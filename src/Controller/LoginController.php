<?php

namespace App\Controller;

use App\Model\BlogPostManager;
use App\Model\CommentManager;
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
            } else {// on verifie si le mot de passe entré est correct
                if (password_verify($_POST['motdepasse'], $result['motdepasse'])) {
                    if (isset($result['id'])) {
                        $_SESSION['is_connected'] = true;
                        $_SESSION['id'] = $result['id'];
                        $_SESSION['nom'] = $result['nom'];
                        $_SESSION['prenom'] = $result['prenom'];
                        $_SESSION['email'] = $result['email'];
                        //session admin
                        $_SESSION['admin'] = $result['admin'];

                        header('Location: /Login/connexion/');
                    }
                } else {
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
        header('Location: /home/pageAccueil');
    }

    //ESPACE USER
    public function connexion()
    {
        //si connecté et le role est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            //traitement d'affichage  liste detaillés des commentaires
             $commentManager = new CommentManager();
             $comments = $commentManager->getBlogpostComment();
            // Fin traitement d'affichage liste detaillés des commentaire

            //gestion blogpost
            $blogpostManager = new BlogPostManager();
            $blogs = $blogpostManager->selectAll();
            //fin gestion blogpost

            //liste des articles espace Home
            $articleManager = new BlogPostManager();
            $articles = $articleManager->selectAll('date_creation', 'DESC LIMIT 6');
            //fin liste des article Home
            return $this->twig->render('connexion/apresConnexion.html.twig', ['session' => $_SESSION,
                'comments' => $comments,
                'blogs' => $blogs,
                'articles' => $articles
                ]);
        }
        //liste des article Home
        $articleManager = new BlogPostManager();
        $articles = $articleManager->selectAll('date_creation', 'DESC LIMIT 6');
        //fin liste des article Home
        return $this->twig->render('connexion/apresConnexion.html.twig', [
            'session' => $_SESSION,
            'articles' => $articles,
        ]);
    }

    // DELETE COMMENT
    /**
     * Delete a specific comment
     */
    public function delete(int $id)
    {
        //si connecté et rôle est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $commentDelete = new CommentManager();
                $commentDelete->delete($id);
                header('Location:/login/connexion');
            }
        }
    }
    
    // VALIDATION
    public function valideComment(int $id)
    {
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $commentValide = new CommentManager();
                $commentValide->validStatus($id);
                header('Location:/login/connexion');
            }
        }
    }

    // DESACTIVE COMMENT
    public function desactiveComment(int $id)
    {
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $commentDesactive = new CommentManager();
                $commentDesactive->desactiveComments($id);
                header('Location:/login/connexion');
            }
        }
    }
}
