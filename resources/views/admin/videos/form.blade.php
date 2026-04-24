@extends('admin.layouts.app')
@section('title', $video->exists ? 'Edit Video' : 'Upload Video')
@section('page-title', $video->exists ? 'Edit Video' : 'Upload Video')
@section('breadcrumb','Video')
@section('content')
<div class="card" style="max-width:680px;">
  <div class="card-hd">
    <span class="card-title">{{ $video->exists ? '✏️ Edit Video' : '🎬 Upload Video Baru' }}</span>
  </div>
  <div class="card-bd">
    <form method="POST"
          action="{{ $video->exists ? route('admin.videos.update',$video) : route('admin.videos.store') }}"
          enctype="multipart/form-data">
      @csrf
      @if($video->exists) @method('PUT') @endif

      <div class="fg">
        <label class="fl">Judul Video *</label>
        <input type="text" name="title" class="fc"
               value="{{ old('title', $video->title) }}"
               placeholder="Proses Konstruksi Gedung XYZ" required>
      </div>

      <div class="fg">
        <label class="fl">File Video * (MP4, MOV, WebM — maks. 50MB)</label>
        @if($video->exists)
        <div style="margin-bottom:10px;">
          <video src="{{ $video->video_url }}" controls style="width:100%;max-height:200px;border-radius:8px;background:#000;"></video>
          <p style="font-size:11px;color:#64748b;margin-top:4px;">Video saat ini — upload baru untuk mengganti</p>
        </div>
        @endif
        <input type="file" name="video_file" class="fc"
               accept="video/mp4,video/quicktime,video/webm"
               {{ $video->exists ? '' : 'required' }}>
      </div>

      <div class="fg">
        <label class="fl">Thumbnail (opsional — gambar cover)</label>
        @if($video->exists && $video->thumbnail_url)
        <img src="{{ $video->thumbnail_url }}" style="height:80px;border-radius:6px;margin-bottom:8px;">
        @endif
        <input type="file" name="thumbnail" class="fc" accept="image/jpeg,image/png,image/webp">
        <div class="fhint">Jika tidak diisi, video akan tampil tanpa thumbnail khusus</div>
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
@endsection