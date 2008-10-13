<?php
  $tool_id = 0;
  $url_loja = "http://xxxx/";
  $url_site = "http://xxxx/";
  $nome_site = "3Gamers";

  $buscaPadrao = array("playstation 3", "wii", "xbox 360", "psp", "nintendo ds");

  include("engine.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="<?= fromUrl($busca) ?>, jogos, informática, câmera, psp, playstation, wii, xbox 360, loja, videogame"/>
  <title><?= fromUrl($busca); ?> - <?= $nome_site; ?></title>
</head>

<body>
  <div id='banner'>
    <img src='http://loja.3gamers.com.br/img/logoGrafite.png'>
  </div>

  <div id='conteudo'>  
</body>
</html>
