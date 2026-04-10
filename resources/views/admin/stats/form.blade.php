@extends('admin.layouts.app')
@section('title', $stat->exists ? 'Edit Statistik' : 'Tambah Statistik')
@section('page-title', $stat->exists ? 'Edit Statistik' : 'Tambah Statistik')
@section('breadcrumb','Statistik')
@section('content')
<div class="card" style="max-width:600px;">
  <div class="card-hd">
    <span class="card-title">{{ $stat->exists ? '✏️ Edit Statistik' : '➕ Tambah Statistik Baru' }}</span>
  </div>
  <div class="card-bd">
    <form method="POST" action="{{ $stat->exists ? route('admin.stats.update',$stat) : route('admin.stats.store') }}">
      @csrf
      @if($stat->exists) @method('PUT') @endif

      <div class="frow">
        <div class="fg">
          <label class="fl">Icon (Emoji) *</label>
          <input type="text" name="icon" class="fc" value="{{ old('icon', $stat->icon) }}" placeholder="🏢" required>
        </div>
        <div class="fg">
          <label class="fl">Urutan Tampil *</label>
          <input type="number" name="order" class="fc" value="{{ old('order', $stat->order ?? 0) }}" min="0" required>
        </div>
      </div>

      <div class="frow">
        <div class="fg">
          <label class="fl">Nilai *</label>
          <input type="text" name="value" class="fc" value="{{ old('value', $stat->value) }}" placeholder="280" required>
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Hanya angka, contoh: 280</small>
        </div>
        <div class="fg">
          <label class="fl">Suffix *</label>
          <input type="text" name="suffix" class="fc" value="{{ old('suffix', $stat->suffix) }}" placeholder="+" required>
          <small style="color:#64748b;font-size:11px;margin-top:4px;display:block;">Contoh: +, %, M+, rb+</small>
        </div>
      </div>

      <div class="fg">
        <label class="fl">Label Keterangan *</label>
        <input type="text" name="label" class="fc" value="{{ old('label', $stat->label) }}" placeholder="Proyek Diselesaikan" required>
      </div>

      @if(old('value') || $stat->exists)
      <div style="background:#252c3d;border:1px solid #2a3040;border-radius:8px;padding:16px;margin-bottom:20px;">
        <p style="font-size:11px;color:#64748b;margin-bottom:8px;text-transform:uppercase;letter-spacing:1px;">Preview</p>
        <div style="font-size:32px;font-weight:900;color:#fff;line-height:1;">
          {{ old('value', $stat->value ?? '0') }}<sup style="font-size:0.45em;color:#C0001C;">{{ old('suffix', $stat->suffix ?? '+') }}</sup>
        </div>
        <div style="font-size:12px;color:#64748b;margin-top:6px;">{{ old('label', $stat->label ?? 'Label') }}</div>
      </div>
      @endif

      <div class="fg">
        <div class="fchk">
          <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $stat->is_active ?? true) ? 'checked' : '' }}>
          <label for="is_active">Aktif (tampil di website)</label>
        </div>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <a href="{{ route('admin.stats.index') }}" class="btn btn-sec">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
