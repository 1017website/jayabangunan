@extends('admin.layouts.app')
@section('title','Detail Pesan')
@section('page-title','Detail Pesan')
@section('breadcrumb','Pesan')
@section('topbar-actions')
<a href="{{ route('admin.messages.index') }}" class="btn btn-sec">← Kembali</a>
@endsection
@section('content')
<div style="max-width:700px;">
  <div class="card">
    <div class="card-hd">
      <span class="card-title">✉️ Pesan dari {{ $message->name }}</span>
      <span class="badge {{ $message->is_read ? 'badge-green' : 'badge-yellow' }}">{{ $message->is_read ? 'Sudah Dibaca' : 'Baru' }}</span>
    </div>
    <div class="card-bd">

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div>
          <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Nama</div>
          <div style="font-size:15px;font-weight:600;color:#fff;">{{ $message->name }}</div>
        </div>
        <div>
          <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Email</div>
          <div style="font-size:15px;"><a href="mailto:{{ $message->email }}" style="color:#60a5fa;">{{ $message->email }}</a></div>
        </div>
        <div>
          <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Telepon</div>
          <div style="font-size:15px;">{{ $message->phone ?: '—' }}</div>
        </div>
        <div>
          <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Layanan Diminati</div>
          <div style="font-size:15px;">
            @if($message->service)
              <span class="badge badge-blue">{{ $message->service }}</span>
            @else
              <span style="color:#64748b;">Tidak dipilih</span>
            @endif
          </div>
        </div>
        <div>
          <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Dikirim Pada</div>
          <div style="font-size:15px;">{{ $message->created_at->format('d F Y, H:i') }}</div>
        </div>
      </div>

      <div style="border-top:1px solid #2a3040;padding-top:20px;">
        <div style="font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;">Isi Pesan</div>
        <div style="background:#252c3d;border:1px solid #2a3040;border-radius:10px;padding:20px;font-size:15px;line-height:1.8;color:#e2e8f0;">
          {{ $message->message }}
        </div>
      </div>

      <div style="display:flex;gap:12px;margin-top:24px;">
        <a href="mailto:{{ $message->email }}?subject=Re: Pertanyaan dari {{ $message->name }}" class="btn btn-primary">
          📧 Balas via Email
        </a>
        @if($message->phone)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="btn btn-success">
          💬 Balas via WhatsApp
        </a>
        @endif
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Hapus pesan ini?')">
          @csrf @method('DELETE')
          <button class="btn btn-danger" type="submit">🗑️ Hapus Pesan</button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
