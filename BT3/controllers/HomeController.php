<?php
    require_once("./vendor/autoload.php");
    require_once('./services/ArticleService.php');

    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;

    class HomeController{
        private $loader;
        private $twig;

        public function __construct(){
            $this->loader = new FilesystemLoader('./views/home');
            $this->twig = new Environment($this->loader);
        }

        public function index(){
            $articles = ArticleService::getAll();
            echo $this->twig->render('index.twig',[
                'articles' => $articles
            ]);
        }
        public function detail(){
            require_once('./services/AuthorService.php');
            require_once('./services/CategoryService.php');
            $ma_bviet ='';
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $ma_bviet = $_GET['ma_bviet'];
            }
            $article = ArticleService::getByID($ma_bviet);
            $author = AuthorService::getByID($article['ma_tgia']);
            $category = CategoryServices::getByID($article['ma_tloai']);
            echo $this->twig->render('detail.twig',[
                'article' => $article,
                'author' => $author,
                'category' => $category
            ]);
        }
    }
?>