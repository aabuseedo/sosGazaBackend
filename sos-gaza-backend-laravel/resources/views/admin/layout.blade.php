<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة تحكم الأدمن')</title>
    
    <!-- Bootstrap RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
<style>
    /* الخط والخلفية العامة */
    body { 
        font-family: 'Cairo', sans-serif; 
        background: #FFF3EE; 
        color: #333335;
    }

    /* الشريط الجانبي */
    .sidebar { 
        width: 240px; 
        background: #C8473B; 
        min-height: 100vh; 
        color: #fff; 
        position: fixed; 
        right: 0; 
        top: 0; 
    }

    .sidebar h4 { 
        margin-bottom: 0; 
        color: #FEFEFE;
    }

    .sidebar a { 
        color: #FEFEFE; 
        text-decoration: none; 
        display: block; 
        padding: 12px 20px; 
        font-weight: 500;
    }

    .sidebar a:hover { 
        background: #FF8775; 
        border-radius: 6px; 
        color: #fff;
    }

    .sidebar .active { 
        background: #EC675C; 
        border-radius: 6px; 
        color: #FEFEFE;
    }

    /* المحتوى الرئيسي */
    .app-content { 
        margin-right: 240px; 
        padding: 20px; 
        background: #FFEBE2; 
        min-height: 100vh;
    }

    /* البطاقات */
    .content-card { 
        background: #FEFEFE; 
        border-radius: 12px; 
        padding: 20px; 
        box-shadow: 0 3px 8px rgba(0,0,0,0.08); 
        margin-bottom: 20px; 
        
    }

    /* البادجات */
    .badge-status.active { 
        background-color: #3C8B72; 
        color: #fff; 
        padding: 5px 10px; 
        border-radius: 6px; 
    }

    .badge-status.expired { 
        background-color: #EC675C; 
        color: #fff; 
        padding: 5px 10px; 
        border-radius: 6px; 
    }

    /* الجداول */
    .table th, .table td { 
        vertical-align: middle; 
        color: #606062;
    }

    .table thead th {
        background: #FFEBE2;
        color: #333335;
        font-weight: 600;
    }

    /* الأزرار */
    .btn-primary { 
        background-color: #C8473B; 
        border-color: #C8473B; 
    }
    .btn-primary:hover { 
        background-color: #EC675C; 
        border-color: #EC675C; 
    }
    .btn-outline-primary { 
        color: #C8473B; 
        border-color: #C8473B; 
    }
    .btn-outline-primary:hover { 
        background-color: #FF8775; 
        border-color: #FF8775; 
        color: #FEFEFE;
    }

    /* التوافق مع الموبايل */
    @media (max-width: 768px) { 
        .app-content { margin-right: 0; } 
        .sidebar { position: relative; width: 100%; } 
    }
</style>
    @stack('styles')
</head>
<body>

<!-- الشريط الجانبي -->
<aside class="sidebar" id="sidebar">
    <div class="p-4 text-center border-bottom">
        <h4>لوحة التحكم</h4>
    </div>
    <nav class="mt-3">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 ms-1"></i> لوحة القيادة
        </a>

        <a href="{{ route('admin.notifications.index') }}" class="{{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
            <i class="bi bi-bell ms-1"></i> الإشعارات
        </a>

        <a href="{{ route('admin.courses.index') }}" class="{{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark ms-1"></i> الكورسات
        </a>

        <!--  <a href="{{ route('admin.lessons.index') }}" class="{{ request()->routeIs('admin.lessons.*') ? 'active' : '' }}">
            <i class="bi bi-play-btn ms-1"></i> الدروس
        </a>
        -->

        <a href="{{ route('admin.sos-requests.index') }}" class="{{ request()->routeIs('admin.sos-requests.*') ? 'active' : '' }}">
            <i class="bi bi-exclamation-octagon ms-1"></i> طلبات SOS
        </a>

        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-people ms-1"></i> المستخدمين
        </a>

        <a href="{{ route('admin.smart-assistants.index') }}" class="{{ request()->routeIs('admin.smart-assistants.*') ? 'active' : '' }}">
        <i class="bi bi-lightbulb ms-1"></i> المساعد الذكي
        </a>


        <a href="{{ route('admin.otp-codes.index') }}" class="{{ request()->routeIs('admin.otp-codes.*') ? 'active' : '' }}">
            <i class="bi bi-key ms-1"></i> رموز OTP
        </a>

        <form action="{{ route('admin.logout') }}" method="POST" class="mt-3 text-center">
            @csrf
            <button class="btn btn-danger btn-sm w-75">
                <i class="bi bi-box-arrow-left ms-1"></i> تسجيل خروج
            </button>
        </form>
    </nav>
</aside>

<!-- المحتوى الرئيسي -->
<main class="app-content">
    <div class="container-fluid">

        <!-- التنبيهات -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle ms-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-2">حدثت بعض الأخطاء:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- محتوى الصفحة -->
        @yield('content')
    </div>
</main>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
