@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-header">
            <h1>Gruppe {{ $group->name }}</h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/tournaments">Tuniere</a></li>
            <li><a href="/tournament/detail/{{ $group->tournament->id }}">{{ $group->tournament->name }}</a></li>
            <li>Gruppe {{ $group->name }}</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daten</h3>
                    </div>
                    <div class="panel-body">
                        Erstelldatum: <i>{{ $group->created_at }}</i><br />
                        Änderungsdatum: <i>{{ $group->created_at }}</i><br />
                        Startdatum: <i>{{ $group->start_date }}</i>
                    </div>
                </div>
            </div>
        </div>
        <a href="/tournament/{{ $group->tournament->id }}/group/edit/{{ $group->id }}" class="btn btn-info" role="button">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Bearbeiten
        </a>

        <a href="/group/{{ $group->id }}/schema/" class="btn btn-info" role="button">
            <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Schema bearbeiten
        </a>
        @include('group.game')

        @include('group.table')

        @include('group.team')

        @include('group.team-add')

    </div>
@endsection