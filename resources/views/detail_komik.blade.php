<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$judul}}</title>
    <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-700">
<div class="container mt-20">
    <div class="row">
    <div class="btn text-center mb-3">
        <a href="{{url('/')}}"  class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3  font-medium text-white hover:bg-indigo-700">Kembali</a>
    </div>
        <div class="max-w-xl mx-auto bg-white rounded-md overflow-hidden shadow-lg mt-8">
            <div class="px-6 py-4">
                <div class="card-header font-bold text-xl mb-2 text-center">{{$judul}}</div>
                <hr>
                <div class="card-body text-gray-700 text-base">
                <form method="POST" action="/proses_tambah_komik">
                @csrf
                    <div class="mt-3">
                    <div class="flex">
                        <div class="w-1/2 p-6">
                            <h3 class="mb-4">Judul: <span class="font-bold">{{ $getKomik->judul }}</span></h3>
                            <h3 class="mb-4">Penulis: <span class="font-bold">{{ $getKomik->penulis }}</span></h3>
                        </div>
                        <div class="ml-7">
                            <img src="{{ asset('img/' . $getKomik->foto) }}" class="w-48 h-auto" alt="Deskripsi Gambar">
                        </div>
                    </div>


                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- sweet allert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  $(function() {
    @if (session()->has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}'
        });
        
    @endif
});

  </script>

  <script>
      $(function() {
          <?php if (session()->has("error")) { ?>
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: '<?= session("error") ?>'
              })
          <?php } ?>
      });
  </script>

<script>
    function previewImage() {
        var input = document.getElementById('file-upload');
        var image = document.getElementById('preview-image');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    var dropArea = document.getElementById('drop-area');

    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.classList.add('bg-gray-300');
    });

    dropArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropArea.classList.remove('bg-gray-300');
    });

    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.classList.remove('bg-gray-300');

        var files = e.dataTransfer.files;
        var input = document.getElementById('file-upload');
        input.files = files;

        previewImage();
    });
</script>
</body>
</html>