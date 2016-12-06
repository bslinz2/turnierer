@extends('layouts.app')

@section('content')
    <div class="container">
        <? $exists = $group->id == null ? false : true; ?>

        <div class="page-header">
            <h1>
                @if($exists)
                    Gruppe bearbeiten
                @else
                    Gruppe erstellen
                @endif
            </h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/tournaments">Turniere</a></li>
            <li><a href="/tournament/detail/{{ $tournament->id }}">{{ $tournament->name }}</a></li>
            <li class="active">
                @if($exists)
                    Gruppe bearbeiten (id: {{ $tournament->id }})
                @else
                    Gruppe erstellen
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

        <form method="POST" action="/tournament/{{ $tournament->id }}/group/edit/{{ $exists ? $group->id : '' }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" autofocus class="form-control" id="name" placeholder="Name" name="name" value="{{ $exists ? $group->name : old('name') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="text" class="form-control" name="start_date" id="start_date" placeholder="YYYY-MM-DD HH:MM:SS ({{ Carbon\Carbon::now() }})" value="{{ $exists ? $group->start_date : Carbon\Carbon::now() }}">
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