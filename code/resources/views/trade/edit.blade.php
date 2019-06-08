@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                {{ Form::open([ 'route' => [ 'trade_update', $trade->id ] ]) }}
                    <div class="card-body">
                        @if ($trade->product_type == App\Charm::class)
                            @include('charm.partials.card', ['charm' => $trade->product])
                        @elseif ($trade->product_type == App\Hat::class)
                            @include('hat.partials.card', ['hat' => $trade->product])
                        @endif
                        <br>
                        <div class="form-group">
                            {{ Form::label('yarn', 'Yarn (price)') }}
                            <div>
                                {{ Form::number('yarn', $trade->yarn, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <br>
                        {{ Form::submit('Update', [ 'class' => 'btn btn-primary btn-sm' ]) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
