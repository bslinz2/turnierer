@extends('layouts.app')

@section('content')
    <div class="container">
        <? $exists = $group->id == null ? false : true; ?>



        <h1>
            @if($exists)
                Gruppe bearbeiten (id: {{ $group->id }})
            @else
                Gruppe Turnier erstellen
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

        <form method="POST" action="/tournament/{{ $tournament->id }}/group/edit/{{ $exists ? $group->id : '' }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" autofocus class="form-control" id="name" placeholder="Name" name="name" value="{{ $exists ? $group->name : old('name') }}">
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" placeholder="YYYY-MM-DD HH:MM:SS ({{ Carbon\Carbon::now() }})" value="{{ $exists ? $group->start_date : Carbon\Carbon::now() }}">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>


    </div>
@endsection