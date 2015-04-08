/**-----------------------------------------------------------|*
*|  SIPAC - Sistema Integrado de Painel de Controle V 2.0     |*
*|  Descrição: Funções - Produtos Imagens	                  	|*
*|  Criado:     26/05/2010 | Por: Ana Claudia                 |*
*|  Modificado: __/__/____ | Por:                             |*
*|  Pagina: js/anexa_arquivos.js                              |*
*|------------------------------------------------------------|*/
jQuery(document).ready(function(){
   //Anexar Multiplas imagens
   qtde = 1;
  if(!empty(jQuery("#ImovelFoto"))){


    new AjaxUpload('ImovelFoto', {
			action: 'http://localhost/dmark_novo/imovels/manager_files',
      data: {qtde: qtde+1},
      name: 'foto',
      onComplete : function(file,response){
        //alert(response);
      if(response.match("Erro")){
          $('div#flashMessage').html(response.replace('Erro:',''));
          return false;
        }
        else{
          image = "<img src='/dmark_novo/img/imoveis/" + response + "' alt='' class='' /><br />";
          hidden = "<input name='data[Imovel][foto_img][]' type='hidden' value='" + response + "' />";
          button = "<input type='button' class='submit' value='Excluir' onclick='delete_image(this)'/>";
          $('<div class="box">' + image + hidden +  button + '</div>').appendTo($('div#list_images'));
        }

			}	
		});
  }  
});

function delete_image(obj){
	file = jQuery(obj).prev(0).val();
	linha   = jQuery(obj).parent();
	 
  linha.hide('slow');
	linha.remove();
		  
	jQuery.ajax({
    type: "POST",
    url: 'http://www.dmarkimoveis.com.br/site_teste/imovels/delete_file/'+file,
    async: false,
    success: function(text) {
      //alert(text)
    }
	})
}