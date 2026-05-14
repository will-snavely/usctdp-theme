@props(['item', 'depth' => 0])

@php
    $hasChildren = !empty($item->children);
    // Adjust flyout direction for deep levels on desktop
    $alignment = $depth > 0 ? 'left-full top-0' : 'left-0 top-full';
@endphp

<div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative group">
    <div class="flex items-center justify-between">
        <a href="{{ $item->url }}"
            class="flex-1 whitespace-nowrap px-4 py-3 text-sm font-bold uppercase tracking-wider transition-colors
                  {{ $depth === 0 ? 'text-white hover:text-blue-300' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
            {{ $item->title }}
        </a>

        @if($hasChildren)
            <button class="pr-4 text-slate-400 {{ $depth === 0 ? 'text-white' : '' }}">
                <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform duration-300 ease-in-out"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <g transform="rotate(-90, 12, 12)">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
            </button>
        @endif
    </div>

    @if($hasChildren)
        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="absolute {{ $alignment }} min-w-[200px] bg-white shadow-xl border border-gray-100 py-2 z-[100]">
            @foreach($item->children as $child)
                {{-- RECURSION HAPPENS HERE --}}
                <x-nav-item :item="$child" :depth="$depth + 1" />
            @endforeach
        </div>
    @endif
</div>