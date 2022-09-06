<?php
    include 'conexao.php';
    
    $sqlVerificar = "SELECT * FROM usuario where id_usuario =" . $_SESSION['id_usuario'] . " AND email_usuario ='" . $_SESSION['email'] . "' AND senha_usuario ='" . $_SESSION['senha'] ."';";
    $verificar = mysqli_query($conexao, $sqlVerificar);
    if(mysqli_num_rows($verificar)>0){
        while($log = mysqli_fetch_array($verificar)){
            if($log['tipo_usuario']==1){
                header('location:./perfil_consumidor.php');
            }else if ($log['tipo_usuario']==2){ // FOTOGRAFO
                $sql_planos = ('select * from planos where id_fotografo = '.$_SESSION['id_usuario'].';');
                $planos = mysqli_query($conexao, $sql_planos);
                if(mysqli_num_rows($planos)>0){
                    header('location:./perfil_fotografo.php');
                    //echo('<script>window.location.href:"./perfil_fotografo.php";</script>');
                }else{
                    header('location:./planos.php');
                    //echo('<script>window.location.href:"./planos.php";</script>');
                }
            }else if ($log['tipo_usuario']==3){
                header('location:./management.php');
                //echo('<script>window.location:"./management.php";</script>');
            }else{
                echo ("<script>window.alert('Não há usuário cadastrado com essas características');</script>");
                //echo ("<script>window.alert('Não há usuário cadastrado com essas características');</script>");
            }
        }
    }
?>