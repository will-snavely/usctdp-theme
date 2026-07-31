<!doctype html>
<html @php(language_attributes())>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php(wp_head())
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body @php(body_class('antialiased text-slate-900 bg-slate-50'))>
  @php(wp_body_open())

  <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12" style="
      background-color: #4a6dae;
      background-image: url('{{ Vite::asset('resources/images/coming_bg_tile.svg') }}');
      background-repeat: repeat;
      background-size: 600px 600px;">
    <div class="max-w-lg w-full">
      <img src="{{ Vite::asset('resources/images/logo_banner.svg') }}" alt="{{ get_bloginfo('name') }}"
        class="h-20 w-auto mx-auto mb-10">

      <div class="bg-blue-50 rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12 text-center">
        <h1 class="text-2xl font-bold text-slate-900 uppercase tracking-tight mb-4">
          {{ __('We\'re getting ready', 'usctdp-theme') }}
        </h1>
        <p class="text-slate-500 leading-relaxed">
          {{ __('Our new site is almost here. Check back soon.', 'usctdp-theme') }}
        </p>
      </div>

      <img src="{{ Vite::asset('resources/images/motto_cropped.svg') }}" alt="Belong, Become, Believe"
        class="w-full h-auto mx-auto mt-4">

      <div class="flex justify-center space-x-6 mt-8">
        {{-- Facebook --}}
        <a href="https://www.facebook.com/tennisstclair/" target="_blank" rel="noopener"
          class="text-white/80 hover:text-white transition-colors" aria-label="Facebook">
          <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
          </svg>
        </a>

        {{-- Instagram --}}
        <a href="https://www.instagram.com/usctdp/" target="_blank" rel="noopener"
          class="text-white/80 hover:text-white transition-colors" aria-label="Instagram">
          <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
          </svg>
        </a>
      </div>

      <div class="text-center text-white/80 text-sm mt-6 space-y-1">
        <p><a href="tel:+14128312630" class="hover:text-white transition-colors">(412) 831-2630</a></p>
        <p><a href="mailto:tennis@usctdp.com" class="hover:text-white transition-colors">tennis@usctdp.com</a></p>
      </div>
    </div>
  </div>

  @php(wp_footer())
</body>

</html>
