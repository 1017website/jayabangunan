@extends('admin.layouts.app')
@section('title','Pesan Masuk')
@section('page-title','Pesan Masuk')
@section('breadcrumb','Pesan')
@section('content')
<div class="card">
  <div class="card-bd" style="padding:0;">
    @if($messages->isEmpty())
    <div class="empty"><div class="empty-icon">📭</div><p>Belum ada pesan masuk</p></div>
    @else
    <div class="tw">
      <table>
        <thead>
          <tr>
            <th></th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Layanan</th>
            <th>Pesan</th>
            <th>Waktu</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $msg)
          <tr style="{{ !$msg->is_read ? 'background:rgba(192,0,28,0.04);' : '' }}">
            <td>
              @if(!$msg->is_read)
                <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#C0001C;"></span>
              @endif
            </td>
            <td style="font-weight:{{ !$msg->is_read ? '700' : '400' }};color:#fff;">{{ $msg->name }}</td>
            <td style="color:#94a3b8;">{{ $msg->email }}</td>
            <td style="color:#94a3b8;">{{ $msg->phone ?: '—' }}</td>
            <td>
              @if($msg->service)
                <span class="badge badge-blue">{{ $msg->service }}</span>
              @else
                <span style="color:#64748b;">—</span>
              @endif
            </td>
            <td style="color:#94a3b8;max-width:220px;">{{ Str::limit($msg->message, 60) }}</td>
            <td style="color:#64748b;white-space:nowrap;">{{ $msg->created_at->format('d M Y, H:i') }}</td>
            <td style="display:flex;gap:8px;white-space:nowrap;">
              <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sec btn-sm">👁 Baca</a>
              <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">🗑️</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div style="padding:16px 24px;">
      {{ $messages->links() }}
    </div>
    @endif
  </div>
</div>
@endsection
