@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 style="margin-bottom: 30px" class="pl-1 text-primary font-weight-bold"><a class="text-primary" href="/rcts" ><i style="font-size: 21.5px;margin-right:7px" class="fa-regular fa-arrow-left"></i></a> Editar uma conta</h3>

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
                        <input name="nome" value="{{ $data['title'] }}" type="text" class="form-control" id="exampleInputUsername1">
                      </div>
                       <div class="form-group">
                        <label for="exampleInputUsername1">Descrição</label>
                        <textarea name="descricao" class="form-control" id="exampleInputUsername1">{{ $data['description'] }}</textarea>
                      </div>
                       <div class="form-group">
                            <label for="exampleInputPassword312">De que conta a receita é</label>
                        
                            <select name="conta" class="form-control" >
                                @foreach($contas as $conta)
                                    <option @if($data['receita_conta_id'] == $conta->id) selected @endif value="{{$conta->id}}">{{$conta->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input name="valor"  value="{{ number_format($data['value'], 2, ',', '.') }}" type="text" placeholder="Ex: 190,90" class="form-control">
                        </div>
                        <div class="form-group">
                        <label>Dia</label>
                        <select class="form-control" name="dia">
                            <option <?php if($data['day'] == 1) { echo 'selected'; } ?> >1</option>
                            <option <?php if($data['day'] == '2') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?>>2</option>
                            <option <?php if($data['day'] == '3') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?>>3</option>
                            <option <?php if($data['day'] == '4') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >4</option>
                            <option <?php if($data['day'] == '5') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >5</option>
                            <option <?php if($data['day'] == '6') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >6</option>
                            <option <?php if($data['day'] == '7') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >7</option>
                            <option <?php if($data['day'] == '8') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >8</option>
                            <option <?php if($data['day'] == '9') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >9</option>
                            <option <?php if($data['day'] == '10') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >10</option>
                            <option <?php if($data['day'] == '11') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >11</option>
                            <option <?php if($data['day'] == '12') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >12</option>
                            <option <?php if($data['day'] == '13') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >13</option>
                            <option <?php if($data['day'] == '14') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >14</option>
                            <option <?php if($data['day'] == '15') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >15</option>
                            <option <?php if($data['day'] == '16') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >16</option>
                            <option <?php if($data['day'] == '17') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >17</option>
                            <option <?php if($data['day'] == '18') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >18</option>
                            <option <?php if($data['day'] == '19') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >19</option>
                            <option <?php if($data['day'] == '20') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >20</option>
                            <option <?php if($data['day'] == '21') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >21</option>
                            <option <?php if($data['day'] == '22') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >22</option>
                            <option <?php if($data['day'] == '23') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >23</option>
                            <option <?php if($data['day'] == '24') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >24</option>
                            <option <?php if($data['day'] == '25') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >25</option>
                            <option <?php if($data['day'] == '26') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >26</option>
                            <option <?php if($data['day'] == '27') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >27</option>
                            <option <?php if($data['day'] == '28') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >28</option>
                            <option <?php if($data['day'] == '29') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >29</option>
                            <option <?php if($data['day'] == '30') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >30</option>
                            <option <?php if($data['day'] == '31') { echo 'selected'; } else if(!$data['day']) { echo 'selected'; } ?> >31</option>
                        </select>
                      </div> 
                        <div class="form-group">
                        <label>Mês</label>
                        <select class="form-control" name="mes">
                            <option <?php $month = date('m'); if($data['month'] == '1') { echo 'selected'; } else if(!$data['month'] && $month == 1) { echo 'selected'; } ?> value="1">Janeiro</option>
                            <option <?php if($data['month'] == '2') { echo 'selected'; } else if(!$data['month'] && $month == 2) { echo 'selected'; } ?> value="2">Fevereiro</option>
                            <option <?php if($data['month'] == '3') { echo 'selected'; } else if(!$data['month'] && $month == 3) { echo 'selected'; } ?> value="3">Março</option>
                            <option <?php if($data['month'] == '4') { echo 'selected'; } else if(!$data['month'] && $month == 4) { echo 'selected'; } ?> value="4">Abril</option>
                            <option <?php if($data['month'] == '5') { echo 'selected'; } else if(!$data['month'] && $month == 5) { echo 'selected'; } ?> value="5">Maio</option>
                            <option <?php if($data['month'] == '6') { echo 'selected'; } else if(!$data['month'] && $month == 6) { echo 'selected'; } ?> value="6">Junho</option>
                            <option <?php if($data['month'] == '7') { echo 'selected'; } else if(!$data['month'] && $month == 7) { echo 'selected'; } ?> value="7">Julho</option>
                            <option <?php if($data['month'] == '8') { echo 'selected'; } else if(!$data['month'] && $month == 8) { echo 'selected'; } ?> value="8">Agosto</option>
                            <option <?php if($data['month'] == '9') { echo 'selected'; } else if(!$data['month'] && $month == 9) { echo 'selected'; } ?> value="9">Setembro</option>
                            <option <?php if($data['month'] == '10') { echo 'selected'; } else if(!$data['month'] && $month == 10) { echo 'selected'; } ?> value="10">Outubro</option>
                            <option <?php if($data['month'] == '11') { echo 'selected'; } else if(!$data['month'] && $month == 11) { echo 'selected'; } ?> value="11">Novembro</option>
                            <option <?php if($data['month'] == '12') { echo 'selected'; } else if(!$data['month'] && $month == 12) { echo 'selected'; } ?> value="12">Dezembro</option>
                        </select>
                      </div>
                      <div class="form-group"> 
                        <label>Ano</label>
                        <select class="form-control" name="ano"> 
                            <?php $year = date('Y'); for ($i=2021; $i <=  $year ; $i++) { ?>
                              <option  <?php if($data['year'] == $i) { echo 'selected'; } else if(!$data['year'] && $year == $i) { echo 'selected'; } ?> value="{{ $i }}">{{ $i }}</option>
                            <?php } ?> 
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