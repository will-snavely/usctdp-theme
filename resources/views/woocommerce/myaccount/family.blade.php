<div class="max-w-3xl mx-auto my-12 px-6">
    @php(wc_print_notices())

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 p-8 md:p-12">
        <h2 class="text-2xl font-bold text-slate-900 mb-6 uppercase tracking-tight">My Family</h2>

        @if (!$family)
            <p class="text-slate-600">We couldn't find a family account linked to your login. Please contact the
                office.</p>
        @else
            <div class="mb-10">
                <h3 class="text-xs font-bold uppercase text-slate-500 mb-4 tracking-wide">Students</h3>

                @if (empty($students))
                    <p class="text-slate-500 text-sm">No students added yet. Add your first student below.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($students as $student)
                            <div class="flex items-center justify-between border border-slate-100 rounded-xl p-4">
                                <div>
                                    <p class="font-bold text-slate-900">{{ $student->first }} {{ $student->last }}
                                    </p>
                                    <p class="text-sm text-slate-500">
                                        @if ($student->age !== null)
                                            {{ $student->age }} years old
                                        @else
                                            Birth date not on file
                                        @endif
                                        @if (!empty($student->level))
                                            &middot; Level {{ $student->level }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pt-8 border-t border-slate-100">
                <h3 class="text-xs font-bold uppercase text-slate-500 mb-4 tracking-wide">Add a Student</h3>

                <form method="post">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-500 mb-2">First Name</label>
                            <input type="text" name="first_name" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Last Name</label>
                            <input type="text" name="last_name" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                    </div>

                    @php($months = [
                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',
                    ])
                    @php($currentYear = (int) date('Y'))

                    <div class="mb-6">
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Birth Date</label>
                        <div class="grid grid-cols-3 gap-4">
                            <select name="birth_month" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition">
                                <option value="" disabled selected>Month</option>
                                @foreach ($months as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <select name="birth_day" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition">
                                <option value="" disabled selected>Day</option>
                                @for ($day = 1; $day <= 31; $day++)
                                    <option value="{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}">{{ $day }}</option>
                                @endfor
                            </select>
                            <input type="number" name="birth_year" inputmode="numeric" placeholder="Year"
                                min="{{ $currentYear - 100 }}" max="{{ $currentYear }}" required
                                class="w-full border border-slate-300 rounded-xl p-3 focus:border-[#5c88da] focus:ring-1 focus:ring-[#5c88da] outline-none transition" />
                        </div>
                    </div>

                    @php(wp_nonce_field('usctdp_add_student', 'usctdp_add_student_nonce'))
                    <input type="hidden" name="usctdp_add_student" value="1" />
                    <button type="submit"
                        class="w-full md:w-auto bg-[#5c88da] text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-blue-600 transition transform active:scale-95">
                        Add Student
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
