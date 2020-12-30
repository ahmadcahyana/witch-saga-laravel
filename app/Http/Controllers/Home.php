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
        $persons = array();
        for($i = 0; $i < count($request->year_of_death); $i++){
            $person = new Person($request->age_of_death[$i], $request->year_of_death[$i]);
            array_push($persons, $person);
        }
        foreach ($persons as $person){
            $sum_killed += $person->getResult()['killed'];
            array_push($results['data'], $person->getResult());
        }
        $average = $sum_killed / count($persons);
        $results['average'] = $average;
        return Response()->json($results);
    }

    public function show(Request $request) {
        $persons = $request;
        return view('show', compact('persons'));
    }
}
