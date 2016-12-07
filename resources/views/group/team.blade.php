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

@if(count($group->games) > 0)
    <div class="alert alert-warning">
        <strong>Warnung!</strong> Diese Gruppe kann nicht mehr editiert werden, da bereits Spiele eingetragen worden sind.
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
                    @if(count($group->games) < 1)
                        <a href="/group/{{ $group->id }}/remove-team/{{ $team->id }}" class="btn btn-danger" role="button">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    @endif
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