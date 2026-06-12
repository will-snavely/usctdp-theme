{{--
  Juniors Programming Overview
  Route: /programming/juniors/

  Variables injected by App\View\Composers\AudienceComposer:
    $mailers         array   [{label, url}, ...]
    $seasons         array   [{value, label, session}, ...]
    $audienceBaseUrl string  '/programming/juniors/'
--}}

@extends('layouts.app')

@section('content')

<div class="audience-overview space-y-12">

  {{-- ── Breadcrumb ── --}}
  <nav class="flex items-center gap-2 text-xs text-slate-400 px-1" aria-label="Breadcrumb">
    <a href="{{ home_url('/programming/') }}" class="hover:text-[#0092be] transition-colors no-underline">
      Programming
    </a>
    <span aria-hidden="true">/</span>
    <span class="text-slate-600 font-medium">Juniors</span>
    <a href="{{ home_url('/programming/adults/') }}"
       class="ml-auto hover:text-[#0092be] transition-colors no-underline">
      Switch to Adults &rarr;
    </a>
  </nav>

  {{-- ── Intro ── --}}
  <section class="animate__animated animate__fadeIn">
    <h2 class="border-l-8 border-[#0092be] pl-4 text-2xl font-bold text-slate-800 mb-4">
      Junior Programs
    </h2>
    <p class="text-slate-600 leading-relaxed max-w-2xl">
      [Placeholder] Our junior programs are designed for players ages 5–18 at every level of play.
      From beginner clinics to competitive tournaments, we have a program that fits your player's
      goals and schedule.
    </p>
  </section>

  {{-- ── Season Mailers ── --}}
  @if(!empty($mailers))
  <div class="flex flex-wrap items-center gap-3 px-1">
    <span class="text-xs font-mono tracking-widest uppercase text-slate-400 shrink-0">
      Season Mailers:
    </span>
    @foreach($mailers as $mailer)
    <a href="{{ $mailer['url'] }}" target="_blank" rel="noopener"
       class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600
              hover:text-[#0092be] transition-colors no-underline">
      <svg class="w-3.5 h-3.5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
      </svg>
      {{ $mailer['label'] }}
    </a>
    @endforeach
  </div>
  @endif

  {{-- ── Program Types ── --}}
  @php
    $types = [
      [
        'slug'   => 'clinic',
        'title'  => 'Clinics',
        'tag'    => 'Year-Round · All Levels',
        'accent' => 'border-[#0092be]',
        'cta'    => 'View Clinic Schedule',
        'body'   => '[Placeholder] Our junior clinics are structured group lessons organized by skill
                    level, running throughout the spring and summer seasons. Players work on stroke
                    mechanics, footwork, match play, and competitive strategy in a fun, team-oriented
                    environment. Clinics are offered at Beginner, Intermediate, and Advanced levels.',
      ],
      [
        'slug'   => 'camp',
        'title'  => 'Camps',
        'tag'    => 'Summer · Ages 5–18',
        'accent' => 'border-red-500',
        'cta'    => 'View Camp Schedule',
        'body'   => '[Placeholder] Intensive week-long summer camps provide a high-volume training
                    experience for junior players looking to accelerate their development. Morning and
                    afternoon sessions cover technique, drills, point play, and match-play situations.
                    Camps are grouped by age and skill level.',
      ],
      [
        'slug'   => 'tournament',
        'title'  => 'Tournaments',
        'tag'    => 'Competitive · USTA Format',
        'accent' => 'border-[#dfff4f]',
        'cta'    => 'View Tournament Schedule',
        'body'   => '[Placeholder] USC TDP runs USTA-sanctioned and in-house junior tournaments
                    throughout the year. Competition is open to players at all levels and provides a
                    structured environment to develop match experience, sportsmanship, and mental
                    toughness.',
      ],
    ];
  @endphp

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate__animated animate__fadeIn"
       style="animation-delay: 0.1s;">
    @foreach($types as $type)
    <div class="flex flex-col p-6 rounded-2xl bg-white border border-slate-200 border-t-4 {{ $type['accent'] }} shadow-sm">
      <div class="mb-auto">
        <p class="text-xs font-mono tracking-widest uppercase text-slate-400 mb-2">
          {{ $type['tag'] }}
        </p>
        <h3 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-3">
          {{ $type['title'] }}
        </h3>
        <p class="text-sm text-slate-600 leading-relaxed">{{ $type['body'] }}</p>
      </div>
      <div class="mt-6">
        <a href="{{ rtrim($audienceBaseUrl, '/') . '/' . $type['slug'] . '/' }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-[#0092be]
                  hover:gap-3 transition-all no-underline">
          {{ $type['cta'] }} <span aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </div>
    @endforeach
  </div>

  {{-- ── Current Sessions ── --}}
  @if(!empty($seasons))
  <section class="border-t border-slate-200 pt-8 animate__animated animate__fadeIn"
           style="animation-delay: 0.2s;">
    <h3 class="text-xs font-mono tracking-widest uppercase text-slate-400 mb-4">Current Sessions</h3>
    <div class="flex flex-wrap gap-4">
      @foreach($seasons as $season)
      <div class="px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm">
        <p class="font-semibold text-slate-700">{{ $season['label'] }}</p>
        <p class="text-slate-500 text-xs mt-0.5">{{ $season['session'] }}</p>
      </div>
      @endforeach
    </div>
  </section>
  @endif

</div>

@endsection
