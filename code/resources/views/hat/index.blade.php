@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Your hats
                </div>
                <div class="card-body">
                    <div class="text-right mb-3">
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
