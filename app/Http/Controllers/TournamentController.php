<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tournament;
use App\Models\Group;

class TournamentController extends Controller
{
    public function index() {
        $tournaments = Tournament::orderBy('id', 'DESC')->get();
        return View('tournament.index', ['tournaments' => $tournaments]);
    }

    public function edit(Tournament $tournament = null) {
        return View('tournament.edit', ['tournament' => $tournament]);
    }

    public function updateInsert(Tournament $tournament = null) {
        $this->validate(request(), [
            'name' => 'required|max:255',
            'start_date' => 'required|date',
            'point_win' => 'required|integer',
            'point_draw' => 'required|integer',
            'point_lose' => 'required|integer',
            'game_duration' => 'required|integer',
            'break_duration' => 'required|integer',
        ]);

        if(!$tournament) {
            $tournament = new Tournament();
        }

        $tournament->fill(request()->all())
            ->save();

        return redirect('/tournaments');
    }

    public function delete(Tournament $tournament) {
        $tournament->delete();
        return redirect()->back();
    }

    public function detail(Tournament $tournament) {
        $groups = Group::where('tournament_id', '=', $tournament->id)
            ->orderBy('name', 'ASC')
            ->get();
        return View('tournament.detail', ['tournament' => $tournament, 'groups' => $groups]);
    }
}
