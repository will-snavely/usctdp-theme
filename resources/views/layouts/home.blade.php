<!doctype html>
<html @php(language_attributes())>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php(do_action('get_header'))
  @php(wp_head())

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body @php(body_class('antialiased text-slate-900 bg-slate-900'))>
  @php(wp_body_open())

  <div id="app" class="relative flex flex-col min-h-screen">
    <a class="sr-only focus:not-sr-only" href="#main">
      {{ __('Skip to content', 'sage') }}
    </a>

    @include('sections.header')

    <div class="flex-grow"
      style="background: 
      /* 1. White Line (h-8 = 32px) at the very top of this div */
      linear-gradient(#ffffff 32px, transparent 32px),
      /* 2. Blue Court Gradient starting after the white line */
      linear-gradient(to bottom, #0092be 0%, #005fbe 40%, #1e3a8a 80%, #0f172a 100%);">
      <main id="main" class="main flex-grow flex flex-col">
        @yield('content')
      </main>
    </div>

    @hasSection('sidebar')
    <aside class="sidebar max-w-screen-xl mx-auto px-6 pb-12">
      @yield('sidebar')
    </aside>
    @endif

    @include('sections.footer')
  </div>

  @php(do_action('get_footer'))
  @php(wp_footer())
</body>

</html>