<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EMIRA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --emira-primary: #08C195;
            --emira-primary-dark: #06a37b;
            --emira-primary-light: #0ed6a8;
            --emira-secondary: #6366f1;
            --emira-dark: #1e293b;
            --emira-gray: #64748b;
            --emira-border: #e2e8f0;
        }
        
        * { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #08C195 0%, #06a37b 50%, #0ed6a8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-container {
            width: 100%;
            max-width: 440px;
        }
        
        .login-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--emira-primary), var(--emira-primary-light));
            padding: 2.5rem 2rem;
            text-align: center;
        }
        
        .login-header .logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2.5rem;
            color: white;
        }
        
        .login-header h1 {
            color: white;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .login-header p {
            color: rgba(255,255,255,0.85);
            font-size: 0.875rem;
            margin: 0;
        }
        
        .login-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--emira-dark);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .form-control {
            border: 2px solid var(--emira-border);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        
        .form-control:focus {
            border-color: var(--emira-primary);
            box-shadow: 0 0 0 4px rgba(8, 193, 149, 0.15);
        }
        
        .form-control-lg {
            padding: 1rem 1.25rem;
            font-size: 1rem;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--emira-primary), var(--emira-primary-light));
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 4px 6px -1px rgba(8, 193, 149, 0.4);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(8, 193, 149, 0.5);
            background: linear-gradient(135deg, var(--emira-primary-dark), var(--emira-primary));
            color: white;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--emira-border);
        }
        
        .divider span {
            padding: 0 1rem;
            color: var(--emira-gray);
            font-size: 0.8rem;
        }
        
        .login-footer {
            background: #f8fafc;
            padding: 1.25rem 2rem;
            text-align: center;
            border-top: 1px solid var(--emira-border);
        }
        
        .login-footer p {
            color: var(--emira-gray);
            font-size: 0.8rem;
            margin: 0;
        }
        
        .login-footer code {
            background: #e2e8f0;
            padding: 0.15rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            color: var(--emira-dark);
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid var(--emira-border);
            border-left: none;
            border-radius: 0 0.75rem 0.75rem 0;
            color: var(--emira-gray);
        }
        
        .input-group .form-control {
            border-right: none;
            border-radius: 0.75rem 0 0 0.75rem;
        }
        
        .input-group .form-control:focus + .input-group-text {
            border-color: var(--emira-primary);
        }
        
        .brand-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255,255,255,0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            color: white;
            font-size: 0.7rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <span class="brand-badge">v1.0.0</span>
                <div class="logo">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h1>⚕️ EMIRA</h1>
                <p>Electronic Medical Integrated Record & Administration</p>
            </div>
            
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control form-control-lg" 
                                   placeholder="nama@email.com" required autofocus>
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control form-control-lg" 
                                   placeholder="••••••••" required id="password">
                            <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                                <i class="fas fa-eye" id="eye-icon"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label text-muted" for="remember" style="font-size: 0.875rem;">
                                Ingat saya
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-login w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Sistem
                    </button>
                </form>
                
                @if($errors->any())
                <div class="alert alert-danger mt-3 mb-0">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
                @endif
            </div>
            
            <div class="login-footer">
                <p class="mb-2"><i class="fas fa-info-circle me-1"></i> Default Login:</p>
                <p><code>superadmin@emira.app</code> / <code>emira@superadmin</code></p>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p style="color: rgba(255,255,255,0.8); font-size: 0.8rem;">
                &copy; {{ date('Y') }} EMIRA - Electronic Medical Integrated Record & Administration
            </p>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ session("error") }}',
            confirmButtonColor: '#08C195'
        });
        @endif
    </script>
</body>
</html>
