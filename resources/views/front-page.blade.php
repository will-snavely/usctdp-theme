@extends('layouts.app')

@section('content')
@while(have_posts()) @php(the_post())
<section class="relative overflow-hidden min-h-screen h-full">
  <div class="relative z-10 max-w-7xl mx-auto px-6 pt-20 pb-24 md:pt-32 md:pb-40">
    <div class="text-center">
      <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
      </div>
    </div>
  </div>
</section>
@endwhile
@endsection