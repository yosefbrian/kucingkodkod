@extends('layouts.app')


@section('content')

<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th	{
    background-color: black;
    color: white;
}
</style>



<div>
<h2>Reimbursement</h2>
</div>

<br>
<hr>

<table>


  <tr>
    <th>No SPD</th>
    <th>Tanggal</th>
    <th>Tujuan</th>
   <!--  <th>Berangkat</th>
    <th>Tujuan</th>
    <th>Tanggal</th>
    <th>Kegiatan</th>
    <th>Keterangan</th>
    <th>Nama PPK</th>
 -->
   </tr>

   <?php $i=0; ?>
                @foreach ($spd as $espede)
                    <?php $i++; ?>
  <tr>
    <td>{{$espede->no_pd}}</td>		
     <td>{{$espede->tanggal}}</td>
     <td>{{$espede->tujuan}}</td>
     <td> 

    <a class="btn btn-primary" data-placement="bottom" title="Lihat Data" data-toggle="modal" data-id ="book->id" data-target="#modalshow1<?php echo $espede->id;?>" href="#">Detil SPD</a>

     <a class="btn btn-success" data-placement="bottom" title="Lihat Data" data-toggle="modal" data-id ="book->id" data-target="#modalshow<?php echo $espede->id;?>" href="#">Upload Nota</a>
    <a class="btn btn-primary" title="Lihat Nota" href="{{ action('SPDController@lihat', $espede->id) }}">Lihat Nota</a>

    <a class="btn btn-success" data-id ="espede->id" data-target="#checklist<?php echo $espede->id;?>" data-toggle="modal" href="#">Checklist</a>
     </td>


<!-- modal checklist -->


 <div id="checklist<?php echo $espede->id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Checklist</h4>
      </div>
      <div class="modal-body">
        

<?php  

$bppd = 0;
$pengiriman = 0;
$pencairan = 0;
foreach ($bp1 as $bepe1) { 
    $bpsatu = $bepe1->no_pd;
    if($bpsatu == $espede->no_pd){

        $bppd = $espede->no_pd;
        $pengiriman = $espede->pengiriman;
        $pencairan = $bepe1->pencairan;

    }
}


?>


@if($pengiriman=='0')
 <input type="checkbox" name="pengiriman" value="{{ $pengiriman }}" disabled="disabled"> Pengiriman<br>
@endif

@if($pengiriman=='1')
 <input type="checkbox" name="pengiriman" value="{{ $pengiriman }}" checked="checked" disabled="disabled"> Pengiriman {{$espede->tanggal_pengiriman}}<br>
@endif

<input type="checkbox" name="pengiriman" value="{{ $espede->id }}" checked="checked" disabled="disabled"> SPD Center <br>

@if($bppd != '')

<input type="checkbox" name="pengiriman" value="{{ $bppd }}" checked="checked" disabled="disabled"> BP <br>

@endif

@if($bppd == '')

<input type="checkbox" name="pengiriman" value="{{ $bppd }}" disabled="disabled"> BP <br>

@endif

@if($pencairan == '1')

<input type="checkbox" name="pengiriman" value="$pencairan" disabled="disabled" checked="checked"> Cair Dana Tersedia <br>

@endif

@if($pencairan == '2')
<input type="checkbox" name="pengiriman" value="$pencairan" disabled="disabled" checked="checked"> Cair Dana Telah Ditransfer <br>

@endif

@if($pencairan == '0' )

<input type="checkbox" name="pengiriman" value="$pencairan" disabled="disabled" > Cair Dana Tersedia <br>

<input type="checkbox" name="pengiriman" value="$pencairan" disabled="disabled" > Cair Dana Telah Ditransfer <br>


@endif




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>     






<!-- modal nota -->

    <div id="modalshow<?php echo $espede->id;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        

<form  action="{{ url('/spdcenter/'.$espede->id) }}" method="post" enctype="multipart/form-data">
    
Nomor ST :<br>
  <input class="form-control" type="text" name="no_st" value="<?php echo $espede->no_st;?>"><br>

No Resi :<br>
  <input class="form-control" type="text" name="no_resi" value=""><br>

Judul Nota :<br>
  <input class="form-control" type="text" name="judul" value=""><br>

Deskripsi Nota :<br>
  <input class="form-control" type="text" name="deskripsi" value=""><br>


    <div class="col-xs-8">
        <input type="file" class="btn btn-default btn-file" value="fileToUpload" name="fileToUpload" id="fileToUpload" required="required"/>
    </div>


<input class="btn btn-success" type="submit" value="Simpan"/>
<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />



</form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>     










     <div class="modal fade" id="modalshow1<?php echo $espede->id;?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title"><b>Detil SPD</b></h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" value="<?php echo $espede->id;?>" name="id">
                                    <div class="panel panel-group">
                                        <div class="panel-body">
                                            <div class="row col-md-10 col-md-offset-1">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-6"><div class="pull-right">&nbsp;</div></label>
                                                        <div class="col-sm-6"></div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Pengiriman 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->pengiriman}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Nomor PD: 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->no_pd}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Nomor ST : 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->no_st}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    NIP : 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->nip}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Nama : 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->nama}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Berangkat : 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->berangkat}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Tujuan :
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{$espede->tujuan}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Tanggal :
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{$espede->tanggal}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Kegiatan : 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{$espede->keterangan}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-6">
                                                                <div class="pull-right">
                                                                    Nama PPK : 
                                                                </div>
                                                            </label>
                                                            <div class="col-sm-6">{{ $espede->nama_ppk}}</div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                    <button type="button" title="Kembali" class="btn btn-default btn-simple" data-dismiss="modal">Kembali</button>
                                    
                            </div>
                           </div>

                          <!--  <td><a class="btn btn-warning" data-placement="bottom" title="Edit Data" href="{{ url('admin/listspd/'.$espede->id.'/ubah')}}"><span class="glyphicon glyphicon-pencil"></a></td>
                    		
                    		<td><a class="btn btn-danger" data-placement="bottom" title="Hapus Data" data-toggle="modal" href="#" data-target="#modaldelete<?php echo $espede->id;?>"><span class="glyphicon glyphicon-trash"></a></td> -->

                           <!--   <div class="modal fade" id="modaldelete<?php echo $espede->id;?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title"><b>Perhatian</b></h4>
                                </div>
                                
                                <div class="modal-body">
                                    <input type="hidden" value="<?php echo $espede->id;?>" name="id">
                                    <h5>Apakah Anda yakin akan menghapus data ini?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Kembali</button>
                                    <div class="divider"></div>
                                    <a class="btn btn-danger btn-simple" title="Hapus" href="{{ action('SPDController@delete', $espede->id) }}">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>      
 -->
   <!--   <td>{{$espede->berangkat}}</td>
     <td>{{$espede->tujuan}}</td>
     <td>{{$espede->tanggal}}</td>
     <td>{{$espede->kegiatan}}</td>
     <td>{{$espede->keterangan}}</td>
     <td>{{$espede->nama_ppk}}</td> -->

  </tr>
 @endforeach 

 </table>


@endsection