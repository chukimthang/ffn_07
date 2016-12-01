@extends('layouts.admin.app')
@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.player_award')
                    <small>@lang('admin.list')</small>
                </h1>
            </div>

            <div class='col-lg-12'>
                <a class='btn btn-primary' href="{{ route('admin.player_award.create') }}">
                    @lang('admin.bt_add', ['name' => 'Award'])
                </a>
                <div class='space20'></div>
            </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>

            <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                <thead>
                    <tr align='center'>
                        <th class='colum' width='10%'>@lang('admin.index')</th>
                        <th class='colum' width='20%'>@lang('admin.lb_name')</th>
                        <th class='colum' width='10%'>@lang('admin.year')</th>
                        <th class='colum'>@lang('admin.player')</th>
                        <th class='colum'>@lang('admin.match')</th>
                        <th class='colum' width='10%'>@lang('admin.edit')</th>
                        <th class='colum' width='10%'>@lang('admin.delete')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($awards as $key => $award)
                    <tr class='odd gradeX' align='center'>
                        <td>{!! $key + 1 !!}</td>
                        <td>{!! $award->name !!}</td>
                        <td>{!! $award->leagueSeason->year !!}</td>
                        <td>{!! $award->player->name !!}</td>
                        <td>{!! $award->match->findTeam($award->match->team1_id)->name !!} - {!! $award->match->findTeam($award->match->team2_id)->name !!}</td>
                        <td class='center'><i class='fa fa-pencil fa-fw'></i>
                            <a href="{!! route('admin.player_award.edit', $award->id) !!}">
                                @lang('admin.edit')
                            </a> 
                        </td>
                        <td class='center'>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.player_award.destroy',
                                $award->id] ]) !!}
                                {!! Form::submit(Lang::get('admin.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class='col-lg-7' align='right'>
                {!! $awards->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
