<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<title>Portofolio Proyek — {{ $company['company_name'] ?? 'Jaya Bangun Konstruksi' }}</title>
<meta name="description" content="Lihat semua portofolio proyek konstruksi PT. Jaya Bangun Konstruksi — gedung komersial, sipil, residensial, dan industri.">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<style>
:root{--red:#8B0000;--red2:#A80000;--red3:#C0001C;--white:#FFFFFF;--off:#F7F5F2;--dark:#111111;--gray:#6B6B6B;--lgray:#C8C4BE;--border:rgba(0,0,0,0.09);}
*{margin:0;padding:0;box-sizing:border-box;}html{scroll-behavior:smooth;}
body{font-family:'Outfit',sans-serif;background:var(--off);color:var(--dark);overflow-x:hidden;}

/* ── CURSOR ── */
.cursor{width:10px;height:10px;border-radius:50%;background:var(--red3);position:fixed;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);transition:transform .15s;}
.cursor-ring{width:36px;height:36px;border-radius:50%;border:1.5px solid rgba(139,0,0,0.4);position:fixed;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:transform .08s linear,width .3s,height .3s,border-color .3s;}
#progress{position:fixed;top:0;left:0;height:2px;background:var(--red3);z-index:9999;transition:width .1s;width:0%;}

/* ── NAV ── */
nav{position:fixed;top:0;left:0;right:0;z-index:1000;height:70px;display:flex;align-items:center;justify-content:space-between;padding:0 52px;background:rgba(255,255,255,0.97);box-shadow:0 1px 0 var(--border);backdrop-filter:blur(12px);}
.nav-brand{display:flex;align-items:center;text-decoration:none;}
.nav-brand img{height:36px;width:auto;}
.nav-links{display:flex;gap:0;list-style:none;}
.nav-links a{color:var(--gray);text-decoration:none;font-size:13px;font-weight:500;padding:0 18px;height:70px;display:flex;align-items:center;transition:color .2s;position:relative;}
.nav-links a::after{content:'';position:absolute;bottom:0;left:18px;right:18px;height:2px;background:var(--red3);transform:scaleX(0);transform-origin:left;transition:transform .3s;}
.nav-links a:hover{color:var(--red2);}
.nav-links a:hover::after,.nav-links a.active::after{transform:scaleX(1);}
.nav-links a.active{color:var(--red2);}
.nav-back{display:flex;align-items:center;gap:8px;color:var(--gray);text-decoration:none;font-size:13px;font-weight:500;padding:9px 18px;border-radius:6px;border:1px solid var(--border);transition:all .2s;}
.nav-back:hover{background:var(--off);color:var(--dark);}
.nav-wa{background:var(--red);color:#fff;padding:10px 22px;border-radius:4px;font-size:13px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:8px;transition:background .2s,transform .2s;}
.nav-wa:hover{background:var(--red3);transform:translateY(-1px);}

/* ── HERO BANNER ── */
.page-hero{
  background:var(--dark);padding:120px 52px 64px;
  position:relative;overflow:hidden;
}
.page-hero::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(139,0,0,0.15) 0%,transparent 60%);
}
.page-hero-grid{
  position:absolute;inset:0;pointer-events:none;
  background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);
  background-size:60px 60px;
}
.page-hero-inner{max-width:1300px;margin:0 auto;position:relative;z-index:2;}
.page-label{display:inline-flex;align-items:center;gap:10px;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--red3);margin-bottom:16px;}
.page-label::before{content:'';width:24px;height:2px;background:var(--red3);}
.page-title{font-size:clamp(40px,5vw,64px);font-weight:800;color:#fff;letter-spacing:-2px;line-height:1.05;margin-bottom:16px;}
.page-title em{font-family:"Instrument Serif",serif;font-style:italic;font-weight:400;color:var(--red3);}
.page-desc{font-size:16px;color:rgba(255,255,255,0.5);font-weight:300;max-width:560px;line-height:1.7;}

/* ── FILTER BAR ── */
.filter-bar{
  background:var(--white);border-bottom:1px solid var(--border);
  position:sticky;top:70px;z-index:100;
  padding:16px 52px;
}
.filter-inner{max-width:1300px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.filter-tabs{display:flex;gap:8px;flex-wrap:wrap;}
.ft{
  padding:8px 20px;border-radius:100px;
  border:1px solid var(--border);
  font-size:12px;font-weight:600;
  cursor:pointer;color:var(--gray);
  background:var(--off);
  transition:all .2s;text-decoration:none;
  display:inline-block;
}
.ft:hover,.ft.active{background:var(--dark);color:#fff;border-color:var(--dark);}
.filter-count{font-size:13px;color:var(--gray);}
.filter-count strong{color:var(--dark);font-weight:700;}

/* ── PROJECT GRID ── */
.projects-wrap{max-width:1300px;margin:0 auto;padding:48px 52px 80px;}
.projects-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:24px;
}
.proj-card{
  background:var(--white);border-radius:14px;
  overflow:hidden;cursor:pointer;
  border:1px solid var(--border);
  transition:transform .3s,box-shadow .3s;
  position:relative;
}
.proj-card:hover{transform:translateY(-6px);box-shadow:0 24px 60px rgba(0,0,0,0.12);}

.proj-card-img{
  width:100%;height:240px;
  object-fit:cover;display:block;
  transition:transform .6s ease;
  filter:brightness(0.92);
}
.proj-card:hover .proj-card-img{transform:scale(1.04);}

.proj-card-img-wrap{overflow:hidden;position:relative;}

.proj-card-zoom{
  position:absolute;top:12px;right:12px;
  width:34px;height:34px;border-radius:50%;
  background:rgba(0,0,0,0.5);backdrop-filter:blur(6px);
  display:flex;align-items:center;justify-content:center;
  font-size:14px;opacity:0;transform:scale(.7);
  transition:opacity .25s,transform .25s;
  pointer-events:none;
}
.proj-card:hover .proj-card-zoom{opacity:1;transform:scale(1);}

.proj-card-body{padding:20px 22px 24px;}
.proj-card-tag{
  display:inline-flex;align-items:center;
  background:rgba(139,0,0,0.08);color:var(--red2);
  font-size:10px;font-weight:700;letter-spacing:2px;
  text-transform:uppercase;padding:4px 12px;border-radius:100px;
  margin-bottom:10px;
}
.proj-card-title{font-size:17px;font-weight:700;letter-spacing:-.3px;margin-bottom:6px;line-height:1.3;}
.proj-card-meta{font-size:12px;color:var(--gray);}
.proj-card-desc{font-size:13px;color:var(--gray);line-height:1.7;margin-top:10px;font-weight:300;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}

/* Empty state */
.empty-projects{text-align:center;padding:80px 20px;color:var(--gray);}
.empty-projects-icon{font-size:56px;margin-bottom:16px;}

/* ── LIGHTBOX (sama dengan homepage) ── */
#lightbox{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0);opacity:0;visibility:hidden;transition:opacity .35s,background .35s;}
#lightbox.active{opacity:1;visibility:visible;background:rgba(0,0,0,0.92);}
#lightbox.active .lb-panel{transform:scale(1) translateY(0);opacity:1;}
.lb-panel{position:relative;max-width:920px;width:94%;max-height:90vh;display:flex;flex-direction:column;border-radius:16px;overflow:hidden;background:#111;transform:scale(.92) translateY(24px);opacity:0;transition:transform .38s cubic-bezier(.22,1,.36,1),opacity .35s;box-shadow:0 32px 80px rgba(0,0,0,.7);}
.lb-img-wrap{position:relative;width:100%;max-height:62vh;overflow:hidden;background:#0a0a0a;display:flex;align-items:center;justify-content:center;}
.lb-img-wrap img{width:100%;height:100%;object-fit:cover;display:block;transition:opacity .3s;}
.lb-img-wrap img.loading{opacity:0;}
.lb-info{padding:24px 28px;background:#111;border-top:1px solid rgba(255,255,255,.08);}
.lb-tag{display:inline-flex;align-items:center;background:var(--red);color:#fff;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 12px;border-radius:100px;margin-bottom:10px;}
.lb-title{font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.5px;line-height:1.2;margin-bottom:6px;}
.lb-meta{font-size:13px;color:rgba(255,255,255,.4);margin-bottom:8px;}
.lb-desc{font-size:13px;color:rgba(255,255,255,.55);line-height:1.7;display:none;}
.lb-desc.has-content{display:block;}
.lb-arrow{position:absolute;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15);color:#fff;font-size:18px;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:10;transition:background .2s,transform .2s;user-select:none;}
.lb-arrow:hover{background:rgba(139,0,0,.6);transform:translateY(-50%) scale(1.1);}
.lb-prev{left:14px;}.lb-next{right:14px;}
.lb-arrow.hidden{opacity:0;pointer-events:none;}
.lb-close{position:absolute;top:14px;right:14px;z-index:20;width:40px;height:40px;border-radius:50%;background:rgba(0,0,0,.6);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15);color:#fff;font-size:18px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s,transform .2s;}
.lb-close:hover{background:rgba(139,0,0,.8);transform:scale(1.1);}
.lb-dots{display:flex;gap:6px;justify-content:center;padding:14px 0 0;}
.lb-dot{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.2);transition:background .25s,transform .25s;cursor:pointer;}
.lb-dot.active{background:var(--red3);transform:scale(1.4);}
.lb-counter{position:absolute;top:14px;left:14px;background:rgba(0,0,0,.55);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.7);font-size:12px;font-weight:600;padding:5px 12px;border-radius:100px;}
.lb-kbd-hint{position:absolute;bottom:14px;left:50%;transform:translateX(-50%);color:rgba(255,255,255,.25);font-size:11px;letter-spacing:1px;white-space:nowrap;pointer-events:none;}

/* ── FOOTER mini ── */
.page-footer{background:var(--dark);padding:40px 52px;text-align:center;}
.page-footer p{font-size:12px;color:rgba(255,255,255,.25);}

/* ── RESPONSIVE ── */
@media(max-width:1024px){.projects-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:768px){
  nav{padding:0 20px;}
  .nav-links{display:none;}
  .page-hero{padding:100px 24px 48px;}
  .filter-bar{padding:12px 20px;}
  .projects-wrap{padding:32px 20px 60px;}
  .projects-grid{grid-template-columns:1fr;gap:16px;}
  .proj-card-img{height:200px;}
  .lb-panel{border-radius:12px;}
  .lb-info{padding:16px 18px;}
  .lb-title{font-size:16px;}
  .lb-kbd-hint{display:none;}
  .page-footer{padding:28px 20px;}
}
</style>
</head>
<body>

<div id="cursor" class="cursor"></div>
<div id="cursor-ring" class="cursor-ring"></div>
<div id="progress"></div>

<!-- NAV -->
<nav>
  <a href="{{ route('home') }}" class="nav-brand">
    <img src="{{ asset('images/logo-red.png') }}" alt="{{ $company['company_name'] ?? 'Jaya Bangun' }}">
  </a>
  <ul class="nav-links">
    <li><a href="{{ route('home') }}#about">Tentang</a></li>
    <li><a href="{{ route('home') }}#services">Layanan</a></li>
    <li><a href="{{ route('projects') }}" class="active">Proyek</a></li>
    <li><a href="{{ route('home') }}#process">Proses</a></li>
    <li><a href="{{ route('home') }}#testimonials">Testimoni</a></li>
    <li><a href="{{ route('home') }}#contact">Kontak</a></li>
  </ul>
  <a href="{{ route('home') }}" class="nav-back">← Kembali ke Beranda</a>
</nav>

<!-- PAGE HERO -->
<div class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="page-hero-inner">
    <div class="page-label">Portofolio</div>
    <h1 class="page-title">Proyek <em>Unggulan</em><br>Kami</h1>
    <p class="page-desc">Dari gedung komersial hingga infrastruktur sipil — setiap proyek adalah bukti komitmen kami terhadap kualitas dan ketepatan waktu.</p>
  </div>
</div>

<!-- FILTER BAR -->
<div class="filter-bar">
  <div class="filter-inner">
    <div class="filter-tabs">
      <a href="{{ route('projects') }}"
         class="ft {{ !$category || $category === 'semua' ? 'active' : '' }}">
        Semua ({{ \App\Models\Project::active()->count() }})
      </a>
      @foreach($categories as $cat)
      <a href="{{ route('projects', ['kategori' => $cat]) }}"
         class="ft {{ $category === $cat ? 'active' : '' }}">
        {{ $cat }} ({{ \App\Models\Project::active()->where('category',$cat)->count() }})
      </a>
      @endforeach
    </div>
    <div class="filter-count">
      Menampilkan <strong>{{ $projects->count() }}</strong> proyek
    </div>
  </div>
</div>

<!-- PROJECTS GRID -->
<div class="projects-wrap">
  @if($projects->isEmpty())
  <div class="empty-projects">
    <div class="empty-projects-icon">🏗️</div>
    <p style="font-size:18px;font-weight:600;color:var(--dark);margin-bottom:8px;">Tidak ada proyek ditemukan</p>
    <p>Coba pilih kategori lain atau <a href="{{ route('projects') }}" style="color:var(--red2);">lihat semua proyek</a>.</p>
  </div>
  @else
  <div class="projects-grid" id="projects-grid">
    @foreach($projects as $i => $project)
    <div class="proj-card"
         data-img="{{ $project->image_url }}"
         data-title="{{ $project->title }}"
         data-category="{{ $project->category }}"
         data-year="{{ $project->year }}"
         data-location="{{ $project->location }}"
         data-desc="{{ $project->description }}"
         data-index="{{ $i }}"
         onclick="openLightbox({{ $i }})">
      <div class="proj-card-img-wrap">
        <img class="proj-card-img" src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
        <div class="proj-card-zoom">🔍</div>
      </div>
      <div class="proj-card-body">
        <div class="proj-card-tag">{{ $project->category }}</div>
        <div class="proj-card-title">{{ $project->title }}</div>
        <div class="proj-card-meta">{{ $project->year }} · {{ $project->location }}</div>
        @if($project->description)
        <div class="proj-card-desc">{{ $project->description }}</div>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>

<!-- FOOTER mini -->
<div class="page-footer">
  <p>© {{ date('Y') }} {{ $company['company_name'] ?? 'PT. Jaya Bangun Konstruksi' }} · <a href="{{ route('home') }}" style="color:var(--red3);">Kembali ke Beranda</a></p>
</div>

<!-- LIGHTBOX -->
<div id="lightbox" onclick="handleLBClick(event)">
  <div class="lb-panel" id="lb-panel">
    <button class="lb-close" onclick="closeLightbox()" title="ESC">✕</button>
    <div class="lb-counter" id="lb-counter"></div>
    <div class="lb-img-wrap">
      <img id="lb-img" src="" alt="">
      <button class="lb-arrow lb-prev" id="lb-prev" onclick="lbNav(-1)">‹</button>
      <button class="lb-arrow lb-next" id="lb-next" onclick="lbNav(1)">›</button>
    </div>
    <div class="lb-info">
      <div id="lb-tag"   class="lb-tag"></div>
      <div id="lb-title" class="lb-title"></div>
      <div id="lb-meta"  class="lb-meta"></div>
      <div id="lb-desc"  class="lb-desc"></div>
      <div class="lb-dots" id="lb-dots"></div>
    </div>
    <div class="lb-kbd-hint">← → navigasi · ESC tutup</div>
  </div>
</div>

<script>
// Custom cursor
const cur=document.getElementById('cursor'),ring=document.getElementById('cursor-ring');
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';ring.style.left=e.clientX+'px';ring.style.top=e.clientY+'px';});
document.querySelectorAll('a,button,.proj-card,.ft').forEach(el=>{
  el.addEventListener('mouseenter',()=>{cur.style.transform='translate(-50%,-50%) scale(2)';ring.style.width='56px';ring.style.height='56px';ring.style.borderColor='rgba(139,0,0,0.6)';});
  el.addEventListener('mouseleave',()=>{cur.style.transform='translate(-50%,-50%) scale(1)';ring.style.width='36px';ring.style.height='36px';ring.style.borderColor='rgba(139,0,0,0.4)';});
});

// Scroll progress
const prog=document.getElementById('progress');
window.addEventListener('scroll',()=>{const sc=document.documentElement.scrollTop,sh=document.documentElement.scrollHeight-window.innerHeight;prog.style.width=(sc/sh*100)+'%';});

// ── Lightbox ──────────────────────────────────────────────────────
const lbData=[];
document.querySelectorAll('.proj-card[data-img]').forEach((el,i)=>{
  lbData.push({
    img:      el.dataset.img,
    title:    el.dataset.title,
    category: el.dataset.category,
    year:     el.dataset.year,
    location: el.dataset.location,
    desc:     el.dataset.desc||'',
  });
});

let lbCurrent=0,lbTotal=lbData.length,touchStartX=0;

// Build dots
const dotsEl=document.getElementById('lb-dots');
lbData.forEach((_,i)=>{
  const d=document.createElement('div');
  d.className='lb-dot'+(i===0?' active':'');
  d.onclick=(e)=>{e.stopPropagation();openLightbox(i);};
  dotsEl.appendChild(d);
});

function openLightbox(index){
  lbCurrent=index; renderLB();
  document.getElementById('lightbox').classList.add('active');
  document.body.style.overflow='hidden';
}
function closeLightbox(){
  document.getElementById('lightbox').classList.remove('active');
  document.body.style.overflow='';
}
function renderLB(){
  const d=lbData[lbCurrent];
  const img=document.getElementById('lb-img');
  img.classList.add('loading');
  img.src=d.img; img.alt=d.title;
  img.onload=()=>img.classList.remove('loading');

  document.getElementById('lb-tag').textContent=d.category;
  document.getElementById('lb-title').textContent=d.title;
  document.getElementById('lb-meta').textContent=d.year+' · '+d.location;

  const descEl=document.getElementById('lb-desc');
  if(d.desc&&d.desc.trim()){descEl.textContent=d.desc;descEl.classList.add('has-content');}
  else{descEl.textContent='';descEl.classList.remove('has-content');}

  document.getElementById('lb-counter').textContent=(lbCurrent+1)+' / '+lbTotal;
  document.querySelectorAll('.lb-dot').forEach((dot,i)=>dot.classList.toggle('active',i===lbCurrent));
  document.getElementById('lb-prev').classList.toggle('hidden',lbCurrent===0);
  document.getElementById('lb-next').classList.toggle('hidden',lbCurrent===lbTotal-1);
}
function lbNav(dir){const n=lbCurrent+dir;if(n>=0&&n<lbTotal)openLightbox(n);}
function handleLBClick(e){if(e.target===document.getElementById('lightbox'))closeLightbox();}

document.addEventListener('keydown',e=>{
  if(!document.getElementById('lightbox').classList.contains('active'))return;
  if(e.key==='Escape')closeLightbox();
  if(e.key==='ArrowLeft')lbNav(-1);
  if(e.key==='ArrowRight')lbNav(1);
});
document.getElementById('lb-panel').addEventListener('touchstart',e=>{touchStartX=e.changedTouches[0].screenX;},{passive:true});
document.getElementById('lb-panel').addEventListener('touchend',e=>{const diff=touchStartX-e.changedTouches[0].screenX;if(Math.abs(diff)>50)lbNav(diff>0?1:-1);},{passive:true});
</script>
</body>
</html>
