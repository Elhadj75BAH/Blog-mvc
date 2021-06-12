<?php

namespace App\Controller;

use App\Model\BlogPostManager;
use Twig\Extra\String\StringExtension;



class BlogpostController extends AbstractController
{

    /**
     * List blogposts
     */
    public function index(): string
    {
        //si connecté
        if($_SESSION['is_connected']===true ){

            $blogpostManager = new BlogPostManager();
            $blogs = $blogpostManager->selectAll();
            return $this->twig->render('blogpost/index.html.twig', [
                'blogs' => $blogs
            ]);
        }
        //
    }


    /**
     * Show informations for a specific blogpost
     */
    public function show(int $id): string
    {
        $blogpostManager = new BlogPostManager();
        $blogpost = $blogpostManager->selectOneById($id);

        return $this->twig->render('blogpost/show.html.twig', [
            'blogpost' => $blogpost
        ]);
    }


    /**
     * Edit a specific blogpost
     */
    public function edit(int $id): string
    {
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
    }


    /**
     * Add a new blogpost
     */
    public function add(): string
    {
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
    }


    /**
     * Delete a specific blogpost
     */
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blogpostManager = new BlogPostManager();
            $blogpostManager->delete($id);
            header('Location:/blogpost/index');
        }
    }
}
