@extends('layouts.app')

@section('content')
    <div class="container">
        <? $exists = $team->id == null ? false : true; ?>

        <div class="page-header">
            <h1>
                @if($exists)
                    Team bearbeiten
                @else
                    Neues Team erstellen
                @endif
            </h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/teams">Teams</a></li>
            <li class="active">
                @if($exists)
                    Bearbeiten (id: {{ $team->id }})
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

        <form method="POST" action="/team/edit/{{ $exists ? $team->id : '' }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" required autofocus class="form-control" id="name" placeholder="Name" name="name" value="{{ $exists ? $team->name : '' }}">
            </div>

            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                Speichern
            </button>
        </form>


    </div>
@endsection