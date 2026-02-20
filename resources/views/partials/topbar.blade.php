<div class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="breadcrumb-area">
            <h1 class="page-title">@yield('page_title', 'Dashboard')</h1>
            <nav class="breadcrumb">
                <span class="breadcrumb-item">EMIRA</span>
                <i class="fas fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-item active">@yield('page_title', 'Dashboard')</span>
            </nav>
        </div>
    </div>
    
    <div class="topbar-right">
        <!-- Search -->
        <div class="search-wrapper">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="form-control" placeholder="Cari...">
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
            <button class="quick-action-btn" title="Notifikasi">
                <i class="fas fa-bell"></i>
                <span class="notification-dot"></span>
            </button>
        </div>
        
        <!-- User Menu -->
        <div class="user-menu-wrapper">
            <button class="user-menu-btn" onclick="toggleUserMenu()">
                <div class="user-avatar-small">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="user-menu-text">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ Auth::user()->role?->display_name ?? 'User' }}</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
            
            <div class="user-dropdown-menu" id="userDropdownMenu">
                <div class="dropdown-header">
                    <div class="user-avatar-dropdown">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-email">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
                <a href="{{ route('pengaturan.index') }}" class="dropdown-item">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item dropdown-item-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('success') || session('error'))
<div class="alert-wrapper animate__animated animate__fadeIn">
    <div class="alert alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
        <div class="alert-icon">
            <i class="fas fa-{{ session('success') ? 'check-circle' : 'exclamation-circle' }}"></i>
        </div>
        <div class="alert-content">
            <strong>{{ session('success') ? 'Berhasil!' : 'Gagal!' }}</strong>
            <p>{{ session('success') ?? session('error') }}</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif

<style>
    .topbar {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }
    
    .topbar-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .menu-toggle {
        display: none;
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .menu-toggle:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(8, 193, 149, 0.3);
    }
    
    @media (max-width: 991.98px) {
        .menu-toggle { display: flex; }
    }
    
    .breadcrumb-area {
        display: flex;
        flex-direction: column;
    }
    
    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.2;
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0.25rem 0 0;
        font-size: 0.8rem;
    }
    
    .breadcrumb-item {
        color: #64748b;
    }
    
    .breadcrumb-item.active {
        color: #08C195;
        font-weight: 500;
    }
    
    .breadcrumb-separator {
        font-size: 0.6rem;
        color: #cbd5e1;
    }
    
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    /* Search */
    .search-wrapper {
        position: relative;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }
    
    .search-box .form-control {
        padding: 0.625rem 1rem 0.625rem 2.5rem;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        background: #f8fafc;
        width: 200px;
        transition: all 0.2s;
        font-size: 0.875rem;
    }
    
    .search-box .form-control:focus {
        background: white;
        border-color: #08C195;
        box-shadow: 0 0 0 3px rgba(8, 193, 149, 0.1);
        width: 260px;
    }
    
    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .quick-action-btn {
        width: 44px;
        height: 44px;
        background: #f8fafc;
        border: none;
        border-radius: 12px;
        color: #64748b;
        font-size: 1rem;
        cursor: pointer;
        position: relative;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .quick-action-btn:hover {
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        color: white;
    }
    
    .notification-dot {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid white;
    }
    
    /* User Menu */
    .user-menu-wrapper {
        position: relative;
    }
    
    .user-menu-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        background: #f8fafc;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .user-menu-btn:hover {
        background: #f1f5f9;
    }
    
    .user-avatar-small {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
    }
    
    .user-menu-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .user-menu-text .user-name {
        font-weight: 600;
        font-size: 0.875rem;
        color: #1e293b;
        line-height: 1.2;
    }
    
    .user-menu-text .user-role {
        font-size: 0.75rem;
        color: #64748b;
    }
    
    .user-menu-btn i {
        color: #94a3b8;
        font-size: 0.75rem;
    }
    
    .user-dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 260px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s;
        z-index: 1000;
        overflow: hidden;
    }
    
    .user-dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .dropdown-header {
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        background: linear-gradient(135deg, rgba(8, 193, 149, 0.1) 0%, rgba(14, 214, 168, 0.05) 100%);
    }
    
    .user-avatar-dropdown {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .dropdown-header .user-name {
        font-weight: 600;
        color: #1e293b;
    }
    
    .dropdown-header .user-email {
        font-size: 0.8rem;
        color: #64748b;
    }
    
    .dropdown-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 0;
    }
    
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.25rem;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .dropdown-item:hover {
        background: #f8fafc;
        color: #08C195;
    }
    
    .dropdown-item i {
        width: 20px;
        text-align: center;
    }
    
    .dropdown-item-logout {
        color: #ef4444;
    }
    
    .dropdown-item-logout:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    /* Alert */
    .alert-wrapper {
        margin-bottom: 1.5rem;
    }
    
    .alert {
        border: none;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    
    .alert-success .alert-icon {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }
    
    .alert-danger .alert-icon {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }
    
    .alert-content {
        flex: 1;
    }
    
    .alert-content strong {
        display: block;
        margin-bottom: 0.125rem;
    }
    
    .alert-content p {
        margin: 0;
        font-size: 0.875rem;
        opacity: 0.85;
    }
    
    @media (max-width: 767.98px) {
        .search-wrapper { display: none; }
        .user-menu-text { display: none; }
        .topbar {
            padding: 0.875rem 1rem;
        }
    }
</style>

<script>
    function toggleUserMenu() {
        document.getElementById('userDropdownMenu').classList.toggle('show');
    }
    
    document.addEventListener('click', function(e) {
        const userMenu = document.querySelector('.user-menu-wrapper');
        if (!userMenu.contains(e.target)) {
            document.getElementById('userDropdownMenu').classList.remove('show');
        }
    });
</script>
