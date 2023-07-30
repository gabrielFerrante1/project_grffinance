@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 style="margin-bottom: 30px" class="pl-1 text-primary font-weight-bold"><i style="font-size: 21.5px" class="fa-solid fa-envelope-open-dollar"></i> - Adicionar nova conta</h3>

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
          <div class="row">
             
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"> 
                    <form method="POST" class="forms-sample">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Nome</label>
                        <input name="nome" value="{{ old('nome') }}" type="text" class="form-control" id="exampleInputUsername1" placeholder="Ex: Banco do Brasil, Cielo e etc">
                      </div> 
                       <div class="form-group">
                        <label for="exampleInputPassword1">Descrição *opcional</label>
                        <textarea name="descricao" type="text" class="form-control" id="exampleInputPassword1">{{ old('descricao') }}</textarea>
                      </div> 
                      <button type="submit" class="btn btn-primary mr-2">Adicionar</button>
                    </form>
                  </div>
                </div>
              </div>  

          </div>
@endsection