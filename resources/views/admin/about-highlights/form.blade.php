@extends('admin.layouts.app')
@section('title', $highlight->exists ? 'Edit Highlight' : 'Tambah Highlight')
@section('page-title', $highlight->exists ? 'Edit Highlight' : 'Tambah Highlight')
@section('breadcrumb','About Highlights')
@section('content')
<div class="card" style="max-width:520px;">
    <div class="card-hd">
        <span class="card-title">{{ $highlight->exists ? '✏️ Edit' : '➕ Tambah' }} Highlight</span>
    </div>
    <div class="card-bd">
        <form method="POST" action="{{ $highlight->exists
      ? route('admin.about-highlights.update', $highlight)
      : route('admin.about-highlights.store') }}">
            @csrf
            @if($highlight->exists) @method('PUT') @endif

            <div class="frow">
                <div class="fg">
                    <label class="fl">Icon (Emoji) *</label>
                    <input type="text" name="icon" class="fc"
                        value="{{ old('icon', $highlight->icon) }}"
                        placeholder="🏅" required>
                </div>
                <div class="fg">
                    <label class="fl">Urutan *</label>
                    <input type="number" name="order" class="fc"
                        value="{{ old('order', $highlight->order ?? 0) }}"
                        min="0" required>
                </div>
            </div>

            <div class="fg">
                <label class="fl">Teks *</label>
                <input type="text" name="text" class="fc"
                    value="{{ old('text', $highlight->text) }}"
                    placeholder="Sertifikat ISO 9001:2015" required maxlength="100">
            </div>

            <div class="fg">
                <div class="fchk">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $highlight->is_active ?? true) ? 'checked' : '' }}>
                    <label for="is_active">Aktif (tampil di website)</label>
                </div>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
                <a href="{{ route('admin.about-highlights.index') }}" class="btn btn-sec">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection