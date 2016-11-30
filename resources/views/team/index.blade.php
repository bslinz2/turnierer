@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Teams</h1>

        @if(count($teams) > 0)
            <table class="table">
                <thead>
                <th>id</th>
                <th>name</th>
                <th>created at</th>
                <th>updated at</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->created_at }}</td>
                        <td>{{ $team->updated_at }}</td>
                        <td>
                            <a href="/team/edit/{{ $team->id }}" class="btn btn-info" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/team/delete/{{ $team->id }}" class="btn btn-danger" role="button">
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
                    Es sind noch keine Teams angelegt worden.
                </div>
            </div>
        @endif

        <a href="/team/edit/" class="btn btn-success" role="button">Neues Team anlegen</a>

    </div>
@endsection