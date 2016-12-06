@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-header">
            <h1>
                Turnier: <i>{{ $tournament->name }}</i>
            </h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/tournaments">Turniere</a></li>
            <li class="active">{{ $tournament->name }}</li>
        </ol>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daten</h3>
                    </div>
                    <div class="panel-body">
                        Erstelldatum: <i>{{ $tournament->created_at }}</i><br />
                        Änderungsdatum: <i>{{ $tournament->created_at }}</i><br />
                        Startdatum: <i>{{ $tournament->start_date }}</i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Punkte</h3>
                    </div>
                    <div class="panel-body">
                        Gewinn: <i>{{ $tournament->point_win }}</i><br />
                        Unentschieden: <i>{{ $tournament->point_draw }}</i><br />
                        Verlierer: <i>{{ $tournament->point_lose }}</i>
                    </div>
                </div>
            </div>
        </div>

        <a href="/tournament/edit/{{ $tournament->id }}" class="btn btn-info" role="button">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Bearbeiten
        </a>

        <br />
        <br />

        <div class="page-header">
            <h2>
                Gruppen
            </h2>
        </div>


        @if(count($groups) > 0)
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Name</th>
                    <th>Startdatum</th>
                    <th>Erstelldatum</th>
                    <th>Teams</th>
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
                        <td>{{ count($group->teams) }}</td>
                        <td>
                            <a href="/group/detail/{{ $group->id }}" class="btn btn-default" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/tournament/{{ $tournament->id }}/group/edit/{{ $group->id }}" class="btn btn-info" role="button">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/group/delete/{{ $group->id }}" class="btn btn-danger" role="button">
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

        <a href="/tournament/{{ $tournament->id }}/group/edit/" autofocus id="new" class="btn btn-success" role="button">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gruppe hinzufügen
        </a>

        <script>
            document.getElementById("new").focus();
        </script>
    </div>
@endsection