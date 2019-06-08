@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Create a hat!
                </div>
                <div class="card-body">
                    {{ Form::open([ 'route' => 'hat_create', 'enctype' => 'multipart/form-data' ]) }}
                        <div class="form-group row">
                            {{ Form::label('label', 'Label', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('label', null, ['class' => 'form-control']) }}
                                <small id="label_info" class="form-text text-muted">And make it witty! This is no serious business!</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('code', 'Code', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('code', null, ['class' => 'form-control']) }}
                                <small id="code_info" class="form-text text-muted">Must be lowercase! You can also use numbers and underscores.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('description', 'Description', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::macro('file', function($name, $value = "#000000") {
                                return '<input type="file" class="form-control-file" name="' . $name . '">';
                            }) }}
                            {{ Form::label('model_archive', 'Model archive', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::file('model_archive') }}
                                <small id="model_archive_info" class="form-text text-muted">Please upload a valid zip archive. Size of archive should not be more than 2MB.</small>
                                <small id="model_archive_info" class="form-text text-muted">Archive should contain a flat directory with a 3D model file with a 'gltf' extension.</small>
                            </div>
                        </div>
                        <br>
                        {{ Form::submit('Create', [ 'class' => 'btn btn-primary btn-sm' ]) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
