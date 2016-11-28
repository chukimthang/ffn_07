@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <h1 class="page-header">@lang('teams.teams_list_header')</h1>
            <div class="col-md-3 form-group">
                <a class="btn btn-primary" href="{{ route('admin.teams.create') }}" role="button">@lang('teams.add_team')</a>
            </div>
            <div class="col-md-3 col-md-offset-6 form-group">
                {!! Form::open(['method' => 'GET', 'route' => 'admin.teams.search']) !!}
                    {!! Form::text('search', null, ['id' => 'text-search-team',
                        'class' => 'form-control', 'placeholder' => 'Search']) !!}
                    <i class="fa fa-search" aria-hidden="true" id="search-team"></i>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="col-md-12">
            @include('admin.shared.flash')
            @include('admin.shared.error')
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr align="center">
                                <th>@lang('teams.index_table_column')</th>
                                <th>@lang('teams.name_table_column')</th>
                                <th>@lang('teams.introduction_table_column')</th>
                                <th>@lang('teams.country_table_column')</th>
                                <th>@lang('teams.created_at_table_column')</th>
                                <th>@lang('teams.delete')</th>
                                <th>@lang('teams.edit')</th>        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $key => $team)
                                <tr class="odd gradeX">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->introduction }}</td>
                                    <td>{{ $team->country->name }}</td>
                                    <td>{{ $team->created_at->format('d-m-Y') }}</td>
                                    <td class="center">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.teams.destroy', $team->id] ]) !!}
                                            {!! Form::submit( Lang::get('teams.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="center">
                                        <a href="{{ route('admin.teams.edit', $team->id) }}">
                                            <i class="fa fa-pencil fa-fw"></i>@lang('teams.edit')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {!! $teams->links() !!}
        </div>
    </div>
@stop
