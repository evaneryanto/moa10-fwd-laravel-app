<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;



class MasterMemberController extends Controller
{
    public function tampil_master_member(){
        return view('admin.master_anggota');
    }

    public function fetchAllMember(){
       $member=  User::where("tipe",1)->get();
       $output = '';
       
  
       if ($member->count() > 0) 
       {
        $output .= '<table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
       foreach ($member as $m) {
           $output .= '<tr>
            <td>' . $m->name . '</td>
             <td>' . $m->email .  '</td>
             <td>' . $m->username. '</td>
             <td>
                <a href="#" id="' . $m->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi-pencil-square h4"></i></a>
                <a href="#" id="' . $m->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
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

    public function store_member(Request $request){
 
        $memberData = [
            'name' => $request->name, 
            'email' =>$request->email, 
            'username' => $request->username, 
            
        ];
        Buku::create($memberData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit_member(Request $request){
        $id = $request->id;
        $member= User::find($id);
        return response()->json($member);
    }

    public function update_member(Request $request) {
       
        $member = User::find($request->kode);
        $memberData = [
            'name' => $request->name, 
        ];
       
        $buku->update($memberData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete_member(Request $request) {
        $id = $request->id;
        $member = User::find($id);
        $member::Destroy($id);
    }
}
