@extends('layouts.master')
@section('title', 'Data Antrian - EMIRA')
@section('page_title', 'Antrian')
@section('content')
<div class="card-custom mb-4">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-orange">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <h5 class="card-title">Antrian Pasien</h5>
                <small class="text-muted">Kelola antrian pasien hari ini</small>
            </div>
        </div>
        <a href="{{ route('antrian.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Antrian Baru
        </a>
    </div>
    <div class="card-body-custom">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <select name="poli_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Poli</option>
                        @foreach(\App\Models\Poli::where('is_active', 1)->get() as $poli)
                        <option value="{{ $poli->id }}" {{ request('poli_id') == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="dipanggil" {{ request('status') == 'dipanggil' ? 'selected' : '' }}>Dipanggil</option>
                        <option value="dalam_pelayanan" {{ request('status') == 'dalam_pelayanan' ? 'selected' : '' }}>Dilayani</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>
        </form>
        
        @if($antrians->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Pasien</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Jam Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($antrians as $antrian)
                    <tr>
                        <td><span class="badge-custom badge-primary">{{ $antrian->no_urut }}</span></td>
                        <td><code>{{ $antrian->kode_antrian }}</code></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-teal">{{ substr($antrian->pasien->nama_lengkap ?? 'P', 0, 1) }}</div>
                                <div>
                                    <div class="fw-semibold">{{ $antrian->pasien->nama_lengkap }}</div>
                                    <small class="text-muted">{{ $antrian->pasien->no_rm }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge-custom badge-purple">{{ $antrian->poli->nama_poli }}</span></td>
                        <td>{{ $antrian->dokter->nama_lengkap ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($antrian->jam_daftar)->format('H:i') }}</td>
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
                            <div class="d-flex gap-1">
                                @if($antrian->status == 'menunggu')
                                <form action="{{ route('antrian.panggil', $antrian->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-action btn-action-primary" title="Panggil Pasien">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                </form>
                                @endif

                                @if($antrian->status == 'dipanggil')
                                <form action="{{ route('antrian.layani', $antrian->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-action" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;" title="Mulai Periksa">
                                        <i class="fas fa-stethoscope"></i>
                                    </button>
                                </form>
                                @endif

                                @if(in_array($antrian->status, ['dipanggil', 'dalam_pelayanan']))
                                <button type="button" class="btn-action btn-action-info" title="Vital Sign" data-bs-toggle="modal" data-bs-target="#vitalSignModal{{ $antrian->id }}">
                                    <i class="fas fa-heartbeat"></i>
                                </button>
                                @endif

                                @if($antrian->status == 'dalam_pelayanan')
                                <a href="{{ route('rekam_medis.create', $antrian->kunjungan->first()->id) }}" class="btn-action btn-action-warning" title="Buat Rekam Medis">
                                    <i class="fas fa-file-medical-alt"></i>
                                </a>
                                <form action="{{ route('antrian.selesai', $antrian->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-action btn-action-success" title="Selesai">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                @if($antrian->status == 'selesai')
                                <a href="{{ route('rekam_medis.show', $antrian->kunjungan->first()->rekamMedis->id) }}" class="btn-action btn-action-info" title="Lihat Rekam Medis">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @endif

                                @if($antrian->status != 'selesai')
                                <form action="{{ route('antrian.destroy', $antrian->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus antrian ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $antrians->firstItem() }}</strong> - <strong>{{ $antrians->lastItem() }}</strong> dari <strong>{{ $antrians->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $antrians->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-clipboard-list"></i></div>
            <h6>Tidak Ada Antrian</h6>
            <p>Belum ada antrian pasien hari ini.</p>
            <a href="{{ route('antrian.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Antrian
            </a>
        </div>
        @endif
    </div>
</div>

@foreach($antrians as $antrian)
<div class="modal fade" id="vitalSignModal{{ $antrian->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-heartbeat me-2 text-danger"></i>
                    Vital Sign - {{ $antrian->pasien->nama_lengkap }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('vital_sign.store', $antrian->kunjungan->first()->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">TD Sistol <span class="text-danger">*</span></label>
                            <input type="number" name="tekanan_darah_sistol" class="form-control" placeholder="120" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">TD Diastol <span class="text-danger">*</span></label>
                            <input type="number" name="tekanan_darah_diastol" class="form-control" placeholder="80" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nadi <span class="text-danger">*</span></label>
                            <input type="number" name="nadi" class="form-control" placeholder="80" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pernapasan <span class="text-danger">*</span></label>
                            <input type="number" name="pernapasan" class="form-control" placeholder="20" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Suhu <span class="text-danger">*</span></label>
                            <input type="number" name="suhu" step="0.1" class="form-control" placeholder="36.5" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">SpO2</label>
                            <input type="number" name="saturasi_oksigen" class="form-control" placeholder="98">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Berat Badan (kg)</label>
                            <input type="number" name="berat_badan" step="0.1" class="form-control" placeholder="60">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tinggi Badan (cm)</label>
                            <input type="number" name="tinggi_badan" class="form-control" placeholder="170">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Gula Darah Sewaktu</label>
                            <input type="number" name="gula_darah_sewaktu" class="form-control" placeholder="100">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kesadaran</label>
                            <select name="kesadaran" class="form-select">
                                <option value="composmentis">Compos Mentis</option>
                                <option value="somnolent">Somnolent</option>
                                <option value="sopor">Sopor</option>
                                <option value="coma">Coma</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Catatan</label>
                            <input type="text" name="catatan" class="form-control" placeholder="Catatan tambahan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-primary">
                        <i class="fas fa-save me-1"></i> Simpan Vital Sign
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<style>
.btn-action-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.btn-action-success:hover { background: #10b981; color: white; }
</style>
@endsection
