@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Trades
                </div>
                <div class="card-body">
                    <div class="text-right mb-3">
                        @if (app('request')->input('user') == 'others')
                            <a href="{{ route('trade_index', [ 'user' => 'others' ]) }}" class="btn btn-secondary col-md-3 mb-1 active">Open trades</a>
                        @else
                            <a href="{{ route('trade_index', [ 'user' => 'others' ]) }}" class="btn btn-secondary col-md-3 mb-1">Open trades</a>
                        @endif

                        @if (app('request')->input('user') == 'self')
                            <a href="{{ route('trade_index', [ 'user' => 'self' ]) }}" class="btn btn-secondary col-md-3 mb-1 active">Your trades</a>
                        @else
                            <a href="{{ route('trade_index', [ 'user' => 'self' ]) }}" class="btn btn-secondary col-md-3 mb-1">Your trades</a>
                        @endif

                        <a href="{{ route('trade_new') }}" class="btn btn-primary col-md-3 mb-1">New trade</a>
                    </div>
                    @if (count($trades) > 0)
                        <div class="row">
                            @foreach ($trades as $trade)
                                <div class="col-sm-6 mb-4">
                                    <div class="trade card">
                                        @php
                                            $product = $trade->product
                                        @endphp
                                        <div class="card-body">
                                            @if ($trade->product_type == App\Charm::class)
                                                @include('charm.partials.card', ['charm' => $trade->product])
                                            @elseif ($trade->product_type == App\Hat::class)
                                                @include('hat.partials.card', ['hat' => $trade->product])
                                            @endif
                                        </div>
                                        <div class="card-header">
                                            <a href="{{ route('trade_show', ['id' => $trade->id]) }}">
                                                Yarn:
                                                @component('user.partials.yarn')
                                                    {{ $trade->yarn }}
                                                @endcomponent
                                            </a>
                                        </div>
                                        
                                        @if ($buyer = $trade->buyer)
                                            <div class="card-header">
                                                Purchased by:
                                                <a href="{{ route('user_show', ['id' => $buyer->id]) }}">
                                                    {{ $buyer->name }} {{ $buyer->surname }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No trades here :(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
