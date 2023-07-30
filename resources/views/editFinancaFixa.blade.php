@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 style="margin-bottom: 30px" class="pl-1 text-primary font-weight-bold"><a class="text-primary" href="{{ route('financasFixas') }}" ><i style="font-size: 21.5px;margin-right:7px" class="fa-regular fa-arrow-left"></i></a> Editar uma despesa</h3>

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
                          <label for="1">Título</label>
                          <input name="titulo" value="{{ $data->title }}" type="text" class="form-control" id="1" placeholder="Titulo da despesa">
                        </div>
                        <div class="form-group">
                          <label for="2">Descrição</label>
                          <textarea name="descricao"  class="form-control" id="2"> {{$data->description}} </textarea>
                        </div>
                        <div class="form-group">
                          <label for="3">Categoria</label>
                          <select id="3" class="form-control" name="categoria">
                            @foreach ($categories as $item)
                                 <option <?php if($data->category == $item->id) {echo 'selected';}  ?> value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                          </select> 
                        </div>
                         <div class="form-group">
                          <label for="4">Valor</label>
                          <input name="preco"  value="{{ number_format($data->price, 2, ',', '.'); }}" type="text"   class="form-control" id="4">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Para onde a despesa vai</label>
                          <select class="form-control" name="status">
                              <option <?php if($data->status == 0) {echo 'selected';}  ?>  value="0" selected>Pendente</option>
                              <option <?php if($data->status  == 1) {echo 'selected';}  ?>  value="1">Paga</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Dia do vencimento (<span class="text-primary">A despesa será lançada todo mês neste dia</span>)</label>
                          <select class="form-control" name="dia">
                            @for ($i = 1; $i <= 31; $i++)
                              <option value="{{ $i }}" <?php if($data->day  == $i) { echo 'selected'; } ?>>{{$i}}</option>
                            @endfor 
                          </select>
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