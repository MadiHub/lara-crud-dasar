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
                <form method="POST" action="/proses_update_komik" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_komik" name="id_komik" value="{{$getKomik->id_komik}}" class="mt-1 p-2 w-full border rounded-md">
                    <div class="mt-3">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" id="judul" name="judul" value="{{$getKomik->judul}}" class="mt-1 p-2 w-full border rounded-md">

                        <label for="penulis" class="block mt-4 text-sm font-medium text-gray-700">Penulis</label>
                        <input type="text" id="penulis" name="penulis" value="{{$getKomik->penulis}}" class="mt-1 p-2 w-full border rounded-md">
                        <div class="cover relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                        <label for="file-upload" class="cursor-pointer">                            <div id="drop-area" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center" >
                                    <img id="preview-image" src="{{ asset('img/' . $getKomik->foto) }}" width="200" alt="">
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="foto" type="file" class="sr-only" onchange="previewImage()"  value="{{ old('foto') }}">
                                            <!-- input file hidden untuk update -->
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                    @error('penulis')
                                                <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="mt-4 px-4 py-2 w-full bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:border-indigo-300">
                            Update
                        </button>
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