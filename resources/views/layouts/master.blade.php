<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>X3 Soluções para cartórios</title>
  <link href="/css/style.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="/css/simple-sidebar.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Summernote -->
  <link href="/summernote/summernote.css" rel="stylesheet">

  <script src="/js/Chart.js"></script>
  <!--script src="/js/legend.js"></script>
  <script src="/js/demo.js"></script-->
  <link type="text/css" rel="stylesheet" href="/css/custom.css">
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>

<body>
  @include ('layouts.header')

  <div id="wrapper" class="toggled">

    @include ('layouts.sidebar')

    <div id="page-content-wrapper">
      <div class="container-fluid">
        <a href="#menu-toggle" class="btn btn-default glyphicon glyphicon-menu-hamburger" id="menu-toggle"></a>

        <div id="main">
          @yield ('content')
        </div>
      </div>
    </div>
  </div>

  @include ('layouts.footer')

  <script src="/js/jquery.min.js"></script>
  <script src="/js/jquery.once.js"></script>
  <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/js/jquery.mask.min.js"></script>
  <script src="/summernote/summernote.min.js"></script>
  <script src="/summernote/lang/summernote-pt-BR.js"></script>
  <script src="/js/script.js"></script>
  <script src="/js/custom.js"></script>
</body>
</html>
