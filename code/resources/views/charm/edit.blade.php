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
                        @if (Auth::user()->hasRole('administrator') || Auth::user()->hasRole('trade_manager'))
                            <div class="form-check">
                                {{ Form::checkbox('active', true, $charm->active, ['id' => 'active', 'class' => 'form-check-input']) }}
                                {{ Form::label('active', 'Is active', [ 'class' => 'form-check-label']) }}
                            </div>
                            <br>
                        @else
                            @if (!$charm->active)
                                <div class="alert alert-secondary">
                                    This charm is inactive, it can be activated by a trade manager.
                                </div>
                            @endif
                        @endif

                        <div class="card">
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
                        <br>

                        @if (count($charm->owner->ownedHats) > 0) 
                            <div class="card">
                                <div class="card-header">
                                    Connected hats
                                </div>
                                <div class="card-body">
                                    <div class="form-group" id="hat-group">
                                        @foreach ($charm->owner->ownedHats as $hat)
                                            <div class="form-check">
                                                {{ Form::checkbox('hats[]', $hat->id, $charm->hasHat($hat->code), [ 'id' => 'hat_' . $hat->id ,'class' => 'form-check-input']) }}
                                                {{ Form::label('hat_' . $hat->id, $hat->label, [ 'class' => 'form-check-label']) }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif

                        {{ Form::submit('Update', [ 'class' => 'btn btn-primary btn-sm' ]) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
