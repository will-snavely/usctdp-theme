{{--
Template Name: Successes
Description: "Where Are They Now" page celebrating high school, college, and pro
athletes who came up through the program.

$stories below is placeholder content — replace with real alumni once available.
Longer term this list is a good candidate for a custom post type / ACF repeater
(mirroring how staff.archive.blade.php is fed by StaffRepository) rather than a
hardcoded array in the template.
--}}

@extends('layouts.app')

@section('content')

  @php
    $levels = [
      'high_school' => ['label' => 'High School', 'color' => '#f97316'],
      'college' => ['label' => 'College', 'color' => '#3b82f6'],
      'pro' => ['label' => 'Pro', 'color' => '#E71C28'],
    ];

    // Placeholder alumni — swap in real profiles as they're collected.
    $stories = [
      [
        'name' => 'Gabriella Dusi',
        'level' => 'high_school',
        'headline' => '2023 WPIAL 2A Champion',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/gabriella.png'),
      ],
      [
        'name' => 'Anthony Lounder',
        'level' => 'high_school',
        'headline' => '2022 WPIAL Champion',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/anthony.png'),
      ],
      [
        'name' => 'John Rohrkaste and Jonah Camardese-Woodruff',
        'level' => 'high_school',
        'headline' => '2024 WPIAL Doubles Title',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/john_jonah.png'),
      ],
      [
        'name' => 'Marra Bruce',
        'level' => 'college',
        'headline' => 'College of Charleston, Class of 2027',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/marra.png'),
      ],
      [
        'name' => 'Sophia Cunningham',
        'level' => 'college',
        'headline' => 'St. Francis University, Class of 2028',
        'detail' => 'Division 1 Scholarship',
        'image' => Vite::asset('resources/images/successes/sophia.png'),
      ],
      [
        'name' => 'Evie Ellenberger',
        'level' => 'college',
        'headline' => 'Allegheny College, Class of 2028',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/evie.png'),
      ],
      [
        'name' => 'Connor Bruce',
        'level' => 'college',
        'headline' => 'University of Dayton, Class of 2024',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/connor.png'),
      ],
      [
        'name' => 'Jake Patterson',
        'level' => 'college',
        'headline' => 'Denison University, Class of 2026',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/jake.png'),
      ],
      [
        'name' => 'Bethany Yauch',
        'level' => 'college',
        'headline' => 'Cleveland State, Class of 2025',
        'detail' => null,
        'image' => Vite::asset('resources/images/successes/bethany.png'),
      ],
      [
        'name' => 'Alison Riske-Amritraj',
        'level' => 'pro',
        'headline' => '3 WTA, 9 ITF Titles, Top Ranked 18th in the World',
        'detail' => 'Alison Riske-Amritraj is a professional tennis player from Pittsburgh, Pennsylvania. She has won three WTA titles and nine ITF titles, and reached a career-high singles ranking of world No. 18 in 2019. Riske-Amritraj has competed in all four Grand Slam tournaments and has represented the United States in the Fed Cup.',
        'image' => Vite::asset('resources/images/successes/alison.png'),
      ],
    ];
  @endphp

  @while(have_posts())
    @php the_post(); @endphp

    <div x-data="{ filter: 'all' }" class="successes-page">

      {{-- ── Intro ── --}}
      <section class="mb-10 animate__animated animate__fadeIn">
        <h2 class="section-heading green text-2xl font-bold text-slate-800 mb-4">
          Where Are They Now
        </h2>
        <p class="text-slate-700 leading-relaxed max-w-3xl">
          From weekend clinics to state titles, college scholarships, and professional careers,
          these are some of the players who got their start on our courts.
        </p>
      </section>

      {{-- ── Filter Bar ── --}}
      <div class="flex flex-wrap items-center gap-2 mb-8 animate__animated animate__fadeIn" style="animation-delay: 0.05s;">
        <button type="button" @click="filter = 'all'" class="filter-pill"
          :class="{ 'filter-pill--active': filter === 'all' }">
          All
        </button>
        @foreach($levels as $value => $meta)
          <button type="button" @click="filter = '{{ $value }}'" class="filter-pill"
            :class="{ 'filter-pill--active': filter === '{{ $value }}' }" style="--pill-color: {{ $meta['color'] }}">
            <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0" style="background: {{ $meta['color'] }}"
              aria-hidden="true"></span>
            {{ $meta['label'] }}
          </button>
        @endforeach
      </div>

      {{-- ── Alumni Grid ── --}}
      @if(empty($stories))
        <p class="text-slate-500 italic">No success stories yet — check back soon.</p>
      @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 animate__animated animate__fadeIn"
          style="animation-delay: 0.1s;">
          @foreach($stories as $story)
            @php
              $levelMeta = $levels[$story['level']] ?? null;
              $initials = collect(explode(' ', preg_replace('/[\[\]]/', '', $story['name'])))
                ->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                ->take(2)
                ->implode('');
              $hasLongDetail = $story['detail'] && mb_strlen($story['detail']) > 100;
            @endphp
            <article x-data="{ expanded: false }" x-show="filter === 'all' || filter === '{{ $story['level'] }}'" x-transition
              class="group flex flex-col rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm transition-[box-shadow,transform] duration-200 hover:shadow-lg hover:-translate-y-0.5"
              aria-label="{{ $story['name'] }}">
              <div class="aspect-square overflow-hidden bg-slate-100">
                @if($story['image'])
                  <img src="{{ $story['image'] }}" alt="Photo of {{ $story['name'] }}"
                    class="w-full h-full object-cover block transition-transform duration-[350ms] ease-in-out group-hover:scale-[1.04]"
                    loading="lazy" decoding="async">
                @else
                  <div class="w-full h-full flex items-center justify-center bg-blue-50" aria-hidden="true">
                    <span class="text-4xl font-bold text-blue-600 select-none">{{ $initials }}</span>
                  </div>
                @endif
              </div>

              <div class="px-5 pt-4 pb-5 flex flex-col gap-2 flex-1">
                @if($levelMeta)
                  <span
                    class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-full text-[11px] font-semibold border"
                    style="background-color: {{ $levelMeta['color'] }}1a; color: {{ $levelMeta['color'] }}; border-color: {{ $levelMeta['color'] }}40;">
                    <span class="inline-block w-1.5 h-1.5 rounded-full shrink-0" style="background: {{ $levelMeta['color'] }};"
                      aria-hidden="true"></span>
                    {{ $levelMeta['label'] }}
                  </span>
                @endif

                <h3 class="text-lg font-bold text-slate-800 m-0">{{ $story['name'] }}</h3>
                <p class="text-sm font-semibold text-slate-700 m-0">{{ $story['headline'] }}</p>
                @if($story['detail'])
                  <p class="text-sm text-slate-500 m-0" :class="{ 'line-clamp-3': !expanded }">{{ $story['detail'] }}</p>
                  @if($hasLongDetail)
                    <button type="button" @click="expanded = !expanded"
                      class="text-xs font-semibold text-blue-600 hover:text-blue-800 self-start mt-0.5"
                      x-text="expanded ? 'Read less' : 'Read more'"></button>
                  @endif
                @endif
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>

  @endwhile
@endsection