<?php
// ===================================================================
// LOGIN_TESTE.PHP  —  ARQUIVO TEMPORÁRIO, SÓ PRA VOCÊ TESTAR SOZINHO
// ===================================================================
// Esse arquivo NÃO faz parte do sistema final. Ele serve só pra criar
// uma sessão "fake" de livraria logada, sem precisar que o Login.php
// de verdade (feito pelos seus colegas) já esteja pronto.
//
// COMO USAR:
//   1. Acesse no navegador: http://localhost/site/Login_Teste.php
//   2. Ele vai te redirecionar automaticamente pro Perfil_livraria.php
//   3. A partir daí, todas as outras páginas (Cadastro, Editar, Excluir)
//      também vão funcionar, porque a sessão já está "logada".
//
// QUANDO SEUS COLEGAS TERMINAREM O LOGIN DE VERDADE:
//   - Apague este arquivo (Login_Teste.php)
//   - Ajuste em Includes/Header.php os nomes de sessão pra bater com
//     o que o Login.php real deles cria
// ===================================================================

session_start(); // Inicia a sessão do PHP

// Cria manualmente as MESMAS variáveis de sessão que o Header.php espera
// (veja o Includes/Header.php: ele confere 'livraria_id' e 'tipo_usuario')
$_SESSION['livraria_id']   = 1;            // Simula um ID de livraria qualquer
$_SESSION['tipo_usuario']  = 'livraria';   // Simula que o tipo de login é "livraria"

// Redireciona pro perfil, já "logado"
header('Location: Perfil_livraria.php');
exit;
