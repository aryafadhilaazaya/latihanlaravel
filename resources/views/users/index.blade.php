<x-app title="Users - Laravel">
    <div class="content">
        <x-card title="Daftar Nama Pegawai" subtitle="Periode 2025-2026">
            <div style="position: absolute; right: 16px; top: 20px;">
                <a href="/users/create" class="btn btn-primary mb-3">+ Tambahkan User</a>
            </div>
            <table class="table table-bordered table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 45%;">Nama</th>
                        <th style="width: 30%;">Email</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-truncate" style="max-width: 200px; text-align: left;">{{ $user->name }}</td>
                        <td class="text-truncate" style="max-width: 250px; text-align: left;">{{ $user->email }}</td>
                        <td>
                            <a href="/users/{{ $user->id }}" class="btn btn-primary btn-sm">Detail</a>
                            <a href="/users/{{ $user->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </x-card>
    </div>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Artikel akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app>