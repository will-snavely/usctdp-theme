<div>
    @if ($people->have_posts())
        <ul>
            @while ($people->have_posts()) @php($people->the_post())
                <li>
                    @hasfield('bio')
                        <p>Bio: @field('bio') </p>
                    @endfield
                </li>
            @endwhile
        </ul>
        @php(wp_reset_postdata())
    @else
        <p>No products found.</p>
    @endif
</div>