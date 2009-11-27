<?php
foreach ($_GET as $variavel => $valor) {
  $busca[$variavel] = $valor;
}
$busca['busca'] = from_url($busca['busca']);

//Se o usuário tiver acessado a Home, ou seja, não buscou nada, geramos uma
//busca para garantir que ele verá produtos relevantes ao tipo de loja desejada
//Defina $buscaPadrao no padroes.php para definir os podutos que poderão aparecer na home
if (empty($busca)) {
  $busca['busca'] = busca_aleatoria();
}

//Agora gera a URL de busca no mercado livre
function gera_url_busca() {
  global $user_id, $loja, $busca;
  $url_busca = "http://www.mercadolivre.com.br/jm/searchXml?as_site_id=MLB&user={$user_id}&pwd={$loja['senha_xml']}&as_qshow=20&charset=UTF-8";
  
  if ($busca['busca'] != "" && $busca['busca'] !== 0)
    $url_busca .= "&as_word=" . to_url($busca['busca']);
  
  if ($busca['categoria'] && $busca['categoria'] !== 0)
    $url_busca .= "&as_categ_id=" . $busca['categoria'];
  
  if ($busca['ordenar'] && $busca['ordenar'] !== 0)
    $url_busca .= "&as_order_id=" . ordenar($busca['ordenar']);
  
  if ($busca['preco']) {
    list($preco_min, $preco_max) = explode(":", $busca['preco']);
    if (!empty($preco_min) && $preco_min !== 0)
      $url_busca .= "&as_price_min=" . $preco_min;
    if ($preco_max != "" && $preco_min !== 0)
      $url_busca .= "&as_price_max=" . $preco_max;
  }
  
  return $url_busca;
}

/* Recebe a url da busca e retorna um array contendo um array de itens, e outro array de categorias
  De preferencia, a url da busca vem da função gera_url_busca() */
function busca_produtos($url_busca) {
  $handler = fopen($url_busca, 'r');
  $resultado_busca = stream_get_contents($handler);
  fclose($handler);
  
  $xml = simplexml_load_string($resultado_busca);
  $itens = $xml->listing->items->children();
  $categorias = $xml->listing->result_categories->children();
  
  $resultado['itens'] = $itens;
  $resultado['categorias'] = $categorias;
  
  return $resultado;
}

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

function to_url($string) {
  $string = str_replace("%20", "+", $string);
  $string = str_replace(" ", "+", $string);
  $string = str_replace("_", "+", $string);
  return $string;
}

function from_url($string) {
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

	function lista_recomendados($recomendados) {
		foreach ($recomendados as $recomendado) {
			echo "<li>";
			echo link_to($recomendado['busca'], @$recomendado['ordenar'], @$recomendado['categoria'], @$recomendado['preco']);
			echo "</li>";
		}
	}
?>
