@extends('admin/template')
@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Jatuh Tempo</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Tagihan</a></li>
          <li class="breadcrumb-item active">Jatuh tempo</li>
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
          <h3 class="card-title">Data yang sudah jatuh tempo</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Tagihan</th>
              <th>No Langganan</th>
              <th>Nama</th>
              <th>Tanggal tagihan</th>
              <th>Tagihan</th>
              <th>Denda</th>
              <th>Harus di bayar</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
        
                @php
                    $no=1;
                @endphp
            @foreach ($tagihan as $item)
            @if ($item->pelanggan->is_active != '0')
            <tr>
              <td>{{$item->no_tagihan}}</td>
              <td>{{$item->pelanggan->no_langganan}}</td>
              <td>{{$item->pelanggan->nama}}</td>
              <td>{{date('d M Y', strtotime($item->tgl_tagihan))}}</td>
              <td>Rp {{number_format($item->ttl_byr,0,',','.')}}</td>
              @if ($item->tgl_tagihan < date('Y-m-d'))
                    <td>Rp {{number_format(10000,0,',','.')}} </td>
                    @php
                      $jum=0;
                      $jum=$item->ttl_byr+10000;
                  @endphp
                @else
                    <td>Rp 0</td>
                    @php
                      $jum=$item->ttl_byr;
                  @endphp
                @endif
                <td>Rp {{number_format($jum,0,',','.')}} </td>
                <td>
                    @if ($item->status == 'proses')
                        <span class="badge bg-warning">Proses</span>
                    @else
                        <span class="badge bg-danger">Belum</span>
                    @endif
                </td>
                <td style="text-align: center;">
                    <input id="id_pel{{$item->no_tagihan}}" type="hidden" value="{{$item->pelanggan->no_langganan}}" name="idpelanggan">
                    <a href="{{url('/admin/tagihan/bayartagihan?no_pelanggan=').$item->pelanggan->id}}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Bayar tagihan"><i class="fas fa-solid fa-wallet"></i></a> 
                    <button onclick="wa('{{$item->no_tagihan}}')" id="btnwa" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Whatsapp">
                      <img id="imgWa{{$item->no_tagihan}}"src="{{url('gambar/wa.png')}}" style="height: 30px; width: 30px;" alt="">
                      <div id="loadingWa{{$item->no_tagihan}}" class="spinner-border text-success d-none" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </button>

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
                <th>Tanggal tagihan</th>
                <th>Tagihan</th>
                <th>Denda</th>
                <th>Jumlah Bayar</th>
                <th>Status</th>
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

     function wa(nomor){
      id = $('#id_pel'+nomor).val();
      $('#imgWa'+nomor).hide();
      $('#loadingWa'+nomor).removeClass('d-none');
      $.post("http://127.0.0.1:8000/api/admin/tagihan/notif", {'id_pelanggan' : id, 'id_tagihan': nomor},  function(data, status){
      console.log(data);
       $('#imgWa'+nomor).show();
        $('#loadingWa'+nomor).addClass('d-none');
      })
    
      }
  
  </script>
@endsection