<?php

$conn  = mysqli_connect('localhost','root','','Letteldatabase'); // Host, usuário, senha e database de conexão com o BD
mysqli_set_charset( $conn, 'utf8'); // mantendo acentuação correta ao exibir a informação para o usuário
$busca =  $_POST['busca'];

if ($busca != '') {

$query = mysqli_query($conn, "SELECT nome,requisitos,orgao,atende,resposta FROM switches INNER JOIN dados on switches.id_pk_switches = dados.id_pk_switches WHERE requisitos LIKE '%$busca%' or nome LIKE '%$busca%' or orgao LIKE '%$busca%' or resposta LIKE '%$busca%' ");
$num   = mysqli_num_rows($query);
if($num >0){
    while($row = mysqli_fetch_assoc($query)){
	  ?> 
	  	<div class="jumbotron jumbotron-fluid">
	  	 	
	  <?php
				echo 'Modelo: <b>'. $row['nome']. '</b> | Atende? <b>'.$row['atende'].'</b> | Solicitado por: <b>'.$row['orgao'].'</b><hr>Item do Edital: <b>'.$row['requisitos'].'</b> <br /><hr>Resposta Lettel<b>: '. $row['resposta'].'</b>';
	  ?> 	
			
	  	</div> 
	  <?php
      
    }
}else{
  echo "Não existem dados relacionados com essa palavra.";
}

} else {
	// trecho para fazer sumir os dados na div de resultados quando o usuário apagar as palavras do campo de pesquisa
	?> <script>

	$("#result").html();

	</script> <?php
}

?>