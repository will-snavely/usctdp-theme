<div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-6 py-12">
  {{-- We use an SVG wrapper for the whole motto to ensure layout stability --}}
  <svg viewBox="0 0 600 60" class="w-full max-w-3xl h-auto overflow-visible">
    <style>
      .motto-word {
        font-family: 'YourChosenFont', sans-serif;
        font-weight: 800;
        font-size: 40px;
        fill: #1e293b; /* slate-800 */
        text-transform: uppercase;
        letter-spacing: 0.1em;
        opacity: 0;
        animation: subtleFadeIn 0.6s cubic-bezier(0.21, 0.6, 0.35, 1) forwards;
      }

      .motto-dot {
        fill: #5c88da; /* Your cornflower blue */
      }

      @keyframes subtleFadeIn {
        from {
          opacity: 0;
          transform: translateY(10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* Staggering the timing: subtle and fast */
      .word-1 { animation-delay: 0.1s; }
      .word-2 { animation-delay: 0.25s; }
      .word-3 { animation-delay: 0.4s; }
    </style>

    {{-- Word 1 --}}
    <text x="0" y="45" class="motto-word word-1">
      Belong<tspan class="motto-dot">.</tspan>
    </text>

    {{-- Word 2 --}}
    <text x="210" y="45" class="motto-word word-2">
      Become<tspan class="motto-dot">.</tspan>
    </text>

    {{-- Word 3 --}}
    <text x="430" y="45" class="motto-word word-3">
      Believe<tspan class="motto-dot">.</tspan>
    </text>
  </svg>
</div>
