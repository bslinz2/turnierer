@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-header">
            <h1>Teams</h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li  class="active">Teams</li>
        </ol>

        @if(count($teams) > 0)
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Name</th>
                    <th>Erstelldatum</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->updated_at }}</td>
                        <td>
                            <a href="/team/edit/{{ $team->id }}" class="btn btn-info" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            @if(true || count($team->groups) < 1 )
                                <a href="/team/delete/{{ $team->id }}" class="btn btn-danger" role="button">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            @else
                                Team ist in mindestens einer Gruppe.
                            @endif
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

        <a href="/team/edit/" class="btn btn-success" role="button">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Neues Team anlegen
        </a>

    </div>
@endsection