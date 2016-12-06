@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-header">
            <h1>Turniere</h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li  class="active">Turniere</li>
        </ol>

        @if(count($tournaments) > 0)
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Name</th>
                    <th>Startdatum</th>
                    <th>Erstelldatum</th>
                    <th>Gruppen</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($tournaments as $tournament)
                    <tr>
                        <td>{{ $tournament->id }}</td>
                        <td>{{ $tournament->name }}</td>
                        <td>{{ $tournament->start_date }}</td>
                        <td>{{ $tournament->created_at }}</td>
                        <td>{{ count($tournament->groups) }}</td>
                        <td>
                            <a href="/tournament/detail/{{ $tournament->id }}" class="btn btn-success" role="button">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                        </td>
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

        <a href="/tournament/edit/" class="btn btn-success" role="button">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Neues Turnier anlegen
        </a>

    </div>
@endsection