

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
                @component('components.Alert')
                  @slot('type')
                  danger
                  @endslot
        
                  @foreach($errors->all() as $e) 
                    <h5>{{$e}}</h5>
                  @endforeach
                @endcomponent  
              @endif

              <!--Sucesso-->
              @if(session('success'))
                @component('components.Alert')
                  @slot('type')
                  success
                  @endslot
          
                  <h5 style="margin-top: 10px">{{session('success')}}</h5> 

                  @if(session('success-count'))
                    <hr />

                    <h5>
                      <strong>{{session('success-count')}}</strong> 
                        @if(session('success-count') === 1) 
                          nova despesa adicionada
                        @else 
                          novas despesas adicionadas
                        @endif
                    </h5>
                  @endif
                @endcomponent 
              @endif
 
                   <!--Sucesso-->
              @if(session('error'))
              @component('components.Alert')
                @slot('type')
                danger
                @endslot
        
                <h5 style="margin-top: 10px">{{session('error')}}</h5>
              @endcomponent 
            @endif
          <div class="row">
            <h3 style="margin-bottom: 40px"  class="pl-4  font-weight-bold text-primary"><i class="icon-cloud-upload"></i> - Importe sua planilha do excel </h3>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"> 
                    <form method="POST" enctype="multipart/form-data"class="forms-sample">
                        @csrf
                      <div class="form-group">
                        <h4 style="font-weight: 600">Regras</h4>
                        <ul>
                            <li>A coluna titulo é <span class="text-danger">obrigátoria</span></li>
                            <li>A coluna categoria é <span class="text-danger">obrigátoria</span></li>
                            <li>A coluna descrição é <span class="text-primary">opcional</span></li>
                            <li>A coluna dia é <span class="text-danger">obrigátoria</span></li>
                            <li>A coluna mes é <span class="text-danger">obrigátoria</span></li>
                            <li>A coluna ano é <span class="text-danger">obrigátoria</span></li>
                            <li>A coluna status é <span class="text-primary">opcional</span></li>
                            <li>Os nomes das colunas <span class="text-danger">não</span> devem conter acentos</li>
                            <button type="button" class="mt-1 mb-2 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Exemplo
                            </button>
                            
            
                        </ul>
                        <input name="file"  type="file" class="form-control file-upload-info " id="exampleInputUsername1">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Importar</button>
                    </form>
                  </div>
                </div>
              </div> 
          </div>
 
        </div> 

        @component('components.Modal')
          @slot('typeModal') modal-xl @endslot
        
          @slot('dataTitle')
          Planilha de exemplo:
          @endslot
    
          @slot('dataText')
            <span style="display: block" class="mb-2">
                <div>
                  Na coluna <span class="text-primary">categoria</span> você pode usar um token de importação da categoria que quiser, 
                  mas caso o token de importação não for achado em nenhuma das suas categorias será criado uma nova categoria automaticamente <br />
                </div>

                <div style="margin: 10px 0px 4px 0">
                  A coluna status só pode ter o valor de <span class="text-danger">Pendente</span> ou <span class="text-primary">Pago</span></span> você pode também deixar ela vazia desta forma será classificada como pendente
                </div> 
            <img class="img-fluid" src="{{ asset('img/e.jpg') }}" />
          @endslot
        @endcomponent
@endsection