

@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
              <!--Erro-->
              @if($errors->any())
              <div class="alert alert-danger">
                      @foreach($errors->all() as $e)
                          <h5>{{$e}}</h5>
                      @endforeach
               </div>
            @endif

              <!--Sucesso-->
              @if(session('success'))
              <div class="alert alert-success">
                          <h5>{{session('success')}}</h5>
               </div>
            @endif
          <div class="row">
            <h3 style="margin-bottom: 40px" class="pl-4   font-weight-bold text-primary"><i class="icon-cloud-download"></i> - Exportar suas despesas </h3>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"> 
                    <span class="mt-2">Gerar arquivo XLSX: </span> <a href="/despesa/exportacao/xlsx"><button class="btn btn-sm btn-primary">Gerar arquivo</button></a>

                    <hr>

                    <span>Gerar arquivo CSV: </span> <a  href="/despesa/exportacao/csv"><button class="btn btn-sm btn-primary">Gerar arquivo</button></a>
                  </div>
                </div>
              </div> 
          </div>


        </div></div></div> 
@endsection