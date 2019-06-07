@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('user.partials.user_info_card', ['user' => $user])
    </div>
</div>
@endsection
