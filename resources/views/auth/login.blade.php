<x-guest-layout>
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950">
        <div class="absolute inset-0 opacity-50">
            <div class="absolute w-72 h-72 bg-sky-500 rounded-full blur-3xl -top-10 -left-10"></div>
            <div class="absolute w-72 h-72 bg-cyan-400 rounded-full blur-3xl bottom-10 right-6"></div>
        </div>

        <div class="relative flex items-center justify-center px-4 py-12 md:px-10">
            <div
                class="w-full max-w-5xl overflow-hidden bg-white/10 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl">
                <div class="grid md:grid-cols-2">
                    <div class="hidden md:flex flex-col justify-between p-10 text-white bg-gradient-to-br from-sky-600 to-cyan-500">
                        <a href="{{ URL('/') }}" class="flex items-center gap-3">
                            <img src="{{ asset('assets/img/gon-logo.png') }}" class="h-16 drop-shadow-lg">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-white/80">Government of Nagaland</p>
                                <h1 class="text-2xl font-semibold leading-tight">HGCD & SDRF Smart App</h1>
                            </div>
                        </a>
                        <div class="space-y-4">
                            <p class="text-sm text-white/80">Streamlined access for authorised personnel with enhanced
                                security and modern experience.</p>
                            <div class="flex items-center gap-3 text-sm text-white/85">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/20">✓</span>
                                <div>
                                    <div class="font-semibold">Secure by design</div>
                                    <div class="text-white/70">Encrypted credentials and captcha validation.</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-white/85">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/20">✓</span>
                                <div>
                                    <div class="font-semibold">Responsive layout</div>
                                    <div class="text-white/70">Optimised for desktop and mobile officers on duty.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 md:p-10 bg-white">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3 md:hidden mb-6">
                                <img src="{{ asset('assets/img/gon-logo.png') }}" class="h-12">
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.18em] text-slate-500">Government of
                                        Nagaland</p>
                                    <h1 class="text-lg font-semibold text-slate-800">HGCD & SDRF Smart App</h1>
                                </div>
                            </div>
                            <span class="hidden text-xs font-medium tracking-wide text-slate-500 md:inline">Authorized
                                Access Only</span>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold text-slate-900">Welcome back</h2>
                            <p class="text-sm text-slate-500">Sign in with your official credentials to continue.</p>
                        </div>

                        <form action="{{ route('login') }}" method="post" class="space-y-5" id="login-form">
                            @csrf
                            <input type="hidden" name="uniqueId" id="uniqueId">

                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-slate-700">Email <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" id="email" name="email" required
                                        class="w-full px-4 py-3 text-slate-900 placeholder:text-slate-400 bg-slate-50 border border-slate-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition
                                        @error('email') border-red-500 ring-red-200 focus:ring-red-200 @enderror"
                                        placeholder="name@example.com" autocomplete="off">
                                    <div class="absolute inset-y-0 right-3 flex items-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 8l9 6 9-6m-18 8h18V8H3v8z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-slate-700">Password <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full px-4 py-3 text-slate-900 placeholder:text-slate-400 bg-slate-50 border border-slate-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition
                                        @error('password') border-red-500 ring-red-200 focus:ring-red-200 @enderror"
                                        placeholder="••••••••" autocomplete="off">
                                    <div class="absolute inset-y-0 right-3 flex items-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 15c1.657 0 3-1.567 3-3.5S13.657 8 12 8s-3 1.567-3 3.5 1.343 3.5 3 3.5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4.5 12c1.5-3 4.5-5 7.5-5s6 2 7.5 5c-1.5 3-4.5 5-7.5 5s-6-2-7.5-5z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">Captcha <span
                                        class="text-red-500">*</span></label>
                                <div class="flex items-center gap-3">
                                    <div class="captcha rounded-xl overflow-hidden border border-slate-200 bg-slate-50 px-3 py-2">
                                        <span class="flex items-center justify-center">{!! captcha_img() !!}</span>
                                    </div>
                                    <button type="button" id="reload"
                                        class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold text-white rounded-lg shadow-md bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 4v6h6M20 20v-6h-6M5 19a8 8 0 0111-11l2 2M19 5a8 8 0 01-11 11l-2-2" />
                                        </svg>
                                        Refresh
                                    </button>
                                </div>
                                <input type="text" id="captcha" name="captcha" required
                                    class="w-full px-4 py-3 text-slate-900 placeholder:text-slate-400 bg-slate-50 border border-slate-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition
                                    @error('captcha') border-red-500 ring-red-200 focus:ring-red-200 @enderror"
                                    placeholder="Enter the characters shown">
                                @error('captcha')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between text-xs text-slate-500">
                                <span class="hidden sm:inline">Use your official email and password.</span>
                                <a href="#" id="forgot-pass" class="font-semibold text-slate-700 hover:text-sky-600">Need
                                    help?</a>
                            </div>

                            <button type="submit"
                                class="w-full py-3 text-base font-semibold text-white transition rounded-xl shadow-lg bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 hover:shadow-xl hover:translate-y-[-1px] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                Secure Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reloadBtn = document.getElementById("reload");
            if (reloadBtn) {
                reloadBtn.addEventListener("click", function() {
                    fetch("reload-captcha")
                        .then(response => response.json())
                        .then(data => {
                            const captcha = document.querySelector(".captcha span");
                            if (captcha) {
                                captcha.innerHTML = data.captcha;
                            }
                        })
                        .catch(error => console.error("Error loading captcha:", error));
                });
            }

            const helpLink = document.getElementById("forgot-pass");
            if (helpLink) {
                helpLink.addEventListener("click", function(e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'Contact helpdesk',
                        text: 'Please contact the DBT portal helpdesk to reset your password at Phone: (+91) 9863771513 / 9863584223 or Email: dbtnagaland(AT)gmail(DOT)com'
                    });
                });
            }
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("login-form");
            if (!form) return;

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                const uniqueId = Math.random().toString(36).substring(7);
                localStorage.setItem("uniqueId", uniqueId);

                const emailInput = document.getElementById("email");
                const passwordInput = document.getElementById("password");
                const uniqueInput = document.getElementById("uniqueId");

                const email = emailInput ? emailInput.value : '';
                const password = passwordInput ? passwordInput.value : '';

                if (uniqueInput) {
                    uniqueInput.value = await JsAesPhp.encrypt(uniqueId, '{{ session()->getId() }}');
                }
                if (emailInput) {
                    emailInput.value = await JsAesPhp.encrypt(email, '{{ session()->getId() }}');
                }
                if (passwordInput) {
                    passwordInput.value = await JsAesPhp.encrypt(password, '{{ session()->getId() }}');
                }

                this.submit();
            });
        });
    </script>
</x-guest-layout>
