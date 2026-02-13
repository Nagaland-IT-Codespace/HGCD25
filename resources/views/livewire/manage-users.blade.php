<div class="mx-auto py-8 px-4 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">User Directory</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage access with ease</h1>
            <p class="text-sm text-slate-500">Search, filter and update roles across the platform.</p>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-user', 'size': '4', 'title': 'Add User'}})"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 hover:shadow-xl hover:translate-y-[-1px] transition">
            <span class="text-lg">＋</span>
            Add User
        </button>
    </div>

    <div class="bg-white/80 backdrop-blur border border-slate-100 shadow-lg rounded-2xl p-4 md:p-5 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or email"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" />
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs">⌘K</span>
            </div>
            <div>
                <select wire:model.live.debounce.300ms="roleSearch"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    <option value="">All roles</option>
                    @foreach (App\Enums\RoleEnum::cases() as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if (session()->has('success'))
            <div
                class="flex items-center gap-3 text-sm text-green-800 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                <span class="text-lg">✔</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-hidden border border-slate-100 rounded-xl shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Mobile</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($users as $index => $user)
                        <tr class="hover:bg-sky-50/60">
                            <td class="px-4 py-3 text-slate-500">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $user->name }}</td>
                            <td class="px-4 py-3 font-medium text-slate-800">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $user->mobile }}
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-user', 'params' : {'userID': {{ $user->id }}}, 'size': '4', 'title': 'Edit User'}})"
                                        class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-slate-100 bg-slate-50/60">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
