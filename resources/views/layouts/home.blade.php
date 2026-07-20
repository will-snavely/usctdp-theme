<!doctype html>
<html @php(language_attributes())>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php(do_action('get_header'))
  @php(wp_head())

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body @php(body_class('antialiased text-slate-900 bg-slate-50'))>
  @php(wp_body_open())

  <div id="app" class="flex flex-col min-h-screen">
    <a class="sr-only focus:not-sr-only" href="#main">
      {{ __('Skip to content', 'sage') }}
    </a>

    @include('sections.header')

    <div class="home-page-bg min-h-screen relative flex flex-col">
      <div class="absolute top-0 left-0 w-full h-18 bg-[#f4f4f4] pattern-grid"></div>
      <div class="flex-grow relative z-10">
        <main id="main" class="main flex-grow w-full max-w-screen-xl mx-auto px-6 lg:px-12">

          {{-- ── Mobile carousel (hidden on sm+) ─────────────────────────────── --}}
          <div class="sm:hidden w-full" x-cloak x-data="{
              active: 1,
              touchStartX: 0,
              showHint: true,
              go(n) { this.showHint = false; this.active = ((n % 3) + 3) % 3; },
              swipe(endX) {
                const dx = endX - this.touchStartX;
                if (Math.abs(dx) > 50) this.go(this.active + (dx < 0 ? 1 : -1));
              }
            }" x-init="setTimeout(() => { showHint = false }, 3000)"
            @touchstart.passive="touchStartX = $event.touches[0].clientX"
            @touchend.passive="swipe($event.changedTouches[0].clientX)">

            {{-- Slide 0 — Belong --}}
            <div x-show="active === 0" x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
              class="flex flex-col items-center">
              <div class="relative w-full px-6">
                <img src="{{ Vite::asset('resources/images/home3.png') }}" alt="Belong"
                  class="w-full h-auto object-contain drop-shadow-lg">
                <h2
                  class="logo-text-main font-black uppercase -mt-8 relative z-10 text-white text-5xl tracking-tighter text-center">
                  Belong<span class="inline-block bg-[#dfff4f] rounded-full ml-1 w-3 h-3"></span>
                </h2>
              </div>
              <div
                class="w-full p-3 rounded-3xl bg-slate-900/80 backdrop-blur-sm border border-slate-800 shadow-xl mt-1">
                <h3 class="text-white text-center text-xl font-bold">Meet Our Community</h3>
                <p class="mt-3 text-sm text-slate-300 text-center leading-relaxed">
                  We are a multigenerational community of athletes. Learn more about our tennis family.
                </p>
                <div class="mt-4">
                  <a href="/about"
                    class="block w-full px-6 py-4 text-center rounded-xl font-bold text-sm text-white border border-slate-700 hover:bg-slate-800 transition-colors no-underline">
                    About Us
                  </a>
                </div>
              </div>
            </div>

            {{-- Slide 1 — Become (featured) --}}
            <div x-show="active === 1" x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
              class="flex flex-col items-center">
              <div class="relative w-full px-6">
                <img src="{{ Vite::asset('resources/images/home2.png') }}" alt="Become"
                  class="w-full h-auto object-contain drop-shadow-2xl scale-110">
                <h2
                  class="logo-text-main font-black uppercase -mt-8 relative z-10 text-white text-5xl italic tracking-tighter text-center">
                  Become<span class="inline-block bg-[#dfff4f] rounded-full ml-1 w-4 h-4"></span>
                </h2>
              </div>
              <div
                class="w-full p-3 rounded-3xl bg-slate-900 border-2 border-red-500 shadow-[0_20px_50px_rgba(0,0,0,0.5)] mt-1">
                <h3 class="text-white text-center text-2xl font-black italic">Level Up Your Game</h3>
                <p class="mt-3 text-sm text-slate-300 text-center leading-relaxed">
                  Instruction for all levels and ages. Build your skills and confidence with our expert-led clinics.
                </p>
                <div class="mt-4">
                  <a href="/shop"
                    class="block w-full px-6 py-4 text-center rounded-xl font-bold text-lg text-white bg-red-700 hover:bg-red-600 transition-colors no-underline">
                    Book a Clinic
                  </a>
                </div>
              </div>
            </div>

            {{-- Slide 2 — Believe --}}
            <div x-show="active === 2" x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
              class="flex flex-col items-center">
              <div class="relative w-full px-6">
                <img src="{{ Vite::asset('resources/images/home1.png') }}" alt="Believe"
                  class="w-full h-auto object-contain drop-shadow-lg">
                <h2
                  class="logo-text-main font-black uppercase -mt-8 relative z-10 text-white text-5xl tracking-tighter text-center">
                  Believe<span class="inline-block bg-[#dfff4f] rounded-full ml-1 w-3 h-3"></span>
                </h2>
              </div>
              <div
                class="w-full p-3 rounded-3xl bg-slate-900/80 backdrop-blur-sm border border-slate-800 shadow-xl mt-1">
                <h3 class="text-white text-center text-xl font-bold">See the Results</h3>
                <p class="mt-3 text-sm text-slate-300 text-center leading-relaxed">
                  Read the success stories of the students who have trained with us.
                </p>
                <div class="mt-4">
                  <a href="/successes"
                    class="block w-full px-6 py-4 text-center rounded-xl font-bold text-sm text-white border border-slate-700 hover:bg-slate-800 transition-colors no-underline">
                    Success Stories
                  </a>
                </div>
              </div>
            </div>

            {{-- Bottom word navigation: Belong | Become | Believe --}}
            <div class="flex justify-center items-end gap-8 mt-6 pb-4">
              <button @click="go(0)"
                class="logo-text-main uppercase tracking-wide transition-all duration-200 pb-1 border-b-2" :class="active === 0
                  ? 'text-white font-black text-xl border-[#dfff4f]'
                  : 'text-slate-500 font-bold text-sm border-transparent hover:text-slate-300'">
                Belong
              </button>
              <button @click="go(1)"
                class="logo-text-main uppercase tracking-wide transition-all duration-200 pb-1 border-b-2" :class="active === 1
                  ? 'text-white font-black text-xl border-[#dfff4f]'
                  : 'text-slate-500 font-bold text-sm border-transparent hover:text-slate-300'">
                Become
              </button>
              <button @click="go(2)"
                class="logo-text-main uppercase tracking-wide transition-all duration-200 pb-1 border-b-2" :class="active === 2
                  ? 'text-white font-black text-xl border-[#dfff4f]'
                  : 'text-slate-500 font-bold text-sm border-transparent hover:text-slate-300'">
                Believe
              </button>
            </div>

            {{-- Swipe hint — pulses briefly, auto-dismisses after 3 s or on first interaction --}}
            <div :class="showHint ? 'opacity-100 animate-pulse' : 'opacity-0'"
              class="flex items-center justify-center gap-2 pt-3 pb-0 text-slate-400 transition-opacity duration-700 ease-in"
              aria-hidden="true">
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M9 3L5 7l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
              <span class="text-[10px] uppercase tracking-[3px] font-medium">swipe</span>
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M5 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </div>

          </div>

          {{-- ── Desktop three-column layout (hidden on mobile) ──────────────── --}}
          <section class="hidden sm:flex flex-wrap justify-center items-end gap-6">
            {{-- Card 1: Belong --}}
            <x-call-to-action class="min-w-[280px] max-w-[350px] duration-300 translate-y-0 hover:-translate-y-2"
              title="Belong" :image="Vite::asset('resources/images/home3.png')" buttonText="About Us"
              buttonLink="/about">
              <x-slot:subtitle>
                Meet Our Community
              </x-slot:subtitle>
              <x-slot:description>
                We are a multigenerational community of athletes. Learn more about our tennis family.
              </x-slot:description>
            </x-call-to-action>

            <x-call-to-action featured title="Become"
              class="min-w-[280px] max-w-[350px] duration-300 translate-y-0 hover:-translate-y-2"
              :image="Vite::asset('resources/images/home2.png')" buttonText="Book a Clinic" delay="0.3s"
              buttonLink="/shop">
              <x-slot:subtitle>
                Level Up Your Game
              </x-slot:subtitle>
              <x-slot:description>
                Instruction for all levels and ages. Build your skills and confidence with our expert-led clinics.
              </x-slot:description>
            </x-call-to-action>

            <x-call-to-action title="Believe"
              class="min-w-[280px] max-w-[350px] duration-300 translate-y-0 hover:-translate-y-2"
              :image="Vite::asset('resources/images/home1.png')" buttonText="Success Stories" delay="0.6s"
              buttonLink="/successes">
              <x-slot:subtitle>
                See the Results
              </x-slot:subtitle>
              <x-slot:description>
                Read the success stories of the students who have trained with us.
              </x-slot:description>
            </x-call-to-action>
          </section>
        </main>
      </div>
    </div>
    @include('sections.footer')
  </div>
  @php(do_action('get_footer'))
  @php(wp_footer())
</body>

</html>