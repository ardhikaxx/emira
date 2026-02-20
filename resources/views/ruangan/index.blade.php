@extends('layouts.master')
@section('title', 'Data Ruangan - EMIRA')
@section('page_title', 'Kelola Ruangan')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-blue">
                <i class="fas fa-bed"></i>
            </div>
            <div>
                <h5 class="card-title">Data Ruangan</h5>
                <small class="text-muted">Kelola ruangan rumah sakit</small>
            </div>
        </div>
        <a href="{{ route('ruangan.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah Ruangan
        </a>
    </div>
    <div class="card-body-custom">
        @if($ruangans->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Ruangan</th>
                        <th>Jenis</th>
                        <th>Kapasitas</th>
                        <th>Lantai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ruangans as $ruangan)
                    <tr>
                        <td><code>{{ $ruangan->kode_ruangan }}</code></td>
                        <td class="fw-semibold">{{ $ruangan->nama_ruangan }}</td>
                        <td>
                            @switch($ruangan->jenis)
                                @case('rawat_inap')<span class="badge-custom badge-blue">Rawat Inap</span>@break
                                @case('icu')<span class="badge-custom badge-red">ICU</span>@break
                                @case('ugd')<span class="badge-custom badge-orange">UGD</span>@break
                                @case('isolasi')<span class="badge-custom badge-purple">Isolasi</span>@break
                                @case('vip')<span class="badge-custom badge-green">VIP</span>@break
                            @endswitch
                        </td>
                        <td>{{ $ruangan->kapasitas }} TT</td>
                        <td>{{ $ruangan->lantai }}</td>
                        <td>
                            @if($ruangan->is_active)
                                <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus ruangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-action-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan <strong>{{ $ruangans->firstItem() }}</strong> - <strong>{{ $ruangans->lastItem() }}</strong> dari <strong>{{ $ruangans->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $ruangans->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-bed"></i></div>
            <h6>Tidak Ada Ruangan</h6>
            <p>Belum ada data ruangan.</p>
            <a href="{{ route('ruangan.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah Ruangan
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
