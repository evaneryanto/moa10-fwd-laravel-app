<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class HomeMemberController extends Controller
{
    public function index(){
        return view('member.home');
    }
}
