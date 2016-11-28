@extends('layouts.admin.app')
@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.rank')
                </h1>
            </div>
        
            <div class='col-md-3 form-group'>
                {!! Form::open(['method' => 'GET', 'route' => 'admin.rank.filter']) !!}
                    {!! Form::select('filter', $leagueSeasons, null, [
                        'class' => 'form-control', 
                        'placeholder' => Lang::get('admin.all', ['name' => 'Season']),
                    ])!!}

                    {!! Form::submit(Lang::get('admin.filter'), ['class' => 'btn btn-primary filter-player-admin']) !!}
                {!! Form::close() !!}
            </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>
            <table class='table table-striped table-bordered table-hover' id='table_rank'>
                <thead>
                    <tr align='center'>
                        <th class='colum'>@lang('admin.index')</th>
                        <th class='colum'>@lang('admin.team')</th>
                        <th class='colum'>@lang('admin.won')</th>
                        <th class='colum'>@lang('admin.drawn')</th>
                        <th class='colum'>@lang('admin.lost')</th>
                        <th class='colum'>@lang('admin.gd')</th>
                        <th class='colum'>@lang('admin.score')</th>
                        <th class='colum'>@lang('admin.year')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranks as $key => $rank)
                        <tr class='odd gradeX' align='center'>
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $rank->team->name !!}</td>
                            <td>{!! $rank->won !!}</td>
                            <td>{!! $rank->drawn !!}</td>
                            <td>{!! $rank->lost !!}</td>
                            <td>{!! $rank->gd !!}</td>
                            <td>{!! $rank->score !!}</td>
                            <td>{!! $rank->leagueSeason->year !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

