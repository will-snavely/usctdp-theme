{{--
Template Name: Staff Single
Description: Staff member detail page.

Variables injected by App\View\Composers\StaffSingleComposer:
$member array View-ready staff member data
--}}

@extends('layouts.app')

@section('content')
    @if (!$member)
        <div class="staff-single staff-single--not-found">
            <p>Staff member not found.</p>
            <a href="{{ get_permalink(get_page_by_path('staff')) }}">← Back to the team</a>
        </div>
    @else
        <article class="staff-single" itemscope itemtype="https://schema.org/Person">

            {{-- ── Hero / Header ─────────────────────────────────────── --}}
            <header class="staff-single__header">
                <div class="staff-single__image-wrap">
                    @if ($member->image_url)
                        <img src="{{ $member->image_url }}" alt="Portrait of {{ $member->full_name }}" class="staff-single__image"
                            itemprop="image" width="480" height="480" decoding="async" />
                    @else
                        <div class="staff-single__image staff-single__image--placeholder" aria-hidden="true">
                            <span class="staff-single__initials">
                                {{ mb_strtoupper(mb_substr($member->first_name, 0, 1)) }}{{ mb_strtoupper(mb_substr($member->last_name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>

                <div class="staff-single__meta">
                    <h1 class="staff-single__name" itemprop="name">
                        {{ $member->full_name }}
                    </h1>

                    {{-- Roles ──────────────────────────────────────────── --}}
                    @if (!empty($member->roles))
                        <ul class="staff-single__roles" aria-label="Roles">
                            @foreach ($member->roles as $role)
                                <li class="staff-single__role">{{ $role }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- ── Pull Quote ────────────────────────────────────────── --}}
                    @if ($member->quote)
                        <aside class="staff-single__quote-wrap" aria-label="Quote from {{ $member->full_name }}">
                            <blockquote class="staff-single__quote" itemprop="description">
                                <p>{!! nl2br(e($member->quote)) !!}</p>
                            </blockquote>
                        </aside>
                    @endif
                </div>
            </header>

            {{-- ── Biography ─────────────────────────────────────────── --}}
            @if ($member->biography)
                <section class="staff-single__bio" aria-labelledby="bio-heading-{{ $member->id }}">
                    <h2 id="bio-heading-{{ $member->id }}" class="staff-single__section-heading">
                        About {{ $member->first_name }}
                    </h2>
                    <div class="staff-single__bio-content" itemprop="description">
                        {!! wpautop(e($member->biography)) !!}
                    </div>
                </section>
            @endif

            {{-- ── FAQ ──────────────────────────────────────────────── --}}
            @if (!empty($member->faq))
                <section class="staff-single__faq" aria-labelledby="faq-heading-{{ $member->id }}" itemscope
                    itemtype="https://schema.org/FAQPage">
                    <h2 id="faq-heading-{{ $member->id }}" class="staff-single__section-heading">
                        Know Your Pro
                    </h2>

                    <dl class="staff-single__faq-list">
                        @foreach ($member->faq as $index => $item)
                            @php
                                $question = $item['q'] ?? '';
                                $answer = $item['a'] ?? '';
                                $moreInfo = implode("\n\n", $item['more'] ?? '');
                            @endphp

                            @if ($question && $answer)
                                <div class="staff-single__faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                    <dt class="staff-single__faq-question" itemprop="name">
                                        {{ $question }}: {{ $answer }}
                                    </dt>
                                    <dd class="staff-single__faq-answer" itemscope itemprop="acceptedAnswer"
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

            {{-- ── Back link ────────────────────────────────────────── --}}
            <nav class="staff-single__nav" aria-label="Staff navigation">
                <a class="staff-single__back-link" href="{{ get_permalink(get_page_by_path('our-team')) }}">
                    ← Back to the team
                </a>
            </nav>

        </article>
    @endif
@endsection