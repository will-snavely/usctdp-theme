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
      <main id="main" class="main flex-grow w-full max-w-screen-lg mx-auto px-6 lg:px-12 py-8 md:py-16">
        @yield('content')
      </main>
    </div>

    @include('sections.footer')

  </div>

  @php(do_action('get_footer'))
  @php(wp_footer())
</body>

</html>