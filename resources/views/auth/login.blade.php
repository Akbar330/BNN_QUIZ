@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<style>
    .login-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
    }

    .login-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.15);
        border: none;
        overflow: hidden;
        position: relative;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-gold) 50%, var(--bnn-secondary) 100%);
    }

    .card-header-bnn {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        color: white;
        text-align: center;
        padding: 2rem 1.5rem;
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
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="90" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="30" cy="30" r="1" fill="white" opacity="0.1"/><circle cx="70" cy="40" r="1" fill="white" opacity="0.1"/><circle cx="20" cy="60" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="70" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1" fill="white" opacity="0.1"/><circle cx="60" cy="90" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .login-logo {
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }

    .login-logo i {
        color: var(--bnn-primary);
        font-size: 2rem;
    }

    .login-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .login-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    .card-body-bnn {
        padding: 2.5rem;
    }

    .form-group-bnn {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label-bnn {
        font-weight: 600;
        color: var(--bnn-dark);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .form-label-bnn i {
        margin-right: 0.5rem;
        color: var(--bnn-primary);
        width: 16px;
    }

    .form-control-bnn {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control-bnn:focus {
        border-color: var(--bnn-primary);
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        background: white;
        transform: translateY(-1px);
    }

    .form-control-bnn.is-invalid {
        border-color: var(--bnn-secondary);
        background: #fef2f2;
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    .btn-login {
        background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
        border: none;
        border-radius: 12px;
        padding: 0.9rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    }

    .divider span {
        background: white;
        color: #64748b;
        padding: 0 1rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .register-link {
        text-align: center;
        padding: 1rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        margin-top: 1rem;
    }

    .register-link p {
        margin: 0;
        color: #64748b;
        font-size: 0.9rem;
    }

    .register-link a {
        color: var(--bnn-primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .register-link a:hover {
        color: var(--bnn-secondary);
        text-decoration: underline;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .card-body-bnn {
            padding: 1.5rem;
        }
        
        .login-logo {
            width: 60px;
            height: 60px;
        }
        
        .login-logo i {
            font-size: 1.5rem;
        }
        
        .login-title {
            font-size: 1.5rem;
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
<img src="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Logo_BNN.svg/1200px-Logo_BNN.svg.png') }}" 
                 alt="BNN Logo" 
                 class="d-inline-block align-text-top navbar-logo">
                    <h4 class="login-title">Masuk ke Sistem</h4>
                    <p class="login-subtitle">Quiz Anti Narkoba BNN</p>
                </div>
                <div class="card-body card-body-bnn">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group-bnn">
                            <label class="form-label-bnn">
                                <i class="fas fa-envelope"></i>
                                Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-bnn @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required
                                   placeholder="Masukkan email Anda">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
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
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
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