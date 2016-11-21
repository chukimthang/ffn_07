@extends('layouts.admin.app')
@extends('layouts.admin.menu')
@section('content')

<div id='page-wrapper'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-12'>
                <h1 class='page-header'>
                    @lang('admin.country')
                    <small>@lang('admin.list')</small>
                </h1>
            </div>

            <div class='col-lg-12'>
                <a class='btn btn-primary' href="{{ route('admin.country.create') }}">
                    @lang('admin.bt_add', ['name' => 'Country'])
                </a>
                <div class='space20'></div>
            </div>

            <div class='col-lg-12'>
                @include('admin.shared.flash')
            </div>

            @if (count($countries))
                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                    <thead>
                        <tr align='center'>
                            <th class='colum' width='10%'>@lang('admin.index')</th>
                            <th class='colum'>@lang('admin.lb_name')</th>
                            <th class='colum'>@lang('admin.code')</th>
                            <th class='colum' width='10%'>@lang('admin.edit')</th>
                            <th class='colum' width='10%'>@lang('admin.delete')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($countries as $key => $country)
                        <tr class='odd gradeX' align='center'>
                            <td>{!! $key + 1 !!}</td>
                            <td>{!! $country->name !!}</td>
                            <td>{!! '+' . $country->code !!}</td>
                            <td class='center'><i class='fa fa-pencil fa-fw'></i>
                                <a href='{!! route('admin.country.edit', $country->id) !!}'>@lang('admin.edit')</a> 
                            </td>
                            <td class='center'>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.country.destroy',
                                    $country->id] ]) !!}
                                    {!! Form::submit( Lang::get('Delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h4 align='center'>@lang('admin.message.empty_data', ['name' => 'Country'])</h4>
            @endif
            
            <div class='col-lg-7' align='right'>
                {!! $countries->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
