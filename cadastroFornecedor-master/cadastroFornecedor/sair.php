<?php

session_start();

if( isset( $_SESSION['logado']) ){
    unset( $_SESSION['logado'] );
}

if( isset( $_SESSION['idAdmin']) ){
    unset( $_SESSION['idAdmin'] );
}

if( isset( $_SESSION['nome']) ){
    unset( $_SESSION['nome'] );
}

if( isset( $_SESSION['foto']) ){
    unset( $_SESSION['foto'] );
}



session_destroy();

header("Location: index.php");
