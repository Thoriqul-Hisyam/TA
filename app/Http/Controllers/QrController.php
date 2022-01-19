<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Qr;

class QrController extends Controller
{
    public function index(){
        $users = User::all();
        return view ('users.index', ['users' => $users]);
    }
    public function store(Request $request){
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();
        return back();
    }
    public function generate ($users)
    {
        $users = User::findOrFail($users);
        $qrcode = QrCode::size(400)->email($users->email);
        return view('qrcode',compact('qrcode'));
    }
}
