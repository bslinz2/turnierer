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
git


    @if(in_array(count($group->teams), $teamSizes))
            <br />
            <br />

            <div class="page-header">
                <h2>Spiele</h2>
            </div>

            <table class="table">
                <thead>
                    <th></th>
                    <th>Team 1</th>
                    <th></th>
                    <th>Team 2</th>
                    <th>Ergebnis</th>
                </thead>
                <tbody>
                    @for($i = 0; $i < count($teamSchema); $i++)
                        <?  $team = $group->teams->get($teamSchema[$i][0] -1);
                            $vsTeam = $group->teams->get($teamSchema[$i][1] -1);
                            $currentGame = App\Models\Game::where([
                                    ['group_id',  $group->id],
                                    ['team_id', $team->id],
                                    ['vs_team_id', $vsTeam->id]
                            ])->get();

                            if($currentGame) {
                                $currentGame = $currentGame->first();
                            }
                        ?>
                        <tr>
                            <td>Spiel {{ $i+1  }}</td>
                            <td>{{ $team->name }}</td>
                            <td>vs. </td>
                            <td>{{ $vsTeam->name }}</td>
                            <td>
                                <form action="/game/group/{{ $group->id }}" class="gameForm">
                                    <input type="hidden" name="team" value="{{ $team->id  }}" />
                                    <input type="hidden" name="vs-team" value="{{ $vsTeam->id  }}" />
                                    <input type="hidden" name="group_id" value="{{ $group->id  }}" />
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" required name="team-result" value="{{ $currentGame ? $currentGame->team_result : '' }}"/>
                                        </div>
                                        <div class="col-sm-1">
                                            :
                                        </div>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" required name="vs-team-result" value="{{ $currentGame ? $currentGame->vs_team_result : '' }}" />
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-success">
                                                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>

                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif

        <script type="text/javascript">
            var $gameForms = document.querySelectorAll('.gameForm');
            for(var i = 0; i < $gameForms.length; i++) {
                $gameForms[i].addEventListener('submit', function(event) {
                    var $gameForm = event.currentTarget;
                    var url = '/game/group/' + $gameForm.querySelector('[name=group_id]').value
                            + '/team/' + $gameForm.querySelector('[name=team]').value
                            + '/vs-team/' + $gameForm.querySelector('[name=vs-team]').value
                            + '/team-result/' + $gameForm.querySelector('[name=team-result]').value
                            + '/vs-team-result/' + $gameForm.querySelector('[name=vs-team-result]').value
                    $gameForm.setAttribute('action', url);
                });
            }
        </script>


        <br />
        <br />

        <div class="page-header">
            <h2>Teams</h2>
        </div>


        @if(!in_array(count($group->teams), $teamSizes))
            <div class="alert alert-warning">
                <strong>Warnung!</strong> Eine gültige Gruppe darf nur eine der folgenden Großen haben: {{ implode(', ', $teamSizes) }}
            </div>
        @else
            <div class="alert alert-success">
                <strong>Erfolg!</strong> Diese Gruppe besteht aus {{ count($group->teams) }} Teams und somit können jetzt Spiele eingetragen werden.
            </div>
        @endif

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
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success" role="button">
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