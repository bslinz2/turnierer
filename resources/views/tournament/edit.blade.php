@extends('layouts.app')

@section('content')
    <div class="container">
        <? $exists = $tournament->id == null ? false : true; ?>

        <div class="page-header">
            <h1>
                @if($exists)
                    Turnier bearbeiten
                @else
                    Neues Turnier erstellen
                @endif
            </h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/tournaments">Turniere</a></li>
            <li class="active">
                @if($exists)
                    Bearbeiten (id: {{ $tournament->id }})
                @else
                    Erstellen
                @endif
            </li>
        </ol>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/tournament/edit/{{ $exists ? $tournament->id : '' }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" autofocus class="form-control" id="name" placeholder="Name" name="name" value="{{ $exists ? $tournament->name : old('name') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="text" class="form-control" name="start_date" id="start_date" placeholder="YYYY-MM-DD HH:MM:SS ({{ Carbon\Carbon::now() }})" value="{{ $exists ? $tournament->start_date : Carbon\Carbon::now() }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="break_duration">Pausenzeit in Minuten</label>
                        <input type="text" required class="form-control" name="break_duration" id="break_duration"  value="{{ $exists && !old('break_duration')? $tournament->break_duration : old('break_duration') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="game_duration">Spielzeit in Minuten</label>
                        <input type="text" required class="form-control" name="game_duration" id="game_duration"  value="{{ $exists && !old('game_duration')? $tournament->game_duration : old('game_duration') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="point_win">Punkte für Gewinner</label>
                        <input type="text" required class="form-control" name="point_win" id="point_win"  value="{{ $exists && !old('point_win') ? $tournament->point_win : old('point_win') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="point_draw">Punkte für Unentschieden</label>
                        <input type="text" required class="form-control" name="point_draw" id="point_draw"  value="{{ $exists && !old('point_draw') ? $tournament->point_draw : old('point_draw') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="point_lose">Punkte für Verlierer</label>
                        <input type="text" required class="form-control" name="point_lose" id="point_lose"  value="{{ $exists && !old('point_lose')? $tournament->point_lose : old('point_lose') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                Speichern
            </button>
        </form>


    </div>
@endsection