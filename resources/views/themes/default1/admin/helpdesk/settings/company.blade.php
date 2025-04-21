@extends('themes.default1.admin.layout.admin')
<link href="{{asset("lb-faveo/css/faveo-css.css")}}" rel="stylesheet" type="text/css" />
@section('Settings')
class="nav-link active"
@stop

@section('settings-menu-parent')
class="nav-item menu-open"
@stop

@section('settings-menu-open')
class="nav nav-treeview menu-open"
@stop

@section('company')
class="nav-link active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{ Lang::get('lang.settings') }}</h1>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
<ol class="breadcrumb">
</ol>
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')
<!-- open a form -->
{!! Form::model($companys,['url' => 'postcompany/'.$companys->id, 'method' => 'PATCH','files'=>true]) !!}
<!-- check whether success or not -->
@if(Session::has('success'))
<div class="alert alert-success alert-dismissable">
    <i class="fas fa-check-circle"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!!Session::get('success')!!}
</div>
@endif
<!-- failure message -->
@if(Session::has('fails'))
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{!! Lang::get('lang.alert') !!}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!!Session::get('fails')!!}
</div>
@endif

@if(Session::has('errors'))
<?php //dd($errors); ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fas fa-ban"></i>
    <b>{!! Lang::get('lang.alert') !!}!</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <br/>
    @if($errors->first('company_name'))
    <li class="error-message-padding">{!! $errors->first('company_name', ':message') !!}</li>
    @endif
    @if($errors->first('website'))
    <li class="error-message-padding">{!! $errors->first('website', ':message') !!}</li>
    @endif
    @if($errors->first('phone'))
    <li class="error-message-padding">{!! $errors->first('phone', ':message') !!}</li>
    @endif
