<div class="max-w-3xl mx-auto my-12 px-6">
    @php(wc_print_notices())

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">
        <h2 class="text-2xl font-bold text-slate-900 mb-6 uppercase tracking-tight">House Credit</h2>

        @if (!$family)
            <p class="text-slate-600">We couldn't find a family account linked to your login. Please contact the
                office.</p>
        @else
            @php($balanceValue = $balance !== null ? (float) $balance : 0.0)
            <div class="border border-slate-100 rounded-xl p-6">
                <p class="text-xs font-bold uppercase text-slate-500 mb-2 tracking-wide">Available Balance</p>
                <p class="text-3xl font-bold text-slate-900">{!! wc_price(max($balanceValue, 0)) !!}</p>
            </div>
            <p class="text-sm text-slate-500 mt-4">
                House credit isn't applied automatically at checkout. To use it toward a registration or purchase,
                please <a href="/contact" class="text-[#5c88da] hover:underline">contact the office</a>.
            </p>
        @endif
    </div>
</div>
