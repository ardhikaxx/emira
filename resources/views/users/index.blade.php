@extends('layouts.master')
@section('title', 'Manajemen User - EMIRA')
@section('page_title', 'Manajemen User')
@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <div class="header-title">
            <div class="header-icon-sm gradient-purple">
                <i class="fas fa-user-cog"></i>
            </div>
            <div>
                <h5 class="card-title">Data User</h5>
                <small class="text-muted">Total {{ $users->total() }} user</small>
            </div>
        </div>
        <a href="{{ route('users.create') }}" class="btn-custom btn-custom-primary">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>
    <div class="card-body-custom">
        @if($users->count() > 0)
        <div class="table-responsive-custom">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm avatar-gradient-{{ $user->role?->name == 'superadmin' ? 'red' : ($user->role?->name == 'dokter' ? 'teal' : 'purple') }}">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="fw-semibold">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role?->name == 'superadmin')
                                <span class="badge-custom badge-red"><i class="fas fa-crown me-1"></i>{{ $user->role?->display_name }}</span>
                            @elseif($user->role?->name == 'dokter')
                                <span class="badge-custom badge-teal"><i class="fas fa-user-md me-1"></i>{{ $user->role?->display_name }}</span>
                            @elseif($user->role?->name == 'perawat')
                                <span class="badge-custom badge-green"><i class="fas fa-user-nurse me-1"></i>{{ $user->role?->display_name }}</span>
                            @else
                                <span class="badge-custom badge-purple">{{ $user->role?->display_name }}</span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_active)
                                <span class="badge-custom badge-active"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge-custom badge-inactive"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-action-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if(!$user->isSuperAdmin())
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
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
                Menampilkan <strong>{{ $users->firstItem() }}</strong> - <strong>{{ $users->lastItem() }}</strong> dari <strong>{{ $users->total() }}</strong> data
            </div>
            <div class="pagination-container">
                {{ $users->links() }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-users"></i></div>
            <h6>Tidak Ada User</h6>
            <p>Belum ada data user.</p>
            <a href="{{ route('users.create') }}" class="btn-custom btn-custom-primary mt-2">
                <i class="fas fa-plus me-1"></i> Tambah User
            </a>
        </div>
        @endif
    </div>
</div>

<style>
.badge-teal { background: rgba(8, 193, 149, 0.1); color: #08C195; }
.badge-red { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
</style>
@endsection
