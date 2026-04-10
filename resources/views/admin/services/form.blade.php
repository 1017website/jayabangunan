@extends('admin.layouts.app')
@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('page-title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('breadcrumb', 'Layanan')
@section('content')
<div class="card" style="max-width:700px;">
  <div class="card-hd">
    <span class="card-title">{{ $service->exists ? '✏️ Edit Layanan' : '➕ Tambah Layanan Baru' }}</span>
  </div>
  <div class="card-bd">
    <form method="POST" action="{{ $service->exists ? route('admin.services.update',$service) : route('admin.services.store') }}">
      @csrf
      @if($service->exists) @method('PUT') @endif

      <div class="frow">
        <div class="fg">
          <label class="fl">Icon (Emoji) *</label>
          <input type="text" name="icon" class="fc" value="{{ old('icon', $service->icon) }}" placeholder="🏗️" required>
        </div>
        <div class="fg">
          <label class="fl">Urutan Tampil *</label>
          <input type="number" name="order" class="fc" value="{{ old('order', $service->order ?? 0) }}" min="0" required>
        </div>
      </div>

      <div class="fg">
        <label class="fl">Judul Layanan *</label>
        <input type="text" name="title" class="fc" value="{{ old('title', $service->title) }}" placeholder="Kontraktor Umum" required>
      </div>

      <div class="fg">
        <label class="fl">Deskripsi *</label>
        <textarea name="description" class="fta" rows="4" required>{{ old('description', $service->description) }}</textarea>
      </div>

      <div class="fg">
        <div class="fchk">
          <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
          <label for="is_active">Aktif (tampil di website)</label>
        </div>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-sec">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
