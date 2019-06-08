<div class="charm card">
    <div class="card-header"><a href="{{ route('charm_show', ['id' => $charm->id]) }}">{{ $charm->label }}</a></div>
    <div class="card-body">{{ $charm->description }}</div>
    <div class="card-header" style="background: {{ $charm->color }};"></div>
</div>