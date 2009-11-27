<?php
require_once('./padroes.php');
require_once('./engine.php');
require_once('./funcoes.php');

/* Usuário acabou de entrar na página, vamos fazer uma busca e mostrar os resultados */
$resultado = busca_produtos(gera_url_busca());