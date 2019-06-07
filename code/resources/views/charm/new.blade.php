@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Create a charm!
                </div>
                <div class="card-body">
                    {{ Form::open([ 'route' => 'charm_create' ]) }}
                        <div class="form-group row">
                            {{ Form::label('label', 'Label', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('label', null, ['class' => 'form-control']) }}
                                <small id="labelInfo" class="form-text text-muted">And make it witty! This is no serious business!</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('code', 'Code', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('code', null, ['class' => 'form-control']) }}
                                <small id="codeInfo" class="form-text text-muted">Must be lowercase! You can also use numbers and underscores.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('description', 'Description', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('power_label', 'Power label', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('power_label', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('power_code', 'Power code', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('power_code', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('power_intensity', 'Power intensity', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::number('power_intensity', 1, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        {{ Form::macro('color', function($name, $value = "#000000") {
                            return '<input type="color" name="' . $name. '" class="form-control" value="' . $value . '"/>';
                        }) }}
                        <div class="form-group row">
                            {{ Form::label('color', 'Color', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::color('color') }}
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
