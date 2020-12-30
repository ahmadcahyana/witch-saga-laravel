<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Person;
class Home extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $sum_killed = 0;
        $results['data'] = array();
        for($i = 0; $i < count($request->year_of_death); $i++){
            if ($request->year_of_death[$i] <= 0 or $request->age_of_death[$i] <= 0){
                $results['data'] = [];
                $results['message'] = "Oops... Please input positive number!";
                $results['error'] = -1;
                break;
            }
            elseif (($request->year_of_death[$i] - $request->age_of_death[$i]) < 1){
                $results['data'] = [];
                $results['message'] = "Oops... Year of Date must be bigger than Age of Date";
                $results['error'] = -1;
                break;
            }
            else {
                $person = new Person($request->age_of_death[$i], $request->year_of_death[$i]);
                $sum_killed += $person->getResult()['killed'];
                array_push($results['data'], $person->getResult());
            }
        }
        if ($results['error'] != -1){
            $average = $sum_killed / count($results['data']);

        }
        else{
            $average = 0;
        }
        $results['average'] = $average;
        return Response()->json($results);
    }

    public function show(Request $request) {
        $persons = $request;
        if($persons['error'] == -1){
            return;
        }
        return view('show', compact('persons'));
    }
}
