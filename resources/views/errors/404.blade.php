{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="error-card">
                <div class="error-content text-center">
                    <!-- Logo BNN dan 404 Number -->
                    <div class="error-icon-wrapper mb-4">
                        <img src="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Logo_BNN.svg/1200px-Logo_BNN.svg.png') }}" 
                             alt="BNN Logo" class="error-logo mb-3">
                        <h1 class="error-number">404</h1>
                    </div>

                    <!-- Error Message -->
                    <div class="error-message mb-4">
                        <h2 class="error-title mb-3">Halaman Tidak Ditemukan</h2>
                        <p class="error-description">
                            Maaf, anda telah keluar dari jalan yang benar, silahkan kembali ke jalan yang lurus.
                        </p>
                        
                        <!-- Inspirational Quote -->
                        <div class="error-quote mt-4 mb-4">
                            <blockquote class="blockquote">
                                <p class="quote-text">"Tunjukilah kami jalan yang lurus"</p>
                                <footer class="blockquote-footer mt-2">
                                    <cite title="Source Title">Q.S. Al-Fatihah ayat 6</cite>
                                </footer>
                            </blockquote>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="error-actions">
                        <a href="{{ route('quiz.index') }}" class="btn btn-bnn-primary me-3 mb-2">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Additional Links for Authenticated Users -->
                    @auth
                    <div class="error-suggestions mt-4">
                        <p class="suggestions-title">Atau coba halaman lain:</p>
                        <div class="suggestions-links">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="suggestion-link">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard Admin
                                </a>
                                <a href="{{ route('admin.results.index') }}" class="suggestion-link">
                                    <i class="fas fa-chart-bar"></i> Hasil Quiz
                                </a>
                            @else
                                <a href="{{ route('quiz.history') }}" class="suggestion-link">
                                    <i class="fas fa-history"></i> Riwayat Quiz
                                </a>
                            @endif
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Error Page Specific Styles matching BNN Theme */
    .error-card {
        background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-gray-light) 100%);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(30, 58, 138, 0.1);
        padding: 3rem 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(59, 130, 246, 0.1);
        position: relative;
        overflow: hidden;
    }

    .error-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 30%, var(--bnn-yellow) 50%, var(--bnn-blue-light) 70%, var(--bnn-blue-dark) 100%);
        border-radius: 24px 24px 0 0;
    }

    .error-logo {
        width: 80px;
        height: 80px;
        background: var(--bnn-white);
        padding: 12px;
        border-radius: 50%;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.15);
        border: 3px solid var(--bnn-blue-soft);
        transition: all 0.3s ease;
    }

    .error-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 40px rgba(30, 58, 138, 0.2);
    }

    .error-number {
        font-size: 6rem;
        font-weight: 700;
        color: var(--bnn-blue-light);
        text-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
        margin: 0;
        line-height: 1;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .error-title {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .error-description {
        color: var(--bnn-gray-dark);
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 500px;
        margin: 0 auto;
    }

    .error-quote {
        background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, var(--bnn-yellow-light) 100%);
        border-radius: 16px;
        padding: 1.5rem;
        border-left: 4px solid var(--bnn-yellow);
        margin: 1.5rem auto;
        max-width: 400px;
    }

    .quote-text {
        font-style: italic;
        font-size: 1rem;
        color: var(--bnn-blue-dark);
        margin: 0;
        font-weight: 500;
    }

    .blockquote-footer {
        color: var(--bnn-gray-dark);
        font-size: 0.875rem;
        opacity: 0.8;
    }

    /* BNN Themed Buttons */
    .btn-bnn-primary {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-bnn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(59, 130, 246, 0.4);
        color: white;
    }

    .btn-bnn-secondary {
        background: linear-gradient(135deg, var(--bnn-gray-light), #e5e7eb);
        border: 2px solid var(--bnn-blue-light);
        color: var(--bnn-blue-dark);
        font-weight: 600;
        padding: 10px 26px;
        border-radius: 12px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-bnn-secondary:hover {
        background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    }

    .suggestions-title {
        color: var(--bnn-blue-dark);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .suggestions-links {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
    }

    .suggestion-link {
        background: var(--bnn-white);
        border: 1px solid var(--bnn-blue-soft);
        color: var(--bnn-blue-dark);
        padding: 0.75rem 1.25rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .suggestion-link:hover {
        background: var(--bnn-blue-light);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.2);
    }

    .suggestion-link i {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .error-card {
            padding: 2rem 1.5rem;
            margin-top: 1rem;
        }

        .error-number {
            font-size: 4rem;
        }

        .error-title {
            font-size: 1.5rem;
        }

        .error-description {
            font-size: 1rem;
        }

        .error-logo {
            width: 60px;
            height: 60px;
        }

        .error-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .suggestions-links {
            flex-direction: column;
            align-items: center;
        }

        .suggestion-link {
            width: 100%;
            max-width: 250px;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .error-number {
            font-size: 3rem;
        }

        .error-title {
            font-size: 1.25rem;
        }

        .btn-bnn-primary,
        .btn-bnn-secondary {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }
    }
</style>
@endpush
@endsection