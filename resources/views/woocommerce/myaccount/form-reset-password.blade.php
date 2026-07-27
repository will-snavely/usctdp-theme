<div class="max-w-2xl mx-auto my-12 px-6">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-blue-50 text-[#5c88da] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 uppercase tracking-tight">Set New Password</h2>
            <p class="text-slate-500 mt-3 leading-relaxed">
                {{ apply_filters('woocommerce_reset_password_message', esc_html__('Enter a new password below.', 'woocommerce')) }}
            </p>
        </div>

        @php(do_action('woocommerce_before_reset_password_form'))

        <form method="post" class="woocommerce-ResetPassword lost_reset_password">
            <div class="mb-6">
                <label for="password_1" class="block text-xs font-bold uppercase text-slate-500 mb-2">
                    {{ esc_html__('New password', 'woocommerce') }}
                </label>
                <input type="password" name="password_1" id="password_1" autocomplete="new-password" required
                    aria-required="true"
                    class="w-full border-slate-200 rounded-xl p-4 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition shadow-sm" />
            </div>

            <div class="mb-8">
                <label for="password_2" class="block text-xs font-bold uppercase text-slate-500 mb-2">
                    {{ esc_html__('Re-enter new password', 'woocommerce') }}
                </label>
                <input type="password" name="password_2" id="password_2" autocomplete="new-password" required
                    aria-required="true"
                    class="w-full border-slate-200 rounded-xl p-4 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition shadow-sm" />
            </div>

            <input type="hidden" name="reset_key" value="{{ esc_attr($args['key']) }}" />
            <input type="hidden" name="reset_login" value="{{ esc_attr($args['login']) }}" />

            @php(do_action('woocommerce_resetpassword_form'))

            <input type="hidden" name="wc_reset_password" value="true" />

            <button type="submit"
                class="w-full bg-[#5c88da] text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-600 transition transform active:scale-95"
                value="{{ esc_attr__('Save', 'woocommerce') }}">
                {{ esc_html__('Save', 'woocommerce') }}
            </button>

            @php(wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'))
        </form>

        @php(do_action('woocommerce_after_reset_password_form'))

        <div class="mt-8 text-center">
            <a href="{{ wc_get_page_permalink('myaccount') }}"
                class="text-sm font-bold text-slate-400 hover:text-[#5c88da] transition uppercase tracking-widest">
                &larr; Back to Login
            </a>
        </div>
    </div>
</div>
