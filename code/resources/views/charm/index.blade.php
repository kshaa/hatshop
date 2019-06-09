@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Charms
                </div>
                <div class="card-body">
                    <div class="text-right mb-3">
                        @if (app('request')->input('user') == 'others')
                            <a href="{{ route('charm_index', [ 'user' => 'others' ]) }}" class="btn btn-secondary col-md-3 mb-1 active">Others' charms</a>
                        @else
                            <a href="{{ route('charm_index', [ 'user' => 'others' ]) }}" class="btn btn-secondary col-md-3 mb-1">Others' charms</a>
                        @endif

                        @if (app('request')->input('user') == 'self')
                            <a href="{{ route('charm_index', [ 'user' => 'self' ]) }}" class="btn btn-secondary col-md-3 mb-1 active">Your charms</a>
                        @else
                            <a href="{{ route('charm_index', [ 'user' => 'self' ]) }}" class="btn btn-secondary col-md-3 mb-1">Your charms</a>
                        @endif

                        <a href="{{ route('charm_new') }}" class="btn btn-primary col-md-3 mb-1">New charm</a>
                    </div>
                    @if (count($charms) > 0)
                        <div class="row">
                            @foreach ($charms as $charm)
                                <div class="col-sm-4 mb-4 {{ $charm->active ? '' : 'inactive-model' }}">
                                    @include('charm.partials.card', ['charm' => $charm])
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>You don't own any charms :(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
