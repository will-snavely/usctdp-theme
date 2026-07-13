{{--
Template Name: Policies
Description: Policies & Information page.
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post(); @endphp

<div class="max-w-3xl mx-auto">
  {{-- ── Photo & Media Usage ── --}}
  <section class="mb-12 animate__animated animate__fadeIn">
    <h2 class="section-heading red text-xl font-bold text-slate-800 mb-4">Photo &amp; Media Usage</h2>
    <div class="text-slate-700 leading-relaxed space-y-3">
      <p>
        By participating in USCTDP programs, participants and their families grant USCTDP permission
        to photograph and record video of activities for use in promotional and informational materials,
        including our website and social media. If you prefer to opt out, please
        <a href="/contact" class="text-[#0092be] hover:underline font-medium">contact our office</a>.
      </p>
    </div>
  </section>

  {{-- ── Communication & Privacy ── --}}
  <section class="mb-12 animate__animated animate__fadeIn" style="animation-delay: 0.05s;">
    <h2 class="section-heading orange text-xl font-bold text-slate-800 mb-4">Communication &amp; Privacy</h2>
    <div class="text-slate-700 leading-relaxed space-y-3">
      <p>
        We may occasionally use your email address to share non-promotional information relevant to your
        enrollment. You can opt out at any time by calling our office or using the unsubscribe link
        included in any email we send. We take your privacy seriously. We do not sell, rent, or
        share your email address or personal information with any third parties.
      </p>
    </div>
  </section>

  {{-- ── Registration ── --}}
  <section class="mb-12 animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
    <h2 class="section-heading green text-xl font-bold text-slate-800 mb-4">Registration</h2>
    <div class="text-slate-700 leading-relaxed space-y-3">
      <p>
        Enrollment is processed on a first-come, first-served basis. To secure your spot, registration
        must be completed at least one week before the session start date.
      </p>
      <ul class="mt-3">
        <li>Register online, by phone, or by mail.</li>
        <li>All sessions begin on Mondays.</li>
        <li>Registrations are not accepted directly from instructors — please go through the office.</li>
      </ul>
    </div>
  </section>

  {{-- ── Scheduling ── --}}
  <section class="mb-12 animate__animated animate__fadeIn" style="animation-delay: 0.15s;">
    <h2 class="section-heading yellow text-xl font-bold text-slate-800 mb-4">Scheduling</h2>
    <div class="text-slate-700 leading-relaxed space-y-3">
      <p>
        Clinics do not meet during Christmas and Easter breaks. These closures do not shorten your
        session — the total number of scheduled weeks remains the same.
      </p>
      <p>
        The following holidays result in rescheduled sessions rather than cancellations:
        Memorial Day, July 4th, Labor Day, Halloween, and Thanksgiving.
      </p>
      <p>
        In the event of weather cancellations, affected sessions will be rescheduled. For cancellation
        updates, <a href="https://www.facebook.com/tennisstclair/" target="_blank"
          class="text-[#0092be] hover:underline font-medium">follow us on Facebook</a>
        or call <a href="tel:4128317556" class="text-[#0092be] hover:underline font-medium">412-831-7556</a>.
      </p>
    </div>
  </section>

  {{-- ── Attendance ── --}}
  <section class="mb-12 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
    <h2 class="section-heading red text-xl font-bold text-slate-800 mb-4">Attendance</h2>
    <div class="rounded-xl bg-red-50 border border-red-100 px-6 py-5 text-slate-700 leading-relaxed">
      <p class="font-semibold text-slate-800 mb-1">No make-up clinics.</p>
      <p>
        Due to high student demand and limited court availability, we are unable to offer make-up
        opportunities for missed clinic sessions. We appreciate your understanding.
      </p>
    </div>
  </section>

  {{-- ── Financial Policies ── --}}
  <section class="mb-12 animate__animated animate__fadeIn" style="animation-delay: 0.25s;">
    <h2 class="section-heading green text-xl font-bold text-slate-800 mb-4">Financial Policies</h2>
    <div class="text-slate-700 leading-relaxed space-y-6">

      <div>
        <h3 class="font-bold text-slate-800 mb-2">Payment</h3>
        <ul>
          <li>Full payment is required before the session start date.</li>
          <li>A <strong>$25 monthly late fee</strong> applies to any outstanding balances.</li>
          <li>We accept Visa, Mastercard, Discover, and personal checks.</li>
        </ul>
      </div>

      <div>
        <h3 class="font-bold text-slate-800 mb-2">Family Discount</h3>
        <p>
          Families enrolling two or more members concurrently are eligible for a family discount.
          For more details, please
          <a href='/contact' class="text-[#0092be] hover:underline font-medium">contact the office</a>.
        </p>
      </div>

      <div>
        <h3 class="font-bold text-slate-800 mb-2">Refunds &amp; Credits</h3>
        <ul>
          <li>Refunds are issued only in cases of injury or illness, provided we are notified promptly.</li>
          <li>House credits are valid for one year and may be applied by any family member.</li>
        </ul>
      </div>

    </div>
  </section>

  {{-- ── Private & Semi-Private Lessons ── --}}
  <section class="mb-12 animate__animated animate__fadeIn" style="animation-delay: 0.3s;">
    <h2 class="section-heading orange text-xl font-bold text-slate-800 mb-4">Private &amp; Semi-Private Lessons</h2>
    <div class="text-slate-700 leading-relaxed space-y-3">
      <p>
        Private and semi-private instruction is available as a complement to our group clinics.
        To be eligible, junior students must be enrolled in a clinic program for a minimum of one
        day per week. Lessons must be arranged directly with your instructor — the office does not
        schedule individual lesson times.
      </p>
    </div>
  </section>

  {{-- ── Contact callout ── --}}
  <section class="mb-16 animate__animated animate__fadeIn text-center" style="animation-delay: 0.35s;">
    <div class="inline-flex items-center gap-5 rounded-2xl bg-slate-900 text-white px-8 py-5 shadow-xl">
      <div>
        <h2 class="text-xl font-black text-white uppercase tracking-tight mt-0 mb-0.5">Questions?</h2>
        <p class="text-slate-300 text-sm">Our office is happy to help.</p>
      </div>
      <a href="{{ get_permalink(get_page_by_path('contact')) ?: '/contact' }}"
        class="shrink-0 px-5 py-2.5 bg-[#0092be] hover:bg-[#007aa0] text-white font-bold rounded-xl transition-colors text-sm no-underline">
        Contact Us
      </a>
    </div>
  </section>

</div>

@endwhile
@endsection