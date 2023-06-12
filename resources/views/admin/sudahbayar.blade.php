@extends('admin/template')
@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Sudah Bayar</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Tagihan</a></li>
          <li class="breadcrumb-item active">Sudah Bayar</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data yang sudah bayar wifi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Tagihan</th>
              <th>No Langganan</th>
              <th>Nama</th>
              <th>Tagihan</th>
              <th>Denda</th>
              <th>Tanggal Bayar</th>
              <th>Jumlah Bayar</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
        
                @php
                    $no=1;
                @endphp
            @foreach ($tagihan as $item)
            @if ($item->pelanggan->is_active != 0)
            @php
                $jum = $item->ttl_byr+$item->denda;
            @endphp
            <tr>
                <td>{{$item->no_tagihan}}</td>
                <td>{{$item->pelanggan->no_langganan}}</td>
                <td>{{$item->pelanggan->nama}}</td>
                <td>{{date('d M Y', strtotime($item->tgl_tagihan))}}</td>
                <td>Rp {{number_format($item->denda,0,',','.')}} </td>
                <td>{{date('d M Y', strtotime($item->tgl_byr))}}</td>
                <td>Rp {{number_format($jum,0,',','.')}} </td>
                <td>
                  <a href="{{url('admin/tagihan/batal/'.$item->no_tagihan)}}" onClick="return confirm('Apakah Anda benar-benar mau membatalkannya ?')" class="btn btn-danger"> Batal</a>
                </td>
            </tr>
            @endif
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>ID Tagihan</th>
                <th>No Langganan</th>
                <th>Nama</th>
                <th>Tagihan</th>
                <th>Denda</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah Bayar</th>
                <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
   
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-lg">
    <form method="post" action="{{url('admin/paket/tambah')}}">
    @csrf
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Tambah Data Paket Wifi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>Nama Paket</label>
            <input type="text" class="form-control" placeholder="" name="nama" required>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" placeholder="0" name="harga" required>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>  Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  </form>
  <!-- /.modal-dialog -->
</div>
@endsection

{{-- import css --}}
@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

{{-- import javascript --}}
@section('js')
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection