@extends('layouts.master')
@section('title', 'Dashboard - EMIRA')
@section('page_title', 'Dashboard')
@section('content')

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card-custom">
            <div class="stat-card-icon-custom gradient-teal">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-card-content">
                <span class="stat-label">Pasien Hari Ini</span>
                <h2 class="stat-value">{{ $stats['pasien_hari_ini'] }}</h2>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>Hari ini</span>
                </div>
            </div>
            <div class="stat-card-bg"></div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card-custom">
            <div class="stat-card-icon-custom gradient-orange">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-card-content">
                <span class="stat-label">Antrian Hari Ini</span>
                <h2 class="stat-value">{{ $stats['antrian_hari_ini'] }}</h2>
                <div class="stat-trend trend-active">
                    <i class="fas fa-circle"></i>
                    <span>{{ \App\Models\Antrian::where('status', 'menunggu')->whereDate('tanggal', today())->count() }} menunggu</span>
                </div>
            </div>
            <div class="stat-card-bg"></div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card-custom">
            <div class="stat-card-icon-custom gradient-green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-card-content">
                <span class="stat-label">Kunjungan Selesai</span>
                <h2 class="stat-value">{{ $stats['kunjungan_selesai'] }}</h2>
                <div class="stat-trend trend-up">
                    <i class="fas fa-check"></i>
                    <span>Completed</span>
                </div>
            </div>
            <div class="stat-card-bg"></div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card-custom">
            <div class="stat-card-icon-custom gradient-purple">
                <i class="fas fa-user-injured"></i>
            </div>
            <div class="stat-card-content">
                <span class="stat-label">Total Pasien</span>
                <h2 class="stat-value">{{ $stats['total_pasien'] }}</h2>
                <div class="stat-trend trend-neutral">
                    <i class="fas fa-database"></i>
                    <span>Semua data</span>
                </div>
            </div>
            <div class="stat-card-bg"></div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="row g-4">
    <!-- Antrian Hari Ini -->
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon gradient-teal">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Antrian Hari Ini</h5>
                        <small class="text-muted">{{ $antrian_hari_ini->count() }} pasien dalam antrian</small>
                    </div>
                </div>
                <a href="{{ route('antrian.index') }}" class="btn-custom btn-outline">
                    <i class="fas fa-eye me-1"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body-custom p-0">
                @if($antrian_hari_ini->count() > 0)
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pasien</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($antrian_hari_ini as $antrian)
                            <tr>
                                <td>
                                    <span class="badge-custom badge-primary">{{ $antrian->no_urut }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-mini">
                                            {{ substr($antrian->pasien->nama_lengkap ?? 'P', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $antrian->pasien->nama_lengkap }}</div>
                                            <small class="text-muted">{{ $antrian->pasien->no_rm }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="poli-badge">{{ $antrian->poli->nama_poli }}</span>
                                </td>
                                <td>
                                    <span>{{ $antrian->dokter->nama_lengkap ?? '-' }}</span>
                                </td>
                                <td>
                                    @if($antrian->status == 'menunggu')
                                        <span class="status-badge status-waiting"><i class="fas fa-clock me-1"></i>Menunggu</span>
                                    @elseif($antrian->status == 'dipanggil')
                                        <span class="status-badge status-calling"><i class="fas fa-bell me-1"></i>Dipanggil</span>
                                    @elseif($antrian->status == 'dalam_pelayanan')
                                        <span class="status-badge status-serving"><i class="fas fa-user-md me-1"></i>Dilayani</span>
                                    @elseif($antrian->status == 'selesai')
                                        <span class="status-badge status-done"><i class="fas fa-check me-1"></i>Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($antrian->status == 'menunggu')
                                    <form action="{{ route('antrian.panggil', $antrian->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-action btn-action-primary" title="Panggil">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-clipboard"></i></div>
                    <h6>Tidak Ada Antrian</h6>
                    <p>Belum ada pasien dalam antrian hari ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Kunjungan Terbaru -->
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon gradient-purple">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">Kunjungan Terbaru</h5>
                        <small class="text-muted">{{ $kunjugan_terbaru->count() }} kunjungan terkini</small>
                    </div>
                </div>
                <a href="{{ route('rekam_medis.index') }}" class="btn-custom btn-outline">
                    <i class="fas fa-eye me-1"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body-custom p-0">
                @if($kunjugan_terbaru->count() > 0)
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>No. Kunjungan</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Poli</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kunjugan_terbaru as $kunjungan)
                            <tr>
                                <td>
                                    <span class="badge-custom badge-secondary">{{ $kunjungan->no_kunjungan }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-mini">
                                            {{ substr($kunjungan->pasien->nama_lengkap ?? 'P', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $kunjungan->pasien->nama_lengkap }}</div>
                                            <small class="text-muted">{{ $kunjungan->pasien->no_rm }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-mini gradient-teal">
                                            {{ substr($kunjungan->dokter->nama_lengkap ?? 'D', 0, 1) }}
                                        </div>
                                        <span>{{ $kunjungan->dokter->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="poli-badge">{{ $kunjungan->poli->nama_poli ?? '-' }}</span>
                                </td>
                                <td>
                                    @if($kunjungan->status == 'menunggu')
                                        <span class="status-badge status-waiting">Menunggu</span>
                                    @elseif($kunjungan->status == 'dalam_pemeriksaan')
                                        <span class="status-badge status-calling">Pemeriksaan</span>
                                    @elseif($kunjungan->status == 'selesai')
                                        <span class="status-badge status-done">Selesai</span>
                                    @else
                                        <span class="status-badge status-waiting">{{ $kunjungan->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('rekam_medis.show', $kunjungan->id) }}" class="btn-action btn-action-primary" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-file-medical"></i></div>
                    <h6>Tidak Ada Kunjungan</h6>
                    <p>Belum ada kunjungan pasien hari ini</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="quick-actions-card">
            <h6 class="mb-3"><i class="fas fa-bolt me-2 text-emira"></i>Aksi Cepat</h6>
            <h6 class="mb-3"><i class="fas fa-bolt me-2 text-emira"></i>Aksi Cepat</h6>
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('antrian.create') }}" class="quick-action">
                    <div class="quick-action-icon gradient-teal"><i class="fas fa-plus"></i></div>
                    <span>Antrian Baru</span>
                </a>
                <a href="{{ route('pasien.create') }}" class="quick-action">
                    <div class="quick-action-icon gradient-purple"><i class="fas fa-user-plus"></i></div>
                    <span>Pasien Baru</span>
                </a>
                <a href="{{ route('rekam_medis.index') }}" class="quick-action">
                    <div class="quick-action-icon gradient-orange"><i class="fas fa-file-medical-alt"></i></div>
                    <span>Rekam Medis</span>
                </a>
                <a href="{{ route('vital_sign.index') }}" class="quick-action">
                    <div class="quick-action-icon gradient-green"><i class="fas fa-heartbeat"></i></div>
                    <span>Vital Sign</span>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Stat Cards */
    .stat-card-custom {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .stat-card-custom:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .stat-card-icon-custom {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    
    .gradient-teal { background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%); }
    .gradient-orange { background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); }
    .gradient-green { background: linear-gradient(135deg, #10b981 0%, #34d399 100%); }
    .gradient-purple { background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%); }
    
    .stat-card-content {
        flex: 1;
        position: relative;
        z-index: 1;
    }
    
    .stat-label {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 0.5rem;
        line-height: 1;
    }
    
    .stat-trend {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.25rem 0.625rem;
        border-radius: 20px;
    }
    
    .trend-up { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .trend-active { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .trend-neutral { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
    
    .stat-card-bg {
        position: absolute;
        right: -20px;
        top: -20px;
        width: 120px;
        height: 120px;
        background: currentColor;
        opacity: 0.03;
        border-radius: 50%;
    }
    
    /* Cards */
    .card-custom {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
        height: 100%;
    }
    
    .card-header-custom {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafbfc;
    }
    
    .header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }
    
    .card-header-custom h5 {
        font-weight: 600;
        color: #1e293b;
        font-size: 1rem;
    }
    
    .btn-custom {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
    }
    
    .btn-outline {
        border: 2px solid #08C195;
        color: #08C195;
        background: transparent;
    }
    
    .btn-outline:hover {
        background: #08C195;
        color: white;
    }
    
    .card-body-custom {
        padding: 1rem;
    }
    
    /* Table */
    .table-custom {
        width: 100%;
        margin: 0;
    }
    
    .table-custom thead th {
        background: transparent;
        color: #64748b;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .table-custom tbody td {
        padding: 0.875rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8fafc;
        font-size: 0.875rem;
    }
    
    .table-custom tbody tr:hover {
        background: #fafbfc;
    }
    
    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }
    
    .badge-custom {
        padding: 0.35rem 0.65rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-primary { background: rgba(8, 193, 149, 0.1); color: #08C195; }
    .badge-secondary { background: #f1f5f9; color: #64748b; }
    
    .avatar-mini {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .avatar-mini.gradient-teal {
        background: linear-gradient(135deg, #08C195 0%, #0ed6a8 100%);
    }
    
    .poli-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 0.25rem 0.625rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .status-waiting { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .status-calling { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
    .status-serving { background: rgba(8, 193, 149, 0.1); color: #08C195; }
    .status-done { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    
    .btn-action {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.8rem;
    }
    
    .btn-action-primary { background: rgba(8, 193, 149, 0.1); color: #08C195; }
    .btn-action-primary:hover { background: #08C195; color: white; }
    
    /* Empty State */
    .empty-state {
        padding: 3rem;
        text-align: center;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: #94a3b8;
    }
    
    .empty-state h6 {
        color: #475569;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .empty-state p {
        color: #94a3b8;
        font-size: 0.875rem;
        margin: 0;
    }
    
    /* Quick Actions */
    .quick-actions-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .quick-actions-card h6 {
        color: #1e293b;
        font-weight: 600;
    }
    
    .quick-action {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.625rem;
        padding: 1rem 1.5rem;
        background: #fafbfc;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .quick-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .quick-action:hover .quick-action-icon {
        transform: scale(1.1);
    }
    
    .quick-action-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        transition: transform 0.2s;
    }
    
    .quick-action span {
        font-size: 0.8rem;
        font-weight: 500;
        color: #475569;
    }
    
    .text-emira { color: #08C195 !important; }
</style>
@endsection
