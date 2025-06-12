<x-app title="Artikel - Laravel">
    <div class="content">
        <h1 style="position: fixed;">Artikel</h1>
        <div class="text-end">
            <a href="/articles/create" class="btn btn-primary mb-3">+ Artikel Baru</a>
        </div>
        <div class="row mt-2">
            @forelse ($articles as $article)
            <div class="mb-2">
                <x-card title="{{ $article->title }}" subtitle="Dibuat: {{ \Carbon\Carbon::parse($article->created_at)->format('d F, Y') }} | 
                    Diperbarui: {{ $article->updated_at ? \Carbon\Carbon::parse($article->updated_at)->format('d F, Y') : '-' }}">
                    {{ $article->body }}
                    <div class="buttons d-flex mt-2 gap-2">
                        <a style="font-size: 14px;" href="/articles/{{ $article->id }}" class="btn btn-primary">Read more</a>
                        <a style="font-size: 14px;" href="/articles/{{ $article->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="delete-form" style="display: block; margin-left: auto;">
                            @csrf
                            @method('DELETE')
                            <button type="button" style="font-size: 14px;" class="btn btn-danger delete-button">Delete</button>
                        </form>
                    </div>
                </x-card>
            </div>
            @empty
            <div class="alert alert-info">Tidak ada data</div>
            @endforelse
        </div>
    </div>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(e) {
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