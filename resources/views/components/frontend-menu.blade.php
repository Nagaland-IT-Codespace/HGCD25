<nav>
    <ul class="hidden md:block uppercase text-sm mt-4 z-10 relative">
        <li class="inline-block px-4 py-2 font-semibold hover:text-emerald-600"><a href={{ url('/') }}>Home</a></li>
        <li class="inline-block px-4 py-2 font-semibold relative">
            <button id="aboutToggle" class="uppercase hover:text-emerald-600">
                About <i class="bi bi-chevron-down text-sm ml-2"></i>
            </button>
            <ul id="aboutDropdown"
                class="absolute bg-white text-xs shadow-sm p-3 w-[200px] mt-10 border border-gray-100 border-t-emerald-600 border-t-4 z-10 hidden">
                <li><a class="rounded-t hover:bg-gray-100 py-1 px-4 block whitespace-no-wrap rounded-md hover:text-emerald-600"
                        href="#">About Us</a></li>
                <li><a class="hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap rounded-md hover:text-emerald-600"
                        href="#">Vision</a></li>
                <li><a class="hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap rounded-md hover:text-emerald-600"
                        href="#">Mission</a></li>
                <li><a class="rounded-b hover:bg-gray-100 py-2 px-4 block whitespace-no-wrap rounded-md hover:text-emerald-600"
                        href="#">Objectives</a></li>
            </ul>
        </li>
        <li class="inline-block px-4 py-2 font-semibold hover:text-emerald-600"><a href="#">Contact</a></li>
        @auth
            <li
                class="inline-block px-4 py-2 text-gray-700 font-semibold bg-gray-100 shadow-md hover:bg-gray-200 rounded-md">
                <a href={{ route('dashboard') }} class="text-xs"><i class="bi bi-person-add mr-1"></i>Dashboard</a>
            </li>
        @else
            <li
                class="inline-block px-4 py-2 text-gray-700 border font-semibold bg-gray-100 shadow-md hover:bg-gray-200 rounded-md">
                <a href={{ route('register') }} class="text-xs"><i class="bi bi-person-add mr-1"></i>Register</a>
            </li>
            <li
                class="inline-block px-4 py-2 text-white font-semibold bg-gray-800 shadow-md hover:bg-emerald-500 rounded-md">
                <a href={{ route('login') }} class="text-xs"><i class="bi bi-box-arrow-in-right mr-1"></i>Login</a>
            </li>
        @endauth
    </ul>

    <!-- Mobile Menu -->
    <div class="h-full flex mt-4 ">
        <button id="mobileToggle">
            <i
                class="bi inline md:hidden text-3xl text-white font-semibold self-center bg-gray-900 px-2 py-1 rounded-md bg-opacity-50 bi-list"></i>
        </button>
    </div>
    <ul id="mobileMenu"
        class="absolute md:hidden left-0 top-0 bg-white text-black overflow-hidden shadow-sm border border-gray-100 p-4 w-[60%] z-10 transition-all bottom-0 hidden">
        <div class="flex">
            <img src="{{ asset('assets/img/gon-logo.png') }}" class="h-[70px]">
            <div>
                <h1 class="mt-3 ml-6 text-black font-bold uppercase leading-0 text-xl">State Portal</h1>
                <span class="text-gray-500 block font-normal ml-6 text-xs leading-0 mt-0">Government of Nagaland</span>
            </div>
        </div>
        <li>
            <hr class="my-5">
        </li>
        <li class="block px-4 py-3 text-black font-semibold"><a href={{ url('/') }}>Home</a></li>
        <li class="block px-4 py-3 text-black font-semibold relative">
            <button id="mobileAboutToggle" class="flex justify-between w-full">
                About <i class="bi bi-chevron-down text-sm ml-2"></i>
            </button>
            <ul id="mobileAboutDropdown" class="bg-white text-gray-600 p-2 hidden">
                <li><a class="rounded-t hover:bg-gray-100 py-3 px-4 block whitespace-no-wrap rounded-md"
                        href="#">About Us</a></li>
                <li><a class="hover:bg-gray-100 py-3 px-4 block whitespace-no-wrap rounded-md" href="#">Vision</a>
                </li>
                <li><a class="hover:bg-gray-100 py-3 px-4 block whitespace-no-wrap rounded-md"
                        href="#">Mission</a></li>
                <li><a class="rounded-b hover:bg-gray-100 py-3 px-4 block whitespace-no-wrap rounded-md"
                        href="#">Objectives</a></li>
            </ul>
        </li>
        <li class="block px-4 py-3 text-black font-semibold"><a href="#">Contact</a></li>
        <li class="block px-4 py-2 text-black font-semibold bg-gray-100 shadow-md hover:bg-gray-200 rounded-md">
            <a href={{ route('register') }}><i class="bi bi-person-add mr-1"></i>Register</a>
        </li>
        <li
            class="block px-4 py-2 text-white mt-3 font-semibold bg-emerald-500 shadow-md hover:bg-emerald-600 rounded-md">
            <a href={{ route('login') }}><i class="bi bi-box-arrow-in-right mr-1"></i>Login</a>
        </li>
    </ul>
</nav>
