@php
    $numero = preg_replace('/^.*-(\d+)$/', '$1', $id);
@endphp

<figure class="text-center scroll-offset" id="figura{{ $id }}">
    <img src="{{ asset($src) }}" alt="{{ $alt }}" class="img-fluid w-100 mt-4">
    @if ($caption)
        <figcaption class="mt-2 text-muted">
            Figura {{ $numero }} – {{ $caption }}
        </figcaption>
    @endif
</figure>
