@extends('admin.layouts.app')
@section('title','Proyek')
@section('page-title','Manajemen Proyek')
@section('breadcrumb','Proyek')
@section('topbar-actions')
<a href="{{ route('admin.projects.create') }}" class="btn btn-primary">➕ Tambah Proyek</a>
@endsection
@section('content')
<div class="card">
  <div class="card-bd" style="padding:0;">
    @if($projects->isEmpty())
    <div class="empty"><div class="empty-icon">🏗️</div><p>Belum ada proyek</p></div>
    @else
    <div class="tw">
      <table>
        <thead><tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Lokasi</th><th>Tahun</th><th>Featured</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
          @foreach($projects as $p)
          <tr>
            <td><img src="{{ $p->image_url }}" style="width:64px;height:44px;object-fit:cover;border-radius:6px;"></td>
            <td style="font-weight:600;">{{ $p->title }}</td>
            <td><span class="badge badge-blue">{{ $p->category }}</span></td>
            <td style="color:#94a3b8;">{{ $p->location }}</td>
            <td>{{ $p->year }}</td>
            <td>{{ $p->is_featured ? '⭐' : '—' }}</td>
            <td><span class="badge {{ $p->is_active ? 'badge-green' : 'badge-red' }}">{{ $p->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td style="display:flex;gap:8px;">
              <a href="{{ route('admin.projects.edit', $p) }}" class="btn btn-sec btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.projects.destroy', $p) }}" onsubmit="return confirm('Hapus proyek ini?')">
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
