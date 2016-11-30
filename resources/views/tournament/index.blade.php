@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Turniere</h1>

        @if(count($tournaments) > 0)
            <table class="table">
                <thead>
                <th>id</th>
                <th>name</th>
                <th>start date</th>
                <th>created at</th>
                <th>updated at</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($tournaments as $tournament)
                    <tr>
                        <td>{{ $tournament->id }}</td>
                        <td>{{ $tournament->name }}</td>
                        <td>{{ $tournament->start }}</td>
                        <td>{{ $tournament->created_at }}</td>
                        <td>{{ $tournament->updated_at }}</td>
                        <td>
                            <a href="/tournament/edit/{{ $tournament->id }}" class="btn btn-info" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/tournament/delete/{{ $tournament->id }}" class="btn btn-danger" role="button">
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
                    Es sind noch keine Turniere angelegt worden.
                </div>
            </div>
        @endif

        <a href="/tournament/edit/" class="btn btn-success" role="button">Neues Turnier anlegen</a>

    </div>
@endsection