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

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>{{ $charm->label }}</h5>
                            <p>{{ $charm->description }}</p>
                        </div>
                        <div class="card-header" style="background: {{ $charm->color }};">
                        </div>
                    </div>

                    <ul class="list-group">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
