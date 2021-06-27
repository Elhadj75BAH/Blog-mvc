<?php


namespace App\Controller;


use App\Model\BlogPostManager;
use App\Model\UsersManager;

class UsersController extends AbstractController
{
    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nom'])&&!empty($_POST['prenom']) && !empty($_POST['motdepasse']) && !empty($_POST['email'])) {
                $userManager = new UsersManager();
                $user = [
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'motdepasse' => $_POST['motdepasse'] ,
                    'email' => $_POST['email'],
                ];
                $userManager->insert($user);
                $inscriptionsucces =" Inscription avec succès !! ";
               //redirect vers la page de login
                return $this->twig->render('Login/login.html.twig',[
                    'success'=>$inscriptionsucces
                ]);
            }
        }
        return $this->twig->render('users/register.html.twig');
    }
    
    
    //function contact
    public function contact()
    {
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(!empty($_POST['nom'])
                &&!empty($_POST['prenom'])
                &&!empty($_POST['email'])
                &&!empty($_POST['sujet'])
                &&!empty($_POST['message'])){
                $to ="devphptestbah@gmail.com";
                $from ="ismailabah16@gmail.com";

                $email = $_POST['email'];
                $message = $_POST['message'];

                $sujet ='Contact De Elhadj BAH';
                $message = "Message Elhadj BAH: " . $message . " contact email: " . $email;
                $headers = "From: " . $from;
                mail($to,$sujet,$message,$headers);

                $this->twig->addGlobal('session',$_SESSION);
            }
            return $this->twig->render('users/succesContact.html.twig');
        }
        return $this->twig->render('users/contact.html.twig',[
            'session'=>$_SESSION
        ]);
    }


    ///
    ///
    ///
    ///
    ///
    /**
     * List blogposts
     */
    public function index(): string
    {
        $blogpostManager = new BlogPostManager();
        $blogs = $blogpostManager->selectAll('titre');

        return $this->twig->render('users/index.html.twig', ['blogs' => $blogs]);
    }


    /**
     * Show informations for a specific blogpost
     */
    public function show(int $id): string
    {
        $blogpostManager = new BlogPostManager();
        $blogpost = $blogpostManager->selectOneById($id);

        return $this->twig->render('blogpost/show.html.twig', ['blogpost' => $blogpost]);
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