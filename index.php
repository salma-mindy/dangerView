<?php
    session_start();
    $errorMsg = "";
    if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
        require_once './php/db.php';

        $req = $db->prepare('SELECT * FROM utilisateurs WHERE motDepasse = :password');
        $req->execute(['password' => $_POST['password']]);

        $user = $req->fetch();
        //var_dump($user->idRole);exit();
        if(isset($user->idRole)){
            switch($user->idRole){
                case "1":
                    header('Location: ./admin/admin_home.php');
                    break;
                case "2":
                    header('Location: ./operateurs/operateur_home.php'); 
                    break;
                default:
                    header('Location: index.php');
                    
            }
        }else{
            header('Location: index.php');
            $errorMsg = "Vos Identifiants sont incorrect";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './include/head.php' ?>
</head>

<body class="mon-formulaire">
    <form method="post" class="form-admin rounded shadow shadow-sm py-5 p-4 justify-content-center" action="">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">
                Identifiez-Vous
            </h1>
            <small>
               
                        <div class="">
                            <?= $errorMsg ?>
                        </div>
            </small>
        </div>
        <div class="form-label-group">
            <input type="email" id="email" name="email" class="form-control">
            <label for="email">Adresse Email</label>
        </div>
        <div class="form-label-group">
            <input type="text" id="password" name="password" class="form-control">
            <label for="password">Mot de passe</label>
        </div>
        <div class="checkbox mb-3">
            <label>
                    <input type="checkbox" value="Garder ma section active">
                    Garder ma section active
                </label>
        </div>
        <input class="btn btn-lg btn-block" type="submit" name="btn_login" value="S'IDENTIFIER">
            <div class="text-center mb-4 mt-2">
              <small>Vous êtes un agent ? Cliquez <a href="#">ici</a></small>
            </div> 
    </form>

    <?php require_once './include/bootstrap-script.php' ?>
</body>

</html>