<x-app title="Buat User Baru - Laravel">
    <div class="content">
        <x-card title="Buat User Baru" subtitle="">
            <form action="/users" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
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
                    <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            @if ($message === 'The password field is required.')
                                Password wajib diisi.
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="submit" class="btn btn-success w-10">Simpan</button>
                    <a href="/users" class="btn btn-danger w-10">Kembali</a>
                </div>
            </form>
        </x-card>
    </div>
</x-app>