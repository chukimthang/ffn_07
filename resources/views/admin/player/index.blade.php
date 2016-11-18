@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @lang('admin.player')
                    <small>@lang('admin.list')</small>
                </h1>
            </div>

            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.player.create') }}">
                    @lang('admin.bt_add', ['name' => 'Player'])
                </a>
                <div class="space20"></div>
            </div>

            <div class="col-lg-12">
                @include('admin.shared.flash')
            </div>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th class="colum">@lang('admin.index')</th>
                        <th class="colum" width="20%">@lang('admin.lb_name')</th>
                        <th class="colum">@lang('admin.position')</th>
                        <th class="colum">@lang('admin.birthday')</th>
                        <th class="colum">@lang('admin.team')</th>
                        <th class="colum">@lang('admin.country')</th>
                        <th class="colum" width="10%">@lang('admin.edit')</th>
                        <th class="colum" width="10%">@lang('admin.delete')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($players as $key => $player)
                    <tr class="odd gradeX" align="center">
                        <td>{!! $key + 1 !!}</td>
                        <td>{!! $player->name !!}</td>
                        <td>{!! Lang::get('admin.positions.'.$player->position) !!}</td>
                        <td>{!! date("d-m-Y", strtotime($player->birthday)); !!}</td>
                        <td>{!! $player->team->name !!}</td>
                        <td>{!! $player->country->name !!}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i>
                            <a href="{!! route('admin.player.edit', $player->id) !!}">@lang('admin.edit')</a> 
                        </td>
                        <td class="center">
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.player.destroy',
                                $player->id] ]) !!}
                                {!! Form::submit(Lang::get('admin.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-lg-7" align="right">
                {!! $players->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
