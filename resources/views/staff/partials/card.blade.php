{{--
Partial: staff/partials/card.blade.php
Usage: @include('staff.partials.card', ['member' => $member])

$member is the hydrated object from StaffRepository::hydrate().
--}}

@php
    /** @var object $member */
    $profileUrl = route('staff.single', ['slug' => $member->slug]);
@endphp

<article class="staff-card" aria-label="{{ $member->full_name }}">
    <a href="{{ $profileUrl }}" class="staff-card__link" tabindex="-1" aria-hidden="true">
        <div class="staff-card__image-wrap">
            @if ($member->image_url)
                <img src="{{ $member->image_url }}" alt="Portrait of {{ $member->full_name }}" class="staff-card__image"
                    loading="lazy" decoding="async" width="400" height="400" />
            @else
                <div class="staff-card__image staff-card__image--placeholder" aria-hidden="true">
                    <span class="staff-card__initials">
                        {{ mb_strtoupper(mb_substr($member->first_name, 0, 1)) }}{{ mb_strtoupper(mb_substr($member->last_name, 0, 1)) }}
                    </span>
                </div>
            @endif
        </div>
    </a>

    <div class="staff-card__body">
        <h3 class="staff-card__name">
            <a href="{{ $profileUrl }}">{{ $member->full_name }}</a>
        </h3>

        @if (!empty($member->roles))
            <ul class="staff-card__roles" aria-label="Roles">
                @foreach ($member->roles as $role)
                    <li class="staff-card__role">{{ $role }}</li>
                @endforeach
            </ul>
        @endif

        @if ($member->quote)
            <p class="staff-card__quote">{{ $member->quote }}</p>
        @endif
    </div>
</article>