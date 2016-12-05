@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Turnier: {{ $tournament->name }}</h1>

        <p>startdate:  {{ $tournament->start_date }}</p>
        <p>
            Punkte für Gewinn:  {{ $tournament->point_win }}<br />
            Punkte für Unentschieden:  {{ $tournament->point_draw }}<br />
            Punkte für Verlierer:  {{ $tournament->point_lose }}
        </p>

        <a href="/tournament/edit/{{ $tournament->id }}" class="btn btn-info" role="button">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
        </a>

        <hr />

        <h2>Gruppen</h2>

        @if(count($groups) > 0)
            <table class="table">
                <thead>
                <th>id</th>
                <th>name</th>
                <th>created at</th>
                <th>updated at</th>
                <th></th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->start_date }}</td>
                        <td>{{ $group->created_at }}</td>
                        <td>{{ $group->updated_at }}</td>
                        <td>
                            <a href="/tournament/{{ $tournament->id }}/group/detail/{{ $group->id }}" class="btn btn-success" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/tournament/{{ $tournament->id }}/group/edit/{{ $group->id }}" class="btn btn-info" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/tournament/{{ $tournament->id }}/group/delete/{{ $group->id }}" class="btn btn-danger" role="button">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="panel panel-info">
                <div class="panel-body">
                    Es sind noch keine Gruppen angelegt worden.
                </div>
            </div>
        @endif

        <a href="/tournament/{{ $tournament->id }}/group/edit/" class="btn btn-info" role="button">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gruppe hinzufügen
        </a>
    </div>
@endsection