</div>
@endif
<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">{{Lang::get('lang.company_settings')}}</h3>
    </div>
    <!-- Name text form Required -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <!-- comapny name -->
                <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    {!! Form::label('company_name',Lang::get('lang.name')) !!} <span class="text-red"> *</span>
                    {!! Form::text('company_name',$companys->company_name,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <!-- website -->
                <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    {!! Form::label('website',Lang::get('lang.website')) !!}
                    {!! Form::url('website',$companys->website,['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <!-- phone -->
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    {!! Form::label('phone',Lang::get('lang.phone')) !!}
                    {!! Form::text('phone',$companys->phone,['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

         <div class="{{ $errors->has('address') ? 'has-error' : '' }}">
            {!! Form::label('address',Lang::get('lang.address')) !!}
            {!! Form::textarea('address',$companys->address,['class' => 'form-control','size' => '30x5']) !!}
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <h4 class="text-primary mb-3">
                    <i class="fas fa-images"></i> 
                    {!! Lang::get('lang.logo_and_favicon') !!}
                    <small class="text-muted">{!! Lang::get('lang.customize_system_appearance') !!}</small>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            @if($companys->panel_logo != null)
                                <img src="{{asset('uploads/company/'.$companys->panel_logo)}}" 
                                     alt="Panel Logo" 
                                     id="panel-logo-preview" 
                                     class="img-fluid mb-2" 
                                     style="max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                            @else
                                <div class="preview-placeholder">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <h5>{!! Lang::get('lang.admin_agent_panel_logo') !!}</h5>
                        <p class="text-muted small">{!! Lang::get('lang.recommended') !!}: 300x100px</p>
                        <div class="mt-3">
                            <div class="custom-file">
                                {!! Form::file('panel_logo', ['class' => 'custom-file-input', 'id' => 'panel_logo']) !!}
                                <label class="btn btn-outline-primary" for="panel_logo">
                                    <i class="fas fa-upload"></i> {!! Lang::get('lang.upload_panel_logo') !!}
                                </label>
                            </div>
                            <div class="mt-3 text-left">
                                @if($companys->panel_logo != null)
                                    <div class="mt-2">
                                        <label class="d-block">
                                            {!! Form::checkbox('use_default_panel_logo') !!}
                                            <span class="ml-2">{!! Lang::get('lang.use_default_panel_logo') !!}</span>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            @if($companys->favicon != null)
                                <img src="{{asset('uploads/company/'.$companys->favicon)}}" 
                                     alt="Favicon" 
                                     id="favicon-preview" 
                                     class="img-fluid mb-2" 
                                     style="max-width: 64px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                            @else
                                <div class="preview-placeholder" style="height: 64px;">
                                    <i class="fas fa-star fa-2x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <h5>{!! Lang::get('lang.favicon') !!}</h5>
                        <p class="text-muted small">{!! Lang::get('lang.recommended') !!}: 32x32px</p>
                        <div class="mt-3">
                            <div class="custom-file">
                                {!! Form::file('favicon', ['class' => 'custom-file-input', 'id' => 'favicon']) !!}
                                <label class="btn btn-outline-primary" for="favicon">
                                    <i class="fas fa-upload"></i> {!! Lang::get('lang.upload_favicon') !!}
                                </label>
                            </div>
                            @if($companys->favicon != null)
                                <div class="mt-2">
                                    <label class="d-block">
                                        {!! Form::checkbox('use_default_favicon') !!}
                                        <span class="ml-2">{!! Lang::get('lang.use_default_favicon') !!}</span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            @if($companys->client_logo != null)
                                <img src="{{asset('uploads/company/'.$companys->client_logo)}}" 
                                     alt="Client Panel Logo" 
                                     id="client-logo-preview" 
                                     class="img-fluid mb-2" 
                                     style="max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                            @else
                                <div class="preview-placeholder">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <h5>{!! Lang::get('lang.client_panel_logo') !!}</h5>
                        <p class="text-muted small">{!! Lang::get('lang.recommended') !!}: 300x100px</p>
                        <div class="mt-3">
                            <div class="custom-file">
                                {!! Form::file('client_logo', ['class' => 'custom-file-input', 'id' => 'client_logo']) !!}
                                <label class="btn btn-outline-primary" for="client_logo">
                                    <i class="fas fa-upload"></i> {!! Lang::get('lang.upload_client_logo') !!}
                                </label>
                            </div>
                            <div class="mt-3 text-left">
                                <div class="form-group">
                                    <label class="d-block">
                                        {!! Form::checkbox('use_client_logo', 1, $companys->use_client_logo) !!}
                                        <span class="ml-2">{!! Lang::get('lang.use_client_logo') !!}</span>
                                    </label>
                                    <small class="form-text text-muted">
                                        {!! Lang::get('lang.client_logo_info') !!}
                                    </small>
                                </div>
                                @if($companys->client_logo != null)
                                    <div class="mt-2">
                                        <label class="d-block">
                                            {!! Form::checkbox('use_default_client_logo') !!}
                                            <span class="ml-2">{!! Lang::get('lang.use_default_client_logo') !!}</span>
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .preview-placeholder {
                width: 100%;
                height: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f8f9fa;
                border: 2px dashed #dee2e6;
                border-radius: 4px;
                margin-bottom: 1rem;
            }
            .custom-file {
                text-align: center;
                margin-bottom: 1rem;
            }
            .custom-file-input {
                position: absolute;
                left: -9999px;
            }
            .card {
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                border: none;
                margin-bottom: 1.5rem;
            }
            .card:hover {
                box-shadow: 0 0 15px rgba(0,0,0,0.15);
            }
        </style>

        <script>
            // Preview de imágenes antes de subir
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var preview = $('#' + previewId);
                        if (preview.length === 0) {
                            // Si no existe el preview, crear uno nuevo
                            var container = $('#' + input.id).closest('.card-body').find('.mb-3');
                            container.html('<img src="' + e.target.result + '" id="' + previewId + '" class="img-fluid mb-2" style="max-height: 100px; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">');
                        } else {
                            preview.attr('src', e.target.result);
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(document).ready(function() {
                $('#favicon').change(function() {
                    readURL(this, 'favicon-preview');
                });

                $('#panel_logo').change(function() {
                    readURL(this, 'panel-logo-preview');
                });

                $('#client_logo').change(function() {
                    readURL(this, 'client-logo-preview');
                });
            });
        </script>
    </div>
    <div class="card-footer">
        {!! Form::submit(Lang::get('lang.submit'),['class'=>'btn btn-primary'])!!}
    </div>
    <!-- Modal -->   
    <div class="modal fade" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" id="custom-alert-body" >
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary yes" data-dismiss="modal"></button>
                    <button type="button" class="btn btn-default no"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".image, .panel-image, .favicon-image").on("click", function() {
            var type = $(this).hasClass('panel-image') ? 'panel' : ($(this).hasClass('favicon-image') ? 'favicon' : 'logo');
            $('#myModal').modal('show');
            $("#myModalLabel").html(type === 'panel' ? "{{Lang::get('lang.delete-panel')}}" : 
                                  type === 'favicon' ? "{{Lang::get('lang.delete-favicon')}}" : 
                                  "{{Lang::get('lang.delete-logo')}}");
            $(".yes").html("{{Lang::get('lang.yes')}}");
            $(".no").html("{{Lang::get('lang.cancel')}}");
            $("#custom-alert-body").html("{{Lang::get('lang.confirm')}}");
            $('.yes').data('type', type);
        });

        $('.no,.closemodal').on("click", function() {
            $('#myModal').modal('hide');
        });

        $('.yes').on('click', function() {
            var type = $(this).data('type');
            var imgId = type === 'panel' ? '#panel-logo' : (type === 'favicon' ? '#favicon-img' : '#company-logo');
            var src = $(imgId).attr('src').split('/');
            var file = src[src.length - 1];
            var path = "uploads/company/" + file;

            $.ajax({
                type: "GET",
                url: "{{route('delete.logo')}}",
                dataType: "html",
                data: {
                    data1: path,
                    type: type
                },
                success: function(data) {
                    if (data == "true") {
                        $(imgId).parent().remove();
                        $('#myModal').modal('hide');
                    } else {
                        $('#myModal').modal('hide');
                    }
                }
            });
        });
    });
</script>
@stop