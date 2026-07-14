<?php

use Illuminate\Support\Facades\Route;
use App\Repositories\StaffRepository;

Route::get('/our-team/{slug}/', function ($slug) {
    $member = StaffRepository::findBySlug($slug);
    if (!$member) {
        abort(404);
    }
    return view('staff.single', compact('member'));
})->where('slug', '[a-zA-Z0-9-]+')->name('staff.single');

// ── Programming ──────────────────────────────────────────────────────────────

Route::get('/programming/juniors/', fn() => view('programs.archive', ['audience' => 'juniors', 'type' => 'clinic']))->name('programs.juniors');
Route::get('/programming/adults/', fn() => view('programs.archive', ['audience' => 'adults', 'type' => 'clinic']))->name('programs.adults');

// Type-filtered list views. URL type slug matches the filter value exactly.
Route::get('/programming/juniors/{type}/', function ($type) {
    return view('programs.archive', ['audience' => 'juniors', 'type' => $type]);
})->where('type', 'clinic|camp|tournament')->name('programs.juniors.type');

Route::get('/programming/adults/{type}/', function ($type) {
    return view('programs.archive', ['audience' => 'adults', 'type' => $type]);
})->where('type', 'clinic|cardio|tournament')->name('programs.adults.type');
