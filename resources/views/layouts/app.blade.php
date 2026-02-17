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

      {{-- 
        Fixing the 'Squish':
        1. max-w-screen-xl: Keeps content from getting too wide on monitors.
        2. mx-auto: Centers the content.
        3. px-6 lg:px-12: Adds the missing padding on mobile and desktop.
        4. py-8 md:py-16: Adds vertical breathing room.
        5. flex-grow: Pushes the footer to the bottom on short pages.
      --}}
      <main id="main" class="main flex-grow w-full max-w-screen-xl mx-auto px-6 lg:px-12 py-8 md:py-16">
        @yield('content')
      </main>

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