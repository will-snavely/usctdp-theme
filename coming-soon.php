<?php

// Named explicitly rather than app('sage.view') - "coming-soon" isn't a WP
// conditional tag Sage's own template-hierarchy resolution knows about, so
// letting it guess would risk resolving to whatever the underlying page
// actually is (e.g. front-page) instead of this template.
echo view('coming-soon', app('sage.data'))->render();
