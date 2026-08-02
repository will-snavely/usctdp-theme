@extends('layouts.app')

@section('content')
  <div
    class="max-w-lg mx-auto text-center bg-blue-50 rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">
    <p class="text-slate-600 leading-relaxed mb-8">
      {{ __("Sorry, we couldn't find the page you're looking for. It may have been moved or no longer exists.", 'sage') }}
    </p>

    <a href="{{ home_url('/') }}"
      class="inline-block bg-[#5c88da] text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-blue-600 transition transform active:scale-95">
      {{ __('Back to Home', 'sage') }}
    </a>
  </div>
@endsection