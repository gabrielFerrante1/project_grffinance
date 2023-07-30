@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 style="margin-bottom: 30px" class="pl-1 text-primary font-weight-bold"><i style="font-size: 21.5px" class="fa-solid fa-envelope-open-dollar"></i> - Adicionar nova receita</h3>

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
              @if(session('error')) 
                @component('components.Alert')
                  @slot('type')
                  danger
                  @endslot 
                  
                  <h5>{{session('error')}}</h5> 
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
                            <input name="nome" value="{{ old('nome') }}" type="text" class="form-control" id="exampleInputUsername1" placeholder="Ex: Boletos, Notas fiscais">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputPassword1">Descrição *opcional</label>
                            <textarea name="descricao" type="text" class="form-control" id="exampleInputPassword1">{{ old('descricao') }}</textarea>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputPassword312">De que conta a receita é</label>
                        
                            <select name="conta" class="form-control" >
                                @foreach($contas as $conta)
                                    <option @if(old('conta') == $conta->id) selected @endif value="{{$conta->id}}">{{$conta->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input name="valor"  value="{{ old('valor') }}" type="text" placeholder="Ex: 190,90" class="form-control">
                        </div>
                        <div class="form-group">
                        <label>Dia</label>
                        <select class="form-control" name="dia">
                            <option <?php $day = date('d');  if(old('dia') == '12') { echo 'selected'; } else if(!old('dia') && $day == 1) { echo 'selected'; } ?> >1</option>
                            <option <?php if(old('dia') == '2') { echo 'selected'; } else if(!old('dia') && $day == 2) { echo 'selected'; } ?>>2</option>
                            <option <?php if(old('dia') == '3') { echo 'selected'; } else if(!old('dia') && $day == 3) { echo 'selected'; } ?>>3</option>
                            <option <?php if(old('dia') == '4') { echo 'selected'; } else if(!old('dia') && $day == 4) { echo 'selected'; } ?> >4</option>
                            <option <?php if(old('dia') == '5') { echo 'selected'; } else if(!old('dia') && $day == 5) { echo 'selected'; } ?> >5</option>
                            <option <?php if(old('dia') == '6') { echo 'selected'; } else if(!old('dia') && $day == 6) { echo 'selected'; } ?> >6</option>
                            <option <?php if(old('dia') == '7') { echo 'selected'; } else if(!old('dia') && $day == 7) { echo 'selected'; } ?> >7</option>
                            <option <?php if(old('dia') == '8') { echo 'selected'; } else if(!old('dia') && $day == 8) { echo 'selected'; } ?> >8</option>
                            <option <?php if(old('dia') == '9') { echo 'selected'; } else if(!old('dia') && $day == 9) { echo 'selected'; } ?> >9</option>
                            <option <?php if(old('dia') == '10') { echo 'selected'; } else if(!old('dia') && $day == 10) { echo 'selected'; } ?> >10</option>
                            <option <?php if(old('dia') == '11') { echo 'selected'; } else if(!old('dia') && $day == 11) { echo 'selected'; } ?> >11</option>
                            <option <?php if(old('dia') == '12') { echo 'selected'; } else if(!old('dia') && $day == 12) { echo 'selected'; } ?> >12</option>
                            <option <?php if(old('dia') == '13') { echo 'selected'; } else if(!old('dia') && $day == 13) { echo 'selected'; } ?> >13</option>
                            <option <?php if(old('dia') == '14') { echo 'selected'; } else if(!old('dia') && $day == 14) { echo 'selected'; } ?> >14</option>
                            <option <?php if(old('dia') == '15') { echo 'selected'; } else if(!old('dia') && $day == 15) { echo 'selected'; } ?> >15</option>
                            <option <?php if(old('dia') == '16') { echo 'selected'; } else if(!old('dia') && $day == 16) { echo 'selected'; } ?> >16</option>
                            <option <?php if(old('dia') == '17') { echo 'selected'; } else if(!old('dia') && $day == 17) { echo 'selected'; } ?> >17</option>
                            <option <?php if(old('dia') == '18') { echo 'selected'; } else if(!old('dia') && $day == 18) { echo 'selected'; } ?> >18</option>
                            <option <?php if(old('dia') == '19') { echo 'selected'; } else if(!old('dia') && $day == 19) { echo 'selected'; } ?> >19</option>
                            <option <?php if(old('dia') == '20') { echo 'selected'; } else if(!old('dia') && $day == 20) { echo 'selected'; } ?> >20</option>
                            <option <?php if(old('dia') == '21') { echo 'selected'; } else if(!old('dia') && $day == 21) { echo 'selected'; } ?> >21</option>
                            <option <?php if(old('dia') == '22') { echo 'selected'; } else if(!old('dia') && $day == 22) { echo 'selected'; } ?> >22</option>
                            <option <?php if(old('dia') == '23') { echo 'selected'; } else if(!old('dia') && $day == 23) { echo 'selected'; } ?> >23</option>
                            <option <?php if(old('dia') == '24') { echo 'selected'; } else if(!old('dia') && $day == 24) { echo 'selected'; } ?> >24</option>
                            <option <?php if(old('dia') == '25') { echo 'selected'; } else if(!old('dia') && $day == 25) { echo 'selected'; } ?> >25</option>
                            <option <?php if(old('dia') == '26') { echo 'selected'; } else if(!old('dia') && $day == 26) { echo 'selected'; } ?> >26</option>
                            <option <?php if(old('dia') == '27') { echo 'selected'; } else if(!old('dia') && $day == 27) { echo 'selected'; } ?> >27</option>
                            <option <?php if(old('dia') == '28') { echo 'selected'; } else if(!old('dia') && $day == 28) { echo 'selected'; } ?> >28</option>
                            <option <?php if(old('dia') == '29') { echo 'selected'; } else if(!old('dia') && $day == 29) { echo 'selected'; } ?> >29</option>
                            <option <?php if(old('dia') == '30') { echo 'selected'; } else if(!old('dia') && $day == 30) { echo 'selected'; } ?> >30</option>
                            <option <?php if(old('dia') == '31') { echo 'selected'; } else if(!old('dia') && $day == 31) { echo 'selected'; } ?> >31</option>
                        </select>
                      </div> 
                        <div class="form-group">
                        <label>Mês</label>
                        <select class="form-control" name="mes">
                            <option <?php $month = date('m'); if(old('mes') == '1') { echo 'selected'; } else if(!old('mes') && $month == 1) { echo 'selected'; } ?> value="1">Janeiro</option>
                            <option <?php if(old('mes') == '2') { echo 'selected'; } else if(!old('mes') && $month == 2) { echo 'selected'; } ?> value="2">Fevereiro</option>
                            <option <?php if(old('mes') == '3') { echo 'selected'; } else if(!old('mes') && $month == 3) { echo 'selected'; } ?> value="3">Março</option>
                            <option <?php if(old('mes') == '4') { echo 'selected'; } else if(!old('mes') && $month == 4) { echo 'selected'; } ?> value="4">Abril</option>
                            <option <?php if(old('mes') == '5') { echo 'selected'; } else if(!old('mes') && $month == 5) { echo 'selected'; } ?> value="5">Maio</option>
                            <option <?php if(old('mes') == '6') { echo 'selected'; } else if(!old('mes') && $month == 6) { echo 'selected'; } ?> value="6">Junho</option>
                            <option <?php if(old('mes') == '7') { echo 'selected'; } else if(!old('mes') && $month == 7) { echo 'selected'; } ?> value="7">Julho</option>
                            <option <?php if(old('mes') == '8') { echo 'selected'; } else if(!old('mes') && $month == 8) { echo 'selected'; } ?> value="8">Agosto</option>
                            <option <?php if(old('mes') == '9') { echo 'selected'; } else if(!old('mes') && $month == 9) { echo 'selected'; } ?> value="9">Setembro</option>
                            <option <?php if(old('mes') == '10') { echo 'selected'; } else if(!old('mes') && $month == 10) { echo 'selected'; } ?> value="10">Outubro</option>
                            <option <?php if(old('mes') == '11') { echo 'selected'; } else if(!old('mes') && $month == 11) { echo 'selected'; } ?> value="11">Novembro</option>
                            <option <?php if(old('mes') == '12') { echo 'selected'; } else if(!old('mes') && $month == 12) { echo 'selected'; } ?> value="12">Dezembro</option>
                        </select>
                      </div>
                      <div class="form-group"> 
                        <label>Ano</label>
                        <select class="form-control" name="ano"> 
                            <?php $year = date('Y'); for ($i=2021; $i <=  $year ; $i++) { ?>
                              <option  <?php if(old('ano') == $i) { echo 'selected'; } else if(!old('ano') && $year == $i) { echo 'selected'; } ?> value="{{ $i }}">{{ $i }}</option>
                            <?php } ?> 
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Adicionar</button>
                    </form>
                  </div>
                </div>
              </div>  

          </div>
@endsection