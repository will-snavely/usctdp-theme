{{-- resources/views/woocommerce/cart/cart-empty.blade.php --}}
{{--
WooCommerce's own cart.js (update_wc_div) looks for .wc-empty-cart-message in
the AJAX response when the cart becomes empty via an AJAX remove, and splices
it in to replace the cart form - no page reload involved. Without this class
on the outer wrapper, that lookup finds nothing and cart.js replaces the cart
form with an empty jQuery set, i.e. nothing, leaving a blank cart page until a
manual refresh.
--}}
<div
    class="wc-empty-cart-message py-16 md:py-24 px-6 text-center bg-white rounded-3xl shadow-sm border border-slate-100 max-w-2xl mx-auto my-12">
    {{-- Decorative Icon --}}
    <div class="mb-8 flex justify-center">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
    </div>

    {{-- Message --}}
    <h2 class="text-3xl font-bold text-slate-900 mb-4 tracking-tight">
        Your cart is currently empty.
    </h2>

    <p class="text-slate-500 mb-10 max-w-sm mx-auto text-lg leading-relaxed">
        Ready to get back on the court? Check out our latest programming!
    </p>

    {{-- Return to Shop Button --}}
    <a href="{{ wc_get_page_permalink('shop') }}"
        class="inline-block bg-[#5c88da] text-white font-bold uppercase tracking-widest text-sm px-8 py-4 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-600 transition-all transform hover:-translate-y-1 active:scale-95">
        Return to Shop
    </a>
</div>