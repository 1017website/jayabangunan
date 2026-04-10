@extends('admin.layouts.app')
@section('title', $project->exists ? 'Edit Proyek' : 'Tambah Proyek')
@section('page-title', $project->exists ? 'Edit Proyek' : 'Tambah Proyek')
@section('breadcrumb','Proyek')
@section('content')
<div class="card" style="max-width:800px;">
  <div class="card-hd">
    <span class="card-title">{{ $project->exists ? '✏️ Edit Proyek' : '➕ Tambah Proyek Baru' }}</span>
  </div>
  <div class="card-bd">
    <form method="POST" action="{{ $project->exists ? route('admin.projects.update',$project) : route('admin.projects.store') }}" enctype="multipart/form-data">
      @csrf
      @if($project->exists) @method('PUT') @endif

      <div class="fg">
        <label class="fl">Judul Proyek *</label>
        <input type="text" name="title" class="fc" value="{{ old('title', $project->title) }}" placeholder="Menara Office Park Surabaya" required>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Kategori *</label>
          <select name="category" class="fs" required>
            @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
          </select>
        </div>
        <div class="fg">
          <label class="fl">Tahun *</label>
          <input type="number" name="year" class="fc" value="{{ old('year', $project->year ?? date('Y')) }}" min="2000" max="2099" required>
        </div>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Lokasi *</label>
          <input type="text" name="location" class="fc" value="{{ old('location', $project->location) }}" placeholder="Surabaya" required>
        </div>
        <div class="fg">
          <label class="fl">Urutan Tampil</label>
          <input type="number" name="order" class="fc" value="{{ old('order', $project->order ?? 0) }}" min="0">
        </div>
      </div>

      <div class="fg">
        <label class="fl">Deskripsi Proyek</label>
        <textarea name="description" class="fta" rows="4" placeholder="Deskripsi singkat tentang proyek...">{{ old('description', $project->description) }}</textarea>
      </div>

      <!-- Image section -->
      <div class="fg">
        <label class="fl">Gambar Proyek</label>
        @if($project->exists && $project->image)
        <div style="margin-bottom:12px;">
          <img src="{{ $project->image_url }}" style="width:160px;height:100px;object-fit:cover;border-radius:8px;border:1px solid #2a3040;">
          <p style="font-size:11px;color:#64748b;margin-top:6px;">Gambar saat ini</p>
        </div>
        @endif
        <div style="display:flex;gap:16px;align-items:flex-start;flex-wrap:wrap;">
          <div style="flex:1;min-width:200px;">
            <label class="fl" style="font-size:11px;">Upload File</label>
            <input type="file" name="image" class="fc" accept="image/*" onchange="previewImage(this)">
            <img id="img-preview" style="display:none;width:120px;height:80px;object-fit:cover;border-radius:6px;margin-top:8px;">
          </div>
          <div style="flex:1;min-width:200px;">
            <label class="fl" style="font-size:11px;">Atau URL Gambar</label>
            <input type="url" name="image_url" class="fc" value="{{ old('image_url', str_starts_with($project->image ?? '', 'http') ? $project->image : '') }}" placeholder="https://...">
          </div>
        </div>
      </div>

      <div style="display:flex;gap:24px;margin-bottom:24px;">
        <div class="fchk">
          <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
          <label for="is_featured">⭐ Proyek Unggulan</label>
        </div>
        <div class="fchk">
          <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}>
          <label for="is_active">✅ Aktif (tampil di website)</label>
        </div>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn btn-primary">💾 Simpan Proyek</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sec">Batal</a>
      </div>
    </form>
  </div>
</div>
<script>
function previewImage(input) {
  const preview = document.getElementById('img-preview');
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection
