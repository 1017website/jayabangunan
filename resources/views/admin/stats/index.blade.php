@extends('admin.layouts.app')
@section('title','Statistik')
@section('page-title','Manajemen Statistik')
@section('breadcrumb','Statistik')
@section('topbar-actions')
<a href="{{ route('admin.stats.create') }}" class="btn btn-primary">➕ Tambah Statistik</a>
@endsection
@section('content')
<p style="color:#64748b;font-size:13px;margin-bottom:20px;">Angka-angka ini tampil di hero card dan section statistik website.</p>
<div class="card">
  <div class="card-bd" style="padding:0;">
    @if($stats->isEmpty())
    <div class="empty"><div class="empty-icon">📊</div><p>Belum ada statistik</p></div>
    @else
    <div class="tw">
      <table>
        <thead><tr><th>Icon</th><th>Tampilan</th><th>Label</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
          @foreach($stats as $s)
          <tr>
            <td style="font-size:22px;">{{ $s->icon }}</td>
            <td style="font-size:20px;font-weight:800;color:#fff;">{{ $s->value }}<span style="color:#C0001C;font-size:14px;">{{ $s->suffix }}</span></td>
            <td style="color:#94a3b8;">{{ $s->label }}</td>
            <td>{{ $s->order }}</td>
            <td><span class="badge {{ $s->is_active ? 'badge-green' : 'badge-red' }}">{{ $s->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td style="display:flex;gap:8px;">
              <a href="{{ route('admin.stats.edit', $s) }}" class="btn btn-sec btn-sm">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.stats.destroy', $s) }}" onsubmit="return confirm('Hapus statistik ini?')">
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
