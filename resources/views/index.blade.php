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
    <a href="{{url('tambah_komik')}}"  class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3  font-medium text-white hover:bg-indigo-700">Tambah Komik</a>

    </div>
        <div class="mt-8 max-w-2xl mx-auto bg-white rounded-md shadow-md">
            <table class="table-auto w-full border">
                <thead>
                <tr>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Penulis</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($allKomik as $k) 
                    <tr class="border-b even:bg-gray-100">
                        <td class="border px-4 py-2">{{$k->judul}}</td>
                        <td class="border px-4 py-2">{{$k->penulis}}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ url('detail_komik/'.$k->id_komik) }}" class=" border border-transparent bg-indigo-600 px-5 py-3 text-center font-medium text-white hover:bg-indigo-700 inline-block rounded-md ">Detail</a>
                            <a href="{{ url('update_komik/'.$k->id_komik) }}" class=" border border-transparent bg-green-600 px-5 py-3 text-center font-medium text-white hover:bg-green-700 inline-block rounded-md ">Update</a>
                            <button type="button" class="border border-transparent bg-red-600 px-5 py-3 text-center font-medium text-white hover:bg-red-700 inline-block rounded-md"  onclick="deleteKomik('{{$k->id_komik}}')">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- sweet allert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- delete komik sweet alert -->
<script>
 function deleteKomik(id_komik) {
    Swal.fire({
        title: "Apa anda yakin?",
        text: "Data Komik dengan id : " + id_komik + " akan terhapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal" 
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `proses_delete_komik/${id_komik}`;
        }
    });
}
</script>

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
</body>
</html>