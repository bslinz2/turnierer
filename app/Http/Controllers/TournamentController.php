<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tournament;

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
            'start' => 'required|date',
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
}
