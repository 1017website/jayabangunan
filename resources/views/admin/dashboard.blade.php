@extends('admin.layouts.app')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="sc-grid">
  <div class="sc red">
    <div class="sc-label">Total Proyek</div>
    <div class="sc-val">{{ $stats['projects'] }}</div>
    <div class="sc-icon">🏗️</div>
  </div>
  <div class="sc blue">
    <div class="sc-label">Layanan</div>
    <div class="sc-val">{{ $stats['services'] }}</div>
    <div class="sc-icon">🔧</div>
  </div>
  <div class="sc green">
    <div class="sc-label">Testimoni</div>
    <div class="sc-val">{{ $stats['testimonials'] }}</div>
    <div class="sc-icon">💬</div>
  </div>
  <div class="sc yellow">
    <div class="sc-label">Pesan Belum Dibaca</div>
    <div class="sc-val">{{ $stats['unread_msgs'] }}</div>
    <div class="sc-icon">✉️</div>
  </div>
</div>

{{-- Visitor Summary --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">
  <div style="background:var(--card);border:1px solid var(--border);border-radius:12px;padding:18px 16px;display:flex;align-items:center;gap:14px;">
    <div style="font-size:28px;flex-shrink:0;">📅</div>
    <div>
      <div style="font-size:26px;font-weight:800;color:#fff;line-height:1;letter-spacing:-1px;">{{ number_format($stats['visitors_today']) }}</div>
      <div style="font-size:11px;color:var(--muted);margin-top:3px;text-transform:uppercase;letter-spacing:1px;">Hari Ini</div>
    </div>
  </div>
  <div style="background:var(--card);border:1px solid var(--border);border-radius:12px;padding:18px 16px;display:flex;align-items:center;gap:14px;">
    <div style="font-size:28px;flex-shrink:0;">📆</div>
    <div>
      <div style="font-size:26px;font-weight:800;color:#fff;line-height:1;letter-spacing:-1px;">{{ number_format($stats['visitors_30days']) }}</div>
      <div style="font-size:11px;color:var(--muted);margin-top:3px;text-transform:uppercase;letter-spacing:1px;">30 Hari Terakhir</div>
    </div>
  </div>
  <div style="background:var(--card);border:1px solid var(--border);border-radius:12px;padding:18px 16px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
    <div style="display:flex;align-items:center;gap:14px;">
      <div style="font-size:28px;flex-shrink:0;">👥</div>
      <div>
        <div style="font-size:26px;font-weight:800;color:#fff;line-height:1;letter-spacing:-1px;">{{ number_format($stats['visitors_total']) }}</div>
        <div style="font-size:11px;color:var(--muted);margin-top:3px;text-transform:uppercase;letter-spacing:1px;">Total Unik</div>
      </div>
    </div>
    <a href="{{ route('admin.visitors.index') }}" class="btn btn-sec btn-sm" style="flex-shrink:0;">Detail →</a>
  </div>
</div>

{{-- Recent Messages --}}
<div class="card" style="margin-bottom:24px;">
  <div class="card-hd">
    <span class="card-title">✉️ Pesan Terbaru</span>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-sec btn-sm">Lihat Semua</a>
  </div>
  <div class="card-bd" style="padding:0;">
    @if($recent_messages->isEmpty())
    <div class="empty"><div class="empty-icon">📭</div><p>Belum ada pesan masuk</p></div>
    @else
    <div class="tw">
      <table>
        <thead><tr><th>Nama</th><th>Email</th><th>Layanan</th><th>Waktu</th><th>Status</th><th></th></tr></thead>
        <tbody>
          @foreach($recent_messages as $msg)
          <tr>
            <td style="font-weight:600;">{{ $msg->name }}</td>
            <td style="color:#94a3b8;">{{ $msg->email }}</td>
            <td>{{ $msg->service ?: '—' }}</td>
            <td style="color:#64748b;white-space:nowrap;">{{ $msg->created_at->diffForHumans() }}</td>
            <td>
              @if($msg->is_read)
                <span class="badge badge-green">Dibaca</span>
              @else
                <span class="badge badge-yellow">Baru</span>
              @endif
            </td>
            <td><a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sec btn-sm">Lihat</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>

{{-- Quick Actions + System Info --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
  <div class="card">
    <div class="card-hd"><span class="card-title">⚡ Aksi Cepat</span></div>
    <div class="card-bd" style="display:flex;flex-direction:column;gap:8px;">
      <a href="{{ route('admin.projects.create') }}"    class="btn btn-primary" style="justify-content:center;">➕ Tambah Proyek Baru</a>
      <a href="{{ route('admin.services.create') }}"    class="btn btn-sec"     style="justify-content:center;">➕ Tambah Layanan</a>
      <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sec"    style="justify-content:center;">➕ Tambah Testimoni</a>
      <a href="{{ route('admin.settings.index') }}"     class="btn btn-sec"     style="justify-content:center;">⚙️ Edit Pengaturan</a>
      <a href="{{ route('admin.seo.index') }}"          class="btn btn-sec"     style="justify-content:center;">🔍 Edit SEO</a>
    </div>
  </div>
  <div class="card">
    <div class="card-hd"><span class="card-title">📋 Info Sistem</span></div>
    <div class="card-bd" style="padding:0;">
      <table style="min-width:0;">
        <tbody>
          <tr><td style="padding:11px 16px;color:#64748b;">Laravel</td><td style="padding:11px 16px;font-weight:600;">{{ app()->version() }}</td></tr>
          <tr><td style="padding:11px 16px;color:#64748b;">PHP</td><td style="padding:11px 16px;font-weight:600;">{{ PHP_VERSION }}</td></tr>
          <tr><td style="padding:11px 16px;color:#64748b;">Environment</td><td style="padding:11px 16px;"><span class="badge badge-green">{{ config('app.env') }}</span></td></tr>
          <tr><td style="padding:11px 16px;color:#64748b;">Total Pesan</td><td style="padding:11px 16px;font-weight:600;">{{ $stats['total_msgs'] }}</td></tr>
          <tr><td style="padding:11px 16px;color:#64748b;">Pengunjung Hari Ini</td><td style="padding:11px 16px;font-weight:600;color:#60a5fa;">{{ $stats['visitors_today'] }}</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<style>
@media(max-width:768px){
  [style*="grid-template-columns:repeat(3,1fr)"]{grid-template-columns:1fr!important;}
  [style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}
}
</style>
@endsection
