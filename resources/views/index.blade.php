<?php $text_mes = null; switch ($mes) {
  case '1':
    $text_mes = 'Janeiro';
    break;
  case '2':
    $text_mes = 'Fevereiro';
    break;
  case '3':
    $text_mes = 'Março';
    break;
  case '4':
    $text_mes = 'Abril';
    break;
  case '5':
    $text_mes = 'Maio';
    break;
  case '6':
    $text_mes = 'Junho';
    break;
  case '7':
    $text_mes = 'Julho';
    break;
  case '8':
    $text_mes = 'Agosto';
    break;
  case '9':
    $text_mes = 'Setembro';
    break;
  case '10':
    $text_mes = 'Outubro';
    break;
  case '11':
    $text_mes = 'Novembro';
    break;
  case '12':
    $text_mes = 'Dezembro';
    break;
};

 
?>
@extends('layouts.nav')

@section('user')
  {{$user->name}}
@endsection

@section('content')
     <!-- partial -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <div  class="content-wrapper">

          <div class="row">
            <div class="col-md-6">
              <h3 class="pl-2 font-weight-bold">Olá, {{ $user->name }}</h3>
              <h6 class="pl-2 mb-4 font-weight-normal mb-0">Acompanhe os gráficos de suas despesas aqui, <span class="text-primary">selecione o mês e o ano para filtrar os resultados</span></h6>
            </div>

           
            <div class="col-md-2  offset-md-2 mt-3">
              <form>
                <select onchange="this.form.submit()" name="mes" class="form-control form-control-sm" id="exampleFormControlSelect3">
                  <option <?php if(!empty($mes) && $mes == '1') echo 'selected'; ?>  value="1">Janeiro</option>
                  <option <?php if(!empty($mes) && $mes == '2') echo 'selected'; ?>  value="2">Fevereiro</option>
                  <option <?php if(!empty($mes) && $mes == '3') echo 'selected'; ?>  value="3">Março</option>
                  <option <?php if(!empty($mes) && $mes == '4') echo 'selected'; ?>  value="4">Abril</option>
                  <option <?php if(!empty($mes) && $mes == '5') echo 'selected'; ?>  value="5">Maio</option>
                  <option <?php if(!empty($mes) && $mes == '6') echo 'selected'; ?>  value="6">Junho</option>
                  <option <?php if(!empty($mes) && $mes == '7') echo 'selected'; ?>  value="7">Julho</option>
                  <option <?php if(!empty($mes) && $mes == '8') echo 'selected'; ?>  value="8">Agosto</option>
                  <option <?php if(!empty($mes) && $mes == '9') echo 'selected'; ?>  value="9">Setembro</option>
                  <option <?php if(!empty($mes) && $mes == '10') echo 'selected'; ?>  value="10">Outubro</option>
                  <option <?php if(!empty($mes) && $mes == '11') echo 'selected'; ?>  value="11">Novembro</option>
                  <option <?php if(!empty($mes) && $mes == '12') echo 'selected'; ?> value="12">Dezembro</option>
                </select>
            </div>

            <div class="col-md-2 mt-3">
                <select onchange="this.form.submit()" name="ano" class="form-control form-control-sm" id="exampleFormControlSelect4"> 
                  <?php $year = date('Y'); for ($i=2021; $i <=  $year ; $i++) { ?>
                    <option <?php if(!empty($ano) && $ano == $i) echo 'selected'; ?> value="{{ $i }}">{{ $i }}</option>
                  <?php } ?> 
                </select>

              </form>
            </div>

         

          </div>

          <div class="row mb-5">
            <div class="col-md-4 mt-3">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Total de despesas pagas no mês de <span style="font-weight: 600">{{ $text_mes }}</span></p>
                  <p class="fs-30 mb-2">{{$count_despesas_pagas}}</p>
                </div>
              </div>
            </div>

             <div class="col-md-4 mt-3">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Total de despesas pendentes no mês <span style="font-weight: 600">{{ $text_mes }}</span></p>
                  <p class="fs-30 mb-2">{{ $count_despesas_pendentes }}</p>
                </div>
              </div>
            </div>

            <div class="col-md-4 mt-3">
              <div class="card card-dark-blue">
                <div class="card-body">
                  <p class="mb-4">Total de despesas geral no mês <span style="font-weight: 600">{{ $text_mes }}</span></p>
                  <p class="fs-30 mb-2">{{$count_despesas_pagas + $count_despesas_pendentes}} </p>
                </div>
              </div>
            </div>

          </div>
 


          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                            <p class="card-title">Categorias com mais gastos</p>
                              <h2 class="text-primary"> <?php if(isset($category_king->total)) { $x = $category_king->total;} else { $x = 0; } ?> R$ {{ number_format($x, 2, ',', '.'); }} </h2>
                              <h3 class="font-weight-500 mb-xl-4 text-primary"> <?php if(isset($category_king->name)) { echo $category_king->name;} ?></h3>
                              @if(isset($category_king->name))
                              <p class="mb-2 mb-xl-0">Você tem altos gastos com a categoria <?php if(isset($category_king->name)) { echo $category_king->name.',';} ?> procure reduzir os custos desta categoria</p>
                              @endif
                            </div>  
                            </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6     @if(isset($category_king->name))  border-right @endif">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
                                    <tbody>
                                      @forelse($categorys_ranking as $c_r)
                                      <?php $cor_aleatoria = rand(27, 255).','.rand(42, 255).','.rand(29, 255) ?>

                                      <tr>
                                      <td class="text-muted">{{$c_r->name}}</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar" role="progressbar" style="width: {{ ($c_r->total / $count_all_categorys) * 100 }}%;background: rgb({{$cor_aleatoria}})" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">R$ <?php $valor_correct = number_format($c_r->total, 2, ',', '.'); echo $valor_correct ?></h5></td>
                                    </tr>

                                    @empty
                                    <span class="text-muted mt-5">Neste mês não há nehuma despesa para ser avaliada</span>
                                    @endforelse

                                  </tbody></table>
                                </div>
                              </div> 
                              <div class="col-md-6">
                                @if(isset($category_king->name)) 
                                  <h4 style="text-transform: none" class="card-title">{{ $category_king->name}} comparada com todas as categorias</h4>
                                  <div class="pl-5 pr-5 pb-5"> <canvas id="myChart3"></canvas></div> 
                                @endif
                              </div>
                           
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          


          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                  <div class="card-body">

                    <h4 style="text-transform: none" class="card-title">Médias de despesas pagas em cada mês no ano de {{ $ano }}</h4>
                    <canvas  width="400" height="100" id="myChart"></canvas>
                  </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                  <div class="card-body">

                    <h4 style="text-transform: none" class="card-title">Médias de despesas <span class="text-primary"> pendentes </span> cada mês no ano de {{ $ano }}</h4>
                    <canvas  width="400" height="100" id="myChart2"></canvas>
                  </div>
              </div>
            </div>
    

        </div><!--fIM DO CONTAINER-->




        
      
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        datasets: [{
            label: 'Média de cada mês',
            data: ["{{$line_graphi[1][0][0]->total}}", "{{$line_graphi[2][0][0]->total}}", "{{$line_graphi[3][0][0]->total}}", "{{$line_graphi[4][0][0]->total}}", "{{$line_graphi[5][0][0]->total}}", "{{$line_graphi[6][0][0]->total}}", "{{$line_graphi[7][0][0]->total}}", "{{$line_graphi[8][0][0]->total}}", "{{$line_graphi[9][0][0]->total}}", "{{$line_graphi[10][0][0]->total}}", "{{$line_graphi[11][0][0]->total}}", "{{$line_graphi[12][0][0]->total}}"],
            backgroundColor: [
                '#4B49AC',
                '#00BFFF',
                '#00FA9A',
                '#DAA520',
                '#FF00FF',
                '#F5C893',
                '#FFA500',
                '#93A7F5',
                '#BBFA07',
                '#b0b0ae',
                '#5f4d29',
                '#8A2BE2',
            ],
            borderColor: [
                '#4B49AC',
                '#00BFFF',
                '#00FA9A',
                '#DAA520',
                '#FF00FF',
                '#F5C893',
                '#FFA500',
                '#93A7F5',
                '#BBFA07',
                '#b0b0ae',
                '#5f4d29',
                '#8A2BE2',
            ],
            borderWidth: 1
        }]
     
    }
});


  const ctx2 = document.getElementById('myChart2').getContext('2d');
  const myChart2 = new Chart(ctx2, {
      type: 'line',
      data: {
          labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          datasets: [{
              label: 'Média de cada mês',
              data: ["{{$line_graphi_pendents[1][0][0]->total}}", "{{$line_graphi_pendents[2][0][0]->total}}", "{{$line_graphi_pendents[3][0][0]->total}}", "{{$line_graphi_pendents[4][0][0]->total}}", "{{$line_graphi_pendents[5][0][0]->total}}", "{{$line_graphi_pendents[6][0][0]->total}}", "{{$line_graphi_pendents[7][0][0]->total}}", "{{$line_graphi_pendents[8][0][0]->total}}", "{{$line_graphi_pendents[9][0][0]->total}}", "{{$line_graphi_pendents[10][0][0]->total}}", "{{$line_graphi_pendents[11][0][0]->total}}", "{{$line_graphi_pendents[12][0][0]->total}}"],
              backgroundColor: [
                  '#4B49AC',
                  '#00BFFF',
                  '#00FA9A',
                  '#DAA520',
                  '#FF00FF',
                  '#F5C893',
                  '#FFA500',
                  '#93A7F5',
                  '#BBFA07',
                  '#b0b0ae',
                  '#5f4d29',
                  '#8A2BE2',
              ],
              borderColor: [
                  '#4B49AC',
                  '#00BFFF',
                  '#00FA9A',
                  '#DAA520',
                  '#FF00FF',
                  '#F5C893',
                  '#FFA500',
                  '#93A7F5',
                  '#BBFA07',
                  '#b0b0ae',
                  '#5f4d29',
                  '#8A2BE2',
              ],
              borderWidth: 1
          }]
      
      }
  });

  const ctx3 = document.getElementById('myChart3').getContext('2d');
const myChart3 = new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: ['Todas as categorias', '<?php if(isset($category_king->category)) { echo $category_king->category;} ?>'],
        datasets: [{
            label: 'Média de cada mês',
            data: ["{{$count_all_categorys}}", "{{$x}}",],
            backgroundColor: [
                '#4B49AC',
                '#00BFFF',
               
            ],
            borderColor: [
                '#4B49AC',
                '#00BFFF',
                
            ],
            borderWidth: 1
        }]
     
    }
});





</script>

@endsection