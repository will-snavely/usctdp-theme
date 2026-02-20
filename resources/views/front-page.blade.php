@extends('layouts.home')

@section('content')
@while(have_posts()) @php(the_post())
<section class="relative overflow-hidden min-h-screen h-full">

  {{-- Court Background: stacked CSS bands, no SVG coordinate issues --}}
  <div class="absolute inset-0 flex flex-col" aria-hidden="true">

    {{-- Dark band: header sits transparently over this --}}
    <div class="h-32 flex-shrink-0" style="background-color: #333333;"></div>

    {{-- White court boundary line --}}
    <div class="h-8 flex-shrink-0" style="background-color: #ffffff;"></div>

    {{-- Blue court: fills all remaining space with gradient to dark navy --}}
    <div class="flex-grow" style="background: linear-gradient(to bottom, #0092be 0%, #005fbe 40%, #1e3a8a 80%, #0f172a 100%);"></div>
  </div>

  {{-- Court line markings layered on top --}}
  <div class="absolute top-32 bottom-0 left-0 right-0 z-0 z-[1] pointer-events-none" aria-hidden="true">
    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 100 100">
      {{-- Angled line starting from the white border (y≈14.5%), sweeping down-right --}}
      <line
        x1="75" y1="0"
        x2="110" y2="40"
        stroke="white"
        stroke-width="30" vector-effect="non-scaling-stroke"
        opacity="1" />
    </svg>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-6 pt-20 pb-24 md:pt-32 md:pb-40">
    <div class="text-center">
      <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
      </div>
    </div>
  </div>
</section>
@endwhile
@endsection