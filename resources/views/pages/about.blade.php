{{--
Template Name: About
Description: About page with Our Story, Our Team, and Our Values sections.
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post(); @endphp

{{-- ── Our Story ── --}}
<section class="about-story mb-16 animate__animated animate__fadeIn">
  <h2 class="section-heading red text-2xl font-bold text-slate-800 mb-6">
    Our Story
  </h2>

  <div class="flex flex-col md:flex-row gap-8 items-center">
    <div class="md:w-1/2">
      <img src="{{ Vite::asset('resources/images/story.png') }}" alt="Our story"
        class="w-full h-50 object-cover rounded-2xl shadow-md"
        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
      <div class="hidden w-full h-72 rounded-2xl bg-slate-200 items-center justify-center text-slate-400 text-sm">
        Story image placeholder
      </div>
    </div>

    <div class="md:w-1/2 space-y-4 text-slate-700 leading-relaxed">
      <p>
        Founded in 1983, our club was built on a singular vision: to establish a premier 
        tennis development program rooted in character, athletic excellence, and personal 
        growth. What began as a dedicated mission to cultivate self-esteem, confidence, and 
        sportsmanship has evolved into a thriving community for players of all levels.

        We believe that tennis is a vehicle for lifelong development. Whether our players are 
        stepping onto the court for the first time, playing for recreation and wellness, or 
        training to compete at the professional level, we provide the structured environment 
        and expert elite coaching necessary to reach those milestones. By consistently modeling 
        professional excellence, integrity, and a steadfast work ethic, we inspire every athlete 
        who walks through our doors to achieve their personal best—both on and off the court.
      </p>
    </div>
  </div>
</section>

{{-- ── Our Team ── --}}
<section class="about-team mb-16 animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
  <h2 class="section-heading green text-2xl font-bold text-slate-800 mb-6">
    Our Team
  </h2>

  <p class="text-slate-600 mb-8 leading-relaxed">
    Our coaches bring decades of combined playing and teaching experience.
    Each one shares a passion for the game and a dedication to helping players reach
    their full potential.
  </p>

  <div class="text-center">
    <a href="{{ get_permalink(get_page_by_path('our-team')) ?: '/our-team' }}"
      class="inline-block px-6 py-3 bg-[#0092be] hover:bg-[#007aa0] text-white font-semibold rounded-xl transition-colors shadow">
      Meet the Full Team
    </a>
  </div>
</section>

{{-- ── Our Values ── --}}
<section class="about-values mb-16 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
  <h2 class="section-heading yellow text-2xl font-bold text-slate-800 mb-6">
    Our Values
  </h2>

  <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm border-t-4 border-[#0092be]">
      <h3 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-3">
        Belong
      </h3>
      <p class="text-slate-600 text-sm leading-relaxed">
        Every player who walks on our courts is part of the family. 
        We foster an inclusive, supportive community where everyone belongs. 
        We build multi-generational relationships: former students return as adults, 
        often enrolling their children.
      </p>
    </div>
    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm border-t-4 border-red-500">
      <h3 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-3">
        Become
      </h3>
      <p class="text-slate-600 text-sm leading-relaxed">
        We believe in growth — on and off the court. 
        Our coaches help players develop the skills, discipline, and confidence to become their best selves.
        We pay attention to students' expressed and unexpressed goals, going above and beyond to help them achieve them.
      </p>
    </div>
    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm border-t-4 border-[#dfff4f]">
      <h3 class="text-xl font-black uppercase tracking-tight text-slate-800 mb-3">
        Believe
      </h3>
      <p class="text-slate-600 text-sm leading-relaxed">
        We encourage every player to believe in themselves and in the process. 
        Hard work, consistency, and faith in the journey are at the heart of everything we do.
        We cultivate teamwork both on and off the court. Our team includes professionals, 
        administrative staff, Township officials, and, most importantly, the families we serve.
      </p>
    </div>
  </div>
</section>

{{-- ── Registration CTA ── --}}
<section class="about-cta animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
  <div
    class="rounded-2xl bg-slate-900 text-white px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
    <div>
      <h2 class="text-2xl font-black text-white uppercase tracking-tight mt-2 mb-2">Ready to Join?</h2>
      <p class="text-slate-300 text-sm leading-relaxed max-w-md">
        Browse our programs and register today. Whether you're signing up for the first time
        or returning for another season, we have a program that's right for you.
      </p>
    </div>
    <div class="flex flex-col sm:flex-row gap-3 shrink-0">
      <a href="{{ wc_get_page_permalink('shop') ?: '/register' }}"
        class="px-6 py-3 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl transition-colors shadow text-center">
        Register Now
      </a>
      <a href="{{ get_permalink(get_page_by_path('programs')) ?: '/programs' }}"
        class="px-6 py-3 border border-slate-600 hover:bg-slate-800 text-white font-semibold rounded-xl transition-colors text-center">
        View Programs
      </a>
    </div>
  </div>
</section>

@endwhile
@endsection