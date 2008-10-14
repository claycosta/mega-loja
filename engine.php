<?php
  //Se o usuário tiver acessado a Home, ou seja, não buscou nada, geramos uma
  //busca para garantir que ele verá produtos relevantes ao tipo de loja desejada
  //Defina $buscaPadrao no index.php para definir os podutos que poderão aparecer na home
  if (!$busca || $busca == "") {
    $busca = $buscaPadrao[array_rand($buscaPadrao)];
  }
  $busca = $_GET['busca'];
  $categoria = $_GET['categoria'];
  $ordenar = $_GET['ordenar'];
  $preco = $_GET['preco'];

  //Agora gera a URL de busca no mercado livre
  $url_busca = "http://www.mercadolivre.com.br/jm/searchXml?as_site_id=MLB&";

  if ($busca != "" && $busca !== 0)
    $url_busca .= "as_word=" . toUrl($busca) . "&";
  
  if ($categoria && $categoria !== 0)
    $url_busca .= "as_categ_id=" . $categoria . "&";

  if ($ordenar && $ordenar !== 0)
    $url_busca .= "as_order_id=" . ordenar($ordenar) . "&";

  if ($preco) {
    list($preco_min, $preco_max) = explode(":", $preco);
    if ($preco_min != "" && $preco_min !== 0)
      $url_busca .= "as_price_min=" . $preco_min . "&";
    if ($preco_max != "" && $preco_min !== 0)
      $url_busca .= "as_price_max=" . $preco_max;
  }

  $ch = curl_init($url_busca);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 12);
  $resultado_busca = curl_exec($ch);
  curl_close($ch);

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

?>


