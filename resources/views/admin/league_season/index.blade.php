@extends('layouts.admin.app')
@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.league_season')
                </h1>
            </div>

            <div class='col-lg-12'>
                <a class='btn btn-primary' href="{{ route('admin.league_season.create') }}">
                    @lang('admin.bt_add', ['name' => 'League Season'])
                </a>
                <div class='space20'></div>
            </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>
            
            @if (count($leagueSeasons))
                <table class='table table-striped table-bordered table-hover' id='table_league_season'>
                    <thead>
                        <tr align='center'>
                            <th class='colum' width='10%'>@lang('admin.index')</th>
                            <th class='colum' width='20%'>@lang('admin.year')</th>
                            <th class='colum'>@lang('admin.league')</th>
                            <th class='colum'>@lang('admin.country')</th>
                            <th class='colum' width='10%'>@lang('admin.edit')</th>
                            <th class='colum' width='10%'>@lang('admin.delete')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leagueSeasons as $key => $season)
                            <tr class='odd gradeX' align='center'>
                                <td>{!! $key + 1 !!}</td>
                                <td>{!! $season->year !!}</td>
                                <td>{!! $season->league->name !!}</td>
                                <td>{!! $season->league->country->name !!}</td>
                                <td class='center'><i class='fa fa-pencil fa-fw'></i>
                                    <a href="{!! route('admin.league_season.edit', $season->id) !!}">@lang('admin.edit')</a> 
                                </td>
                                <td class='center'>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.league_season.destroy',
                                        $season->id] ]) !!}
                                        {!! Form::submit(Lang::get('admin.delete'),
                                            ['class' => 'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 align='center'>@lang('admin.message.empty_data', ['name' => 'League season'])</h4>
            @endif

            <div class='col-lg-7' align='right'>
                {!! $leagueSeasons->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
