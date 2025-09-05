<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الأدمن</title>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: url('/images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #FFF3EE;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(99, 82, 82, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container img.logo {
            width: 120px;
            margin-bottom: 10px;
        }
        .login-container h2 {
            margin-bottom: 25px;
            color: #333335;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #d2c3c3ff;
            text-align: right;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #C8473B;
            color: #FFF3EE;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container button:hover {
            background: #EC675C;
        }
        .errors {
            margin-top: 15px;
            color: red;
            text-align: right;
        }
        .errors ul {
            padding-right: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- شعار الموقع -->
    <img src="/images/logo.png" alt="شعار الموقع" class="logo">

    <h2>تسجيل دخول الأدمن</h2>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="email" name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="كلمة المرور" required>
        <button type="submit">دخول</button>
    </form>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

</body>
</html>
