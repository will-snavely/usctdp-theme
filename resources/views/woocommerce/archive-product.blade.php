{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}

@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp

  <header class="woocommerce-products-header">
    @php
      $groups = [
        ['label' => 'Event Type', 'tax' => 'event_type', 'terms' => $event_types],
        ['label' => 'Age Group',  'tax' => 'age_group',  'terms' => $age_groups],
        ['label' => 'Skill Level','tax' => 'skill_level','terms' => $skill_levels],
      ];
    @endphp
    <div class="filter-container mb-10 space-y-4">
      @foreach($groups as $group)
        <div class="filter-group">
          <span class="block text-xs font-bold uppercase text-gray-400 mb-2">{{ $group['label'] }}</span>
          <div class="flex flex-wrap gap-2">
            @foreach($group['terms'] as $term)
              <x-filter-pill 
                :url="$filter_url($group['tax'], $term->slug)"
                :label="$term->name"
                :active="($active_filters[$group['tax']] ?? '') === $term->slug"
              />
            @endforeach
          </div>
        </div>
      @endforeach

      @if(!empty($active_filters))
        <div class="pt-2">
          <a href="{{ get_permalink(wc_get_page_id('shop')) }}" class="text-xs text-red-500 font-medium hover:underline">
            ✕ Reset all filters
          </a>
        </div>
      @endif
    </div>

    <div>
      @php
        do_action('woocommerce_archive_description')
      @endphp
    </div>
  </header>

  @if (woocommerce_product_loop())
    <div id="shop-area" class="flex flex-col">
      <div>
        @php
          do_action('woocommerce_before_shop_loop');
        @endphp
      </div>

      <div class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @while (have_posts())
          @php the_post() @endphp
          @php do_action('woocommerce_shop_loop') @endphp
          @include('woocommerce.content-product')
        @endwhile
      </div>

      @php
        do_action('woocommerce_after_shop_loop')
      @endphp
    </div>
  @else
    @php
      do_action('woocommerce_no_products_found')
    @endphp
  @endif

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection
