<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Techno Hub – Admin Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(135deg, #1a73e8, #0f2027, #203a43, #2c5364);
      background-size: 300% 300%;
      animation: gradientMove 12s ease infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      overflow: hidden;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .login-wrapper {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 90%;
      max-width: 1000px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.3);
      padding: 40px;
      backdrop-filter: blur(15px);
      animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(30px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .brand-section {
      flex: 1;
      text-align: center;
      padding-right: 40px;
      border-right: 2px solid rgba(255,255,255,0.2);
    }

    .brand-section img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 15px;
      border: 3px solid rgba(255,255,255,0.3);
    }

    .brand-section h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: #fff;
    }

    .brand-section p {
      font-size: 1rem;
      color: rgba(255,255,255,0.85);
      max-width: 320px;
      margin: 0 auto;
    }

    .login-box {
      flex: 1;
      padding-left: 40px;
      text-align: center;
    }

    .login-box h2 {
      font-size: 2rem;
      margin-bottom: 25px;
      color: #fff;
      font-weight: 600;
    }

    .login-box form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .login-box input {
      padding: 14px;
      border-radius: 8px;
      border: none;
      outline: none;
      font-size: 1rem;
      background: rgba(255,255,255,0.15);
      color: #fff;
      transition: 0.3s;
    }

    .login-box input::placeholder {
      color: rgba(255,255,255,0.7);
    }

    .login-box input:focus {
      background: rgba(255,255,255,0.25);
      box-shadow: 0 0 8px rgba(255,255,255,0.3);
    }

    .login-box button {
      padding: 14px;
      border-radius: 8px;
      border: none;
      font-size: 1.1rem;
      font-weight: 600;
      color: #fff;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      cursor: pointer;
      transition: 0.4s;
    }

    .login-box button:hover {
      background: linear-gradient(135deg, #0072ff, #00c6ff);
      transform: scale(1.05);
    }

    .home-link {
      display: inline-block;
      margin-top: 20px;
      color: #fff;
      text-decoration: none;
      font-size: 0.95rem;
      opacity: 0.8;
      transition: 0.3s;
    }

    .home-link:hover {
      opacity: 1;
      text-decoration: underline;
    }

    .alert {
      background: rgba(255, 77, 77, 0.9);
      color: #fff;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 12px;
    }

    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column;
        padding: 25px;
        text-align: center;
      }

      .brand-section {
        border: none;
        padding-right: 0;
        padding-bottom: 25px;
      }

      .login-box {
        padding-left: 0;
      }
    }
  </style>
</head>
<body>

  <div class="login-wrapper">
    <div class="brand-section">
      <img src="/images/logo.png" alt="Smart Techno Hub Logo">
      <h1>Smart Techno Hub</h1>
      <p>Your trusted partner for mobile repair and sales. Log in to manage your services and customers.</p>
    </div>

    <div class="login-box">
      <h2>Admin Login</h2>

      @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>

      <a href="{{ url('/') }}" class="home-link">← Back to Home</a>
    </div>
  </div>

</body>
</html>
