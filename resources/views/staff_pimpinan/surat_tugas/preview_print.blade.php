@extends('staff_pimpinan.sp_view')
@section('page_title')
	Preview Surat
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/surat_tugas_kepegawaian.css') }}">
  
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;: 
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
               <h3 class="box-title">Detail Surat Tugas {{$surat_tugas->jenis_sk->jenis}}</h3>
            </div>

            <div class="box-body">
         		<div class="table-responsive">
                  <table class="table table-striped table-bordered">
               

                     <tr>
                        <td>No Surat</td>
                        <td>{{ $surat_tugas->nomor_surat}}/UN25.1.15/KP/{{ \Carbon\Carbon::parse($surat_tugas->created_at)->year }}</td>
                     </tr>

                     <tr>
                        <td>Yang Bertugas</td>
                        <td>
                            @foreach ($dosen_tugas as $bertugas)
                           <p>{{ $bertugas->user['nama'] }} - {{ $bertugas->user['no_pegawai'] }}</p>
                           @endforeach
                           @foreach ($pemateri as $pematerii)
                           @if ($pematerii['id_sk'] == $surat_tugas->id)
                           <p>{{$pematerii['nama']}}</p>   
                           @endif
                       @endforeach
                        </td>
                     </tr>
                     <tr>
                        <td>Tanggal Bertugas</td>
                        <td>{{ Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::parse($surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                     </tr>
                     <tr>
                        <td>Keterangan</td>
                        <td>{{$surat_tugas->keterangan}}</td>
                     </tr>
                     <tr>
                        <td>Status</td>
                        <td>{{$surat_tugas->status_sk->status}}</td>
                     </tr>
                  </table>    
               </div>
            </div>

            <!-- Jenis Surat -->
            @if ($surat_tugas->jenis_surat == 1)
            @include('kepegawaian.surat_tugas.jenis.peserta')
            @elseif ($surat_tugas->jenis_surat == 2)
            @include('kepegawaian.surat_tugas.jenis.panitia')
            @else
            @include('kepegawaian.surat_tugas.jenis.pemateri')
            @endif

            <div  class="box-footer">
               <a href="{{ route('staffpim.index') }}" class="btn btn-default">Kembali</a>
               <a  href="{{ route('staffpim.surat.approve', $surat_tugas->id ) }}" class="btn btn-primary pull-right">Setujui</a>
               <a style="margin-right: 5px;" href="{{ route('staffpim.surat.reject.view', $surat_tugas->id ) }}" class="btn btn-danger pull-right">Tolak</a>
            </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')
   <script type="text/javascript">
      var status = @json($surat_tugas->id_status_surat_tugas);
      for (var i = status; i > 0; i--) {
         // $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
         $("#progres_"+i).addClass('verified');
         $("#progres_"+i).find('i').addClass('fa fa-check');
      }
   </script>
@endsection