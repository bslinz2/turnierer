@extends('layouts.app')

@section('content')
    <div class="container">
        <? $exists = $tournament->id == null ? false : true; ?>



        <h1>
            @if($exists)
                Turnier bearbeiten (id: {{ $tournament->id }})
            @else
                Neues Turnier erstellen
            @endif
        </h1>

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

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $exists ? $tournament->name : '' }}">
            </div>
            <div class="form-group">
                <label for="start">Start Date</label>
                <input type="text" class="form-control" name="start" id="start" placeholder="YYYY-MM-DD HH:MM:SS ({{ Carbon\Carbon::now() }})" value="{{ $exists ? $tournament->start : '' }}">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>


    </div>
@endsection