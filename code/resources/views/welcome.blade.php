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
                <h1 class="masthead-heading mb-0">This is a site designed for hat trading.</h1>
                <a href="{{ route('register') }}" class="btn btn-primary btn-xl rounded-pill mt-5">{{ __('Join us!') }}</a>
            </div>
        </div>
  </header>
</div>
@endsection
