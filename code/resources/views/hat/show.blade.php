@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    {{ $hat->label }}
                </div>
                <div class="card-body">
                    @if (!$hat->active)
                        <div class="alert alert-secondary">
                            This hat is inactive, it can be activated by a trade manager.
                        </div>
                    @endif

                    @if ($hat->owner_id === Auth::user()->id || Auth::user()->hasRole('administrator'))
                        <div class="text-right mb-3">
                            <a href="{{ route('hat_edit', [ 'id' => $hat->id ]) }}" class="btn btn-primary col-md-3 mb-1">Edit hat</a>
                            <a href="{{ route('hat_delete', [ 'id' => $hat->id ]) }}"
                                class="btn btn-danger col-md-3 mb-1"
                                onclick="event.preventDefault(); document.getElementById('delete-hat-form').submit();">
                                Delete hat
                            </a>
                            <form id="delete-hat-form" action="{{ route('hat_delete', [ 'id' => $hat->id ]) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div>
                            <div class="hat-model-widget" data-model-url="{{ url($hat->hatModelUrl()) }}"></div>
                        </div>
                        <div class="card-body">
                            <h5>{{ $hat->label }}</h5>
                            <p>{{ $hat->description }}</p>
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item">
                            Owner: <a href="{{ route('user_show', ['id' => $owner->id]) }}">{{ $owner->name }}</a>
                        </li>
                        <li class="list-group-item">
                            Creator: <a href="{{ route('user_show', ['id' => $creator->id]) }}">{{ $creator->name }}</a>
                        </li>
                    </ul>
                    <br>

                    @if (count($hat->charms) > 0)
                        <div class="card">
                            <div class="card-header">
                                Connected charms
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($hat->charms as $charm)
                                        <li class="list-group-item">
                                            <a href="{{ route('charm_show', ['id' => $charm->id]) }}">{{ $charm->label }}</a>
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
