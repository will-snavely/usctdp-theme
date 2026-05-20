{{--
Template Name: Staff Archive
Description: Staff directory page.

Variables injected by App\View\Composers\StaffArchiveComposer:
$staff array View-ready staff member arrays
--}}

@extends('layouts.app')

@php
    $hotspot_radius = 87;
@endphp
@section('content')
    <section class="staff-archive">
        <div class="staff-archive__teamimage">
            <div class="team-image-container">
                <img src="{{ Vite::asset('resources/images/ourteam.webp') }}" alt="Our Team" class="base-image">
                <img src="{{ Vite::asset('resources/images/ourteam_motto.svg') }}" alt="Belong, Become, Believe"
                    class="motto-overlay">
                <svg class="svg-overlay" viewBox="0 0 1600 600" xmlns="http://www.w3.org/2000/svg">
                    <a href="doug-addington">
                        <circle class="biohotspot" cx="219.15" cy="123.28" r="87" data-quote="q1" />
                    </a>
                    <a href="sean-boehm">
                        <circle class="biohotspot" cx="463.36" cy="98.88" r="87" data-quote="q2" />
                    </a>
                    <a href="holly-chomyn">
                        <circle class="biohotspot" cx="705.88" cy="107.86" r="87" data-quote="q3" />
                    </a>
                    <a href="ryan-taucher">
                        <circle class="biohotspot" cx="924.23" cy="107.98" r="87" data-quote="q4" />
                    </a>
                    <a href="janis-finn">
                        <circle class="biohotspot" cx="1132.13" cy="104.31" r="87" data-quote="q5" />
                    </a>
                    <a href="chad-brown">
                        <circle class="biohotspot" cx="1335.58" cy="101.36" r="87" data-quote="q6" />
                    </a>
                    <a href="sandra-viehoever">
                        <circle class="biohotspot" cx="132.31" cy="290.35" r="87" data-quote="q7" />
                    </a>
                    <a href="mike-lucente">
                        <circle class="biohotspot" cx="339" cy="263.16" r="87" data-quote="q8" />
                    </a>
                    <a href="augie-garofoli">
                        <circle class="biohotspot" cx="571.85" cy="245.35" r="87" data-quote="q9" />
                    </a>
                    <a href="janice-irwin">
                        <circle class="biohotspot" cx="818.33" cy="281.74" r="87" data-quote="q10" />
                    </a>
                    <a href="lance-falce">
                        <circle class="biohotspot" cx="1036.03" cy="258.71" r="87" data-quote="q11" />
                    </a>
                    <a href="ray-halackna">
                        <circle class="biohotspot" cx="1233.43" cy="250.06" r="87" data-quote="q12" />
                    </a>
                    <a href="marcy-bruce">
                        <circle class="biohotspot" cx="1422.30" cy="265.81" r="87" data-quote="q13" />
                    </a>
                    <g id="q1" class="quote-grp transparent" transform="translate(290, 80)">
                        <rect class="quote-rect" width="400" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" xml:space="preserve" x="40" y="30">
                            <tspan x="40" y="30">Don't give up.</tspan>
                            <tspan x="40" y="63.3">It's out there if you want it.</tspan>
                        </text>
                        <text class="quote-name" x="183.5" y="116.7">Doug Addington</text>
                    </g>
                    <g id="q2" class="quote-grp transparent" transform="translate(540,50)">
                        <rect class="quote-rect" width="468" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" xml:space="preserve" x="40" y="30">
                            <tspan x="40" y="30">Focus on the process and the </tspan>
                            <tspan x="40" y="63.3">results will speak for themselves.</tspan>
                        </text>
                        <text class="quote-name" x="183.5" y="116.7">Sean Boehm</text>
                    </g>
                    <g id="q3" class="quote-grp transparent" transform="translate(790,60)">
                        <rect class="quote-rect" width="538" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">I have a deep passion for learning,</tspan>
                            <tspan x="40" y="63.3">teaching, and playing the game of tennis.</tspan>
                        </text>
                        <text class="quote-name" x="347.5" y="116.7">Holly Chomyn</text>
                    </g>
                    <g id="q4" class="quote-grp transparent" transform="translate(1000,60)">
                        <rect class="quote-rect" width="368.14703" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" xml:space="preserve" x="40" y="30">
                            <tspan x="40" y="30">If you win, say nothing.</tspan>
                            <tspan x="40" y="63.3">If you lose, say even less.</tspan>
                        </text>
                        <text class="quote-name" x="185.5" y="116.7">Ryan Taucher</text>
                    </g>
                    <g id="q5" class="quote-grp transparent" transform="translate(1210,60)">
                        <rect class="quote-rect" width="368.14703" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">I'm at my best when</tspan>
                            <tspan x="40" y="63.3">I'm helping others.</tspan>
                        </text>
                        <text class="quote-name" x="225.5" y="116.7">Janis Finn</text>
                    </g>
                    <g id="q6" class="quote-grp transparent" transform="translate(790, 40)">
                        <rect class="quote-rect" width="468.60645" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" width="30" height="130" x="0"
                            y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">I taught myself to play and thought</tspan>
                            <tspan x="40" y="63.3">there was a decent chance I could</tspan>
                            <tspan x="40" y="96.6">teach others.</tspan>
                        </text>
                        <text class="quote-name" x="299.5" y="116.7">Chad Brown</text>
                    </g>
                    <g id="q7" class="quote-grp transparent" transform="translate(210,230)">
                        <rect class="quote-rect" width="580.09192" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" width="30" height="130" x="0"
                            y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">From Monheim to White Plains to Pittsburgh,</tspan>
                            <tspan x="40" y="63.3">tennis has played a major role in my life.</tspan>
                        </text>
                        <text class="quote-name" x="343.5" y="116.7">Sandra Viehoever</text>
                    </g>
                    <g id="q8" class="quote-grp transparent" transform="translate(420,220)">
                        <rect class="quote-rect" width="368.14706" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" width="30" height="130" x="0"
                            y="0" />
                        <text class="quote-text" xml:space="preserve" x="40" y="30">
                            <tspan x="40" y="30">Be open to being better by</tspan>
                            <tspan x="40" y="63.3">failing forward.</tspan>
                        </text>
                        <text class="quote-name" x="190.75" y="116.7">Mike Lucente</text>
                    </g>
                    <g id="q9" class="quote-grp transparent" transform="translate(650,220)">
                        <rect class="quote-rect" width="529.86224" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" width="30" height="130" x="0"
                            y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">Since I was a senior in high school,</tspan>
                            <tspan x="40" y="63.3">I knew I was meant to be a tennis coach.</tspan>
                        </text>
                        <text class="quote-name" x="336.75" y="116.7">Augie Garofoli</text>
                    </g>
                    <g id="q10" class="quote-grp transparent" transform="translate(900,240)">
                        <rect class="quote-rect" width="292.18997" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" width="30" height="130" x="0"
                            y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">To God be the glory.</tspan>
                        </text>
                        <text class="quote-name" x="128.75" y="116.7">Janice Irwin</text>
                    </g>
                    <g id="q11" class="quote-grp transparent" transform="translate(400,200)">
                        <rect class="quote-rect" width="564.16547" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" width="30" height="130" x="0"
                            y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">Asking if you have a favorite tennis player is </tspan>
                            <tspan x="40" y="63.3">like asking if you have a favorite kid.</tspan>
                        </text>
                        <text class="quote-name" x="402.75" y="116.7">Lance Falce</text>
                    </g>
                    <g id="q12" class="quote-grp transparent" transform="translate(820,180)">
                        <rect class="quote-rect" width="341.19455" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" x="40" y="30">
                            <tspan x="40" y="30">Did we get better today?</tspan>
                        </text>
                        <text class="quote-name" x="156.75" y="116.7">Ray Halackna</text>
                    </g>
                    <g id="q13" class="quote-grp transparent" transform="translate(930,200)">
                        <rect class="quote-rect" width="400" height="130" x="0" y="0" />
                        <rect class="quote-rect-border" width="30" height="130" x="0" y="0" />
                        <text class="quote-text" xml:space="preserve" x="40" y="30">
                            <tspan x="40" y="30">I hate losing more than</tspan>
                            <tspan x="40" y="63.3">I like winning.</tspan>
                        </text>
                        <text class="quote-name" x="225.75" y="116.7">Marcy Bruce</text>
                    </g>
                </svg>
                <div id="map-tooltip" class="scroll-tooltip"></div>
            </div>
        </div>

        @if (!empty($staff))
            <div class="staff-archive__grid">
                @foreach ($staff as $member)
                    @include('staff.partials.card', ['member' => $member])
                @endforeach
        </div> @else <p class="staff-archive__empty">No staff members found.</p>
        @endif
</section> @endsection