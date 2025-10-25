<header class="banner bg-neutral-400" x-data="{ mobileMenuOpen: false }">
  <div class="w-full max-w-screen-xl flex justify-between items-center mx-auto px-4 lg:px-8 h-32">
    
    <div class="usctdp-logo w-auto max-w-lg h-full flex items-center p-4">
      <a href="{{ home_url('/') }}">
        <img
          src="{{ Vite::asset('resources/images/logo_banner.png') }}" 
          alt="Upper St. Clair Tennis Development Program, Est. 1983">
      </a>
    </div>
    
    <nav class="nav-primary hidden lg:block" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu([
        'theme_location' => 'primary_navigation', 
        'menu_class' => 'flex space-x-6 list-none items-center', 
        'echo' => false]) !!}
    </nav>

    {{-- Hamburger Button --}}
    <button x-on:click="mobileMenuOpen=!mobileMenuOpen" 
            class="lg:hidden p-2 text-gray-700 hover:text-gray-900 rounded-md transition duration-150 ease-in-out"
            aria-label="Toggle navigation"
            :aria-expanded="mobileMenuOpen">
      
      {{-- Menu Icon (Hidden when mobileMenuOpen is true) --}}
      <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
      
      {{-- Close Icon (Hidden when mobileMenuOpen is false) --}}
      <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>

  <div id="mobile-menu" 
      class="lg:hidden absolute w-full bg-white shadow-lg pb-4 z-40 border-t border-gray-600"
      x-show="mobileMenuOpen"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 transform -translate-y-2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 transform translate-y-0"
      x-transition:leave-end="opacity-0 transform -translate-y-2"
      x-on:click.away="mobileMenuOpen = false">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            // Stack links vertically for mobile
            'menu_class' => 'flex flex-col space-y-2 px-4', 
            'echo' => false,
        ]) !!}
    @endif
  </div>

</header>
