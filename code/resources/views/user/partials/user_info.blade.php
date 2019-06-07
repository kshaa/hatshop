<ul class="list-group">
    <li class="list-group-item">
        Yarn:
        @component('user.partials.yarn')
            {{ $user->yarn }}
        @endcomponent
    </li>
    <li class="list-group-item">
        Roles:
        <span class="roles">
        @foreach ($user->roles()->get() as $role)
            <span class="seperator">{{ $loop->first ? '' : '|' }}</span>
            <span class="name">{{ $role->label }}</span>
        @endforeach 
        </span>
    </li>
    <li class="list-group-item">
        Email:
        {{ $user->email }}
    </li>
    <li class="list-group-item">Info:
        {{ $user->info ? $user->info : '* Empty *' }}
    </li>
</ul>