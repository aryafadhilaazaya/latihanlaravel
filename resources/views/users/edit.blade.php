<x-app title="Edit User - Laravel">
    <div class="content">
        <x-card title="Edit User" subtitle="">
            <form action="/users/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            @if ($message === 'The name field is required.')
                                Nama wajib diisi.
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            @if ($message === 'The email field is required.')
                                Email wajib diisi.
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah Password!">
                </div>
                <div class="mb-4">
                    <label for="current_password" class="form-label">Konfirmasi perubahan (Password Saat Ini)</label>
                    <input type="password" name="current_password" id="current_password" class="form-control  @error('current_password') is-invalid @enderror" placeholder="Masukkan password saat ini">
                    @error('current_password')
                        <div class="invalid-feedback">
                            @if ($message === 'The current_password field is required.')
                                Password saat ini wajib diisi.
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
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