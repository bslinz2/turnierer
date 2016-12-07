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
        </thead>
        <tbody>
        <?  $teams = $group->teams;
            $games = $group->games;
        ?>
        @foreach($group->games as $game)
            <? $game->points(); ?>
            <? $teams->where('id', $game->team->id)->first()->points += $game->team->points; ?>
            <? $teams->where('id', $game->vsTeam->id)->first()->points += $game->vsTeam->points; ?>
        @endforeach

        <? $teams = $teams->sortByDesc('points'); ?>

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