<?php


namespace App\Controller;


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
}