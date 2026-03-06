{{-- resources/views/components/feature-card.blade.php --}}
@props([
    'image', 
    'title', 
    'dotColor' => '#dfff4f', 
    'buttonText' => 'Learn More', 
    'buttonLink' => '#',
    'delay' => '0s'
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center flex-1 min-w-[280px] max-w-[320px]']) }}>
  {{-- Image & Title Section --}}
  <div class="flex flex-col items-center animate__animated animate__fadeIn" style="animation-delay: {{ $delay }};">
    <div class="w-full aspect-square">
      <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-auto object-contain drop-shadow-lg" loading="eager">
    </div>
    <h2 class="text-4xl md:text-5xl font-black uppercase -mt-6 z-10 text-white flex items-center gap-1">
      <span>{{ $title }}</span>
      <span class="inline-block w-3 h-3 rounded-full" style="background-color: {{ $dotColor }};"></span>
    </h2>
  </div>

  <div class="w-full p-6 bg-slate-900/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-800">
    <h3 class="text-xl font-bold text-white text-center">
      {{ $subtitle }} 
    </h3>
    <hr class="my-4 border-t border-slate-800 w-1/4 mx-auto" />
    
    @if($description ?? false)
      <p class="text-sm text-slate-400 text-center leading-relaxed mb-6">
        {{ $description }}
      </p>
    @endif

    <a href="{{ $buttonLink }}" class="block w-full px-5 py-2.5 text-sm font-semibold text-center text-white border border-slate-700 rounded-xl hover:bg-slate-800 transition-all">
      {{ $buttonText }}
    </a>
  </div>
</div>
