<?php

// avisando que estamos trabalhando com o session
session_start();

// Caso o usuário não seja logado, redireciona para o login
if (!$_SESSION['username']) {
  header('Location: login.php');
  exit();  
} 