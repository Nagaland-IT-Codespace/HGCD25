<x-page-layout>
    {{-- start of hero section --}}
    <div
        class="max-w-screen-2xl mx-auto pt-10 bg-gradient-to-r from-[#327b5d] via-[#047A56] to-[#047A56] rounded-3xl mt-10 z-0 relative shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-5 pb-14 md:p-20">
                <h1 class="text-4xl md:text-6xl text-gray-100 font-semibold">Right to Information (RTI) <br>
                    Portal
                </h1>
                <p class="text-gray-200 text-md mt-5"><b>The Right to Information (RTI)</b> empowers citizens to
                    access
                    government records, promoting transparency and accountability. It ensures that individuals can
                    request information from public authorities to enhance governance and uphold democratic rights.
                </p>
                <a href="{{ route('register') }}"
                    class="bg-gray-50 inline-block hover:bg-gray-100 rounded-md px-8 py-3 text-sm text-dark font-semibold uppercase mt-10"><i
                        class="bi bi-hand-index-thumb"></i> File
                    RTI</a>
            </div>
            <div class="md:flex items-end hidden">
                <img src="{{ asset('assets/img/rti_img2.jpg') }}" alt="" class="h-[500px] ml-20">
            </div>
        </div>
    </div>
    <div class="bg-gray-100 pb-4 pt-24 mt-[-80px] z-0 border-y">
        <div class="container m-auto md:mb-14 ">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-10">
                <!-- Card 1 -->
                <a class="relative p-5 bg-gray-50 shadow-lg hover:bg-gray-100 rounded-md border overflow-hidden block"
                    href="#">
                    <i class="bi bi-person-badge absolute right-4 top-4 text-gray-600 text-6xl"></i>
                    <!-- Content -->
                    <h1 class="font-semibold text-lg text-emerald-600 uppercase mt-2">Nodal Contacts</h1>
                    <p class="text-xs text-gray-500">RTI Nodal Officers</p>
                </a>

                <!-- Card 2 -->
                <a class="relative p-5 bg-gray-50 shadow-lg hover:bg-gray-100 rounded-md border overflow-hidden block"
                    href="#">
                    <i class="bi bi-newspaper absolute right-4 top-4 text-gray-600 text-6xl"></i>
                    <h1 class="font-semibold text-lg uppercase mt-2 text-emerald-600">RTI Rules</h1>
                    <p class="text-xs text-gray-500">Download the RTI Rules</p>
                </a>

                <!-- Card 3 -->
                <a class="relative p-5 bg-gray-50 shadow-lg hover:bg-gray-100 rounded-md border overflow-hidden block"
                    href="#">
                    <i class="bi bi-file-ruled absolute right-4 top-4 text-gray-600 text-6xl"></i>
                    <h1 class="font-semibold text-lg uppercase mt-2 text-emerald-600">How to Guide</h1>
                    <p class="text-xs text-gray-500">How to Apply Online RTI</p>
                </a>

                <!-- Card 4 -->
                <a class="relative p-5 bg-gray-50 shadow-lg hover:bg-gray-100 rounded-md border overflow-hidden block"
                    href="#">
                    <i class="bi bi-question-diamond absolute right-4 top-4 text-gray-600 text-6xl"></i>
                    <h1 class="font-semibold text-lg uppercase mt-2 text-emerald-600">Grievances</h1>
                    <p class="text-xs text-gray-500">CPGRAMS</p>
                </a>
            </div>

        </div>
    </div>


    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 md:py-20 md:px-10">
                <h1 class="text-4xl md:text-6xl text-gray-800 font-semibold title">About <span
                        class="text-emerald-600">RTI</span></h1>
                <p class="text-gray-500 text-md mt-5">The Right to Information (RTI) Act, 2005 empowers Indian
                    citizens to access government records, promoting transparency and accountability. It allows
                    individuals to request information from public authorities, ensuring that government actions
                    remain open to scrutiny. Exceptions exist for national security and personal privacy, but
                    overall, RTI strengthens democracy by reducing corruption and encouraging informed participation
                    in governance.
                </p>
                <ul class="text-gray-500 mt-5">
                    <li class="flex justify-between gap-4 my-3">
                        <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>
                        Access to Government Information: Citizens can request information from public authorities,
                        ensuring transparency.
                    </li>
                    <li class="flex justify-between gap-4 my-3">
                        <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>Response Time Limit:
                        Authorities must respond within 30 days (or 48 hours in urgent cases
                        related to life and liberty).
                    </li>

                    <li class="flex justify-between gap-4 my-3">
                        <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>Exemptions for Sensitive
                        Information: Certain information related to national security,
                        privacy, and confidential matters is exempt.
                    </li>

                    <li class="flex justify-between gap-4 my-3">
                        <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>Empowers Citizens & Reduces
                        Corruption: Encourages accountability in governance and helps
                        expose corruption or inefficiencies.
                    </li>
                </ul>
                <a href="{{ route('register') }}"
                    class="bg-emerald-600 inline-block hover:bg-emerald-700 text-white rounded-md px-8 py-3 text-sm text-dark font-semibold uppercase mt-10"><i
                        class="bi bi-hand-index-thumb"></i> File
                    RTI</a>
            </div>
            <div class="md:block hidden mt-24">
                <img src="{{ asset('assets/img/glass-rti.jpg') }}" alt="" class="h-[600px] ml-40 rounded-lg">
            </div>
        </div>
    </div>
</x-page-layout>
