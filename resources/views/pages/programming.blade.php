{{--
  Template Name: Programming
  Description: Programming overview page — links to junior/adult programs and season mailer downloads.

  PDF mailers are managed via WordPress options (WP Admin → Tools or a custom options page):
    Option key "usctdp_junior_mailers"  JSON: [{"label":"Spring 2026","url":"https://..."}]
    Option key "usctdp_adult_mailers"   JSON: [{"label":"Spring 2026","url":"https://..."}]

  Variables injected by App\View\Composers\ProgrammingComposer:
    $juniorMailers  array  [{label, url}, ...]
    $adultMailers   array  [{label, url}, ...]
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php(the_post())

<div class="programming-overview space-y-14">

  {{-- ── Audience Cards ── --}}
  <section class="animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

      {{-- Juniors --}}
      <a href="{{ home_url('/programming/juniors/') }}"
         class="group flex flex-col justify-between p-8 rounded-2xl bg-slate-900 text-white shadow-xl
                no-underline hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
        <div>
          <span class="inline-block mb-3 text-xs font-mono tracking-widest uppercase text-[#0092be]">
            Ages 5–18
          </span>
          <h3 class="text-3xl font-black uppercase tracking-tight mb-4">Juniors</h3>
          <ul class="text-slate-400 text-sm space-y-1.5 mb-8">
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-slate-500 shrink-0"></span> Clinics
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-slate-500 shrink-0"></span> Camps
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-slate-500 shrink-0"></span> Tournaments
            </li>
          </ul>
        </div>
        <span class="inline-flex items-center gap-2 text-sm font-semibold text-[#0092be]
                     group-hover:gap-3 transition-all">
          View Junior Programs <span aria-hidden="true">&rarr;</span>
        </span>
      </a>

      {{-- Adults --}}
      <a href="{{ home_url('/programming/adults/') }}"
         class="group flex flex-col justify-between p-8 rounded-2xl bg-slate-800 text-white shadow-xl
                no-underline hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
        <div>
          <span class="inline-block mb-3 text-xs font-mono tracking-widest uppercase text-[#dfff4f]">
            18 &amp; Up
          </span>
          <h3 class="text-3xl font-black uppercase tracking-tight mb-4">Adults</h3>
          <ul class="text-slate-400 text-sm space-y-1.5 mb-8">
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-slate-500 shrink-0"></span> Clinics
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-slate-500 shrink-0"></span> Cardio Tennis
            </li>
            <li class="flex items-center gap-2">
              <span class="w-1 h-1 rounded-full bg-slate-500 shrink-0"></span> Tournaments
            </li>
          </ul>
        </div>
        <span class="inline-flex items-center gap-2 text-sm font-semibold text-[#dfff4f]
                     group-hover:gap-3 transition-all">
          View Adult Programs <span aria-hidden="true">&rarr;</span>
        </span>
      </a>

    </div>
  </section>

  {{-- ── Season Mailers ── --}}
  @if(!empty($juniorMailers) || !empty($adultMailers))
  <section class="animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
    <h2 class="border-l-8 border-[#0092be] pl-4 text-2xl font-bold text-slate-800 mb-6">
      Season Mailers
    </h2>
    <p class="text-slate-500 text-sm mb-6">
      Download our seasonal program guides for full scheduling and pricing details.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

      @if(!empty($juniorMailers))
      <div>
        <h3 class="text-xs font-mono tracking-widest uppercase text-slate-400 mb-3">Junior Mailers</h3>
        <ul class="space-y-2">
          @foreach($juniorMailers as $mailer)
          <li>
            <a href="{{ $mailer['url'] }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2.5 text-sm font-medium text-slate-700
                      hover:text-[#0092be] transition-colors">
              <svg class="w-5 h-5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
              </svg>
              {{ $mailer['label'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
      @endif

      @if(!empty($adultMailers))
      <div>
        <h3 class="text-xs font-mono tracking-widest uppercase text-slate-400 mb-3">Adult Mailers</h3>
        <ul class="space-y-2">
          @foreach($adultMailers as $mailer)
          <li>
            <a href="{{ $mailer['url'] }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2.5 text-sm font-medium text-slate-700
                      hover:text-[#0092be] transition-colors">
              <svg class="w-5 h-5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
              </svg>
              {{ $mailer['label'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
      @endif

    </div>
  </section>
  @endif

</div>

@endwhile
@endsection
