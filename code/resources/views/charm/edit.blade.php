@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                {{ Form::open([ 'route' => [ 'charm_update', $charm->id ] ]) }}
                    <div class="card-header">
                        <div class="form-group row">
                            {{ Form::label('label', 'Label', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('label', $charm->label, ['class' => 'form-control']) }}
                                <small id="labelInfo" class="form-text text-muted">Gotta keep it witty! This is no serious business!</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!$charm->active)
                            <div class="alert alert-secondary">
                                This charm is inactive, it can be activated by a trade manager.
                            </div>
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group row">
                                    {{ Form::label('description', 'Description', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                                    <div class="col-md-6">
                                        {{ Form::textarea('description', $charm->description, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                {{ Form::macro('color', function($name, $value = "#000000") {
                                    return '<input type="color" name="' . $name. '" class="form-control" value="' . $value . '"/>';
                                }) }}
                                <div class="form-group row">
                                    {{ Form::label('color', 'Color', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                                    <div class="col-md-6">
                                        {{ Form::color('color', $charm->color) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::submit('Update', [ 'class' => 'btn btn-primary btn-sm' ]) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
