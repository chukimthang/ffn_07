@extends('layouts.admin.app')
@extends('layouts.admin.menu')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-lg-offset-1">
                <h1 class="page-header">
                    @lang('admin.player')
                    <small>@lang('admin.edit')</small>
                </h1>
            </div>

            <div class="col-lg-8 col-lg-offset-1">
                {!! Form::model($player, ['method' => 'PUT', 'route' => ['admin.player.update', $player->id]]) !!}
                    @include('admin.shared.error')

                    <div class="form-group">
                        {!! Form::label('name', Lang::get('admin.name', ['name' => 'Player'])) !!}
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.message.holder', ['name' => 'Name'])
                        ]) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('introduction', Lang::get('admin.intro')) !!}
                        {!! Form::textarea('introduction', null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.message.holder', ['name' => 'Introduction'])
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('position', Lang::get('admin.position')) !!}
                        {!! Form::select('position', $positions, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Position'])
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('birthday', Lang::get('admin.birthday')) !!}
                        {!! Form::date('birthday', null, [
                            'class' => 'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Html::image('http://img.quantrimang.com/photos/image/072015/22/avatar.jpg', null,
                            ['class' => 'img-circle', 'id' => 'avatar-image', 
                            'width' => '200', 'height' => '180']) !!}
                        {!! Form::file('avatar-input', ['id' => 'avatar-input']) !!}
                        {!! Form::hidden('avatar', null, ['id' => 'logo']) !!}
                    </div>
                    
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" 
                            aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('team_id', Lang::get('admin.team')) !!}
                        {!! Form::select('team_id', $teams, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Team'])
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('country_id', Lang::get('admin.country')) !!}
                        {!! Form::select('country_id', $countries, null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.choose', ['name' => 'Country'])
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit(Lang::get('admin.bt_edit', ['name' => 'Player']),
                            ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}

                <script type="text/javascript">CKEDITOR.replace('introduction');</script>
                <script type="text/javascript" src="{{ asset('admin_asset/js/player.js') }}"></script>
                <script type="text/javascript">
                    var f = new firebaseCustom();
                    f.init({
                        apiKey: '{{ config('firebase.apiKey') }}',
                        authDomain: '{{ config('firebase.authDomain') }}',
                        databaseURL: '{{ config('firebase.databaseURL') }}',
                        storageBucket: '{{ config('firebase.storageBucket') }}',
                        messagingSenderId: '{{ config('firebase.messagingSenderId') }}',
                    });
                    var p = new player();
                    p.init(f);
                </script>
            </div>
        </div>
    </div>
</div>
@stop
