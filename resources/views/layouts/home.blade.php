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

    <div class="page-header w-full h-18 flex justify-center items-center">
    </div>

    <div class="flex-grow"
      style="background: linear-gradient(to bottom, #0092be 0%, #005fbe 40%, #1e3a8a 80%, #0f172a 100%);">
      <main id="main" class="main flex-grow w-full max-w-screen-xl mx-auto px-6 lg:px-12 py-8 md:py-16">
        <section class="flex flex-wrap justify-center items-end gap-4 p-6">
          <div class="flex flex-col items-center flex-1 min-w-[280px] max-w-[400px] animate__animated animate__fadeIn">
            <div class="w-full">
              <img src="{{ Vite::asset('resources/images/home3.png') }}" alt="Belong" class="w-full h-auto object-contain drop-shadow-lg">
            </div>
            <h2 class="text-4xl md:text-5xl font-black uppercase -mt-6 z-10 text-slate-900">
              Belong.
            </h2>
          </div>

          <div class="flex flex-col items-center flex-1 min-w-[280px] max-w-[400px] animate__animated animate__fadeIn" style="animation-delay: 0.5s;">
            <div class="w-full">
              <img src="{{ Vite::asset('resources/images/home2.png') }}" alt="Become" class="w-full h-auto object-contain drop-shadow-lg">
            </div>
            <h2 class="text-4xl md:text-5xl font-black uppercase -mt-6 z-10 text-slate-900">
              Become.
            </h2>
          </div>

          <div class="flex flex-col items-center flex-1 min-w-[280px] max-w-[400px] animate__animated animate__fadeIn" style="animation-delay: 1.0s;">
            <div class="w-full">
              <img src="{{ Vite::asset('resources/images/home1.png') }}" alt="Believe" class="w-full h-auto object-contain drop-shadow-lg">
            </div>
            <h2 class="text-4xl md:text-5xl font-black uppercase -mt-6 z-10 text-slate-900">
              Believe.
            </h2>
          </div>

        </section>
      </main>
    </div>

    @include('sections.footer')

  </div>

  @php(do_action('get_footer'))
  @php(wp_footer())
</body>

</html>