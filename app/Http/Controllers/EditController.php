<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\real;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

use Yajra\DataTables\Facades\DataTables;
use function Laravel\Prompts\select;

class EditController extends Controller
{
 
    public function showEdit(Request $request)
    {
       // dd($request->all());
        return view('modal');
    }
    public function editp(Request $request){
       // $user = Auth::user();
       $user = auth()->user();

       // Lakukan validasi data yang dikirimkan melalui $request jika diperlukan
       $request->validate([
           'current_password' => 'required',
           'password' => 'required|min:4|confirmed',
           'password_confirmation' => 'required|same:password',
       ]);
// SHA1
if (sha1($request->current_password) === $user->Password) {
    // Pastikan password baru dan konfirmasi cocok
    if ($request->password === $request->password_confirmation) {
        // Melakukan update password langsung ke database
        DB::table('ts_karyawan_sk')
            ->where('nama_kary', $user->nama_kary)
            ->update(['Password' => sha1($request->password)]);

        // Redirect dengan pesan sukses
       
    return response()->json(['message' => 'Password berhasil diubah.']);
    } else {
        // Redirect dengan pesan kesalahan konfirmasi password
        return response()->json(['message' => 'Konfirmasi password tidak cocok.']);
    }
} else {
    // Redirect dengan pesan kesalahan kata sandi saat ini
    return response()->json(['message' => 'Password lama salah.'],400);
}
//    hash
       // Pastikan kata sandi saat ini sesuai
    //    if (Hash::check($request->current_password, $user->Password)) {
    //        // Pastikan password baru dan konfirmasi cocok
    //        if ($request->password === $request->password_confirmation) {
    //            // Melakukan update password langsung ke database
    //            DB::table('ts_karyawan_sk')
    //                ->where('nama_kary', $user->nama_kary)
    //                ->update(['Password' => Hash::make($request->password)]);
   
    //            // Redirect dengan pesan sukses
    //            return response()->json(['message' => 'Password berhasil diubah.']);
    //        } else {
    //            // Redirect dengan pesan kesalahan konfirmasi password
    //            return response()->json(['message' => 'Konfirmasi password tidak cocok.']);
    //        }
    //    } else {
    //        // Redirect dengan pesan kesalahan kata sandi saat ini
    //        return response()->json(['message' => 'Kata sandi saat ini salah.'], 422);
    //    }
    }

   
public function modal(Request $request){
    //$idJobSPKk = $request->input('Id_Job_SPK');
    $currentUserNamaKary = Auth::user()->nama_kary;
   
    $data = Post::join('td_joborder', 'td_wp_spk.Id_Job', '=', 'td_joborder.Id_Job')
    ->join('td_project', 'td_joborder.Id_Reg', '=', 'td_project.Id_Reg')
    ->join('ts_kapal', 'td_project.IdVessel', '=', 'ts_kapal.IdVessel')
    ->join('ts_karyawan_sk', 'td_wp_spk.Kode_Pelksn', '=', 'ts_karyawan_sk.nama_kary')
    ->where('ts_karyawan_sk.nama_kary', $currentUserNamaKary)
    ->select(
        'td_wp_spk.NoSPK',
        'td_wp_spk.Id_Job_SPK',
        'td_wp_spk.NoWBS',
        'td_project.Kode_Proyek',
        'ts_kapal.Nama Kapal'
    )
    ->get();


   return view('modal',compact('data'));
}

// public function up($Id_Job_SPK){
// $category = real::find($Id_Job_SPK);
// return response()->json(['data'=>$category]);
// }

public function tambahDataReal(Request $request, $Id_Job_SPK)
{
    // Validasi data yang diterima dari formulir
    $validatedData = $request->validate([
        'Kode' => 'required',
        'realisasi_WP' => 'required',
        'volume_Task' => 'required',
        'Satuan'=>'required',
       'Ttl_Price'=>'required',
        'UnitPrice'=>'required',
        // Tambahkan validasi untuk kolom lainnya sesuai kebutuhan
    ]);
    
  // Hitung Ttl_Price berdasarkan volume_Task dan Satuan
    $Ttl_Price = $validatedData['volume_Task'] * 3000;
   // $idJobSPKk = $request->session()->get('Id_Job_SPK');
    // Ambil Id_Job_SPK dari td_wp_spk
   $idJobSPK = DB::table('td_wp_spk')->where('Id_Job_SPK', $Id_Job_SPK)->value('Id_Job_SPK');
    DB::table('td_wp_bkl_real')->insert([
        'Id_Job_SPK' => $idJobSPK,
        'Kode' => $validatedData['Kode'],
        'realisasi_WP' => $validatedData['realisasi_WP'],
        'volume_Task' => $validatedData['volume_Task'],
        'Satuan'=>$validatedData['Satuan'],
        'Ttl_Price'=>$Ttl_Price,
        'UnitPrice'=>3000,
        'tgl_update'  => DB::raw('NOW()'),
        'status' => 0,
        'status_M'=>0,// Tambahkan nilai status sesuai kebutuhan
        // Tambahkan data untuk kolom-kolom lainnya sesuai kebutuhan
    ]); 
   // return response()->json(['success'=>true]);

  //return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
  
    //return response()->json(['result'=>$dataa]);
   // return response()->json(['success' => 'Konfirmasi password tidak cocok.']);
  
 //return back()->with('success', 'Data berhasil ditambahkan ');
}
public function edit($Id_Job_SPK)
{
    $data = Post::find($Id_Job_SPK); // Mengambil data berdasarkan ID
    return view('update', compact('data'));

}
public function update(Request $request,Post $id)
{
    $request->validate([
        'nama' => 'required',
      
    ]);

    $id->update($request->all());

    return redirect()->route('posts.index')
                    ->with('success','Post updated successfully');


}
// public function tes(){
//     $data = DB::table('data2')
//     ->join('data1', 'data2.kode', '=', 'data1.id')
//     ->select('data2.kode', 'data2.matkul')
//     //->select('kode','matkul')
//     ->get();
//     return view('data1',compact('data'));
// }
// public function tes2(){
// return view('data2');
// //     $data2 = DB::table('data1')
// //     ->join('data2', 'data1.kode', '=', 'data2.kode')
// //     ->select('data1.nama', 'data2.kode')
// //     ->where('data2.kode',$kode)
// //     ->get();
    
// // return view('data2', compact('data2'));
// }public function view($Id_Job_SPK)
// {
//     // Ambil data dari tabel 'td_wp_spk' berdasarkan $idJobSPK
//     $data = Post::find($Id_Job_SPK); // Mengambil data berdasarkan ID
   

//     return view('modal', compact('data'));
// }

// public function getTdWpBklReal($Id_Job_SPK)
// {
//     // Bergabung dengan tabel 'td_wp_bkl_real' hanya saat diperlukan
//     $data = DB::table('td_wp_spk')
//         ->join('td_wp_bkl_real', 'td_wp_spk.Id_Job_SPK', '=', 'td_wp_bkl_real.Id_Job_SPK')
//         ->where('td_wp_spk.Id_Job_SPK', $Id_Job_SPK)
//         ->select('td_wp_spk.NoSPK', 'td_wp_spk.Id_Job_SPK', 'td_wp_spk.NoWBS',
//                  'td_wp_bkl_real.Kode', 'td_wp_bkl_real.realisasi_WP',
//                  'td_wp_bkl_real.UnitPrice', 'td_wp_bkl_real.volume_Task',
//                  'td_wp_bkl_real.Satuan', 'td_wp_bkl_real.Ttl_Price')
//         ->get();

//     return view('edit', compact('data'));
// }


}