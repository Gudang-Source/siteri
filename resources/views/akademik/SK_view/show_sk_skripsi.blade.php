@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Detail SK Skripsi
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.tbl_row{
			display: table;
			width: 100%;
			border-bottom: 0.1px solid lightgrey;
			margin-top: 5px;
		}

		.revisi_wrap{
        padding: 5px;
      }

      #dataTable thead tr th{
      	text-align: center;
      }

      #dataTable tbody tr td:nth-child(2){
      	width: 100px;
      }

      #dataTable tbody tr td:nth-child(5){
      	width: 350px;
      }
	</style>
@endsection

@section('judul_header')
	SK Skripsi
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
	
	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Progress SK Skripsi Ini</h3>
              	  <span style="margin-left: 5px;">
	            	@if($sk->verif_ktu == 2) 
							<label class="label bg-red">Butuh Revisi (KTU)</label>
						@elseif($sk->verif_dekan == 2) 
							<label class="label bg-red">Butuh Revisi (Dekan)</label>
						@else
						@endif
					  </span>
	          	  
	            	<div class="box-tools pull-right">
	               	<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
	               	</button>
	               	<button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
	               	</button>
	              	</div>
	            </div>
				
	            <div class="box-body">
						<h5><b>Nomor Surat</b> : {{$sk->no_surat}}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk->created_at)->year}}</h5>
            		<h5><b>Tanggal Dibuat</b> : {{Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            		<h5><b>Tanggal SK Pembimbing</b> : {{Carbon\Carbon::parse($sk->tgl_sk_pembimbing)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            		<h5><b>Tanggal SK Penguji</b> : {{Carbon\Carbon::parse($sk->tgl_sk_penguji)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            		
            		<br>
	            	<h5><b>Progres</b> :</h5>
	            	<div class="tl_wrap">
	            	  <div class="item_tl" id="progres_1">
	            	    <div><i class="fa fa-check"></i></div>
	            	    <h4>Disimpan</h4>
	            	  </div>

	            	  <div class="item_tl" id="progres_2">
	            	    <div><i></i></div>
	            	    <h4>Dikirim</h4>
	            	  </div>

	            	  <div class="item_tl" id="progres_3">
	            	    <div><i></i></div>
	            	    <h4>Disetujui KTU</h4>
	            	  </div>

	            	  {{-- <div class="item_tl" id="progres_4">
	            	    <div><i></i></div>
	            	    <h4>Disetujui Dekan</h4>
	            	  </div> --}}
	            	</div>

         			@if(!is_null($sk->pesan_revisi))
         			<div class="revisi_wrap">
            			<h4><b>Pesan Revisi</b> : </h4>
         				<blockquote>
         					<p>{{ $sk->pesan_revisi }}</p>
         				</blockquote>
         			</div>
         			@endif
	            </div>

	            <div class="box-footer">
	            	<a href="{{ route('akademik.skripsi.index') }}" class="btn btn-default">Kembali</a>
            		@if ($sk->verif_ktu == 1)
            	   	<div class="pull-right">
            	      <a href="{{ route('akademik.skripsi.cetak', $sk->no_surat) }}" class="btn bg-teal"><i class="fa fa-print"></i> Download PDF</a>
            	   	</div>
            		@endif
	            </div>
      		</div>
      	</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
	              	<h3 class="box-title">Data SK Skripsi</h3>

	              	@if($sk->verif_ktu != 1)
		              <div class="form-group" style="float: right;">
		              	<a href="{{ route('akademik.Skripsi.edit', $sk->no_surat) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
		              </div>
	              	@endif
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="dataTable" class="table table-bordered table-hover">
		            		<thead>
			            		<tr>
			            			<th>No</th>
			            			<th>NIM</th>
			            			<th>Nama Mahasiswa</th>
			            			<th>Program Studi</th>
			            			<th>Judul</th>
			            			<th>Pembimbing I/II</th>
			            			<th>Pembahas I/II</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		@php $no = 0; @endphp
			            		@foreach($detail_skripsi as $item)
		            			<tr>
		            				<th>{{ $no+=1 }}</th>
		            				<td>{{$item->skripsi->nim}}</td>
		            				<td>{{$item->skripsi->mahasiswa->nama}}</td>
		            				<td>{{$item->skripsi->mahasiswa->bagian->bagian}}</td>
		            				<td>{{$item->judul}}</td>
		            				@if ($item->surat_tugas[0]->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing")
		            				   <td>
		            				      <div class="tbl_row">
		            				         1. {{ $item->surat_tugas[0]->dosen1->nama }}
		            				      </div>
		            				      <div class="tbl_row">
		            				         2. {{ $item->surat_tugas[0]->dosen2->nama }}
		            				      </div>
		            				   </td>
		            				   <td>
		            				      <div class="tbl_row">
		            				         1. {{ $item->surat_tugas[1]->dosen1->nama }}
		            				      </div>
		            				      <div class="tbl_row">
		            				         2. {{ $item->surat_tugas[1]->dosen2->nama }}
		            				      </div>
		            				   </td>
		            				@else
		            				   <td>
		            				      <div class="tbl_row">
		            				         1. {{ $item->surat_tugas[1]->dosen1->nama }}
		            				      </div>
		            				      <div class="tbl_row">
		            				         2. {{ $item->surat_tugas[1]->dosen2->nama }}
		            				      </div>
		            				   </td>
		            				   <td>
		            				      <div class="tbl_row">
		            				         1. {{ $item->surat_tugas[0]->dosen1->nama }}
		            				      </div>
		            				      <div class="tbl_row">
		            				         2. {{ $item->surat_tugas[0]->dosen2->nama }}
		            				      </div>
		            				   </td>
		            				@endif
		            			</tr>
			            		@endforeach
			            	</tbody>
			            </table> 
	            	</div>
	            	
	            	 @if($sk->verif_ktu != 1)
		              <br>
		              <div class="form-group" style="float: right;">
		            	<a href="{{ route('akademik.skripsi.edit', $sk->no_surat) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
		              </div>
	              	@endif
	            </div>
      		</div>
      </div>
	</div>

@endsection

@section('script')
<script src="/js/btn_backTop.js"></script>
<script type="text/javascript">
	var status = @json($sk->id_status_sk);
	for (var i = status; i > 0; i--) {
		// $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
		$("#progres_"+i).addClass('verified');
      $("#progres_"+i).find('i').addClass('fa fa-check');
	}
</script>
@endsection