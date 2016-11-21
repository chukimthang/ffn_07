<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <title>@lang('text.admin_title')</title>
    {{ Html::script('/bower_components/jquery/dist/jquery.min.js') }}
    {{ Html::script('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::style('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{ Html::style('/bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ Html::style('/bower_components/sweetalert2/dist/sweetalert2.css') }}
    {{ Html::style('admin_asset/css/admin.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ Html::script('bower_components/ckeditor/ckeditor.js') }}
    {{ Html::script('bower_components/metisMenu/dist/metisMenu.min.js') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.css') }}
    {{ Html::style('bower_components/font-awesome/css/font-awesome.css') }}
    {{ Html::script('/bower_components/firebase/firebase.js') }}
    {{ Html::script('/bower_components/sweetalert2/dist/sweetalert2.min.js') }}
    {{ Html::style('/css/login.css') }}
    {{ Html::script('admin_asset/js/admin.js') }}
    {{ Html::script('admin_asset/js/firebase.js') }}
    
    {{ Html::script('bower_components/moment/min/moment.min.js') }}
    {{ Html::style('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}
    {{ Html::script('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js') }}
    {{ Html::script('admin_asset/js/app.js') }}
</head>
<body>
    <div id='wrapper'>
        @include('layouts.admin.header')
        @yield('content')
    </div>
    @yield('script')
</body>
</html>
