<div class="hat card">
    <div class="card-header"><a href="{{ route('hat_show', ['id' => $hat->id]) }}">{{ $hat->label }}</a></div>
    <div>
        <div class="hat-model-widget" data-model-url="{{ url($hat->hatModelUrl()) }}"></div>
    </div>
    <div class="card-body">{{ $hat->description }}</div>
</div>