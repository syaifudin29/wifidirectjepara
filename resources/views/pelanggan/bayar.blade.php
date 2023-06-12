@extends('pelanggan/template')
@section('containerpelanggan')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Bayar Tagihan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Bayar</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
   <div class="col-md-6">
    @if ($tampilan == "sukses")
        
    
    {{-- tidak ada tagihan --}}
    <div class="card">
      <div class="card-header bg-info" >
        <h5>Data Tagihan</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
     <p><b><i>* Belum ada tagihan</i></b></p>
      </div>
    </div>
    @elseif($tampilan == "belum")
    {{-- bayar --}}
    <div class="card">
      <div class="card-header bg-danger" >
        <h5>Data Tagihan</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama" value="{{$pelanggan[0]['nama']}}" disabled>
        </div>
        <hr>
        <h6 class="bg-secondary" style="padding: 10px">Jumlah tagihan :</h6>
        <table class="table">
          <thead>
            <th>Bulan</th>
            <th>Jumlah</th>
            <th>Denda</th>
          </thead>
          <tbody>
            @php
                $jum=0;
                $jum1=0;
            @endphp
            @foreach ($tagihan as $item)
            @php
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
            </tr>
            @endforeach
          </tbody>
        </table>
        <hr>
        <h6>Jumlah yang harus di bayar : </h6>
       <h5> <b>Rp {{number_format($jum1,0,',','.')}}</b></h5>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button class="btn btn-danger float-right" id="pay-button">Bayar sekarang</button>
      </div>
      <!-- /.card-footer-->
    </div>
    @else
    {{-- proses --}}
    <div class="card">
      <div class="card-header bg-warning" >
        <h5><i>*Proses pembayaran</i></h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <label>No Transaksi</label>
          <input type="text" class="form-control" name="nama" value="{{$status->order_id}}" disabled>
        </div>
        <div class="form-group">
          <label>Jumlah tagihan</label>
          <input type="text" class="form-control" name="nama" value="{{$status->gross_amount}}" disabled>
        </div>
        <div class="form-group">
          <label>Metode</label>
          @if ($status->payment_type == 'bank_transfer')
              @if (isset($status->permata_va_number) != 0)
              <h5 style="color: red; text-transform: uppercase;"><b>VA BANK Permata : {{$status->permata_va_number}}</b></h5>
              @else
              <h5 style="color: red; text-transform: uppercase;"><b>VA BANK {{$status->va_numbers[0]->bank}} : {{$status->va_numbers[0]->va_number}}</b></h5>
              @endif
          {{-- @elseif() --}}
          @elseif($status->payment_type == 'qris')
            <h5>QRIS / Shoope pay / E - wallet</h5>
             {!! QrCode::size(100)->generate($status->signature_key); !!}
          @elseif($status->store == 'alfamart')
            pembayaran melalui <b>Alfamart / Alfamidi </b> terdekat :
             <h3 style="color: red; text-transform: uppercase;">{{$status->payment_code}}</b></h3>
          @elseif($status->store == 'indomaret')
         pembayaran melalui <b>Indomart</b> terdekat :
             <h3 style="color: red; text-transform: uppercase;">{{$status->payment_code}}</b></h3>
          @endif
        </div>
        <p><i>*Silahkan melakukan pembayaran sesuai jumlah tagihan  <b>Rp. {{$status->gross_amount}}</b></i> dengan metode yang dipilih.</p>
         <a href="{{url('pelanggan/transaksi/cancel/'.$status->order_id)}}" class="btn btn-danger">Batalkan transaksi</a>
      </div>

    </div>
 
    @endif
    </div>
  </div>
</section>
    @endsection
    @section('metaatas')
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
      <script type="text/javascript"
      @isset($pengaturan[0]['status'])
          
    
      @if ($pengaturan[0]['status'] == 1)
        src="{{env('P_URL_MIDTRANS')}}"
        data-client-key="{{env('P_MIDTRANS_SERVER_KEY')}}"
      @else
        src="{{env('URL_MIDTRANS')}}"
        data-client-key="{{env('MIDTRANS_SERVER_KEY')}}"
      @endif

      @endisset
      >
      </script>
      <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    @endsection
    @section('js')
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            window.location.href = '{{url('pelanggan/updatetagihan/'.$order_id.'/sukses')}}';
          },
          onPending: function(result){
            /* You may add your own implementation here */
            window.location.href = '{{url('pelanggan/updatetagihan/'.$order_id.'/proses')}}';
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment '+{{$order_id}});
          }
        })
      });
    
    </script>
    @endsection