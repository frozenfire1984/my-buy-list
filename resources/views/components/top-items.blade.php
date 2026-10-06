@if($items->isNotEmpty())
<div {{ $attributes->class($classes) }}>
    <div class="banner-top__label">{{ $label }}</div>
    <ul class="tags-wrapper">
    @foreach($items as $item)
        <li>
            <a class="tag" href="{{ route('buy-list.show', ['id' => $item->id]) }}">
                {{ $item->name }}
                @if($item->category)
                    <span class="tag__cat">{{ $item->category->name }}</span>
                @endif
            </a>
        </li>
    @endforeach
    </ul>
</div>
@endif