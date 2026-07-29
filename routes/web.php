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

Route::get('/programming/schedule/', fn() => view('programs.archive'))->name('programs.archive');

// Legacy audience/type URLs — redirect (301) to the unified archive with
// age_group/type as query params, preserving any other query params (e.g. level).
Route::get('/programming/juniors/', function () {
    return redirect(add_query_arg(array_merge(request()->query(), ['age_group' => 'juniors']), home_url('/programming/schedule/')), 301);
})->name('programs.juniors');

Route::get('/programming/adults/', function () {
    return redirect(add_query_arg(array_merge(request()->query(), ['age_group' => 'adults']), home_url('/programming/schedule/')), 301);
})->name('programs.adults');

Route::get('/programming/juniors/{type}/', function ($type) {
    return redirect(add_query_arg(array_merge(request()->query(), ['age_group' => 'juniors', 'type' => $type]), home_url('/programming/schedule/')), 301);
})->where('type', 'clinic|camp|tournament')->name('programs.juniors.type');

Route::get('/programming/adults/{type}/', function ($type) {
    return redirect(add_query_arg(array_merge(request()->query(), ['age_group' => 'adults', 'type' => $type]), home_url('/programming/schedule/')), 301);
})->where('type', 'clinic|cardio|tournament')->name('programs.adults.type');
