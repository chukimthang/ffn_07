@extends('layouts.admin.app')
@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.team_achievement')
                    <small>@lang('admin.list')</small>
                </h1>
            </div>

            <div class='col-lg-12'>
                <a class='btn btn-primary' href="{{ route('admin.team_achievement.create') }}">
                    @lang('admin.bt_add', ['name' => 'Achievement'])
                </a>
                <div class='space20'></div>
            </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>

            <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                <thead>
                    <tr align='center'>
                        <th class='colum'>@lang('admin.index')</th>
                        <th class='colum' width='20%'>@lang('admin.lb_name')</th>
                        <th class='colum'>@lang('admin.year')</th>
                        <th class='colum'>@lang('admin.team')</th>
                        <th class='colum'>@lang('admin.country')</th>
                        <th class='colum' width='10%'>@lang('admin.edit')</th>
                        <th class='colum' width='10%'>@lang('admin.delete')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($achievements as $key => $achievement)
                    <tr class='odd gradeX' align='center'>
                        <td>{!! $key + 1 !!}</td>
                        <td>{!! $achievement->name !!}</td>
                        <td>{!! $achievement->leagueSeason->year !!}</td>
                        <td>{!! $achievement->team->name !!}</td>
                        <td>{!! $achievement->leagueSeason->league->country->name !!}</td>
                        <td class='center'><i class='fa fa-pencil fa-fw'></i>
                            <a href="{!! route('admin.team_achievement.edit', $achievement->id) !!}">@lang('admin.edit')</a> 
                        </td>
                        <td class='center'>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.team_achievement.destroy',
                                $achievement->id] ]) !!}
                                {!! Form::submit(Lang::get('admin.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class='col-lg-7' align='right'>
                {!! $achievements->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
