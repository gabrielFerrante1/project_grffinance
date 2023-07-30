@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

<script src="/dist/winbox.bundle.js"></script>
<link rel="stylesheet" href="/dist/css/winbox.min.css">
<script src="/dist/js/winbox.min.js"></script>

 
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
            <!--Sucesso-->
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
                  <div  class="col-md-6">
                    <label>Nome</label>
                    <input value="{{ $dados['nome'] }}" type="search" class="form-control" name="nome" />
                  </div>
                  
                  <div  class="col-md-3">
                    <label>Token</label>
                    <input value="{{ $dados['token'] }}" type="search" class="form-control" name="token" />
                  </div>
                  
                  <div  class="col-md-2">
                    <label>Ordenar por</label>
                    <select onchange="this.form.submit()" name="data" class="form-control form-control-md" id="exampleFormControlSelect3">
                        <option  <?php if(!empty($dados['data']) && $dados['data'] == 'desc') echo 'selected'; ?>  value="desc">Data mais recente</option>
                        <option <?php if(!empty($dados['data']) && $dados['data'] == 'asc') echo 'selected'; ?>  value="asc">Data mais antiga</option> 
                      </select>
                  </div>

                  <div class="col-md-1">
                    <button style="margin-top: 31px" class=" btn btn-primary">Procurar</button>
                  </div>
            </div>
          </form>
      
           
              <div class="col-sm-12 " style="margin-top: 40px"> 
                <div id="table" class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Nome
                          </th>
                          <th>
                            Token de importação
                          </th>
                          <th  style="width:0">
                            Despesas nessa categoria
                          </th>  
                          <th style="width:0">
                            Ações
                          </th> 
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($query as $key => $value)
                        <tr >
                          <td>
                           <?php if(strlen($value->name) > 40) {
                                echo substr($value->name, 0, 40).'...';
                            } else {
                                echo $value->name;
                            }?>
                          </td>
                          <td>
                            {{$value->token}}
                          </td>
                          <td>
                            {{$value->count_financas}}
                          </td>
                          <td >
                            <a href="/categoria/edit/{{$value->id}}"><button style="border-radius: 2px" class="btn btn-sm btn-primary" >Editar</button></a>

                            <a onclick="setDel({{$value->id}}, {{$value->count_financas}})" data-bs-toggle="modal" data-bs-target="#exampleModal" href="/trash/{{ $value->id }}?link={{url()->full()}}"><button style="border-radius: 2px" class="btn btn-sm btn-danger">Excluir</button></a>
                          </td>
                        </tr>
                      
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="row mt-4">
                    <div class="col-md-12">
                        {{$query->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
          </div> 

         

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deseja mesmo excluir essa categoria?</h5>
                <button type="button" style="background:none;border:none" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
              </div>
              <div id="modalText" class="modal-body"> 
              </div> 
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <a id="actionUrl"><button type="button" class="btn btn-primary">Excluir</button></a>
                </div> 
            </div>
          </div>
        </div>

        <script>
            $(function() {
                $('.a').hide();
            });

           function setDel (id, countFinancas) {
            document.getElementById('actionUrl').href = `/del-categoria/${id}`;

            if(countFinancas > 0) {
              document.getElementById('actionUrl').style.display = 'none';

              document.getElementById('modalText').style.display = 'block';
              document.getElementById('modalText').innerHTML = 'Para excluir essa categoria primeiro é necessário que você a remova de todas as finanças associdas a ela de todas as áreas *Despesas pagas / Pendentes e Lixeira. <span style="margin-top:5px;display:block"> Existe '+countFinancas+' finança(s) associada(s) a esta categoria </span>';

            } else {
              document.getElementById('actionUrl').style.display = 'block';
              
              document.getElementById('modalText').style.display = 'none';
            }
           } 
        </script>

        
@endsection