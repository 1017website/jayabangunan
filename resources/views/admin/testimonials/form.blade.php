@extends('admin.layouts.app')
@section('title', $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('page-title', $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('breadcrumb','Testimoni')
@section('content')
<div class="card" style="max-width:700px;">
  <div class="card-hd">
    <span class="card-title">{{ $testimonial->exists ? '✏️ Edit Testimoni' : '➕ Tambah Testimoni Baru' }}</span>
  </div>
  <div class="card-bd">
    <form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update',$testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
      @csrf
      @if($testimonial->exists) @method('PUT') @endif

      <div class="frow">
        <div class="fg">
          <label class="fl">Nama *</label>
          <input type="text" name="name" class="fc" value="{{ old('name', $testimonial->name) }}" required>
        </div>
        <div class="fg">
          <label class="fl">Jabatan *</label>
          <input type="text" name="role" class="fc" value="{{ old('role', $testimonial->role) }}" placeholder="Direktur" required>
        </div>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Perusahaan</label>
          <input type="text" name="company" class="fc" value="{{ old('company', $testimonial->company) }}" placeholder="PT. Contoh Abadi">
        </div>
        <div class="fg">
          <label class="fl">Rating (1–5) *</label>
          <select name="rating" class="fs" required>
            @for($i=5;$i>=1;$i--)
            <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ str_repeat('★',$i) }} ({{ $i }})</option>
            @endfor
          </select>
        </div>
      </div>

      <div class="fg">
        <label class="fl">Isi Testimoni *</label>
        <textarea name="content" class="fta" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
      </div>

      <!-- Avatar -->
      <div class="fg">
        <label class="fl">Foto Avatar</label>
        @if($testimonial->exists && $testimonial->avatar)
        <div style="margin-bottom:10px;">
          <img src="{{ $testimonial->avatar_url }}" style="width:56px;height:56px;border-radius:50%;object-fit:cover;border:2px solid #2a3040;">
          <p style="font-size:11px;color:#64748b;margin-top:4px;">Foto saat ini</p>
        </div>
        @endif
        <div style="display:flex;gap:16px;align-items:flex-start;flex-wrap:wrap;">
          <div style="flex:1;min-width:180px;">
            <label class="fl" style="font-size:11px;">Upload Foto</label>
            <input type="file" name="avatar" class="fc" accept="image/*">
          </div>
          <div style="flex:1;min-width:180px;">
            <label class="fl" style="font-size:11px;">Atau URL Foto</label>
            <input type="url" name="avatar_url" class="fc" value="{{ old('avatar_url', str_starts_with($testimonial->avatar ?? '', 'http') ? $testimonial->avatar : '') }}" placeholder="https://...">
          </div>
        </div>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Urutan Tampil</label>
          <input type="number" name="order" class="fc" value="{{ old('order', $testimonial->order ?? 0) }}" min="0">
        </div>
        <div class="fg" style="display:flex;align-items:flex-end;padding-bottom:4px;">
          <div class="fchk">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
            <label for="is_active">Aktif (tampil di website)</label>
          </div>
        </div>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sec">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
