var Busca = function(user_id, senha_xml) {
  this.url_base = "http://www.mercadolivre.com.br/jm/searchXml?as_site_id=MLB&user="+user_id
    +"&pwd="+senha_xml+"&as_qshow=21&charset=UTF-8";
  this.frase = "";
  this.categoria = 0;
  this.ordenacao = "des";
  this.preco = {minimo: 0, maximo: 0};
  this.produtos = [];

  this.geraUrl = function() {
    var url = this.url_base;
    if (this.frase != "") { url += "&as_word=" + this.preparaFrase(); } else { url += "&as_word=iphone4s"; }
    if (this.categoria != 0) { url += "&as_categ_id=" + this.categoria; }
    if (this.ordenacao != "des") { url += ""; }
    if (this.preco.minimo != 0) { url += ""; }
    if (this.preco.maximo != 0) { url += ""; }
    return url;
  };

  this.preparaFrase = function() {
    return this.frase.replace(/\s|(%20)|_/g, "+");
  };

  this.buscar = function(callback) {
    var self = this; //Vai perder o this dentro do .each() adiante, então precisamos de uma referência a esta classe
    this.produtos = [];
    
    $.ajax({
			url: './proxy.php', 
			type: 'POST',
			data: { url: this.geraUrl() },
			success: function(xml_produtos) {
        //Quando pega o xml de produtos do mercado livre, cria um objeto Produto pra cada um. 
        $(xml_produtos).find('item').each(function(n, item) {
    			self.produtos.push(new Produto(item));
        });
        
        //Depois chama a função de callback que foi definida, devolvendo a lista de objetos Produto
        callback(self.produtos); 
      },
			context: this
		});
  };
};
