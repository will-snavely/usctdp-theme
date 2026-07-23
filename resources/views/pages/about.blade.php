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
      <div class="flex flex-col md:flex-row gap-8 items-start">
        <div class="md:w-1/2">
          <img src="{{ Vite::asset('resources/images/story.png') }}" alt="Our story"
            class="w-full h-50 object-cover rounded-2xl shadow-md"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="hidden w-full h-72 rounded-2xl bg-slate-200 items-center justify-center text-slate-400 text-sm">
            The USCTDP Team
          </div>
        </div>

        <div class="md:w-1/2 space-y-4 text-slate-700 leading-relaxed">
          <p>
            Janice Irwin began building USCTDP in 1983, founded on a love for the game
            of tennis and for teaching others. Since that time we have trained thousands
            of players and developed a multi-generational community of tennis lovers in
            Upper Saint Clair.
          </p>
          <p>
            We are dedicated to excellence, growth, and integrity in everything we do.
            As professional coaches and staff, we continuously refine our craft while
            cultivating a safe, welcoming, and team-oriented environment both on and
            off the court. By upholding high professional standards and actively
            mentoring our students, we serve as positive, motivating forces
            across the greater USC community.
          </p>
        </div>
      </div>

      <p class="mt-8 text-center text-slate-700 leading-relaxed max-w-3xl mx-auto">
        Above all, we deliver on our promises, build lasting trust, and embody
        our core brand every single day:
        <span class="block mt-2 text-base font-bold tracking-wide text-slate-800">
          BELONG. BECOME. BELIEVE.
        </span>
      </p>
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
          class="inline-block px-6 py-3 bg-blue-900 hover:bg-blue-950 text-white font-semibold rounded-xl transition-colors shadow">
          Meet the Full Team
        </a>
      </div>
    </section>


    {{-- ── Our Facilities ── --}}
    <section class="about-facilities mb-16 animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
      <h2 class="section-heading yellow text-2xl font-bold text-slate-800 mb-6">
        Our Facilities
      </h2>

      <p class="text-slate-600 leading-relaxed">
        Our facilities include <strong>10 outdoor courts</strong> and
        <strong>6 indoor courts</strong>, located at
        <a href="https://maps.app.goo.gl/JNt7ewt3kQxkeMtQ7" target="_blank" rel="noopener noreferrer"
          class="text-blue-700 hover:text-blue-900 underline">
          1750 McLaughlin Run Road, Pittsburgh, PA 15241</a>. Our office is located at
        <a href="https://maps.app.goo.gl/TBB5BNz19AJvT4zR8" target="_blank" rel="noopener noreferrer"
          class="text-blue-700 hover:text-blue-900 underline">
          37 McMurray Road Building #1, Suite LL1 Upper St. Clair, PA 15241.
        </a>
      </p>
    </section>

    {{-- ── Our Values ── --}}
    <section class="about-values mb-16 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
      <h2 class="section-heading orange text-2xl font-bold text-slate-800 mb-6">
        Our Values
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm border-t-4 border-blue-500">
          <img src="{{ Vite::asset('resources/images/belong.svg') }}" alt="Belong" class="h-10 sm:h-12 w-auto mb-3">
          <p class="text-slate-600 text-sm leading-relaxed">
            Every player who walks on our courts is part of the family.
            We foster an inclusive, supportive community where everyone belongs.
            We build multi-generational relationships: former students return as adults,
            often enrolling their own children.
          </p>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm border-t-4 border-red-500">
          <img src="{{ Vite::asset('resources/images/become.svg') }}" alt="Become" class="h-10 sm:h-12 w-auto mb-3">
          <p class="text-slate-600 text-sm leading-relaxed">
            We believe in growth, on and off the court.
            Our coaches help players develop the skills, discipline, and confidence to become their best selves.
            We pay attention to students' expressed and unexpressed goals, going above and beyond to help them achieve them.
          </p>
        </div>
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm border-t-4 border-[#dfff4f]">
          <img src="{{ Vite::asset('resources/images/believe.svg') }}" alt="Believe" class="h-10 sm:h-12 w-auto mb-3">
          <p class="text-slate-600 text-sm leading-relaxed">
            Hard work, consistency, and faith in the journey are at the heart of everything we do.
            Students of our program have excelled in tournament play, have received college scholarships,
            and have thrived as professional players. Faith makes anything possible.
          </p>
        </div>
      </div>
    </section>

    {{-- ── Registration CTA ── --}}
    <section class="about-cta animate__animated animate__fadeIn" style="animation-delay: 0.4s;">
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
          <a href="/shop"
            class="px-6 py-3 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl transition-colors shadow text-center">
            Register Now
          </a>
          <a href="/programming"
            class="px-6 py-3 border border-slate-600 hover:bg-slate-800 text-white font-semibold rounded-xl transition-colors text-center">
            View Programs
          </a>
        </div>
      </div>
    </section>

  @endwhile
@endsection