@extends('dosen.dosen_view')
@section('page_title')
	Preview Surat Tugas
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold; 
      }
      .siteri {
         width: 100%;
      }
	</style>	
@endsection

@section('judul_header')
	Preview Surat Tugas 
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">

   			<div class="box-header">
          <h3 class="box-title">Detail Surat Tugas</h3>
        </div>

        <div class="box-body">
       		<div class="table-responsive">
            <table class="table table-striped table-bordered">

              <tr>
                <td>No Surat</td>
                <td>{{ $spd->surat_tugas->nomor_surat}}</td>
              </tr>
              <tr>
                <td>Yang Bertugas</td>
                <td>
                    @foreach ($dosen_tugas as $bertugas)
                   <p>{{ $bertugas->user['nama'] }} - {{ $bertugas->user['no_pegawai'] }}</p>
                   @endforeach
                </td>
              </tr>
              <tr>
                <td>Tanggal Bertugas</td>
                <td>{{ Carbon\Carbon::parse($spd->surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::parse($spd->surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>{{$spd->surat_tugas->keterangan}}</td>
              </tr>
              <tr>
                <td>Status</td>
                <td>{{$spd->surat_tugas->status_sk->status}}</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="box-body" style="width: 90%; margin: auto;">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                <ul>
            
                  @foreach ($errors->all() as $error)
            
                      <li>{{ $error }}</li>
            
                  @endforeach
            
                </ul>
            </div>
          @endif
          
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div> 
          @endif

          @if ($spd->surat_tugas->status_sk->id != 10)
            <h4>Upload Bukti Transportasi</h4>
            <form method="post" action="{{route('dosen.file.upload', $spd->id_spd)}}" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                <div class="input-group siteri increment">
            
                  <input type="file" name="transportasi[]" class="myfrm form-control">
            
                  <div class="input-group-btn"> 
            
                    <button class="btn btn-success"  id="transportasi" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            
                  </div>
            
                </div>
            
                <div class="clone hide" clone_name="transportasi">
            
                  <div class="siteri input-group" style="margin-top:10px">
            
                    <input type="file" name="transportasi[]" class="myfrm form-control">
            
                    <div class="input-group-btn"> 
            
                      <button class="btn btn-danger delete" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
              </div>

              <br>
              @if ($spd->biaya_penginapan != null)
              <div class="form-group">
                <h4>Upload Bukti Penginapan</h4>
                <div class="input-group siteri increment" >
            
                  <input type="file" name="penginapan[]" class="myfrm form-control">
            
                  <div class="input-group-btn"> 
            
                    <button class="btn btn-success" id="penginapan" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            
                  </div>
            
                </div>
            
                <div class="clone hide" clone_name="penginapan">
            
                  <div class="siteri input-group" style="margin-top:10px">
            
                    <input type="file" name="penginapan[]" class="myfrm form-control">
            
                    <div class="input-group-btn"> 
            
                      <button class="btn btn-danger delete" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              <br>
              @if ($spd->biaya_pendaftaran_acara != null)
              <div class="form-group">  
                <h4>Upload Bukti Pendaftaran</h4>
                <div class="input-group siteri increment" >
            
                  <input type="file" name="pendaftaran[]" class="myfrm form-control">
            
                  <div class="input-group-btn"> 
            
                    <button class="btn btn-success" id="pendaftaran" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            
                  </div>
            
                </div>
            
                <div class="clone hide" clone_name="pendaftaran">
            
                  <div class="siteri input-group" style="margin-top:10px">
            
                    <input type="file" name="pendaftaran[]" class="myfrm form-control">
            
                    <div class="input-group-btn"> 
            
                      <button class="btn btn-danger delete" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
              </div>
              @endif

            </form>
          @endif   
        </div>

        <div  class="box-footer">
           <a href="{{route('dosen.dosen_upload_index') }}" class="btn btn-default pull-right">Kembali</a>
        </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')

   <script type="text/javascript">
      $(document).ready(function() {
        $(".btn-success").click(function(){ 
          id = $(this).attr('id');
          // console.log(id);
          var lsthmtl = $("div[clone_name=" + id + "]").html();
          $(this).parents(".increment").after(lsthmtl);
        });
  
        $("body").on("click",".delete",function(){ 
            $(this).parents(".siteri").remove();
            console.log("test");
        });
      });
  
  </script>
  
  
  
@endsection