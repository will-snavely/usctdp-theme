<div class="max-w-2xl mx-auto my-12 px-6">
    @php(wc_print_notices())

    @php($registrationEnabled = get_option('woocommerce_enable_myaccount_registration') === 'yes')
    @php($wantsRegister = !empty($_POST['register']) || (isset($_GET['action']) && $_GET['action'] === 'register'))
    @php($initialMode = $registrationEnabled && $wantsRegister ? 'register' : 'login')

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12"
        x-data="{ mode: '{{ $initialMode }}' }">

        {{-- Login --}}
        <div x-show="mode === 'login'" x-cloak>
            <h2 class="text-2xl font-bold text-slate-900 mb-2 uppercase tracking-tight text-center">Login</h2>
            <div class="flex items-center justify-center gap-2 mb-6 text-xs font-bold uppercase tracking-wide text-slate-500">
                <svg class="w-4 h-4 text-[#5c88da]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                Secure Access
            </div>

            <form class="woocommerce-form woocommerce-form-login login" method="post">
                @php(do_action('woocommerce_login_form_start'))

                <div class="mb-4">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Username or Email</label>
                    <input type="text" name="username"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
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

            @if ($registrationEnabled)
                <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                    <p class="text-slate-600 mb-4">New here? Join the program to track your sessions, manage gear
                        orders, and get early access to clinics.</p>
                    <button type="button" @click="mode = 'register'"
                        class="inline-block text-center border-2 border-[#5c88da] text-[#5c88da] font-bold py-3 px-8 rounded-xl hover:bg-[#5c88da] hover:text-white transition">
                        Create Account
                    </button>
                </div>
            @endif
        </div>

        {{-- Register --}}
        @if ($registrationEnabled)
            <div x-show="mode === 'register'" x-cloak>
                <h2 class="text-2xl font-bold text-slate-900 mb-2 uppercase tracking-tight text-center">Create
                    Account</h2>
                <div class="flex items-center justify-center gap-2 mb-6 text-xs font-bold uppercase tracking-wide text-slate-500">
                    <svg class="w-4 h-4 text-[#5c88da]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Secure Access
                </div>

                <form method="post" class="woocommerce-form woocommerce-form-register register"
                    @php(do_action('woocommerce_register_form_tag'))>
                    @php(do_action('woocommerce_register_form_start'))

                    @if (get_option('woocommerce_registration_generate_username') === 'no')
                        <div class="mb-4">
                            <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Username</label>
                            <input type="text" name="username"
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-500 mb-2">First Name</label>
                            <input type="text" name="first_name" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Last Name</label>
                            <input type="text" name="last_name" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Email Address</label>
                        <input type="email" name="email"
                            class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Phone Number <span
                                class="normal-case text-slate-400 font-normal">(optional)</span></label>
                        <input type="tel" name="phone"
                            class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                    </div>

                    @if (get_option('woocommerce_registration_generate_password') === 'no')
                        <div class="mb-6">
                            <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                    @else
                        <p class="text-sm text-slate-500 mb-6">A link to set a new password will be sent to your
                            email address.</p>
                    @endif

                    <div
                        class="mb-6 text-sm text-slate-500 [&_p]:mb-0 [&_a]:text-[#5c88da] [&_a]:underline">
                        @php(do_action('woocommerce_register_form'))
                    </div>

                    @php(wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'))
                    <button type="submit" name="register" value="Register"
                        class="w-full bg-[#5c88da] text-white font-bold py-4 rounded-xl shadow-lg hover:bg-blue-600 transition transform active:scale-95">
                        Create Account
                    </button>

                    @php(do_action('woocommerce_register_form_end'))
                </form>

                <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                    <button type="button" @click="mode = 'login'" class="text-sm text-[#5c88da] hover:underline">
                        Already have an account? Sign in
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
