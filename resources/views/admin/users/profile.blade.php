@extends('admin.layouts.app')
@section('title','Profil Saya')
@section('page-title','Profil Saya')
@section('breadcrumb','Profil')

@section('content')
<div style="max-width:680px;display:flex;flex-direction:column;gap:24px;">

  {{-- ── Info Profil ──────────────────────────────────────────── --}}
  <div class="card">
    <div class="card-hd">
      <span class="card-title">👤 Informasi Profil</span>
    </div>
    <div class="card-bd">

      {{-- Avatar besar --}}
      <div style="display:flex;align-items:center;gap:20px;margin-bottom:28px;padding-bottom:24px;border-bottom:1px solid #2a3040;">
        <div style="width:72px;height:72px;border-radius:50%;background:var(--red);display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:800;color:#fff;flex-shrink:0;border:3px solid rgba(192,0,28,0.3);">
          {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
          <div style="font-size:20px;font-weight:700;color:#fff;letter-spacing:-0.3px;">{{ $user->name }}</div>
          <div style="font-size:13px;color:#64748b;margin-top:3px;">{{ $user->email }}</div>
          <span class="badge {{ $user->role === 'admin' ? 'badge-red' : 'badge-blue' }}" style="margin-top:8px;">
            {{ $user->role === 'admin' ? '👑 Admin' : '✏️ Editor' }}
          </span>
        </div>
      </div>

      <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        <div class="frow">
          <div class="fg">
            <label class="fl">Nama Lengkap *</label>
            <input type="text" name="name" class="fc" value="{{ old('name', $user->name) }}" required>
          </div>
          <div class="fg">
            <label class="fl">Email *</label>
            <input type="email" name="email" class="fc" value="{{ old('email', $user->email) }}" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
      </form>
    </div>
  </div>

  {{-- ── Ganti Password ───────────────────────────────────────── --}}
  <div class="card">
    <div class="card-hd">
      <span class="card-title">🔒 Ganti Password</span>
    </div>
    <div class="card-bd">
      <form method="POST" action="{{ route('admin.change-password') }}" id="change-pw-form">
        @csrf

        <div class="fg">
          <label class="fl">Password Saat Ini *</label>
          <div style="position:relative;">
            <input type="password" name="current_password" id="cur-pw" class="fc"
                   placeholder="Masukkan password Anda saat ini"
                   style="padding-right:44px;" required>
            <button type="button" onclick="togglePw('cur-pw','eye-cur')"
                    style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:16px;" id="eye-cur">👁</button>
          </div>
          @error('current_password')
          <div style="color:#f87171;font-size:12px;margin-top:5px;">❌ {{ $message }}</div>
          @enderror
        </div>

        <div style="border-top:1px solid #2a3040;padding-top:20px;margin-bottom:0;">
          <div class="fg">
            <label class="fl">Password Baru *</label>
            <div style="position:relative;">
              <input type="password" name="new_password" id="new-pw" class="fc"
                     placeholder="Min. 8 karakter, huruf & angka"
                     style="padding-right:44px;" required oninput="checkStrength();checkMatch();">
              <button type="button" onclick="togglePw('new-pw','eye-new')"
                      style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:16px;" id="eye-new">👁</button>
            </div>
            {{-- Strength bar --}}
            <div style="margin-top:8px;height:4px;border-radius:4px;background:#2a3040;overflow:hidden;">
              <div id="strength-bar" style="height:100%;width:0%;transition:width 0.3s,background 0.3s;border-radius:4px;"></div>
            </div>
            <div id="strength-label" class="fhint"></div>
          </div>

          <div class="fg">
            <label class="fl">Konfirmasi Password Baru *</label>
            <div style="position:relative;">
              <input type="password" name="new_password_confirmation" id="confirm-pw" class="fc"
                     placeholder="Ulangi password baru"
                     style="padding-right:44px;" required oninput="checkMatch()">
              <button type="button" onclick="togglePw('confirm-pw','eye-conf')"
                      style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:16px;" id="eye-conf">👁</button>
            </div>
            <div id="match-hint" class="fhint" style="display:none;"></div>
          </div>
        </div>

        {{-- Tips --}}
        <div style="background:#252c3d;border:1px solid #2a3040;border-radius:8px;padding:14px 16px;margin-bottom:20px;">
          <p style="font-size:12px;color:#64748b;line-height:1.7;">
            💡 <strong style="color:#94a3b8;">Tips password kuat:</strong><br>
            • Minimal 8 karakter<br>
            • Kombinasi huruf besar, huruf kecil, angka<br>
            • Tambahkan karakter khusus (!@#$%) untuk lebih aman
          </p>
        </div>

        <button type="submit" class="btn btn-primary">🔒 Ubah Password</button>
      </form>
    </div>
  </div>

</div>

<script>
function togglePw(inputId, btnId) {
  const inp = document.getElementById(inputId);
  const btn = document.getElementById(btnId);
  if (inp.type === 'password') { inp.type = 'text'; btn.textContent = '🙈'; }
  else { inp.type = 'password'; btn.textContent = '👁'; }
}

function checkStrength() {
  const val = document.getElementById('new-pw').value;
  const bar = document.getElementById('strength-bar');
  const lbl = document.getElementById('strength-label');
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
}

function checkMatch() {
  const pw  = document.getElementById('new-pw').value;
  const pw2 = document.getElementById('confirm-pw').value;
  const el  = document.getElementById('match-hint');
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
