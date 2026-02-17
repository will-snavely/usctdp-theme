<header class="relative w-full border-b-2 border-black/10 shadow-sm" 
        style="background-color: #0265b5;" 
        x-data="{ mobileMenuOpen: false }">
  
  <div class="max-w-screen-xl mx-auto px-6 lg:px-12 flex justify-between items-center h-32">
    {{-- Logo Area --}}
    <div class="flex-shrink-0 flex items-center h-full">
      <a href="{{ home_url('/') }}" class="block">
        <img src="{{ Vite::asset('resources/images/logo_banner.png') }}" 
             alt="USCTDP" 
             class="!h-20 md:!h-24 lg:!h-28 !w-auto !max-w-none object-contain">
      </a>
    </div>

    {{-- Desktop Navigation (Hidden on Mobile) --}}
    <nav class="nav-primary hidden lg:block" aria-label="Primary Navigation">
      {!! wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'container' => false,
        'menu_class' => 'flex space-x-8 items-center text-base font-bold text-white uppercase',
        'echo' => false
      ]) !!}
    </nav>

    {{-- Desktop User & Cart Area --}}
    <div class="hidden lg:flex items-center ml-8 border-l border-white/20 pl-6">
      
      {{-- 1. Cart Icon: Now completely independent of the User Menu state --}}
      <div class="flex items-center mr-6">
        <a href="{{ wc_get_cart_url() }}" class="relative group p-2 text-white hover:text-blue-200 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          @if (WC()->cart->get_cart_contents_count() > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-[10px] font-black leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full border-2 border-[#5c88da]">
              {{ WC()->cart->get_cart_contents_count() }}
            </span>
          @endif
        </a>
      </div>

      {{-- 2. Account State: x-data is now scoped ONLY to this container --}}
      <div x-data="{ userMenuOpen: false }" class="relative">
        @if (is_user_logged_in())
          <button @click="userMenuOpen = !userMenuOpen" 
                  @click.away="userMenuOpen = false" 
                  class="flex items-center gap-2 text-white font-bold uppercase text-sm hover:text-blue-200 transition-colors">
            <span>My Account</span>
            <svg class="w-4 h-4 transition-transform" :class="userMenuOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>

          {{-- Dropdown --}}
          <div x-show="userMenuOpen" 
              x-cloak 
              class="absolute right-0 mt-4 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 overflow-hidden"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100">
            <a href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}" class="block px-4 py-3 text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-blue-50">Dashboard</a>
            <div class="border-t border-gray-100"></div>
            <a href="{{ wp_logout_url(home_url()) }}" class="block px-4 py-3 text-xs font-bold uppercase tracking-wider text-red-600 hover:bg-red-50">Logout</a>
          </div>
        @else
          <a href="{{ wp_login_url() }}" class="text-white font-bold uppercase text-sm hover:text-blue-200 transition-colors">
            Login
          </a>
        @endif
      </div>
    </div>

    {{-- RESTORED: Mobile Hamburger Button --}}
    <button @click="mobileMenuOpen = !mobileMenuOpen" 
            class="lg:hidden p-2 text-white focus:outline-none" 
            aria-label="Toggle Navigation">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {{-- Hamburger Icon --}}
        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
        {{-- Close (X) Icon --}}
        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  {{-- Mobile Menu Overlay (Inside the header tag) --}}
  <div x-show="mobileMenuOpen" 
       x-cloak 
       {{-- Changed to absolute to sit right below the header --}}
       class="lg:hidden absolute top-full left-0 w-full bg-white shadow-2xl z-50 border-t border-gray-100"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-2"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-2">
    
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-mobile px-6 py-8">
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'container' => false,
          'menu_class' => 'flex flex-col space-y-2 list-none p-0 m-0',
          'echo' => false,
        ]) !!}

        {{-- Mobile User Area --}}
        <div class="mt-4 border-t border-gray-100 bg-slate-50 -mx-6 px-6 py-6">
          @if (is_user_logged_in())
            <div class="flex items-center gap-3 mb-4">
              {{-- Simple User Icon --}}
              <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div>
                <span class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Logged in as</span>
                <span class="block text-sm font-bold text-slate-800">{{ wp_get_current_user()->display_name }}</span>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-2">
              <a href="{{ get_permalink(get_option('woocommerce_myaccount_page_id')) }}" 
                class="flex items-center justify-between w-full p-4 bg-white rounded-lg border border-gray-200 shadow-sm text-slate-700 font-bold uppercase text-sm">
                My Dashboard
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
              </a>
              
              <a href="{{ wp_logout_url(home_url()) }}" 
                class="block w-full text-center p-3 text-xs font-bold text-red-500 uppercase tracking-tighter">
                Sign Out
              </a>
            </div>
          @else
            <a href="{{ wp_login_url() }}" 
              class="flex items-center justify-center w-full p-4 bg-indigo-600 rounded-lg shadow-md text-white font-bold uppercase text-sm transition-transform active:scale-95">
              Login to Account
            </a>
          @endif
        </div>
      </nav>
    @endif
  </div>
</header>