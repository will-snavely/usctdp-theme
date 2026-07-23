{{--
Template Name: Programming
Description: Programming overview page — summarizes junior/adult programming and
links out to the detailed audience and program-type pages.

PDF mailers are managed via WordPress options (WP Admin → Tools or a custom options page):
Option key "usctdp_junior_mailers" JSON: [{"label":"Spring 2026","url":"https://..."}]
Option key "usctdp_adult_mailers" JSON: [{"label":"Spring 2026","url":"https://..."}]

Variables injected by App\View\Composers\ProgrammingComposer:
$juniorMailers array [{label, url}, ...]
$adultMailers array [{label, url}, ...]
--}}

@extends('layouts.app')

@section('content')

  @php
    $juniorTypes = [
      [
        'slug' => 'clinic',
        'title' => 'Clinics',
        'tag' => 'Ages 4.5–17 · All Levels',
        'accent' => '#3b82f6',
        'blurb' => 'Tiny Tots and Pre-Rally clinics introduce our youngest players to the game. Orange Ball and Teen clinics serve older kids. Green and Yellow Ball clinics prepare students for high-level play.',
      ],
      [
        'slug' => 'tournament',
        'title' => 'Tournaments',
        'tag' => 'Round Robins · Team Play',
        'accent' => '#3b82f6',
        'blurb' => 'Junior Singles Round Robins build match experience, and World Team Tennis adds a team format with both singles and doubles. ',
      ],
      [
        'slug' => 'camp',
        'title' => 'Camps',
        'tag' => 'Summer Only',
        'accent' => '#3b82f6',
        'blurb' => 'Diverse programming including Match Play coaching, Travel Teams, and more. Flexible daily rates and package savings are available. Summer only.',
      ],
    ];

    $adultTypes = [
      [
        'slug' => 'clinic',
        'title' => 'Clinics',
        'tag' => '18 and up· All Levels',
        'accent' => '#3b82f6',
        'blurb' => 'Level 1 through Level 4 clinics carry adult players from their first lesson to advanced, competitive match play.',
      ],
      [
        'slug' => 'cardio',
        'title' => 'Cardio Tennis',
        'tag' => 'Fitness',
        'accent' => '#3b82f6',
        'blurb' => 'A group fitness experience using tennis to drive aerobic and anaerobic benefits. This is a structured, games based, "High Intensity Tennis Training"',
      ],
      [
        'slug' => 'tournament',
        'title' => 'Tournaments',
        'tag' => 'Round Robin',
        'accent' => '#3b82f6',
        'blurb' => 'Round-robin singles events give adult players of every level a structured, competitive match-play format.',
      ],
    ];
  @endphp

  @while(have_posts()) @php the_post(); @endphp

    <div class="programming-overview space-y-10">

      {{-- ── Intro ── --}}
      <section class="animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
        <div class="flex items-baseline flex-wrap gap-4 mb-2">
          <h2 class="section-heading red text-2xl font-bold text-slate-800">
            Become Your Best
          </h2>
        </div>
        <p class="text-slate-600 leading-relaxed mb-3">
          USCTDP offers tennis programming for players of every age and level, including
          clinics, round robin tournaments, and a variety of camps
          in the summer time. Explore our offerings in more detail below.
        </p>
        <div class="flex items-center gap-3 text-sm font-semibold">
          <a href="#junior-programs" class="text-blue-500 hover:underline">
            Jump to Junior Programs
          </a>
          <span class="text-slate-300" aria-hidden="true">|</span>
          <a href="#adult-programs" class="text-blue-500 hover:underline">
            Jump to Adult Programs
          </a>
        </div>
      </section>

      {{-- ── Juniors ── --}}
      <section id="junior-programs" class="animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
        <div class="flex items-baseline flex-wrap gap-4 mb-2">
          <h2 class="section-heading orange text-2xl font-bold text-slate-800">
            Junior Programs
          </h2>
        </div>
        <p class="text-slate-600 leading-relaxed mb-4">
          For players aged 4.5–17 at every level of play. From beginner clinics to competitive
          tournaments, we have a program that fits your player's goals and schedule.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
          @foreach($juniorTypes as $type)
            @include('components.program-type-card', ['type' => $type, 'baseUrl' => '/programming/juniors/'])
          @endforeach
        </div>

        @if(!empty($juniorMailers))
          <div class="flex flex-wrap items-center gap-3 px-1">
            <span class="text-xs font-mono tracking-widest uppercase text-slate-400 shrink-0">
              Season Mailers:
            </span>
            @foreach($juniorMailers as $mailer)
              <a href="{{ $mailer['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600
                                                                        hover:text-blue-500 transition-colors no-underline">
                <svg class="w-3.5 h-3.5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path
                    d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
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
          <h2 class="section-heading green text-2xl font-bold text-slate-800">
            Adult Programs
          </h2>
        </div>
        <p class="text-slate-600 leading-relaxed mb-4">
          Whether you're a seasoned competitor or picking up a racket for the first time, our adult
          programs offer something for everyone. Train with experienced pros in a welcoming,
          community-driven environment.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
          @foreach($adultTypes as $type)
            @include('components.program-type-card', ['type' => $type, 'baseUrl' => '/programming/adults/'])
          @endforeach
        </div>

        @if(!empty($adultMailers))
          <div class="flex flex-wrap items-center gap-3 px-1">
            <span class="text-xs font-mono tracking-widest uppercase text-slate-400 shrink-0">
              Season Mailers:
            </span>
            @foreach($adultMailers as $mailer)
              <a href="{{ $mailer['url'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600
                                                                        hover:text-blue-500 transition-colors no-underline">
                <svg class="w-3.5 h-3.5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path
                    d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
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