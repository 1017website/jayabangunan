@extends('admin.layouts.app')
@section('title', $user->exists ? 'Edit User' : 'Tambah User')
@section('page-title', $user->exists ? 'Edit User' : 'Tambah User')
@section('breadcrumb','Users')

@section('content')
<div style="max-width:600px;">
  <div class="card">
    <div class="card-hd">
      <span class="card-title">{{ $user->exists ? '✏️ Edit User' : '➕ Tambah User Baru' }}</span>
    </div>
    <div class="card-bd">
      <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}">
        @csrf
        @if($user->exists) @method('PUT') @endif

        <div class="fg">
          <label class="fl">Nama Lengkap *</label>
          <input type="text" name="name" class="fc" value="{{ old('name', $user->name) }}" placeholder="Admin Jaya Bangun" required autofocus>
        </div>

        <div class="fg">
          <label class="fl">Email *</label>
          <input type="email" name="email" class="fc" value="{{ old('email', $user->email) }}" placeholder="admin@jayabangun.co.id" required>
        </div>

        <div class="fg">
          <label class="fl">Role *</label>
          <select name="role" class="fs" required>
            <option value="admin"  {{ old('role', $user->role) === 'admin'  ? 'selected' : '' }}>👑 Admin — Akses penuh semua fitur</option>
            <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>✏️ Editor — Kelola konten saja</option>
          </select>
        </div>

        @if(!$user->exists)
        {{-- Password hanya saat buat user baru --}}
        <div style="border-top:1px solid #2a3040;margin:20px 0;padding-top:20px;">
          <p style="font-size:12px;color:#64748b;margin-bottom:16px;text-transform:uppercase;letter-spacing:1px;font-weight:700;">🔒 Password</p>

          <div class="fg">
            <label class="fl">Password *</label>
            <div style="position:relative;">
              <input type="password" name="password" id="pw" class="fc" placeholder="Min. 8 karakter, huruf & angka" required style="padding-right:44px;">
              <button type="button" onclick="togglePw('pw','eye1')" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:16px;" id="eye1">👁</button>
            </div>
            <div id="pw-strength" style="margin-top:8px;height:4px;border-radius:4px;background:#2a3040;overflow:hidden;">
              <div id="pw-strength-bar" style="height:100%;width:0%;transition:width 0.3s,background 0.3s;border-radius:4px;"></div>
            </div>
            <div id="pw-strength-label" class="fhint"></div>
          </div>

          <div class="fg">
            <label class="fl">Konfirmasi Password *</label>
            <div style="position:relative;">
              <input type="password" name="password_confirmation" id="pw2" class="fc" placeholder="Ulangi password" required style="padding-right:44px;" oninput="checkMatch()">
              <button type="button" onclick="togglePw('pw2','eye2')" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:16px;" id="eye2">👁</button>
            </div>
            <div id="match-hint" class="fhint" style="display:none;"></div>
          </div>
        </div>
        @else
        <div style="background:#252c3d;border:1px solid #2a3040;border-radius:8px;padding:14px 16px;margin-bottom:16px;">
          <p style="font-size:13px;color:#64748b;">🔒 Untuk mengubah password, gunakan tombol <strong style="color:#e2e8f0;">Reset PW</strong> di halaman daftar user, atau minta user menggantinya sendiri melalui menu <strong style="color:#e2e8f0;">Profil Saya</strong>.</p>
        </div>
        @endif

        <div style="display:flex;gap:12px;margin-top:8px;">
          <button type="submit" class="btn btn-primary">💾 Simpan</button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-sec">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Toggle show/hide password
function togglePw(inputId, btnId) {
  const inp = document.getElementById(inputId);
  const btn = document.getElementById(btnId);
  if (inp.type === 'password') { inp.type = 'text'; btn.textContent = '🙈'; }
  else { inp.type = 'password'; btn.textContent = '👁'; }
}

// Password strength meter
document.getElementById('pw')?.addEventListener('input', function() {
  const val = this.value;
  const bar = document.getElementById('pw-strength-bar');
  const lbl = document.getElementById('pw-strength-label');
  let score = 0;
  if (val.length >= 8)          score++;
  if (/[A-Z]/.test(val))        score++;
  if (/[0-9]/.test(val))        score++;
  if (/[^A-Za-z0-9]/.test(val)) score++;

  const levels = [
    { w: '0%',   c: '#2a3040', t: '' },
    { w: '25%',  c: '#ef4444', t: '⚠️ Terlalu lemah' },
    { w: '50%',  c: '#f97316', t: '🔶 Sedang' },
    { w: '75%',  c: '#eab308', t: '🔷 Cukup kuat' },
    { w: '100%', c: '#22c55e', t: '✅ Kuat' },
  ];
  const lvl = val.length === 0 ? levels[0] : levels[Math.min(score, 4)];
  bar.style.width      = lvl.w;
  bar.style.background = lvl.c;
  lbl.textContent      = lvl.t;
  lbl.style.color      = lvl.c;
  checkMatch();
});

function checkMatch() {
  const pw  = document.getElementById('pw')?.value;
  const pw2 = document.getElementById('pw2')?.value;
  const el  = document.getElementById('match-hint');
  if (!el) return;
  if (!pw2) { el.style.display = 'none'; return; }
  el.style.display = 'block';
  if (pw === pw2) {
    el.textContent = '✅ Password cocok';
    el.style.color = '#4ade80';
  } else {
    el.textContent = '❌ Password tidak cocok';
    el.style.color = '#f87171';
  }
}
</script>
@endsection
