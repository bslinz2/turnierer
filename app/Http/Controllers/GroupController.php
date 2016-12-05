<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Group;

class GroupController extends Controller
{

    public function edit(Tournament $tournament, Group $group = null) {
        return View('group.edit', ['tournament' => $tournament, 'group' => $group]);
    }

    public function updateInsert(Tournament $tournament = null) {
        $this->validate(request(), [
            'name' => 'required|max:255',
            'start' => 'required|date',
            'point_win' => 'required|integer',
            'point_draw' => 'required|integer',
            'point_lose' => 'required|integer',
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
        $groups = Group::where('tournament_id', '=', $tournament->id)->get();
        return View('tournament.detail', ['tournament' => $tournament, 'groups' => $groups]);
    }
}

