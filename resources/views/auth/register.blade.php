@extends('themes.default1.client.layout.logclient')
@php
use Illuminate\Support\Str;
$randomPassword = Str::random(8);
@endphp

@section('home')
    class = "nav-item active"
@stop

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right ">
        <li class="breadcrumb-item"> <i class="fas fa-home"> </i> {!! Lang::get('lang.you_are_here') !!} : &nbsp;</li>
        <li><a href="{!! URL::route('post.register') !!}">{!! Lang::get('lang.registration') !!}</a></li>
    </ol>
@stop

@section('content')
    @if(Session::has('status'))
    <div class="alert alert-success alert-dismissable">
        <i class="fas fa-check-circle"> </i> <b> {!! Lang::get('lang.success') !!} </b>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('status')}}
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <b>{!! Lang::get('lang.alert') !!} !</b>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif

<div id="content" class="site-content col-md-12">
    <div class="text-center mb-4">
        <h1 class="site-title" style="color: #0084b4; font-size: 28px; margin-bottom: 20px;">
            SOPORTE TECNICO UTELVT
        </h1>
    </div>

    <div class="d-flex justify-content-center mb-4">
        <div class="search-box" style="width: 80%; max-width: 600px;">
            <input type="text" class="form-control" placeholder="¿Tiene una pregunta? escriba su búsqueda aquí ..." style="border-radius: 4px;">
        </div>
        <button class="btn btn-info ml-2" style="background-color: #00b1b3; border: none;">BUSCAR</button>
    </div>

    <div id="corewidgetbox" class="wid">
        <div id="wbox" class="widgetrow text-center">
        @if(Auth::user())
        @else
            <span onclick="javascript: window.location.href='{{url('auth/login')}}';">
                <a href="{{url('auth/login')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/register.png') }})">
                    <span class="widgetitemtitle" style="color: rgb(0, 154, 186)">{!! Lang::get('lang.login') !!}</span>
                </a>
            </span>
        @endif
        <?php
        $company = App\Model\helpdesk\Settings\Company::where('id', '=', '1')->first();
        $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();
        ?>
        @if($system != null) 
            @if($system->status) 
                @if($system->status == 1)
                    <span onclick="javascript: window.location.href='{!! URL::route('form') !!}';">
                        <a href="{!! URL::route('form') !!}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/submitticket.png') }})">
                            <span class="widgetitemtitle" style="color: rgb(0, 154, 186)">{!! Lang::get('lang.submit_a_ticket') !!}</span>
                        </a>
                    </span>
                @endif
            @endif
        @endif
            <span onclick="javascript: window.location.href='{{url('mytickets')}}';">
                <a href="{{url('mytickets')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/news.png') }})">
                    <span class="widgetitemtitle" style="color: rgb(0, 154, 186)">{!! Lang::get('lang.my_tickets') !!}</span>
                </a>
            </span>
            <span onclick="javascript: window.location.href='{{url('/knowledgebase')}}';">
                <a href="{{url('/knowledgebase')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/knowledgebase.png') }})">
                    <span class="widgetitemtitle" style="color: rgb(0, 154, 186)">{!! Lang::get('lang.knowledge_base') !!}</span>
                </a>
            </span>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="login-box" style="width: 490px;">
            <div class="form-border">
                <div style="text-align: center;">
                    <?php
                    $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();
                    ?>
                    <div style="background-color: #00A3B5; padding: 10px;">
                        <h3 style="color: white; margin: 0;">
                            {!! $system->name !!}
                        </h3>
                    </div>
                </div>
               
                <div class="mt-4">
                    <div class="text-center">
                        <h3 class="box-title">{!! Lang::get('lang.registration') !!}</h3>
                    </div>
                </div>

                <!-- form open -->
                {!!  Form::open(['url'=>'auth/register', 'method'=>'post']) !!}

                <!-- fullname -->
                <div class="form-group has-feedback {{ $errors->has('full_name') ? 'has-error' : '' }}" style="display: -webkit-box;">
                    {!! Form::text('full_name',null,['placeholder'=>Lang::get('lang.full_name'),'class' => 'form-control']) !!}
                    <span class="fas fa-user form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                </div>

                <!-- Email -->
                @if (($email_mandatory->status == 1 || $email_mandatory->status == '1'))
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}" style="display: -webkit-box;">
                    {!! Form::text('email',null,['placeholder'=>Lang::get('lang.email'),'class' => 'form-control']) !!}
                    <span class="far fa-envelope text-muted form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                </div>
                @elseif (($settings->status == 0 || $settings->status == '0') && ($email_mandatory->status == 0 || $email_mandatory->status == '0'))
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}" style="display: -webkit-box;">
                    {!! Form::text('email',null,['placeholder'=>Lang::get('lang.email'),'class' => 'form-control']) !!}
                    <span class="far fa-envelope text-muted form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                </div>
                @else
                    {!! Form::hidden('email', null) !!}
                @endif

                @if($settings->status == '1' || $settings->status == 1)
                <div='row'>
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                        {!! Form::text('code',null,['placeholder'=>91,'class' => 'form-control']) !!}
                        </div>    
                    </div>
                    <div class="col-md-9">
                        <div class="form-group has-feedback {{ $errors->has('mobile') ? 'has-error' : '' }}" style="display: -webkit-box;">
                        {!! Form::text('mobile',null,['placeholder'=>Lang::get('lang.mobile'),'class' => 'form-control']) !!}
                        <span class="fas fa-phone form-control-feedback" style="top: 9px;left: -25px;color: #6c757d;"></span>
                        </div>
                    </div>
                </div>
                @else
                    {!! Form::hidden('mobile', null) !!}
                    {!! Form::hidden('code', null) !!}
                @endif

                <!-- Se eliminan los campos de contraseña visibles y se usan campos ocultos -->
                {!! Form::hidden('password', $randomPassword) !!}
                {!! Form::hidden('password_confirmation', $randomPassword) !!}
                
                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat" style="width: 100%; hov: #00c0ef; color: #fff">{!! Lang::get('lang.register') !!}</button>
                </div>

                <div>
                    <div class="checkbox icheck" align="center">
                        <label class="mb-0">
                            {!! Lang::get('lang.i_already_have_a_membership') !!} <a href="{{url('auth/login')}}" class="text-center">{!! Lang::get('lang.login') !!}</a>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('themes.default1.client.layout.social-login')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close()!!}  
@stop
