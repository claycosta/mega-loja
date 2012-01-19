<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <script type="text/javascript" src="./lib/mustache.js"></script>
  <script type="text/javascript" src="./lib/produto.js"></script>
  <script type="text/javascript" src="./lib/busca.js"></script>
  <script type="text/javascript" src="./lib/loja.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<?php	include_once('./lib/base.php'); ?>
	<link rel="stylesheet" href="base.css" type="text/css">
	<title><?= $nome_loja ?></title>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?= $nome_loja ?></h1>
			
			<ul>
				<li><a href="">Home</a></li>
				<li><a href="">Destaque</a></li>
				<li><a href="">Mercado Pago</a></li>
				<li><a href="">Dúvidas</a></li>
				<li><a href="">Sobre</a></li>
			</ul>
		</div>
		
		<div id="busca">
			<form method="get">
				<input type="text" name="frase" placeholder="O que você procura?">
				<input type="submit" value="Buscar">
			</form>
		</div>
		
		<div id="destaque">
			
		</div>
		
		<div id="lista_produtos">
			
		</div>
		
		<div id="footer">
			
		</div>
	</div>
</body>
</html>