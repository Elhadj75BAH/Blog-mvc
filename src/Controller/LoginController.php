<?php
namespace App\Controller;

use App\Model\UsersManager;

/**
 * Class LoginController
 *
 */
class LoginController extends AbstractController
{
    // Connexion
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

            if ($result === "User not found") {
                $error = "User not found";
            }

            if ($result === "Incorrect password") {
                $error = "Incorrect password";
            }

           if(isset($result['id'])){
                $_SESSION['is_connected'] = true;
                $_SESSION['id'] = $result['id'];
                $_SESSION['nom'] = $result['nom'];
                $_SESSION['email'] = $result['email'];
               return $this->twig->render('accueil_apres_connexion/apresConnexion.html.twig');
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
}
