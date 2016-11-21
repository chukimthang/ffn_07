@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.player')
                    <small>@lang('admin.list')</small>
                </h1>
            </div>

            <div class='col-md-12'>
                <div class='col-md-3'>
                    <a class='btn btn-primary' href="{{ route('admin.player.create') }}">
                        @lang('admin.bt_add', ['name' => 'Player'])
                    </a>
                </div>
               
                <div class='col-md-3 form-group'>
                    {!! Form::open(['method' => 'GET', 'route' => 'admin.player.filter']) !!}
                        {!! Form::select('filter', $teams, null, [
                            'class' => 'form-control', 
                            'placeholder' => Lang::get('admin.all', ['name' => 'Player']),
                        ])!!}

                        {!! Form::submit(Lang::get('admin.filter'), ['class' => 'btn btn-primary filter-player-admin']) !!}
                    {!! Form::close() !!}
                </div>

                <div class='col-md-3 col-md-offset-3 form-group'>
                    {!! Form::open(['method' => 'GET', 'route' => 'admin.player.search']) !!}
                        {!! Form::text('search', null, ['id' => 'text-search-player',
                            'class' => 'form-control', 'placeholder' => 'Search']) !!}
                        <i class='fa fa-search' aria-hidden='true' id='search-team'></i>
                    {!! Form::close() !!}
                </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>

            <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                <thead>
                    <tr align='center'>
                        <th class='colum'>@lang('admin.index')</th>
                        <th class='colum' width='20%'>@lang('admin.lb_name')</th>
                        <th class='colum'>@lang('admin.position')</th>
                        <th class='colum'>@lang('admin.birthday')</th>
                        <th class='colum'>@lang('admin.team')</th>
                        <th class='colum'>@lang('admin.country')</th>
                        <th class='colum' width='10%'>@lang('admin.edit')</th>
                        <th class='colum' width='10%'>@lang('admin.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($players))
                        @foreach($players as $key => $player)
                            <tr class='odd gradeX' align='center'>
                                <td>{!! $key + 1 !!}</td>
                                <td>{!! $player->name !!}</td>
                                <td>{!! $player->position->name !!}</td>
                                <td>{!! date('d-m-Y', strtotime($player->birthday)); !!}</td>
                                <td>{!! $player->team->name !!}</td>
                                <td>{!! $player->country->name !!}</td>
                                <td class='center'><i class='fa fa-pencil fa-fw'></i>
                                    <a href='{!! route('admin.player.edit', $player->id) !!}'>@lang('admin.edit')</a> 
                                </td>
                                <td class='center'>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.player.destroy',
                                        $player->id] ]) !!}
                                        {!! Form::submit(Lang::get('admin.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class='position_tr'>
                            <td colspan='8'><h4>@lang('admin.table_empty')</h4></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class='col-lg-7' align='right'>
                {!! $players->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
