@extends('pelanggan/template')
@section('containerpelanggan')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <section class="col-lg-7 connectedSortable ui-sortable">
<div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Data diri</h3>
          </div>

            <div class="card-body">
              <div class="form-group">
              <label>NIK</label>
              <input type="text" class="form-control" value="{{$pelanggan[0]->ktp}}" disabled>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" value="{{$pelanggan[0]->nama}}" disabled>
            </div>
             <div class="form-group">
              <label>No HP / WA</label>
              <input type="text" class="form-control" value="{{$pelanggan[0]->no_hp}}" disabled>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" cols="30" rows="3" disabled>{{$pelanggan[0]->alamat}}</textarea>
            </div>
            <div class="form-group">
              <label>Paket</label>
               <input type="text" class="form-control" value="{{$pelanggan[0]->paket->nama}}" disabled>
            </div>
        </div>
      </section>
      <section class="col-lg-5 connectedSortable ui-sortable">
      <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Photo profil</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
           <form method="POST" action="{{url('pelanggan/profile/updatephoto')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              @if ($pelanggan[0]['photo'] == "")
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{url('dist/img/avatar.png')}}" alt="User Avatar">
              </div>
              @else
              <div class="widget-user-image">
                <img class="img-circle" style="height: 150px" src="{{asset('storage/'.$pelanggan[0]['photo'])}}" alt="User Avatar">
              </div>
              @endif
             
            <label>Foto</label>
            <div>
              <input class="form-control" name="foto" type="file" id="formFile">
            </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-warning">Update photo</button>
            </div>
          </form>

        </div> <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Ubah Password</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form method="post" action="{{url('pelanggan/profile/updatepassword')}}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Password lama</label>
                <div class="input-group input-group-sm">
                  <input id="input1" type="password" name="pass_old" class="form-control" placeholder="******">
                  <span class="input-group-append">
                    <button type="button" onclick="showPassword1()" class="btn btn-info btn-flat"><i id="icon1" class="fas fa-eye"></i></button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label>Password baru</label>
                <div class="input-group input-group-sm">
                  <input id="input2" type="password" name="pass_new" class="form-control" placeholder="******">
                  <span class="input-group-append">
                    <button type="button" onclick="showPassword2()" class="btn btn-info btn-flat"><i id="icon2" class="fas fa-eye"></i></button>
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-warning">Update password</button>
            </div>
          </form>
        </div>
      </section>          
      </div>
      
    </div>
  
</section>
@endsection
@section('js')
<script>
  function showPassword1(){
    var typ =$("#input1").prop("type");
    if(typ == "password"){
      $("#icon1").prop("class", "fas fa-eye-slash");
      $("#input1").prop("type", "text");
    }else{
      $("#icon1").prop("class", "fas fa-eye");
      $("#input1").prop("type", "password");
    }
  }

  function showPassword2(){
    var typ =$("#input2").prop("type");
    if(typ == "password"){
      $("#icon2").prop("class", "fas fa-eye-slash");
      $("#input2").prop("type", "text");
    }else{
      $("#icon2").prop("class", "fas fa-eye");
      $("#input2").prop("type", "password");
    }
  }
</script>
@endsection