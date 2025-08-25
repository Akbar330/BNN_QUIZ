@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<style>
    .login-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        position: relative;
    }

    .login-card {
        background: var(--bnn-white);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(30, 58, 138, 0.12);
        border: 1px solid rgba(59, 130, 246, 0.1);
        overflow: hidden;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 30%, var(--bnn-yellow) 50%, var(--bnn-blue-light) 70%, var(--bnn-blue-dark) 100%);
        box-shadow: 0 2px 16px rgba(30, 58, 138, 0.2);
    }

    .card-header-bnn {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        color: var(--bnn-white);
        text-align: center;
        padding: 2.5rem 2rem;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .card-header-bnn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="0.8" fill="white" opacity="0.08"/><circle cx="90" cy="20" r="0.8" fill="white" opacity="0.08"/><circle cx="30" cy="30" r="0.8" fill="white" opacity="0.08"/><circle cx="70" cy="40" r="0.8" fill="white" opacity="0.08"/><circle cx="20" cy="60" r="0.8" fill="white" opacity="0.08"/><circle cx="80" cy="70" r="0.8" fill="white" opacity="0.08"/><circle cx="40" cy="80" r="0.8" fill="white" opacity="0.08"/><circle cx="60" cy="90" r="0.8" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.4;
    }

    .login-logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .login-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
        background: var(--bnn-white);
        padding: 8px;
        border-radius: 50%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .login-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    }

    .login-text-content {
        display: flex;
        flex-direction: column;
        text-align: left;
        line-height: 1.2;
    }

    .login-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        color: var(--bnn-white);
        position: relative;
        z-index: 1;
    }

    .login-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        color: var(--bnn-yellow-light);
        margin: 0;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    .card-body-bnn {
        padding: 2.5rem;
        background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-gray-light) 100%);
    }

    .form-group-bnn {
        margin-bottom: 1.75rem;
        position: relative;
    }

    .form-label-bnn {
        font-weight: 600;
        color: var(--bnn-gray-dark);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label-bnn i {
        color: var(--bnn-blue-light);
        width: 18px;
        font-size: 0.9rem;
    }

    .form-control-bnn {
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: var(--bnn-white);
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        color: var(--bnn-gray-dark);
    }

    .form-control-bnn:focus {
        border-color: var(--bnn-blue-light);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        background: var(--bnn-white);
        transform: translateY(-2px);
        outline: none;
    }

    .form-control-bnn::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }

    .form-control-bnn.is-invalid {
        border-color: var(--bnn-danger);
        background: #fef2f2;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
        color: var(--bnn-danger);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-login {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border: none;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        color: var(--bnn-white);
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.15);
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 48px rgba(30, 58, 138, 0.25);
        color: var(--bnn-white);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 2.5rem 0;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), transparent);
    }

    .divider span {
        background: var(--bnn-white);
        color: var(--bnn-gray-dark);
        padding: 0 1.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        opacity: 0.8;
    }

    .register-link {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.05) 100%);
        border-radius: 16px;
        margin-top: 1.5rem;
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    .register-link p {
        margin: 0;
        color: var(--bnn-gray-dark);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .register-link a {
        color: var(--bnn-blue-dark);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .register-link a:hover {
        color: var(--bnn-blue-light);
        text-decoration: underline;
        text-decoration-color: var(--bnn-yellow);
        text-decoration-thickness: 2px;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .login-card {
        animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Floating elements background */
    .login-container::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-yellow));
        border-radius: 50%;
        opacity: 0.1;
        animation: float 20s infinite linear;
    }

    .login-container::after {
        content: '';
        position: absolute;
        bottom: -30px;
        right: -30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--bnn-yellow), var(--bnn-blue-light));
        border-radius: 50%;
        opacity: 0.1;
        animation: float 15s infinite linear reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
        25% { transform: translateY(-20px) rotate(90deg) scale(1.1); }
        50% { transform: translateY(0) rotate(180deg) scale(1); }
        75% { transform: translateY(-10px) rotate(270deg) scale(0.9); }
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .login-container {
            padding: 1rem;
        }
        
        .card-body-bnn {
            padding: 2rem;
        }
        
        .card-header-bnn {
            padding: 2rem 1.5rem;
        }
        
        .login-logo-container {
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .login-logo {
            width: 60px;
            height: 60px;
        }
        
        .login-text-content {
            text-align: center;
        }
        
        .login-title {
            font-size: 1.5rem;
        }
        
        .login-subtitle {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .card-body-bnn {
            padding: 1.5rem;
        }
        
        .form-control-bnn {
            padding: 0.875rem 1rem;
        }
        
        .btn-login {
            padding: 0.875rem 1.25rem;
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
            <div class="card login-card">
                <div class="card-header card-header-bnn">
                    <div class="login-logo-container">
                        <img src="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Logo_BNN.svg/1200px-Logo_BNN.svg.png') }}" 
                             alt="BNN Logo" 
                             class="login-logo">
                        <div class="login-text-content">
                            <h4 class="login-title">Masuk ke Sistem</h4>
                            <p class="login-subtitle">Quiz Anti Narkoba BNN</p>
                        </div>
                    </div>
                </div>
                <div class="card-body card-body-bnn">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group-bnn">
                            <label class="form-label-bnn">
                                <i class="fas fa-envelope"></i>
                                Email Address
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-bnn @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required
                                   placeholder="Masukkan alamat email Anda">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group-bnn">
                            <label class="form-label-bnn">
                                <i class="fas fa-lock"></i>
                                Password
                            </label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control form-control-bnn @error('password') is-invalid @enderror" 
                                   required
                                   placeholder="Masukkan password Anda">
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Masuk ke Sistem
                        </button>
                    </form>
                    
                    <div class="divider">
                        <span>atau</span>
                    </div>
                    
                    <div class="register-link">
                        <p>Belum memiliki akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection