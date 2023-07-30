@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 style="margin-bottom: 30px" class="pl-1 text-primary font-weight-bold"><a class="text-primary" href="/contas" ><i style="font-size: 21.5px;margin-right:7px" class="fa-regular fa-arrow-left"></i></a> Editar uma conta</h3>

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
                        <input name="nome" value="{{ $data['name'] }}" type="text" class="form-control" id="exampleInputUsername1" placeholder="Nome da categoria">
                      </div>
                       <div class="form-group">
                        <label for="exampleInputUsername1">Descrição</label>
                        <textarea name="descricao" class="form-control" id="exampleInputUsername1">{{ $data['description'] }}</textarea>

                      </div>  
                      <button type="submit" class="btn btn-primary mr-2">Editar</button>
                    </form>
                  </div>
                </div>
            </div> 

          </div>
        </div>
    </div>

   
@endsection