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
            <th style="width: 300px">Ergebnis</th>
            <th>Beginn</th>
            <th>Ende</th>
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
                            <div class="col-sm-3">
                                <input class="form-control" type="number" required name="team-result" value="{{ $currentGame ? $currentGame->team_result : '' }}"/>
                            </div>
                            <div class="col-sm-1">
                                :
                            </div>
                            <div class="col-sm-3">
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
                <? $group->start_date = $group->start_date->second(0); ?>
                <td>{{ $group->start_date }}</td>
                <? $group->start_date = $group->start_date->addMinutes($group->tournament->game_duration) ?>
                <td>{{ $group->start_date }}</td>
                <? $group->start_date = $group->start_date->addMinutes($group->tournament->break_duration) ?>

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