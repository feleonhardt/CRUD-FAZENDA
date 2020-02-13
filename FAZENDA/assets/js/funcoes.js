$(document).ready(function(){
  $("#tabela").change(function() {
   var campo_pesquisa = ($('#tabela option:selected').val());
   if ((campo_pesquisa) == "carros"){
      $("#coluna_disable").css("display", "none");
      $("#carros").css("display", "block");
      $("#computadores").css("display", "none");
      $("#escolas").css("display", "none");
      $("#funcionarios").css("display", "none");
      $("#predios").css("display", "none");
      $("#vendedores").css("display", "none");
    }else if ((campo_pesquisa) == "computadores"){
      $("#coluna_disable").css("display", "none");
      $("#carros").css("display", "none");
      $("#computadores").css("display", "block");
      $("#escolas").css("display", "none");
      $("#funcionarios").css("display", "none");
      $("#predios").css("display", "none");
      $("#vendedores").css("display", "none");
    }else if ((campo_pesquisa) == "escolas"){
      $("#coluna_disable").css("display", "none");
      $("#carros").css("display", "none");
      $("#computadores").css("display", "none");
      $("#escolas").css("display", "block");
      $("#funcionarios").css("display", "none");
      $("#predios").css("display", "none");
      $("#vendedores").css("display", "none");
    }else if ((campo_pesquisa) == "funcionarios"){
      $("#coluna_disable").css("display", "none");
      $("#carros").css("display", "none");
      $("#computadores").css("display", "none");
      $("#escolas").css("display", "none");
      $("#funcionarios").css("display", "block");
      $("#predios").css("display", "none");
      $("#vendedores").css("display", "none");
    }else if ((campo_pesquisa) == "predios"){
      $("#coluna_disable").css("display", "none");
      $("#carros").css("display", "none");
      $("#computadores").css("display", "none");
      $("#escolas").css("display", "none");
      $("#funcionarios").css("display", "none");
      $("#predios").css("display", "block");
      $("#vendedores").css("display", "none");
    }else if ((campo_pesquisa) == "vendedores"){
      $("#coluna_disable").css("display", "none");
      $("#carros").css("display", "none");
      $("#computadores").css("display", "none");
      $("#escolas").css("display", "none");
      $("#funcionarios").css("display", "none");
      $("#predios").css("display", "none");
      $("#vendedores").css("display", "block");
    }else{
      $("#coluna_disable").css("display", "block");
      $("#carros").css("display", "none");
      $("#computadores").css("display", "none");
      $("#escolas").css("display", "none");
      $("#funcionarios").css("display", "none");
      $("#predios").css("display", "none");
      $("#vendedores").css("display", "none");
    }
  });
  $("#coluna_carros").change(function() {
   var campo_pesquisa = ($('#coluna_carros option:selected').val());
   if ((campo_pesquisa) != ''){
     $("#busca").css("display", "block");
     $("#sem_busca").css("display", "none");
   }else{
     $("#busca").css("display", "none");
     $("#sem_busca").css("display", "block");
   }
  });
  $("#coluna_computadores").change(function() {
   var campo_pesquisa = ($('#coluna_computadores option:selected').val());
   if ((campo_pesquisa) != ''){
     $("#busca").css("display", "block");
     $("#sem_busca").css("display", "none");
   }else{
     $("#busca").css("display", "none");
     $("#sem_busca").css("display", "block");
   }
  });
  $("#coluna_funcionarios").change(function() {
   var campo_pesquisa = ($('#coluna_funcionarios option:selected').val());
   if ((campo_pesquisa) != ''){
     $("#busca").css("display", "block");
     $("#sem_busca").css("display", "none");
   }else{
     $("#busca").css("display", "none");
     $("#sem_busca").css("display", "block");
   }
  });
  $("#coluna_escolas").change(function() {
   var campo_pesquisa = ($('#coluna_escolas option:selected').val());
   if ((campo_pesquisa) != ''){
     $("#busca").css("display", "block");
     $("#sem_busca").css("display", "none");
   }else{
     $("#busca").css("display", "none");
     $("#sem_busca").css("display", "block");
   }
  });
  $("#coluna_predios").change(function() {
   var campo_pesquisa = ($('#coluna_predios option:selected').val());
   if ((campo_pesquisa) != ''){
     $("#busca").css("display", "block");
     $("#sem_busca").css("display", "none");
   }else{
     $("#busca").css("display", "none");
     $("#sem_busca").css("display", "block");
   }
  });
  $("#coluna_vendedores").change(function() {
   var campo_pesquisa = ($('#coluna_vendedores option:selected').val());
   if ((campo_pesquisa) != ''){
     $("#busca").css("display", "block");
     $("#sem_busca").css("display", "none");
   }else{
     $("#busca").css("display", "none");
     $("#sem_busca").css("display", "block");
   }
  });
});
