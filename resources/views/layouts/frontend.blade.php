<!DOCTYPE html>
<html lang="id">
<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ Setting::get('company_tagline', 'Mitra konstruksi terpercaya di Jawa Timur') }}">
<title>@yield('title', Setting::get('company_name', 'Jaya Bangun Konstruksi'))</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@stack('head')
<style>
:root{--red:#8B0000;--red2:#A80000;--red3:#C0001C;--white:#FFFFFF;--off:#F7F5F2;--dark:#111111;--gray:#6B6B6B;--lgray:#C8C4BE;--border:rgba(0,0,0,0.09);}
*{margin:0;padding:0;box-sizing:border-box;}html{scroll-behavior:smooth;}
body{font-family:'Outfit',sans-serif;background:var(--white);color:var(--dark);overflow-x:hidden;}
.cursor{width:10px;height:10px;border-radius:50%;background:var(--red3);position:fixed;pointer-events:none;z-index:9999;transition:transform 0.15s,width 0.3s,height 0.3s;transform:translate(-50%,-50%);}
.cursor-ring{width:36px;height:36px;border-radius:50%;border:1.5px solid rgba(139,0,0,0.4);position:fixed;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:transform 0.08s linear,width 0.3s,height 0.3s,border-color 0.3s;}
#preloader{position:fixed;inset:0;z-index:10000;background:var(--dark);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:24px;transition:opacity 0.6s,visibility 0.6s;}
#preloader.hide{opacity:0;visibility:hidden;}
.pre-logo{font-family:'Outfit',sans-serif;font-size:28px;font-weight:800;color:#fff;opacity:0;animation:fadeIn 0.6s 0.3s forwards;}
.pre-logo span{color:var(--red3);}
.pre-bar-wrap{width:200px;height:2px;background:rgba(255,255,255,0.1);overflow:hidden;}
.pre-bar{height:100%;background:var(--red3);width:0;animation:load 1.4s 0.5s ease forwards;}
@keyframes fadeIn{to{opacity:1;}}@keyframes load{to{width:100%;}}
#progress-bar{position:fixed;top:0;left:0;height:2px;background:var(--red3);z-index:9997;width:0;transition:width 0.1s;}
nav{position:fixed;top:0;left:0;right:0;z-index:1000;height:70px;display:flex;align-items:center;justify-content:space-between;padding:0 52px;transition:background 0.4s,box-shadow 0.4s;}
nav.scrolled{background:rgba(255,255,255,0.97);box-shadow:0 1px 0 var(--border);backdrop-filter:blur(12px);}
.nav-brand{font-family:'Outfit',sans-serif;font-size:20px;font-weight:800;color:#fff;text-decoration:none;letter-spacing:-0.5px;transition:color 0.3s;}
.nav-brand span{color:var(--red3);}
nav.scrolled .nav-brand{color:var(--dark);}
.nav-links{display:flex;gap:0;list-style:none;}
.nav-links a{color:rgba(255,255,255,0.75);text-decoration:none;font-size:13px;font-weight:500;padding:0 18px;height:70px;display:flex;align-items:center;letter-spacing:0.2px;transition:color 0.2s;position:relative;}
nav.scrolled .nav-links a{color:var(--gray);}
.nav-links a::after{content:'';position:absolute;bottom:0;left:18px;right:18px;height:2px;background:var(--red3);transform:scaleX(0);transform-origin:left;transition:transform 0.3s;}
.nav-links a:hover,.nav-links a.active{color:var(--dark);}
nav.scrolled .nav-links a:hover{color:var(--dark);}
.nav-links a:hover::after,.nav-links a.active::after{transform:scaleX(1);}
.nav-wa{background:var(--red);color:#fff;padding:10px 22px;border-radius:4px;font-size:13px;font-weight:600;letter-spacing:0.3px;text-decoration:none;display:flex;align-items:center;gap:8px;transition:background 0.2s,transform 0.2s;}
.nav-wa:hover{background:var(--red3);transform:translateY(-1px);}
@media(max-width:1024px){
  .nav-wa{display:none;}
}
/* Hamburger */
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:8px;}
.hamburger span{width:24px;height:2px;background:#fff;transition:all 0.3s;}
nav.scrolled .hamburger span{background:var(--dark);}
/* Mobile Nav */
.mobile-nav{display:none;position:fixed;top:70px;left:0;right:0;background:rgba(255,255,255,0.98);backdrop-filter:blur(20px);box-shadow:0 4px 20px rgba(0,0,0,0.1);z-index:999;padding:16px 0;flex-direction:column;}
.mobile-nav.open{display:flex;}
.mobile-nav a{padding:14px 28px;font-size:14px;font-weight:500;color:var(--dark);text-decoration:none;border-bottom:1px solid var(--border);}
.mobile-nav a:hover{color:var(--red);}

/* ─── HERO ─── */
#hero{min-height:100vh;position:relative;display:flex;align-items:center;overflow:hidden;}
.hero-bg{position:absolute;inset:0;background:#0A0A0A;}
.hero-bg-img{position:absolute;inset:0;background-size:cover;background-position:center;background-repeat:no-repeat;opacity:0.28;filter:grayscale(20%);}
.hero-bg-gradient{position:absolute;inset:0;background:linear-gradient(105deg,rgba(10,10,10,0.97) 0%,rgba(10,10,10,0.75) 50%,rgba(139,0,0,0.15) 100%);}
.hero-grid-lines{position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);background-size:80px 80px;}
.hero-content{position:relative;z-index:2;padding:0 52px;max-width:1300px;width:100%;display:grid;grid-template-columns:1fr 420px;gap:60px;align-items:center;padding-top:70px;}
.hero-chip{display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(255,255,255,0.15);padding:6px 14px;border-radius:100px;font-size:11px;font-weight:500;letter-spacing:1.5px;color:rgba(255,255,255,0.6);text-transform:uppercase;margin-bottom:32px;background:rgba(255,255,255,0.04);backdrop-filter:blur(6px);}
.hero-chip-dot{width:6px;height:6px;border-radius:50%;background:var(--red3);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(192,0,28,0.6);}50%{box-shadow:0 0 0 6px rgba(192,0,28,0);}}
.hero-h1{font-family:'Outfit',sans-serif;font-size:clamp(52px,5.5vw,76px);font-weight:800;line-height:1.0;letter-spacing:-2px;color:#fff;margin-bottom:8px;}
.hero-h1-sub{font-family:"Instrument Serif",serif;font-style:italic;font-size:clamp(52px,5.5vw,80px);font-weight:400;line-height:1.1;letter-spacing:-1px;color:var(--red3);margin-bottom:28px;display:block;}
.hero-desc{font-size:16px;line-height:1.8;color:rgba(255,255,255,0.55);max-width:500px;font-weight:300;margin-bottom:44px;}
.hero-btns{display:flex;gap:14px;flex-wrap:wrap;}
.hbtn-primary{background:var(--red);color:#fff;padding:15px 36px;border-radius:5px;font-size:14px;font-weight:600;letter-spacing:0.3px;text-decoration:none;display:inline-flex;align-items:center;gap:10px;transition:background 0.2s,transform 0.2s,box-shadow 0.2s;box-shadow:0 4px 24px rgba(139,0,0,0.4);}
.hbtn-primary:hover{background:var(--red3);transform:translateY(-2px);box-shadow:0 8px 32px rgba(192,0,28,0.45);}
.hbtn-outline{border:1px solid rgba(255,255,255,0.2);color:rgba(255,255,255,0.8);padding:15px 32px;border-radius:5px;font-size:14px;font-weight:500;text-decoration:none;transition:border-color 0.2s,color 0.2s,background 0.2s;}
.hbtn-outline:hover{border-color:rgba(255,255,255,0.6);color:#fff;background:rgba(255,255,255,0.05);}
.hero-card{background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:36px 32px;backdrop-filter:blur(20px);display:flex;flex-direction:column;gap:24px;}
.hcard-stat{display:flex;align-items:center;gap:16px;padding:18px 0;border-bottom:1px solid rgba(255,255,255,0.08);}
.hcard-stat:last-child{border-bottom:none;padding-bottom:0;}
.hcard-stat:first-child{padding-top:0;}
.hcs-icon{width:48px;height:48px;border-radius:10px;background:rgba(139,0,0,0.25);display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;}
.hcs-n{font-size:30px;font-weight:800;color:#fff;line-height:1;letter-spacing:-1px;}
.hcs-n span{color:var(--red3);}
.hcs-l{font-size:12px;color:rgba(255,255,255,0.45);margin-top:3px;}
.scroll-hint{position:absolute;bottom:36px;left:52px;display:flex;align-items:center;gap:12px;color:rgba(255,255,255,0.35);font-size:11px;letter-spacing:2px;text-transform:uppercase;z-index:2;}
.scroll-line{width:48px;height:1px;background:rgba(255,255,255,0.2);position:relative;overflow:hidden;}
.scroll-line::after{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:var(--red3);animation:scrollLine 2s 2s infinite;}
@keyframes scrollLine{0%{left:-100%;}100%{left:100%;}}

/* ─── TICKER ─── */
.ticker{background:var(--red);padding:13px 0;overflow:hidden;white-space:nowrap;position:relative;z-index:1;}
.ticker-track{display:inline-flex;gap:0;animation:tickerAnim 22s linear infinite;}
.ticker-item{display:inline-flex;align-items:center;gap:28px;padding:0 28px;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.8);}
.ticker-dot{color:rgba(255,255,255,0.3);}
@keyframes tickerAnim{0%{transform:translateX(0);}100%{transform:translateX(-50%);}}

/* ─── SECTIONS ─── */
.sec{padding:110px 52px;}
.sec-inner{max-width:1300px;margin:0 auto;}
.label{display:inline-flex;align-items:center;gap:10px;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--red2);margin-bottom:16px;}
.label::before{content:'';width:24px;height:2px;background:var(--red2);}
.sec-title{font-family:'Outfit',sans-serif;font-size:clamp(38px,4vw,56px);font-weight:800;letter-spacing:-2px;line-height:1.05;margin-bottom:16px;}
.sec-title em{font-family:"Instrument Serif",serif;font-style:italic;font-weight:400;color:var(--red2);letter-spacing:-1px;}

/* ─── ABOUT ─── */
#about{background:var(--off);}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}
.about-imgs{position:relative;height:520px;}
.about-img-main{position:absolute;top:0;right:0;width:80%;height:420px;object-fit:cover;border-radius:8px;}
.about-img-sub{position:absolute;bottom:0;left:0;width:55%;height:260px;object-fit:cover;border-radius:8px;border:4px solid var(--off);box-shadow:0 20px 60px rgba(0,0,0,0.12);}
.about-badge{position:absolute;top:50%;right:-20px;transform:translateY(-50%);background:var(--red);color:#fff;width:100px;height:100px;border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(139,0,0,0.4);}
.about-badge-n{font-size:28px;font-weight:800;line-height:1;}
.about-badge-t{font-size:9px;font-weight:600;letter-spacing:1.5px;text-align:center;opacity:0.8;}
.about-text p{font-size:15px;line-height:1.9;color:var(--gray);font-weight:300;margin-bottom:18px;}
.about-highlights{margin-top:36px;display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);border:1px solid var(--border);border-radius:8px;overflow:hidden;}
.ah-item{background:var(--white);padding:20px 22px;display:flex;align-items:center;gap:14px;transition:background 0.2s;}
.ah-item:hover{background:#faf8f5;}
.ah-icon{font-size:22px;}
.ah-text{font-size:13px;font-weight:500;line-height:1.4;}

/* ─── SERVICES ─── */
#services{background:var(--white);}
.svc-layout{display:grid;grid-template-columns:280px 1fr;gap:80px;align-items:start;margin-top:60px;}
.svc-sidebar{position:sticky;top:90px;}
.svc-sidebar p{font-size:15px;line-height:1.8;color:var(--gray);font-weight:300;margin-top:16px;margin-bottom:32px;}
.svc-grid{display:grid;grid-template-columns:1fr 1fr;gap:2px;background:var(--border);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
.svc-card{background:var(--white);padding:40px 36px;cursor:default;transition:background 0.25s;position:relative;overflow:hidden;}
.svc-card:hover{background:var(--off);}
.svc-card::before{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:var(--red3);transform:scaleX(0);transform-origin:left;transition:transform 0.35s;}
.svc-card:hover::before{transform:scaleX(1);}
.svc-card-icon{width:52px;height:52px;border-radius:12px;background:rgba(139,0,0,0.08);display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:20px;transition:background 0.25s;}
.svc-card:hover .svc-card-icon{background:rgba(139,0,0,0.15);}
.svc-card-title{font-size:17px;font-weight:700;letter-spacing:-0.3px;margin-bottom:10px;}
.svc-card-desc{font-size:13px;line-height:1.75;color:var(--gray);font-weight:300;}
.svc-card-num{position:absolute;top:20px;right:24px;font-size:52px;font-weight:900;color:rgba(0,0,0,0.04);line-height:1;}

/* ─── PROJECTS ─── */
#projects{background:var(--off);}
.proj-header{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;}
.proj-filters{display:flex;gap:8px;flex-wrap:wrap;}
.pf{padding:8px 20px;border-radius:100px;border:1px solid var(--border);font-size:12px;font-weight:500;cursor:pointer;color:var(--gray);background:var(--white);transition:all 0.2s;}
.pf.active,.pf:hover{background:var(--dark);color:#fff;border-color:var(--dark);}
.proj-mosaic{display:grid;grid-template-columns:repeat(12,1fr);grid-template-rows:320px 280px;gap:16px;}
.pm-item{border-radius:10px;overflow:hidden;position:relative;cursor:pointer;}
.pm-item:nth-child(1){grid-column:span 5;grid-row:span 2;}
.pm-item:nth-child(2){grid-column:span 7;}
.pm-item:nth-child(3){grid-column:span 3;}
.pm-item:nth-child(4){grid-column:span 4;}
.pm-item img{width:100%;height:100%;object-fit:cover;transition:transform 0.6s ease;filter:brightness(0.82);}
.pm-item:hover img{transform:scale(1.06);}
.pm-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.78) 0%,transparent 55%);padding:20px 22px;display:flex;flex-direction:column;justify-content:flex-end;opacity:0.9;transition:opacity 0.3s;}
.pm-item:hover .pm-overlay{opacity:1;}
.pm-tag{display:inline-flex;align-items:center;background:var(--red);color:#fff;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 10px;border-radius:100px;width:fit-content;margin-bottom:8px;}
.pm-name{font-size:17px;font-weight:700;color:#fff;letter-spacing:-0.3px;}
.pm-item:nth-child(1) .pm-name{font-size:22px;}
.pm-year{font-size:11px;color:rgba(255,255,255,0.5);margin-top:4px;}

/* ─── STATS ─── */
#stats{background:var(--dark);padding:80px 52px;}
.stats-grid{max-width:1300px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:0;border:1px solid rgba(255,255,255,0.08);border-radius:12px;overflow:hidden;}
.stat-cell{padding:48px 40px;border-right:1px solid rgba(255,255,255,0.08);text-align:center;transition:background 0.3s;position:relative;overflow:hidden;}
.stat-cell:last-child{border-right:none;}
.stat-cell:hover{background:rgba(139,0,0,0.18);}
.stat-cell::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:var(--red3);transform:scaleX(0);transition:transform 0.4s;}
.stat-cell:hover::before{transform:scaleX(1);}
.stat-n{font-size:56px;font-weight:900;color:#fff;line-height:1;letter-spacing:-3px;}
.stat-n sup{font-size:0.45em;letter-spacing:0;vertical-align:super;color:var(--red3);}
.stat-desc{font-size:12px;color:rgba(255,255,255,0.35);margin-top:10px;letter-spacing:0.5px;}

/* ─── PROCESS ─── */
#process{background:var(--white);}
.process-steps{display:grid;grid-template-columns:repeat(5,1fr);gap:0;margin-top:60px;position:relative;}
.process-steps::before{content:'';position:absolute;top:32px;left:10%;right:10%;height:1px;background:var(--border);z-index:0;}
.step{display:flex;flex-direction:column;align-items:center;text-align:center;padding:0 12px;position:relative;z-index:1;}
.step-num{width:64px;height:64px;border-radius:50%;background:var(--white);border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:800;color:var(--red);margin-bottom:20px;transition:background 0.3s,border-color 0.3s,color 0.3s,transform 0.3s;}
.step:hover .step-num{background:var(--red);color:#fff;border-color:var(--red);transform:scale(1.1);}
.step-icon{font-size:24px;margin-bottom:12px;}
.step-title{font-size:14px;font-weight:700;letter-spacing:-0.2px;margin-bottom:8px;}
.step-desc{font-size:12px;color:var(--gray);line-height:1.6;}

/* ─── TESTIMONIALS ─── */
#testimonials{background:var(--off);}
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:52px;}
.testi-card{background:var(--white);border:1px solid var(--border);border-radius:12px;padding:36px 32px;transition:transform 0.3s,box-shadow 0.3s;position:relative;overflow:hidden;}
.testi-card:hover{transform:translateY(-4px);box-shadow:0 20px 60px rgba(0,0,0,0.08);}
.testi-card::after{content:'"';position:absolute;top:-10px;right:20px;font-family:"Instrument Serif",serif;font-size:120px;color:rgba(139,0,0,0.06);line-height:1;pointer-events:none;}
.testi-stars{display:flex;gap:3px;margin-bottom:16px;color:var(--red3);font-size:14px;}
.testi-text{font-size:14px;line-height:1.8;color:var(--gray);font-style:italic;font-weight:300;margin-bottom:24px;}
.testi-author{display:flex;align-items:center;gap:14px;}
.testi-avatar{width:46px;height:46px;border-radius:50%;object-fit:cover;filter:grayscale(20%);}
.testi-name{font-size:14px;font-weight:600;}
.testi-role{font-size:11px;color:var(--gray);margin-top:2px;}

/* ─── CLIENTS ─── */
#clients{background:var(--white);padding:60px 52px;border-top:1px solid var(--border);}
.clients-inner{max-width:1300px;margin:0 auto;}
.clients-label{text-align:center;font-size:11px;color:var(--lgray);letter-spacing:3px;text-transform:uppercase;margin-bottom:32px;}
.clients-row{display:flex;align-items:center;justify-content:center;gap:56px;flex-wrap:wrap;}
.client-name{font-family:"Instrument Serif",serif;font-style:italic;font-size:22px;color:var(--lgray);transition:color 0.2s;cursor:default;}
.client-name:hover{color:var(--dark);}

/* ─── CONTACT ─── */
#contact{background:var(--dark);color:#fff;}
#contact .sec-inner{display:grid;grid-template-columns:1fr 1fr;gap:80px;}
.contact-left .label{color:rgba(200,169,110,0.7);}
.contact-left .label::before{background:rgba(200,169,110,0.7);}
.contact-left .sec-title{color:#fff;}
.contact-left .sec-title em{color:#C8A96E;}
.contact-left p{font-size:15px;line-height:1.85;color:rgba(255,255,255,0.45);font-weight:300;margin:20px 0 40px;}
.cinfo-list{display:flex;flex-direction:column;gap:0;}
.cinfo-item{display:flex;align-items:center;gap:16px;padding:16px 0;border-bottom:1px solid rgba(255,255,255,0.08);}
.cinfo-item:first-child{border-top:1px solid rgba(255,255,255,0.08);}
.cinfo-icon{width:40px;height:40px;border-radius:8px;background:rgba(139,0,0,0.3);display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;}
.cinfo-label{font-size:10px;color:rgba(255,255,255,0.3);letter-spacing:2px;text-transform:uppercase;}
.cinfo-val{font-size:14px;margin-top:3px;}
.cf{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:40px 36px;}
.cf-title{font-size:18px;font-weight:700;margin-bottom:28px;}
.cf-group{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.cf-field{display:flex;flex-direction:column;gap:7px;margin-bottom:16px;}
.cf-field label{font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.4);}
.cf-field input,.cf-field select,.cf-field textarea{background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.12);border-radius:6px;padding:13px 16px;font-size:14px;color:#fff;font-family:'Outfit',sans-serif;transition:border-color 0.2s,background 0.2s;outline:none;width:100%;}
.cf-field input::placeholder,.cf-field textarea::placeholder{color:rgba(255,255,255,0.25);}
.cf-field input:focus,.cf-field select:focus,.cf-field textarea:focus{border-color:rgba(192,0,28,0.5);background:rgba(255,255,255,0.08);}
.cf-field select option{background:#1a1a1a;color:#fff;}
.cf-field textarea{height:120px;resize:vertical;}
.cf-submit{width:100%;background:var(--red);color:#fff;border:none;padding:16px;border-radius:6px;font-size:14px;font-weight:600;cursor:pointer;letter-spacing:0.3px;font-family:'Outfit',sans-serif;transition:background 0.2s,transform 0.2s;margin-top:8px;}
.cf-submit:hover{background:var(--red3);transform:translateY(-1px);}

/* ─── FOOTER ─── */
footer{background:#0A0A0A;padding:60px 52px 30px;}
.footer-inner{max-width:1300px;margin:0 auto;}
.footer-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:48px;padding-bottom:48px;border-bottom:1px solid rgba(255,255,255,0.06);}
.footer-brand{font-family:'Outfit',sans-serif;font-size:22px;font-weight:800;color:#fff;letter-spacing:-0.5px;margin-bottom:16px;}
.footer-brand span{color:var(--red3);}
.footer-grid>div>p{font-size:13px;line-height:1.8;color:rgba(255,255,255,0.3);font-weight:300;}
.footer-col-title{font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:20px;}
.footer-links{list-style:none;display:flex;flex-direction:column;gap:10px;}
.footer-links a{font-size:13px;color:rgba(255,255,255,0.4);text-decoration:none;transition:color 0.2s;}
.footer-links a:hover{color:#fff;}
.footer-bottom{max-width:1300px;margin:0 auto;padding-top:28px;display:flex;justify-content:space-between;font-size:12px;color:rgba(255,255,255,0.2);}

/* ─── ALERTS ─── */
.alert{padding:14px 18px;border-radius:8px;margin-bottom:20px;font-size:14px;}
.alert-success{background:rgba(22,163,74,0.15);border:1px solid rgba(22,163,74,0.3);color:#16a34a;}
.alert-error{background:rgba(220,38,38,0.15);border:1px solid rgba(220,38,38,0.3);color:#dc2626;}

/* ─── REVEAL ─── */
.rv,.rv-l,.rv-r{opacity:0;transform:translateY(30px);transition:opacity 0.7s,transform 0.7s;}
.rv-l{transform:translateX(-40px);}
.rv-r{transform:translateX(40px);}
.rv.on,.rv-l.on,.rv-r.on{opacity:1;transform:none;}
.d1{transition-delay:0.1s;}.d2{transition-delay:0.2s;}.d3{transition-delay:0.3s;}

/* ─── RESPONSIVE ─── */
@media(max-width:1024px){
  nav{padding:0 28px;}
  .nav-links{display:none;}
  .hamburger{display:flex;}
  .hero-content{grid-template-columns:1fr;padding:0 28px;padding-top:90px;}
  .hero-card{display:none;}
  .sec{padding:80px 28px;}
  .about-grid{grid-template-columns:1fr;}
  .about-imgs{height:350px;}
  .svc-layout{grid-template-columns:1fr;}
  .svc-sidebar{position:static;}
  #contact .sec-inner{grid-template-columns:1fr;}
  .footer-grid{grid-template-columns:1fr 1fr;}
  .stats-grid{grid-template-columns:repeat(2,1fr);}
  .stat-cell:nth-child(2){border-right:none;}
  .process-steps{grid-template-columns:repeat(2,1fr);gap:32px;}
  .process-steps::before{display:none;}
  .testi-grid{grid-template-columns:1fr;}
  .proj-mosaic{grid-template-rows:260px 220px;}
}
@media(max-width:640px){
  .hero-h1{font-size:42px;}
  .proj-mosaic{grid-template-columns:1fr;grid-template-rows:auto;}
  .pm-item:nth-child(1),.pm-item:nth-child(2),.pm-item:nth-child(3),.pm-item:nth-child(4){grid-column:1;grid-row:auto;height:220px;}
  .footer-grid{grid-template-columns:1fr;}
  .stats-grid{grid-template-columns:1fr 1fr;}
  #stats{padding:60px 20px;}
}
</style>
</head>
<body>

<div id="cursor" class="cursor"></div>
<div id="cursor-ring" class="cursor-ring"></div>
<div id="progress-bar"></div>

<div id="preloader">
  <div class="pre-logo">JAYA<span>.</span>BANGUN</div>
  <div class="pre-bar-wrap"><div class="pre-bar"></div></div>
</div>

<nav id="navbar">
  <a href="{{ route('home') }}" class="nav-brand">JAYA<span>.</span>BANGUN</a>
  <ul class="nav-links">
    <li><a href="#about">Tentang</a></li>
    <li><a href="#services">Layanan</a></li>
    <li><a href="#projects">Proyek</a></li>
    <li><a href="#process">Cara Kerja</a></li>
    <li><a href="#testimonials">Testimoni</a></li>
    <li><a href="#contact">Kontak</a></li>
  </ul>
  <a href="https://wa.me/{{ Setting::get('company_whatsapp','6231567890') }}" class="nav-wa" target="_blank">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
    WhatsApp
  </a>
  <div class="hamburger" id="hamburger" onclick="toggleMobile()">
    <span></span><span></span><span></span>
  </div>
</nav>

<div class="mobile-nav" id="mobileNav">
  <a href="#about" onclick="closeMobile()">Tentang</a>
  <a href="#services" onclick="closeMobile()">Layanan</a>
  <a href="#projects" onclick="closeMobile()">Proyek</a>
  <a href="#process" onclick="closeMobile()">Cara Kerja</a>
  <a href="#testimonials" onclick="closeMobile()">Testimoni</a>
  <a href="#contact" onclick="closeMobile()">Kontak</a>
  <a href="https://wa.me/{{ Setting::get('company_whatsapp','6231567890') }}"
     target="_blank"
     onclick="closeMobile()"
     style="color:#25d366;font-weight:600;display:flex;align-items:center;gap:8px;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
    </svg>
    Chat WhatsApp
  </a>
</div>

@yield('content')

<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div>
        <div class="footer-brand">JAYA<span>.</span>BANGUN</div>
        <p>{{ Setting::get('company_tagline','Mitra konstruksi terpercaya di Jawa Timur sejak 2008.') }}</p>
      </div>
      <div>
        <div class="footer-col-title">Layanan</div>
        <ul class="footer-links">
          <li><a href="#services">Kontraktor Umum</a></li>
          <li><a href="#services">Teknik Sipil</a></li>
          <li><a href="#services">Desain Arsitektur</a></li>
          <li><a href="#services">Manajemen Proyek</a></li>
          <li><a href="#services">Renovasi</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Perusahaan</div>
        <ul class="footer-links">
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#projects">Portofolio</a></li>
          <li><a href="#process">Cara Kerja</a></li>
          <li><a href="#testimonials">Testimoni</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Kontak</div>
        <ul class="footer-links">
          <li><a href="#">{{ Setting::get('company_address','Jl. Raya Darmo No. 88') }}</a></li>
          <li><a href="tel:{{ Setting::get('company_phone') }}">{{ Setting::get('company_phone','+62 31 5678 9012') }}</a></li>
          <li><a href="mailto:{{ Setting::get('company_email') }}">{{ Setting::get('company_email','info@jayabangun.co.id') }}</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} {{ Setting::get('company_name','PT. Jaya Bangun Konstruksi') }}. Hak cipta dilindungi.</span>
      <span>Dibangun dengan ❤️ di Surabaya</span>
    </div>
  </div>
</footer>

<script>
window.addEventListener("load",()=>{setTimeout(()=>{document.getElementById("preloader").classList.add("hide");},1800);});
const cur=document.getElementById("cursor"),ring=document.getElementById("cursor-ring");
document.addEventListener("mousemove",e=>{cur.style.left=e.clientX+"px";cur.style.top=e.clientY+"px";ring.style.left=e.clientX+"px";ring.style.top=e.clientY+"px";});
document.querySelectorAll("a,button,.pf,.svc-card,.pm-item,.step").forEach(el=>{
  el.addEventListener("mouseenter",()=>{cur.style.transform="translate(-50%,-50%) scale(2)";ring.style.width="56px";ring.style.height="56px";ring.style.borderColor="rgba(139,0,0,0.6)";});
  el.addEventListener("mouseleave",()=>{cur.style.transform="translate(-50%,-50%) scale(1)";ring.style.width="36px";ring.style.height="36px";ring.style.borderColor="rgba(139,0,0,0.4)";});
});
const prog=document.getElementById("progress-bar");
window.addEventListener("scroll",()=>{const sc=document.documentElement.scrollTop,sh=document.documentElement.scrollHeight-window.innerHeight;prog.style.width=(sc/sh*100)+"%";});
const navbar=document.getElementById("navbar");
window.addEventListener("scroll",()=>{navbar.classList.toggle("scrolled",window.scrollY>60);});
const obs=new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add("on");});},{threshold:0.08});
document.querySelectorAll(".rv,.rv-l,.rv-r").forEach(el=>obs.observe(el));
document.querySelectorAll(".pf").forEach(f=>{
  f.addEventListener("click",()=>{
    const cat=f.dataset.cat;
    document.querySelectorAll(".pf").forEach(x=>x.classList.remove("active"));
    f.classList.add("active");
    document.querySelectorAll(".pm-item").forEach(item=>{
      item.style.display=(cat==="all"||item.dataset.cat===cat)?"block":"none";
    });
  });
});
function toggleMobile(){
  document.getElementById("mobileNav").classList.toggle("open");
  const spans = document.querySelectorAll('.hamburger span');
  const isOpen = document.getElementById("mobileNav").classList.contains("open");
  if(isOpen){
    spans[0].style.transform='rotate(45deg) translate(5px,5px)';
    spans[1].style.opacity='0';
    spans[2].style.transform='rotate(-45deg) translate(5px,-5px)';
  } else {
    spans[0].style.transform='none';
    spans[1].style.opacity='1';
    spans[2].style.transform='none';
  }
}
function closeMobile(){
  document.getElementById("mobileNav").classList.remove("open");
  document.querySelectorAll('.hamburger span').forEach(s=>{
    s.style.transform='none';
    s.style.opacity='1';
  });
}
</script>
@stack('scripts')
</body>
</html>
