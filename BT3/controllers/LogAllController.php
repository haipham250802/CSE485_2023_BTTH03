<?php
    require_once("./vendor/autoload.php");
    require_once('./services/ArticleService.php');

    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;

    class LogAllController{
        private $loader;
        private $twig;

        public function __construct(){
            $this->loader = new FilesystemLoader('./views/homeAdmin');
            $this->twig = new Environment($this->loader);
        }

        public function index(){
            $articles = ArticleService::getAll();
            echo $this->twig->render('index.twig');
        }
    }
?>