@extends('layouts.app')

@section('title', 'Register')

@push('styles')
<style>
    .register-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }

    .register-card {
        background: var(--bnn-white);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(30, 58, 138, 0.12);
        border: none;
        overflow: hidden;
        position: relative;
        backdrop-filter: blur(20px);
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-blue-dark) 0%, var(--bnn-yellow) 50%, var(--bnn-blue-light) 100%);
    }

    .card-header-register {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        color: var(--bnn-white);
        text-align: center;
        padding: 2.5rem 2rem 2rem;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .card-header-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="registerGrain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="1" fill="white" opacity="0.08"/><circle cx="85" cy="25" r="1" fill="white" opacity="0.08"/><circle cx="35" cy="35" r="1" fill="white" opacity="0.08"/><circle cx="75" cy="45" r="1" fill="white" opacity="0.08"/><circle cx="25" cy="65" r="1" fill="white" opacity="0.08"/><circle cx="85" cy="75" r="1" fill="white" opacity="0.08"/><circle cx="45" cy="85" r="1" fill="white" opacity="0.08"/><circle cx="65" cy="95" r="1" fill="white" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23registerGrain)"/></svg>');
        opacity: 0.3;
    }

    .register-logo {
        width: 80px;
        height: 80px;
        background: var(--bnn-white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .register-logo:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 16px 50px rgba(0, 0, 0, 0.2);
    }

    .register-logo i {
        color: var(--bnn-blue-dark);
        font-size: 2.2rem;
    }

    .register-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
        color: var(--bnn-white);
    }

    .register-subtitle {
        font-size: 0.95rem;
        opacity: 0.9;
        font-weight: 400;
        position: relative;
        z-index: 1;
        color: var(--bnn-yellow-light);
    }

    .card-body-register {
        padding: 2.5rem;
        background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-gray-light) 100%);
    }

    .form-group-register {
        margin-bottom: 1.8rem;
        position: relative;
    }

    .form-label-register {
        font-weight: 600;
        color: var(--bnn-blue-dark);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        letter-spacing: 0.5px;
    }

    .form-label-register i {
        margin-right: 0.75rem;
        color: var(--bnn-blue-light);
        width: 18px;
        font-size: 1.1rem;
    }

    .form-control-register {
        border: 2px solid var(--bnn-blue-soft);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--bnn-white);
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(30, 58, 138, 0.05);
    }

    .form-control-register:focus {
        border-color: var(--bnn-blue-light);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 4px 20px rgba(30, 58, 138, 0.15);
        background: var(--bnn-white);
        transform: translateY(-2px);
        outline: none;
    }

    .form-control-register.is-invalid {
        border-color: var(--bnn-danger);
        background: #fef2f2;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .form-select-register {
        border: 2px solid var(--bnn-blue-soft);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--bnn-white);
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(30, 58, 138, 0.05);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%233b82f6' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .form-select-register:focus {
        border-color: var(--bnn-blue-light);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 4px 20px rgba(30, 58, 138, 0.15);
        background-color: var(--bnn-white);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%233b82f6' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        transform: translateY(-2px);
        outline: none;
    }

    .form-select-register.is-invalid {
        border-color: var(--bnn-danger);
        background-color: #fef2f2;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ef4444' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.75rem;
        font-weight: 500;
        color: var(--bnn-danger);
        display: flex;
        align-items: center;
    }

    .invalid-feedback i {
        margin-right: 0.5rem;
        font-size: 0.8rem;
    }

    .btn-register {
        background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
        border: none;
        border-radius: 16px;
        padding: 1.1rem 2rem;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 30px rgba(30, 58, 138, 0.25);
    }

    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(30, 58, 138, 0.35);
        background: linear-gradient(135deg, var(--bnn-blue-light) 0%, var(--bnn-blue-dark) 100%);
    }

    .btn-register:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 25px rgba(30, 58, 138, 0.3);
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .role-info {
        background: linear-gradient(135deg, var(--bnn-yellow-light) 0%, rgba(251, 191, 36, 0.1) 100%);
        border: 2px solid rgba(251, 191, 36, 0.3);
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 2rem;
        font-size: 0.9rem;
        color: var(--bnn-blue-dark);
        font-weight: 500;
        box-shadow: 0 4px 20px rgba(251, 191, 36, 0.15);
    }

    .role-info i {
        color: var(--bnn-yellow);
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    .password-strength {
        font-size: 0.85rem;
        color: var(--bnn-gray-dark);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        opacity: 0.8;
    }

    .password-strength i {
        margin-right: 0.5rem;
        font-size: 0.8rem;
        color: var(--bnn-success);
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
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--bnn-blue-soft), transparent);
    }

    .divider span {
        background: var(--bnn-white);
        color: var(--bnn-gray-dark);
        padding: 0 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .login-link {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.05) 100%);
        border-radius: 16px;
        margin-top: 1.5rem;
        border: 2px solid rgba(59, 130, 246, 0.1);
        transition: all 0.3s ease;
    }

    .login-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .login-link p {
        margin: 0;
        color: var(--bnn-gray-dark);
        font-size: 0.95rem;
        font-weight: 500;
    }

    .login-link a {
        color: var(--bnn-blue-light);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        position: relative;
    }

    .login-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--bnn-yellow);
        transition: width 0.3s ease;
    }

    .login-link a:hover {
        color: var(--bnn-blue-dark);
    }

    .login-link a:hover::after {
        width: 100%;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-card {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Form Floating Labels Effect */
    .form-floating {
        position: relative;
    }

    .form-floating input:focus + label,
    .form-floating input:not(:placeholder-shown) + label,
    .form-floating select:focus + label,
    .form-floating select:not([value=""]) + label {
        transform: translateY(-1.25rem) scale(0.85);
        color: var(--bnn-blue-light);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .card-body-register {
            padding: 2rem 1.5rem;
        }
        
        .register-logo {
            width: 70px;
            height: 70px;
        }
        
        .register-logo i {
            font-size: 1.8rem;
        }
        
        .register-title {
            font-size: 1.6rem;
        }

        .register-container {
            padding: 1rem 0;
        }

        .card-header-register {
            padding: 2rem 1.5rem 1.5rem;
        }

        .form-control-register,
        .form-select-register {
            padding: 0.9rem 1rem;
        }

        .btn-register {
            padding: 1rem 1.5rem;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .register-card {
            margin: 0 1rem;
        }

        .card-body-register {
            padding: 1.5rem;
        }

        .card-header-register {
            padding: 1.5rem;
        }

        .register-logo {
            width: 60px;
            height: 60px;
        }

        .register-logo i {
            font-size: 1.5rem;
        }

        .register-title {
            font-size: 1.4rem;
        }

        .register-subtitle {
            font-size: 0.85rem;
        }
    }

    /* Additional Enhancements */
    .form-control-register::placeholder,
    .form-select-register::placeholder {
        color: rgba(30, 58, 138, 0.4);
        font-weight: 400;
    }

    .btn-register i {
        transition: transform 0.3s ease;
    }

    .btn-register:hover i {
        transform: translateX(3px);
    }

    /* Focus ring for accessibility */
    .form-control-register:focus-visible,
    .form-select-register:focus-visible,
    .btn-register:focus-visible {
        outline: 3px solid rgba(59, 130, 246, 0.5);
        outline-offset: 2px;
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <div class="row justify-content-center w-100">
        <div class="col-md-7 col-lg-6 col-xl-5">
            <div class="card register-card">
                <div class="card-header card-header-register">
                    <div class="register-logo">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h4 class="register-title">Daftar Akun Baru</h4>
                    <p class="register-subtitle">Bergabung dengan Program Anti Narkoba BNN</p>
                </div>
                <div class="card-body card-body-register">
                    <div class="role-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Informasi Penting:</strong> Pilih role sesuai dengan status Anda untuk mendapatkan konten quiz yang tepat dan relevan.
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group-register">
                            <label class="form-label-register">
                                <i class="fas fa-user"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control form-control-register @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   required
                                   placeholder="Masukkan nama lengkap Anda">
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group-register">
                            <label class="form-label-register">
                                <i class="fas fa-envelope"></i>
                                Alamat Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-register @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required
                                   placeholder="Masukkan alamat email yang valid">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group-register">
                            <label class="form-label-register">
                                <i class="fas fa-users"></i>
                                Role / Status Anda
                            </label>
                            <select name="role" 
                                    class="form-select form-select-register @error('role') is-invalid @enderror" 
                                    required>
                                <option value="">Pilih Status yang Sesuai</option>
                                <option value="pelajar" {{ old('role') === 'pelajar' ? 'selected' : '' }}>
                                    🎓 Pelajar / Mahasiswa
                                </option>
                                <option value="masyarakat" {{ old('role') === 'masyarakat' ? 'selected' : '' }}>
                                    👥 Masyarakat Umum
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group-register">
                            <label class="form-label-register">
                                <i class="fas fa-lock"></i>
                                Password
                            </label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control form-control-register @error('password') is-invalid @enderror" 
                                   required
                                   placeholder="Buat password yang kuat dan aman"
                                   minlength="8">
                            <div class="password-strength">
                                <i class="fas fa-shield-alt"></i>
                                Minimal 8 karakter dengan kombinasi huruf, angka, dan simbol
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group-register">
                            <label class="form-label-register">
                                <i class="fas fa-check-double"></i>
                                Konfirmasi Password
                            </label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control form-control-register" 
                                   required
                                   placeholder="Ketik ulang password yang sama">
                        </div>
                        
                        <button type="submit" class="btn btn-register w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            Daftar Sekarang
                        </button>
                    </form>
                    
                    <div class="divider">
                        <span>atau</span>
                    </div>
                    
                    <div class="login-link">
                        <p>Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection