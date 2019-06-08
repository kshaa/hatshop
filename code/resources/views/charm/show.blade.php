@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    {{ $charm->label }}
                </div>
                <div class="card-body">
                    @if (!$charm->active)
                        <div class="alert alert-secondary">
                            This charm is inactive, it can be activated by a trade manager.
                        </div>
                    @endif

                    @if ($charm->owner_id === Auth::user()->id || Auth::user()->hasRole('administrator'))
                        <div class="text-right mb-3">
                            <a href="{{ route('charm_edit', [ 'id' => $charm->id ]) }}" class="btn btn-primary col-md-3 mb-1">Edit charm</a>
                            <a href="{{ route('charm_delete', [ 'id' => $charm->id ]) }}"
                                class="btn btn-danger col-md-3 mb-1"
                                onclick="event.preventDefault(); document.getElementById('delete-charm-form').submit();">
                                Delete charm
                            </a>
                            <form id="delete-charm-form" action="{{ route('charm_delete', [ 'id' => $charm->id ]) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>{{ $charm->label }}</h5>
                            <p>{{ $charm->description }}</p>
                        </div>
                        <div class="card-header" style="background: {{ $charm->color }};">
                        </div>
                    </div>

                    <ul class="list-group mb-4">
                        <li class="list-group-item">
                            Power: <span>{{ $charm->power_label }}</a>
                        </li>
                        <li class="list-group-item">
                            Power intensity: <span>{{ $charm->power_intensity }}</a>
                        </li>
                        <li class="list-group-item">
                            Owner: <a href="{{ route('user_show', ['id' => $owner->id]) }}">{{ $owner->name }}</a>
                        </li>
                        <li class="list-group-item">
                            Creator: <a href="{{ route('user_show', ['id' => $creator->id]) }}">{{ $creator->name }}</a>
                        </li>
                    </ul>

                    @if (count($charm->hats) > 0)
                        <div class="card">
                            <div class="card-header">
                                Connected hats
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($charm->hats as $hat)
                                        <li class="list-group-item">
                                            <a href="{{ route('hat_show', ['id' => $hat->id]) }}">{{ $hat->label }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
