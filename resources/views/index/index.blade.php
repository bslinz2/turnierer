@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="jumbotron">
            <div class="container">
                <h1>Turnierer</h1>
                <p>Tuniere einfach managen.</p>
            </div>
        </div>

        @if (Auth::guest())
            Sie müssen sich einloggen um den <i>Turnierer</i> zu verwenden.
        @else
            <div class="panel panel-default">
                <div class="panel-heading">Turniere</div>
                <div class="panel-body">
                    <a href="/tournaments">/tournaments</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Teams</div>
                <div class="panel-body">
                    <a href="/teams">/teams</a>
                </div>
            </div>
        @endif


    </div>
@endsection