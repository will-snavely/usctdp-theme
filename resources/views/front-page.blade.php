{{-- resources/views/front-page.blade.php --}}
@extends('layouts.home')

@section('content')
  @while(have_posts()) @php(the_post())
    <section class="relative bg-white overflow-hidden border-b border-slate-100">
      {{-- The Background Layer --}}
      <div class="plaid absolute inset-0 opacity-[0.65] pointer-events-none">
      </div>

      {{-- The Diagonal "Court Line" Accent --}}
      <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-slate-50 to-transparent -skew-x-12 transform translate-x-1/4"></div>

      <div class="relative z-10 max-w-7xl mx-auto px-6 pt-20 pb-24 md:pt-32 md:pb-40">
        <div class="text-center">
          @include('partials.motto')
          
          <p class="mt-8 text-sm md:text-base text-slate-800 font-bold uppercase tracking-[0.3em] animate-fade-in-up">
            USC Tennis Development Program
          </p>

          <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/programs" class="w-full sm:w-auto bg-[#5c88da] text-white font-bold px-10 py-4 rounded-xl shadow-xl shadow-blue-100 hover:bg-blue-600 transition-all transform hover:-translate-y-1">
              Join a Program
            </a>
            <a href="/about" class="w-full sm:w-auto bg-white text-slate-600 border border-slate-200 font-bold px-10 py-4 rounded-xl hover:bg-slate-50 transition-all">
              Our Mission
            </a>
          </div>
        </div>
      </div>
    </section>
  @endwhile
@endsection
