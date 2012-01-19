var Loja = function(user_id, senha_xml, tool_id) {
  this.busca = new Busca(user_id, senha_xml);
  this.tool_id = tool_id;

  $('#busca form').submit(function(event) {
    event.preventDefault();
    loja.busca.frase = $('#busca input').val();
    loja.buscar();
  });

  this.buscar = function(frase) {
    this.busca.frase = frase;
    this.busca.buscar(this.listarProdutos);
  };

  this.listarProdutos = function(produtos) {
    $('div#lista_produtos').html('');

    for(var x = 0; x < produtos.length; x++) {
      if (x == 0 && $('div#destaque').is('div')) {
        loja.exibeDestaque(produtos[0]);
      } else {
        loja.exibeProduto(produtos[x]);
      }
    }
  };

  this.exibeDestaque = function(produto) {
    $('div#destaque').html(produto.toHtml());
  };

  this.exibeProduto = function(produto) {
    $(produto.toHtml()).appendTo('div#lista_produtos');
  };
};