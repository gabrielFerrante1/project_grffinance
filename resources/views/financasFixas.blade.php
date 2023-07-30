@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


<script src="/dist/winbox.bundle.js"></script>
<link rel="stylesheet" href="/dist/css/winbox.min.css">
<script src="/dist/js/winbox.min.js"></script>

  

@section('content')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
  
          <form class="form-group">
            <div class="row mt-2 pl-3 pr-5">
             
                <div  class="col-md-5">
                  <label>Título</label>
                  <input value="{{ $dados['titulo'] }}" type="search" class="form-control" name="titulo" />
                </div>

                <div  class="col-md-3">
                    <label>Categorias</label>
                    <select onchange="this.form.submit()" name="categoria" class="form-control form-control-md" id="exampleFormControlSelect3">
                      <option value="all">Todas categorias</option>
                        @foreach($fin2 as $o)
                          <option value="{{$o->id}}" <?php if(!empty($dados['categoria']) && $dados['categoria'] == $o->id) echo 'selected'; ?>>{{$o['name']}}</option>
                        @endforeach
                    </select>
                </div>

                  <div  class="col-md-3">
                    <label>Ordenar por</label>
                    <select onchange="this.form.submit()" name="ordena" class="form-control form-control-md" id="exampleFormControlSelect3">
                        <option  <?php if(!empty($dados['ordena']) && $dados['ordena'] == 'ir') echo 'selected'; ?> value="ir">Inclusão mais recente</option>
                        <option <?php if(!empty($dados['ordena']) && $dados['ordena'] == 'ia') echo 'selected'; ?> value="ia">Inclusão mais antiga</option> 
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

                <div  id="table" class="table-responsive">               
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
                          <th style="width:0">
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
                                <a href="/financa_fixa/edit/{{ $f->id }}"><button style="border-radius: 2px" class="btn btn-sm btn-primary">Editar</button></a>
                            
                            <button onclick="deleteFinancaFixa({{ $f->id }})" style="border-radius: 2px" class="btn btn-sm btn-danger">Excluir</button> 
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

           function deleteFinancaFixa(id) {
                var r = confirm("Deseja realmente excluir?");
                if (r == true) {
                 window.location.href = `/del-financa-fixa/${id}`
                }
           }
        </script>

@endsection