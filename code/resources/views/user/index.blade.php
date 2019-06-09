@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Users
                </div>
                <div class="card-body">
                    @if (count($users) > 0)
                        <div class="container">
                            <ul class="list-group">
                                @foreach ($users as $user)
                                    <li class="list-group-item">
                                        <a href="{{ route('user_show', ['id' => $user->id]) }}">{{ $user->name }} {{ $user->surname }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>You're all alone here :(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
