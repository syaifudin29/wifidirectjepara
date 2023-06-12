@extends('admin/template')
@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Paket Wifi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Paket Wifi</a></li>
          <li class="breadcrumb-item active">Data Paket</li>
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
          <h3 class="card-title">DataTable with paket wifi</h3>
          <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-plus-circle"></i> Tambah data</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama Paket</th>
              <th>Harga</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
        
                @php
                    $no=1;
                @endphp
             @foreach ($paket as $item)
             <tr>
                 <td>{{$no++}}</td>
                 <td>{{$item->nama}}</td>
                 <td>Rp {{number_format($item->harga,0,',','.')}} </td>
                 <td style="text-align: center;">
                  <a data-toggle="modal" data-target="#modaledit{{$item->id}}" class="btn btn-warning"><i class="fas fa-edit"></i></a> 
                  <a href="{{url('admin/paket/delete/'.$item->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            {{-- modal edit  --}}
            <div class="modal fade" id="modaledit{{$item->id}}">
              <div class="modal-dialog modal-lg">
                <form method="post" action="{{url('admin/paket/edit')}}">
                @csrf
                <input type="hidden" value="{{$item->id}}" name="id">
                <div class="modal-content">
                  <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Data Paket Wifi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control" placeholder="" value="{{$item->nama}}" name="nama" required>
                      </div>
                      <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" placeholder="0" value="{{$item->harga}}" name="harga" required>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i>  Update</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              </form>
              <!-- /.modal-dialog -->
            </div>
             @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Harga</th>
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