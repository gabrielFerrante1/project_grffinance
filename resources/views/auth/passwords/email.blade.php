
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

        <h3 class="text-center">Esqueci minha senha</h3>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            Email enviado com sucesso!
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="pt-3">
            @csrf
          <div class="form-group">
            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>Não há nenhum usuário com este email</strong>
                </span>
            @enderror
        </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Enviar email</button>
          </div>
        </form>
      </div>
    </div>
  </div>

