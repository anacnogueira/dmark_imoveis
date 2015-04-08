$(document).ready(function() {
   get_bairros(jQuery("#ImovelCidadeId"),jQuery('#ImovelBairroId'));
});
function empty(valor){
    if(valor == "" || valor == 0 || valor == null || valor == undefined)
      return true;
    else
      return false;
  }

function get_bairros(campo_cidade,campo_bairro){
    campo_cidade.change(function(){

      var cidade_sel  = $(this).val();
      var dropdownSet = campo_bairro;

      if(empty(cidade_sel)){
        dropdownSet.attr("disabled",true);
        $(dropdownSet).emptySelect();
      }
      else {
        dropdownSet.attr("disabled",false);
        $.ajax({
          type: "GET",
          url: "http://localhost/dmark_novo/imovels/get_bairros/"+ cidade_sel,
          contentType: "application/json; charset=ISO-8859-1",
          dataType: "json",
          success: function(json) { 
            $(dropdownSet).loadSelect(json);
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Erro: " + XMLHttpRequest.responseText);
          }
        });
      }
    });
  }