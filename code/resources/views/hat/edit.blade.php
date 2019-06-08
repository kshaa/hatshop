@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                {{ Form::open([ 'route' => [ 'hat_update', $hat->id ] ]) }}
                    <div class="card-header">
                        <div class="form-group row">
                            {{ Form::label('label', 'Label', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('label', $hat->label, ['class' => 'form-control']) }}
                                <small id="labelInfo" class="form-text text-muted">Gotta keep it witty! This is no serious business!</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('trade_manager'))
                            <div class="form-check">
                                {{ Form::checkbox('active', true, $hat->active, ['id' => 'active', 'class' => 'form-check-input']) }}
                                {{ Form::label('active', 'Is active', [ 'class' => 'form-check-label']) }}
                            </div>
                            <br>
                        @else
                            @if (!$hat->active)
                                <div class="alert alert-secondary">
                                    This charm is inactive, it can be activated by a trade manager.
                                </div>
                            @endif
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group row">
                                    {{ Form::label('description', 'Description', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                                    <div class="col-md-6">
                                        {{ Form::textarea('description', $hat->description, ['class' => 'form-control']) }}
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
