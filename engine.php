<?php
require_once('./padroes.php');

foreach ($_GET as $variavel => $valor) {
  $$variavel = $valor;
}

//Se o usuário tiver acessado a Home, ou seja, não buscou nada, geramos uma
//busca para garantir que ele verá produtos relevantes ao tipo de loja desejada
//Defina $buscaPadrao no padroes.php para definir os podutos que poderão aparecer na home
if (empty($busca)) {
  $busca = $buscaPadrao[array_rand($buscaPadrao)];
}

//Agora gera a URL de busca no mercado livre
$url_busca = "http://www.mercadolivre.com.br/jm/searchXml?as_site_id=MLB&user={$user_id}&pwd={$senha_xml}&as_qshow=20&charset=UTF-8";

if ($busca != "" && $busca !== 0)
  $url_busca .= "&as_word=" . toUrl($busca);

if ($categoria && $categoria !== 0)
  $url_busca .= "&as_categ_id=" . $categoria;

if ($ordenar && $ordenar !== 0)
  $url_busca .= "&as_order_id=" . ordenar($ordenar);

if ($preco) {
  list($preco_min, $preco_max) = explode(":", $preco);
  if (!empty($preco_min) && $preco_min !== 0)
    $url_busca .= "&as_price_min=" . $preco_min;
  if ($preco_max != "" && $preco_min !== 0)
    $url_busca .= "&as_price_max=" . $preco_max;
}

$handler = fopen($url_busca, 'r');
$resultado_busca = stream_get_contents($handler);
fclose($handler);
$xml = simplexml_load_string($resultado_busca);
$itens = $xml->listing->items->children();

$categories = $xml->listing->result_categories->children();

/**********************************************************************************/

//Esta função recebe um XML das categorias, e lista todas elas, criando links
function lista_categorias($categorias) {
	global $url_loja, $busca;
	foreach($categorias as $categoria) {
		if ($categoria['name'] == "Outros" || $categoria['name'] == 'Outras Marcas') continue;
		$cat_name = $categoria['name'];
		$cat_id = $categoria['id'];

		print '<a href="' . $url_loja . sanitize($cat_name) . "/" . 'ven/' . $cat_id . "/" . '">' . sanitize($cat_name) . "</a>, ";
	}
	print link_to($busca, 'ven');
}

function toUrl($string) {
  $string = str_replace("%20", "+", $string);
  $string = str_replace(" ", "+", $string);
  $string = str_replace("_", "+", $string);
  return $string;
}

function fromUrl($string) {
  $string = str_replace("+", " ", $string);
  $string = str_replace("_", " ", $string);  
  $string = str_replace("%20", " ", $string);
  return $string;
}

function ordenar($string) {
  switch($string) {
    case "des":  //É o padrão do mercado livre, ordena pelos produtos com destaque
      return "";

    case "ven":  //Ordena pelos mais VENdidos
      return "MAS_OFERTADOS";

    case "vis":  //Ordena pelos mais VISitados
      return "HIT_PAGE";

/*
      case "bus":  //Ordena pelos mais BUScados
      return "";
*/

    case "bar":  //Ordena pelos mais BARatos
      return "BARATOS";

    case "alfa": //Ordena por ordem ALFAbética
      return "ITEM_TITLE";

    case "car":  //Ordena pelos mais CARos
      return "CAROS";

    case "tempo": //Ordena pelo tempo restante do anúncio
      return "AUCTION_STOP";
  }
}

	function busca_um_produto($dados, $tool_id) {
		list($el_preco_min, $el_preco_max) = explode(":", $dados['preco']);
		$busca_url = "http://www.mercadolivre.com.br/jm/searchXml?as_qshow=1&as_site_id=MLB";

		if($dados['preco']) {
			list($el_preco_min, $el_preco_max) = explode(':', $dados['preco']);
		}

		if($dados['certificado'] == true)
        $busca_url .= "&as_filtro_id=CERTIFIED";
      if($dados['mercadopago'] == true)
        $busca_url .= "&as_filtro_id2=MPAGO";
		if($dados['busca'])
        $busca_url .= "&as_word=" . toUrl($dados['busca']);
      if($dados['categoria'])
        $busca_url .= "&as_categ_id=" . $dados['categoria'];
      if($el_preco_min)
        $busca_url .= "&as_price_min=" . $el_preco_min;
      if($el_preco_max)
        $busca_url .= "&as_price_max=" . $el_preco_max;

		$handler = fopen($busca_url, 'r');
		$resultado_busca = stream_get_contents($handler);
		fclose($handler);
      $xml = simplexml_load_string($resultado_busca);

		$item = $xml->listing->items->item->children();
		$produto['title'] = sanitize($item->title);
		$produto['link'] = str_ireplace("tool=XXX","tool=".$tool_id, $item->link);
		$produto['link'] = sanitize($produto['link']);
		$produto['image'] = sanitize($item->image_url);
		$produto['price'] = $item->currency . $item->price;

		return $produto;
	}

	function sanitize($string, $capitalize = false) {
		$string = str_ireplace("&","&amp;", $string);
		$string[0] = strtoupper($string[0]);
		return $string;
	}

	function pega_texto($busca) {
		if( in_array($busca, array('perfume', 'perfumes', 'eau de toilette', 'locao', 'loção', )) )
			$nome = 'perfume';
		else
			$nome = 'perfume';

		$h = fopen($nome. '.txt', 'r');
		$texto = stream_get_contents($h);
		fclose($h);

		return $texto;
	}

	function link_to($busca, $ordenar = '', $categoria = '', $preco = '') {
		global $url_loja;
		$output = "<a href=\"$url_loja" . $busca 
			. ($ordenar ? "/".$ordenar : '')
			. ($categoria ? "/".$categoria : '')
			. ($preco ? "/".$preco : '')
			. '">'
			. $busca
			. '</a>';
		return $output;
	}

	//Retorna o cabeçalho do topo, para ser usado dentro de um H1
	function the_header() {
		global $busca;
		return "Mostrando " . sanitize(fromUrl($busca), true) . "";
	}

	function the_title() {
		global $nome_loja, $busca;
		$titulo = sanitize(fromUrl($busca)) . " - " . $nome_loja;
		return $titulo;
	}

	//Gera uma tabela, com os produtos encontrados na busca
	function lista_produtos($itens) {
		global $tool_id, $busca;

		print "<table id=\"listagemProdutos\"><tr>";
		$contador = 0;
		foreach($itens as $item) {
			if($contador > 0 && $contador % 4 == 0) { echo("</tr><tr>"); }
			$contador++;
			$title = $item->title;
			$link = $item->link;
			$image_url = sanitize($item->image_url);
			$price = $item->currency . $item->price;
			$link = str_ireplace("tool=XXX","tool=".$tool_id, $link);
			$link = sanitize($link);

			print "<td>
				<a href=\"$link\">
					<img src=\"$image_url\" alt=\"".sanitize($title)." - ".sanitize($busca)."\" width=\"90\"
						height=\"90\" /> <br />
					<span class=\"tituloProduto\">".sanitize($title)."</span> <br />
					<span class=\"preco\">$price</span>
				</a>
			</td>";
		}
		print "</tr></table>";
	}

	function lista_recomendados($recomendados) {
		foreach ($recomendados as $recomendado) {
			echo "<li>";
			echo link_to($recomendado['busca'], @$recomendado['ordenar'], @$recomendado['categoria'], @$recomendado['preco']);
			echo "</li>";
		}
	}
?>
