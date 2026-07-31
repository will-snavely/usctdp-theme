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
    </div>
  </div>

  @php(wp_footer())
</body>

</html>
