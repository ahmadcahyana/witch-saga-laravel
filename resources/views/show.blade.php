<div class="col-md-12">
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Born</th>
        <th>Killed</th>
    </tr>
    </thead>
    <tbody>
    @foreach($persons->data as $index => $person)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $person['born'] }}</td>
            <td>{{ $person['killed'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="col-md-12">
    <p class="text-right">Average : <strong>{{ $persons->average }}</strong></p>
</div>

