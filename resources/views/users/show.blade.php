<x-app title="Detail User">
    <div class="content">
        <x-card title="Detail User" subtitle="">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>: Hidden for Security</td>
                        </tr>
                        <tr>
                            <th>Dibuat pada</th>
                            <td>: {{ \Carbon\Carbon::parse($user->created_at)->format('d F, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diedit pada</th>
                            <td>: {{ $user->updated_at ? \Carbon\Carbon::parse($user->updated_at)->format('d F, Y H:i') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <a href="/users" class="btn btn-success w-25">Kembali</a>
            </div>
        </x-card>
    </div>
</x-app>