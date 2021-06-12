<?php
namespace App\Controller;

use App\Model\UsersManager;

/**
 * Class LoginController
 *
 */
class LoginController extends AbstractController
{
    // Login
    public function login()
    {

        $error = '';
        $userManager = new UsersManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = [
                'email' => $_POST['email'],
                'motdepasse' => $_POST['motdepasse']
            ];
            $result = $userManager->checkUserConnection($login);
          // si pas de resultat
            if (!$result) {
                $error = "Aucun utilisateur  trouvé :)";
            }else{// on verifie si le mot de passe entré est correct
                if(password_verify($_POST['motdepasse'],$result['motdepasse'])){
                    if(isset($result['id'])){
                        $_SESSION['is_connected'] = true;
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['nom'] = $result['nom'];
                        $_SESSION['prenom'] = $result['prenom'];
                        $_SESSION['email'] = $result['email'];
                        //echo 'vous êtes connecté '.$_SESSION['nom'];
                        return $this->twig->render('connexion/apresConnexion.html.twig',[
                            'session'=>$_SESSION
                        ]);
                    }
                }else{
                    $error = "Votre mot de passe est erroné ";
                }
            }
        }
        return $this->twig->render('Login/login.html.twig', ['error' => $error]);
    }
// Deconnexion
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /login/login');
    }

    //
    public function connexion(){
        return $this->twig->render('connexion/apresConnexion.html.twig',[
            'session'=>$_SESSION
        ]);
    }


}
