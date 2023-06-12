@extends('admin/template')
@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
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
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$pelanggan}}</h3>

            <p>Pelanggan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$belum}}</h3>

            <p>Jatuh Tempo</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$sudah->count()}}</h3>

            <p>Sudah Bayar</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$ttl}}</h3>

            <p>Transaksi Bulan ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
     <div class="row">
          <!-- Left col -->
    <section class="col-lg-7 connectedSortable ui-sortable">
      {{-- kiri --}}

      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
          Aplikasi Wifi Pembayaran Online
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="callout callout-danger">
            <p> Aplikasi Billing atau Aplikasi Tagihan Internet berbasis web yang berfungsi untuk mengelola data pelanggan, mengatur layanan pelanggan, membuat tagihan / invoice, melihat report keuangan, riwayat tagihan pelanggan dan masih banyak fitur lainnya.</p>
          </div>
        </div>
    </div>
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Transaksi Pembayaran </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No Transaksi</th>
              <th>Pelanggan</th>
              <th>Total Transaksi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($sudah->limit(5)->get() as $items)
              <tr>
                <td>{{ $items->no_tagihan }}</td>
                <td>{{ $items->pelanggan->nama }}</td>
                <td>{{ $items->ttl_byr }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable ui-sortable">

      <!-- Calendar -->

      <!-- /.card -->
    </section>
    <!-- right col -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection