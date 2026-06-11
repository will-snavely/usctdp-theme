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

Route::get('/programming/adults/', function () {
    return view('programs.archive', ['audience' => 'adults']);
})->name('programs.archive');

Route::get('/programming/juniors/', function () {
    return view('programs.archive', ['audience' => 'juniors']);
})->name('programs.archive');
