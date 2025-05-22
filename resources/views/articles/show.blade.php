<x-app title="Detail Artikel">
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <h2>{{ $article->title }}</h2>
                <div class="text-muted">
                    {{ \Carbon\Carbon::parse($article->created_at)->format('d F, Y') }}
                </div>
                <hr>
                    {{ $article->body }}
            </div>
        </div>
        <div class="mt-5">
            <a href="/articles" class="btn btn-success">Kembali</a>
        </div>
    </div>
</x-app>