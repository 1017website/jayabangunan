@extends('admin.layouts.app')
@section('title','Testimoni')
@section('page-title','Manajemen Testimoni')
@section('breadcrumb','Testimoni')
@section('topbar-actions')
<a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">➕ Tambah Testimoni</a>
@endsection
@section('content')
<div class="card">
  <div class="card-bd" style="padding:0;">
    @if($testimonials->isEmpty())
    <div class="empty"><div class="empty-icon">💬</div><p>Belum ada testimoni</p></div>
    @else
    <div class="tw">
      <table>
        <thead><tr><th>Avatar</th><th>Nama</th><th>Jabatan / Perusahaan</th><th>Isi Testimoni</th><th>Rating</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
          @foreach($testimonials as $t)
          <tr>
            <td><img src="{{ $t->avatar_url }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;"></td>
            <td style="font-weight:600;">{{ $t->name }}</td>
            <td style="color:#94a3b8;">{{ $t->role }}{{ $t->company ? ' — '.$t->company : '' }}</td>
            <td style="color:#94a3b8;max-width:260px;">{{ Str::limit($t->content, 70) }}</td>
            <td style="color:#eab308;letter-spacing:2px;">{{ str_repeat('★', $t->rating) }}</td>
            <td>{{ $t->order }}</td>
            <td><span class="badge {{ $t->is_active ? 'badge-green' : 'badge-red' }}">{{ $t->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td style="display:flex;gap:8px;">
              <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sec btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">🗑️</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>
@endsection
