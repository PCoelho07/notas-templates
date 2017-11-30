<header id="header">
  <h1><a href="/">X3 soluções</a></h1>
  <nav class="profile">
    <ul>
      <li role="presentation" class="dropdown nameuser" style="margin-top: 24px;">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
        </a>

        <ul class="dropdown-menu dmenu">
          <li><a href="/users/{{ Auth::user()->id }}/edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Meu perfil</a></li>
          <li><a href="/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a></li>
        </ul>

      </li>
      <li><img src="/imagens/user_placeholder.png" width="36" height="36" alt=""/></li>
      <li role="presentation" class="dropdown">
        <a class="glyphicon glyphicon-cog dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>

        @include ('layouts.header.dropdown-menu')

      </li>
      <li><a class="glyphicon glyphicon-bell" href="#"></a></li>
    </ul>
  </nav>
</header>

