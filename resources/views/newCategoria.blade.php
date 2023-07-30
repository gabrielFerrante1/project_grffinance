@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 style="margin-bottom: 30px" class="pl-1 text-primary font-weight-bold"><i style="font-size: 21.5px" class="fa-regular fa-grid-2-plus"></i> - Criar nova categoria</h3>

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

                    <h5>{{session('success')}}</h5> 
                @endcomponent  
            @endif

            @if(session('error'))
            @component('components.Alert')
                @slot('type')
                danger
                @endslot
 
                <h5>{{session('error')}}</h5> 
            @endcomponent  
        @endif

          <div class="row"> 
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"> 
                    <form method="POST" class="forms-sample">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Nome</label>
                        <input name="nome" value="{{ old('nome') }}" type="text" class="form-control" id="exampleInputUsername1" placeholder="Nome da categoria">
                      </div>  
                      <div class="form-group">
                        <label for="exampleInputPassword1">
                            Token para importação
                            <button type="button" style="background: none;border:none;outline:none;font-size:17px" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-circle-question"></i></button>
                        </label>
                        <input name="token" value="{{ old('token') }}" type="text" class="form-control" id="exampleInputUsername1">
                      </div> 
                      <button type="submit" class="btn btn-primary mr-2">Criar</button>
                    </form>
                  </div>
                </div>
            </div> 

          </div>
        </div>
    </div>

  
    @component('components.Modal')
        @slot('dataTitle')
          Sobre o token de importação
        @endslot
  
        @slot('dataText')
          Quando você cria uma categoria e cria um token de importação para ela, você pode utilizar o token na sua tabela de excel na coluna de <span class="text-primary">categoria</span>,
          dessa forma quando você importar sua tabela para o nosso sistema o token será lido e substituído pela categoria em si.
        @endslot
    @endcomponent
@endsection