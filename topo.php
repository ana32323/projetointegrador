<?php if(isset($_SESSION['usuarios'])) : ?>
   <span> logado: <?= $_SESSION['usuario']->nome ?></span>
   <a href="logout.php">Sair</a>
   <br>

<?php endif; ?>

<h1><center>catalogo de alimento</center></h1>
<a href="index.php">Inicio</a>
<a href="cadastro.php">Cadastro Usuario</a>



