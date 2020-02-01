@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Buat Laporan Peminjaman Barang')

@section('css_link')
<link href="/adminlte/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link href="/adminlte/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<style type="text/css">
    .hidden {
        display: none important !;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Buat Laporan Peminjaman Barang</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'perlengkapan.peminjaman_barang.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal/Jam</th>
                                <th>Kegiatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::text('tanggal', null, ['class' => 'form-control not-rounded-border', 'id' => 'reservationtime']) !!}
                                </td>

                                <td>
                                    {!! Form::text('kegiatan', null, ['class' => 'form-control']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>🗙</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            <tr>
                                <td>
                                    <select id="barang" name="barang[]" class="form-control barang">
                                        <option value="null">Pilih Barang</option>
                                        @foreach ($barang as $val)
                                        <option value="{{ $val->id }}">{{ $val->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="merk">
                                    <select id="merk_barang" name="merk_barang[]" class="form-control merk_barang"
                                        disabled="true">
                                    </select>
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control'])!!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>🗙</th>
                            </tr>
                        </tfoot>
                    </table>

                    <h5>Total Data = <span class="data_count">0</span></h5>
                </div>
                <button id="tambah" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                <br><br>
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Simpan dan Kirim', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/adminlte/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    var dataAjax = null;
    $(function(){

        opsiButton();
        tableCount();
        barangAjax();

        $('.js-example-basic-multiple').select2();

        $('#reservation').daterangepicker();

        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'YYYY/MM/DD HH:mm:ss' }})

        $('.datepicker').datepicker({
            autoclose: true,
            // format: 'yyyy-mm-dd'
        });

        $('.timepicker').timepicker({
            showInputs: false
        });

        $('#tambah').click(function(event) {
            $('#inputan').append(`
                <tr>
                    <td>
                        <select id="barang" name="barang[]" class="form-control barang">
                            <option value="">Pilih Barang</option>
                            @foreach ($barang as $val)
                            <option value="{{ $val->id }}">{{$val->nama_barang}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="merk">
                        <select id="merk_barang" name="merk_barang[]" class="form-control merk_barang" disabled="true">
                        </select>
                    </td>

                    <td>
                        {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka'])
                        !!}
                    </td>

                    <td>
                        {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control', 'id' =>
                        'satuan'])!!}
                    </td>

                    <td>
                        {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                    </td>
                </tr>
            `);

            opsiButton();
            tableCount();
            barangAjax();
        });

        function barangAjax(){
            $('.barang').on('change', function(){
                var id = $(this).val();

                // console.log($(this).parents('tr'));
                // console.log($(this).parents('tr')["0"].children[1]);
                merk = $(this).parents('tr').children('.merk').children();
                // console.log($(this).parents('tr').children('.merk').children());
                // console.log($(this).parents('tr').children('.merk_barang'));

                if(id) {
                    $.ajax({
                    url: "/perlengkapan/peminjaman_barang/barang/" + id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        dataAjax = data;
                        $(merk).empty();
                        $(merk).prop('disabled', false);
                        $.each(data, function(key, value) {
                            $(merk).append('<option value="'+ value.id +'">' + value.merk_barang + '</option>');
                        });
                        // console.log(merk);
                    }
                });
                } else {
                    $(merk).prop('disabled', true);
                    $(this).parents('tr').children('.merk_barang').empty();
                }
            });
        }

        function tableCount(){
            data = $('#inputan tr').length;
            $(".data_count").text(data);
        }

        function opsiButton(){
            $('.fa.fa-trash').click(function(){
                if (data > 1) {
                    $(this).parents('tr').remove();
                    tableCount();
                }
            });
        }
    });

</script>
@endsection
