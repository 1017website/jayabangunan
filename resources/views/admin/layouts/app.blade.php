<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'CMS') — Jaya Bangun Admin</title>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{--red:#8B0000;--red2:#A80000;--red3:#C0001C;--dark:#0f1117;--sidebar:#161b27;--card:#1e2433;--border:#2a3040;--text:#e2e8f0;--muted:#64748b;--sw:240px;}
html,body{height:100%;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--dark);color:var(--text);font-size:14px;}

/* OVERLAY */
#ov{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.65);z-index:199;backdrop-filter:blur(2px);}
#ov.show{display:block;}

/* SIDEBAR */
.sb{width:var(--sw);background:var(--sidebar);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;bottom:0;z-index:200;transition:transform .3s ease;}
.sb-logo{padding:18px 16px 14px;border-bottom:1px solid var(--border);flex-shrink:0;}
.sb-logo a{font-size:20px;font-weight:900;color:#fff;text-decoration:none;letter-spacing:-.5px;display:block;}
.sb-logo a span{color:var(--red3);}
.sb-logo small{font-size:10px;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;}
.sb-nav{padding:10px 8px;flex:1;overflow-y:auto;}
.sb-nav::-webkit-scrollbar{width:4px;}
.sb-nav::-webkit-scrollbar-track{background:transparent;}
.sb-nav::-webkit-scrollbar-thumb{background:#2a3040;border-radius:4px;}
.sec-label{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--muted);padding:12px 8px 5px;}
.sb-nav a{display:flex;align-items:center;gap:9px;padding:9px 10px;border-radius:8px;color:#94a3b8;text-decoration:none;font-size:13px;font-weight:500;transition:all .2s;margin-bottom:1px;}
.sb-nav a:hover{background:rgba(139,0,0,0.15);color:#fff;}
.sb-nav a.active{background:rgba(192,0,28,0.2);color:#fff;border-left:3px solid var(--red3);padding-left:7px;}
.sb-nav a .ic{font-size:15px;width:20px;text-align:center;flex-shrink:0;}
.sb-nav a .lbl{flex:1;}
.sb-nav a .nb{background:var(--red3);color:#fff;font-size:10px;font-weight:700;padding:2px 7px;border-radius:100px;}
.sb-nav a .nb.bl{background:#3b82f6;}
.sb-foot{padding:10px 8px;border-top:1px solid var(--border);flex-shrink:0;}
.u-row{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:8px;}
.u-av{width:32px;height:32px;border-radius:50%;background:var(--red);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;flex-shrink:0;}
.u-name{font-size:13px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.u-role{font-size:11px;color:var(--muted);}
.lo-btn{display:flex;align-items:center;gap:8px;width:100%;padding:9px 10px;background:transparent;border:1px solid var(--border);border-radius:8px;color:var(--muted);font-size:13px;cursor:pointer;transition:all .2s;margin-top:6px;font-family:inherit;}
.lo-btn:hover{border-color:var(--red3);color:var(--red3);}

/* MAIN */
.mw{margin-left:var(--sw);display:flex;flex-direction:column;min-height:100vh;transition:margin .3s;}

/* TOPBAR */
.tb{height:58px;padding:0 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;background:var(--sidebar);position:sticky;top:0;z-index:50;flex-shrink:0;}
.tb-left{display:flex;align-items:center;gap:12px;}
.hbg{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:6px;border-radius:6px;transition:background .2s;}
.hbg:hover{background:rgba(255,255,255,0.07);}
.hbg span{display:block;width:20px;height:2px;background:#94a3b8;border-radius:2px;transition:all .3s;}
.tb-title{font-size:15px;font-weight:700;color:#fff;line-height:1.2;}
.tb-bc{font-size:11px;color:var(--muted);}
.tb-actions{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}

/* PAGE */
.pc{padding:24px;flex:1;}

/* CARDS */
.card{background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
.card-hd{padding:15px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
.card-title{font-size:14px;font-weight:700;color:#fff;}
.card-bd{padding:20px;}

/* STAT CARDS */
.sc-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
.sc{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:18px 16px;position:relative;overflow:hidden;}
.sc::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;}
.sc.red::before{background:var(--red3);}
.sc.blue::before{background:#3b82f6;}
.sc.green::before{background:#22c55e;}
.sc.yellow::before{background:#eab308;}
.sc-label{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);margin-bottom:8px;line-height:1.4;}
.sc-val{font-size:30px;font-weight:800;color:#fff;line-height:1;letter-spacing:-1px;}
.sc-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:30px;opacity:0.1;}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all .2s;white-space:nowrap;font-family:inherit;}
.btn-primary{background:var(--red);color:#fff;}.btn-primary:hover{background:var(--red3);}
.btn-sec{background:#252c3d;color:var(--text);border:1px solid var(--border);}.btn-sec:hover{background:#2f3a50;}
.btn-danger{background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.25);}.btn-danger:hover{background:rgba(239,68,68,.2);}
.btn-success{background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.25);}.btn-success:hover{background:rgba(34,197,94,.2);}
.btn-sm{padding:6px 11px;font-size:12px;}

/* TABLE */
.tw{overflow-x:auto;-webkit-overflow-scrolling:touch;}
table{width:100%;border-collapse:collapse;min-width:480px;}
thead th{padding:10px 14px;text-align:left;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);border-bottom:1px solid var(--border);white-space:nowrap;}
tbody td{padding:12px 14px;border-bottom:1px solid var(--border);color:var(--text);font-size:13px;vertical-align:middle;}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover{background:rgba(255,255,255,0.02);}
.td-act{display:flex;gap:6px;align-items:center;}

/* FORMS */
.fg{margin-bottom:16px;}
.fl{display:block;font-size:11px;font-weight:700;letter-spacing:.8px;color:#94a3b8;margin-bottom:7px;text-transform:uppercase;}
.fc,.fs,.fta{width:100%;background:#252c3d;border:1px solid var(--border);border-radius:8px;padding:10px 13px;color:var(--text);font-size:14px;font-family:inherit;transition:border-color .2s;}
.fc:focus,.fs:focus,.fta:focus{outline:none;border-color:var(--red3);box-shadow:0 0 0 3px rgba(192,0,28,.1);}
.fta{resize:vertical;min-height:100px;line-height:1.6;}
.fs option{background:var(--card);}
.frow{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.fchk{display:flex;align-items:center;gap:9px;}
.fchk input[type=checkbox]{width:17px;height:17px;accent-color:var(--red3);cursor:pointer;flex-shrink:0;}
.fchk label{font-size:13px;color:var(--text);cursor:pointer;}
.fhint{font-size:11px;color:var(--muted);margin-top:4px;line-height:1.5;}

/* ALERTS */
.alert{padding:11px 15px;border-radius:8px;font-size:13px;margin-bottom:18px;line-height:1.5;}
.alert-success{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:#4ade80;}
.alert-danger{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);color:#f87171;}

/* BADGES */
.badge{display:inline-flex;padding:3px 9px;border-radius:100px;font-size:11px;font-weight:600;}
.badge-green{background:rgba(34,197,94,.15);color:#4ade80;}
.badge-red{background:rgba(239,68,68,.15);color:#f87171;}
.badge-blue{background:rgba(59,130,246,.15);color:#60a5fa;}
.badge-yellow{background:rgba(234,179,8,.15);color:#facc15;}

/* EMPTY */
.empty{text-align:center;padding:50px 20px;color:var(--muted);}
.empty-icon{font-size:44px;margin-bottom:12px;}

/* ── RESPONSIVE ─────────────────────────────────────────────────── */
@media(max-width:1100px){
  .sc-grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:768px){
  /* Sidebar hidden */
  .sb{transform:translateX(-100%);}
  .sb.open{transform:translateX(0);}
  /* Full width main */
  .mw{margin-left:0;}
  /* Show hamburger */
  .hbg{display:flex;}
  /* Topbar */
  .tb{padding:0 14px;height:54px;}
  /* Page */
  .pc{padding:14px;}
  /* Stat grid */
  .sc-grid{grid-template-columns:1fr 1fr;gap:10px;}
  .sc{padding:14px 12px;}
  .sc-val{font-size:24px;}
  .sc-icon{font-size:24px;}
  /* Card */
  .card-hd{padding:13px 14px;}
  .card-bd{padding:14px;}
  /* Form row */
  .frow{grid-template-columns:1fr;}
  /* Table scroll hint */
  .tw{margin:0 -14px;}
  /* Actions wrap */
  .tb-actions{gap:6px;}
}
@media(max-width:420px){
  .sc-grid{grid-template-columns:1fr 1fr;}
  .sc-val{font-size:20px;}
  .sc-label{font-size:9px;}
  .btn{padding:8px 12px;font-size:12px;}
}
</style>
</head>
<body>

<div id="ov" onclick="closeSB()"></div>

<!-- SIDEBAR -->
<aside class="sb" id="sb">
  <div class="sb-logo">
    <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;">
      <img src="{{ asset('images/logo-white.png') }}" alt="Jaya Bangun" style="height:36px;width:auto;filter:brightness(1);">
    </a>
    <small>CMS Panel</small>
  </div>
  <nav class="sb-nav">
    <div class="sec-label">Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="ic">🏠</span><span class="lbl">Dashboard</span>
    </a>
    <a href="{{ route('home') }}" target="_blank">
      <span class="ic">🌐</span><span class="lbl">Lihat Website</span>
    </a>

    <div class="sec-label">Konten</div>
    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
      <span class="ic">⚙️</span><span class="lbl">Pengaturan</span>
    </a>
    <a href="{{ route('admin.seo.index') }}" class="{{ request()->routeIs('admin.seo*') ? 'active' : '' }}">
      <span class="ic">🔍</span><span class="lbl">SEO</span>
    </a>
    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services*') ? 'active' : '' }}">
      <span class="ic">🔧</span><span class="lbl">Layanan</span>
    </a>
    <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
      <span class="ic">🏗️</span><span class="lbl">Proyek</span>
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
      <span class="ic">💬</span><span class="lbl">Testimoni</span>
    </a>
    <a href="{{ route('admin.stats.index') }}" class="{{ request()->routeIs('admin.stats*') ? 'active' : '' }}">
      <span class="ic">📊</span><span class="lbl">Statistik</span>
    </a>

    <div class="sec-label">Analitik</div>
    <a href="{{ route('admin.visitors.index') }}" class="{{ request()->routeIs('admin.visitors*') ? 'active' : '' }}">
      <span class="ic">👥</span><span class="lbl">Pengunjung</span>
      @php try{$tv=\App\Models\VisitorLog::todayCount();}catch(\Exception $e){$tv=0;} @endphp
      @if($tv>0)<span class="nb bl">{{ $tv }}</span>@endif
    </a>

    <div class="sec-label">Komunikasi</div>
    <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
      <span class="ic">✉️</span><span class="lbl">Pesan Masuk</span>
      @php try{$ur=\App\Models\ContactMessage::unread()->count();}catch(\Exception $e){$ur=0;} @endphp
      @if($ur>0)<span class="nb">{{ $ur }}</span>@endif
    </a>
  </nav>
  <div class="sb-foot">
    <div class="u-row">
      <div class="u-av">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
      <div style="overflow:hidden;min-width:0;">
        <div class="u-name">{{ auth()->user()->name }}</div>
        <div class="u-role">{{ ucfirst(auth()->user()->role) }}</div>
      </div>
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="lo-btn">🚪 Keluar</button>
    </form>
  </div>
</aside>

<!-- MAIN -->
<div class="mw" id="mw">
  <div class="tb">
    <div class="tb-left">
      <button class="hbg" onclick="toggleSB()" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </button>
      <div>
        <div class="tb-title">@yield('page-title','Dashboard')</div>
        <div class="tb-bc">Admin / @yield('breadcrumb','Dashboard')</div>
      </div>
    </div>
    <div class="tb-actions">@yield('topbar-actions')</div>
  </div>

  <div class="pc">
    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
      <strong>Ada kesalahan:</strong><br>
      @foreach($errors->all() as $e)• {{ $e }}<br>@endforeach
    </div>
    @endif

    @yield('content')
  </div>
</div>

<script>
function toggleSB(){
  const sb=document.getElementById('sb'),ov=document.getElementById('ov');
  if(sb.classList.contains('open')){closeSB();}
  else{sb.classList.add('open');ov.classList.add('show');document.body.style.overflow='hidden';}
}
function closeSB(){
  document.getElementById('sb').classList.remove('open');
  document.getElementById('ov').classList.remove('show');
  document.body.style.overflow='';
}
document.querySelectorAll('.sb-nav a').forEach(a=>a.addEventListener('click',()=>{if(window.innerWidth<=768)closeSB();}));
document.addEventListener('keydown',e=>{if(e.key==='Escape')closeSB();});
window.addEventListener('resize',()=>{if(window.innerWidth>768)closeSB();});
</script>
</body>
</html>
