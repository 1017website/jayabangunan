<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Jaya Bangun CMS</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:#0f1117;min-height:100vh;display:flex;align-items:center;justify-content:center;}
.login-wrap{width:100%;max-width:400px;padding:20px;}
.login-logo{text-align:center;margin-bottom:32px;}
.login-logo h1{font-size:28px;font-weight:900;color:#fff;letter-spacing:-1px;}
.login-logo h1 span{color:#C0001C;}
.login-logo p{font-size:12px;color:#64748b;margin-top:6px;letter-spacing:2px;text-transform:uppercase;}
.login-card{background:#1e2433;border:1px solid #2a3040;border-radius:16px;padding:36px 32px;}
.login-card h2{font-size:18px;font-weight:700;color:#fff;margin-bottom:6px;}
.login-card p{font-size:13px;color:#64748b;margin-bottom:28px;}
.form-group{margin-bottom:18px;}
.form-label{display:block;font-size:11px;font-weight:700;letter-spacing:1px;color:#94a3b8;margin-bottom:8px;text-transform:uppercase;}
.form-control{width:100%;background:#252c3d;border:1px solid #2a3040;border-radius:8px;padding:12px 14px;color:#e2e8f0;font-size:14px;transition:border-color 0.2s;}
.form-control:focus{outline:none;border-color:#C0001C;}
.form-check{display:flex;align-items:center;gap:8px;margin-bottom:24px;}
.form-check input{accent-color:#C0001C;width:16px;height:16px;}
.form-check label{font-size:13px;color:#94a3b8;cursor:pointer;}
.btn-login{width:100%;padding:13px;background:#8B0000;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;transition:background 0.2s;}
.btn-login:hover{background:#C0001C;}
.error-msg{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#f87171;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:18px;}
</style>
</head>
<body>
<div class="login-wrap">
  <div class="login-logo">
    <img src="{{ asset('images/logo-white.png') }}" alt="Jaya Bangun Konstruksi" style="height:64px;width:auto;margin-bottom:8px;">
    <p>Content Management System</p>
  </div>
  <div class="login-card">
    <h2>Masuk ke Panel Admin</h2>
    <p>Masukkan kredensial akun Anda untuk melanjutkan</p>

    @if($errors->any())
    <div class="error-msg">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="admin@jayabangun.co.id" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
      </div>
      <div class="form-check">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Ingat saya</label>
      </div>
      <button type="submit" class="btn-login">Masuk →</button>
    </form>
  </div>
</div>
</body>
</html>
