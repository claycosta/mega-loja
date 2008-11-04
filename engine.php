<?php

  $busca = @$_GET['busca'];
  $categoria = @$_GET['categoria'];
  $ordenar = @$_GET['ordenar'];
  $preco = @$_GET['preco'];

  //Se o usuário tiver acessado a Home, ou seja, não buscou nada, geramos uma
  //busca para garantir que ele verá produtos relevantes ao tipo de loja desejada
  //Defina $buscaPadrao no index.php para definir os podutos que poderão aparecer na home
  if (empty($busca)) {
    $busca = $buscaPadrao[array_rand($buscaPadrao)];
  }

  //Agora gera a URL de busca no mercado livre
  $url_busca = "http://www.mercadolivre.com.br/jm/searchXml?as_site_id=MLB&user={$user_id}&pwd={$senha_xml}&as_qshow=25";

  if ($busca != "" && $busca !== 0)
    $url_busca .= "&as_word=" . toUrl($busca);
  
  if ($categoria && $categoria !== 0)
    $url_busca .= "&as_categ_id=" . $categoria;

  if ($ordenar && $ordenar !== 0)
    $url_busca .= "&as_order_id=" . ordenar($ordenar);

  if ($preco) {
    list($preco_min, $preco_max) = explode(":", $preco);
    if ($preco_min != "" && $preco_min !== 0)
      $url_busca .= "&as_price_min=" . $preco_min;
    if ($preco_max != "" && $preco_min !== 0)
      $url_busca .= "&as_price_max=" . $preco_max;
  }

  $handler = fopen($url_busca, 'r');
  $resultado_busca = stream_get_contents($handler);
  fclose($handler);
  $xml = simplexml_load_string($resultado_busca);
  $items = $xml->listing->items->children();









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
		$busca_url = "http://www.mercadolivre.com.br/jm/searchXml?as_qshow=1&as_site_id=MLB&";

		if($dados['preco']) {
			list($el_preco_min, $el_preco_max) = explode(':', $dados['preco']);
		}

		if($dados['certificado'] == true)
        $busca_url .= "as_filtro_id=CERTIFIED&";
      if($dados['mercadopago'] == true)
        $busca_url .= "as_filtro_id2=MPAGO&";
      if($dados['busca'])
        $busca_url .= "as_word=" . toUrl($dados['busca']) . "&";
      if($dados['categoria'])
        $busca_url .= "as_categ_id=" . $dados['categoria'] . "&";
      if($el_preco_min)
        $busca_url .= "as_price_min=" . $el_preco_min . "&";
      if($el_preco_max)
        $busca_url .= "as_price_max=" . $el_preco_max . "&";

		$handler = fopen($busca_url, 'r');
		$resultado_busca = stream_get_contents($handler);
		fclose($handler);
      $xml = simplexml_load_string($resultado_busca);

		$item = $xml->listing->items->item->children();
		$produto['title'] = $item->title;
		$produto['link'] = str_ireplace("tool=XXX","tool=".$tool_id, $item->link);
		$produto['image'] = $item->image_url;
		$produto['price'] = $item->currency . $item->price;

		return $produto;
	}

?>


