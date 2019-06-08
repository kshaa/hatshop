@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Create a trade!
                </div>
                <div class="card-body">
                    {{ Form::open([ 'route' => 'trade_create', 'id' => 'trade_create_form', 'enctype' => 'multipart/form-data' ]) }}
                        <div class="alert alert-secondary">
                            Note that trading a hat will remove all connections to its charms and vice versa.
                        </div>
                        <br>
                        <div class="form-group">
                            {{ Form::label('charm_or_hat', 'Trade charm or hat?') }}
                            <div class="form-check">
                                {{ Form::radio('charm_or_hat', 'charm', null, [ 'id' => 'charm', 'class' => 'form-check-input']) }}
                                {{ Form::label('charm', 'Charm', [ 'class' => 'form-check-label']) }}
                            </div>
                            <div class="form-check">
                                {{ Form::radio('charm_or_hat', 'hat', null, [ 'id' => 'hat', 'class' => 'form-check-input']) }}
                                {{ Form::label('hat', 'Hat', [ 'class' => 'form-check-label']) }}
                            </div>
                        </div>
                        <div class="form-group" id="charm-group">
                            {{ Form::label('label', 'Which charm?') }}
                            @foreach ($ownedCharms as $charm)
                                <div class="form-check">
                                    {{ Form::radio('charm_id', $charm->id, null, [ 'id' => 'charm_' . $charm->id ,'class' => 'form-check-input']) }}
                                    {{ Form::label('charm_' . $charm->id, $charm->label, [ 'class' => 'form-check-label']) }}
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group" id="hat-group">
                            {{ Form::label('label', 'Which hat?') }}
                            @foreach ($ownedHats as $hat)
                                <div class="form-check">
                                    {{ Form::radio('hat_id', $hat->id, null, [ 'id' => 'hat_' . $hat->id ,'class' => 'form-check-input']) }}
                                    {{ Form::label('hat_' . $hat->id, $hat->label, [ 'class' => 'form-check-label']) }}
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            {{ Form::label('yarn', 'Yarn (price)') }}
                            <div>
                                {{ Form::number('yarn', 1, ['class' => 'form-control']) }}
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
