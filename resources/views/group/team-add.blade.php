@if(count($group->games) < 1)
    <div class="page-header">
        <h2>Team hinzufügen</h2>
    </div>

    @if(count($addAbleTeams) < 1)
        <div class="panel panel-info">
            <div class="panel-body">
                Es sind keine Teams zum Hinzufügen verfügbar.
            </div>
        </div>
    @else
        <form method="GET" action="/group/add-team" id="teamForm">
            <input type="hidden" value="{{ $group->id }}" name="group_id" />
            <div class="form-group">
                <select name="team_id" class="form-control">
                    @foreach($addAbleTeams as $addAbleTeam)
                        <option value="{{ $addAbleTeam->id }}">
                            {{ $addAbleTeam->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success" role="button">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Team hinzufügen
            </button>
        </form>

        <script type="text/javascript">
            var $form = document.querySelector('#teamForm');
            $form.addEventListener('submit', function(event) {
                var url = '/group/' + $form.querySelector('[name=group_id]').value + '/add-team/' +
                        $form.querySelector('[name=team_id]').value;
                $form.setAttribute('action', url);
            });
        </script>
    @endif
@endif