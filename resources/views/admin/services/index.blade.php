@extends('admin.layouts.app')
@section('title','Layanan')
@section('page-title','Manajemen Layanan')
@section('breadcrumb','Layanan')
@section('topbar-actions')
<a href="{{ route('admin.services.create') }}" class="btn btn-primary">➕ Tambah Layanan</a>
@endsection
@section('content')
<div class="card">
  <div class="card-bd" style="padding:0;">
    @if($services->isEmpty())
    <div class="empty"><div class="empty-icon">🔧</div><p>Belum ada layanan</p></div>
    @else
    <div class="tw">
      <table>
        <thead><tr><th>Icon</th><th>Judul</th><th>Deskripsi</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
          @foreach($services as $svc)
          <tr>
            <td style="font-size:24px;">{{ $svc->icon }}</td>
            <td style="font-weight:600;">{{ $svc->title }}</td>
            <td style="color:#94a3b8;max-width:300px;">{{ Str::limit($svc->description, 80) }}</td>
            <td>{{ $svc->order }}</td>
            <td><span class="badge {{ $svc->is_active ? 'badge-green' : 'badge-red' }}">{{ $svc->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td style="display:flex;gap:8px;">
              <a href="{{ route('admin.services.edit', $svc) }}" class="btn btn-sec btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.services.destroy', $svc) }}" onsubmit="return confirm('Hapus layanan ini?')">
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
