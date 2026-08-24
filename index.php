<?php
// Definimos o ano de nascimento
$ano_nascimento = 1995;

// Pegamos o ano atual de forma automática
$ano_atual = date("Y");

// Calculamos a idade
$idade = $ano_atual - $ano_nascimento;

// Exibimos o resultado
echo "Olá! Você tem $idade anos de idade.";
?>
