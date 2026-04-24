@extends('admin.layouts.app')
@section('title', $video->exists ? 'Edit Video' : 'Tambah Video')
@section('page-title', $video->exists ? 'Edit Video' : 'Tambah Video')
@section('breadcrumb','Video')
@section('content')
<div class="card" style="max-width:640px;">
  <div class="card-hd">
    <span class="card-title">{{ $video->exists ? '✏️ Edit Video' : '🎬 Tambah Video YouTube' }}</span>
  </div>
  <div class="card-bd">
    <form method="POST"
      action="{{ $video->exists ? route('admin.videos.update',$video) : route('admin.videos.store') }}">
      @csrf
      @if($video->exists) @method('PUT') @endif

      <div class="fg">
        <label class="fl">Judul Video *</label>
        <input type="text" name="title" class="fc"
          value="{{ old('title', $video->title) }}"
          placeholder="Proses Konstruksi Gedung XYZ" required>
      </div>

      <div class="fg">
        <label class="fl">URL YouTube *</label>
        <input type="text" name="youtube_url" id="yt-url" class="fc"
          value="{{ old('youtube_url', $video->youtube_url) }}"
          placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX"
          oninput="previewYT(this.value)" required>
        <div class="fhint">
          Mendukung: youtube.com/watch?v=... · youtu.be/... · youtube.com/shorts/... · URL unlisted
        </div>
      </div>

      {{-- Preview thumbnail --}}
      <div id="yt-preview" style="display:none;margin-bottom:16px;">
        <label class="fl" style="margin-bottom:8px;">Preview Thumbnail</label>
        <img id="yt-thumb" src=""
          style="width:100%;max-width:320px;border-radius:8px;border:1px solid #2a3040;">
        <div style="margin-top:8px;display:flex;align-items:center;gap:8px;">
          <span style="font-size:11px;color:#4ade80;">✅ URL YouTube valid</span>
          <a id="yt-link" href="#" target="_blank"
            style="font-size:11px;color:#60a5fa;text-decoration:none;">Buka di YouTube →</a>
        </div>
      </div>
      <div id="yt-invalid" style="display:none;font-size:12px;color:#f87171;margin-bottom:12px;">
        ❌ URL tidak valid. Pastikan dari youtube.com atau youtu.be.
      </div>

      <div class="fg">
        <label class="fl">Deskripsi</label>
        <textarea name="description" class="fta" rows="3"
          placeholder="Deskripsi singkat video...">{{ old('description', $video->description) }}</textarea>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Urutan Tampil *</label>
          <input type="number" name="order" class="fc"
            value="{{ old('order', $video->order ?? 0) }}" min="0" required>
        </div>
        <div class="fg" style="display:flex;align-items:flex-end;padding-bottom:4px;">
          <div class="fchk">
            <input type="checkbox" name="is_active" id="is_active" value="1"
              {{ old('is_active', $video->is_active ?? true) ? 'checked' : '' }}>
            <label for="is_active">Aktif (tampil di website)</label>
          </div>
        </div>
      </div>

      <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-sec">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  function previewYT(url) {
    const regex = /(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
    const match = url.match(regex);
    const preview = document.getElementById('yt-preview');
    const invalid = document.getElementById('yt-invalid');
    const thumb = document.getElementById('yt-thumb');
    const link = document.getElementById('yt-link');

    if (match && match[1]) {
      const id = match[1];
      thumb.src = `https://img.youtube.com/vi/${id}/maxresdefault.jpg`;
      link.href = `https://www.youtube.com/watch?v=${id}`;
      preview.style.display = 'block';
      invalid.style.display = 'none';
    } else if (url.length > 10) {
      preview.style.display = 'none';
      invalid.style.display = 'block';
    } else {
      preview.style.display = 'none';
      invalid.style.display = 'none';
    }
  }

  // Preview saat edit
  @if($video - > exists && $video - > youtube_url)
  previewYT('{{ $video->youtube_url }}');
  @endif
</script>
@endsection