@extends('layouts.admin.app')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <h1 class="page-header">@lang('categories.categories_list_header')</h1>
            <a class="btn btn-primary" href="{{ route('admin.categories.create') }}" role="button">@lang('categories.add_categories')</a>
        </div>

        <div class="space20"></div>
        <div class="col-md-12">
            @if(Session::has('flash_message'))
                <p>
                    <div class="alert alert-info">
                        {{Session::get('flash_message')}}
                    </div>
                </p>
            @endif

            @if ( $errors->any() )
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr align="center">
                                <th width="20%">@lang('categories.index_table_column')</th>
                                <th>@lang('categories.name_table_column')</th>
                                <th width="10%">@lang('categories.delete_table_column')</th>
                                <th width="10%">@lang('categories.edit_table_column')</th>    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr class="odd gradeX">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="center">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.categories.destroy', $category->id] ]) !!}
                                            {!! Form::submit( Lang::get('categories.btn_delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="center">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}">
                                            <i class="fa fa-pencil fa-fw"></i>@lang('categories.btn_edit')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $categories->links() }}
        </div>
    </div>
@stop
