@extends('pelanggan/template')
@section('containerpelanggan')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->

<!-- Main content -->
<section class="content">
  <div class="row">
          <!-- Left col -->
      <section class="col-lg-7 connectedSortable ui-sortable">
        {{-- kiri --}}

        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="callout callout-danger">
              <h5>Aplikasi Wifi Pembayaran Online</h5>
            <p> Aplikasi Billing atau Aplikasi Tagihan Internet berbasis web yang berfungsi untuk mengelola data pelanggan, mengatur layanan pelanggan, membuat tagihan / invoice, melihat report keuangan, riwayat tagihan pelanggan dan masih banyak fitur lainnya.</p>

            </div>
          </div>
      </div>
        <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
            Data transaksi
          </h3>
        </div>
      
      <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No transaksi</th>
          <th>Bulan</th>
          <th>keterangan</th>
        </tr>
        </thead>
        <tbody>
          
          @if (count($tagihan) == 0)
            <tr>
              <td colspan="3">Data kosong</td>
            </tr>
          @endif
          @foreach ($tagihan as $item)
          <tr>
            <td>{{$item->no_tagihan}}</td>
            <td>{{Carbon\Carbon::parse($item->tgl_tagihan)->translatedFormat('F Y')}}</td>
            <td>
                <span class="badge badge-success">Sukses</span>
            </td>
          </tr>
          @endforeach
        
        </tbody>
      </table>
      </div>
        </div>
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable ui-sortable">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{count($jatuh)}}</h3>

                    <p>Tagihan belum bayar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer"
                    >More info <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{count($tagihan)}}</h3>

                    <p>Pembayaran berhasil</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer"
                    >More info <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
            </div>
          </div>
      </section>
      <!-- right col -->
    </div>
  </section>

@endsection
@section('js')

@endsection
@section('css')
  
@endsection