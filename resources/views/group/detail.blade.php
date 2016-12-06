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
            <div class="col-md-6">
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

        <br />
        <br />

        <div class="page-header">
            <h2>Teams</h2>
        </div>

        @if(count($group->teams) > 0)
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Name</th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($group->teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>{{ $team->name }}</td>
                        <td>
                            <a href="/group/{{ $group->id }}/remove-team/{{ $team->id }}" class="btn btn-danger" role="button">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="panel panel-info">
                <div class="panel-body">
                    Es sind noch keine Teams hinzugefügt worden.
                </div>
            </div>
        @endif

        <div class="page-header">
            <h2>Team hinzufügen</h2>
        </div>

        @if(count($addAbleTeams) < 1)
            <div class="panel panel-info">
                <div class="panel-body">
                    Es sind keine Teams zum Hinzufügen verfügbar.
                </div>
            </div>
        @else
            <form method="GET" action="/group/add-team" id="teamForm">
                <input type="hidden" value="{{ $group->id }}" name="group_id" />
                <div class="form-group">
                    <select name="team_id" class="form-control">
                        @foreach($addAbleTeams as $addAbleTeam)
                            <option value="{{ $addAbleTeam->id }}">
                                {{ $addAbleTeam->name }}
                                ({{ $addAbleTeam->id }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-info" role="button">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Team hinzufügen
                </button>
            </form>

            <script type="text/javascript">
                var $form = document.querySelector('#teamForm');
                $form.addEventListener('submit', function(event) {
                    var url = '/group/' + $form.querySelector('[name=group_id]').value + '/add-team/' +
                            $form.querySelector('[name=team_id]').value;
                    $form.setAttribute('action', url);
                });
            </script>
        @endif


    </div>
@endsection