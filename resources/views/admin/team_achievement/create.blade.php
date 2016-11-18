@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-lg-offset-1">
                <h1 class="page-header">
                    @lang('admin.team_achievement')
                    <small>@lang('admin.add')</small>
                </h1>
            </div>

            <div class="col-lg-7 col-lg-offset-1" id="form-add">
                @include('admin.shared.error')

                {!! Form::open(['route' => 'admin.team_achievement.store' ]) !!}
                    <div class="form-group">
                        {!! Form::label('name', Lang::get('admin.name',['name' => 'Achievement'])) !!}
                        {!! Form::text('name', null, [
                            'class' => 'form-control', 
                            'placeholder' => Lang::get('admin.message.holder', ['name' => 'Team Achievement']) ]) 
                        !!}
                    </div>

                   <div class="form-group">
                       {!! Form::label('league_season_id', Lang::get('admin.league_season')) !!}
                       {!! Form::select('league_season_id', $league_seasons, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'League Season'])
                       ]) !!}
                   </div>

                   <div class="form-group">
                       {!! Form::label('team_id', Lang::get('admin.team')) !!}
                       {!! Form::select('team_id', $teams, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Team'])
                       ]) !!}
                   </div>

                    <div class="form-group">
                        {!! Form::submit(Lang::get('admin.bt_add', ['name' => 'Achievement']), 
                            ['class' => 'btn btn-default']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
