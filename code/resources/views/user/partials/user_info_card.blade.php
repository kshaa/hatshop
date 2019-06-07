<div class="col-md-8">
    <div class="card">
        <div class="card-header">
                {{ $user->name }} {{ $user->surname }}
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @include('user.partials.user_info', ['user' => $user])
        </div>
    </div>
</div>
