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
                  <p class="mb-4">Soma das receitas</p>
                  <p class="fs-30 mb-2">R$ {{$t}}</p>
                </div>
              </div>
            </div>

             <div class="col-md-4">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Média das receitas</p>
                  <p class="fs-30 mb-2">R$ {{$m}}</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Total de receitas</p>
                  <p class="fs-30 mb-2">{{count($fin)}}</p>
                </div>
              </div>
            </div>

          </div>
          
          <form class="form-group">
            <div class="row mt-2 pl-3 pr-5">
             
                <div  class="col-md-3">
                  <label>Título</label>
                  <input value="{{ $dados['titulo'] }}" type="search" class="form-control" name="titulo" />
                </div>

                <div  class="col-md-2">
                    <label>Contas</label>
                    <select onchange="this.form.submit()" name="conta" class="form-control form-control-md" id="exampleFormControlSelect3">
                      <option value="all">Todas contas</option>
                        @foreach($fin2 as $o)
                          <option value="{{$o->id}}" <?php if(!empty($dados['conta']) && $dados['conta'] == $o->id) echo 'selected'; ?>>{{$o['name']}}</option>
                        @endforeach
                    </select> 
                </div>
                    <div  class="col-md-2">
                        <label>Dias</label>
                        <select onchange="this.form.submit()" class="form-control" name="dia">
                            <option <?php if(!empty($dados['dia']) || $dados['dia'] == 'all') { echo 'selected'; } ?> value="all">Todos os dias</option>
                            <option <?php if($dados['dia'] == 1) { echo 'selected'; } ?> >1</option>
                            <option <?php if($dados['dia'] == '2') { echo 'selected'; } ?>>2</option>
                            <option <?php if($dados['dia'] == '3') { echo 'selected'; } ?>>3</option>
                            <option <?php if($dados['dia'] == '4') { echo 'selected'; } ?> >4</option>
                            <option <?php if($dados['dia'] == '5') { echo 'selected'; } ?> >5</option>
                            <option <?php if($dados['dia'] == '6') { echo 'selected'; } ?> >6</option>
                            <option <?php if($dados['dia'] == '7') { echo 'selected'; } ?> >7</option>
                            <option <?php if($dados['dia'] == '8') { echo 'selected'; } ?> >8</option>
                            <option <?php if($dados['dia'] == '9') { echo 'selected'; } ?> >9</option>
                            <option <?php if($dados['dia'] == '10') { echo 'selected'; } ?> >10</option>
                            <option <?php if($dados['dia'] == '11') { echo 'selected'; } ?> >11</option>
                            <option <?php if($dados['dia'] == '12') { echo 'selected'; } ?> >12</option>
                            <option <?php if($dados['dia'] == '13') { echo 'selected'; } ?> >13</option>
                            <option <?php if($dados['dia'] == '14') { echo 'selected'; } ?> >14</option>
                            <option <?php if($dados['dia'] == '15') { echo 'selected'; } ?> >15</option>
                            <option <?php if($dados['dia'] == '16') { echo 'selected'; } ?> >16</option>
                            <option <?php if($dados['dia'] == '17') { echo 'selected'; } ?> >17</option>
                            <option <?php if($dados['dia'] == '18') { echo 'selected'; } ?> >18</option>
                            <option <?php if($dados['dia'] == '19') { echo 'selected'; } ?> >19</option>
                            <option <?php if($dados['dia'] == '20') { echo 'selected'; } ?> >20</option>
                            <option <?php if($dados['dia'] == '21') { echo 'selected'; } ?> >21</option>
                            <option <?php if($dados['dia'] == '22') { echo 'selected'; } ?> >22</option>
                            <option <?php if($dados['dia'] == '23') { echo 'selected'; } ?> >23</option>
                            <option <?php if($dados['dia'] == '24') { echo 'selected'; } ?> >24</option>
                            <option <?php if($dados['dia'] == '25') { echo 'selected'; } ?> >25</option>
                            <option <?php if($dados['dia'] == '26') { echo 'selected'; } ?> >26</option>
                            <option <?php if($dados['dia'] == '27') { echo 'selected'; } ?> >27</option>
                            <option <?php if($dados['dia'] == '28') { echo 'selected'; } ?> >28</option>
                            <option <?php if($dados['dia'] == '29') { echo 'selected'; } ?> >29</option>
                            <option <?php if($dados['dia'] == '30') { echo 'selected'; } ?> >30</option>
                            <option <?php if($dados['dia'] == '31') { echo 'selected'; } ?> >31</option>
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
                            Conta
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
                            {{$f->conta}}
                          </td>
                          <td>
                           <?php $value_new = number_format($f->value, 2, ',', '.');  ?>
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
                            <a href="/receita/edit/{{ $f->id }}"><button style="border-radius: 2px" class="btn btn-sm btn-primary">Editar</button></a>

                            <a href="/del-receita/{{ $f->id }}"><button style="border-radius: 2px" class="btn btn-sm btn-danger">Excluir</button></a>
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