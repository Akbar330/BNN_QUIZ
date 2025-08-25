<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Anti Narkoba BNN - @yield('title')</title>
    <link rel="icon" href="{{ url('https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Logo_BNN.svg/1200px-Logo_BNN.svg.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --bnn-blue-dark: #1e3a8a;     /* Biru tua untuk header */
            --bnn-blue-light: #3b82f6;    /* Biru muda untuk aksen */
            --bnn-blue-soft: #dbeafe;     /* Biru sangat muda untuk background */
            --bnn-yellow: #fbbf24;        /* Kuning untuk aksen kecil */
            --bnn-yellow-light: #fef3c7;  /* Kuning muda untuk highlight */
            --bnn-white: #ffffff;
            --bnn-gray-light: #f8fafc;
            --bnn-gray-dark: #374151;
            --bnn-success: #10b981;
            --bnn-danger: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--bnn-white) 0%, var(--bnn-blue-soft) 100%);
            min-height: 100vh;
            color: var(--bnn-gray-dark);
            line-height: 1.6;
        }

        .navbar-bnn {
            background: linear-gradient(135deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 100%);
            box-shadow: 0 8px 32px rgba(30, 58, 138, 0.15);
            border-bottom: 3px solid var(--bnn-yellow);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .navbar-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background: var(--bnn-white);
            padding: 6px;
            border-radius: 50%;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-logo:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .navbar-text-content {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--bnn-white);
            margin: 0;
        }

        .navbar-subtitle {
            font-size: 0.75rem;
            opacity: 0.9;
            color: var(--bnn-yellow-light);
            margin: 0;
            font-weight: 400;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-logo {
                width: 40px;
                height: 40px;
            }
            
            .navbar-title {
                font-size: 1rem;
            }
            
            .navbar-subtitle {
                font-size: 0.7rem;
            }
            
            .navbar-brand {
                gap: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-logo {
                width: 35px;
                height: 35px;
            }
            
            .navbar-title {
                font-size: 0.9rem;
            }
            
            .navbar-subtitle {
                display: none;
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
            color: var(--bnn-blue-dark);
            font-size: 1.2rem;
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 0 4px;
            padding: 0.6rem 1rem;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-1px);
            color: var(--bnn-yellow-light) !important;
        }

        .badge-role {
            background: var(--bnn-yellow) !important;
            color: var(--bnn-blue-dark) !important;
            font-weight: 600;
            font-size: 0.7rem;
            padding: 6px 10px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 16px 48px rgba(30, 58, 138, 0.12);
            border-radius: 16px;
            padding: 0.75rem 0;
            margin-top: 0.5rem;
            background: var(--bnn-white);
            min-width: 220px;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 0 0.5rem;
            color: var(--bnn-gray-dark);
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--bnn-blue-light), var(--bnn-blue-dark));
            color: white;
            transform: translateX(6px);
        }

        .dropdown-item i {
            width: 18px;
            margin-right: 10px;
            color: var(--bnn-blue-light);
        }

        .dropdown-item:hover i {
            color: var(--bnn-yellow-light);
        }

        .alert-bnn {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-left: 5px solid;
            padding: 1.25rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-left-color: var(--bnn-success);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-left-color: var(--bnn-danger);
            color: #991b1b;
        }

        .main-content {
            position: relative;
            z-index: 1;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(135deg, var(--bnn-blue-soft) 0%, rgba(59, 130, 246, 0.1) 100%);
            border-radius: 0 0 60px 60px;
            z-index: -1;
        }

        .btn-close {
            filter: brightness(0) saturate(100%) invert(25%) sepia(15%) saturate(2270%) hue-rotate(206deg) brightness(94%) contrast(89%);
            border-radius: 50%;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-close:hover {
            transform: scale(1.1);
            background: rgba(59, 130, 246, 0.1);
        }

        .footer-pattern {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--bnn-blue-dark) 0%, var(--bnn-blue-light) 30%, var(--bnn-yellow) 50%, var(--bnn-blue-light) 70%, var(--bnn-blue-dark) 100%);
            z-index: 1000;
            box-shadow: 0 -2px 16px rgba(30, 58, 138, 0.2);
        }

        /* Floating Background Shapes */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .floating-shape {
            position: absolute;
            background: var(--bnn-blue-soft);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 15s infinite linear;
        }

        .floating-shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }

        .floating-shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(0) rotate(180deg); }
            75% { transform: translateY(-10px) rotate(270deg); }
        }
    </style>
</head>
<body>
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>

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