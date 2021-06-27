<?php

namespace App\Controller;

use App\Model\BlogPostManager;
use App\Model\CommentManager;


class BlogpostController extends AbstractController
{

    /**
     * List blogposts
     */
    public function index(): string
    {
        //si connecté
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2){
            $blogpostManager = new BlogPostManager();
            $blogs = $blogpostManager->selectAll();
            return $this->twig->render('blogpost/index.html.twig', [
                'blogs' => $blogs,
            ]);
        }
        //
       /* $blogpostManager = new BlogPostManager();
        $blogs = $blogpostManager->selectAll();
        return $this->twig->render('blogpost/index.html.twig', [
            'blogs' => $blogs,
        ]);
        //
       */
    }


    /**
     * Show informations for a specific blogpost
     */
    public function show(int $id): string
    {
        //si connecté et le role est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2) {
            $blogpostManager = new BlogPostManager();
            $blogpost = $blogpostManager->selectOneById($id);

            //test commentaire
            $commentManager = new CommentManager();
            $comments = $commentManager->selectAll();
            //test commentaire

            return $this->twig->render('blogpost/show.html.twig', [
                'blogpost' => $blogpost,
                'comments' => $comments
            ]);
        }//
    }


    /**
     * Edit a specific blogpost
     */
    public function edit(int $id): string
    {
        //si connecté et le role est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2) {
            $blogpostManager = new BlogPostManager();
            $blogpost = $blogpostManager->selectOneById($id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // clean $_POST data
                $blogpost = array_map('trim', $_POST);

                // TODO validations (length, format...)

                // if validation is ok, update and redirection
                $blogpostManager->update($blogpost);
                header('Location: /blogpost/show/' . $id);
            }

            return $this->twig->render('blogpost/edit.html.twig', [
                'blogpost' => $blogpost,
            ]);
        }//
    }


    /**
     * Add a new blogpost
     */
    public function add(): string
    {
        //si connecté et le rôle est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // clean $_POST data
                $blogpost = array_map('trim', $_POST);

                // TODO validations (length, format...)

                // if validation is ok, insert and redirection
                $blogpostManager = new BlogPostManager();
                $id = $blogpostManager->insert($blogpost);
                header('Location:/blogpost/show/' . $id);
            }

            return $this->twig->render('blogpost/add.html.twig');
        }//
    }


    /**
     * Delete a specific blogpost
     */
    public function delete(int $id)
    {
        //si connecté et rôle est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 2) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $blogpostManager = new BlogPostManager();
                $blogpostManager->delete($id);
                header('Location:/blogpost/index');
            }
        }//
    }



    //ICI

    //
}
