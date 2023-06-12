@extends('admin/template')
@section('container')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profile {{session()->get('status')}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
            <li class="breadcrumb-item active">Data Profile</li>
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
            <div class="card col-md-5 " style="padding: 20px;">
              <div class="row">
              <div class="col-md-6">
                <h5 for="">Midtrans production</h5>
              </div>
              <div class="col-md-6">
                <label class="switch">
                  <input type="checkbox" @if ($pengaturan[0]['status'] == 1)
                      checked
                  @endif onclick="ubahSimulasi()">
                  <span class="slider round"></span>
                </label>
              </div>
              </div>
            </div>
        </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card col-md-5">
                <!-- /.card-header -->
                <form action="{{url('admin/profile/updateprofile')}}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="{{$user[0]['nama']}}" required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email"  value="{{$user[0]['email']}}" name="suplier"  required="">
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" name="no_hp" value="{{$user[0]['no_hp']}}" name="suplier"  required="">
                    </div>
                    <div class="form-group">
                        <label>Alamat </label>
                        <textarea  cols="30" rows="4" name="alamat" class="form-control">{{$user[0]['alamat']}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="margin-top: 10px" class="btn btn-warning">Update</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="card col-md-5"  style="margin-left: 10px">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <form method="POST" action="{{url('admin/profile/updatephoto')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="widget-user-image">
                           @if ($user[0]['photo'] == "")
                           <img class="img-circle elevation-2" style="width: 100px;" src="{{url('dist/img/avatar.png')}}" alt="User Avatar">
                           @else
                           <img class="img-circle elevation-2" style="width: 100px;" src="{{asset('storage').'/'.$user[0]['photo']}}" alt="User Avatar">
                           @endif
                            <input style="margin-top: 10px" class="form-control" name="foto" type="file" id="formFile">
                            <button style="margin-top: 10px" class="btn btn-warning">Update</button>
                        </div>
                        </form>
                    </div>
                    <hr>
                    <div class="form-group">
                        <form action="{{url('admin/profile/updatepassword')}}" method="POST">
                            @csrf
                           
                                <div class="form-group">
                                    <label>Password lama</label>
                                    <div class="input-group input-group-sm">
                                    <input id="input1" type="password" name="ps_lama" class="form-control" placeholder="******">
                                    <span class="input-group-append">
                                        <button type="button" onclick="showPassword1()" class="btn btn-info btn-flat"><i id="icon1" class="fas fa-eye"></i></button>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password baru</label>
                                    <div class="input-group input-group-sm">
                                    <input id="input2" type="password" name="ps_baru" class="form-control" placeholder="******">
                                    <span class="input-group-append">
                                        <button type="button" onclick="showPassword2()" class="btn btn-info btn-flat"><i id="icon2" class="fas fa-eye"></i></button>
                                    </span>
                                    </div>
                                </div>
                               
                            <button style="margin-top: 10px" class="btn btn-warning">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
@section('css')
<style>
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
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
  function ubahSimulasi(){
    window.location.href = "{{url('admin/profile/updatesimulasi/'.$pengaturan[0]['status'])}}";
  }
</script>
@endsection