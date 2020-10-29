<?php

if (empty($_POST['nome']) || empty($_POST['sobrenome'])  || empty($_POST['idade'])  ) {
    echo 'Formulário não preenchido corretamente';
}
 var_dump($_POST);
?>