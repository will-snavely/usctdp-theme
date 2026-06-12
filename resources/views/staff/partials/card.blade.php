{{--
Partial: staff/partials/card.blade.php
Usage: @include('staff.partials.card', ['member' => $member])

$member is the hydrated object from StaffRepository::hydrate().
--}}

@php
    /** @var object $member */
    $profileUrl = route('staff.single', ['slug' => $member->slug]);
@endphp

<article class="group flex flex-col rounded-lg overflow-hidden bg-white shadow-sm transition-[box-shadow,transform] duration-200 hover:shadow-lg hover:-translate-y-0.5" aria-label="{{ $member->full_name }}">
    <a href="{{ $profileUrl }}" class="block aspect-square overflow-hidden bg-gray-100" tabindex="-1" aria-hidden="true">
        <div class="w-full h-full">
            @if ($member->image_url)
                <img src="{{ $member->image_url }}" alt="Portrait of {{ $member->full_name }}"
                    class="w-full h-full object-cover block transition-transform duration-[350ms] ease-in-out group-hover:scale-[1.04]"
                    loading="lazy" decoding="async" width="400" height="400" />
            @else
                <div class="w-full h-full flex items-center justify-center bg-blue-50" aria-hidden="true">
                    <span class="text-4xl font-bold text-blue-600 select-none">
                        {{ mb_strtoupper(mb_substr($member->first_name, 0, 1)) }}{{ mb_strtoupper(mb_substr($member->last_name, 0, 1)) }}
                    </span>
                </div>
            @endif
        </div>
    </a>

    <div class="px-5 pt-4 pb-6 flex flex-col gap-1.5 flex-1">
        <h3 class="text-[1.05rem] font-semibold m-0 text-[#1a1a2e]">
            <a href="{{ $profileUrl }}" class="text-inherit no-underline hover:underline">{{ $member->full_name }}</a>
        </h3>

        @if (!empty($member->roles))
            <ul class="list-none mt-2 mb-0 p-0 flex flex-wrap gap-1.5" aria-label="Roles">
                @foreach ($member->roles as $role)
                    <li class="text-xs font-medium py-[0.2em] px-[0.65em] rounded-full bg-blue-50 text-blue-600">{{ $role }}</li>
                @endforeach
            </ul>
        @endif

        @if ($member->quote)
            <p class="text-[0.85rem] italic text-[#333] px-2.5 py-2.5 border-l-2 border-[#E71C28] mt-2.5 mb-0 bg-[#f9f9f9] rounded-lg">{{ $member->quote }}</p>
        @endif
    </div>
</article>
