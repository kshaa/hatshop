@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @php
                    $user = Auth::user();
                @endphp
                <div class="card-header">
                        {{ $user->name }} {{ $user->surname }}
                </div>

                <div class="card-body">
                    <div class="text-right mb-3">
                        <a href="{{ route('user_edit', [ 'id' => $user->id ]) }}" class="btn btn-primary col-md-3 mb-1">Edit user</a>
                    </div>

                    @include('user.partials.user_info', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
