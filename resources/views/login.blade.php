<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('AvatarAI.jpg') }}">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .form-login {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8); /* Mulai dengan skala kecil */
            background: white;
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            opacity: 0; /* Mulai dengan transparansi */
            animation: fadeIn 0.5s ease-out forwards; /* Animasi masuk */
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8); /* Mulai kecil dan transparan */
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1); /* Akhirnya normal */
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #888;
        }

        .form-group input {
            width: 100%;
            padding: 12px 12px 12px 38px;
            border: 1px solid #ccc;
            border-radius: 10px;
            transition: 0.3s ease;
        }

        .form-group input:focus {
            border-color: #6ca0dc;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background: #6ca0dc;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background: #5185c2;
        }

        .login {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .login a {
            color: #3a6fd4;
            text-decoration: none;
        }

        .login a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-login">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()" style="position:absolute; right:40px; top:50%; transform:translateY(-50%); cursor:pointer; color:#888;">
                    <i class="fa fa-eye-slash" id="eyeIcon"></i>
                </span>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <div class="login">
            Belum punya akun? <a href="/register">Daftar di sini</a>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            } else {
                pwd.type = 'password';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            }
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                backdrop: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Login!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false,
                backdrop: false
            });
        </script>
    @endif
    
</body>
</html>