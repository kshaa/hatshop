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
                    @if (count($hats) > 0)
                        <div class="row">
                            @foreach ($hats as $hat)
                                <div class="col-sm-4 mb-4">
                                    <div class="card">
                                        <div class="card-header"><a href="{{ route('hat_show', ['id' => $hat->id]) }}">{{ $hat->label }}</a></div>
                                        <div class="card-body">{{ $hat->description }}</div>
                                    </div>
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
