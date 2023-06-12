@extends('admin/template')
@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pelanggan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
          <li class="breadcrumb-item active">Data pelanggan</li>
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
          <h3 class="card-title">DataTable with pelanggan</h3>
          <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-plus-circle"></i> Tambah data</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No Langganan</th>
              <th>Nama</th>
              <th>No HP</th>
              <th>Paket</th>
              <th>Jatuh Tempo</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pelanggan as $item)
              <tr>
                <td>{{$item->no_langganan}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->no_hp}}</td>
                <td>{{$item->paket->nama}}</td>
                <td>{{date('d M Y', strtotime($item->jatuhtempo))}}</td>
                <td style="text-align: center;">
                  <a href="{{url('admin/pelanggan/updatepassword')."/".$item->no_langganan}}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset Password"><i class="fas fa-key"></i></a>
                  <a data-toggle="modal" data-target="#modalupdate{{$item->no_langganan}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Update pelanggan" class="btn btn-warning"><i class="fas fa-edit"></i></a> 
                  <form method="post" action="/admin/pelanggan/{{$item->no_langganan}}"  enctype="multipart/form-data" class="d-inline">
                    @method('DELETE')
                    @csrf
                  <button class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus Pelanggan"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
                {{-- modal edit --}}
                <div class="modal fade" id="modalupdate{{$item->no_langganan}}">
                  <div class="modal-dialog modal-lg">
                    <form method="post" action="/admin/pelanggan/{{$item->id}}" enctype="multipart/form-data">
                      @method('PUT');
                      @csrf
                    <input type="hidden" class="form-control" name="no_langganan" value="{{$item->no_langganan}}" >
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h4 class="modal-title">Tambah Data Pelanggan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label>NO Pelanggan</label>
                            <input type="text" class="form-control" placeholder="masukkan satuan" value="{{$item->no_langganan}}" disabled>
                          </div>
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="masukkan nama" value="{{$item->nama}}"  name="nama" required>
                          </div>
                          <div class="form-group">
                            <label>No Hp</label>
                            <input type="number" class="form-control" placeholder="628xxxx" value="{{$item->no_hp}}"  name="no_hp" required>
                          </div>
                          <div class="form-group">
                            <label>ID KTP</label>
                            <input type="number" class="form-control" placeholder="0"  name="ktp" value="{{$item->ktp}}" required>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="user@email.com" value="{{$item->email}} "  name="email" required>
                          </div>
                          <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control">{{$item->alamat}}</textarea>
                          </div>
                          <div class="form-group">
                            <label>Paket</label>
                            <select class="form-control" name="paket_id" aria-label="Default select example">
                              @foreach ($paket as $itemp)
                              @if ($itemp->id == $item->paket_id)
                                  <option value="{{$itemp->id}}" selected>{{$itemp->nama." - Rp ".number_format($itemp->harga,0,',','.')}}</option>
                              @else 
                              <option value="{{$itemp->id}}">{{$itemp->nama." - Rp ".number_format($itemp->harga,0,',','.')}}</option>
                                @endif
                              
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Jatuh Tempo</label>
                            <input type="date" class="form-control" value="{{$item->jatuhtempo}}"  name="jatuhtempo" required>
                          </div>
                          
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i>  update</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  </form>
                  <!-- /.modal-dialog -->
                </div>
              </tr>
             @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>No Langganan</th>
              <th>Nama</th>
              <th>No HP</th>
              <th>Paket</th>
              <th>Jatuh Tempo</th>
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
    <form method="post" action="{{route('pelanggan.store')}}" enctype="multipart/form-data">
      @csrf
    <input type="hidden" class="form-control" name="no_langganan" value="<?php echo "WF01201".($pelanggan->count()+1); ?>" >
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Tambah Data Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>NO Pelanggan</label>
            <input type="text" class="form-control" placeholder="masukkan satuan" value="<?php echo "WF01201".($pelanggan->count()+1); ?>" name="id_barang" disabled>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="masukkan nama"  name="nama" required>
          </div>
          <div class="form-group">
            <label>No Hp</label>
            <input type="number" class="form-control" placeholder="628xxxx"  name="no_hp" required>
          </div>
          <div class="form-group">
            <label>ID KTP</label>
            <input type="number" class="form-control" placeholder="0"  name="ktp" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="user@email.com"  name="email" required>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" class="form-control">

            </textarea>
          </div>
          <div class="form-group">
            <label>Paket</label>
            <select class="form-control" name="paket_id" aria-label="Default select example">
             @foreach ($paket as $itemp)
             <option value="{{$itemp->id}}">{{$itemp->nama." - Rp ".number_format($itemp->harga,0,',','.')}}</option>
             @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Jatuh Tempo</label>
            <input type="date" class="form-control"  name="jatuhtempo" required>
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
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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