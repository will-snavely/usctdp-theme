<div class="max-w-3xl mx-auto my-12 px-6">
    {{-- Keep every PHP directive below in the multi-line block style, not the
         single-line parenthesized shorthand -- this view mixes both forms and
         the parenthesized one silently breaks the other's output otherwise. --}}
    @php
        wc_print_notices();
    @endphp

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">
        <h2 class="text-2xl font-bold text-slate-900 mb-6 uppercase tracking-tight">My Registrations</h2>

        @php
            $byStudent = [];
            foreach ($registrations as $reg) {
                $byStudent[$reg->student_id]['name'] = $reg->student_first . ' ' . $reg->student_last;
                $byStudent[$reg->student_id]['registrations'][] = $reg;
            }
        @endphp

        @if (!$family)
            <p class="text-slate-600">We couldn't find a family account linked to your login. Please contact the
                office.</p>
        @elseif (empty($registrations))
            <p class="text-slate-500 text-sm">No registrations yet. Once you register a student for a program, it'll
                show up here.</p>
        @else
            <div class="space-y-8">
                @foreach ($byStudent as $studentGroup)
                    <div>
                        <h3 class="text-xs font-bold uppercase text-slate-500 mb-3 tracking-wide">
                            {{ $studentGroup['name'] }}</h3>
                        <div class="space-y-3">
                            @foreach ($studentGroup['registrations'] as $reg)
                                @php
                                    $statusClasses = match ($reg->registration_status) {
                                        'active' => 'bg-green-100 text-green-700',
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp
                                <div class="flex items-center justify-between border border-slate-100 rounded-xl p-4">
                                    <div>
                                        <p class="font-bold text-slate-900">{{ $reg->activity_name }}</p>
                                        <p class="text-sm text-slate-500">{{ $reg->session_name }}</p>
                                    </div>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wide px-3 py-1 rounded-full whitespace-nowrap {{ $statusClasses }}">
                                        {{ ucfirst($reg->registration_status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
