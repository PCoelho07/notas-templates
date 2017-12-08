@if (Auth::check())
  <div id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <ul class="nav side-menu">
            <li>
              <a href="/"><i class="fa fa-home"></i> Home </a>
            </li>
            <li>
              <a href="#"><i class="fa fa-files-o"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu ch2">
                <li><a href="/clients">Clientes</a></li>
                <li><a href="/templates">Templates</a></li>
                <li><a href="/cliente-qualificacao">Qualificação por cliente</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </ul>
  </div>
@endif


