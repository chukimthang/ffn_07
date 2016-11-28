
@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12 col-lg-offset-1'>
                <h1 class='page-header'>
                    @lang('admin.match')
                    <small>@lang('admin.edit')</small>
                </h1>
            </div>

            <div class='col-lg-7 col-lg-offset-1'>
                {!! Form::model($match, ['method' => 'PUT', 'route' => ['admin.match.update',
                    $match->id]]) !!}
                    @include('admin.shared.error')

                    <div class='form-group'>
                        {!! Form::label('team1_id', Lang::get('admin.lb_team', ['name' => '1'])) !!}
                        {!! Form::select('team1_id', $teams, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Team'])
                        ]) !!}
                    </div>

                    <div class='form-group'>
                        {!! Form::label('team2_id', Lang::get('admin.lb_team', ['name' => '2'])) !!}
                        {!! Form::select('team2_id', $teams, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Team'])
                        ]) !!}
                    </div>

                    <div class='form-group'>
                        {!! Form::label('start_time', Lang::get('admin.start_time')) !!}
                        <div class='input-group date datetimepicker'>
                            {!! Form::text('start_time', null, ['class' => 'form-control']) !!}
                            <span class='input-group-addon'>
                                <span class='glyphicon glyphicon-calendar'></span>
                            </span>
                        </div>
                    </div>

                    <div class='form-group'>
                        {!! Form::label('end_time', Lang::get('admin.end_time')) !!}
                        <div class='input-group date datetimepicker'>
                            {!! Form::text('end_time', null, ['class' => 'form-control']) !!}
                            <span class='input-group-addon'>
                                <span class='glyphicon glyphicon-calendar'></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('team1_goal', Lang::get('admin.goal', ['name' => 1])) !!}
                        {!! Form::text('team1_goal', null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Goal'])
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('team2_goal', Lang::get('admin.goal', ['name' => 2])) !!}
                        {!! Form::text('team2_goal', null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Goal'])
                        ]) !!}
                    </div>

                    <div class='form-group'>
                        {!! Form::label('league_season_id', Lang::get('admin.league_season')) !!}
                        {!! Form::select('league_season_id', $leagueSeasons, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Year'])
                        ]) !!}
                    </div>

                    <div class='form-group'>
                        {!! Form::label('status', Lang::get('admin.status')) !!}
                        {!! Form::select('status', $status, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Status'])
                        ]) !!}
                    </div>

                    <div class='form-group'>
                        {!! Form::submit(Lang::get('admin.bt_add', ['name' => 'Match']),
                            ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type='text/javascript' src='{{ asset('admin_asset/js/app.js') }}'></script>
<script type="text/javascript">
    var a = new app();
    a.init();
</script>
@stop
