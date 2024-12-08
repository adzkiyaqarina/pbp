<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMA Register</title>
  <style>
    /* styles.css */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .background {
      background-color: #00000045;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      z-index:2;
      flex-direction:column;
      gap:10px;
    }

    .login-container {
      background: #ffffffb8;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      width: 400px;
      text-align: center;
      margin-right:200px;
      backdrop-filter: blur(4px);
    }

    h1 {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .input-group {
      margin-bottom: 15px;
      text-align: left;
      display: flex;
      flex-direction:column;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
      font-size: 14px;
    }

    .input-group input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .forgot-password {
      display: block;
      margin: 10px 0 15px 0;
      font-size: 12px;
      color: #007bff;
      text-decoration: none;
      text-align:left;
    }

    .btn {
      width: 100%;
      padding: 10px;
      background: #1E2B5F;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      font-weight:bold;
    }

    .btn:hover {
      background: #0056b3;
    }

    p {
      margin-top: 15px;
      font-size: 14px;
    }

    p a {
      color: #007bff;
      text-decoration: none;
    }
    .back_bg{
      position:fixed;
      top:0;
      left:0;
      width: 100%;
      height:100%;z-index: 1;
    }
    .back_bg img{
      width: 100%;
      height:100%;
      object-fit: cover;
    }
    .alert{
      padding:10px 30px;
      background:red;
      color:white;
      font-weight: bold;
      width: 400px;
      border-radius:8px;
      margin-right: 200px;
    }
    .success{
      padding:10px 30px;
      background:green;
      color:white;
      font-weight: bold;
      width: 400px;
      border-radius:8px;
      margin-right: 200px;
    }

    .input_{
      display: flex;
      background: white;
      padding:5px 15px;
      align-items: center;
      gap:2px;
      border-radius:8px;
    }

    .input_ input{
      width: 100%;
      background: none;
      border:none;
      outline:none;
    }

    .input_ img{
      width: 16px;
      margin-right:10px;
    }

    @media screen and (max-width:1000px){
      .login-container{
        margin-right: 0;
      }
      .background{
        align-items: center;
      }
    }

  </style>
</head>
<body>
  <div class="back_bg">
    <img src="/images/sima_bg.png">
  </div>
  <div class="background">
    @if (session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="login-container">
      <h1>Sistem Informasi Manajemen Akademik (SIMA)</h1>
      <form method="POST">
        @csrf
        <div class="input-group">
          <label for="username">Nama Lengkap</label>
          <div class="input_">
            <img src="/icon/user.png">
            <input type="text" name="nama_lengkap" placeholder="Masukan Nama Lengkap..." required>
          </div>
          @if ($errors->has('nama_lengkap'))
            <small class="text-danger">{{ $errors->first('nama_lengkap') }}</small>
          @endif
        </div>
        <div class="input-group">
          <label for="username">Email</label>
          <div class="input_">
            <img src="/icon/email.png">
            <input type="text" name="email" placeholder="Masukan Email..." required>
          </div>
          @if ($errors->has('email'))
            <small class="text-danger">{{ $errors->first('email') }}</small>
          @endif
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <div class="input_">
            <img src="/icon/password.png">
            <input type="password" name="password" placeholder="Masukkan password..." required>
          </div>
          @if ($errors->has('password'))
            <small class="text-danger">{{ $errors->first('password') }}</small>
          @endif
        </div>
        <div class="input-group">
          <label for="password">Konfirmasi Password</label>
          <div class="input_">
            <img src="/icon/password.png">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi password..." required>
          </div>
        </div>
        <button type="submit" class="btn">Register</button>
      </form>
      <p>Sudah punya akun? <a href="/login">Login Sekarang</a></p>
    </div>
  </div>
</body>
</html>
