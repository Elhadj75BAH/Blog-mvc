<?php
namespace App\Controller;

use App\Model\BlogPostManager;
use App\Model\CommentManager;
use App\Model\UsersManager;
use Hoa\Iterator\Limit;

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
                        //session admin
                        $_SESSION['admin']=$result['admin'];

                        header('Location: /Login/connexion/');
                    }
                }else{
                    $error = "Votre mot de passe ou email est erroné ";
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
        header('Location: /home/page_accueil');
    }

    //ESPACE USER
    public function connexion(){
        //si connecté et le role est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2) {
            //traitement d'affichage  pour  commentaire
            $commentManager = new CommentManager();
            $comments = $commentManager->selectAll('date_creation','DESC');
            //traitement d'affichage pour  commentaire
            //button validator comment
            if (isset($_POST['status'])==true) {
                // do this
            }

            //fin button validator comment
            //gestion blogpost
            $blogpostManager = new BlogPostManager();
            $blogs = $blogpostManager->selectAll();
            //fin gestion blogpost

            //liste des articles espace Home
            $articleManager = new BlogPostManager();
            $articles = $articleManager->selectAll('date_creation','DESC LIMIT 6');
            //fin liste des article Home
            return $this->twig->render('connexion/apresConnexion.html.twig',[
                'session'=>$_SESSION,
                'comments'=>$comments,
                'blogs'=>$blogs,
                'articles'=>$articles
            ]);
        }
        //liste des article Home
        $articleManager = new BlogPostManager();
        $articles = $articleManager->selectAll('date_creation','DESC LIMIT 6');
        //fin liste des article Home
        return $this->twig->render('connexion/apresConnexion.html.twig',[
            'session'=>$_SESSION,
            'articles'=>$articles
        ]);
    }

    // DELETE COMMENT
    /**
     * Delete a specific comment
     */
    public function delete(int $id)
    {
        //si connecté et rôle est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $comments = new CommentManager();
                $comments->delete($id);
                header('Location:/login/connexion');
            }
        }//
    }


}
