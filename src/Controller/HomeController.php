<?php



namespace App\Controller;

use App\Model\BlogPostManager;

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

        return $this->twig->render('Home/show.html.twig', [
            'blogpost' => $blogpost
        ]);
    }

}
