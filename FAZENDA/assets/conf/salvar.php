<?php

  // include("Conexao.php");
  try {
    $HOST = "localhost";
    $BANCO = "u949930417_location";
    $USUARIO = "u949930417_feleonhardt";
    $SENHA = "bailarina03";

    $PDO = new PDO("mysql:host=".$HOST.";dbname=".$BANCO.";charset=utf8", $USUARIO, $SENHA);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $erro) {
    echo "Erro de econexão, detalhes: ".$erro->getMessage();
    // echo "conexao_erro";
  }

  $lng = $_GET['lng'];
  $lat = $_GET['lat'];
  $data = $_GET['data'];
  $placa = $_GET['placa'];

  $sql = "INSERT INTO dados_novo (latitude, longitude, hora, placa) VALUES (:latitude, :longitude, :hora, :placa)";

  $stmt = $PDO->prepare($sql);

  $stmt->bindParam(':latitude', $lat);
  $stmt->bindParam(':longitude', $lng);
  $stmt->bindParam(':hora', $data);
  $stmt->bindParam(':placa', $placa);


  if ($lat != 0.000000 and $lng != 0.000000 and $data != 'null') {
    if ($stmt->execute()) {
      echo "salvo_com_sucesso";
    }else {
      echo "erro_ao_salvar";
    }
  }else {
    echo "erro_ao_salvar";
  }
  // ------- tirar do comentário para funcionar------


?>
