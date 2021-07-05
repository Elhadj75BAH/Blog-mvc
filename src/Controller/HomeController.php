<?php



namespace App\Controller;

use App\Model\BlogPostManager;
use App\Model\CommentManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */


    public function page_accueil()
    {
        //date du jour
        $datej = mktime(0, 0, 0, date("m"), date("d"), date("y"));
        return $this->twig->render('Home/accueil.html.twig',['datej'=>$datej]);
    }

    public function index()
    {
        $blogpostManager = new BlogPostManager();
        $blogs = $blogpostManager->selectAll( 'date_creation','DESC');
        return $this->twig->render('Home/index.html.twig',
            ['blogs'=>$blogs]);
    }

    public function show(int $id): string
    {
        $blogpostManager = new BlogPostManager();
        $blogpost = $blogpostManager->selectOneById($id);

        //traitement d'affichage  pour  commentaire
        $commentManager = new CommentManager();
        //$comments = $commentManager->getComments($id);
         $comments = $commentManager->getCommentsUser($id);
        //traitement d'affichage pour  commentaire

        //si connecté
            if (isset($_SESSION['is_connected']) && $_SESSION['is_connected'] === true){
                //HERE COMMENT
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    //ici
                    if (!empty($_POST['contenu'])){
                        if (isset($_POST)) {
                            $commentManager = new CommentManager();
                            $comment = [
                                'contenu' => $_POST['contenu'],
                                //'status' => $_POST['status'],
                                'article_id' => $id,
                                'user_id' => $_SESSION['id']
                            ];
                            $commentManager->insertComment($comment);
                        }
                       header('Location:/Home/show/' . $id);
                    }//END COMMENT
                }//End connected
            }
        return $this->twig->render('Home/show.html.twig', [
            'blogpost' => $blogpost,
            'comments' => $comments,
        ]);
    }
}
