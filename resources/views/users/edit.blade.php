<x-app title="Edit User - Laravel">
    <div class="content">
        <x-card title="Edit User" subtitle="">
            <form action="/users/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah Password!">
                </div>
                <div class="mb-4">
                    <label for="current_password" class="form-label">Konfirmasi perubahan (Password Saat Ini)</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Masukkan password saat ini" required>
                    <small class="text-muted"><a style="color: red;">*</a> Wajib diisi untuk menyimpan perubahan.</small>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-success w-10">Simpan</button>
                    <a href="/users" class="btn btn-danger w-10">Kembali</a>
                </div>
            </form>
        </x-card>
    </div>
</x-app>