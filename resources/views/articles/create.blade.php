<x-app title="Buat Artikel - Laravel">
    <div class="content">
        <x-card title="Buat Artikel Baru" subtitle="">
            <form action="/articles" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label">Isi</label>
                    <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-success w-10">Simpan</button>
                    <a href="/articles" class="btn btn-danger w-10">Kembali</a>
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