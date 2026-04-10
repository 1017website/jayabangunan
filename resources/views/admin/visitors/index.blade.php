@extends('admin.layouts.app')
@section('title','Statistik Pengunjung')
@section('page-title','Statistik Pengunjung')
@section('breadcrumb','Pengunjung')

@section('topbar-actions')
<form method="POST" action="{{ route('admin.visitors.clear') }}" onsubmit="return confirm('Reset semua data pengunjung? Tindakan ini tidak bisa dibatalkan.')">
  @csrf
  <button type="submit" class="btn btn-danger btn-sm">🗑️ Reset Data</button>
</form>
@endsection

@section('content')

{{-- Stat Cards --}}
<div class="sc-grid" style="grid-template-columns:repeat(4,1fr);">
  <div class="sc red">
    <div class="sc-label">Total Pengunjung Unik</div>
    <div class="sc-val">{{ number_format($total_unique) }}</div>
    <div class="sc-icon">👥</div>
  </div>
  <div class="sc blue">
    <div class="sc-label">Total Kunjungan</div>
    <div class="sc-val">{{ number_format($total_visits) }}</div>
    <div class="sc-icon">📊</div>
  </div>
  <div class="sc green">
    <div class="sc-label">Pengunjung Hari Ini</div>
    <div class="sc-val">{{ number_format($today) }}</div>
    <div class="sc-icon">📅</div>
  </div>
  <div class="sc yellow">
    <div class="sc-label">30 Hari Terakhir</div>
    <div class="sc-val">{{ number_format($last_30_days) }}</div>
    <div class="sc-icon">📈</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;">

  {{-- Chart 7 Hari --}}
  <div class="card">
    <div class="card-hd">
      <span class="card-title">📈 Pengunjung 7 Hari Terakhir</span>
    </div>
    <div class="card-bd">
      <div style="position:relative;height:220px;display:flex;align-items:flex-end;gap:8px;padding-bottom:32px;">
        @php $maxCount = max(collect($chart_data)->pluck('count')->max(), 1); @endphp
        @foreach($chart_data as $day)
        @php $height = max(($day['count'] / $maxCount) * 180, 4); @endphp
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:6px;">
          <div style="font-size:11px;font-weight:700;color:#e2e8f0;">{{ $day['count'] }}</div>
          <div style="width:100%;height:{{ $height }}px;background:linear-gradient(to top,#8B0000,#C0001C);border-radius:6px 6px 0 0;transition:height 0.5s;position:relative;"
               title="{{ $day['label'] }}: {{ $day['count'] }} pengunjung">
          </div>
          <div style="font-size:10px;color:#64748b;text-align:center;white-space:nowrap;transform:rotate(-30deg);transform-origin:top left;margin-top:4px;">
            {{ \Carbon\Carbon::parse($day['date'])->format('d/m') }}
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Top Pages --}}
  <div class="card">
    <div class="card-hd">
      <span class="card-title">🔥 Halaman Terpopuler</span>
    </div>
    <div class="card-bd" style="padding:0;">
      @if($top_pages->isEmpty())
      <div class="empty" style="padding:30px;"><p>Belum ada data</p></div>
      @else
      @php $maxPage = $top_pages->first()->visits; @endphp
      @foreach($top_pages as $page)
      <div style="padding:12px 20px;border-bottom:1px solid #2a3040;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
          <span style="font-size:12px;color:#e2e8f0;font-weight:500;">{{ $page->page ?: '/' }}</span>
          <span style="font-size:12px;font-weight:700;color:#C0001C;">{{ $page->visits }}</span>
        </div>
        <div style="height:4px;background:#2a3040;border-radius:4px;overflow:hidden;">
          <div style="height:100%;width:{{ ($page->visits/$maxPage)*100 }}%;background:linear-gradient(to right,#8B0000,#C0001C);border-radius:4px;"></div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>

</div>

{{-- Chart Bulanan --}}
<div class="card">
  <div class="card-hd">
    <span class="card-title">📆 Pengunjung 6 Bulan Terakhir</span>
  </div>
  <div class="card-bd">
    <div style="display:flex;align-items:flex-end;gap:16px;height:180px;padding-bottom:32px;">
      @php $maxMonthly = max(collect($monthly)->pluck('count')->max(), 1); @endphp
      @foreach($monthly as $m)
      @php $h = max(($m['count'] / $maxMonthly) * 150, 4); @endphp
      <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:6px;">
        <div style="font-size:12px;font-weight:700;color:#e2e8f0;">{{ $m['count'] }}</div>
        <div style="width:100%;height:{{ $h }}px;background:linear-gradient(to top,#1e3a5f,#3b82f6);border-radius:6px 6px 0 0;"></div>
        <div style="font-size:11px;color:#64748b;text-align:center;">{{ $m['label'] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
