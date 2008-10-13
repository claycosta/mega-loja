<?php
  $tool_id = "5431013";
  $url_loja = "http://xxxx/";
  $url_site = "http://xxxx/";
  $nome_site = "3Gamers";

  $buscaPadrao = array("playstation 3", "wii", "xbox 360", "psp", "nintendo ds");

  include("engine.php");


/* DEFINIÇÃO DE ELEMENTOS PARA O MENU LATERAL */
//Copie este template para vários produtos, trocando o 0 por 1, 2, 3...
//Apenas "busca" é um parâmetro obrigatório. Todos os outros são opcionais. Se não quiser usar um deles
//basta apagar a linha ou deixar em branco "".

  $menu[0]['busca'] = "Playstation 3";  //Aqui você define o termo a ser buscado no ML
  $menu[0]['categoria'] = "11624";           //Aqui você deve definir o ID da categoria
  $menu[0]['preco'] = "500:3000";       //Defina preço mínimo e máximo, separado por :
  $menu[0]['certificado'] = true;       //Se deve listar apenas vendedores certificados
  $menu[0]['mercadopago'] = true;       //Se deve listar apenas produtos que aceitam Mercado Pago

  $menu[1]['busca'] = "Xbox 360"; 
  $menu[1]['categoria'] = "11108";
  $menu[1]['preco'] = "500:3000";
  $menu[1]['certificado'] = true;
  $menu[1]['mercadopago'] = true;

  $menu[2]['busca'] = "Wii"; 
  $menu[2]['categoria'] = "11965";
  $menu[2]['preco'] = "500:2000";
  $menu[2]['certificado'] = true;
  $menu[2]['mercadopago'] = true;

  $menu[3]['busca'] = "PSP"; 
  $menu[3]['categoria'] = "6772";
  $menu[3]['preco'] = "400:1500";
  $menu[3]['certificado'] = true;
  $menu[3]['mercadopago'] = true;

  $menu[4]['busca'] = "Playstation 2"; 
  $menu[4]['categoria'] = "4384";
  $menu[4]['preco'] = "350:1100";
  $menu[4]['certificado'] = true;
  $menu[4]['mercadopago'] = true;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="<?= fromUrl($busca) ?>, jogos, informática, câmera, psp, playstation, wii, xbox 360, loja, videogame"/>
  <title><?= fromUrl($busca); ?> - <?= $nome_site; ?></title>

  <style>
    <!--
    body {background-image:url('http://loja.3gamers.com.br/img/fundo.png');background-repeat: repeat-y; background-position: left; background-color: #4e4741}
    img { border:0px; }
    a{text-decoration: none}
    div#banner {text-align:left; margin:-10px; padding-left: 25px;background-image:url('http://loja.3gamers.com.br/img/fundbanner.jpg');background-repeat: repeat-x }
    div#loja p {font-size:12px}
    center {text-align: left}
    #conteudo {margin-left:25px; margin-top:25px}
    #conteudo form {position: relative; left:25px}
    #menuLat{
    width: 179px; overflow: hidden; position:absolute; left:820px; top:50px;text-align:center;
    background-image:url('http://loja.3gamers.com.br/img/fundoMenuLat.PNG');background-repeat: repeat-y; background-color:#ffffff;}
    span#tituloProduto {color:black}
    span#preco {color:red}
    table#listagemProdutos {border-spacing: 25px 50px}
    table#listagemProdutos td {max-width: 160px; text-align:center; border:1px black solid; overflow: hidden;}
    -->
  </style>
</head>

<body>
  <div id='banner'>
    <img src='http://loja.3gamers.com.br/img/logoGrafite.png'>
  </div>

  <div id='conteudo'>
    <form action="index.php">
      Busca: <input type="text" name="busca" value="<?= fromUrl($busca); ?>"> <input type="submit" value="Buscar">
    </form>
    
    <table id="listagemProdutos">
      <tr>
        <?
        $contador = 0;
        foreach($items as $item) {
          $contador++;
          $title = $item->title;
	        $link = $item->link;
	        $image_url = $item->image_url;
	        $price = $item->currency . $item->price;
	        $link = str_ireplace("tool=XXX","tool=".$tool_id, $link);
        ?>

          <td>
	          <a href="<?=$link?>">
              <img src="<?=$image_url?>" /> <br />
	            <span id="tituloProduto"><?=$title?></span> <br />
	            <span id="preco"><?=$price?></span>
	          </a>
	        </td>
	        <? if($contador % 4 == 0) { echo("</tr><tr>"); } ?>

        <?
        }
        ?>
      </tr>
    </table>
  </div>





</body>
</html>
