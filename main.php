<?php
require_once('./padroes.php');
require_once('./engine.php');
require_once('./funcoes.php');

/* Usu�rio acabou de entrar na p�gina, vamos fazer uma busca e mostrar os resultados */
$resultado = busca_produtos(gera_url_busca());