@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Trade
                </div>
                <div class="card-body">
                    @if (!$trade->buyer_id)
                        <div class="text-right mb-3">
                            @if ($trade->seller_id === Auth::user()->id)
                                <a href="{{ route('trade_edit', [ 'id' => $trade->id ]) }}" class="btn btn-primary col-md-3 mb-1">Edit trade</a>
                                <a href="{{ route('trade_delete', [ 'id' => $trade->id ]) }}"
                                    class="btn btn-danger col-md-3 mb-1"
                                    onclick="event.preventDefault(); document.getElementById('delete-trade-form').submit();">
                                    Delete trade
                                </a>
                                <form id="delete-trade-form" action="{{ route('trade_delete', [ 'id' => $trade->id ]) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('trade_complete', [ 'id' => $trade->id ]) }}"
                                    class="btn btn-danger col-md-3 mb-1"
                                    onclick="event.preventDefault(); document.getElementById('complete-trade-form').submit();">
                                    Buy!
                                </a>
                                <form id="complete-trade-form" action="{{ route('trade_complete', [ 'id' => $trade->id ]) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endif
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($trade->product_type == App\Charm::class)
                                @include('charm.partials.card', ['charm' => $trade->product])
                            @elseif ($trade->product_type == App\Hat::class)
                                @include('hat.partials.card', ['hat' => $trade->product])
                            @endif
                        </div>
                        <div class="card-header">
                            Yarn:
                            @component('user.partials.yarn')
                                {{ $trade->yarn }}
                            @endcomponent
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            Seller: <a href="{{ route('user_show', ['id' => $trade->seller_id]) }}">{{ $trade->seller->name }}</a>
                        </li>
                        @if ($trade->buyer_id)
                            <li class="list-group-item">
                                Buyer: <a href="{{ route('user_show', ['id' => $trade->buyer_id]) }}">{{ $trade->buyer->name }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
