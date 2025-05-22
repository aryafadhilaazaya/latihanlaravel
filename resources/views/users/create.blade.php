<x-app title="Buat User Baru - Laravel">
    <div class="content">
        <x-card title="Buat User Baru" subtitle="">
            <form action="/users" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-success w-10">Simpan</button>
                    <a href="/users" class="btn btn-danger w-10">Kembali</a>
                </div>
            </form>
        </x-card>
    </div>
    <script>
        <?php if ($errors->any()): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    timer: 5000,
                    showConfirmButton: true
                });
            </script>
        <?php endif; ?>
    </script>
</x-app>