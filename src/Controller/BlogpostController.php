<?php

namespace App\Controller;

use App\Model\BlogPostManager;
use App\Model\CommentManager;
//use App\Model\BlogPost;

class BlogpostController extends AbstractController
{

    /**
     * List blogposts
     */
    public function index(): ?string
    {
        //si connecté
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            $blogpostManager = new BlogPostManager();
            $blogs = $blogpostManager->selectAll();
            return $this->twig->render('blogpost/index.html.twig', [
                'blogs' => $blogs,
                'session' =>$_SESSION
            ]);
        }
        
    }


    /**
     * Show informations for a specific blogpost
     */
    public function show(int $id): string
    {
        //si connecté et le role est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            $blogpostManager = new BlogPostManager();
            $blogpost = $blogpostManager->selectOneById($id);

            //Recuperation Commentaires
            $commentManager = new CommentManager();
            $comments = $commentManager->selectAll();
            
            return $this->twig->render('blogpost/show.html.twig', [
                'blogpost' => $blogpost,
                'comments' => $comments,
                'session' =>$_SESSION
            ]);
        }//
    }


    /**
     * Edit a specific blogpost
     */
    public function edit(int $id): string
    {
        //si connecté et le role est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            $blogpostManager = new BlogPostManager();
            $blogpost = $blogpostManager->selectOneById($id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $blogpost = array_map('trim', $_POST);
                
                $blogpostManager->update($blogpost);
                header('Location: /blogpost/show/' . $id);
            }

            return $this->twig->render('blogpost/edit.html.twig', [
                'blogpost' => $blogpost,
                'session' =>$_SESSION
            ]);
        }//
    }


    /**
     * Add a new blogpost
     */
    public function add(): string
    {
        //si connecté et le rôle est admin
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $blogpost = array_map('trim', $_POST);
                
                $blogpostManager = new BlogPostManager();
                $id = $blogpostManager->insert($blogpost);
                header('Location:/blogpost/show/' . $id);
            }

            return $this->twig->render('blogpost/add.html.twig',['session' =>$_SESSION]);
        }//
    }


    /**
     * Delete a specific blogpost
     */
    public function delete(int $id)
    {
        if (isset($_SESSION) && $_SESSION['is_connected'] === true && $_SESSION['admin'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $blogpostManager = new BlogPostManager();
                $blogpostManager->delete($id);
                header('Location:/blogpost/index');
            }
        }//
    }

}
