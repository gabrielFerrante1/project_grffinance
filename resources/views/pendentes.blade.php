@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')
 
     <style>
       .h {
          color: rgb(128, 128, 128);
          font-weight: 500;
          float: right;
       }
       .h_2 { 
         color: rgb(128, 128, 128);
          font-weight: 500;
          float: left;
       }
     </style>

     <div class="main-panel">
        <div class="content-wrapper">
          @if(session('success'))
            @component('components.Alert')
                @slot('type')
                success
                @endslot

                <h5>{{session('success')}}</h5> 
            @endcomponent  
          @endif

          <div class="row mb-4 pl-3 pr-3">

            <div class="col-md-4">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Soma das despesas</p>
                  <p class="fs-30 mb-2">R$ {{$t}}</p>
                </div>
              </div>
            </div>

             <div class="col-md-4">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Média das despesas</p>
                  <p class="fs-30 mb-2">R$ {{$m}}</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Total de despesas</p>
                  <p class="fs-30 mb-2">{{count($fin)}}</p>
                </div>
              </div>
            </div>

          </div>
          
          <form class="form-group">
            <div class="row mt-2 pl-3 pr-5">
             
                <div  class="col-md-5">
                  <label>Título</label>
                  <input value="{{ $dados['titulo'] }}" type="search" class="form-control" name="titulo" />
                </div>

                <div  class="col-md-2">
                    <label>Categorias</label>
                    <select onchange="this.form.submit()" name="categoria" class="form-control form-control-md" id="exampleFormControlSelect3">
                      <option value="all">Todas categorias</option>
                        @foreach($fin2 as $o)
                          <option value="{{$o->id}}" <?php if(!empty($dados['categoria']) && $dados['categoria'] == $o->id) echo 'selected'; ?>>{{$o['name']}}</option>
                        @endforeach
                    </select> 
                </div>
              
                <div  class="col-md-2">
                  <label>Meses</label>
                  <select onchange="this.form.submit()" name="mes" class="form-control form-control-md" id="exampleFormControlSelect3">
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '') echo 'selected'; ?> value="all">Todas os meses</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '1') echo 'selected'; ?>  value="1">Janeiro</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '2') echo 'selected'; ?>  value="2">Fevereiro</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '3') echo 'selected'; ?>  value="3">Março</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '4') echo 'selected'; ?>  value="4">Abril</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '5') echo 'selected'; ?>  value="5">Maio</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '6') echo 'selected'; ?>  value="6">Junho</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '7') echo 'selected'; ?>  value="7">Julho</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '8') echo 'selected'; ?>  value="8">Agosto</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '9') echo 'selected'; ?>  value="9">Setembro</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '10') echo 'selected'; ?>  value="10">Outubro</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '11') echo 'selected'; ?>  value="11">Novembro</option>
                    <option <?php if(!empty($dados['mes']) && $dados['mes'] == '12') echo 'selected'; ?>  value="12">Dezembro</option>
                  </select>
                </div>

                  <div  class="col-md-2">
                    <label>Anos</label>
                    <select onchange="this.form.submit()" name="ano" class="form-control form-control-md" id="exampleFormControlSelect3">
                      <option <?php if(!empty($dados['ano']) && $dados['ano'] == 'all') echo 'selected'; ?> value="all">Todos os anos</option>
                      <?php $y = date('Y'); for ($i=2021; $i <=  $y ; $i++) { ?>
                          <option <?php if(!empty($dados['ano']) && $dados['ano'] == $i) echo 'selected'; ?> value="{{ $i }}">{{ $i }}</option>
                        <?php } ?> 
              
                    </select> 
                  </div>

                  <div class="col-md-1">
                    <button style="margin-top: 31px" class=" btn btn-primary">Procurar</button>
                  </div>
            </div>
          </form>
      
           
              <div class="col-sm-12">

                <div onclick="rightScroll()"  class="bg-primary p-2" style="float:left">
                  <i style="font-size: 24px;color:white;margin-left:5px" class="fas fa-chevron-left"></i>
                </div>
                <div onclick="leftScroll()"  class="bg-primary  p-2" style="float:right">
                  <i style="font-size: 24px;color:white;margin-left:5px" class="fas fa-chevron-right"></i>
                </div> 
                

                <div id="table" class="table-responsive ">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Título
                          </th>
                          <th>
                            Categoria
                          </th> 
                          <th>
                            Valor
                          </th>
                          <th>
                            Dia
                          </th>
                          <th>
                            Mês
                          </th>
                          <th>
                            Ano
                          </th>
                          <th  style="width:0">
                            Ações
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                          @foreach($fin as $key => $f)
                        <tr>
                          <td>
                            {{$f->title}}
                          </td>
                          <td>
                            {{$f->category}}
                          </td> 
                          <td>
                           <?php $value_new = number_format($f->price, 2, ',', '.');  ?>
                            R$ {{$value_new}}
                          </td>
                          <td>
                            {{$f->day}}
                          </td>
                          <td>
                            {{$f->month}}
                          </td>
                          <td>
                            {{$f->year}}
                          </td>
                          <td>
                            <a href="/status/despesa/{{ $f->id }}?status=1"><button style="border-radius: 2px" class="btn btn-sm btn-success">Altrerar para pago</button></a>
                          
                            <a href="/financa/edit/{{ $f->id }}?link={{ url()->current() }}"><button style="border-radius: 2px" class="btn btn-sm btn-primary">Editar</button></a>

                            <a href="/trash/{{ $f->id }}?link={{url()->current()}}"><button style="border-radius: 2px" class="btn btn-sm btn-danger">Excluir</button></a>
                          </td>
                         
                        </tr>

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-12">
                        {{$fin->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
          </div></div>
        
       <style>
         .ti-grf {
           font-size: 19px;
           color: blueviolet;
           font-weight: 600;
           font-family: Arial, Helvetica, sans-serif;
           display: inline;
         }
       </style>
        <script> 

            function leftScroll() {
             
             document.getElementById('table').scrollLeft += 180;
           }

           function rightScroll() {
            
            document.getElementById('table').scrollLeft -= 180;
          }
        </script>

@endsection