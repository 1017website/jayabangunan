@extends('admin.layouts.app')
@section('title','Manajemen User')
@section('page-title','Manajemen User')
@section('breadcrumb','Users')

@section('topbar-actions')
<a href="{{ route('admin.users.create') }}" class="btn btn-primary">➕ Tambah User</a>
@endsection

@section('content')

{{-- Alert error khusus (misal: hapus diri sendiri) --}}
@if(session('error'))
<div class="alert alert-danger">⚠️ {{ session('error') }}</div>
@endif

<div class="card">
  <div class="card-hd">
    <span class="card-title">👤 Daftar User Admin</span>
    <small style="color:#64748b;font-size:12px;">Total: {{ $users->count() }} user</small>
  </div>
  <div class="card-bd" style="padding:0;">
    @if($users->isEmpty())
    <div class="empty"><div class="empty-icon">👤</div><p>Belum ada user</p></div>
    @else
    <div class="tw">
      <table>
        <thead>
          <tr>
            <th>Avatar</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr style="{{ $user->id === auth()->id() ? 'background:rgba(192,0,28,0.04);' : '' }}">
            <td>
              <div style="width:38px;height:38px;border-radius:50%;background:{{ $user->role === 'admin' ? '#8B0000' : '#1e3a5f' }};display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:700;color:#fff;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
              </div>
            </td>
            <td>
              <div style="font-weight:600;color:#fff;">{{ $user->name }}</div>
              @if($user->id === auth()->id())
              <div style="font-size:11px;color:var(--red3);margin-top:2px;">● Akun Anda</div>
              @endif
            </td>
            <td style="color:#94a3b8;">{{ $user->email }}</td>
            <td>
              <span class="badge {{ $user->role === 'admin' ? 'badge-red' : 'badge-blue' }}">
                {{ $user->role === 'admin' ? '👑 Admin' : '✏️ Editor' }}
              </span>
            </td>
            <td style="color:#64748b;white-space:nowrap;">{{ $user->created_at->format('d M Y') }}</td>
            <td>
              <div class="td-act">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sec btn-sm">✏️ Edit</a>

                {{-- Reset Password Modal Trigger --}}
                <button class="btn btn-sec btn-sm" onclick="openResetModal({{ $user->id }}, '{{ addslashes($user->name) }}')">🔑 Reset PW</button>

                {{-- Tidak bisa hapus diri sendiri --}}
                @if($user->id !== auth()->id())
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user {{ addslashes($user->name) }}?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm" type="submit">🗑️</button>
                </form>
                @endif
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

{{-- Reset Password Modal --}}
<div id="reset-modal" style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,0.7);backdrop-filter:blur(4px);align-items:center;justify-content:center;">
  <div style="background:#1e2433;border:1px solid #2a3040;border-radius:16px;padding:32px;width:100%;max-width:440px;margin:20px;position:relative;">
    <button onclick="closeResetModal()" style="position:absolute;top:16px;right:16px;background:none;border:none;color:#64748b;font-size:20px;cursor:pointer;line-height:1;">✕</button>
    <h3 style="font-size:16px;font-weight:700;color:#fff;margin-bottom:6px;">🔑 Reset Password</h3>
    <p id="reset-modal-desc" style="font-size:13px;color:#64748b;margin-bottom:24px;"></p>

    <form id="reset-form" method="POST">
      @csrf
      <div class="fg">
        <label class="fl">Password Baru *</label>
        <input type="password" name="new_password" id="rp-new" class="fc" placeholder="Min. 8 karakter, huruf & angka" required>
      </div>
      <div class="fg">
        <label class="fl">Konfirmasi Password *</label>
        <input type="password" name="new_password_confirmation" id="rp-confirm" class="fc" placeholder="Ulangi password baru" required>
        <div id="rp-match" style="font-size:12px;margin-top:5px;display:none;"></div>
      </div>
      <div style="display:flex;gap:10px;margin-top:8px;">
        <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">💾 Simpan Password</button>
        <button type="button" onclick="closeResetModal()" class="btn btn-sec">Batal</button>
      </div>
    </form>
  </div>
</div>

<script>
function openResetModal(userId, userName) {
  document.getElementById('reset-modal').style.display = 'flex';
  document.getElementById('reset-modal-desc').textContent = 'Reset password untuk: ' + userName;
  document.getElementById('reset-form').action = '/admin/users/' + userId + '/reset-password';
  document.getElementById('rp-new').value = '';
  document.getElementById('rp-confirm').value = '';
  document.getElementById('rp-match').style.display = 'none';
}
function closeResetModal() {
  document.getElementById('reset-modal').style.display = 'none';
}
// Password match indicator
document.getElementById('rp-confirm').addEventListener('input', function() {
  const pw  = document.getElementById('rp-new').value;
  const el  = document.getElementById('rp-match');
  el.style.display = 'block';
  if (this.value === pw && pw.length > 0) {
    el.textContent = '✅ Password cocok';
    el.style.color = '#4ade80';
  } else {
    el.textContent = '❌ Password tidak cocok';
    el.style.color = '#f87171';
  }
});
document.getElementById('reset-modal').addEventListener('click', function(e) {
  if (e.target === this) closeResetModal();
});
</script>
@endsection
