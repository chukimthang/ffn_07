@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.match')
                </h1>
            </div>

            <div class='col-lg-12'>
                <a class='btn btn-primary' href="{{ route('admin.match.create') }}">
                    @lang('admin.bt_add', ['name' => 'Match'])
                </a>
                <div class='space20'></div>
            </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>
            
            @if (count($matches))
                <table class='table table-striped table-bordered table-hover' id='table_match'>
                    <thead>
                        <tr align='center'>
                            <th class='colum'>@lang('admin.index')</th>
                            <th class='colum'>@lang('admin.lb_team', ['name' => '1'])</th>
                            <th class='colum'>@lang('admin.lb_team', ['name' => '2'])</th>
                            <th class='colum'>@lang('admin.start_time')</th>
                            <th class='colum'>@lang('admin.end_time')</th>
                            <th class='colum'>@lang('admin.goal', ['name' => 1])</th>
                            <th class='colum'>@lang('admin.goal', ['name' => 2])</th>
                            <th class='colum'>@lang('admin.status')</th>
                            <th class='colum'>@lang('admin.year')</th>
                            <th class='colum'>@lang('admin.edit')</th>
                            <th class='colum'>@lang('admin.delete')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matches as $key => $match)
                            <tr class='odd gradeX' align='center'>
                                <td>{!! $key + 1 !!}</td>
                                <td>{!! $match->findTeam($match->team1_id) !!}</td>
                                <td>{!! $match->findTeam($match->team2_id) !!}</td>
                                <td>{!! $match->start_time !!}</td>
                                <td>{!! $match->end_time !!}</td>
                                <td>{!! $match->checkStatus($match->status, $match->team1_goal) !!}</td>
                                <td>{!! $match->checkStatus($match->status, $match->team2_goal) !!}</td>
                                <td>{!! config('view.status')[$match->status] !!}</td>
                                <td>{!! $match->leagueSeason->year !!}</td>
                                <td class='center'><i class='fa fa-pencil fa-fw'></i>
                                    <a href="#">@lang('admin.edit')</a> 
                                </td>
                                <td class='center'>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 align='center'>@lang('admin.message.empty_data', ['name' => 'Match'])</h4>
            @endif

            <div class='col-lg-7' align='right'>
                {!! $matches->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
