<div class="max-w-2xl mx-auto my-12 px-6">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-blue-50 text-[#5c88da] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                    </path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-900 uppercase tracking-tight">Reset Password</h2>
            <p class="text-slate-500 mt-3 leading-relaxed">
                {{ apply_filters('woocommerce_lost_password_message', esc_html__('Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')) }}
            </p>
        </div>

        <form method="post" class="woocommerce-ResetPassword lost_reset_password">
            <div class="mb-8">
                <label for="user_login" class="block text-xs font-bold uppercase text-slate-500 mb-2">Username or
                    Email</label>
                <input type="text" name="user_login" id="user_login" autocomplete="username"
                    class="w-full border-slate-200 rounded-xl p-4 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition shadow-sm" />
            </div>

            @php(do_action('woocommerce_lostpassword_form'))

            <input type="hidden" name="wc_reset_password" value="true" />

            <button type="submit"
                class="w-full bg-[#5c88da] text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-600 transition transform active:scale-95"
                value="{{ esc_attr__('Reset password', 'woocommerce') }}">
                {{ esc_html__('Reset password', 'woocommerce') }}
            </button>

            @php(wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'))
        </form>

        <div class="mt-8 text-center">
            <a href="{{ wc_get_page_permalink('myaccount') }}"
                class="text-sm font-bold text-slate-400 hover:text-[#5c88da] transition uppercase tracking-widest">
                &larr; Back to Login
            </a>
        </div>
    </div>
</div>