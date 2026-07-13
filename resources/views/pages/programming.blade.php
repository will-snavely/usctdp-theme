{{--
  Template Name: Programming
  Description: Programming overview page — summarizes junior/adult programming and
  links out to the detailed audience and program-type pages.

  PDF mailers are managed via WordPress options (WP Admin → Tools or a custom options page):
    Option key "usctdp_junior_mailers"  JSON: [{"label":"Spring 2026","url":"https://..."}]
    Option key "usctdp_adult_mailers"   JSON: [{"label":"Spring 2026","url":"https://..."}]

  Variables injected by App\View\Composers\ProgrammingComposer:
    $juniorMailers  array  [{label, url}, ...]
    $adultMailers   array  [{label, url}, ...]
--}}

@extends('layouts.app')

@section('content')

@php
  $juniorTypes = [
    [
      'slug'  => 'clinic',
      'title' => 'Clinics',
      'tag'   => 'Ages 4–17 · Beginner–Advanced',
      'blurb' => 'Clinics are grouped by age and ability. Tiny Tots and Red Pre-Rally introduce our youngest players (4 and up) to the game through active, motor-skill-building games on smaller courts. Older kids and teens move through the Orange and Teen programs, building real rally skills, stroke mechanics, and match strategy on full-size courts. From there, Green Ball and our advanced Yellow Ball classes prepare juniors for competitive, tournament-level play, with Yellow Ball Open reserved for nationally and sectionally ranked players sharpening their match toughness.',
    ],
    [
      'slug'  => 'camp',
      'title' => 'Camps',
      'tag'   => 'Summer · Ages 5–18',
      'blurb' => 'Week-long summer camps with morning and afternoon sessions grouped by age and skill level.',
    ],
    [
      'slug'  => 'tournament',
      'title' => 'Tournaments',
      'tag'   => 'Round Robins · Team Play',
      'blurb' => 'Junior Singles Round Robins build match experience, and World Team Tennis adds a team format with both singles and doubles.',
    ],
  ];

  $adultTypes = [
    [
      'slug'  => 'clinic',
      'title' => 'Clinics',
      'tag'   => 'Ages 18+ · Beginner–Advanced',
      'blurb' => 'Level 1 through Level 4 clinics carry adult players from their first lesson to advanced, competitive match play. Small groups are organized by skill level, so you\'re always training alongside players at your pace as you build technique, consistency, and tactical awareness.',
    ],
    [
      'slug'  => 'cardio',
      'title' => 'Cardio Tennis',
      'tag'   => 'Fitness · All Levels',
      'blurb' => 'A high-energy, music-driven group fitness class that uses game-based tennis drills for a full-body cardio workout — no experience necessary.',
    ],
    [
      'slug'  => 'tournament',
      'title' => 'Tournaments',
      'tag'   => 'Round Robin · All Levels',
      'blurb' => 'Round-robin singles events give adult players of every level a structured, competitive match-play format.',
    ],
  ];
@endphp

@while(have_posts()) @php the_post(); @endphp

