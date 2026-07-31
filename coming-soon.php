<?php

// Named explicitly rather than app('sage.view') - "coming-soon" isn't a WP
// conditional tag Sage's own template-hierarchy resolution knows about, so
// letting it guess would risk resolving to whatever the underlying page
// actually is (e.g. front-page) instead of this template.
//
// No app('sage.data') either - WooCommerce's coming-soon handler include()s
// this file directly (see the coming-soon_template filter in
// app/filters.php), bypassing Sage's own template_include pipeline
// entirely, so that container binding is never registered for this
// request. The view doesn't need it - it only uses plain WP functions.
echo view('coming-soon')->render();
