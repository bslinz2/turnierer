<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Group;
use App\Models\Game;

class GameController extends Controller {

    public function edit(Group $group, Team $team, Team $vsTeam, $teamResult, $vsTeamResult) {
        $games = Game::where('group_id', $group->id)
            ->where('team_id', $team->id)
            ->where('vs_team_id', $vsTeam->id)
            ->get();

        if(count($games) > 0) {
            $game = $games->first();
        } else {
            $game = new Game();
            $game->team_id = $team->id;
            $game->vs_team_id = $vsTeam->id;
        }

        $game->group_id = $group->id;
        $game->team_result = (int) $teamResult;
        $game->vs_team_result = (int) $vsTeamResult;
        $game->save();
        
        return redirect('/group/detail/' . $group->id);
    }
}
