<div class="p-6">
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @forelse($photos as $photo)
            <div class="group relative">
                <div class="aspect-square overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                    <img src="{{ asset('storage/' . $photo->photo_url) }}"
                         class="h-full w-full object-cover transition duration-300 group-hover:scale-110">

                    <a href="{{ asset('storage/' . $photo->photo_url) }}" target="_blank"
                       class="absolute inset-0 flex items-center justify-center bg-slate-900/40 opacity-0 transition group-hover:opacity-100">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                        </svg>
                    </a>
                </div>
                <div class="mt-2 text-[10px] text-slate-500 flex justify-between items-center px-1">
                    <span>{{ $photo->created_at->format('d M, H:i') }}</span>
                    <span class="bg-slate-100 px-1.5 py-0.5 rounded uppercase font-bold">{{ $photo->verified_by }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400">
                <p>No photos available for this assignment.</p>
            </div>
        @endforelse
    </div>

    @if($assignment->remarks)
        <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Latest Remarks</h4>
            <p class="text-sm text-slate-700">{{ $assignment->remarks }}</p>
        </div>
    @endif
</div>
