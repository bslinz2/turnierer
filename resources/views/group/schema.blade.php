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

        @if(count($group->games) > 0)
            <div class="alert alert-warning">
                <strong>Warnung!</strong> Es sind bereits Spiele eingetragen worden, deswegen ist es wichtig, dass die gespielten Spiele nicht mehr editiert werden!
            </div>
        @endif

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

            <? $i = 1; ?>

            @foreach($group->schema as $schemaRow)
                <div class="row">
                    <div class="col-md-1">
                        Spiel {{ $i }}
                    </div>
                    <div class="col-md-1">
                        Team
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" required class="form-control" name="schema[]"
                                   id="start_date" placeholder="{{ $schemaRow[0] }}" value="{{ $schemaRow[0] }}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        gegen
                    </div>
                    <div class="col-md-1">
                        Team
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" required class="form-control" name="schema[]"
                                   id="start_date" placeholder="{{ $schemaRow[1] }}" value="{{ $schemaRow[1] }}" />
                        </div>
                    </div>
                </div>
                <hr />
                <? $i++; ?>
            @endforeach



            <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                Speichern
            </button>
        </form>
    </div>
@endsection