@php
  global $product;
  if (empty($product) || ! $product->is_visible()) return;
@endphp

<article {{ wc_product_class('group bg-white border p-4 rounded-xl transition hover:shadow-lg', $product) }}>
  {{-- Image Section --}}
  <div class="relative overflow-hidden rounded-md mb-4">
    <div class="product-image-container max-w-[250px] mx-auto">
      <a href="{{ get_permalink() }}">
        {!! 
          $product->get_image(
            'woocommerce_thumbnail',
            ['class' => 'w-full h-auto transform transition group-hover:scale-105']) 
        !!}
      </a>
    </div>
    
    {{-- Example of a custom "Sale" badge --}}
    @if($product->is_on_sale())
      <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
        SALE
      </span>
    @endif
  </div>

  {{-- Content Section --}}
  <div class="flex flex-col flex-grow">
    <h2 class="text-lg font-semibold mb-2">
      <a href="{{ get_permalink() }}" class="hover:text-primary">
        {!! $product->get_name() !!}
      </a>
    </h2>

    <div class="text-gray-600 mb-4">
      {!! $product->get_short_description() !!}
    </div>

    <div class="text-gray-600 mb-4">
      {!! $product->get_price_html() !!}
    </div>

    {{-- Bottom Action Area --}}
    <div class="mt-auto">
      @php(woocommerce_template_loop_add_to_cart())
    </div>
  </div>
</article>
