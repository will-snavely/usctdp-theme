@props([
    'title',
    'image',
    'featured' => false, 
    'delay' => '0s',
    'buttonText' => 'Learn More',
    'buttonLink' => '#'
])

<div {{ $attributes->merge(['class' => 'group flex flex-col items-center flex-1 transition-transform duration-300']) }}>
  
  {{-- Header Section --}}
  <div class="flex flex-col items-center animate__animated animate__fadeIn" style="animation-delay: {{ $delay }};">
    <div class="relative w-full">
      <img src="{{ $image }}" alt="{{ $title }}" 
           @class([
               'w-full h-auto object-contain transition-all duration-500',
               'drop-shadow-2xl scale-110 group-hover:scale-115' => $featured,
               'drop-shadow-lg group-hover:scale-105' => !$featured,
               'group-hover:drop-shadow-[0_0_15px_rgba(223,255,79,0.5)]'
           ])>
    </div>
    
    <h2 @class([
        'font-black uppercase -mt-8 z-10 text-white tracking-tighter',
        'text-4xl md:text-6xl italic' => $featured,
        'text-4xl md:text-5xl' => !$featured
    ])>
      <span>{{ $title }}</span>
      <span class="inline-block bg-[#dfff4f] rounded-full ml-1 {{ $featured ? 'w-4 h-4' : 'w-3 h-3' }}"></span>
    </h2>
  </div>

  {{-- Content Box --}}
  <div @class([
      'w-full p-4 rounded-3xl relative overflow-hidden transition-all',
      'bg-slate-900 border-2 border-indigo-500 shadow-[0_20px_50px_rgba(0,0,0,0.5)]' => $featured,
      'bg-slate-900/80 backdrop-blur-sm border border-slate-800 shadow-xl' => !$featured
  ])>
    
    <h3 @class([
        'text-white text-center',
        'text-2xl font-black italic' => $featured,
        'text-xl font-bold' => !$featured
    ])>
      {{ $subtitle }}
    </h3>

    @if(isset($description))
      <p class="mt-4 text-sm text-slate-300 text-center leading-relaxed">
        {{ $description }}
      </p>
    @endif

    <div class="mt-8">
      <a href="{{ $buttonLink }}" 
        @class([
          'block w-full px-6 py-4 text-center transition-all rounded-xl font-bold',
          'text-lg text-white bg-indigo-600 hover:bg-indigo-500 shadow-[0_10px_20px_rgba(79,70,229,0.4)]' => $featured,
          'text-sm text-white border border-slate-700 hover:bg-slate-800' => !$featured
        ])>
        {{ $buttonText }}
      </a>
    </div>
  </div>
</div>
