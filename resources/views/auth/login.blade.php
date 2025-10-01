<x-guest-layout>
    <div class="w-full max-w-md p-8 m-auto bg-white rounded-lg shadow-lg">
        <a href="{{ URL('/') }}">
            <div class="flex mb-3">
                <img src="{{ asset('assets/img/gon-logo.png') }}" class="h-[80px]">
                <div>
                    <h1 class="mt-4 ml-4 font-bold text-gray-800 uppercase leading-0 text-LG">HGCD & SDRF <span
                            class="text-gray-800">Smart</span> App
                    </h1>
                    <span class="block mt-0 ml-4 text-sm font-normal text-gray-500 leading-0">Government of
                        Nagaland</span>
                </div>
            </div>
        </a>
        <hr>
        <div class="my-5 text-center">
            <h4 class="font-semibold text-sky-700 text-md">LOGIN</h4>
        </div>
        <form action="{{ route('login') }}" method="post" class="mt-5 space-y-4" id="login-form">
            @csrf
            <input type="hidden" name="uniqueId" id="uniqueId">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email <span
                        class="text-red-500">*</span></label>
                <input type="text" id="email" name="email" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500
                    @error('email') border-red-500 @enderror"
                    placeholder="Email" autocomplete="off">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password <span
                        class="text-red-500">*</span></label>
                <input type="password" id="password" name="password" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500
                    @error('password') border-red-500 @enderror"
                    placeholder="Your Password" autocomplete="off">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center space-x-2">
                <div class="captcha">
                    <span>{!! captcha_img() !!}</span>
                </div>
                <button type="button" id="reload"
                    class="px-3 py-2 text-white transition rounded-lg shadow-md bg-sky-500 hover:bg-sky-600">
                    ↻
                </button>
            </div>

            <div>
                <input type="text" id="captcha" name="captcha" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500
                    @error('captcha') border-red-500 @enderror"
                    placeholder="Enter Captcha">
                @error('captcha')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="flex items-center justify-between text-sm">
                <a href="{{ route('register') }}" class="font-medium text-sky-500 hover:underline">Not registered?
                    <b>Click here to register</b></a>
                <a href="#" class="text-gray-500 hover:underline" id="forgot-pass">Forgot Password?</a>
            </div> --}}

            <button type="submit"
                class="w-full px-4 py-2 font-bold text-white transition rounded-lg shadow-md bg-sky-600 hover:bg-sky-700">
                Log In
            </button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("reload").addEventListener("click", function() {
                fetch("reload-captcha")
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector(".captcha span").innerHTML = data.captcha;
                    })
                    .catch(error => console.error("Error loading captcha:", error));
            });
            document.getElementById("forgot-pass").addEventListener("click", function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Contact helpdesk',
                    text: 'Please contact the DBT portal helpdesk to reset your password at Phone: (+91) 9863771513 / 9863584223 or Email: dbtnagaland(AT)gmail(DOT)com'
                });
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("login-form").addEventListener("submit", async function(e) {
                e.preventDefault();

                var uniqueId = Math.random().toString(36).substring(7);
                localStorage.setItem("uniqueId", uniqueId);

                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;

                document.getElementById("uniqueId").value = await JsAesPhp.encrypt(uniqueId,
                    '{{ session()->getId() }}');
                document.getElementById("email").value = await JsAesPhp.encrypt(email,
                    '{{ session()->getId() }}');
                document.getElementById("password").value = await JsAesPhp.encrypt(password,
                    '{{ session()->getId() }}');

                console.log(document.getElementById("uniqueId").value);
                console.log('{{ session()->getId() }}');

                this.submit();
            });
        });
    </script>
</x-guest-layout>
