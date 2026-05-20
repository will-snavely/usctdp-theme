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