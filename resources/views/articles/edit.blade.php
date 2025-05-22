<x-app title="Edit Artikel - Laravel">
    <div class="content">
        <x-card title="Edit Artikel" subtitle="">
            <form action="/articles/{{ $article->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label">Isi</label>
                    <textarea name="body" id="body" class="form-control" rows="5" required>{{ $article->body }}</textarea>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-success w-10">Simpan</button>
                    <a href="/articles" class="btn btn-danger w-10">Kembali</a>
                </div>
            </form>
        </x-card>
    </div>
</x-app>