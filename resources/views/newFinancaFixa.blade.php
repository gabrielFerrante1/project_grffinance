@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection


@section('content')

     <!-- partial -->
   
     <div class="main-panel">
        <div class="content-wrapper">
          <h3 class="pl-1 text-primary font-weight-bold "> <i style="font-size: 23px;" class="fa-regular fa-thumbtack"></i> - Adicionar nova despesa fixa </h3>
            <small style="margin: 0 0 32px 40px;display:block;font-size:14px">
                Crie uma nova finança fixa, dessa forma ela será lançada em suas despesas automaticamente todo mês.
            </small>


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

              <!--erro-->
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
                        <label for="exampleInputUsername1">Título</label>
                        <input name="titulo" value="{{ old('titulo') }}" type="text" class="form-control" id="exampleInputUsername1" placeholder="Titulo da despesa">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Descrição</label>
                        <input name="descricao"  value="{{ old('descricao') }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Descrição *Opcional">
                      </div>
                      <div class="form-group">
                        <label>Categoria</label>
                        <select  class="form-control" name="categoria">
                          @foreach ($categories as $item)
                               <option <?php if(old('categoria') && old('categoria') == $item->id) {echo 'selected';}  ?> value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select> 
                      </div>
                      <div class="form-group">
                        <label>Valor</label>
                        <input name="preco"  value="{{ old('preco') }}" type="text" placeholder="Ex: 190,90" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Para onde a despesa vai </label>
                        <select class="form-control" name="status">
                            <option <?php if(old('status') && old('status') == 0) {echo 'selected';}  ?>  value="0" selected>Para pendentes</option>
                            <option <?php if(old('status') && old('status') == 1) {echo 'selected';}  ?>  value="1">Para pagas</option>
                        </select>
                      </div> 
                      <div class="form-group">
                        <label>Dia do vencimento (<span class="text-primary">Ela será lançada todo mês neste dia</span>)</label>
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
                      <button type="submit" class="btn btn-primary mr-2">Adicionar</button>
                    </form>
                  </div>
                </div>
              </div> 

          </div></div></div></div> 
@endsection