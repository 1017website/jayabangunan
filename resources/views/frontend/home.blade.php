<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  {{-- SEO Dynamic --}}
  @php $seo = \App\Models\Setting::getGroup('seo'); @endphp
  <title>{{ $seo['seo_title'] ?? ($company['company_name'] ?? 'Jaya Bangun Konstruksi') }}</title>
  <meta name="description" content="{{ $seo['seo_description'] ?? ($company['company_tagline'] ?? '') }}">
  @if(!empty($seo['seo_keywords']))
    <meta name="keywords" content="{{ $seo['seo_keywords'] }}">
  @endif
  <meta name="robots" content="{{ $seo['seo_robots'] ?? 'index, follow' }}">
  @if(!empty($seo['seo_canonical']))
    <link rel="canonical" href="{{ $seo['seo_canonical'] }}">
  @endif

  {{-- Open Graph --}}
  <meta property="og:type" content="{{ $seo['seo_og_type'] ?? 'website' }}">
  <meta property="og:title" content="{{ $seo['seo_title'] ?? ($company['company_name'] ?? '') }}">
  <meta property="og:description" content="{{ $seo['seo_description'] ?? '' }}">
  <meta property="og:url" content="{{ url('/') }}">
  @if(!empty($seo['seo_og_image']))
    <meta property="og:image" content="{{ $seo['seo_og_image'] }}">
  @endif

  {{-- Twitter Card --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $seo['seo_title'] ?? '' }}">
  <meta name="twitter:description" content="{{ $seo['seo_description'] ?? '' }}">
  @if(!empty($seo['seo_og_image']))
    <meta name="twitter:image" content="{{ $seo['seo_og_image'] }}">
  @endif

  {{-- Google Verification --}}
  @if(!empty($seo['seo_google_verification']))
    <meta name="google-site-verification" content="{{ $seo['seo_google_verification'] }}">
  @endif

  <link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Instrument+Serif:ital@0;1&display=swap"
    rel="stylesheet">

  {{-- Google Analytics --}}
  @if(!empty($seo['seo_google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo['seo_google_analytics'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());
      gtag('config', '{{ $seo['seo_google_analytics'] }}');
    </script>
  @endif

  {{-- Google Tag Manager --}}
  @if(!empty($seo['seo_google_tag_manager']))
    <script>(function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
          'gtm.start':
            new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', '{{ $seo['seo_google_tag_manager'] }}');</script>
  @endif

  {{-- Meta Pixel --}}
  @if(!empty($seo['seo_meta_pixel']))
    <script>
      !function (f, b, e, v, n, t, s) {
        if (f.fbq) return; n = f.fbq = function () {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        }; if (!f._fbq) f._fbq = n;
        n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0;
        t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '{{ $seo['seo_meta_pixel'] }}');
      fbq('track', 'PageView');

      // ViewContent — saat halaman selesai dimuat
      fbq('track', 'ViewContent', {
        content_name: '{{ $seo['seo_title'] ?? ($company['company_name'] ?? '') }}',
        content_category: 'Konstruksi',
        content_type: 'website'
      });
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id={{ $seo['seo_meta_pixel'] }}&ev=PageView&noscript=1" />
    </noscript>
  @endif

  <style>
    :root {
      --red: #8B0000;
      --red2: #A80000;
      --red3: #C0001C;
      --white: #FFFFFF;
      --off: #F7F5F2;
      --dark: #111111;
      --gray: #6B6B6B;
      --lgray: #C8C4BE;
      --border: rgba(0, 0, 0, 0.09);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Outfit', sans-serif;
      background: var(--white);
      color: var(--dark);
      overflow-x: hidden;
    }

    html,
    body {
      overflow-x: hidden;
      max-width: 100%;
    }

    .cursor {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--red3);
      position: fixed;
      pointer-events: none;
      z-index: 9999;
      transition: transform 0.15s, width 0.3s, height 0.3s;
      transform: translate(-50%, -50%);
    }

    .cursor-ring {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: 1.5px solid rgba(139, 0, 0, 0.4);
      position: fixed;
      pointer-events: none;
      z-index: 9998;
      transform: translate(-50%, -50%);
      transition: transform 0.08s linear, width 0.3s, height 0.3s, border-color 0.3s;
    }

    #preloader {
      position: fixed;
      inset: 0;
      z-index: 10000;
      background: var(--dark);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      gap: 24px;
      transition: opacity 0.6s, visibility 0.6s;
    }

    #preloader.hide {
      opacity: 0;
      visibility: hidden;
    }

    .pre-logo {
      width: 180px;
      opacity: 0;
      animation: fadeIn 0.6s 0.3s forwards;
    }

    .pre-bar-wrap {
      width: 200px;
      height: 2px;
      background: rgba(255, 255, 255, 0.1);
      overflow: hidden;
    }

    .pre-bar {
      height: 100%;
      background: var(--red3);
      width: 0;
      animation: load 1.4s 0.5s ease forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    @keyframes load {
      to {
        width: 100%;
      }
    }

    #progress {
      position: fixed;
      top: 0;
      left: 0;
      height: 2px;
      background: var(--red3);
      z-index: 9999;
      transition: width 0.1s;
      width: 0%;
    }

    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 52px;
      transition: background 0.4s, box-shadow 0.4s;
    }

    nav.scrolled {
      background: rgba(255, 255, 255, 0.97);
      box-shadow: 0 1px 0 var(--border);
      backdrop-filter: blur(12px);
    }

    .nav-brand {
      display: flex;
      align-items: center;
      text-decoration: none;
      flex-shrink: 0;
    }

    .nav-logo-white {
      height: 33px;
      width: auto;
      display: block;
      transition: opacity 0.3s;
    }

    .nav-logo-red {
      height: 33px;
      width: auto;
      display: none;
      transition: opacity 0.3s;
    }

    nav.scrolled .nav-logo-white {
      display: none;
    }

    nav.scrolled .nav-logo-red {
      display: block;
    }

    .nav-links {
      display: flex;
      gap: 0;
      list-style: none;
    }

    .nav-links a {
      color: rgba(255, 255, 255, 0.85);
      text-decoration: none;
      font-size: 13px;
      font-weight: 500;
      padding: 0 18px;
      height: 70px;
      display: flex;
      align-items: center;
      letter-spacing: 0.2px;
      transition: color 0.2s;
      position: relative;
    }

    nav.scrolled .nav-links a {
      color: var(--dark);
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 18px;
      right: 18px;
      height: 2px;
      background: var(--red3);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s;
    }

    .nav-links a:hover {
      color: #fff;
    }

    nav.scrolled .nav-links a:hover {
      color: var(--red2);
    }

    .nav-links a:hover::after,
    .nav-links a.active::after {
      transform: scaleX(1);
    }

    nav.scrolled .nav-links a.active {
      color: var(--red2);
    }

    .nav-wa {
      background: #25D366;
      color: #fff;
      padding: 10px 22px;
      border-radius: 4px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.3px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background 0.2s, transform 0.2s;
      white-space: nowrap;
      flex-shrink: 0;
    }

    .nav-wa:hover {
      background: #1ebe5d;
      transform: translateY(-1px);
    }

    .nav-wa .wa-label {
      display: inline;
    }

    @media(max-width: 900px) {
      nav {
        padding: 0 16px;
        max-width: 100vw;
        box-sizing: border-box;
      }

      .nav-brand img {
        height: 28px;
      }

      .nav-wa {
        width: 40px;
        height: 40px;
        min-width: 40px;
        padding: 0;
        border-radius: 50%;
        justify-content: center;
        flex-shrink: 0;
      }

      .nav-wa .wa-label {
        display: none;
      }

      .nav-wa svg {
        width: 18px;
        height: 18px;
      }
    }

    @media(max-width: 900px) {
      footer {
        padding: 60px 24px 0;
      }

      .footer-grid {
        grid-template-columns: 1fr;
        gap: 32px;
      }

      .footer-tagline {
        max-width: 100%;
      }

      .footer-bottom {
        flex-direction: column;
        gap: 8px;
        text-align: center;
        padding: 20px 0;
      }
    }

    @media(max-width:900px) {

      html,
      body {
        overflow-x: hidden;
        max-width: 100%;
      }

      nav {
        padding: 0 16px;
        box-sizing: border-box;
      }

      .nav-links {
        display: none;
      }

      .nav-brand img {
        height: 28px;
      }

      .nav-wa {
        width: 40px;
        height: 40px;
        min-width: 40px;
        padding: 0;
        border-radius: 50%;
        justify-content: center;
        flex-shrink: 0;
        gap: 0;
      }

      .nav-wa .wa-label {
        display: none;
      }

      .hero-content {
        grid-template-columns: 1fr;
        padding: 100px 24px 60px;
      }

      .hero-card {
        display: none;
      }

      .sec {
        padding: 70px 24px;
      }

      .about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .about-imgs {
        height: 300px;
      }

      .svc-layout {
        grid-template-columns: 1fr;
      }

      .svc-grid {
        grid-template-columns: 1fr;
      }

      .proj-mosaic {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
      }

      .pm-item:nth-child(1),
      .pm-item:nth-child(2),
      .pm-item:nth-child(3),
      .pm-item:nth-child(4) {
        grid-column: span 1;
        grid-row: span 1;
        height: 220px;
      }

      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      #stats {
        padding: 60px 24px;
      }

      .process-steps {
        grid-template-columns: 1fr;
        gap: 32px;
      }

      .process-steps::before {
        display: none;
      }

      .testi-grid {
        grid-template-columns: 1fr;
      }

      #contact .sec-inner {
        grid-template-columns: 1fr;
      }

      footer {
        padding: 60px 24px 0;
      }

      .footer-grid {
        grid-template-columns: 1fr !important;
        gap: 32px;
      }

      .footer-tagline {
        max-width: 100%;
      }

      .footer-bottom {
        flex-direction: column;
        gap: 8px;
        text-align: center;
        padding: 20px 0;
      }

      .proj-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
      }
    }

    #hero {
      min-height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .hero-bg {
      position: absolute;
      inset: 0;
      background: #0A0A0A;
    }

    .hero-bg-img {
      position: absolute;
      inset: 0;
      background: url("{{ $hero['hero_bg_image'] ?? 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1800&q=85' }}") center/cover no-repeat;
      opacity: 0.28;
      filter: grayscale(20%);
    }

    .hero-bg-gradient {
      position: absolute;
      inset: 0;
      background: linear-gradient(105deg, rgba(10, 10, 10, 0.97) 0%, rgba(10, 10, 10, 0.75) 50%, rgba(139, 0, 0, 0.15) 100%);
    }

    .hero-grid-lines {
      position: absolute;
      inset: 0;
      pointer-events: none;
      background-image: linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
      background-size: 80px 80px;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      padding: 90px 52px 52px;
      max-width: 1300px;
      width: 100%;
      display: grid;
      grid-template-columns: 1fr 420px;
      gap: 60px;
      align-items: center;
      margin: 0 auto;
    }

    .hero-chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 6px 14px;
      border-radius: 100px;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 1.5px;
      color: rgba(255, 255, 255, 0.6);
      text-transform: uppercase;
      margin-bottom: 32px;
      background: rgba(255, 255, 255, 0.04);
      backdrop-filter: blur(6px);
    }

    .hero-chip-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--red3);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        box-shadow: 0 0 0 0 rgba(192, 0, 28, 0.6);
      }

      50% {
        box-shadow: 0 0 0 6px rgba(192, 0, 28, 0);
      }
    }

    .hero-h1 {
      font-family: 'Outfit', sans-serif;
      font-size: clamp(52px, 5.5vw, 76px);
      font-weight: 800;
      line-height: 1.0;
      letter-spacing: -2px;
      color: #fff;
      margin-bottom: 8px;
    }

    .hero-h1-sub {
      font-family: "Instrument Serif", serif;
      font-style: italic;
      font-size: clamp(52px, 5.5vw, 80px);
      font-weight: 400;
      line-height: 1.1;
      letter-spacing: -1px;
      color: var(--red3);
      margin-bottom: 28px;
      display: block;
    }

    .hero-desc {
      font-size: 16px;
      line-height: 1.8;
      color: rgba(255, 255, 255, 0.55);
      max-width: 500px;
      font-weight: 300;
      margin-bottom: 44px;
    }

    .hero-btns {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
    }

    .hbtn-primary {
      background: var(--red);
      color: #fff;
      padding: 15px 36px;
      border-radius: 5px;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 0.3px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 4px 24px rgba(139, 0, 0, 0.4);
    }

    .hbtn-primary:hover {
      background: var(--red3);
      transform: translateY(-2px);
      box-shadow: 0 8px 32px rgba(192, 0, 28, 0.45);
    }

    .hbtn-outline {
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: rgba(255, 255, 255, 0.8);
      padding: 15px 32px;
      border-radius: 5px;
      font-size: 14px;
      font-weight: 500;
      text-decoration: none;
      transition: border-color 0.2s, color 0.2s, background 0.2s;
    }

    .hbtn-outline:hover {
      border-color: rgba(255, 255, 255, 0.6);
      color: #fff;
      background: rgba(255, 255, 255, 0.05);
    }

    .hero-card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 36px 32px;
      backdrop-filter: blur(20px);
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .hcard-stat {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 18px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .hcard-stat:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .hcard-stat:first-child {
      padding-top: 0;
    }

    .hcs-icon {
      width: 48px;
      height: 48px;
      border-radius: 10px;
      background: rgba(139, 0, 0, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
    }

    .hcs-n {
      font-size: 30px;
      font-weight: 800;
      color: #fff;
      line-height: 1;
      letter-spacing: -1px;
    }

    .hcs-n span {
      color: var(--red3);
    }

    .hcs-l {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.45);
      margin-top: 3px;
    }

    .scroll-hint {
      position: absolute;
      bottom: 36px;
      left: 52px;
      display: flex;
      align-items: center;
      gap: 12px;
      color: rgba(255, 255, 255, 0.35);
      font-size: 11px;
      letter-spacing: 2px;
      text-transform: uppercase;
      z-index: 2;
    }

    .scroll-line {
      width: 48px;
      height: 1px;
      background: rgba(255, 255, 255, 0.2);
      position: relative;
      overflow: hidden;
    }

    .scroll-line::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: var(--red3);
      animation: scrollLine 2s 2s infinite;
    }

    @keyframes scrollLine {
      0% {
        left: -100%;
      }

      100% {
        left: 100%;
      }
    }

    .ticker {
      background: var(--red);
      padding: 13px 0;
      overflow: hidden;
      white-space: nowrap;
      position: relative;
      z-index: 1;
    }

    .ticker-track {
      display: inline-flex;
      gap: 0;
      animation: tickerAnim 22s linear infinite;
    }

    .ticker-item {
      display: inline-flex;
      align-items: center;
      gap: 28px;
      padding: 0 28px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.8);
    }

    .ticker-dot {
      color: rgba(255, 255, 255, 0.3);
    }

    @keyframes tickerAnim {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }
    }

    .sec {
      padding: 110px 52px;
    }

    .sec-inner {
      max-width: 1300px;
      margin: 0 auto;
    }

    .label {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--red2);
      margin-bottom: 16px;
    }

    .label::before {
      content: '';
      width: 24px;
      height: 2px;
      background: var(--red2);
    }

    .sec-title {
      font-family: 'Outfit', sans-serif;
      font-size: clamp(38px, 4vw, 56px);
      font-weight: 800;
      letter-spacing: -2px;
      line-height: 1.05;
      margin-bottom: 16px;
    }

    .sec-title em {
      font-family: "Instrument Serif", serif;
      font-style: italic;
      font-weight: 400;
      color: var(--red2);
      letter-spacing: -1px;
    }

    #about {
      background: var(--off);
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
    }

    .about-imgs {
      position: relative;
      height: 520px;
    }

    .about-img-main {
      position: absolute;
      top: 0;
      right: 0;
      width: 80%;
      height: 420px;
      object-fit: cover;
      border-radius: 8px;
    }

    .about-img-sub {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 55%;
      height: 260px;
      object-fit: cover;
      border-radius: 8px;
      border: 4px solid var(--off);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    }

    .about-badge {
      position: absolute;
      top: 50%;
      right: -20px;
      transform: translateY(-50%);
      background: var(--red);
      color: #fff;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4);
    }

    .about-badge-n {
      font-size: 28px;
      font-weight: 800;
      line-height: 1;
    }

    .about-badge-t {
      font-size: 9px;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-align: center;
      opacity: 0.8;
    }

    .about-text p {
      font-size: 15px;
      line-height: 1.9;
      color: var(--gray);
      font-weight: 300;
      margin-bottom: 18px;
    }

    .about-highlights {
      margin-top: 36px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1px;
      background: var(--border);
      border: 1px solid var(--border);
      border-radius: 8px;
      overflow: hidden;
    }

    .ah-item {
      background: var(--white);
      padding: 20px 22px;
      display: flex;
      align-items: center;
      gap: 14px;
      transition: background 0.2s;
    }

    .ah-item:hover {
      background: #faf8f5;
    }

    .ah-icon {
      font-size: 22px;
    }

    .ah-text {
      font-size: 13px;
      font-weight: 500;
      line-height: 1.4;
    }

    #services {
      background: var(--white);
    }

    .svc-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 80px;
      align-items: start;
      margin-top: 60px;
    }

    .svc-sidebar {
      position: sticky;
      top: 90px;
    }

    .svc-sidebar p {
      font-size: 15px;
      line-height: 1.8;
      color: var(--gray);
      font-weight: 300;
      margin-top: 16px;
      margin-bottom: 32px;
    }

    .svc-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2px;
      background: var(--border);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
    }

    .svc-card {
      background: var(--white);
      padding: 40px 36px;
      cursor: default;
      transition: background 0.25s;
      position: relative;
      overflow: hidden;
    }

    .svc-card:hover {
      background: var(--off);
    }

    .svc-card::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--red3);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.35s;
    }

    .svc-card:hover::before {
      transform: scaleX(1);
    }

    .svc-card-icon {
      width: 52px;
      height: 52px;
      border-radius: 12px;
      background: rgba(139, 0, 0, 0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-bottom: 20px;
      transition: background 0.25s;
    }

    .svc-card:hover .svc-card-icon {
      background: rgba(139, 0, 0, 0.15);
    }

    .svc-card-title {
      font-size: 17px;
      font-weight: 700;
      letter-spacing: -0.3px;
      margin-bottom: 10px;
    }

    .svc-card-desc {
      font-size: 13px;
      line-height: 1.75;
      color: var(--gray);
      font-weight: 300;
    }

    .svc-card-num {
      position: absolute;
      top: 20px;
      right: 24px;
      font-size: 52px;
      font-weight: 900;
      color: rgba(0, 0, 0, 0.04);
      line-height: 1;
    }

    #projects {
      background: var(--off);
    }

    .proj-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      margin-bottom: 48px;
    }

    .proj-filters {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .pf {
      padding: 8px 20px;
      border-radius: 100px;
      border: 1px solid var(--border);
      font-size: 12px;
      font-weight: 500;
      cursor: pointer;
      color: var(--gray);
      background: var(--white);
      transition: all 0.2s;
    }

    .pf.active,
    .pf:hover {
      background: var(--dark);
      color: #fff;
      border-color: var(--dark);
    }

    .proj-mosaic {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      grid-template-rows: 320px 280px;
      gap: 16px;
    }

    .pm-item {
      border-radius: 10px;
      overflow: hidden;
      position: relative;
      cursor: pointer;
    }

    .pm-item:nth-child(1) {
      grid-column: span 5;
      grid-row: span 2;
    }

    .pm-item:nth-child(2) {
      grid-column: span 7;
    }

    .pm-item:nth-child(3) {
      grid-column: span 3;
    }

    .pm-item:nth-child(4) {
      grid-column: span 4;
    }

    .pm-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
      filter: brightness(0.82);
    }

    .pm-item:hover img {
      transform: scale(1.06);
    }

    .pm-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.78) 0%, transparent 55%);
      padding: 20px 22px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      opacity: 0.9;
      transition: opacity 0.3s;
    }

    .pm-item:hover .pm-overlay {
      opacity: 1;
    }

    .pm-tag {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--red);
      color: #fff;
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 4px 10px;
      border-radius: 100px;
      width: fit-content;
      margin-bottom: 8px;
    }

    .pm-name {
      font-size: 17px;
      font-weight: 700;
      color: #fff;
      letter-spacing: -0.3px;
    }

    .pm-item:nth-child(1) .pm-name {
      font-size: 22px;
    }

    .pm-year {
      font-size: 11px;
      color: rgba(255, 255, 255, 0.5);
      margin-top: 4px;
    }

    /* Zoom hint icon */
    .pm-zoom-hint {
      position: absolute;
      top: 14px;
      right: 14px;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(6px);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      opacity: 0;
      transform: scale(0.7);
      transition: opacity 0.25s, transform 0.25s;
      pointer-events: none;
    }

    .pm-item:hover .pm-zoom-hint {
      opacity: 1;
      transform: scale(1);
    }

    /* ─── LIGHTBOX ─────────────────────────────────────────────────── */
    #lightbox {
      position: fixed;
      inset: 0;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(0, 0, 0, 0);
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.35s, background 0.35s;
    }

    #lightbox.active {
      opacity: 1;
      visibility: visible;
      background: rgba(0, 0, 0, 0.92);
    }

    #lightbox.active .lb-panel {
      transform: scale(1) translateY(0);
      opacity: 1;
    }

    .lb-panel {
      position: relative;
      max-width: 900px;
      width: 92%;
      max-height: 90vh;
      display: flex;
      flex-direction: column;
      border-radius: 16px;
      overflow: hidden;
      background: #111;
      transform: scale(0.92) translateY(24px);
      opacity: 0;
      transition: transform 0.38s cubic-bezier(.22, 1, .36, 1), opacity 0.35s;
      box-shadow: 0 32px 80px rgba(0, 0, 0, 0.7);
    }

    .lb-img-wrap {
      position: relative;
      width: 100%;
      max-height: 60vh;
      overflow: hidden;
      background: #0a0a0a;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .lb-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: opacity 0.3s;
    }

    .lb-img-wrap img.loading {
      opacity: 0;
    }

    .lb-info {
      padding: 24px 28px;
      background: #111;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .lb-tag {
      display: inline-flex;
      align-items: center;
      background: var(--red);
      color: #fff;
      font-size: 9px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 4px 12px;
      border-radius: 100px;
      margin-bottom: 10px;
    }

    .lb-title {
      font-family: 'Outfit', sans-serif;
      font-size: 22px;
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.5px;
      line-height: 1.2;
      margin-bottom: 6px;
    }

    .lb-meta {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.4);
      margin-bottom: 8px;
    }

    .lb-desc {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.55);
      line-height: 1.7;
      display: none;
    }

    .lb-desc.has-content {
      display: block;
    }

    /* Nav arrows */
    .lb-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #fff;
      font-size: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 10;
      transition: background 0.2s, transform 0.2s;
      user-select: none;
    }

    .lb-arrow:hover {
      background: rgba(139, 0, 0, 0.6);
      transform: translateY(-50%) scale(1.1);
    }

    .lb-prev {
      left: 14px;
    }

    .lb-next {
      right: 14px;
    }

    .lb-arrow.hidden {
      opacity: 0;
      pointer-events: none;
    }

    /* Close button */
    .lb-close {
      position: absolute;
      top: 14px;
      right: 14px;
      z-index: 20;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #fff;
      font-size: 18px;
      line-height: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
    }

    .lb-close:hover {
      background: rgba(139, 0, 0, 0.8);
      transform: scale(1.1);
    }

    /* Dots indicator */
    .lb-dots {
      display: flex;
      gap: 6px;
      justify-content: center;
      padding: 14px 0 0;
    }

    .lb-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      transition: background 0.25s, transform 0.25s;
      cursor: pointer;
    }

    .lb-dot.active {
      background: var(--red3);
      transform: scale(1.4);
    }

    /* Counter */
    .lb-counter {
      position: absolute;
      top: 14px;
      left: 14px;
      background: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(6px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.7);
      font-size: 12px;
      font-weight: 600;
      padding: 5px 12px;
      border-radius: 100px;
    }

    /* Keyboard hint */
    .lb-kbd-hint {
      position: absolute;
      bottom: 14px;
      left: 50%;
      transform: translateX(-50%);
      color: rgba(255, 255, 255, 0.25);
      font-size: 11px;
      letter-spacing: 1px;
      white-space: nowrap;
      pointer-events: none;
    }

    @media(max-width:600px) {
      .lb-panel {
        border-radius: 12px;
      }

      .lb-info {
        padding: 16px 18px;
      }

      .lb-title {
        font-size: 17px;
      }

      .lb-kbd-hint {
        display: none;
      }

      .lb-arrow {
        width: 36px;
        height: 36px;
        font-size: 15px;
      }
    }

    #stats {
      background: var(--dark);
      padding: 80px 52px;
    }

    .stats-grid {
      max-width: 1300px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 0;
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 12px;
      overflow: hidden;
    }

    .stat-cell {
      padding: 48px 40px;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
      text-align: center;
      transition: background 0.3s;
      position: relative;
      overflow: hidden;
    }

    .stat-cell:last-child {
      border-right: none;
    }

    .stat-cell:hover {
      background: rgba(139, 0, 0, 0.18);
    }

    .stat-cell::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--red3);
      transform: scaleX(0);
      transition: transform 0.4s;
    }

    .stat-cell:hover::before {
      transform: scaleX(1);
    }

    .stat-n {
      font-size: 56px;
      font-weight: 900;
      color: #fff;
      line-height: 1;
      letter-spacing: -3px;
    }

    .stat-n sup {
      font-size: 0.45em;
      letter-spacing: 0;
      vertical-align: super;
      color: var(--red3);
    }

    .stat-desc {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.35);
      margin-top: 10px;
      letter-spacing: 0.5px;
    }

    #process {
      background: var(--white);
    }

    .process-steps {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 0;
      margin-top: 60px;
      position: relative;
    }

    .process-steps::before {
      content: '';
      position: absolute;
      top: 32px;
      left: 10%;
      right: 10%;
      height: 1px;
      background: var(--border);
      z-index: 0;
    }

    .step {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 0 12px;
      position: relative;
      z-index: 1;
    }

    .step-num {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: var(--white);
      border: 2px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      font-weight: 800;
      color: var(--red);
      margin-bottom: 20px;
      transition: background 0.3s, border-color 0.3s, color 0.3s, transform 0.3s;
    }

    .step:hover .step-num {
      background: var(--red);
      color: #fff;
      border-color: var(--red);
      transform: scale(1.1);
    }

    .step-icon {
      font-size: 24px;
      margin-bottom: 12px;
    }

    .step-title {
      font-size: 14px;
      font-weight: 700;
      letter-spacing: -0.2px;
      margin-bottom: 8px;
    }

    .step-desc {
      font-size: 12px;
      color: var(--gray);
      line-height: 1.6;
    }

    #testimonials {
      background: var(--off);
    }

    .testi-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-top: 52px;
    }

    .testi-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 36px 32px;
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative;
      overflow: hidden;
    }

    .testi-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    }

    .testi-card::after {
      content: '"';
      position: absolute;
      top: -10px;
      right: 20px;
      font-family: "Instrument Serif", serif;
      font-size: 120px;
      color: rgba(139, 0, 0, 0.06);
      line-height: 1;
      pointer-events: none;
    }

    .testi-stars {
      display: flex;
      gap: 3px;
      margin-bottom: 16px;
      color: var(--red3);
      font-size: 14px;
    }

    .testi-text {
      font-size: 14px;
      line-height: 1.8;
      color: var(--gray);
      font-style: italic;
      font-weight: 300;
      margin-bottom: 24px;
    }

    .testi-author {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .testi-avatar {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      object-fit: cover;
      filter: grayscale(20%);
    }

    .testi-name {
      font-size: 14px;
      font-weight: 600;
    }

    .testi-role {
      font-size: 11px;
      color: var(--gray);
      margin-top: 2px;
    }

    #contact {
      background: var(--dark);
      color: #fff;
    }

    #contact .sec-inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
    }

    .contact-left .label {
      color: rgba(200, 169, 110, 0.7);
    }

    .contact-left .label::before {
      background: rgba(200, 169, 110, 0.7);
    }

    .contact-left .sec-title {
      color: #fff;
    }

    .contact-left .sec-title em {
      color: #C8A96E;
    }

    .contact-left p {
      font-size: 15px;
      line-height: 1.85;
      color: rgba(255, 255, 255, 0.45);
      font-weight: 300;
      margin: 20px 0 40px;
    }

    .cinfo-list {
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .cinfo-item {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 16px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .cinfo-item:first-child {
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .cinfo-icon {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      background: rgba(139, 0, 0, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      flex-shrink: 0;
    }

    .cinfo-label {
      font-size: 10px;
      color: rgba(255, 255, 255, 0.3);
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .cinfo-val {
      font-size: 14px;
      margin-top: 3px;
    }

    .cf {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 40px 36px;
    }

    .cf-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .cf-group {
      margin-bottom: 18px;
    }

    .cf-label {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.4);
      margin-bottom: 8px;
      display: block;
    }

    .cf-input,
    .cf-select,
    .cf-textarea {
      width: 100%;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      padding: 14px 16px;
      color: #fff;
      font-family: 'Outfit', sans-serif;
      font-size: 14px;
      transition: border-color 0.2s;
    }

    .cf-input:focus,
    .cf-select:focus,
    .cf-textarea:focus {
      outline: none;
      border-color: rgba(139, 0, 0, 0.6);
    }

    .cf-select option {
      background: var(--dark);
    }

    .cf-textarea {
      resize: vertical;
      min-height: 120px;
    }

    .cf-btn {
      width: 100%;
      padding: 16px;
      background: var(--red);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 0.5px;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
      margin-top: 4px;
    }

    .cf-btn:hover {
      background: var(--red3);
      transform: translateY(-1px);
    }

    .alert-success {
      background: rgba(0, 180, 0, 0.15);
      border: 1px solid rgba(0, 180, 0, 0.3);
      color: #7fdb7f;
      padding: 14px 18px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    footer {
      background: #0A0A0A;
      padding: 80px 52px 0;
    }

    .footer-grid {
      max-width: 1300px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1fr;
      gap: 60px;
      padding-bottom: 60px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .footer-brand {
      margin-bottom: 16px;
    }

    .footer-brand img {
      height: 50px;
      width: auto;
      opacity: 0.9;
    }

    .footer-tagline {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.3);
      line-height: 1.7;
      max-width: 260px;
    }

    .footer-col-title {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.3);
      margin-bottom: 20px;
    }

    .footer-links {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .footer-links a {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.45);
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-links a:hover {
      color: #fff;
    }

    .footer-bottom {
      max-width: 1300px;
      margin: 0 auto;
      padding: 24px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer-bottom span {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.25);
    }

    /* Reveal animations */
    .rv,
    .rv-l,
    .rv-r {
      opacity: 0;
      transform: translateY(32px);
      transition: opacity 0.7s, transform 0.7s;
    }

    .rv-l {
      transform: translateX(-32px);
    }

    .rv-r {
      transform: translateX(32px);
    }

    .rv.on,
    .rv-l.on,
    .rv-r.on {
      opacity: 1;
      transform: none;
    }

    .d1 {
      transition-delay: 0.1s;
    }

    .d2 {
      transition-delay: 0.2s;
    }

    .d3 {
      transition-delay: 0.3s;
    }

    @media(max-width:900px) {
      nav {
        padding: 0 24px;
      }

      .nav-links {
        display: none;
      }

      .hero-content {
        grid-template-columns: 1fr;
        padding: 100px 24px 60px;
      }

      .hero-card {
        display: none;
      }

      .sec {
        padding: 70px 24px;
      }

      .about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .about-imgs {
        height: 300px;
      }

      .svc-layout {
        grid-template-columns: 1fr;
      }

      .svc-grid {
        grid-template-columns: 1fr;
      }

      .proj-mosaic {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
      }

      .pm-item:nth-child(1),
      .pm-item:nth-child(2),
      .pm-item:nth-child(3),
      .pm-item:nth-child(4) {
        grid-column: span 1;
        grid-row: span 1;
        height: 220px;
      }

      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .process-steps {
        grid-template-columns: 1fr;
        gap: 32px;
      }

      .process-steps::before {
        display: none;
      }

      .testi-grid {
        grid-template-columns: 1fr;
      }

      #contact .sec-inner {
        grid-template-columns: 1fr;
      }

      .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 40px;
      }
    }
  </style>
</head>

<body>

  {{-- Google Tag Manager (noscript) --}}
  @if(!empty($seo['seo_google_tag_manager']))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seo['seo_google_tag_manager'] }}" height="0"
        width="0" style="display:none;visibility:hidden"></iframe></noscript>
  @endif

  <div id="cursor" class="cursor"></div>
  <div id="cursor-ring" class="cursor-ring"></div>
  <div id="progress"></div>

  <div id="preloader">
    <img src="{{ asset('images/logo-white.png') }}" alt="Jaya Bangun Konstruksi" class="pre-logo">
    <div class="pre-bar-wrap">
      <div class="pre-bar"></div>
    </div>
  </div>

  <!-- NAV -->
  <nav id="navbar">
    <a href="#" class="nav-brand">
      <img src="{{ asset('images/logo-white.png') }}" alt="Jaya Bangun Konstruksi" class="nav-logo-white">
      <img src="{{ asset('images/logo-red.png') }}" alt="Jaya Bangun Konstruksi" class="nav-logo-red">
    </a>
    <ul class="nav-links">
      <li><a href="#about">Tentang</a></li>
      <li><a href="#services">Layanan</a></li>
      <li><a href="#projects">Proyek</a></li>
      <li><a href="#process">Proses</a></li>
      <li><a href="#testimonials">Testimoni</a></li>
      <li><a href="#contact">Kontak</a></li>
    </ul>
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company['company_whatsapp'] ?? '6231567890') }}"
      class="nav-wa" target="_blank">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white"
        style="flex-shrink:0;">
        <path
          d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
        <path
          d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.532 5.859L.057 23.625a.75.75 0 0 0 .921.908l5.919-1.55A11.95 11.95 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.853 0-3.587-.5-5.084-1.375l-.362-.214-3.754.984.999-3.648-.235-.374A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
      </svg>
      <span class="wa-label">WhatsApp</span>
    </a>
  </nav>

  <!-- HERO -->
  <section id="hero">
    <div class="hero-bg">
      <div class="hero-bg-img"></div>
      <div class="hero-bg-gradient"></div>
      <div class="hero-grid-lines"></div>
    </div>
    <div class="hero-content">
      <div class="hero-left">
        <div class="hero-chip">
          <div class="hero-chip-dot"></div>
          {{ $hero['hero_badge'] ?? 'Sejak 2008 · Bersertifikat ISO 9001' }}
        </div>
        <h1 class="hero-h1">{{ $hero['hero_title'] ?? 'Membangun' }}</h1>
        <span class="hero-h1-sub">{{ $hero['hero_subtitle'] ?? 'Indonesia' }}</span>
        <p class="hero-desc">{{ $hero['hero_description'] ?? '' }}</p>
        <div class="hero-btns">
          <a href="#projects" class="hbtn-primary"><span>🏗</span> {{ $hero['hero_btn_primary'] ?? 'Lihat Proyek' }}</a>
          <a href="#contact" class="hbtn-outline">{{ $hero['hero_btn_secondary'] ?? 'Konsultasi Gratis →' }}</a>
        </div>
      </div>
      <div class="hero-card">
        @foreach($stats->take(4) as $stat)
          <div class="hcard-stat">
            <div class="hcs-icon">{{ $stat->icon }}</div>
            <div>
              <div class="hcs-n">{{ $stat->value }}<span>{{ $stat->suffix }}</span></div>
              <div class="hcs-l">{{ $stat->label }}</div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="scroll-hint">
      <div class="scroll-line"></div>Scroll
    </div>
  </section>

  <!-- TICKER -->
  <div class="ticker">
    <div class="ticker-track">
      @foreach($services as $s)
        <span class="ticker-item">{{ $s->title }} <span class="ticker-dot">◆</span></span>
      @endforeach
      @foreach($services as $s)
        <span class="ticker-item">{{ $s->title }} <span class="ticker-dot">◆</span></span>
      @endforeach
    </div>
  </div>

  <!-- ABOUT -->
  <section id="about" class="sec">
    <div class="sec-inner about-grid">
      <div class="about-imgs rv-l">
        <img class="about-img-main" src="{{ $about['about_image_main'] ?? '' }}" alt="Tim Kami">
        <img class="about-img-sub" src="{{ $about['about_image_sub'] ?? '' }}" alt="Proyek">
        <div class="about-badge">
          <div class="about-badge-n">{{ $about['about_years'] ?? '15+' }}</div>
          <div class="about-badge-t">TAHUN<br>BERDIRI</div>
        </div>
      </div>
      <div class="about-text rv-r">
        <div class="label">Tentang Kami</div>
        <h2 class="sec-title">Pondasi kuat,<br><em>Visi jauh</em></h2>
        <p>{{ $about['about_text1'] ?? '' }}</p>
        <p>{{ $about['about_text2'] ?? '' }}</p>
        <div class="about-highlights">
          @foreach($highlights as $h)
            <div class="ah-item">
              <span class="ah-icon">{{ $h->icon }}</span>
              <span class="ah-text">{{ $h->text }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section id="services" class="sec">
    <div class="sec-inner">
      <div class="rv">
        <div class="label">Layanan</div>
        <h2 class="sec-title">Yang kami <em>kerjakan</em></h2>
      </div>
      <div class="svc-layout">
        <div class="svc-sidebar rv">
          <p>Dari perencanaan hingga serah terima, kami menyediakan solusi konstruksi lengkap dengan standar kualitas
            dan keselamatan tertinggi.</p>
          <a href="#contact" class="hbtn-primary" style="display:inline-flex">Diskusi Proyek →</a>
        </div>
        <div class="svc-grid rv d1">
          @foreach($services as $i => $svc)
            <div class="svc-card">
              <div class="svc-card-icon">{{ $svc->icon }}</div>
              <div class="svc-card-title">{{ $svc->title }}</div>
              <p class="svc-card-desc">{{ $svc->description }}</p>
              <div class="svc-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- PROJECTS -->
  <section id="projects" class="sec">
    <div class="sec-inner">
      <div class="proj-header rv">
        <div>
          <div class="label">Portofolio</div>
          <h2 class="sec-title">Proyek <em>Unggulan</em></h2>
        </div>
        <div class="proj-filters">
          <div class="pf active" data-cat="all">Semua</div>
          @foreach($categories as $cat)
            <div class="pf" data-cat="{{ $cat }}">{{ $cat }}</div>
          @endforeach
        </div>
      </div>
      <div class="proj-mosaic rv d1">
        @foreach($projects->take(4) as $i => $project)
          <div class="pm-item" data-cat="{{ $project->category }}" data-img="{{ $project->image_url }}"
            data-title="{{ $project->title }}" data-category="{{ $project->category }}" data-year="{{ $project->year }}"
            data-location="{{ $project->location }}" data-desc="{{ $project->description }}" data-index="{{ $i }}"
            onclick="openLightbox({{ $i }})">
            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
            <div class="pm-overlay">
              <div class="pm-tag">{{ $project->category }}</div>
              <div class="pm-name">{{ $project->title }}</div>
              <div class="pm-year">{{ $project->year }} · {{ $project->location }}</div>
            </div>
            <div class="pm-zoom-hint">🔍</div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Tombol Lihat Semua --}}
    @php $totalProjects = $projects->count(); @endphp
    @if($totalProjects > 4)
      <div style="text-align:center;margin-top:48px;" class="rv">
        <a href="{{ route('projects') }}" class="hbtn-primary"
          style="display:inline-flex;padding:16px 40px;font-size:15px;">
          🏗 Lihat Semua {{ $totalProjects }} Proyek →
        </a>
      </div>
    @endif
    </div>

  </section>

  <!-- STATS -->
  <section id="stats">
    <div class="stats-grid rv">
      @foreach($stats as $stat)
        <div class="stat-cell">
          <div class="stat-n">{{ $stat->value }}<sup>{{ $stat->suffix }}</sup></div>
          <div class="stat-desc">{{ $stat->label }}</div>
        </div>
      @endforeach
    </div>
  </section>

  <!-- PROCESS -->
  <section id="process" class="sec">
    <div class="sec-inner">
      <div class="rv" style="text-align:center;max-width:560px;margin:0 auto 60px;">
        <div class="label" style="justify-content:center">Cara Kerja</div>
        <h2 class="sec-title">Proses <em>Kami</em></h2>
        <p style="font-size:15px;color:var(--gray);line-height:1.8;font-weight:300;margin-top:12px;">Setiap proyek
          dijalankan dengan metodologi terstruktur untuk memastikan hasil terbaik.</p>
      </div>
      <div class="process-steps rv d1">
        <div class="step">
          <div class="step-num">01</div>
          <div class="step-icon">💬</div>
          <div class="step-title">Konsultasi Awal</div>
          <p class="step-desc">Diskusi kebutuhan, lokasi, dan anggaran proyek Anda secara gratis.</p>
        </div>
        <div class="step">
          <div class="step-num">02</div>
          <div class="step-icon">📐</div>
          <div class="step-title">Survei & Desain</div>
          <p class="step-desc">Survei lapangan, pengukuran, dan penyusunan desain serta DED.</p>
        </div>
        <div class="step">
          <div class="step-num">03</div>
          <div class="step-icon">📋</div>
          <div class="step-title">Penawaran & Kontrak</div>
          <p class="step-desc">RAB transparan, negosiasi, dan penandatanganan kontrak kerja.</p>
        </div>
        <div class="step">
          <div class="step-num">04</div>
          <div class="step-icon">🏗️</div>
          <div class="step-title">Pelaksanaan</div>
          <p class="step-desc">Konstruksi diawasi ketat oleh tim ahli bersertifikat di lapangan.</p>
        </div>
        <div class="step">
          <div class="step-num">05</div>
          <div class="step-icon">🎯</div>
          <div class="step-title">Serah Terima</div>
          <p class="step-desc">Inspeksi final, dokumentasi, dan serah terima proyek tepat waktu.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section id="testimonials" class="sec">
    <div class="sec-inner">
      <div class="rv" style="text-align:center;max-width:520px;margin:0 auto 52px;">
        <div class="label" style="justify-content:center">Testimoni</div>
        <h2 class="sec-title">Kata <em>Klien</em> Kami</h2>
      </div>
      <div class="testi-grid">
        @foreach($testimonials as $i => $t)
          <div class="testi-card rv d{{ $i + 1 }}">
            <div class="testi-stars">{{ $t->stars }}</div>
            <p class="testi-text">"{{ $t->content }}"</p>
            <div class="testi-author">
              <img class="testi-avatar" src="{{ $t->avatar_url }}" alt="{{ $t->name }}">
              <div>
                <div class="testi-name">{{ $t->name }}</div>
                <div class="testi-role">{{ $t->role }}{{ $t->company ? ', ' . $t->company : '' }}</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="sec">
    <div class="sec-inner">
      <div class="contact-left rv-l">
        <div class="label">Kontak</div>
        <h2 class="sec-title">Mulai <em>Proyek</em><br>Anda Sekarang</h2>
        <p>Konsultasikan kebutuhan konstruksi Anda dengan tim ahli kami. Gratis, tanpa komitmen.</p>
        <div class="cinfo-list">
          <div class="cinfo-item">
            <div class="cinfo-icon">📍</div>
            <div>
              <div class="cinfo-label">Alamat</div>
              <div class="cinfo-val">{{ $company['company_address'] ?? '' }}</div>
            </div>
          </div>
          <div class="cinfo-item">
            <div class="cinfo-icon">📞</div>
            <div>
              <div class="cinfo-label">Telepon</div>
              <div class="cinfo-val">{{ $company['company_phone'] ?? '' }}</div>
            </div>
          </div>
          <div class="cinfo-item">
            <div class="cinfo-icon">✉️</div>
            <div>
              <div class="cinfo-label">Email</div>
              <div class="cinfo-val">{{ $company['company_email'] ?? '' }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="rv-r">
        <div class="cf">
          @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
          @endif
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="cf-row">
              <div class="cf-group">
                <label class="cf-label">Nama Lengkap *</label>
                <input type="text" name="name" class="cf-input" placeholder="Nama Anda" value="{{ old('name') }}"
                  required>
              </div>
              <div class="cf-group">
                <label class="cf-label">Email *</label>
                <input type="email" name="email" class="cf-input" placeholder="email@anda.com"
                  value="{{ old('email') }}" required>
              </div>
            </div>
            <div class="cf-row">
              <div class="cf-group">
                <label class="cf-label">No. Telepon</label>
                <input type="tel" name="phone" class="cf-input" placeholder="+62 xxx" value="{{ old('phone') }}">
              </div>
              <div class="cf-group">
                <label class="cf-label">Jenis Layanan</label>
                <select name="service" class="cf-select">
                  <option value="">Pilih Layanan</option>
                  @foreach($services as $svc)
                    <option value="{{ $svc->title }}" {{ old('service') == $svc->title ? 'selected' : '' }}>
                      {{ $svc->title }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="cf-group">
              <label class="cf-label">Pesan *</label>
              <textarea name="message" class="cf-textarea" placeholder="Ceritakan proyek Anda..."
                required>{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="cf-btn">🚀 Kirim Pesan</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-grid">
      <div>
        <div class="footer-brand">
          <img src="{{ asset('images/logo-white.png') }}"
            alt="{{ $company['company_name'] ?? 'Jaya Bangun Konstruksi' }}">
        </div>
        <p class="footer-tagline">{{ $company['company_tagline'] ?? '' }}</p>

        {{-- Social Media Icons --}}
        <div style="display:flex;gap:10px;margin-top:20px;">
          @if(!empty($social['social_instagram']))
            <a href="{{ $social['social_instagram'] }}" target="_blank" rel="noopener"
              style="width:38px;height:38px;border-radius:9px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;"
              onmouseover="this.style.background='linear-gradient(135deg,#833ab4,#fd1d1d,#fcb045)';this.style.border='1px solid transparent';this.style.transform='translateY(-2px)'"
              onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.border='1px solid rgba(255,255,255,0.1)';this.style.transform='none'">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="20" height="20" rx="5" stroke="white" stroke-width="2" />
                <circle cx="12" cy="12" r="4" stroke="white" stroke-width="2" />
                <circle cx="17.5" cy="6.5" r="1" fill="white" />
              </svg>
            </a>
          @endif

          @if(!empty($social['social_facebook']))
            <a href="{{ $social['social_facebook'] }}" target="_blank" rel="noopener"
              style="width:38px;height:38px;border-radius:9px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;"
              onmouseover="this.style.background='#1877f2';this.style.border='1px solid transparent';this.style.transform='translateY(-2px)'"
              onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.border='1px solid rgba(255,255,255,0.1)';this.style.transform='none'">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
              </svg>
            </a>
          @endif

          @if(!empty($social['social_youtube']))
            <a href="{{ $social['social_youtube'] }}" target="_blank" rel="noopener"
              style="width:38px;height:38px;border-radius:9px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;"
              onmouseover="this.style.background='#ff0000';this.style.border='1px solid transparent';this.style.transform='translateY(-2px)'"
              onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.border='1px solid rgba(255,255,255,0.1)';this.style.transform='none'">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.96-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z" />
                <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#ff0000" />
              </svg>
            </a>
          @endif

          @if(!empty($social['social_whatsapp'] ?? $company['company_whatsapp'] ?? null))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company['company_whatsapp'] ?? '') }}" target="_blank"
              rel="noopener"
              style="width:38px;height:38px;border-radius:9px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;"
              onmouseover="this.style.background='#25d366';this.style.border='1px solid transparent';this.style.transform='translateY(-2px)'"
              onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.border='1px solid rgba(255,255,255,0.1)';this.style.transform='none'">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                <path
                  d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.532 5.859L.057 23.625a.75.75 0 0 0 .921.908l5.919-1.55A11.95 11.95 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.853 0-3.587-.5-5.084-1.375l-.362-.214-3.754.984.999-3.648-.235-.374A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
              </svg>
            </a>
          @endif
        </div>
      </div>

      <div>
        <div class="footer-col-title">Layanan</div>
        <ul class="footer-links">
          @foreach($services->take(5) as $svc)
            <li><a href="#services">{{ $svc->title }}</a></li>
          @endforeach
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Perusahaan</div>
        <ul class="footer-links">
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#projects">Portofolio</a></li>
          <li><a href="#process">Cara Kerja</a></li>
          <li><a href="#testimonials">Testimoni</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Kontak</div>
        <ul class="footer-links">
          <li><a href="#">{{ $company['company_address'] ?? '' }}</a></li>
          <li><a href="tel:{{ $company['company_phone'] ?? '' }}">{{ $company['company_phone'] ?? '' }}</a></li>
          <li><a href="mailto:{{ $company['company_email'] ?? '' }}">{{ $company['company_email'] ?? '' }}</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} {{ $company['company_name'] ?? 'PT. Jaya Bangun Konstruksi' }}. Hak cipta
        dilindungi.</span>
      <span>Developed by <a href="https://1017studios.id" target="_blank"
          style="color: #8b0000;">1017studios.id</a></span>
    </div>
  </footer>

  <!-- ─── LIGHTBOX ─────────────────────────────────────────────── -->
  <div id="lightbox" onclick="handleLBClick(event)">
    <div class="lb-panel" id="lb-panel">

      <!-- Close -->
      <button class="lb-close" onclick="closeLightbox()" title="Tutup (ESC)">✕</button>

      <!-- Counter -->
      <div class="lb-counter" id="lb-counter">1 / 4</div>

      <!-- Image -->
      <div class="lb-img-wrap">
        <img id="lb-img" src="" alt="" loading="eager">
        <!-- Prev / Next -->
        <button class="lb-arrow lb-prev" id="lb-prev" onclick="lbNav(-1)" title="Sebelumnya (←)">‹</button>
        <button class="lb-arrow lb-next" id="lb-next" onclick="lbNav(1)" title="Berikutnya (→)">›</button>
      </div>

      <!-- Info -->
      <div class="lb-info">
        <div id="lb-tag" class="lb-tag"></div>
        <div id="lb-title" class="lb-title"></div>
        <div id="lb-meta" class="lb-meta"></div>
        <div id="lb-desc" class="lb-desc"></div>
        <div class="lb-dots" id="lb-dots"></div>
      </div>

      <div class="lb-kbd-hint">← → navigasi &nbsp;·&nbsp; ESC tutup</div>
    </div>
  </div>

  <script>
    // ── Preloader ────────────────────────────────────────────────────
    window.addEventListener("load", () => {
      setTimeout(() => {
        document.getElementById("preloader").classList.add("hide");
      }, 1800);
    });

    // ── Custom cursor ─────────────────────────────────────────────────
    const cur = document.getElementById("cursor"),
      ring = document.getElementById("cursor-ring");
    document.addEventListener("mousemove", e => {
      cur.style.left = e.clientX + "px";
      cur.style.top = e.clientY + "px";
      ring.style.left = e.clientX + "px";
      ring.style.top = e.clientY + "px";
    });
    document.querySelectorAll("a,button,.pf,.svc-card,.pm-item,.step").forEach(el => {
      el.addEventListener("mouseenter", () => {
        cur.style.transform = "translate(-50%,-50%) scale(2)";
        ring.style.width = "56px";
        ring.style.height = "56px";
        ring.style.borderColor = "rgba(139,0,0,0.6)";
      });
      el.addEventListener("mouseleave", () => {
        cur.style.transform = "translate(-50%,-50%) scale(1)";
        ring.style.width = "36px";
        ring.style.height = "36px";
        ring.style.borderColor = "rgba(139,0,0,0.4)";
      });
    });

    // ── Scroll progress ───────────────────────────────────────────────
    const prog = document.getElementById("progress");
    window.addEventListener("scroll", () => {
      const sc = document.documentElement.scrollTop,
        sh = document.documentElement.scrollHeight - window.innerHeight;
      prog.style.width = (sc / sh * 100) + "%";
    });

    // ── Navbar ────────────────────────────────────────────────────────
    const navbar = document.getElementById("navbar");
    window.addEventListener("scroll", () => {
      navbar.classList.toggle("scrolled", window.scrollY > 60);
    });

    // ── Meta Pixel: Scroll 50% ────────────────────────────────────────
    @if(!empty($seo['seo_meta_pixel']))
      let scrollTracked = false;
      window.addEventListener('scroll', function () {
        if (scrollTracked) return;
        const scrolled = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
        if (scrolled >= 0.5) {
          scrollTracked = true;
          fbq('trackCustom', 'ScrollPage', { depth: '50%' });
        }
      });
    @endif

    // ── Meta Pixel: Lead saat klik WhatsApp ───────────────────────────
    @if(!empty($seo['seo_meta_pixel']))
      document.querySelectorAll('a[href*="wa.me"]').forEach(function (el) {
        el.addEventListener('click', function () {
          fbq('track', 'Lead', {
            content_name: 'WhatsApp Click',
            content_category: 'Konstruksi'
          });
        });
      });
    @endif

    // ── Scroll reveal ─────────────────────────────────────────────────
    const obs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add("on");
      });
    }, {
      threshold: 0.08
    });
    document.querySelectorAll(".rv,.rv-l,.rv-r").forEach(el => obs.observe(el));

    // ── Project filter ────────────────────────────────────────────────
    document.querySelectorAll(".pf").forEach(f => {
      f.addEventListener("click", () => {
        document.querySelectorAll(".pf").forEach(x => x.classList.remove("active"));
        f.classList.add("active");
        const cat = f.dataset.cat;
        document.querySelectorAll(".pm-item").forEach(item => {
          item.style.display = (cat === "all" || item.dataset.cat === cat) ? "block" : "none";
        });
      });
    });

    // ── Active nav on scroll ──────────────────────────────────────────
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-links a");
    window.addEventListener("scroll", () => {
      let current = "";
      sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 100) current = s.id;
      });
      navLinks.forEach(a => {
        a.classList.toggle("active", a.getAttribute("href") === "#" + current);
      });
    });

    // ────────────────────────────────────────────────────────────────
    // ── LIGHTBOX ─────────────────────────────────────────────────────
    // ────────────────────────────────────────────────────────────────
    const lbData = [];
    document.querySelectorAll(".pm-item[data-img]").forEach((el, i) => {
      lbData.push({
        img: el.dataset.img,
        title: el.dataset.title,
        category: el.dataset.category,
        year: el.dataset.year,
        location: el.dataset.location,
        desc: el.dataset.desc || "",
      });
    });

    let lbCurrent = 0;
    let lbTotal = lbData.length;
    let touchStartX = 0;

    // Build dots
    const dotsEl = document.getElementById("lb-dots");
    lbData.forEach((_, i) => {
      const d = document.createElement("div");
      d.className = "lb-dot" + (i === 0 ? " active" : "");
      d.onclick = (e) => {
        e.stopPropagation();
        openLightbox(i);
      };
      dotsEl.appendChild(d);
    });

    function openLightbox(index) {
      lbCurrent = index;
      renderLB();
      document.getElementById("lightbox").classList.add("active");
      document.body.style.overflow = "hidden";
    }

    function closeLightbox() {
      document.getElementById("lightbox").classList.remove("active");
      document.body.style.overflow = "";
    }

    function renderLB() {
      const d = lbData[lbCurrent];
      const img = document.getElementById("lb-img");

      // Fade image on change
      img.classList.add("loading");
      img.src = d.img;
      img.alt = d.title;
      img.onload = () => img.classList.remove("loading");

      document.getElementById("lb-tag").textContent = d.category;
      document.getElementById("lb-title").textContent = d.title;
      document.getElementById("lb-meta").textContent = d.year + " · " + d.location;

      const descEl = document.getElementById("lb-desc");
      if (d.desc && d.desc.trim()) {
        descEl.textContent = d.desc;
        descEl.classList.add("has-content");
      } else {
        descEl.textContent = "";
        descEl.classList.remove("has-content");
      }

      document.getElementById("lb-counter").textContent = (lbCurrent + 1) + " / " + lbTotal;

      // Update dots
      document.querySelectorAll(".lb-dot").forEach((dot, i) => {
        dot.classList.toggle("active", i === lbCurrent);
      });

      // Update arrows
      document.getElementById("lb-prev").classList.toggle("hidden", lbCurrent === 0);
      document.getElementById("lb-next").classList.toggle("hidden", lbCurrent === lbTotal - 1);
    }

    function lbNav(dir) {
      const next = lbCurrent + dir;
      if (next >= 0 && next < lbTotal) openLightbox(next);
    }

    // Click outside panel = close
    function handleLBClick(e) {
      if (e.target === document.getElementById("lightbox")) closeLightbox();
    }

    // Keyboard navigation
    document.addEventListener("keydown", e => {
      const lb = document.getElementById("lightbox");
      if (!lb.classList.contains("active")) return;
      if (e.key === "Escape") closeLightbox();
      if (e.key === "ArrowLeft") lbNav(-1);
      if (e.key === "ArrowRight") lbNav(1);
    });

    // Touch / swipe support
    document.getElementById("lb-panel").addEventListener("touchstart", e => {
      touchStartX = e.changedTouches[0].screenX;
    }, {
      passive: true
    });
    document.getElementById("lb-panel").addEventListener("touchend", e => {
      const diff = touchStartX - e.changedTouches[0].screenX;
      if (Math.abs(diff) > 50) lbNav(diff > 0 ? 1 : -1);
    }, {
      passive: true
    });
  </script>
</body>

</html>