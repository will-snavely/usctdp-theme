<article @php(post_class())>
  <header>
    <h2 class="entry-title bg-blue-100">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h2>

    @include('partials.entry-meta')
  </header>
  <x-people/>
  <div class="entry-summary bg-blue-200">
    @php(the_excerpt())
  </div>
</article>
