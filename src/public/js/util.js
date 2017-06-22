/**
 * Created by guilherme.zupolini on 22/06/2017.
 */

validaCamposObrigatorios = function (elementos) {
    var valida = true;
    $('form ' + elementos).each(function () {
        $(this).parent('div').removeClass("has-error");
       if($(this).attr("required") && !$.trim($(this).val())){
           $(this).parent('div').addClass("has-error");
           valida = false;
       }
    });
    return valida;
};

alertMessage = function (msg, tipo, painel) {
    $(painel).show()
    .html("<p>"+ msg +"<button type='button' class='close' aria-label='Close' id='btnCloseAlert'><span aria-hidden='true'>&times;</span></button></p>");
  if(tipo == "sucesso"){
      $(painel).addClass('alert-success').removeClass('alert-danger');
  }else{
      $(painel).addClass('alert-danger').removeClass('alert-success');
  }

  $('#btnCloseAlert').click(function () {
     $(painel).hide();
  });
};

voltarTopo = function () {
    $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
};
