<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::orderBy('id', 'DESC')->get();
        return View('team.index', ['teams' => $teams]);
    }

    public function edit(Team $team = null) {

        return View('team.edit', ['team' => $team]);
    }

    public function updateInsert(Team $team = null) {
        $this->validate(request(), [
            'name' => 'required|max:255',
        ]);

        if(!$team) {
            $team = new Team();
        }

        $team->fill(request()->all())
            ->save();

        return redirect('/teams');
    }

    public function delete(Team $team) {
        $team->delete();
        return redirect()->back();
    }
}
