<?php
  $request_uri = $_SERVER['REQUEST_URI'];
  $request_uri = str_replace("/bighiloja/", "", $request_uri);
  list($busca, $ordenar, $categoria, $preco) = explode('/', $request_uri);

  /*  
  //TODO lembrar de melhorar esse foreach
  $contador_parte = 0; // O contador existe pra identificar as 3 primeiras partes da URI
  $opcoes = array();
  foreach($partes as $parte) {
    if ($contador == 0) { $busca = $partes[0]; }
    if ($contador == 1) { $ordenar = $partes[1]; }
    if ($contador == 2) { $categoria = $partes[2]; }
    if ($contador > 2) {
      list($opcao, $valor) = explode(":", $parte);
      $$opcao = $valor;
      array_push($opcoes, $$opcao);
    }
    $contador++;
  }
  */
  
  //Agora gera a URL de busca no mercado livre
  $url_busca = "http://www.mercadolivre.com.br/jm/searchXml?";
  if ($busca) $url_busca .= "as_word=" . converte($busca) . "&";
  if ($categoria) $url_busca .= "as_categ_id=" . $categoria . "&";
  if ($ordenar) $url_busca .= "as_order_id=" . ordenar($ordenar) . "&";
  if ($preco) {
    list($preco_min, $preco_max) = explode("-", $preco);
    if ($preco_min != "" && $preco_min != 0)
      $url_busca .= "as_price_min=" . $preco_min . "&";
    if ($preco_max != "" && $preco_min != 0)
      $url_busca .= "as_price_max=" . $preco_max;
  }

  $ch = curl_init($url_busca);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 12);
  $resultado_busca = curl_exec($ch);
  curl_close($ch);

  print $resultado_busca;









function converte($string) {
  $string = str_replace("%20", "+", $string);
  $string = str_replace(" ", "+", $string);
  $string = str_replace("_", "+", $string);
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

/*    case "bus":  //Ordena pelos mais BUScados
      return "";*/

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


