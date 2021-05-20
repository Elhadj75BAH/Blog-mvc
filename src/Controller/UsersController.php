<?php


namespace App\Controller;


use App\Model\UsersManager;

class UsersController extends AbstractController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nom']) && !empty($_POST['motdepasse']) && !empty($_POST['email'])) {
                $userManager = new UsersManager();
                $user = [
                    'nom' => $_POST['nom'],
                    'motdepasse' => $_POST['motdepasse'] ,
                    'email' => $_POST['email'],
                ];
                $userManager->insert($user);
                /* TODO : ICI AJOUTER REDIRECTION VERS PAGE LOGIN */
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

                $sujet =['Contact De Elhadj BAH'];
                $message = "Message Elhadj BAH: " . $message . " contact email: " . $email;
                $headers = "from: " . $from;

                mail($to,$sujet,$message,$headers);
                return $this->twig->render('users/succesContact.html.twig');
            }
        }
        return $this->twig->render('users/contact.html.twig');
    }
}