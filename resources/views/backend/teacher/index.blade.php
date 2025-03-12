@extends('backend.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-3 text-black">Data Guru</h3>
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <a href="{{ route('teacher.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Add Teacher
            </a>

            <!-- Form Pencarian -->
            <form action="{{ route('teacher') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari guru..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    @if(request('search'))
                <a href="{{ route('user') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $index => $data)
                        <tr>
                            <td>{{ $teachers->firstItem() + $index }}</td>
                            <td class="text-start">{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td class="text-start">{{ $data->address }}</td>
                            <td>
                                @if($data->gender == 'L')
                                    <span class="badge bg-info">Laki-laki</span>
                                @else
                                    <span class="badge bg-warning">Perempuan</span>
                                @endif
                            </td>
                            <td>
                                @if($data->status == 'Aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if($data->photo)
                                    <img src="{{ asset('backend/images/' . $data->photo) }}" alt="Foto Guru" width="50">
                                @else
                                    <span class="badge bg-secondary">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('teacher.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('teacher.destroy', $data->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                <div class="alert alert-warning mt-3">
                                    Tidak ada data guru yang tersedia.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                 <!-- Paginasi -->
                 <div class="d-flex justify-content-center flex-wrap w-100 mt-3">
    <nav>
        <ul class="pagination">
            <!-- Tombol Previous -->
            @if ($teachers->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $teachers->previousPageUrl() }}">Previous</a>
                </li>
            @endif

            <!-- Info Halaman -->
            <li class="page-item disabled">
                <span class="page-link text-muted">Page {{ $teachers->currentPage() }} dari {{ $teachers->lastPage() }}</span>
            </li>

            <!-- Tombol Next -->
            @if ($teachers->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $teachers->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>

        
            </div>
        </div>
    </div>
</div>
@endsection
