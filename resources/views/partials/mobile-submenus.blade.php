{{-- resources/views/partials/mobile-submenus.blade.php --}}
@foreach($items as $item)
    @if(!empty($item->children))
        <div x-show="activePanel === 'panel-{{ $item->ID }}'" x-cloak class="w-full bg-white px-6 py-8"
            x-transition:enter="transition opacity ease-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">

            <button @click="goBack()"
                class="flex items-center gap-2 text-blue-600 font-bold uppercase text-xs mb-6 tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Back to {{ $item->title }}
            </button>

            <ul class="flex flex-col space-y-2 list-none p-0 m-0 text-slate-800">
                @foreach($item->children as $child)
                    <li class="border-b border-gray-50 last:border-0">
                        @if(!empty($child->children))
                            <button @click="goForward('panel-{{ $child->ID }}')"
                                class="w-full flex justify-between items-center py-4 text-left font-bold uppercase text-sm">
                                {{ $child->title }}
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 5l7 7-7 7" stroke-width="2" />
                                </svg>
                            </button>
                        @else
                            <a href="{{ $child->url }}" class="block py-4 font-bold uppercase text-sm">
                                {{ $child->title }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Continue recursion for deeper levels --}}
        @include('partials.mobile-submenus', ['items' => $item->children])
    @endif
@endforeach