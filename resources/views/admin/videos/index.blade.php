@extends('admin.layouts.app')
@section('title', 'Video')
@section('page-title', 'Manajemen Video')
@section('breadcrumb', 'Video')
@section('topbar-actions')
    <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">➕ Upload Video</a>
@endsection
@section('content')
    <p style="color:#64748b;font-size:13px;margin-bottom:16px;">
        Video ditampilkan dalam grid di website. Format: MP4, MOV, WebM. Maks. 50MB per video.
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
                                <th>Preview</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $v)
                                <tr>
                                    <td>
                                        <video src="{{ $v->video_url }}"
                                            style="width:80px;height:60px;object-fit:cover;border-radius:6px;" muted></video>
                                    </td>
                                    <td style="font-weight:600;">{{ $v->title }}</td>
                                    <td style="color:#94a3b8;max-width:200px;">{{ Str::limit($v->description, 60) ?: '—' }}</td>
                                    <td>{{ $v->order }}</td>
                                    <td><span
                                            class="badge {{ $v->is_active ? 'badge-green' : 'badge-red' }}">{{ $v->is_active ? 'Aktif' : 'Nonaktif' }}</span>
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