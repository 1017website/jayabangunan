@extends('admin.layouts.app')
@section('title','Video')
@section('page-title','Manajemen Video')
@section('breadcrumb','Video')
@section('topbar-actions')
<a href="{{ route('admin.videos.create') }}" class="btn btn-primary">➕ Tambah Video</a>
@endsection
@section('content')
<p style="color:#64748b;font-size:13px;margin-bottom:16px;">
    Paste URL YouTube (biasa, Shorts, atau unlisted). Thumbnail otomatis diambil dari YouTube.
</p>
<div class="card">
    <div class="card-bd" style="padding:0;">
        @if($videos->isEmpty())
        <div class="empty">
            <div class="empty-icon">🎬</div>
            <p>Belum ada video</p>
        </div>
        @else
        <div class="tw">
            <table>
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>YouTube URL</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $v)
                    <tr>
                        <td>
                            <img src="{{ $v->thumbnail_url }}"
                                style="width:80px;height:50px;object-fit:cover;border-radius:6px;background:#1e2433;"
                                onerror="this.style.background='#2a3040';this.style.width='80px'">
                        </td>
                        <td style="font-weight:600;">{{ $v->title }}</td>
                        <td>
                            <a href="{{ $v->youtube_url }}" target="_blank"
                                style="color:#60a5fa;font-size:12px;text-decoration:none;">
                                ▶ Lihat di YouTube
                            </a>
                        </td>
                        <td>{{ $v->order }}</td>
                        <td>
                            <span class="badge {{ $v->is_active ? 'badge-green' : 'badge-red' }}">
                                {{ $v->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="td-act">
                                <a href="{{ route('admin.videos.edit', $v) }}" class="btn btn-sec btn-sm">✏️ Edit</a>
                                <form method="POST" action="{{ route('admin.videos.destroy', $v) }}"
                                    onsubmit="return confirm('Hapus video ini?')">
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