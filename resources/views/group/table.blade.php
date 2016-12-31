<br />
<br />

<div class="page-header">
    <h2>Spielstand</h2>
</div>

@if(count($group->teams) > 0)
    <table class="table">
        <thead>
            <th>Rang</th>
            <th>Team</th>
            <th>Punkte</th>
            <th>geschossene Tore</th>
            <th>erhaltene Tore</th>
            <th>Tordifferenz</th>
        </thead>
        <tbody>
        <?  $teams = $group->teams;
            $games = $group->games;
        ?>

        @foreach($group->games as $game)
            @if($game->team_result != null && $game->vs_team_result != null)
                <? $game->points(); ?>
                <? $current = $teams->where('id', $game->team->id)->first(); ?>
                <? $currentVs = $teams->where('id', $game->vsTeam->id)->first(); ?>

                <? $current->points += $game->team->points; ?>
                <? $currentVs->points += $game->vsTeam->points; ?>

                <? $current->goalsShot += $game->team->goalsShot; ?>
                <? $currentVs->goalsShot += $game->vsTeam->goalsShot; ?>

                <? $current->goalsGot += $game->team->goalsGot; ?>
                <? $currentVs->goalsGot += $game->vsTeam->goalsGot; ?>
            @endif
        @endforeach

        <?  $teams = $teams->sort(function($a, $b) {
                if($a->points > $b->points) {
                    return false;
                } elseif($a->points < $b->point) {
                    return true;
                }

                // $a->points == $b->points
                if($a->goalsShot - $a->goalsGot > $b->goalsShot - $b->goalsGot) {
                    return false;
                } elseif($a->goalsShot - $a->goalsGot < $b->goalsShot - $b->goalsGot) {
                    return true;
                }

                // $a->goalsShot - $a->goalsGot == $b->goalsShot - $b->goalsGot
                if($a->goalsShot > $b->goalsShot) {
                    return false;
                } elseif($a->goalsShot < $b->goalsShot) {
                    return true;
                }

                return false;

        }); ?>

        <? $i = 0; $lastPoints = -1; ?>
        @foreach($teams as $team)
            <? $team->points = $team->points ? $team->points : 0; ?>
            <tr>
                <td>
                    @if($lastPoints != $team->points)
                        <? $i++; ?>
                    @endif
                    <? $lastPoints = $team->points; ?>

                    {{ $i }}

                </td>
                <td>
                    {{ $team->name }}
                </td>
                <td>
                    {{ $team->points }}
                </td>
                <td>
                    {{ $team->goalsShot }}
                </td>
                <td>
                    {{ $team->goalsGot }}
                </td>
                <td>
                    {{ $team->goalsShot - $team->goalsGot }}
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