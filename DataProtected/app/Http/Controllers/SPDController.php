<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\spdcenter;

use App\Profil;

use App\Http\Requests;

use Request as reques;

use Auth;

use App\notaspd as nota;

use App\bp2a;

use App\bp1;

use App\notaspd;

use Excel;

use Carbon\Carbon;
use Illuminate\Session;

class SPDController extends Controller
{
    public function getData()
    {

    	// $user = Auth::user()->id;

          $profil = Profil::paginate(10);
        
        return view('spd.spd')->with('profil', $profil);
    }


    public function edit($id) {
        $profil = Profil::findOrFail($id);
        return view('spd.spdcenter',  compact('profil'));
    }


    public function create(Request $request) {
         $spd = new spdcenter();
        $spd->pengiriman = $request->get('pengiriman');
        $spd->no_pd = $request->get('no_pd');
    	$spd->no_st = $request->get('no_st');
    	$spd->nip = $request->get('nip');
    	$spd->nama = $request->get('nama');
    	$spd->berangkat = $request->get('berangkat');
    	$spd->tujuan = $request->get('tujuan');
    	$spd->tanggal_berangkat = $request->get('Tanggal')."-".$request->get('Bulan')."-".$request->get('Tahun');
      $spd->tanggal_pulang = $request->get('Tanggal_pulang')."-".$request->get('Bulan_pulang')."-".$request->get('Tahun_pulang');

    	$spd->kegiatan = $request->get('kegiatan');
    	$spd->keterangan = $request->get('keterangan');
    	$spd->nama_ppk = $request->get('nama_ppk');
      $spd->tanggal_pengiriman = $request->get('Tanggal_pengiriman')."-".$request->get('Bulan_pengiriman')."-".$request->get('Tahun_pengiriman');
        $spd->save();
         

         $profil = Profil::paginate(10);
        
        return view('spd.spd')->with('profil', $profil);
        // return redirect('admin/spd');
    }


    public function spdlist()
    {

    	// $user = Auth::user()->id;

        $spd = spdcenter::orderBy('created_at','desc')->paginate(10);
        
        return view('spd.listspd')->with('spd', $spd);
    }


    public function delete($id) {
        spdcenter::find($id)->delete();
        // \Session::flash('flash_message', 'Data pegawai telah dihapus');
        $spd = spdcenter::orderBy('created_at','desc')->paginate(10);
        
        return view('spd.listspd')->with('spd', $spd);
    }


    public function ubah($id) {
        $spd = spdcenter::findOrFail($id);
        return view('spd.spdupdate',  compact('spd'));
    }


    public function update($id, Request $request) 
    {
    		
        $pengiriman = reques::get('pengiriman');
        $no_pd = reques::get('no_pd');
    	$no_st = reques::get('no_st');
    	$nip = reques::get('nip');
    	$nama = reques::get('nama');
    	$berangkat = reques::get('berangkat');
    	$tujuan = reques::get('tujuan');
    	$tanggal = reques::get('Tanggal');
      $bulan = reques::get('Bulan');
      $tahun = reques::get('Tahun');

      $tanggal_pulang = reques::get('Tanggal_pulang');
      $bulan_pulang = reques::get('Bulan_pulang');
      $tahun_pulang = reques::get('Tahun_pulang');


    	$kegiatan = reques::get('kegiatan');
    	$keterangan = reques::get('keterangan');
    	$nama_ppk = reques::get('nama_ppk');
      $tanggal_pengiriman = reques::get('Tanggal_pengiriman');
      $bulan_pengiriman = reques::get('Bulan_pengiriman');
      $tahun_pengiriman = reques::get('Tahun_pengiriman');


       
		// $filename = reques::get('fileToUpload')->getClientOriginalName();


		$book = spdcenter::findOrFail($id);

		$book->pengiriman = $pengiriman;
		$book->no_pd = $no_pd;
		$book->no_st = $no_st;
		$book->nip = $nip;
		$book->nama = $nama;
		$book->berangkat = $berangkat;
		$book->tujuan = $tujuan;
		$book->tanggal_berangkat = $tanggal.'-'.$bulan.'-'.$tahun;
    $book->tanggal_pulang = $tanggal_pulang.'-'.$bulan_pulang.'-'.$tahun_pulang;
		$book->kegiatan = $kegiatan;
		$book->keterangan = $keterangan;
		$book->nama_ppk = $nama_ppk;
    $book->tanggal_pengiriman = $tanggal_pengiriman.'-'.$bulan_pengiriman.'-'.$tahun_pengiriman;
		$book->save();



		// $book->update(array(
  //           'nama'    =>  $nama,
  //           'nip' =>  $nip,
  //           'jabatan'  => $jabatan,
  //           'npwp' => $npwp
  //           'jenis_kelamin' => $jenis_kelamin,
  //           'nm_status_pegawai' => $nm_status_pegawai,
  //           'pangkat' => $pangkat,
  //           'jenis_jabatan' => $jenis_jabatan,
  //           'unit_organisasi'  => $unit_organisasi,
  //           'jabatan_grade'  => $jabatan_grade,
  //           'nama_bank'  => $nama_bank,
  //           'no_rekening'  => $no_rekening,
  //           'nama_rekening'  => $nama_rekening,
  //           'filename'  => $filename


  //       ));        
        // \Session::flash('flash_message', 'Data pegawai telah diperbarui');
        $spd = spdcenter::orderBy('created_at','desc')->paginate(10);
        
        return view('spd.listspd')->with('spd', $spd);
    }





