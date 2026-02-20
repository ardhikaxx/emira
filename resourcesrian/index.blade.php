@extends('layouts.master')
@section('title', 'Antrian - EMIRA')
@section('page_title', 'Kelola Antrian')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Daftar Antrian Hari Ini</h5>
        <a href="{{ route('antrian.create') }}" class="btn btn-emira"><i class="fas fa-plus me-1"></i> Daftar Antrian</a>
    </div>
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="poli_id" class="form-select">
                        <option value="">Semua Poli</option>
                        @foreach($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>Pasien</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antrians as $antrian)
                    <tr>
                        <td><strong>{{ $antrian->no_urut }}</strong></td>
                        <td>{{ $antrian->pasien->nama_lengkap }}</td>
                        <td>{{ $antrian->poli->nama_poli }}</td>
                        <td>{{ $antrian->dokter->nama_lengkap }}</td>
                        <td>
                            @if($antrian->status == 'menunggu')<span class="badge bg-warning">Menunggu</span>
                            @elseif($antrian->status == 'dipanggil')<span class="badge bg-info">Dipanggil</span>
                            @elseif($antrian->status == 'dalam_pelayanan')<span class="badge bg-primary">Dilayani</span>
                            @elseif($antrian->status == 'selesai')<span class="badge bg-success">Selesai</span>
                            @else<span class="badge bg-secondary">{{ $antrian->status }}</span>@endif
                        </td>
                        <td>
                            @if($antrian->status == 'menunggu')
                            <form action="{{ route('antrian.panggil', $antrian->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-info"><i class="fas fa-bell"></i> Panggil</button>
                            </form>
                            @endif
                            @if($antrian->status == 'dipanggil' || $antrian->status == 'dalam_pelayanan')
                            <form action="{{ route('antrian.selesai', $antrian->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Selesai</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Tidak ada antrian hari ini</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
