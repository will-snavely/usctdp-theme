@php
global $product;
if (empty($product) || ! $product->is_visible()) return;
@endphp

<article {{ wc_product_class('group flex flex-col bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow', $product) }}>

  {{-- Image --}}
  <a href="{{ get_permalink() }}" class="block shrink-0 overflow-hidden">
    <div class="h-[200px] bg-slate-100">
      {!!
        $product->get_image(
          'woocommerce_thumbnail',
          ['class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105']
        )
      !!}
    </div>
  </a>

  {{-- Body --}}
  <div class="flex flex-col flex-grow p-5">

    {{-- Name --}}
    <h2 class="font-bold text-slate-800 text-base leading-snug mb-2 mt-2">
      <a href="{{ get_permalink() }}" class="hover:text-[#0092be] transition-colors no-underline">
        {!! $product->get_name() !!}
      </a>
    </h2>

    {{-- Short description --}}
    <div class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-4">
      {!! $product->get_short_description() !!}
    </div>

    {{-- CTA --}}
    <div class="mt-auto">
      @if($product->is_in_stock())
        <a href="{{ get_permalink() }}"
          class="block text-center px-4 py-2.5 bg-[#0092be] hover:bg-[#007aa0] text-white text-sm font-bold rounded-xl transition-colors no-underline uppercase tracking-widest">
          Register &rarr;
        </a>
      @else
        <a href="{{ get_permalink() }}"
          class="block text-center px-4 py-2.5 bg-slate-100 text-slate-400 text-sm font-bold rounded-xl no-underline uppercase tracking-widest cursor-default">
          Out of Season
        </a>
      @endif
    </div>

  </div>
</article>
