<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	/*
	 * TODO coisas ainda a fazer:
	 * - Adicionar links para ordenar por mais visitados, mais baratos, etc
	 * - Adicionar links internos para buscas mais comuns
	 * - Substituir barra lateral de menus por algum tipo de texto que tenha a ver com a busca
	 *
	 */

	$tool_id = "5431013";
	$url_loja = "http://loja.diasdebeleza.com.br/";
	$url_site = "http://xxxx/";
	$nome_site = "3Gamers";

	$user_id = 'pspawn';
	$senha_xml = 'UFNQQVdOUFNQQVdO';

	$buscaPadrao = array("perfume", "hidratante", "avon", "natura");

	include("engine.php");

/* DEFINIÇÃO DE ELEMENTOS PARA O MENU LATERAL */
//Copie este template para vários produtos, trocando o 0 por 1, 2, 3...
//Apenas "busca" é um parâmetro obrigatório. Todos os outros são opcionais. Se não quiser usar um deles
//basta apagar a linha ou deixar em branco "".

	$menu[0]['busca'] = "natura";	//Aqui você define o termo a ser buscado no ML
	$menu[0]['categoria'] = "6284";			//Aqui você deve definir o ID da categoria
	$menu[0]['preco'] = "10:200";			 //Defina preço mínimo e máximo, separado por :
	$menu[0]['certificado'] = true;			 //Se deve listar apenas vendedores certificados
	$menu[0]['mercadopago'] = true;			 //Se deve listar apenas produtos que aceitam Mercado Pago

	$menu[1]['busca'] = "Xbox 360";
	$menu[1]['categoria'] = "11108";
	$menu[1]['preco'] = "500:3000";
	$menu[1]['certificado'] = true;
	$menu[1]['mercadopago'] = true;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="<?= fromUrl($busca) ?>, beleza, perfumes, cabelos, natura, promoção" />
	<meta name="language" content="pt-br" />
	<meta name="description" content="Loja Dias de Beleza. Encontre produtos diversos para beleza feminina. Resultado da busca por: <?= fromUrl($busca) ?>." />
	<title><?=fromUrl($busca)?>	- <?= $nome_site; ?></title>
	<link type="text/css" rel="stylesheet" href="./loja.css" />
</head>

<body>
	<div id='banner'>
		<img src='http://loja.3gamers.com.br/img/logoGrafite.png' alt="Logotipo Loja <?=$nome_site?>: <?=fromUrl($busca)?>"/>
	</div>

	<div id='conteudo'>
		<form action="index.php">
			<p>
				<label for="busca">Busca:</label> <input type="text" tabindex="1" name="busca" id="busca" alt="Busca" accesskey="B" value="<?= fromUrl($busca); ?>"/>
				<input type="submit" value="Buscar" tabindex="2" accesskey="E" />
			</p>
		</form>

		<h1>Mostrando <?= fromUrl($busca) ?></h1>

		<table id="listagemProdutos">
			<tr>
				<?
				$contador = 0;
				foreach($items as $item) {
					if($contador > 0 && $contador % 4 == 0) { echo("</tr><tr>"); }
					$contador++;
					//$title = sanitize($item->title);
					$title = $item->title;
					$link = $item->link;
					$image_url = sanitize($item->image_url);
					$price = $item->currency . $item->price;
					$link = str_ireplace("tool=XXX","tool=".$tool_id, $link);
					$link = sanitize($link);
				?>

					<td>
						<a href="<?=$link?>">
							<img src="<?=$image_url?>" alt="<?=sanitize($title)?> - <?=sanitize($busca)?>"/> <br />
							<span class="tituloProduto"><?=$title?></span> <br />
							<span class="preco"><?=$price?></span>
						</a>
					</td>
					<?  ?>

				<?
				}
				?>
			</tr>
		</table>
		<p>Você buscou por: <strong><?= fromUrl($busca) ?></strong></p>
	</div>

<?php
/********************************************************************************
*********************** MENU LATERAL ********************************************
********************************************************************************/
?>

	<div id='menuLat'>
	<div id="interno">
	 <p>
		<?php
		foreach($menu as $elemento) {
		$produto = busca_um_produto($elemento, $tool_id);
		?>
			<a href="<?=$produto['link']?>">
				<img src="<?=$produto['image']?>" alt="<?=$produto['title']?>" /> <br />
				<span class="tituloProduto"><?=sanitize($produto['title'])?></span> <br />
				<span class="preco"><?=$produto['price']?></span>
			</a>
			<br /><br />
		<?php
		}
		?>
	 </p>
	 </div>
	</div>
</body>
</html>
