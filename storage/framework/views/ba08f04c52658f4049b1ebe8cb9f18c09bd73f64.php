<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.akademik_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	Buat Surat Tugas Penguji Skripsi
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('/adminlte/bower_components/select2/dist/css/select2.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
   <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="<?php echo e(asset('/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
   <!-- Bootstrap time Picker -->
   <link rel="stylesheet" href="<?php echo e(asset('/adminlte/plugins/timepicker/bootstrap-timepicker.min.css')); ?>">
	<style type="text/css">
		form{
			width: 90%;
			margin: auto;
		}

		#nim, #nama_mhs{
			/*width: 80%;*/
		}

		#no_surat{
			width: 25%;
		}

		#format_nomor{
			font-size: 16px;
		}

		#btn_group{
			float: right;
			margin-right: 20px;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	Surat Tugas Penguji Skripsi
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Buat Surat Tugas Penguji Skripsi</h3>

               <br><br>
               <?php if(session('success')): ?>
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-check"></i> Sukses</h4>
                   <?php echo e(session('success')); ?>

               </div>
               <?php
               Session::forget('success');
               ?>

               <?php endif; ?>
               <?php if(session('error')): ?>
               <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-ban"></i>Error</h4>
                   <?php echo e(session('error')); ?>

               </div>

               <?php
               Session::forget('error');
               ?>
               <?php endif; ?>
            </div>

            <form action="<?php echo e(route('akademik.sutgas-penguji.store')); ?>" method="post">
            	<?php echo csrf_field(); ?>
               <div class="box-body">
            		<div class="form-group">
            			<label for="no_surat">No Surat</label><br>
            			<input type="text" name="no_surat" id="no_surat" value="<?php echo e(old('no_surat')); ?>">
            			<span id="format_nomor">/UN25.1.15/SP/<?php echo e(Carbon\Carbon::today()->year); ?></span>

                     <?php if ($errors->has('no_surat')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('no_surat'); ?>
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong><?php echo e($message); ?></strong>
                        </span>
                     <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            		</div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nim">NIM Mahasiswa</label><br>
                           <select id="nim" name="nim" class="form-control select2">
                              <option value="">-- Pilih NIM --</option>
                              <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($item->nim); ?>" <?php echo e(($item->nim == old('nim')? 'selected' : '')); ?>>
                                    <?php echo e($item->nim); ?>

                                 </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>

                           <?php if ($errors->has('nim')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('nim'); ?>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong><?php echo e($message); ?></strong>
                              </span>
                           <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nama_mhs">Nama Mahasiswa</label>
                           <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" readonly="">
                        </div>
                     </div>
                  </div>

                  <div class="form-inline">
                     <div class="form-group">
                        <label for="tanggal">Tanggal Pelaksanaan</label><br>
                        <input type="text" name="tanggal" id="datepicker" class="form-control" autocomplete="off" style="font-size: 16px;" value="<?php echo e(old('tanggal')); ?>">

                        <?php if ($errors->has('tanggal')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('tanggal'); ?>
                           <span class="invalid-feedback" role="alert" style="color: red;">
                              <strong><?php echo e($message); ?></strong>
                           </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                     </div>

                     <div class="form-group">
                        <label for="jam">Jam Pelaksanaan</label><br>
                        <input type="text" name="jam" id="jam" class="form-control timepicker" style="font-size: 16px; width: 60%;" value="<?php echo e(old('jam')); ?>"> <b style="font-size: 15px;">WIB</b>

                        <?php if ($errors->has('jam')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('jam'); ?>
                           <span class="invalid-feedback" role="alert" style="color: red;">
                              <strong><?php echo e($message); ?></strong>
                           </span>
                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                     </div>
                  </div>
                  <br>

                  <div class="form-group">
                     <label for="tempat">Tempat Pelaksanaan</label><br>
                     <select name="tempat" id="tempat" class="form-control select2">
                        <option value="">--Pilih Ruangan--</option>
                        <?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($item->id); ?>" <?php echo e(($item->id == old('tempat')? 'selected' : '')); ?>>
                              <?php echo e($item->nama_ruang); ?>

                           </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                     

                     <?php if ($errors->has('tempat')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('tempat'); ?>
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong><?php echo e($message); ?></strong>
                        </span>
                     <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                  </div>

            		<div class="form-group">
            			<label for="id_penguji1">Penguji 1</label><br>
            			<select name="id_penguji1" id="id_penguji1" class="form-control select2">
                            <option value="">--Pilih Penguji 1--</option>
            				<?php $__currentLoopData = $dosen1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            					<option value="<?php echo e($item->no_pegawai); ?>" <?php echo e(($item->no_pegawai == old('id_penguji1')? 'selected' : '')); ?>>
                              <?php echo e($item->nama); ?>

                           </option>
            				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            			</select>

                     <?php if ($errors->has('id_penguji1')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('id_penguji1'); ?>
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                     <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            		</div>

            		<div class="form-group">
            			<label for="id_penguji2">Penguji 2</label><br>
            			<select name="id_penguji2" id="id_penguji2" class="form-control select2">
            				<option value="">--Pilih Penguji 2--</option>
            				<?php $__currentLoopData = $dosen2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            					<option value="<?php echo e($item->no_pegawai); ?>" <?php echo e(($item->no_pegawai == old('id_penguji2')? 'selected' : '')); ?>>
                              <?php echo e($item->nama); ?>

                           </option>
            				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            			</select>

                     <?php if ($errors->has('id_penguji2')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('id_penguji2'); ?>
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                     <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            		</div>
               </div>

               <div class="box-footer">
                  <input type="hidden" name="status" value="">
                  <a href="<?php echo e(route('akademik.sutgas-penguji.index')); ?>" class="btn btn-default">Batal</a> &ensp;

                  <div id="btn_group">
                     
                     <button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> &ensp;
                     <button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>
                  </div>
               </div>
            </form>

   		</div>
   	</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
	<!-- bootstrap datepicker -->
   <script src="<?php echo e(asset('/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
   <script src="<?php echo e(asset('/adminlte/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.id.js')); ?>"></script>
   <!-- bootstrap time picker -->
   <script src="<?php echo e(asset('/adminlte/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>

   <script type="text/javascript">
		$('.select2').select2();

      $("button[name='simpan_draf']").click(function(event) {
         event.preventDefault();
         $("input[name='status']").val(1);
         $('form').trigger('submit');
      });

      $("button[name='simpan_kirim']").click(function(event) {
         event.preventDefault();
         $("input[name='status']").val(2);
         $('form').trigger('submit');
      });

      //Time picker
      $('.timepicker').timepicker({
        showInputs: true,
        showMeridian: false,
        minuteStep: 5,
        defaultTime: '08.00'
      })

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        language: 'id'
      })

      var mahasiswa = <?php echo json_encode($mahasiswa, 15, 512) ?>;
      var nim_old = <?php echo json_encode(old('nim'), 15, 512) ?>;
      var dosen1 = <?php echo json_encode($dosen1, 15, 512) ?>;
      var dosen2 = <?php echo json_encode($dosen2, 15, 512) ?>;

      if(nim_old != null){
         var nama = "";
         var id_pembimbing1 = 0;
         var id_pembimbing2 = 0;
         var old_id_penguji1 = <?php echo json_encode(old('id_penguji1'), 15, 512) ?>;
         var old_id_penguji2 = <?php echo json_encode(old('id_penguji2'), 15, 512) ?>;

         // console.log('ada gan');
         $.each(mahasiswa, function(index, val) {
             if(nim_old == val.nim){
               nama = val.nama;
               // id_pembimbing1 = val.detail_skripsi.id_pembimbing_utama;
               // id_pembimbing2 = val.detail_skripsi.id_pembimbing_pendamping;
               return false;
             }
         });
         $("input[name='nama_mhs']").val(nama);

         var route = "<?php echo e(route('akademik.getPembimbing')); ?>" + "/" + nim_old;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $.ajax({
            url: route,
            type: 'GET',
            // dataType: 'json',
            // data: {'nim': nim},
         })
         .done(function(pembimbing) {
            console.log("success");
            setDosen_old(pembimbing['dosen1'].no_pegawai, pembimbing['dosen2'].no_pegawai, old_id_penguji1, old_id_penguji2);

            //Set disable pilihan dosen di select dosen 2 yg sdh dipilih di select dosen 1
            if (old_id_penguji1 != null) {
               $("select#id_penguji2 option[value='"+old_id_penguji1+"']").attr('disabled', 'disabled');
            }
            //Set disable pilihan dosen di select dosen 1 yg sdh dipilih di select dosen 2
            if (old_id_penguji2 != null) {
               $("select#id_penguji1 option[value='"+old_id_penguji2+"']").attr('disabled', 'disabled');
            }
         })
         .fail(function() {
            console.log("error");
         });
      }

      // Set dosen yg sama di select dosen 2 jadi disabled ketika select dosen 1 berubah
      $("select#id_penguji1").change(function(event) {
         $("select#id_penguji2 option[disabled='disabled']").removeAttr('disabled');
         var no_pegawai = $(this).val();
         $("select#id_penguji2 option[value='"+no_pegawai+"']").attr('disabled', 'disabled');
      });

      //Set dosen yg sama di select dosen 1 jadi disabled ketika select dosen 2 berubah   
      $("select#id_penguji2").change(function(event) {
         $("select#id_penguji1 option[disabled='disabled']").removeAttr('disabled');
         var no_pegawai = $(this).val();
         $("select#id_penguji1 option[value='"+no_pegawai+"']").attr('disabled', 'disabled');
      });

		$("select[name='nim']").change(function(event) {
			var nim = $(this).val();
			var nama = "";
         var id_pembimbing1 = 0;
         var id_pembimbing2 = 0;
			$.each(mahasiswa, function(index, val) {
				 if(nim == val.nim){
				 	nama = val.nama;
               // id_pembimbing1 = val.detail_skripsi.id_pembimbing_utama;
               // id_pembimbing2 = val.detail_skripsi.id_pembimbing_pendamping;
				 	return false;
				 }
			});

			$("input[name='nama_mhs']").val(nama);

         var route = "<?php echo e(route('akademik.getPembimbing')); ?>" + "/" + nim;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $.ajax({
            url: route,
            type: 'GET',
            // dataType: 'json',
            // data: {'nim': nim},
         })
         .done(function(pembimbing) {
            console.log("success");
            // console.log(pembimbing);
            setDosen(pembimbing['dosen1'].no_pegawai, pembimbing['dosen2'].no_pegawai);
         })
         .fail(function() {
            console.log("error");
         });
		});

      function setDosen(id_pembimbing1, id_pembimbing2) {
         $("select[name='id_penguji1']").find("option:not(:first-child)").remove();
         $("select[name='id_penguji2']").find("option:not(:first-child)").remove();

         $.each(dosen1, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               $("select[name='id_penguji1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
            }
         });

         $.each(dosen2, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               $("select[name='id_penguji2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
            }
         });

      }

      function setDosen_old(id_pembimbing1, id_pembimbing2, old_penguji1 = null, old_penguji2 = null) {
         $("select[name='id_penguji1']").find("option:not(:first-child)").remove();
         $("select[name='id_penguji2']").find("option:not(:first-child)").remove();

         $.each(dosen1, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               if(val.no_pegawai == old_penguji1){
                  $("select[name='id_penguji1']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
               }
               else{
                  $("select[name='id_penguji1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               }
            }
         });

         $.each(dosen2, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               if (val.no_pegawai == old_penguji2) {
                  $("select[name='id_penguji2']").append(`<option value="`+val.no_pegawai+`" selected>`+val.nama+`</option>`);
               }
               else{
                  $("select[name='id_penguji2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               }
            }
         });
      }
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/akademik/sutgas_penguji/create.blade.php ENDPATH**/ ?>