@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Hats
                </div>
                <div class="card-body">
                    <div class="text-right mb-3">
                        @if (app('request')->input('user') == 'others')
                            <a href="{{ route('hat_index', [ 'user' => 'others' ]) }}" class="btn btn-secondary col-md-3 mb-1 active">Others' hats</a>
                        @else
                            <a href="{{ route('hat_index', [ 'user' => 'others' ]) }}" class="btn btn-secondary col-md-3 mb-1">Others' hats</a>
                        @endif

                        @if (app('request')->input('user') == 'self')
                            <a href="{{ route('hat_index', [ 'user' => 'self' ]) }}" class="btn btn-secondary col-md-3 mb-1 active">Your hats</a>
                        @else
                            <a href="{{ route('hat_index', [ 'user' => 'self' ]) }}" class="btn btn-secondary col-md-3 mb-1">Your hats</a>
                        @endif

                        <a href="{{ route('hat_new') }}" class="btn btn-primary col-md-3 mb-1">New hat</a>
                    </div>
                    @if (count($hats) > 0)
                        <div class="row">
                            @foreach ($hats as $hat)
                                <div class="col-sm-6 mb-4 {{ $hat->active ? '' : 'inactive-model' }}">
                                    @include('hat.partials.card', ['hat' => $hat])
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>You don't own any hats :(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