<div class="programming-overview space-y-10">

  {{-- ── Intro ── --}}
  <section class="animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
    <h1 class="text-3xl font-black uppercase tracking-tight text-slate-800 mb-2">Programming</h1>
    <p class="text-slate-600 leading-relaxed max-w-2xl mb-3">
      USC TDP offers tennis programming for players of every age and level, from junior clinics
      and camps to adult leagues and cardio tennis. Explore what's available below, or jump
      straight to a full program page for schedules and registration.
    </p>
    <div class="flex items-center gap-3 text-sm font-semibold">
      <a href="#junior-programs" class="text-[#0092be] hover:underline">
        Jump to Junior Programs <span aria-hidden="true">&darr;</span>
      </a>
      <span class="text-slate-300" aria-hidden="true">|</span>
      <a href="#adult-programs" class="text-[#0092be] hover:underline">
        Jump to Adult Programs <span aria-hidden="true">&darr;</span>
      </a>
    </div>
  </section>

  {{-- ── Juniors ── --}}
  <section id="junior-programs" class="animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
    <div class="flex items-baseline flex-wrap gap-4 mb-2">
      <h2 class="section-heading red text-2xl font-bold text-slate-800">
        Junior Programs
      </h2>
      <a href="{{ home_url('/programming/juniors/') }}"
         class="inline-flex items-center gap-2 text-sm font-semibold text-[#0092be]
                hover:gap-3 transition-all no-underline">
        View All Junior Programs <span aria-hidden="true">&rarr;</span>
      </a>
    </div>
    <p class="text-slate-600 leading-relaxed max-w-2xl mb-4">
      For players ages 5–18 at every level of play. From beginner clinics to competitive
      tournaments, we have a program that fits your player's goals and schedule.
    </p>

    <div class="divide-y divide-slate-100 mb-4">
      @foreach($juniorTypes as $type)
      <div class="py-4 first:pt-0">
        <h3 class="flex items-baseline flex-wrap gap-x-3 gap-y-1 text-base font-bold text-slate-800 mb-1">
          {{ $type['title'] }}
          <span class="text-xs font-mono font-normal tracking-widest uppercase text-slate-400">
            {{ $type['tag'] }}
          </span>
        </h3>
        <p class="text-sm text-slate-600 leading-relaxed">{{ $type['blurb'] }}</p>

        <div class="mt-3">
          <a href="{{ home_url('/programming/juniors/' . $type['slug'] . '/') }}"
             class="inline-flex items-center gap-2 bg-slate-100 hover:bg-[#0092be] text-slate-700
                    hover:text-white rounded-lg px-5 py-2.5 text-xs font-bold tracking-widest
                    uppercase transition-colors no-underline">
            Learn More <span aria-hidden="true">&rarr;</span>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    @if(!empty($juniorMailers))
    <div class="flex flex-wrap items-center gap-3 px-1">
      <span class="text-xs font-mono tracking-widest uppercase text-slate-400 shrink-0">
        Season Mailers:
      </span>
      @foreach($juniorMailers as $mailer)
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
  </section>

  {{-- ── Adults ── --}}
  <section id="adult-programs" class="animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
    <div class="flex items-baseline flex-wrap gap-4 mb-2">
      <h2 class="section-heading orange text-2xl font-bold text-slate-800">
        Adult Programs
      </h2>
      <a href="{{ home_url('/programming/adults/') }}"
         class="inline-flex items-center gap-2 text-sm font-semibold text-[#0092be]
                hover:gap-3 transition-all no-underline">
        View All Adult Programs <span aria-hidden="true">&rarr;</span>
      </a>
    </div>
    <p class="text-slate-600 leading-relaxed max-w-2xl mb-4">
      Whether you're a seasoned competitor or picking up a racket for the first time, our adult
      programs offer something for everyone. Train with experienced pros in a welcoming,
      community-driven environment.
    </p>

    <div class="divide-y divide-slate-100 mb-4">
      @foreach($adultTypes as $type)
      <div class="py-4 first:pt-0">
        <h3 class="flex items-baseline flex-wrap gap-x-3 gap-y-1 text-base font-bold text-slate-800 mb-1">
          {{ $type['title'] }}
          <span class="text-xs font-mono font-normal tracking-widest uppercase text-slate-400">
            {{ $type['tag'] }}
          </span>
        </h3>
        <p class="text-sm text-slate-600 leading-relaxed">{{ $type['blurb'] }}</p>

        <div class="mt-3">
          <a href="{{ home_url('/programming/adults/' . $type['slug'] . '/') }}"
             class="inline-flex items-center gap-2 bg-slate-100 hover:bg-[#0092be] text-slate-700
                    hover:text-white rounded-lg px-5 py-2.5 text-xs font-bold tracking-widest
                    uppercase transition-colors no-underline">
            Learn More <span aria-hidden="true">&rarr;</span>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    @if(!empty($adultMailers))
    <div class="flex flex-wrap items-center gap-3 px-1">
      <span class="text-xs font-mono tracking-widest uppercase text-slate-400 shrink-0">
        Season Mailers:
      </span>
      @foreach($adultMailers as $mailer)
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
  </section>

</div>

@endwhile
@endsection
