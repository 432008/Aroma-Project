@props([
    'rating' => 0,
    'count' => 0,
])

@php
    $fullStars = (int) round((float) $rating);
@endphp

<span class="stars" role="img" aria-label="Rated {{ number_format((float) $rating, 1) }} out of 5">

    @for($i = 1; $i <= 5; $i++)
        <i class="bi {{ $i <= $fullStars ? 'bi-star-fill' : 'bi-star' }}" aria-hidden="true"></i>
    @endfor

    @if((int) $count > 0)
        <span class="count">({{ $count }})</span>
    @endif

</span>
