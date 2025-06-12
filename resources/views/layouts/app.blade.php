<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{ asset('AvatarAI.jpg') }}">
  <title>{{ $title }}</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .content {
      padding: 15px 35px;
    }

    .navbar {
      background: linear-gradient(to right, #f5deb3, lightblue);
    }

    .nav-item:hover {
      background-color: rgb(223, 160, 44);
      transition: all 0.3s ease;
      border-radius: 5px;
    }

    .card {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .animate-home {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.5s ease-out forwards;
    }

    @keyframes fadeInUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <x-navigation/>
  <div class="animate-home">
    {{ $slot }}
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  @if (session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
      });
    </script>
  @elseif (session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false
      });
    </script>
  @endif
  <script>
        <?php if ($errors->any()): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '{!! implode("<br>", $errors->all()) !!}',
                timer: 5000,
                showConfirmButton: true
            });
        <?php endif; ?>
    </script>
</body>
</html>