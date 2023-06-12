@extends('admin/template')
@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bayar Tagihan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Tagihan</a></li>
          <li class="breadcrumb-item active">Bayar Tagihan</li>
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
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">CARI PELANGGAN :</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select class="form-control select2" name="pelanggan_id" id="mySelect" aria-label="Default select example">
                            <option>Pilih</option>
                             @foreach ($pelanggancari as $itemp)
                             <option value="{{$itemp->id}}">{{$itemp->no_langganan}} | {{$itemp->nama}}</option>
                             @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Data Pelanggan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if (count($pelanggan) == 0)
                <form>
                  <div class="card-body">
                    <div class="form-group">
                    <label>No Langgan</label>
                    <input type="text" class="form-control" name="suplier"   disabled>
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control"   name="nama"  disabled>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" disabled></textarea>
                  </div>
                </form>
                @else   
                <form>
                  <div class="card-body">
                    <div class="form-group">
                    <label>No Pelanggan</label>
                    <input type="text" class="form-control" name="suplier" value="{{$pelanggan[0]['no_langganan']}}"  disabled>
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{$pelanggan[0]['nama']}}"  name="nama"  disabled>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" disabled>{{$pelanggan[0]['alamat']}}</textarea>
                  </div>
                </form>
                @endif
              </div>
        </div>
       
    </div>
    <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Tagihan</h3>
                </div>
                <div style="padding: 20px">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Tagihan</th>
                      <th>Denda</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                
                      @php
                          $jum=0;
                          $jum1=0;
                      @endphp
                      @if (count($tagihan) == 0)
                          
                      @else
                        @foreach ($tagihan as $item)
                        @php
                              $jum=$jum+$item->ttl_byr;
                              $idpelanggan = $item->pelanggan_id;
                          @endphp
                        <tr>
                            <td>{{date('M', strtotime($item->tgl_tagihan))}}</td> 
                            <td>Rp {{number_format($item->ttl_byr,0,',','.')}}</td>
                            @if ($item->tgl_tagihan < date('Y-m-d'))
                                <td>Rp {{number_format(10000,0,',','.')}} </td>
                                @php
                                    $jum=0;
                                    $jum=$item->ttl_byr+10000;
                                    $jum1=$jum+$jum1;
                                @endphp
                            @else
                                <td>Rp 0</td>
                                  @php
                                    $jum=0;
                                    $jum=$item->ttl_byr;
                                      $jum1=$jum+$jum1;
                                @endphp
                            @endif
                            <td>Rp {{number_format($jum,0,',','.')}}</td>  
                        </tr>
                        @endforeach
                      @endif
                      <tr style="background-color: aquamarine">
                      <td><b>Total</b></td>
                      <td></td>
                      <td></td>
                      <td><b>Rp {{number_format($jum1,0,',','.')}}</b></td>
                      </tr>
                    </tbody>
                    <tfoot>
                    </tfoot>
                  </table>
                </div>
            </div>
            <form action="{{url('admin/tagihan/bayartagihanproses')}}" method="post">
              {{-- @php
                  echo $tagihan[0]->status;
              @endphp --}}
              @csrf
           @if (count($tagihan) != 0)
           @if ($tagihan[0]->status == "belum")
            <input type="hidden" value="{{$idpelanggan}}" name="id">
            <button type="submit" class="btn btn-success">Bayar Sekarang</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{url('/admin/tagihan/bayartagihan')}}';">Batal</button>
            @elseif($tagihan[0]->status == "proses")
              {{-- tagihan proses --}}
              <div class="card card-default">
              <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-bullhorn"></i>
                    Pembritahuan
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="callout callout-danger">
                    <h5>Transaksi sedang dalam proses pembayaran</h5>

                    <p>Cek pada menu <i>pelanggan</i> untuk mengecek status pembayaran</p>
                    <p style="color:red;">atau klik tombol dibawah ini untuk membatalkaan pembayaran via online</p>
                      <button type="button" class="btn btn-danger" onClick="batal({{$tagihan[0]->no_pembayaran}})" >Batalkan Transaksi !</button>
                  </div>
                </div>
            </div>
            @else
         
            @endif
            @else
            <div class="card-body">
              <div class="callout callout-danger">
                <h5>Tidak ada tagihan</h5>
              </div>
            </div>
            @endif
          </form>
        
        

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
<link rel="stylesheet" href="{{ URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<style type="text/css">
 .select2-container--default .select2-selection--single{
   height: 100%;
 }
</style>
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
  <script src=" {{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script type="text/javascript">
    $('.select2').select2();
    
    $('#mySelect').on('change', function() {
      var value = $(this).val();
      window.location.replace("{{url('/admin/tagihan/bayartagihan?no_pelanggan=')}}"+value);
    });

    function batal(id){
      window.location.href = '{{url('admin/transaksi/cancel')}}/'+id;
    }
  </script>
@endsection