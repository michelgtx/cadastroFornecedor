
<div class="container">
   

    <header >
    
        <img src="fundo_index/testeazulUp.png"/>
<!--    <img src="fundo_index/teste22.png"/>-->
    <link href="estilos_cadastro.css" rel="stylesheet" />
</header>




<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();

if (isset($_SESSION['logado']) &&
        $_SESSION['logado'] == TRUE) {
    ?>

    <nav class="menu">
        
        <a href="fornecedores.php" name="fornecedores"><br>
            <button class="btn btn-info">Fornecedores</button></a>


        <a href="materiais.php">
            <button class="btn btn-info">Materiais</button></a>

<!--            <a href="admins.php">
                    <button>Cadastrar Admins </button></a>-->

  
        <a href="sair.php">
            <button  class="btn btn-danger">Sair</button></a>



        <img width="40px" src="fotos_admins/<?php echo $_SESSION['foto'] ?>" />


        <?php echo $_SESSION['nome'] ?> - Acesso Administrativo  

  
    </nav>
        
    <?php
} else {
    ?>


    <form action="entrar.php" method="POST" >


        <div class="container_login" >


            <div class="control-group"><br>
                <!--                             <label class="control-label">Admin:</label> -->
                <div class="controls">
<br><br>
                    <input  type="text"  placeholder="Digite seu Admin..." name="login" </>
                </div>
            </div>

            <div class="control-group">

                <!--                            <label class="control-label" >Senha:</label>-->
                <div class="controls">
                    <input type="password"  placeholder="Digite sua Senha..." name="senha" />
                </div>
            </div>

            <div class="control-group">
                <div class="controls">

                    <button class="btn btn-primary" style="width: 219px;"  type="submit" name="entrar" value="Entrar"> Entrar </button>
                </div>
            </div>



        </div>



    </form>
    </div>

    <?php
}
?>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

