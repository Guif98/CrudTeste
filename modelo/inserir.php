<?php

if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['idade'])) {
    Contato::inserir();
}

?>