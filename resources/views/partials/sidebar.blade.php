<aside class="sidebar" id="sidebar">
    <!-- Brand & User (Fixed Top) -->
    <div class="sidebar-header">
        <!-- Brand -->
        <div class="sidebar-brand">
            <div class="d-flex align-items-center gap-3">
                <div class="brand-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div>
                    <h4 class="brand-text">EMIRA</h4>
                    <small class="brand-subtitle">Rekam Medis Terintegrasi</small>
                </div>
            </div>
        </div>
        
        <!-- User Profile -->
        <div class="sidebar-user">
            <div class="user-avatar-wrapper">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="online-status"></div>
            </div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">
                    <span class="role-badge">{{ Auth::user()->role?->display_name ?? 'User' }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation Menu (Scrollable) -->
    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Utama</div>
            
            <a class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="nav-icon"><i class="fas fa-home"></i></div>
                <span class="nav-text">Dashboard</span>
                <div class="nav-indicator"></div>
            </a>
            
            @if(Auth::user()->isSuperAdmin() || Auth::user()->isRekamMedis())
            <a class="nav-item {{ request()->routeIs('pasien.*') ? 'active' : '' }}" href="{{ route('pasien.index') }}">
                <div class="nav-icon"><i class="fas fa-users"></i></div>
                <span class="nav-text">Data Pasien</span>
                <div class="nav-indicator"></div>
            </a>
            @endif
            
            <a class="nav-item {{ request()->routeIs('antrian.*') ? 'active' : '' }}" href="{{ route('antrian.index') }}">
                <div class="nav-icon"><i class="fas fa-clipboard-list"></i></div>
                <span class="nav-text">Antrian</span>
                @php
                $antrianCount = \App\Models\Antrian::where('status', 'menunggu')->whereDate('tanggal', today())->count();
                @endphp
                @if($antrianCount > 0)
                <span class="nav-badge">{{ $antrianCount }}</span>
                @endif
                <div class="nav-indicator"></div>
            </a>
            
            @if(Auth::user()->isSuperAdmin())
            <a class="nav-item {{ request()->routeIs('booking.*') ? 'active' : '' }}" href="{{ route('booking.index') }}">
                <div class="nav-icon"><i class="fas fa-calendar-check"></i></div>
                <span class="nav-text">Booking Online</span>
                @php
                $bookingCount = \App\Models\Booking::where('status', 'pending')->count();
                @endphp
                @if($bookingCount > 0)
                <span class="nav-badge">{{ $bookingCount }}</span>
                @endif
                <div class="nav-indicator"></div>
            </a>
            @endif
            
            @if(Auth::user()->isSuperAdmin() || Auth::user()->isRekamMedis() || Auth::user()->isDokter())
            <a class="nav-item {{ request()->routeIs('rekam_medis.*') ? 'active' : '' }}" href="{{ route('rekam_medis.index') }}">
                <div class="nav-icon"><i class="fas fa-file-medical-alt"></i></div>
                <span class="nav-text">Rekam Medis</span>
                <div class="nav-indicator"></div>
            </a>
            @endif
            
            @if(Auth::user()->isSuperAdmin() || Auth::user()->isRekamMedis() || Auth::user()->isPerawat())
            <a class="nav-item {{ request()->routeIs('vital_sign.*') ? 'active' : '' }}" href="{{ route('vital_sign.index') }}">
                <div class="nav-icon"><i class="fas fa-heartbeat"></i></div>
                <span class="nav-text">Vital Sign</span>
                <div class="nav-indicator"></div>
            </a>
            @endif
        </div>
        
        @if(Auth::user()->isSuperAdmin())
        <div class="nav-section">
            <div class="nav-section-title">Master Data</div>
            
            <a class="nav-item {{ request()->routeIs('poli.*') ? 'active' : '' }}" href="{{ route('poli.index') }}">
                <div class="nav-icon"><i class="fas fa-hospital"></i></div>
                <span class="nav-text">Kelola Poli</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a class="nav-item {{ request()->routeIs('dokter.*') ? 'active' : '' }}" href="{{ route('dokter.index') }}">
                <div class="nav-icon"><i class="fas fa-user-md"></i></div>
                <span class="nav-text">Kelola Dokter</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a class="nav-item {{ request()->routeIs('jadwal.*') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                <div class="nav-icon"><i class="fas fa-calendar-alt"></i></div>
                <span class="nav-text">Jadwal Dokter</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a class="nav-item {{ request()->routeIs('ruangan.*') ? 'active' : '' }}" href="{{ route('ruangan.index') }}">
                <div class="nav-icon"><i class="fas fa-bed"></i></div>
                <span class="nav-text">Kelola Ruangan</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a class="nav-item {{ request()->routeIs('icd10.*') ? 'active' : '' }}" href="{{ route('icd10.index') }}">
                <div class="nav-icon"><i class="fas fa-code"></i></div>
                <span class="nav-text">Kode ICD-10</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a class="nav-item {{ request()->routeIs('tindakan.*') ? 'active' : '' }}" href="{{ route('tindakan.index') }}">
                <div class="nav-icon"><i class="fas fa-syringe"></i></div>
                <span class="nav-text">Master Tindakan</span>
                <div class="nav-indicator"></div>
            </a>
        </div>
        
        <div class="nav-section">
            <div class="nav-section-title">Pengaturan</div>
            
            <a class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <div class="nav-icon"><i class="fas fa-user-cog"></i></div>
                <span class="nav-text">Manajemen User</span>
                <div class="nav-indicator"></div>
            </a>
            
            <a class="nav-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}" href="{{ route('pengaturan.index') }}">
                <div class="nav-icon"><i class="fas fa-cogs"></i></div>
                <span class="nav-text">Pengaturan Sistem</span>
                <div class="nav-indicator"></div>
            </a>
        </div>
        @endif
        
        <div class="nav-section mt-auto">
            <a class="nav-item nav-item-logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="nav-icon"><i class="fas fa-sign-out-alt"></i></div>
                <span class="nav-text">Logout</span>
                <div class="nav-indicator"></div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
</aside>

<style>
    .sidebar {
        width: 280px;
        background: linear-gradient(180deg, #0a1f1a 0%, #0d2922 50%, #0a1f1a 100%);
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }
    
    /* Header (Fixed) */
    .sidebar-header {
        flex-shrink: 0;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    
    /* Brand */
    .sidebar-brand {
        padding: 1.25rem 1.25rem 1rem;
    }
    
    .brand-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
        box-shadow: 0 4px 12px rgba(8, 193, 149, 0.3);
    }
    
    .brand-text {
        color: white;
        font-weight: 700;
        font-size: 1.25rem;
        margin: 0;
        letter-spacing: -0.5px;
    }
    
    .brand-subtitle {
        color: rgba(255,255,255,0.4);
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* User Profile */
    .sidebar-user {
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.875rem;
        background: rgba(255,255,255,0.02);
    }
    
    .user-avatar-wrapper {
        position: relative;
    }
    
    .user-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        box-shadow: 0 4px 12px rgba(8, 193, 149, 0.4);
    }
    
    .online-status {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        background: #10b981;
        border: 2px solid #0d2922;
        border-radius: 50%;
    }
    
    .user-info {
        flex: 1;
    }
    
    .user-name {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.125rem;
    }
    
    .role-badge {
        background: rgba(8, 193, 149, 0.2);
        color: #0ed6a8;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 500;
    }
    
    /* Navigation - Scrollable */
    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 0.75rem 0;
    }
    
    .sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }
    
    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.1);
        border-radius: 2px;
    }
    
    .sidebar-nav:hover::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.25);
    }
    
    .nav-section {
        padding: 0 0.75rem;
        margin-bottom: 0.5rem;
    }
    
    .nav-section.mt-auto {
        margin-top: auto;
        padding-top: 0.5rem;
        border-top: 1px solid rgba(255,255,255,0.06);
    }
    
    .nav-section-title {
        color: rgba(255,255,255,0.3);
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        padding: 0.75rem 0.75rem 0.5rem;
    }
    
    .nav-item {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        padding: 0.75rem 1rem;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        border-radius: 10px;
        margin-bottom: 0.25rem;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .nav-item:hover {
        background: rgba(255,255,255,0.05);
        color: white;
    }
    
    .nav-item.active {
        background: linear-gradient(90deg, rgba(8, 193, 149, 0.2) 0%, rgba(8, 193, 149, 0.05) 100%);
        color: #0ed6a8;
    }
    
    .nav-item.active .nav-icon {
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(8, 193, 149, 0.4);
    }
    
    .nav-icon {
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    
    .nav-text {
        flex: 1;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .nav-badge {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        min-width: 20px;
        text-align: center;
    }
    
    .nav-indicator {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 0;
        background: #08C195;
        border-radius: 3px 0 0 3px;
        transition: height 0.2s ease;
    }
    
    .nav-item.active .nav-indicator {
        height: 24px;
    }
    
    .nav-item-logout {
        color: rgba(255, 200, 200, 0.7);
    }
    
    .nav-item-logout:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
    }
    
    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
            width: 280px;
        }
        .sidebar.show {
            transform: translateX(0);
        }
    }
</style>
