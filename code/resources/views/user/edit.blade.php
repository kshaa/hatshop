@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                {{ Form::open([ 'route' => [ 'user_update', $user->id ] ]) }}
                    <div class="card-header">
                        <div class="form-group row">
                            {{ Form::label('name', 'Name', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('surname', 'Surname', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::text('surname', $user->surname, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->hasRole('administrator'))
                            <div class="card">
                                <div class="card-header">
                                    Roles
                                </div>
                                <div class="card-body">
                                    @foreach ($user->availableRoles() as $role)
                                        <div class="form-check">
                                            {{ Form::checkbox('roles[]', $role->id, $user->hasRole($role->code), [ 'id' => 'role_' . $role->id ,'class' => 'form-check-input']) }}
                                            {{ Form::label('role_' . $role->id, $role->label, [ 'class' => 'form-check-label']) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <br>
                        @endif

                        <div class="form-group row">
                            {{ Form::label('info', 'Info', [ 'class' => 'col-md-4 col-form-label text-md-right']) }}
                            <div class="col-md-6">
                                {{ Form::textarea('info', $user->info, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <br>

                        {{ Form::submit('Update', [ 'class' => 'btn btn-primary btn-sm' ]) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
