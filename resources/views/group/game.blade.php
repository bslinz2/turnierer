@if(in_array(count($group->teams), $teamSizes))
    <br />
    <br />

    <div class="page-header">
        <h2>Spiele</h2>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Team 1</th>
                <th>Team 2</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Beginn</th>
                <th>Ende</th>
            </tr>
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

                <td colspan="5">
                    <form action="/game/group/{{ $group->id }}" class="gameForm">
                        <input type="hidden" name="team" value="{{ $team->id  }}" />
                        <input type="hidden" name="vs-team" value="{{ $vsTeam->id  }}" />
                        <input type="hidden" name="group_id" value="{{ $group->id  }}" />

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">{{ $team->name }}</label>
                                    <input class="form-control" type="number" required name="team-result" value="{{ $currentGame ? $currentGame->team_result : '' }}"/>
                                </div>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">{{ $vsTeam->name }}</label>
                                    <input class="form-control" type="number" required name="vs-team-result" value="{{ $currentGame ? $currentGame->vs_team_result : '' }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Start Versatz (Minuten)</label>
                                    <input class="form-control" type="number" name="start_offset" required value="{{ $currentGame ? $currentGame->start_offset : 0 }}" />
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="name"></label>
                                    <button type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>


                <? $group->start_date = $group->start_date->second(0); ?>

                @if($currentGame)
                    <? $group->start_date = $group->start_date->addMinutes($currentGame->start_offset); ?>
                @endif

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
                    + '/start-offset/' + $gameForm.querySelector('[name=start_offset]').value
            $gameForm.setAttribute('action', url);
        });
    }
</script>