{{--
Template Name: Confirm Import
Description: Landing page for the legacy-family opt-in import email link
(?usctdp_import=<pending id>&usctdp_key=...). Not linked from the site nav -
only reachable via the emailed link, so it's provisioned in data/pages.json
without a menu entry.
--}}

@extends('layouts.app')

@section('content')
@php
    $confirmHooks = new Usctdp_Mgmt_Import_Confirm_Hooks();
    $context = $confirmHooks->get_confirm_context();
@endphp

<div class="max-w-2xl mx-auto my-12 px-6">
    @php(wc_print_notices())

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">

        @if ($context['state'] === 'invalid')
            <h2 class="text-2xl font-bold text-slate-900 mb-4 uppercase tracking-tight text-center">Link Invalid or
                Expired</h2>
            <p class="text-slate-600 text-center">This import link is no longer valid. Please contact the office and
                we'll send you a new one.</p>

        @elseif ($context['state'] === 'already_confirmed')
            <h2 class="text-2xl font-bold text-slate-900 mb-4 uppercase tracking-tight text-center">Already Confirmed
            </h2>
            <p class="text-slate-600 text-center mb-6">This account has already been set up. You can log in below.
            </p>
            <a href="{{ wc_get_page_permalink('myaccount') }}"
                class="block text-center w-full bg-[#5c88da] text-white font-bold py-4 rounded-xl shadow-lg hover:bg-blue-600 transition">
                Go to My Account
            </a>

        @else
            @php($pending = $context['pending'])
            <h2 class="text-2xl font-bold text-slate-900 mb-2 uppercase tracking-tight text-center">Confirm Your
                Family's Info</h2>
            <p class="text-slate-500 text-center mb-8">We've pre-filled this from our records &mdash; please review
                and correct anything that's changed before confirming.</p>

            <form method="post">
                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Last Name</label>
                    <input type="text" name="last_name" required value="{{ $pending->last }}"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Phone Number</label>
                    <input type="tel" name="phone" required value="{{ $pending->phone_numbers[0] ?? '' }}"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ $pending->emails[0] ?? '' }}"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Address</label>
                    <input type="text" name="address" value="{{ $pending->address }}"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">City</label>
                        <input type="text" name="city" value="{{ $pending->city }}"
                            class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">State</label>
                        <input type="text" name="state" value="{{ $pending->state }}"
                            class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Zip</label>
                        <input type="text" name="zip" value="{{ $pending->zip }}"
                            class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                    </div>
                </div>

                @if (!empty($pending->students))
                    <div class="mb-6 pt-6 border-t border-slate-100">
                        <h3 class="text-xs font-bold uppercase text-slate-500 mb-4 tracking-wide">Students</h3>
                        @foreach ($pending->students as $index => $student)
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">First
                                        Name</label>
                                    <input type="text" name="students[{{ $index }}][first]" required
                                        value="{{ $student->first }}"
                                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Birth
                                        Date</label>
                                    <input type="date" name="students[{{ $index }}][birth_date]"
                                        value="{{ $student->birth_date }}"
                                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                                    <input type="hidden" name="students[{{ $index }}][last]"
                                        value="{{ $student->last }}" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($context['requires_password'])
                    <div class="mb-6 pt-6 border-t border-slate-100">
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Set a Password</label>
                        <input type="password" name="new_password" required minlength="8"
                            class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                    </div>
                @endif

                <input type="hidden" name="usctdp_import" value="{{ $context['pending_id'] }}" />
                <input type="hidden" name="usctdp_key" value="{{ $context['key'] }}" />
                <input type="hidden" name="usctdp_confirm_import" value="1" />
                @php(wp_nonce_field('usctdp_confirm_import', 'usctdp_confirm_import_nonce'))

                <button type="submit"
                    class="w-full bg-[#5c88da] text-white font-bold py-4 rounded-xl shadow-lg hover:bg-blue-600 transition transform active:scale-95">
                    Confirm and Create My Account
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
