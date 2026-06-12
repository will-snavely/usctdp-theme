{{--
Template Name: Staff Single
Description: Staff member detail page.

Variables injected by App\View\Composers\StaffSingleComposer:
$member array View-ready staff member data
--}}

@extends('layouts.app')

@section('content')
    @if (!$member)
        <div class="text-center py-24 px-6">
            <p>Staff member not found.</p>
            <a href="{{ get_permalink(get_page_by_path('staff')) }}">← Back to the team</a>
        </div>
    @else
        <article class="max-w-[860px] mx-auto py-12 px-6" itemscope itemtype="https://schema.org/Person">

            {{-- ── Hero / Header ─────────────────────────────────────────────── --}}
            <header class="flex gap-10 items-start mb-10 flex-wrap max-[600px]:flex-col max-[600px]:items-center max-[600px]:text-center animate__animated animate__fadeIn">
                <div class="shrink-0 w-[200px] h-[200px] rounded-full overflow-hidden">
                    @if ($member->image_url)
                        <img src="{{ $member->image_url }}" alt="Portrait of {{ $member->full_name }}"
                            class="w-full h-full object-cover block"
                            itemprop="image" width="480" height="480" decoding="async" />
                    @else
                        <div class="flex items-center justify-center bg-blue-50 w-full h-full" aria-hidden="true">
                            <span class="text-5xl font-bold text-blue-600 select-none">
                                {{ mb_strtoupper(mb_substr($member->first_name, 0, 1)) }}{{ mb_strtoupper(mb_substr($member->last_name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>

                <div class="flex-1 min-w-[200px] flex flex-col gap-2 pt-2">
                    <h1 class="text-[clamp(1.5rem,4vw,2.25rem)] font-bold text-[#1a1a2e] m-0" itemprop="name">
                        {{ $member->full_name }}
                    </h1>

                    {{-- Roles ──────────────────────────────────────────────── --}}
                    @if (!empty($member->roles))
                        <ul class="list-none m-0 mt-2 p-0 flex flex-wrap gap-1.5 max-[600px]:justify-center" aria-label="Roles">
                            @foreach ($member->roles as $role)
                                <li class="text-xs font-medium py-[0.25em] px-3 rounded-full bg-blue-50 text-blue-600">{{ $role }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- ── Pull Quote ──────────────────────────────────────── --}}
                    @if ($member->quote)
                        <aside class="mb-10" aria-label="Quote from {{ $member->full_name }}">
                            <blockquote class="m-0 py-6 px-7 border-l-4 border-[#e65627] bg-gray-50 rounded-r-lg" itemprop="description">
                                <p class="text-lg italic leading-relaxed m-0 mb-3 text-gray-700">{!! nl2br(e($member->quote)) !!}</p>
                            </blockquote>
                        </aside>
                    @endif
                </div>
            </header>

            {{-- ── Biography ───────────────────────────────────────────────── --}}
            @if ($member->biography)
                <section class="mb-10 animate__animated animate__fadeIn" style="animation-delay: 0.1s;" aria-labelledby="bio-heading-{{ $member->id }}">
                    <h2 id="bio-heading-{{ $member->id }}" class="text-xl font-bold text-[#1a1a2e] mt-0 mb-4 pb-2 border-b-2 border-gray-200">
                        About {{ $member->first_name }}
                    </h2>
                    <div class="text-base leading-7 text-gray-700 [&_p+p]:mt-4" itemprop="description">
                        {!! wpautop(e($member->biography)) !!}
                    </div>
                </section>
            @endif

            {{-- ── FAQ ─────────────────────────────────────────────────────── --}}
            @if (!empty($member->faq))
                <section class="mb-10 animate__animated animate__fadeIn" style="animation-delay: 0.2s;" aria-labelledby="faq-heading-{{ $member->id }}" itemscope
                    itemtype="https://schema.org/FAQPage">
                    <h2 id="faq-heading-{{ $member->id }}" class="text-xl font-bold text-[#1a1a2e] mt-0 mb-4 pb-2 border-b-2 border-gray-200">
                        Know Your Pro
                    </h2>

                    <dl class="m-0 p-0 flex flex-col gap-6">
                        @foreach ($member->faq as $index => $item)
                            @php
                                $question = $item['q'] ?? '';
                                $answer = $item['a'] ?? '';
                                $moreInfo = implode("\n\n", $item['more'] ?? '');
                            @endphp

                            @if ($question && $answer)
                                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                    <dt class="text-base font-semibold text-[#1a1a2e] m-0 mb-1.5" itemprop="name">
                                        {{ $question }}: {{ $answer }}
                                    </dt>
                                    <dd class="m-0 text-[0.95rem] leading-[1.7] text-gray-700" itemscope itemprop="acceptedAnswer"
                                        itemtype="https://schema.org/Answer">
                                        <span itemprop="text">
                                            {!! wpautop(e($moreInfo)) !!}
                                        </span>
                                    </dd>
                                </div>
                            @endif
                        @endforeach
                    </dl>
                </section>
            @endif

            {{-- ── Back link ────────────────────────────────────────────────── --}}
            <nav class="mt-12 pt-6 border-t border-gray-200" aria-label="Staff navigation">
                <a class="text-sm font-medium text-blue-600 no-underline hover:underline"
                    href="{{ get_permalink(get_page_by_path('our-team')) }}">
                    ← Back to the team
                </a>
            </nav>

        </article>
    @endif
@endsection
