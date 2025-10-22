<?php

include_once "configs/database.php";
include_once "objetos/produto.php";
include_once "objetos/ProdutoController.php";

$controller = new ProdutoController();
$produtos = $controller->index();
global $produtos;


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalogo Alimentos</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <main class="container">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Página Iniciar</a>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Administrador
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Cadastrar Usuario</a></li>
                <li><a class="dropdown-item" href="#">Cadastrar Produto</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                
              </ul>
            </li>
            
           
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success" type="submit">Login</button>
          </form>
        </div>
      </div>
    </nav>

    <div class="row car">

      <div class="col">

        <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src = d-block w-100 alt="...">
            </div>

            <div class="carousel-item">
              <img src class="d-block w-100" alt="...">
            </div>

            <div class="carousel-item">
              <img src=" class="d-block w-100" alt="...">
            </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

    </div>

    <h1>
      <center>Catálogo de Alimentos</center>
    </h1>

    <div class="row">
      <div class="col d-flex justify-content-center">
        <form action="index.php" method="post" class="form-pesquisa">
          <input type="text" name="pesquisa" class="form-control" placeholder=>

          <div class="d-flex justify-content-center" style="margin-top: 10px">
            <button class="btn btn-primary mb-3" style="margin-right: 10px">Pesquisa</button>
            <button class="btn btn-primary mb-3" style="margin-right: 10px">Limpar Pesquisa</button>

          </div>

        </form>

      </div>

    </div>

    <div class="row">
     
        <?php if ($produtos) : ?>
          <?php foreach($produtos as $produto) : ?>
            <section class="col painel-produtos">
            <div class="card" style="width: 18rem;">
              <img src="uploads/<?= $produto["imagem"] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"> <?= $produto["nome"] ?></h5>
                <p class="card-text"> <?= $produto["descricao"] ?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
          </div>
          </section>
           
          <?php endforeach ?>
        <?php endif ?>
   

    </div>


  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>


</html>