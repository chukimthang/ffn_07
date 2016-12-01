@extends('layouts.admin.app')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @lang('admin.position')
                    <small>@lang('admin.list')</small>
                </h1>
            </div>

            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.position.create') }}">
                    @lang('admin.bt_add', ['name' => 'position'])
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
                        <th class="colum" width="40%">@lang('admin.lb_name')</th>
                        <th class="colum">@lang('admin.create_at')</th>
                        <th class="colum" width="10%">@lang('admin.edit')</th>
                        <th class="colum" width="10%">@lang('admin.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($positions))
                        @foreach($positions as $key => $position)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $key + 1 !!}</td>
                                <td>{!! $position->name !!}</td>
                                <td>{!! $position->created_at->format('d-m-Y') !!}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i>
                                    <a href="{!! route('admin.position.edit', $position->id) !!}">
                                        @lang('admin.edit')
                                    </a> 
                                </td>
                                <td class="center">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.position.destroy',
                                        $position->id] ]) !!}
                                        {!! Form::submit(Lang::get('admin.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr id="position_tr">
                            <td id="position_td"></td>
                            <td id="position_td"><h4>@lang('admin.table_empty')</h4></td>
                            <td id="position_td"></td>
                            <td id="position_td"></td>
                            <td id="position_td"></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="col-lg-7" align="right">
                {!! $positions->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
