@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <h4 class="mb-4 fw-bold">Manajemen User</h4>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $user->role }}
                                    </span>
                                </td>

                                <td>
                                    @if ($user->status == 'banned')
                                        <span class="badge bg-danger">Banned</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Tidak ada data user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
