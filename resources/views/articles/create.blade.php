<x-app title="Buat Artikel - Laravel">
    <div class="content">
        <x-card title="Buat Artikel Baru" subtitle="">
            <form action="/articles" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            @if ($message === 'The title field is required.')
                                Judul wajib diisi.
                            @elseif (str_contains($message, 'must not be greater'))
                                Judul terlalu panjang.
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label">Isi</label>
                    <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="5">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">
                            @if ($message === 'The body field is required.')
                                Isi artikel wajib diisi.
                            @elseif (str_contains($message, 'must not be greater'))
                                Isi artikel terlalu panjang.
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-success w-10">Simpan</button>
                    <a href="/articles" class="btn btn-danger w-10">Kembali</a>
                </div>
            </form>
        </x-card>
    </div>
</x-app>

<script>
        <?php if ($errors->any()): ?>
            let pesan = `{!! implode('<br>', $errors->all()) !!}`
                .replace('The title field is required.', 'Judul wajib diisi.')
                .replace('The body field is required.', 'Isi artikel wajib diisi.')
                .replace(/The title may not be greater than (\\d+) characters\./g, 'Judul terlalu panjang.')
                .replace(/The body may not be greater than (\\d+) characters\./g, 'Isi artikel terlalu panjang.');
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: pesan,
                timer: 5000,
                showConfirmButton: true
            });
        <?php endif; ?>
    </script>