<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="bi bi-pie-chart-fill text-gray-700"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <i class="bi bi-calendar3-range-fill text-gray-400"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Settings</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('manageDistricts') }}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">
                            Manage Districts</a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</aside>
