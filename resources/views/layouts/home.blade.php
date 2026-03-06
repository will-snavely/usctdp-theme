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
          <section class="flex flex-wrap justify-center items-end gap-6">
            {{-- Card 1: Belong --}}
            <x-call-to-action 
              class="min-w-[280px] max-w-[350px] duration-300 translate-y-0 hover:-translate-y-2"
              title="Belong" 
              :image="Vite::asset('resources/images/home3.png')" 
              buttonText="About Us">
                <x-slot:subtitle>
                  Meet Our Community
                </x-slot:subtitle>
                <x-slot:description>
                  More than just a court. Join a vibrant social circle of tennis enthusiasts.
                </x-slot:description>
            </x-call-to-action>

            <x-call-to-action 
                featured 
                title="Become" 
                class="min-w-[280px] max-w-[350px] duration-300 translate-y-0 hover:-translate-y-2"
                :image="Vite::asset('resources/images/home2.png')" 
                buttonText="Book a Clinic"
                delay="0.3s">
                  <x-slot:subtitle>
                    Level Up Your Game
                  </x-slot:subtitle>
                  <x-slot:description>
                    From beginners to competitive pros. Master the court with expert-led coaching clinics.
                  </x-slot:description>
            </x-call-to-action>

              <x-call-to-action 
                title="Believe" 
                class="min-w-[280px] max-w-[350px] duration-300 translate-y-0 hover:-translate-y-2"
                :image="Vite::asset('resources/images/home1.png')" 
                buttonText="Success Stories"
                delay="0.6s">
                  <x-slot:subtitle>
                    See the Results
                  </x-slot:subtitle>
                  <x-slot:description>
                    Witness the transformation of our players and the trophies in our cabinets.
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
