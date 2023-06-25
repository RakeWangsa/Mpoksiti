<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ManagementUserController;
use App\Models\Menu;
use App\Models\Publikasi;
use App\Models\Trader;
use App\Models\tbRTrader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\activity_log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{

    //Method Untuk Pemanggilan Halaman Management User
    public function manage()
    {
        // $user = Session::get('role');
        // dd($user);
        $manages = new ManagementUserController();
        return view('admin.manage', [
            "title" => "Management",
            "traders" => $manages->all(),
        ]);
    }

    public function searchUser(Request $request)
    {
        $manages = Trader::all();
        if ($request->keyword != '') {
            $manages = Trader::where('npwp', 'LIKE', '%' . $request->keyword . '%')->orWhere('nm_trader', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return response()->json([
            'traders' => $manages,
        ]);
    }

    public function tambahUser()
    {
        return view('admin.addUser', [
            "title" => "Tambah User",
        ]);
    }

    public function checkNpwp(Request $request)
    {
        $npwp = $request->get('npwp');
        if (isset($npwp)) {
            $result = $this->getIDandNameTrader($npwp);

            if (isset($result)) {
                echo 'unique';
            } else {
                echo 'not_unique';
            }
        }
    }

    private function getIDandNameTrader($npwp)
    {
        $checkNPWP = tbRTrader::where('npwp', $npwp)->get(['id_trader', 'nm_trader'])->first();
        return $checkNPWP ?? null;
    }

    public function storeUser(Request $request)
    {
    
        $this->validate($request, [
            'npwp' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'npwp.required' => 'NPWP is Required',
            'no_hp.required' => 'Nomor Handphone is Required',
            'email.required' => 'Email is Required',
            'password.required' => 'Password is Required',
        ]);

        $npwp = $request->input('npwp');
        $result = $this->getIDandNameTrader($npwp);
        if (!isset($result)) {
            return redirect('/admin/manage')->with('error', 'NPWP Tidak Ada');
        } else {
            Trader::insert([
                'id_trader' => $result['id_trader'],
                'nm_trader' => $result['nm_trader'],
                'npwp' => $request->npwp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/admin/manage')->with('success', 'New user has been added');
        }
    }

    public function editUser($id_trader)
    {
        $edit = Trader::where('id_trader', $id_trader)->get();
        return view('admin.editUser', [
            "title" => "Edit User",
            "edit" => $edit,
            "id_trader" => $id_trader,
        ]);
    }

    public function updateUser(Request $request, $id_trader)
    {
        $this->validate($request, [
            'nm_trader' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ], [
            'nm_trader.required' => 'Nama User is Required',
            'no_hp.required' => 'Nomor Handphone is Required',
            'email.required' => 'Email is Required',
        ]);

        if (isset($request->password)) {
            Trader::where('id_trader', $id_trader)->update([
                'nm_trader' => $request->nm_trader,
                'npwp' => $request->npwp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/admin/manage')->with('success', 'User has been Edited');
        } else {
            Trader::where('id_trader', $id_trader)->update([
                'nm_trader' => $request->nm_trader,
                'npwp' => $request->npwp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
            ]);

            return redirect('/admin/manage')->with('success', 'User has been Edited');
        }

    }

    public function deleteUser($id_trader)
    {
        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
         activity_log::insert([
            'description' => 'admin menghapus trader dengan id '.$id_trader,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
            ]);
        Trader::where('id_trader', $id_trader)->delete();
        return redirect('/admin/manage')->with('error', 'User has been removed');
    }

    //Method Untuk Pemanggilan Halaman Menu
    public function allMenu()
    {
        return view('admin.menu', [
            "title" => "Menu",
            "menus" => Menu::all(),
        ]);
    }

    public function editMenu($id_menu)
    {
        $edit_menu = Menu::where('id_menu', $id_menu)->get();
        return view('admin.editMenu', [
            "title" => "Edit Menu",
            "editMenu" => $edit_menu,
        ]);
    }

    public function updateMenu(Request $request)
    {

        $this->validate($request, [
            'nm_menu' => 'required',
            'url' => 'required',
        ], [
            'nm_menu.required' => 'Nama Menu harus diisi',
            'url.required' => 'URL harus diisi'
        ]);

        Menu::where('id_menu', $request->id_menu)->update([
            'nm_menu' => $request->nm_menu,
            'url' => $request->url,
        ]);
        return redirect('/admin/menu')->with('info', 'Menu has been changed');
    }

    //Method Untuk Pemanggilan Halaman Publikasi
    public function allGambar()
    {
        return view('admin.publikasi', [
            "title" => "Publikasi",
            "allGambar" => Publikasi::all(),
        ]);
    }

    public function tambahGambar()
    {
        return view('admin.addGambar', [
            "title" => "Tambah Gambar",
        ]);
    }

    public function storeGambar(Request $request)
    {
        $this->validate($request, [
            'nm_gambar' => 'required',
            'file_gambar' => 'required|mimes:png,jpg,jpeg',
        ], [
            'nm_gambar.required' => 'Nama Gambar harus diisi',
            'file_gambar.required' => 'File Gambar harus diisi'
        ]);

        $file_gambar = $request->file('file_gambar');

        $nama_file = $file_gambar->getClientOriginalName();

        $tujuan_upload = 'img';
        $file_gambar->move($tujuan_upload, $nama_file);

        Publikasi::create([
            'nm_gambar' => $request->nm_gambar,
            'file_gambar' => $nama_file,
        ]);

        return redirect('/admin/publikasi')->with('success', 'New Picture has been added');
    }

    public function searchGambar(Request $request)
    {
        $gambar = Publikasi::all();
        if ($request->keyword != '') {
            $gambar = Publikasi::where('nm_gambar', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return response()->json([
            'publikasi' => $gambar,
        ]);
    }

    public function deleteGambar($id_gambar)
    {
        Publikasi::where('id_gambar', $id_gambar)->delete();
        return redirect('/admin/publikasi')->with('error', 'Picture has been removed');
    }

}