    public function spduser()
    {

    	$user = Auth::user()->id;

          $profil = Profil::where('profil_id', $user)->firstOrFail();

          $nip = $profil->nip;

      

			$spd = spdcenter::where('nip', $nip)->orderBy('created_at','desc')->paginate(10);  

      
      // foreach ($spd as $spdc) {
      //   if($spdc==){
      //   $spdc1 = $spd->id;
      //   }
      // }
              
        
      $bp1 = bp1::where('nip', $nip)->paginate(10);
      $bp2 = bp2a::paginate(10);
      $nota = notaspd::paginate(10);

        // return view('spd.spduser')->with('spd', $spd)->with('bp1', $bp1)->with('bp2', $bp2);

      return view('spd.spduser')->with('spd', $spd)->with('bp1', $bp1)->with('bp2', $bp2)->with('nota', $nota);
    }


public function storespd(Request $request, $id) {
        // validation rules
    $uploadOk = 1;

    $target_dir = "upload/notaspd/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

            $uploadOk = 1;              
        
    }
    // Check if file already exists
    if (file_exists($target_file)) {
            
        $uploadOk = 1;
    }
    // Check file size
    // Allow certain file formats
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          // $this->import();
          \Session::flash('flash_message', 'Data telah berhasil diimport');
          } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
      $notalist = new nota();
      $notalist->nota_id = $id;
      $notalist->no_st = $request->get('no_st');
      $notalist->no_resi = $request->get('no_resi');
      $notalist->deskripsi = $request->get('deskripsi');
      $notalist->filename = basename($_FILES["fileToUpload"]["name"]);
      $notalist->tanggal_pengiriman = $request->get('Tanggal_pengiriman').'-'.$request->get('Bulan_pengiriman').'-'.$request->get('Tahun_pengiriman');
      $notalist->tanggal_st = $request->get('Tanggal_st').'-'.$request->get('Bulan_st').'-'.$request->get('Tahun_st');
      $notalist->save();
         
    
        return redirect('/spdcenter');
    }

    public function lihat($id){
        $nota_list = nota::where('nota_id', $id)->orderBy('created_at','desc')->paginate(5);
        
        return view('spd.lihatnota')->with('nota_list', $nota_list);
    }

    public function deletenota($id) {
        $nota = nota::find($id);
        $target_dir = "upload/notaspd/";
        $target_file = $target_dir . $nota->filename;
        unlink($target_file);

        nota::find($id)->delete();
        // \Session::flash('flash_message', 'Data pegawai telah dihapus');
        return Redirect('/spdcenter');
    }

    public function cari(Request $request) {

      $tanggal = $request->get('Tahun')."-".$request->get('Bulan')."-".$request->get('Tanggal')."%";

      $result = spdcenter::where('created_at', 'LIKE', $tanggal)->paginate(10);
        // \Session::flash('flash_message', 'Data pegawai telah dihapus');
        // return Redirect('admin/listspd');
        return view('spd.listspdcari')->with('result', $result)->with('tanggal', $tanggal);
    }




     public function searchspd(Request $request) {
      $cari = $request->get('spdsearch');
      if($cari==''){
        // return redirect('admin/listspd');
        return redirect()->back(); 
      }

      else{

      $result = spdcenter::where('no_pd', 'LIKE', '%'.$cari.'%')->orWhere('no_st', 'LIKE', '%'.$cari.'%')->orWhere('nama', 'LIKE', '%'.$cari.'%')->orWhere('nip', 'LIKE', '%'.$cari.'%')->paginate(10);
        // \Session::flash('flash_message', 'Data pegawai telah dihapus');
        // return Redirect('admin/listspd');
        return view('spd.listspdsearch')->with('result', $result);
    
        }
    }


 public function spdsearch(Request $request) {
      $cari = $request->get('spdsearch');

      if($cari==''){
        return redirect()->back();
      }

      else{
      $result = profil::where('nip', 'LIKE', '%'.$cari.'%')->orWhere('nama', 'LIKE', '%'.$cari.'%')->paginate(10);
        // \Session::flash('flash_message', 'Data pegawai telah dihapus');
        // return Redirect('admin/listspd');
        return view('spd.spdsearch')->with('result', $result);
      }


    }

    public function exportall(){

      set_time_limit ( 300000 ); 

      Excel::create('ListSPD', function($excel) {

        $excel->sheet('ListSPD', function($sheet) {
          $users = spdcenter::orderBy('id')->get();
          $sheet->loadView('exportspd', ['users' => $users->toArray()]);
        });
      })->download('xls');
  }

      public function exporttgl($tanggal){
      set_time_limit ( 300000 ); 

      Excel::create('ListSPD-'.substr($tanggal, 0, 10), function($excel) use($tanggal) {

        $excel->sheet('ListSPD', function($sheet) use($tanggal) {
          $users = spdcenter::where('created_at', 'LIKE', $tanggal)->orderBy('id')->get();
          $sheet->loadView('exportspd', ['users' => $users->toArray()]);
        });
      })->download('xls');
  }
}
