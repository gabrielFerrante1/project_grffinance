
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Grf - Finanças pessoais</title>
<!-- plugins:css -->
<link rel="stylesheet" href="/vendors/feather/feather.css">
<link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="/css/vertical-layout-light/style.css">
<!-- endinject -->
<link rel="shortcut icon" href="/images/favicon.png" />


<div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left py-5 px-4 px-sm-5">

        <h3 class="text-center">Faça login</h3>
          @if(session('erro-cred'))
            <div class="alert alert-danger">
              <h5>{{session('erro-cred')}}</h5>
            </div>
         @endif

         @if(session('password'))
         <div class="alert alert-danger">
           <h5>{{session('password')}}</h5>
         </div>
       @endif

        <form  method="POST" action="{{ route('login') }}" class="pt-3">
            @csrf
          <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}"  class="form-control form-control-lg @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
            @enderror

          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Senha">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Entrar</button>
          </div>
          <div class="mt-4 text-center">
      
            <a class="text-black mt-1"  href="{{ route('signup') }}">
                Não tem conta? Criar
            </a> 
        </div>
        </form>
      </div>
    </div>
  </div>

