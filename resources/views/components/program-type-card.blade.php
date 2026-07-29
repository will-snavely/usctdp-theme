{{--
  Component: program-type-card
  Usage: @include('components.program-type-card', ['type' => $type, 'audience' => 'juniors'])

  $type: ['slug', 'title', 'tag', 'accent', 'blurb'] — accent is a hex color, e.g. '#3b82f6'
  $audience: 'juniors' | 'adults' — links to the archive pre-filtered by age group + type
--}}

<div class="flex flex-col p-6 rounded-2xl bg-white border border-t-4 shadow-sm"
  style="border-color: {{ $type['accent'] }}4D; border-top-color: {{ $type['accent'] }};">
  <div class="mb-auto">
    <h3 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-1">
      {{ $type['title'] }}
    </h3>
    <p class="text-xs font-mono tracking-widest uppercase text-slate-400 mb-2">
      {{ $type['tag'] }}
    </p>
    <p class="text-sm text-slate-600 leading-relaxed">{{ $type['blurb'] }}</p>
  </div>
  <div class="mt-6">
    <a href="{{ home_url('/programming/schedule/') . '?' . http_build_query(['age_group' => $audience, 'type' => $type['slug']]) }}"
      class="inline-block bg-blue-900 hover:bg-blue-950 text-white rounded-lg px-5 py-2.5
             text-xs font-bold tracking-widest uppercase transition-colors !no-underline">
      Learn More &rarr;
    </a>
  </div>
</div>
