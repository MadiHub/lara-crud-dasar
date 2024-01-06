<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// config controller
use App\Models\ModelKomik;
use Illuminate\Http\Request;
// end //

class Home extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $ModelKomik;

    public function __construct(ModelKomik $ModelKomik)
    {
        $this->ModelKomik = $ModelKomik;
    }

    public function index () {
        $allKomik = $this->ModelKomik->getAllKomik();
        $data = [
            'judul' => 'Home Komik',
            'allKomik' => $allKomik
        ];
        return view('index', $data);
    }

    public function tambah_komik () {
        $data = [
            'judul' => 'Tambah Komik',
        ];
        return view('tambah_komik', $data);
    }

    public function detail_komik ($id_komik) {
        $getKomikById = $this->ModelKomik->getKomikById($id_komik);
        $data = [
            'judul' => 'Detail Komik',
            'getKomik' => $getKomikById,
        ];
        return view('detail_komik', $data);
    }

    public function update_komik ($id_komik) {
        $getKomikById = $this->ModelKomik->getKomikById($id_komik);
        // dd($getKomikById);
        $data = [
            'judul' => 'Update Komik',
            'getKomik' => $getKomikById,
        ];
        return view('update_komik', $data);
    }

    public function proses_tambah_komik (Request $request) {
        $validated = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'foto' => 'required',
        ]);

        $judul = $request->input('judul');
        $penulis = $request->input('penulis');
        $foto = $request->file('foto');

        $direktoriFoto = 'img';
        $fileName = $judul . '-' . time() . '.png';

        $foto->move($direktoriFoto,$fileName);
        $data = [
            'judul' => $judul,
            'penulis' => $penulis,
            'foto' => $fileName,
        ];

        // Hapus nilai form
        $request->replace([
            'judul' => null,
            'penulis' => null,
        ]);

        $this->ModelKomik->addKomik($data);
        $request->session()->flash('success', 'Data berhasil ditambah !');
        return back()->withInput();
    }

    public function proses_update_komik(Request $request)
    {
        $id_komik = $request->input('id_komik');
        $judul = $request->input('judul');
        $penulis = $request->input('penulis');
        $foto = $request->file('foto');
    
        $direktoriFoto = 'img';
    
        $getKomikById = $this->ModelKomik->getKomikById($id_komik);
        $foto_lama = $getKomikById->foto;
    
        // Hapus foto lama jika ada foto baru
        if ($foto != null && $foto_lama && $foto_lama !== 'profile_kosong.jpg' && file_exists($direktoriFoto . '/' . $foto_lama)) {
            unlink($direktoriFoto . '/' . $foto_lama);
        }
    
        // Pindahkan file foto baru jika diunggah
        $fileName = null;
        if ($foto != null) {
            $fileName = $judul . '-' . time() . '.png';
            $foto->move($direktoriFoto, $fileName);
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $fileName = $foto_lama;
        }
    
        // Update data komik
        $data = [
            'judul' => $judul,
            'penulis' => $penulis,
            'foto' => $fileName,
        ];
    
        $this->ModelKomik->updateKomik($id_komik, $data);
    
        $request->session()->flash('success', 'Data berhasil diubah !');
        return back()->withInput();
    }
    
    public function proses_delete_komik ($id_komik) {
        $getKomikById = $this->ModelKomik->getKomikById($id_komik);

        //  hapus foto lama dahulu            
        $foto_lama = $getKomikById->foto;
        $direktoriFoto = 'img';
        if ($foto_lama && $foto_lama !== 'profile_kosong.jpg' && file_exists($direktoriFoto . '/' . $foto_lama)) {
            unlink($direktoriFoto . '/' . $foto_lama);
        }
        // end foto lama

        if (isset($getKomikById)) {
            $this->ModelKomik->deleteKomik($id_komik);
            session()->flash('success', 'Data berhasil dihapus !');

            return back()->withInput();
        } else {
           session()->flash('success', 'Data gagal dihapus !');

            return back()->withInput();
        }
    }
}
