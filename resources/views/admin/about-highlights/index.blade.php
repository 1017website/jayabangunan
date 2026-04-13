@extends('admin.layouts.app')
@section('title','Highlight Tentang Kami')
@section('page-title','Highlight Tentang Kami')
@section('breadcrumb','About Highlights')
@section('topbar-actions')
<a href="{{ route('admin.about-highlights.create') }}" class="btn btn-primary">➕ Tambah</a>
@endsection
@section('content')
<p style="color:#64748b;font-size:13px;margin-bottom:16px;">
    Mengelola kotak-kotak sertifikasi & pencapaian di section Tentang Kami.
</p>
<div class="card">
    <div class="card-bd" style="padding:0;">
        @if($highlights->isEmpty())
        <div class="empty">
            <div class="empty-icon">🏅</div>
            <p>Belum ada highlight</p>
        </div>
        @else
        <div class="tw">
            <table>
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Teks</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($highlights as $h)
                    <tr>
                        <td style="font-size:22px;">{{ $h->icon }}</td>
                        <td style="font-weight:600;">{{ $h->text }}</td>
                        <td>{{ $h->order }}</td>
                        <td>
                            <span class="badge {{ $h->is_active ? 'badge-green' : 'badge-red' }}">
                                {{ $h->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="td-act">
                                <a href="{{ route('admin.about-highlights.edit', $h) }}" class="btn btn-sec btn-sm">✏️ Edit</a>
                                <form method="POST" action="{{ route('admin.about-highlights.destroy', $h) }}"
                                    onsubmit="return confirm('Hapus highlight ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">🗑️</button>
                                </form>
                            </div>
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