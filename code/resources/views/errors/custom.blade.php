@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
        </div>
    </div>
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container">
                <h1 class="masthead-heading mb-0">
                    <h2>{{ $message }}</h2>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-xl rounded-pill mt-5">{{ __('Lets go home!') }}</a>
                </h1>
            </div>
        </div>
  </header>
</div>
@endsection

