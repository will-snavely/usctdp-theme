<div class="max-w-4xl mx-auto my-12 px-6">
    <div class="grid md:grid-cols-2 gap-12 bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">

        {{-- Left Side: Login --}}
        <div class="p-8 md:p-12">
            <h2 class="text-2xl font-bold text-slate-900 mb-6 uppercase tracking-tight">Login</h2>

            <form class="woocommerce-form woocommerce-form-login login" method="post">
                @php(do_action('woocommerce_login_form_start'))

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Username or Email</label>
                    <input type="text" name="username"
                        class="w-full border-slate-200 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full border-slate-200 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center text-sm text-slate-600">
                        <input name="rememberme" type="checkbox" class="rounded border-slate-300 text-[#5c88da] mr-2">
                        Remember Me
                    </label>
                    <a href="{{ wp_lostpassword_url() }}" class="text-sm text-[#5c88da] hover:underline">Forgot?</a>
                </div>

                @php(wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'))
                <button type="submit" name="login" value="Login"
                    class="w-full bg-[#5c88da] text-white font-bold py-4 rounded-xl shadow-lg hover:bg-blue-600 transition transform active:scale-95">
                    Sign In
                </button>

                @php(do_action('woocommerce_login_form_end'))
            </form>
        </div>

        {{-- Right Side: Branding/Registration --}}
        <div class="bg-slate-50 p-8 md:p-12 flex flex-col justify-center border-l border-slate-100">
            @if (get_option('woocommerce_enable_myaccount_registration') === 'yes')
                <h2 class="text-2xl font-bold text-slate-900 mb-4 uppercase tracking-tight">New Here?</h2>
                <p class="text-slate-600 mb-8">Join the program to track your sessions, manage gear orders, and get early
                    access to clinics.</p>

                <a href="/register"
                    class="inline-block text-center border-2 border-[#5c88da] text-[#5c88da] font-bold py-3 rounded-xl hover:bg-[#5c88da] hover:text-white transition">
                    Create Account
                </a>
            @else
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-blue-100 text-[#5c88da] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800">Secure Access</h3>
                    <p class="text-sm text-slate-500 mt-2">Log in to manage your player profile.</p>
                </div>
            @endif
        </div>
    </div>
</div>