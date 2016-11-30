@extends('layouts.app')

@section('content')
    <div class="container">
        <? $exists = $team->id == null ? false : true; ?>

        <h1>
            @if($exists)
                Team bearbeiten (id: {{ $team->id }})
            @else
                Neues Team erstellen
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

        <form method="POST" action="/team/edit/{{ $exists ? $team->id : '' }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $exists ? $team->name : '' }}">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>


    </div>
@endsection