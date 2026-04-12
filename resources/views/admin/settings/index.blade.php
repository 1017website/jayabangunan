@extends('admin.layouts.app')
@section('title','Pengaturan Website')
@section('page-title','Pengaturan Website')
@section('breadcrumb','Pengaturan')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
  @csrf

  {{-- ── HERO ─────────────────────────────────────────────────────────── --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">🦸 Section Hero</span>
      <small style="color:#64748b;font-size:12px;">Bagian utama paling atas website</small>
    </div>
    <div class="card-bd">
      <div class="frow">
        <div class="fg">
          <label class="fl">Judul Utama (baris 1)</label>
          <input type="text" name="settings[hero_title]" class="fc" value="{{ $hero['hero_title'] ?? 'Membangun' }}" placeholder="Membangun">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Font tebal besar — contoh: "Membangun"</small>
        </div>
        <div class="fg">
          <label class="fl">Judul Utama (baris 2 — italic merah)</label>
          <input type="text" name="settings[hero_subtitle]" class="fc" value="{{ $hero['hero_subtitle'] ?? 'Indonesia' }}" placeholder="Indonesia">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Font serif italic — contoh: "Indonesia"</small>
        </div>
      </div>

      <div class="fg">
        <label class="fl">Badge / Tagline Kecil</label>
        <input type="text" name="settings[hero_badge]" class="fc" value="{{ $hero['hero_badge'] ?? '' }}" placeholder="Sejak 2008 · Bersertifikat ISO 9001">
      </div>

      <div class="fg">
        <label class="fl">Deskripsi Hero</label>
        <textarea name="settings[hero_description]" class="fta" rows="3">{{ $hero['hero_description'] ?? '' }}</textarea>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Teks Tombol Primer</label>
          <input type="text" name="settings[hero_btn_primary]" class="fc" value="{{ $hero['hero_btn_primary'] ?? 'Lihat Proyek' }}">
        </div>
        <div class="fg">
          <label class="fl">Teks Tombol Sekunder</label>
          <input type="text" name="settings[hero_btn_secondary]" class="fc" value="{{ $hero['hero_btn_secondary'] ?? 'Konsultasi Gratis →' }}">
        </div>
      </div>

      <x-admin.image-upload
        label="Gambar Background Hero"
        uploadName="upload_hero_bg_image"
        urlName="settings[hero_bg_image]"
        :currentUrl="$hero['hero_bg_image'] ?? null"
        hint="Ukuran ideal: 1800×1000px. Akan tampil sebagai background gelap di bagian atas website."
      />
    </div>
  </div>

  {{-- ── ABOUT ────────────────────────────────────────────────────────── --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">🏢 Section Tentang Kami</span>
    </div>
    <div class="card-bd">
      <div class="fg">
        <label class="fl">Paragraf 1</label>
        <textarea name="settings[about_text1]" class="fta" rows="3">{{ $about['about_text1'] ?? '' }}</textarea>
      </div>
      <div class="fg">
        <label class="fl">Paragraf 2</label>
        <textarea name="settings[about_text2]" class="fta" rows="3">{{ $about['about_text2'] ?? '' }}</textarea>
      </div>
      <div class="frow">
        <div class="fg">
          <label class="fl">Badge Tahun Berdiri</label>
          <input type="text" name="settings[about_years]" class="fc" value="{{ $about['about_years'] ?? '15+' }}" placeholder="15+">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Ditampilkan di badge lingkaran merah</small>
        </div>
      </div>
      <div class="frow">
        <x-admin.image-upload
          label="Foto Utama (kanan atas)"
          uploadName="upload_about_image_main"
          urlName="settings[about_image_main]"
          :currentUrl="$about['about_image_main'] ?? null"
          hint="Ukuran ideal: 900×600px"
        />
        <x-admin.image-upload
          label="Foto Kecil (kiri bawah)"
          uploadName="upload_about_image_sub"
          urlName="settings[about_image_sub]"
          :currentUrl="$about['about_image_sub'] ?? null"
          hint="Ukuran ideal: 600×400px"
        />
      </div>
    </div>
  </div>

  {{-- ── COMPANY INFO ─────────────────────────────────────────────────── --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">🏗️ Informasi Perusahaan</span>
      <small style="color:#64748b;font-size:12px;">Tampil di footer, kontak, dan navbar WhatsApp</small>
    </div>
    <div class="card-bd">
      <div class="frow">
        <div class="fg">
          <label class="fl">Nama Perusahaan</label>
          <input type="text" name="settings[company_name]" class="fc" value="{{ $company['company_name'] ?? '' }}" placeholder="PT. Jaya Bangun Konstruksi">
        </div>
        <div class="fg">
          <label class="fl">Tahun Berdiri</label>
          <input type="text" name="settings[company_founded]" class="fc" value="{{ $company['company_founded'] ?? '2008' }}" placeholder="2008">
        </div>
      </div>

      <div class="fg">
        <label class="fl">Tagline Perusahaan</label>
        <textarea name="settings[company_tagline]" class="fta" rows="2">{{ $company['company_tagline'] ?? '' }}</textarea>
      </div>

      <div class="fg">
        <label class="fl">Alamat Lengkap</label>
        <input type="text" name="settings[company_address]" class="fc" value="{{ $company['company_address'] ?? '' }}" placeholder="Jl. Raya Darmo No. 88, Surabaya">
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Nomor Telepon</label>
          <input type="text" name="settings[company_phone]" class="fc" value="{{ $company['company_phone'] ?? '' }}" placeholder="+62 31 5678 9012">
        </div>
        <div class="fg">
          <label class="fl">Nomor WhatsApp</label>
          <input type="text" name="settings[company_whatsapp]" class="fc" value="{{ $company['company_whatsapp'] ?? '' }}" placeholder="6231567890">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Format internasional tanpa + (contoh: 628123456789)</small>
        </div>
      </div>

      <div class="fg">
        <label class="fl">Email</label>
        <input type="email" name="settings[company_email]" class="fc" value="{{ $company['company_email'] ?? '' }}" placeholder="info@jayabangun.co.id">
      </div>
    </div>
  </div>

  {{-- ── SOCIAL MEDIA ─────────────────────────────────────────────────── --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">📱 Media Sosial</span>
    </div>
    <div class="card-bd">
      <div class="frow">
        <div class="fg">
          <label class="fl">Instagram URL</label>
          <input type="url" name="settings[social_instagram]" class="fc" value="{{ $social['social_instagram'] ?? '' }}" placeholder="https://instagram.com/...">
        </div>
        <div class="fg">
          <label class="fl">Facebook URL</label>
          <input type="url" name="settings[social_facebook]" class="fc" value="{{ $social['social_facebook'] ?? '' }}" placeholder="https://facebook.com/...">
        </div>
      </div>
      <div class="fg">
        <label class="fl">YouTube URL</label>
        <input type="url" name="settings[social_youtube]" class="fc" value="{{ $social['social_youtube'] ?? '' }}" placeholder="https://youtube.com/...">
      </div>
    </div>
  </div>

  <div style="display:flex;gap:12px;position:sticky;bottom:0;background:#0f1117;padding:16px 0;border-top:1px solid #2a3040;margin-top:8px;">
    <button type="submit" class="btn btn-primary" style="font-size:15px;padding:12px 32px;">💾 Simpan Semua Pengaturan</button>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-sec">🌐 Lihat Website</a>
  </div>

</form>
@endsection
