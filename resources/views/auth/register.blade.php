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
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(30, 64, 175, 0.15);
        border: none;
        overflow: hidden;
        position: relative;
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--bnn-accent) 0%, var(--bnn-gold) 50%, var(--bnn-primary) 100%);
    }

    .card-header-register {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
        color: white;
        text-align: center;
        padding: 2rem 1.5rem 1.5rem;
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
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="registerGrain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="15" cy="15" r="1" fill="white" opacity="0.1"/><circle cx="85" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="35" cy="35" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="45" r="1" fill="white" opacity="0.1"/><circle cx="25" cy="65" r="1" fill="white" opacity="0.1"/><circle cx="85" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="45" cy="85" r="1" fill="white" opacity="0.1"/><circle cx="65" cy="95" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23registerGrain)"/></svg>');
        opacity: 0.3;
    }

    .register-logo {
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

    .register-logo i {
        color: var(--bnn-accent);
        font-size: 2rem;
    }

    .register-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        position: relative;
        z-index: 1;
    }

    .register-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }

    .card-body-register {
        padding: 2rem;
    }

    .form-group-register {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label-register {
        font-weight: 600;
        color: var(--bnn-dark);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .form-label-register i {
        margin-right: 0.5rem;
        color: var(--bnn-accent);
        width: 16px;
    }

    .form-control-register {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-control-register:focus {
        border-color: var(--bnn-accent);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        background: white;
        transform: translateY(-1px);
    }

    .form-control-register.is-invalid {
        border-color: var(--bnn-secondary);
        background: #fef2f2;
    }

    .form-select-register {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8fafc;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23059669' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .form-select-register:focus {
        border-color: var(--bnn-accent);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        background-color: white;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23059669' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        transform: translateY(-1px);
        outline: none;
    }

    .form-select-register.is-invalid {
        border-color: var(--bnn-secondary);
        background-color: #fef2f2;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23dc2626' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    .btn-register {
        background: linear-gradient(135deg, var(--bnn-accent) 0%, var(--bnn-primary) 100%);
        border: none;
        border-radius: 12px;
        padding: 0.9rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(5, 150, 105, 0.3);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    .role-info {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        color: #15803d;
    }

    .role-info i {
        color: var(--bnn-accent);
        margin-right: 0.5rem;
    }

    .password-strength {
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
    }

    .password-strength i {
        margin-right: 0.25rem;
        font-size: 0.7rem;
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

    .login-link {
        text-align: center;
        padding: 1rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 12px;
        margin-top: 1rem;
    }

    .login-link p {
        margin: 0;
        color: #64748b;
        font-size: 0.9rem;
    }

    .login-link a {
        color: var(--bnn-accent);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .login-link a:hover {
        color: var(--bnn-primary);
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

    .register-card {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .card-body-register {
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
            font-size: 1.5rem;
        }

        .register-container {
            padding: 1rem 0;
        }
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
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
                        <strong>Informasi:</strong> Pilih role sesuai dengan status Anda untuk mendapatkan konten quiz yang tepat.
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
                                Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-register @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required
                                   placeholder="Masukkan alamat email Anda">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group-register">
                            <label class="form-label-register">
                                <i class="fas fa-users"></i>
                                Role / Status
                            </label>
                            <select name="role" 
                                    class="form-select form-select-register @error('role') is-invalid @enderror" 
                                    required>
                                <option value="">Pilih Status Anda</option>
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
                                   placeholder="Buat password yang kuat"
                                   minlength="8">
                            <div class="password-strength">
                                <i class="fas fa-shield-alt"></i>
                                Minimal 8 karakter, gunakan kombinasi huruf dan angka
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
                                   placeholder="Ketik ulang password Anda">
                        </div>
                        
                        <button type="submit" class="btn btn-register w-100">
                            <i class="fas fa-user-plus me-2"></i>
                            Daftar Sekarang
                        </button>
                    </form>
                    
                    <div class="divider">
                        <span>sudah punya akun?</span>
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