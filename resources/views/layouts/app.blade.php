<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Anti Narkoba BNN - @yield('title')</title>
    <link rel="icon" href="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Logo_BNN.svg/1200px-Logo_BNN.svg.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --bnn-primary: #1e40af;
            --bnn-secondary: #dc2626;
            --bnn-accent: #059669;
            --bnn-dark: #1f2937;
            --bnn-light: #f8fafc;
            --bnn-gold: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .navbar-bnn {
            background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
            box-shadow: 0 4px 20px rgba(30, 64, 175, 0.3);
            border-bottom: 3px solid var(--bnn-gold);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-brand {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.navbar-logo {
    width: 40px;          /* Ukuran logo diperkecil dari default */
    height: 40px;         /* Tinggi yang proporsional */
    object-fit: contain;  /* Mempertahankan aspek ratio */
    background: white;    /* Background putih untuk kontras */
    padding: 4px;         /* Sedikit padding */
    border-radius: 8px;   /* Sudut yang rounded */
    box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Shadow yang subtle */
}

.navbar-text-content {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.navbar-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    margin: 0;
}

.navbar-subtitle {
    font-size: 0.7rem;
    opacity: 0.9;
    color: white;
    margin: 0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .navbar-logo {
        width: 35px;
        height: 35px;
    }
    
    .navbar-title {
        font-size: 1rem;
    }
    
    .navbar-subtitle {
        font-size: 0.65rem;
    }
    
    .navbar-brand {
        gap: 0.5rem;
    }
}

@media (max-width: 576px) {
    .navbar-logo {
        width: 32px;
        height: 32px;
    }
    
    .navbar-title {
        font-size: 0.9rem;
    }
    
    .navbar-subtitle {
        display: none; /* Hide subtitle on very small screens */
    }
}

        .bnn-logo {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .bnn-logo i {
            color: var(--bnn-primary);
            font-size: 1.2rem;
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 4px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .badge-role {
            background: var(--bnn-gold) !important;
            color: var(--bnn-dark) !important;
            font-weight: 600;
            font-size: 0.7rem;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 0.5rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--bnn-primary), var(--bnn-secondary));
            color: white;
            transform: translateX(4px);
        }

        .dropdown-item i {
            width: 16px;
            margin-right: 8px;
        }

        .alert-bnn {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfdf7 0%, #a7f3d0 100%);
            border-left-color: var(--bnn-accent);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            border-left-color: var(--bnn-secondary);
            color: #991b1b;
        }

        .main-content {
            position: relative;
            z-index: 1;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(135deg, var(--bnn-primary) 0%, var(--bnn-secondary) 100%);
            opacity: 0.05;
            border-radius: 0 0 50px 50px;
            z-index: -1;
        }

        .btn-close {
            filter: brightness(0) saturate(100%) invert(25%) sepia(15%) saturate(2270%) hue-rotate(206deg) brightness(94%) contrast(89%);
        }

        .footer-pattern {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--bnn-primary) 0%, var(--bnn-gold) 50%, var(--bnn-secondary) 100%);
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .bnn-logo {
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-bnn">
    <div class="container">
        <a class="navbar-brand" href="{{ route('quiz.index') }}">
            <img src="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Logo_BNN.svg/1200px-Logo_BNN.svg.png') }}" 
                 alt="BNN Logo" 
                 class="d-inline-block align-text-top navbar-logo">
            <div class="navbar-text-content">
                <div class="navbar-title">Quiz Anti Narkoba</div>
                <small class="navbar-subtitle">Badan Narkotika Nasional</small>
            </div>
        </a>
        
        @auth
        <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2"></i> 
                    {{ auth()->user()->name }}
                    <span class="badge badge-role ms-2">{{ ucfirst(auth()->user()->role) }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if(auth()->user()->isAdmin())
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard Admin
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.results.index') }}">
                            <i class="fas fa-chart-bar"></i> Hasil Quiz
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.quizzes') }}">
                            <i class="fas fa-cogs"></i> Kelola Quiz
                        </a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('quiz.index') }}">
                            <i class="fas fa-play-circle"></i> Mulai Quiz
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('quiz.history') }}">
                            <i class="fas fa-history"></i> Riwayat Quiz
                        </a></li>
                    @endif
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @endauth
    </div>
</nav>

    <main class="py-4 main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-bnn alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-bnn alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <div class="footer-pattern"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    
    <script>
        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>