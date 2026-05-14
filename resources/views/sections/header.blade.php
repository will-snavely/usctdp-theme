<header class="relative w-full bg-[#333333] h-32 flex items-center" x-data="{ mobileMenuOpen: false }" style="
    background-image: url('{{ Vite::asset('resources/images/tennis_bg_overlay.svg') }}');
    background-repeat: repeat;
    background-size: 1000px 125px;">

  <div class="max-w-screen-xl mx-auto px-6 lg:px-12 flex justify-between items-center h-32">
    {{-- Logo Area --}}
    <div class="flex-shrink-0 flex items-center h-full pr-4 md:pr-10">
      <a href="{{ home_url('/') }}" class="block max-w-full">
        <img src="{{ Vite::asset('resources/images/logo_banner.svg') }}" alt="USCTDP"
          class="h-16 md:h-24 lg:h-28 w-auto max-w-full object-contain">
      </a>
    </div>

    {{-- Desktop Navigation --}}
    <nav class="hidden lg:flex items-center space-x-2" aria-label="Primary Navigation">
      @foreach($navigation as $item)
        <x-nav-item :item="$item" />
      @endforeach
    </nav>

    <div class="hidden lg:flex items-center ml-8 border-l border-white/20 pl-6">
      <div class="flex items-center mr-6">
        <a href="{{ wc_get_cart_url() }}" class="relative group p-2 text-white hover:text-blue-200 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          @if (WC()->cart->get_cart_contents_count() > 0)
            <span
              class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-[10px] font-black leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full border-2 border-[#5c88da]">
              {{ WC()->cart->get_cart_contents_count() }}
            </span>
          @endif
        </a>
      </div>

      <div x-data="{ userMenuOpen: false }" class="relative">
        @if (is_user_logged_in())
          <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false"
            class="flex items-center gap-2 text-white font-bold uppercase text-sm hover:text-blue-200 transition-colors">
            <span>My Account</span>
            <svg class="w-4 h-4 transition-transform duration-500 ease-in-out" :class="userMenuOpen ? 'rotate-180' : ''"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>

          {{-- Dropdown --}}
          <div x-show="userMenuOpen" x-cloak
            class="absolute right-0 mt-4 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 overflow-hidden"
            x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">
            <a href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}"
              class="block px-4 py-3 text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-blue-50">Dashboard</a>
            <div class="border-t border-gray-100"></div>
            <a href="{{ wp_logout_url(home_url()) }}"
              class="block px-4 py-3 text-xs font-bold uppercase tracking-wider text-red-600 hover:bg-red-50">Logout</a>
          </div>
        @else
          <a href="{{ wp_login_url() }}"
            class="text-white font-bold uppercase text-sm hover:text-blue-200 transition-colors">
            Login
          </a>
        @endif
      </div>
    </div>

    {{-- Hamburger for small screens --}}
    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-white focus:outline-none"
      aria-label="Toggle Navigation">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {{-- Hamburger icon --}}
        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
          d="M4 6h16M4 12h16M4 18h16"></path>
        {{-- Close (X) Icon --}}
        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
          d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  {{-- Mobile Menu Overlay --}}
  <div x-show="mobileMenuOpen" x-cloak
    class="lg:hidden absolute top-full left-0 w-full bg-white shadow-2xl z-50 border-t border-gray-100 overflow-y-auto"
    x-data="{ 
      currentPath: ['main'], 
      get activePanel() { return this.currentPath[this.currentPath.length - 1]; },
      goForward(id) { this.currentPath.push(id); },
      goBack() { if (this.currentPath.length > 1) this.currentPath.pop(); }
    }" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100">

    <div class="relative w-full overflow-hidden">
      {{-- Level 1: Main Panel --}}
      <div x-show="activePanel === 'main'" x-transition:enter="transition ease-out duration-200" class="px-6 py-8">
        <ul class="flex flex-col space-y-2 list-none p-0 m-0">
          @foreach($navigation as $item)
            <li class="border-b border-gray-50 last:border-0">
              @if(!empty($item->children))
                <button @click="goForward('panel-{{ $item->ID }}')"
                  class="w-full flex justify-between items-center py-4 text-left font-bold text-slate-800 uppercase text-sm">
                  {{ $item->title }}
                  <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              @else
                <a href="{{ $item->url }}"
                  class="block py-4 font-bold text-slate-800 uppercase text-sm">{{ $item->title }}</a>
              @endif
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Sub Panels (Recursive handling for levels 2-5) --}}
      @include('partials.mobile-submenus', ['items' => $navigation])

      {{-- Mobile User Area (Fixed to the bottom of the main panel) --}}
      <div x-show="activePanel === 'main'" class="mt-4 border-t border-gray-100 bg-slate-50 px-6 py-6">
        @if (is_user_logged_in())
          <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <div>
              <span class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Logged in</span>
              <span class="block text-sm font-bold text-slate-800">{{ wp_get_current_user()->display_name }}</span>
            </div>
          </div>
          <a href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}"
            class="flex items-center justify-between w-full p-4 bg-white rounded-lg border border-gray-200 text-sm font-bold uppercase">
            My Dashboard
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M9 5l7 7-7 7" stroke-width="2" />
            </svg>
          </a>
        @else
          <a href="{{ wp_login_url() }}"
            class="flex items-center justify-center w-full p-4 bg-[#5c88da] rounded-lg text-white font-bold uppercase text-sm">Login</a>
        @endif
      </div>
    </div>
  </div>
</header>