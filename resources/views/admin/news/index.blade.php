@extends('layouts.admin.app')

@section('content')
    <div id='page-wrapper'>
        <div class='container-fluid'>
            <h1 class='page-header'>@lang('news.news_list_header')</h1>
            <a class='btn btn-primary' href="{{ route('admin.news.create') }}" role='button'>
                @lang('news.add_news')
            </a>
        </div>

        <div class='space20'></div>
        <div class='col-md-12'>
            @include('admin.shared.flash')
            @include('admin.shared.error')
            
            <div class='panel panel-default'>
                <div class='panel-body'>
                    <table class='table table-hover'>
                        <thead>
                            <tr align='center'>
                                <th>@lang('news.index_table_column')</th>
                                <th>@lang('news.title_table_column')</th>	
                                <th>@lang('news.created_at_table_column')</th>
                                <th>@lang('news.cate_table_column')</th>
                                <th>@lang('news.country_table_column')</th>
                                <th>@lang('news.delete')</th>
                                <th>@lang('news.edit')</th>        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $key => $n)
                                <tr class='odd gradeX'>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $n->title }}</td>
                                    <td>{{ $n->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $n->category->name }}</td>
                                    <td>{{ $n->country->name }}</td>
                                    <td class='center'>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.news.destroy', $n->id] ]) !!}
                                            {!! Form::submit( Lang::get('news.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td class='center'>
                                        <a href='{{ route('admin.news.edit', $n->id) }}'>
                                            <i class='fa fa-pencil fa-fw'></i>@lang('news.edit')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $news->links() }}
        </div>
    </div>
@stop
