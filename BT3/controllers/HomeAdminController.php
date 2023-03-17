<?php
    require_once("./vendor/autoload.php");
    require_once("./config/DBConnection.php");
    require_once("./services/AllService.php");

    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;

    class HomeAdminController{
        private $loader;
        private $twig;

        public function __construct(){
            $this->loader = new FilesystemLoader('./views/homeAdmin');
            $this->twig = new Environment($this->loader);
        }

        public function index(){
            $countCategory = AllService::count('multi','theloai');
            $countAuthor = AllService::count('multi','tacgia');
            $countArticle = AllService::count('multi','baiviet');
            $countUser = AllService::count('multi','users');

            echo $this->twig->render('index.twig',[
                'countCategory' => $countCategory,
                'countAuthor' => $countAuthor,
                'countArticle' => $countArticle,
                'countUser' => $countUser
            ]);
        }
    }
?>