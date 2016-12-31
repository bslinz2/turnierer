@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>
                Schema bearbeiten
            </h1>
        </div>

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/tournaments">Turniere</a></li>
            <li><a href="/tournament/detail/{{ $group->tournament->id }}">{{ $group->tournament->name }}</a></li>
            <li><a href="/group/detail/{{ $group->id }}">Gruppe {{ $group->name }}</a></li>
            <li>Schema bearbeiten</li>
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

        <form method="POST" action="/group/{{ $group->id }}/schema">
            {{ csrf_field() }}

            @foreach($group->schema as $schemaRow)
                <div class="row">
                    @foreach($schemaRow as $schemaCol)
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" required class="form-control" name="schema[]"
                                       id="start_date" placeholder="{{ $schemaCol }}" value="{{ $schemaCol }}" />
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach



            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                Speichern
            </button>
        </form>
    </div>
@endsection