<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Techno Hub – Login</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

```
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 50px;
  width: 90%;
  max-width: 1000px;
}

.brand {
  flex: 1;
  text-align: right;
}

.brand img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  margin-bottom: 10px;
}

.brand h1 {
  color: #1a1a1a;
  font-size: 2.5rem;
  margin: 0;
  font-weight: 700;
}

.brand p {
  color: #555;
  font-size: 1.1rem;
  max-width: 350px;
  margin: 10px auto 0;
}

.login-box {
  flex: 1;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  padding: 35px 30px;
  width: 100%;
  max-width: 400px;
  text-align: center;
  animation: fadeIn 0.8s ease forwards;
}

.login-box input {
  width: 100%;
  padding: 14px 12px;
  margin: 12px 0;
  border-radius: 6px;
  border: 1px solid #ddd;
  font-size: 1rem;
  transition: 0.3s;
  outline: none;
}

.login-box input:focus {
  border-color: #1877f2;
  box-shadow: 0 0 5px rgba(24, 119, 242, 0.3);
}

.login-box button {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 6px;
  background-color: #1877f2;
  color: #fff;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
  margin-top: 10px;
}

.login-box button:hover {
  background-color: #166fe0;
}

.home-link {
  display: inline-block;
  margin-top: 18px;
  color: #1877f2;
  text-decoration: none;
  font-size: 0.95rem;
}

.home-link:hover {
  text-decoration: underline;
}

.alert {
  background: #ff4d4d;
  color: #fff;
  padding: 10px;
  border-radius: 6px;
  margin-bottom: 12px;
}

@keyframes fadeIn {
  from {opacity: 0; transform: translateY(20px);}
  to {opacity: 1; transform: translateY(0);}
}

@media (max-width: 768px) {
  .login-container {
    flex-direction: column;
    gap: 20px;
    text-align: center;
  }
  .brand {
    text-align: center;
  }
}
```

  </style>
</head>
<body>

  <div class="login-container">
    <div class="brand">
      <img src="/images/logo.png" alt="Smart Techno Hub Logo">
      <h1>Smart Techno Hub</h1>
      <p>Your trusted partner for mobile repair and sales. Log in to manage your services and customers.</p>
    </div>

```
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
```

  </div>

</body>
</html>
