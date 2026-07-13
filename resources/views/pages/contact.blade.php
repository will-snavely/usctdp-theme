{{--
  Template Name: Contact
  Description: Contact page with office details, social links, and email form.

  Form submission is handled via WordPress admin-post.php.
  Register the action in your theme's functions.php or a dedicated action class:
    add_action('admin_post_nopriv_contact_form', 'handle_contact_form');
    add_action('admin_post_contact_form', 'handle_contact_form');
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post(); @endphp

<div class="contact-page space-y-12">

  {{-- ── Contact Details + Social ── --}}
  <section class="animate__animated animate__fadeIn">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

      {{-- Office Details --}}
      <div class="space-y-5">
        <h2 class="section-heading green text-2xl font-bold text-slate-800">
          Get in Touch
        </h2>

        <ul class="space-y-4 text-slate-700 text-sm">
          <li class="flex items-start gap-3">
            {{-- Location icon --}}
            <svg class="w-5 h-5 mt-0.5 shrink-0 text-[#0092be]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>
            <span>
              [Address placeholder]<br>
              Upper St. Clair, PA
            </span>
          </li>

          <li class="flex items-center gap-3">
            {{-- Phone icon --}}
            <svg class="w-5 h-5 shrink-0 text-[#0092be]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 6.75Z"/>
            </svg>
            <a href="tel:+14128312630" class="hover:text-[#0092be] transition-colors">(412) 831-2630</a>
          </li>

          <li class="flex items-center gap-3">
            {{-- Email icon --}}
            <svg class="w-5 h-5 shrink-0 text-[#0092be]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
            </svg>
            <a href="mailto:info@usctdp.com" class="hover:text-[#0092be] transition-colors">info@usctdp.com</a>
          </li>
        </ul>
      </div>

      {{-- Social Media --}}
      <div class="space-y-5">
        <h2 class="section-heading orange text-2xl font-bold text-slate-800">
          Follow Us
        </h2>

        <div class="flex gap-5">
          {{-- Facebook --}}
          <a href="https://www.facebook.com/tennisstclair/" target="_blank" rel="noopener"
             class="flex items-center gap-2 text-slate-600 hover:text-[#1877F2] transition-colors text-sm font-medium"
             aria-label="Follow us on Facebook">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            Facebook
          </a>

          {{-- Instagram --}}
          <a href="https://www.instagram.com/usctdp/" target="_blank" rel="noopener"
             class="flex items-center gap-2 text-slate-600 hover:text-[#E4405F] transition-colors text-sm font-medium"
             aria-label="Follow us on Instagram">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
            Instagram
          </a>
        </div>
      </div>

    </div>
  </section>

  {{-- ── Contact Form ── --}}
  <section class="animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
    <h2 class="section-heading yellow text-2xl font-bold text-slate-800 mb-6">
      Send Us a Message
    </h2>

    @if(session('contact_success'))
      <div class="mb-6 px-5 py-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm" role="alert">
        Thank you for reaching out! We'll get back to you as soon as possible.
      </div>
    @endif

    @if(session('contact_error'))
      <div class="mb-6 px-5 py-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm" role="alert">
        Something went wrong. Please try again or email us directly at
        <a href="mailto:info@usctdp.com" class="underline">info@usctdp.com</a>.
      </div>
    @endif

    <form
      method="POST"
      action="{{ admin_url('admin-post.php') }}"
      class="space-y-5"
      novalidate
    >
      @php(wp_nonce_field('contact_form_submit', 'contact_nonce'))
      <input type="hidden" name="action" value="contact_form">

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div class="flex flex-col gap-1.5">
          <label for="contact-name" class="text-sm font-semibold text-slate-700">
            Name <span class="text-red-500" aria-hidden="true">*</span>
          </label>
          <input
            id="contact-name"
            type="text"
            name="contact_name"
            required
            autocomplete="name"
            class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400
                   focus:outline-none focus:ring-2 focus:ring-[#0092be] focus:border-transparent transition"
            placeholder="Your full name"
          >
        </div>

        <div class="flex flex-col gap-1.5">
          <label for="contact-email" class="text-sm font-semibold text-slate-700">
            Email <span class="text-red-500" aria-hidden="true">*</span>
          </label>
          <input
            id="contact-email"
            type="email"
            name="contact_email"
            required
            autocomplete="email"
            class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400
                   focus:outline-none focus:ring-2 focus:ring-[#0092be] focus:border-transparent transition"
            placeholder="you@example.com"
          >
        </div>
      </div>

      <div class="flex flex-col gap-1.5">
        <label for="contact-subject" class="text-sm font-semibold text-slate-700">
          Subject
        </label>
        <input
          id="contact-subject"
          type="text"
          name="contact_subject"
          autocomplete="off"
          class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400
                 focus:outline-none focus:ring-2 focus:ring-[#0092be] focus:border-transparent transition"
          placeholder="What's this about?"
        >
      </div>

      <div class="flex flex-col gap-1.5">
        <label for="contact-message" class="text-sm font-semibold text-slate-700">
          Message <span class="text-red-500" aria-hidden="true">*</span>
        </label>
        <textarea
          id="contact-message"
          name="contact_message"
          required
          rows="6"
          class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400
                 focus:outline-none focus:ring-2 focus:ring-[#0092be] focus:border-transparent transition resize-y"
          placeholder="How can we help you?"
        ></textarea>
      </div>

      <div>
        <button
          type="submit"
          class="px-8 py-3 bg-[#0092be] hover:bg-[#007aa0] text-white font-semibold rounded-xl
                 transition-colors shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0092be]"
        >
          Send Message
        </button>
      </div>
    </form>
  </section>

</div>

@endwhile
@endsection
