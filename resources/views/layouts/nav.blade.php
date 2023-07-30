<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Grf - Finanças</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/vendors/feather/feather.css">
  <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/images/favicon.png" />
  <link rel="stylesheet" type="text/css" href="/fontawesome6/css/all.min.css" />

  <link  rel="icon" href="{{asset('img/bolsa-de-dinheiro.png')}}" >
</head>
<body>
  <div  class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav style="z-index: 10" class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <h4  style="font-weight: 600" class="pt-2 text-primary">Grf Despesas</h4>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!--
        <form action="/despesas">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
               <button style="background: none;border:none;outline" type="submit">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </button>
              </div>
              
                <input name="titulo" type="text" class="form-control" id="navbar-search-input" placeholder="Pesquisar por despesas" aria-label="search" aria-describedby="search">
             
            </div>
          </li>
        </ul>
      </form>-->
        <ul class="navbar-nav navbar-nav-right">
         
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              @yield('user')
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown"> 
              <a href="/logout" class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div  class="container-fluid page-body-wrapper">
     
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav style="z-index: 9" class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav"> 
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="icon-grid menu-icon" style="margin-bottom:6px"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li> 
          
          <span class="nav-item--title-divisor">Finanças</span>
  
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-plus menu-icon" style="margin-bottom:7px"></i>
              <span class="menu-title">Adicionar</span>
              <i  class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column" style="margin: 0 0 0 20px">
                <li class="nav-item">
                  <a class="nav-link" href="/nova_financa">
                      <i class="icon-plus menu-icon" style="margin-bottom:8px"></i>
                      Nova finança 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/nova_categoria">
                      <i class="icon-plus menu-icon" style="margin-bottom:8px"></i>
                      Nova categoria 
                  </a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="/nova_financa_fixa">
                      <i class="icon-plus menu-icon" style="margin-bottom:8px"></i>
                      Nova finança fixa 
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/categorias">
              <i class="fa-regular fa-tags menu-icon" style="margin-bottom:2px;font-size:17px;margin-right:12px;margin-left:-3px"></i>
              <span class="menu-title">Categorias</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="/financas">
              <i class="fa-regular fa-file-invoice-dollar  menu-icon" style="margin-bottom:2px;font-size:18px"></i> 
              <span class="menu-title">Despesas pagas</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="/pendentes">  
              <i class="fa-regular fa-file-exclamation  menu-icon" style="margin-bottom:2px;font-size:18px"></i>
              <span class="menu-title">Despesas pendentes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/finans_fixas">
              <i class="fa-regular fa-file-contract  menu-icon" style="margin-bottom:2px;font-size:18px"></i>
              <span class="menu-title">Despesas fixas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements-2" aria-expanded="false" aria-controls="form-elements-2">
              <i class="fa-solid fa-network-wired  menu-icon" style="margin-bottom:2px;font-size:17px;margin-right:12px;margin-left:-3px"></i>
              <span class="menu-title">Integrações</span>
              <i  class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements-2">
              <ul class="nav flex-column" style="margin: 0 0 0 20px">
                <li class="nav-item">
                  <a class="nav-link" href="/importacao">
                      <i class="icon-cloud-upload menu-icon" style="margin-bottom:5px;font-size:20px"></i>
                      Importar
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/exportacao">
                    <i class="icon-cloud-download menu-icon" style="margin-bottom:5px;font-size:20px"></i>
                    Exportar
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/trash">
              <i class="fa-regular fa-trash-can menu-icon" style="margin-bottom:1px"></i>
              <span class="menu-title">Lixeira</span> 
            </a>
          </li>
      
          <span style="margin-top: 27px" class="nav-item--title-divisor">Receitas</span>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#receitas" aria-expanded="false" aria-controls="receitas">
              <i class="icon-plus menu-icon" style="margin-bottom:7px"></i>
              <span class="menu-title">Adicionar</span>
              <i  class="menu-arrow"></i>
            </a>
            <div class="collapse" id="receitas">
              <ul class="nav flex-column" style="margin: 0 0 0 20px">
                <li class="nav-item">
                  <a class="nav-link" href="/nova_conta">
                      <i class="icon-plus menu-icon" style="margin-bottom:8px"></i>
                      Nova conta 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/nova_receita">
                      <i class="icon-plus menu-icon" style="margin-bottom:8px"></i>
                      Nova receita 
                  </a>
                </li> 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contas">
              <i class="fa-regular fa-sack-dollar   menu-icon" style="margin-bottom:2px;font-size:17.5px;margin-right:15px;margin-left:-1px"></i>
              <span class="menu-title">Contas</span> 
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="/rcts">
              <i class="fa-solid fa-hand-holding-dollar menu-icon" style="margin-bottom:2px;font-size:17.5px;margin-right:15px;margin-left:-1px"></i>
              <span class="menu-title">Receitas</span> 
            </a>
          </li> 
        </ul>
      </nav>
       
                @yield('content')
            

                
              </div> 
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->
        
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="/vendors/chart.js/Chart.min.js"></script>
  <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>
  
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page--><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

