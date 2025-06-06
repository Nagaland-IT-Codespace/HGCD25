<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>RTI Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
    @livewireStyles()
</head>

<body class="bg-gray-100 dark">
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="{{ url('/') }}" class="flex ms-2 md:me-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-sky-700">RTI
                            <span class="hidden font-thin md:inline text-slate-400">Dashboard</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div class="hidden md:flex">
                            <div class="flex mr-3">
                                <div class="relative inline-block">
                                    <!-- Notification Icon -->
                                    <button
                                        class="px-2 py-1 text-gray-600 transition bg-gray-200 rounded-full hover:bg-gray-300"
                                        data-dropdown-toggle="notificationDropdown">
                                        <i class="text-sm bi bi-bell"></i>
                                    </button>

                                    <!-- Small Red Notification Badge -->
                                    <span
                                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-1 -mr-1 text-xs font-semibold text-white bg-red-600 rounded-full">
                                        3
                                    </span>

                                    <div id="notificationDropdown"
                                        class="absolute right-0 z-10 hidden w-64 p-3 mt-2 bg-white rounded-lg shadow-lg">
                                        <p class="text-sm font-semibold text-gray-700">Notifications</p>
                                        <ul class="mt-2 divide-y divide-gray-200">
                                            <li class="p-2 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-100">
                                                <i class="text-blue-500 bi bi-envelope-fill"></i> New message received
                                            </li>
                                            <li class="p-2 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-100">
                                                <i class="text-green-500 bi bi-person-fill"></i> Friend request accepted
                                            </li>
                                            <li class="p-2 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-100">
                                                <i class="text-yellow-500 bi bi-check-circle-fill"></i> Task completed
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mx-3 border-l border-gray-300"></div>

                                <p class="mt-1 text-sm font-semibold text-gray-700"><i
                                        class="bi bi-universal-access-circle"></i> Accesibility </p>
                                <div class="mx-3 border-l border-gray-300"></div>
                                <button id="increaseFont-btn" type="button"
                                    class="text-sm text-gray-700 text-md">A+</button>
                                <div class="mx-3 border-l border-gray-300"></div>

                                <button id="resetFont-btn" type="button"
                                    class="text-sm text-gray-700 text-md">A-</button>
                                <div class="mx-3 border-l border-gray-300"></div>

                            </div>
                        </div>

                        <div>
                            <button type="button" class="flex text-sm rounded-full" aria-expanded="false"
                                data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <i class="text-2xl text-gray-800 bi bi-person-circle"></i>
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white border border-gray-200 divide-y divide-gray-100 rounded shadow"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-500 truncate" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                                        role="menuitem" data-modal-target="change-password"
                                        data-modal-toggle="change-password">Change password</a>
                                </li>

                                <li>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                                            role="menuitem"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">Sign
                                            out</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <x-admin-menu />
    <div class="p-4 sm:ml-64 dark ">
        <div class="p-4 rounded-lg mt-14">
            <div class="flex justify-between mb-6">
                <div>
                    <h1 class="text-xl font-semibold"><a href="{{ route('dashboard') }}"
                            class="text-gray-900">{{ $title ?? 'Dashboard' }}</a></h1>
                </div>
                <div class="breadcrumb">
                    <nav class="flex">
                        <ol class="flex list-none">
                            <li><a href="{{ route('dashboard') }}" class="text-gray-600"><i class="bi bi-house"></i>
                                    Dashboard</a>
                            </li>
                            @if (isset($title))
                                <li class="mx-2 "><i class="bi bi-chevron-right font-sm"></i></li>
                                <li><span class="text-gray-400">{{ $title }}</span></li>
                            @endif
                        </ol>
                    </nav>

                </div>
            </div>
            {{ $slot }}
        </div>
    </div>
    {{-- change password modal --}}

    @livewire('auth.change-password')

    <livewire:modals />
    <livewire:scripts />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script></script>
    @if (session('success'))
        <script>
            swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
</body>

</html>
