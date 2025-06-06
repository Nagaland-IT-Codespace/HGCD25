<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="RTI Portal Nagaland">
    <meta name="keywords" content="RTI, Nagaland, Government of Nagaland, Right to Information">
    <meta name="author" content="DITC Nagaland">
    <meta name="robots" content="index, follow">
    <title>RTI Portal | Nagaland</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-gray-100 hidden md:block md:px-4">
        <div class="max-w-screen-2xl mx-auto ease-out duration-900 border-b">
            <div class="bg-dark py-2 flex justify-between text-gray-600 text-sm">
                <div class="font-semibold hidden md:block">Government of Nagaland</div>
                <div class="flex gap-2 items-center">
                    <span><i class="bi bi-telephone"></i> +91 12345 67890</span> |
                    <span><i class="bi bi-envelope"></i> info@example.com</span> |
                    <div class="flex gap-2">
                        <a href="#" class="hover:text-sky-500"><i class="bi bi-globe"></i></a> |
                        <a href="#" class="hover:text-sky-500"><i class="bi bi-twitter"></i></a> |
                        <a href="#" class="hover:text-sky-500"><i class="bi bi-facebook"></i></a> |

                        <!-- Accessibility Dropdown -->
                        <div class="relative">
                            <button id="accessibilityToggle" class="hover:text-sky-500 flex items-center">
                                <i class="bi bi-universal-access"></i> <i class="bi bi-chevron-down ml-1"></i>
                            </button>

                            <div id="accessibilityDropdown"
                                class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md p-2 z-50 border hidden">
                                <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                    onclick="changeFontSize(-10)">
                                    <i class="bi bi-dash-circle"></i> Decrease Font
                                </button>
                                <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                    onclick="changeFontSize(10)">
                                    <i class="bi bi-plus-circle"></i> Increase Font
                                </button>
                                <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                    onclick="resetFont()">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reset Font
                                </button>
                                <button class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                    onclick="toggleContrast()">
                                    <i class="bi bi-eye-fill"></i> High Contrast
                                </button>
                                <a href="https://socialjustice.gov.in/screen-reader" target="_blank"
                                    class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                    <i class="bi bi-window-fullscreen"></i> Screen Readers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="max-w-screen-2xl mx-auto ease-out duration-900 w-full  px-5 md:px:0">
        <div class="py-3 flex justify-between ">
            <div class="flex">
                <img src="{{ asset('assets/img/gon-logo.png') }}" class="h-[80px]">
                <div>
                    <h1 class="mt-4 ml-6 text-gray-800 font-bold uppercase leading-0 text-3xl">State <span
                            class="text-emerald-600">RTI Portal</span>
                    </h1>
                    <span class="text-gray-600 block font-normal ml-6 text-xs leading-0 mt-0">Government of
                        Nagaland</span>
                </div>
            </div>
            <div class="text-gray-700 mt-3">
                <x-frontend-menu />
            </div>
        </div>
    </div>
    {{ $slot }}
    <section class="py-10 bg-gray-100 tribal border-y">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="px-5">
                    <div class="flex gap-5">
                        <img src="{{ asset('assets/img/gon-logo.png') }}" class="h-24">
                        <div class="pt-4">
                            <h1 class="text-gray-800 font-bold uppercase leading-0 text-2xl">State <span
                                    class="text-emerald-600">RTI Portal</span>
                            </h1>
                            <span class="text-gray-600">Government of Nagaland</span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mt-5">The Right to Information (RTI) empowers citizens to access
                        government
                        records, promoting transparency and accountability. It ensures that individuals can request
                        information from public authorities to enhance governance and uphold democratic rights.</p>
                </div>
                <div class="px-5 mt-5 md:mt-0">
                    <h1 class="text-lg text-gray-800 font-semibold title">Contact us</h1>
                    <p class="text-gray-500 text-sm leading-5 mt-3">
                        NAGALAND HEALTH PROTECTION SOCIETY,<br> 4th & 5th floor Drug Control Building, Department of
                        Health
                        and Family Welfare Below Nagaland Civil Secretariat Complex, Ruziezou, Kohima- 797 001 <br />
                        <br />
                        <b>Email: <br></b>support-nhps(AT)cmhis(DOT)nagaland(DOT)gov(DOT)in <br />
                        <b>Phone No.: </b> 1800 202 3380
                    </p>
                </div>
                <div class="px-5 pt-5 text-center">
                    <img src="{{ asset('assets/img/gon-logo.png') }}" alt="" class="h-20 mx-auto mb-4">
                    <p class="text-gray-500 text-sm">State Portal of Nagaland</p>
                    <p><a href="https://nagaland.gov.in" class="text-gray-800 font-semibold hover:underline"
                            target="_blank">nagaland.gov.in</a>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5 bg-gray-50">
        <div class="max-w-screen-xl mx-auto text-center">
            <p class="text-gray-500 text-xs">
                For best experience view site in 1024 X 1080 resolution. Supports all modern browsers Chrome v84+,
                Safari 4+, Mozilla Firefox v90+. <br>

                The CMHIS Portal is W3C, GIGW and WCAG 2.0 compliant <br><br>
                Copyright © <?php echo date('Y'); ?> <span class="text-gray-800">Government of Nagaland. </span>All Rights
                Reserved.
                Developed by the <a href="https://ditc.nagaland.gov.in"
                    class="text-gray-800 font-semibold hover:underline" target="_blank">Department of Information
                    Technology & Communication:
                    Nagaland</a>
            </p>
        </div>
    </section>
</body>

</html>
