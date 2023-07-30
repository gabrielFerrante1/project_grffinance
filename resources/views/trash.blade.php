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
            <div class="d-flex">
             <h3 style="margin-bottom: 30px;flex:1" class="pl-3 font-weight-bold text-primary"><i style="font-size: 21.5px" class="fa-regular fa-trash-can "></i> - Lixeira das despesas </h3>
                
             @if(count($fin) >= 1 || isset($_GET['titulo'])) 
                <div  >
                    <button type="button"   data-bs-toggle="modal" data-bs-target="#exampleModal" style="align-self: center;padding:8px 14px;font-size:13px"  class="btn btn-outline-primary">Esvaziar a lixeira</button>
                </div>
             @endif
            </div>
            

            @if(count($fin) >= 1 || isset($_GET['titulo'])) 
                <section>
                    <form class="form-group">
                        <div class="row mt-2 pl-3 pr-5">
                        
                            <div  class="col-md-3">
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

                            <div  class="col-md-2">
                                <label>Status</label>
                                <select onchange="this.form.submit()" name="status" class="form-control form-control-md" id="exampleFormControlSelect3">
                                <option <?php if(!empty($dados['status']) && $dados['status'] == 'all') echo 'selected'; ?> value="all">Todos os status</option> 
                                <option <?php if(!empty($dados['status']) && $dados['status'] == 'pe') echo 'selected'; ?> value="pe">Pendente</option>
                                <option <?php if(!empty($dados['status']) && $dados['status'] == 'pa') echo 'selected'; ?> value="pa">Pago</option>
                        
                                </select> 
                            </div>

                            <div  class="col-md-1">
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
                                <th >
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
                                <th>
                                    Status
                                </th>
                                <th style="width:0">
                                    Ações
                                </th> 
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($fin as $key => $f)
                                <tr>
                                <td style="width:0">
                                    {{substr($f->title, 0, 30).'...'}}
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
                                <td >
                                    {{$f->year}}
                                </td>
                                <td >
                                    @if($f->status)
                                    Pago
                                    @else
                                    Pendente
                                    @endif
                                </td>
                                <td > 
                                    <a href="/trash/{{ $f->id }}?link={{url()->full()}}"><button type="button" style="border-radius: 2px"   class="btn btn-sm btn-success">Recuperar</button></a>
                                </td>
                                
                                </tr>

                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </section> 
            @else 
                <p class="text-secondary text-center">Não há nehuma despesa excluída! <br /> Quando excluir uma despesa ela aparecerá aqui. </p>
            @endif
        </div>
     
        <script>
            $(function() {
                $('.a').hide();
            }); 
            function leftScroll() {
             
              document.getElementById('table').scrollLeft += 110;
            }

            function rightScroll() {
             
             document.getElementById('table').scrollLeft -= 110;
           }
        </script>

        @component('components.Modal') 
            @slot('dataTitle')
            Alerta
            @endslot

            @slot('dataText') 
                     Deseja mesmo esvaziar a lixeira? <br/>
                     Esta ação é <span class="text-danger">irreversível</span>
            @endslot

            @slot('actionText') Esvaziar @endslot
            @slot('actionUrl')
            /del-all-trash
            @endslot 
        @endcomponent
@endsection