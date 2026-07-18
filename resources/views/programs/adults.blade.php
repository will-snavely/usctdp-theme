{{--
  Adults Programming Overview
  Route: /programming/adults/

  Variables injected by App\View\Composers\AudienceComposer:
    $mailers         array   [{label, url}, ...]
    $seasons         array   [{value, label, session}, ...]
    $audienceBaseUrl string  '/programming/adults/'
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
    <span class="text-slate-600 font-medium">Adults</span>
    <a href="{{ home_url('/programming/juniors/') }}"
       class="ml-auto hover:text-[#0092be] transition-colors no-underline">
      Switch to Juniors &rarr;
    </a>
  </nav>

  {{-- ── Intro ── --}}
  <section class="animate__animated animate__fadeIn">
    <h2 class="section-heading orange text-2xl font-bold text-slate-800 mb-4">
      Adult Programs
    </h2>
    <p class="text-slate-600 leading-relaxed max-w-2xl">
      [Placeholder] Whether you're a seasoned competitor or picking up a racket for the first time,
      our adult programs offer something for everyone. Train with experienced pros in a welcoming,
      community-driven environment.
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
        'body'   => '[Placeholder] Adult clinics are organized group lessons structured by skill level,
                    running throughout the spring and summer seasons. Sessions focus on technique,
                    consistency, tactical awareness, and competitive match play. Clinics are offered
                    at Beginner, Intermediate, and Advanced levels.',
      ],
      [
        'slug'   => 'cardio',
        'title'  => 'Cardio Tennis',
        'tag'    => 'Fitness · All Levels',
        'accent' => 'border-red-500',
        'cta'    => 'View Cardio Tennis Schedule',
        'body'   => '[Placeholder] Cardio Tennis is a high-energy group fitness program set to music,
                    combining the best parts of tennis with a cardiovascular workout. No experience is
                    necessary — it\'s fun, social, and a great full-body workout for players of all
                    ages and fitness levels.',
      ],
      [
        'slug'   => 'tournament',
        'title'  => 'Tournaments',
        'tag'    => 'Competitive · All Levels',
        'accent' => 'border-[#dfff4f]',
        'cta'    => 'View Tournament Schedule',
        'body'   => '[Placeholder] Our adult tournament schedule includes round-robins, ladder
                    competitions, and USTA-sanctioned events throughout the season. Events are
                    organized by skill level to ensure competitive, fair, and enjoyable matches for
                    all participants.',
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
