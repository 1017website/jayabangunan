@extends('admin.layouts.app')
@section('title','Pengaturan SEO')
@section('page-title','Pengaturan SEO')
@section('breadcrumb','SEO')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<form method="POST" action="{{ route('admin.seo.update') }}" enctype="multipart/form-data">
  @csrf

  {{-- Meta Dasar --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">🔍 Meta Tags Dasar</span>
      <small style="color:#64748b;font-size:12px;">Yang muncul di hasil pencarian Google</small>
    </div>
    <div class="card-bd">

      <div class="fg">
        <label class="fl">
          SEO Title *
          <span id="title-count" style="font-weight:400;color:#64748b;text-transform:none;letter-spacing:0;font-size:11px;margin-left:8px;">0/60 karakter</span>
        </label>
        <input type="text" name="settings[seo_title]" id="seo-title" class="fc"
               value="{{ $seo['seo_title'] ?? '' }}"
               placeholder="PT. Jaya Bangun Konstruksi — Kontraktor Terpercaya Jawa Timur"
               maxlength="70" required
               oninput="countChars(this,'title-count',60)">
        <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Optimal: 50–60 karakter. Ini yang muncul sebagai judul di Google.</small>
      </div>

      <div class="fg">
        <label class="fl">
          Meta Description *
          <span id="desc-count" style="font-weight:400;color:#64748b;text-transform:none;letter-spacing:0;font-size:11px;margin-left:8px;">0/155 karakter</span>
        </label>
        <textarea name="settings[seo_description]" id="seo-desc" class="fta" rows="3"
                  placeholder="Deskripsi singkat website untuk mesin pencari..."
                  maxlength="160" required
                  oninput="countChars(this,'desc-count',155)">{{ $seo['seo_description'] ?? '' }}</textarea>
        <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Optimal: 120–155 karakter. Ini yang muncul sebagai deskripsi di Google.</small>
      </div>

      <div class="fg">
        <label class="fl">Keywords</label>
        <input type="text" name="settings[seo_keywords]" class="fc"
               value="{{ $seo['seo_keywords'] ?? '' }}"
               placeholder="kontraktor surabaya, jasa konstruksi, arsitektur surabaya">
        <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Pisahkan dengan koma. (Opsional — Google modern tidak terlalu bergantung pada ini)</small>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Robots</label>
          <select name="settings[seo_robots]" class="fs">
            <option value="index, follow"   {{ ($seo['seo_robots'] ?? '') == 'index, follow'   ? 'selected' : '' }}>index, follow (Rekomendasi)</option>
            <option value="noindex, follow" {{ ($seo['seo_robots'] ?? '') == 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
            <option value="noindex, nofollow" {{ ($seo['seo_robots'] ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
          </select>
        </div>
        <div class="fg">
          <label class="fl">Canonical URL</label>
          <input type="url" name="settings[seo_canonical]" class="fc"
                 value="{{ $seo['seo_canonical'] ?? '' }}"
                 placeholder="https://jayabangun.co.id">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Kosongkan jika tidak perlu</small>
        </div>
      </div>

      {{-- Preview Google SERP --}}
      <div style="background:#252c3d;border:1px solid #2a3040;border-radius:10px;padding:20px;margin-top:8px;">
        <p style="font-size:11px;color:#64748b;margin-bottom:12px;text-transform:uppercase;letter-spacing:1px;">📱 Preview di Google</p>
        <div style="font-size:12px;color:#94a3b8;margin-bottom:4px;">{{ url('/') }}</div>
        <div id="preview-title" style="font-size:18px;color:#60a5fa;margin-bottom:4px;line-height:1.3;">{{ $seo['seo_title'] ?? 'Judul Website' }}</div>
        <div id="preview-desc"  style="font-size:13px;color:#94a3b8;line-height:1.6;">{{ $seo['seo_description'] ?? 'Deskripsi website akan muncul di sini...' }}</div>
      </div>

    </div>
  </div>

  {{-- Open Graph / Social Media --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">📱 Open Graph (Facebook, WhatsApp, Twitter)</span>
      <small style="color:#64748b;font-size:12px;">Tampilan saat link di-share ke media sosial</small>
    </div>
    <div class="card-bd">
      <x-admin.image-upload
        label="OG Image (Gambar Thumbnail Share)"
        uploadName="upload_seo_og_image"
        urlName="settings[seo_og_image]"
        :currentUrl="$seo['seo_og_image'] ?? null"
        hint="Ukuran ideal: 1200×630 px — muncul saat link dibagikan ke WhatsApp, Facebook, Twitter."
      />
      <div class="fg">
        <label class="fl">OG Type</label>
        <select name="settings[seo_og_type]" class="fs">
          <option value="website" {{ ($seo['seo_og_type'] ?? 'website') == 'website' ? 'selected' : '' }}>website</option>
          <option value="article" {{ ($seo['seo_og_type'] ?? '') == 'article' ? 'selected' : '' }}>article</option>
        </select>
      </div>
    </div>
  </div>

  {{-- Google Tools --}}
  <div class="card" style="margin-bottom:24px;">
    <div class="card-hd">
      <span class="card-title">📊 Google Tools</span>
    </div>
    <div class="card-bd">
      <div class="frow">
        <div class="fg">
          <label class="fl">Google Analytics ID</label>
          <input type="text" name="settings[seo_google_analytics]" class="fc"
                 value="{{ $seo['seo_google_analytics'] ?? '' }}"
                 placeholder="G-XXXXXXXXXX">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Format: G-XXXXXXXXXX (GA4) atau UA-XXXXXXX (Universal)</small>
        </div>
        <div class="fg">
          <label class="fl">Google Search Console Verification</label>
          <input type="text" name="settings[seo_google_verification]" class="fc"
                 value="{{ $seo['seo_google_verification'] ?? '' }}"
                 placeholder="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Kode dari Google Search Console (isi bagian content="" saja)</small>
        </div>
      </div>
    </div>
  </div>

  <div style="position:sticky;bottom:0;background:#0f1117;padding:16px 0;border-top:1px solid #2a3040;">
    <button type="submit" class="btn btn-primary" style="font-size:15px;padding:12px 32px;">💾 Simpan Pengaturan SEO</button>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-sec" style="margin-left:12px;">🌐 Lihat Website</a>
  </div>

</form>

<script>
function countChars(input, counterId, optimal) {
  const len = input.value.length;
  const el  = document.getElementById(counterId);
  el.textContent = len + '/' + optimal + ' karakter';
  el.style.color = len > optimal ? '#f87171' : len > optimal * 0.8 ? '#facc15' : '#4ade80';
}

// Live preview
document.getElementById('seo-title').addEventListener('input', function() {
  document.getElementById('preview-title').textContent = this.value || 'Judul Website';
});
document.getElementById('seo-desc').addEventListener('input', function() {
  document.getElementById('preview-desc').textContent = this.value || 'Deskripsi website...';
});

// Hitung awal
countChars(document.getElementById('seo-title'), 'title-count', 60);
countChars(document.getElementById('seo-desc'),  'desc-count',  155);
</script>
@endsection
