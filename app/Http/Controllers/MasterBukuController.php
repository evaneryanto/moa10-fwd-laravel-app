<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class MasterBukuController extends Controller
{
    public function tampil_master_buku(){
        return view('admin.master_buku');
    }

    public function fetchAll(){
       $buku =  Buku::all();
       $output = '';
       
    //    if($buku->count() == 0)
    //    {
    //         //dd("kosong");

    //         echo "kosong";
    //    }
    //    else
    //    {
    //         //dd("isi");
    //         echo "isi";
    //    }

       if ($buku->count() > 0) 
       {
        $output .= '<table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Foto Buku</th>
            <th>ISBN</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tanggal terbit</th>
            <th>Penerbit</th>
            <th>Klasifikasi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
       foreach ($buku as $b) {
           $output .= '<tr>
           <td>' . $b->id . '</td>
           <td><img src="storage/images/' . $b->foto_buku . '" width="100" height = "100" class=""></td> 
            <td>' . $b->kode_buku . '</td>
             <td>' . $b->judul .  '</td>
             <td>' . $b->pengarang. '</td>
             <td>' . $b->tanggal_terbit .  '</td>
             <td>' . $b->penerbit . '</td>
             <td>' . $b->klasifikasi.  '</td>
             <td>
                <a href="#" id="' . $b->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi-pencil-square h4"></i></a>
                <a href="#" id="' . $b->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
            </td>
           </tr>';
         }
        $output .= '</tbody></table>';
        echo $output;
    } 
    else 
        {
            echo '<h1 class="text-center text-secondary my-5">No record in the database!</h1>';
            //echo "Masuk" ;
        }
    }

    public function store(Request $request){

        $file = $request->file('foto_buku');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName); //php artisan storage:link
 
        $bukuData = [
            'kode_buku' => $request->kode_buku, 
            'judul' => $request->judul, 
            'pengarang' => $request->pengarang, 
            'tanggal_terbit' =>$request->tanggal_terbit,
            'penerbit' => $request->penerbit,
            'klasifikasi'=>$request->klasifikasi,
            'foto_buku' => $fileName
        ];
        Buku::create($bukuData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit(Request $request){
        $id = $request->id;
        $book = Buku::find($id);
        return response()->json($book);
    }

    public function update(Request $request) {
        $fileName = '';
        $buku = Buku::find($request->kode);
        $file = $request->file('foto_buku');
    
        if($request->hasFile('foto_buku')) {
            $file = $request->file('foto_buku');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if($buku->foto_buku) {
                Storage::delete('public/images/' . $buku->foto_buku);
              
            }
        } else {
            $fileName = $request->avatar;
        
        }

        $bukuData = [
            'kode_buku' => $request->kode_buku, 
            'judul' => $request->judul, 
            'pengarang' => $request->pengarang, 
            'tanggal_terbit' =>$request->tanggal_terbit,
            'penerbit' => $request->penerbit,
            'klasifikasi'=>$request->klasifikasi,
            'foto_buku' => $fileName,
        ];
 
       
        $buku->update($bukuData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
        $id = $request->id;
        $book = Buku::find($id);
        if (Storage::delete('public/images/' . $book->foto_buku)) {
            Buku::destroy($id);
        }
    }
}
