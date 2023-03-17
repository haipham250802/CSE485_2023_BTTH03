<?php
require_once ("./vendor/autoload.php");
require_once("./models/Article.php");

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class ArticleController{
    private $loader;
    private $twig;
    public function __construct(){
        $this->loader = new FilesystemLoader('./views/article');
        $this->twig = new Environment($this->loader);
    }
    public function index(){
        $articles = Article::getAll();
        // var_dump($articles);
        echo $this->twig->render('index.twig',[
            'articles' => $articles
        ]);
    }
    public function edit(){
        require_once("./services/AuthorService.php");
        require_once("./services/CategoryService.php");
        
        $ma_bviet = $ma_tloai = $ma_tgia ='';
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $ma_bviet = $_GET['ma_bviet'];
            $ma_tloai = $_GET['ma_tloai'];
            $ma_tgia = $_GET['ma_tgia'];
        }

        $getIdArticle = Article::getByID($ma_bviet);
        $getAllAuthor = AuthorService::getAll();
        $getAllCategory = CategoryServices::getAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ma_bviet1 = $_POST['ma_bviet'];
            $tieude = $_POST['tieude'];
            $ten_bhat = $_POST['ten_bhat'];
            $ma_tloai1 = $_POST['ma_tloai'];
            $tomtat = $_POST['tomtat'];
            $noidung = $_POST['noidung'];
            $ma_tgia1 = $_POST['ma_tgia'];
            $ngayviet = $_POST['ngayviet'];
            $hinhanh = $_POST['hinhanh'];
            if(isset($_POST['edit'])){
                Article::update($ma_bviet1, $tieude, $ten_bhat, $ma_tloai1, $tomtat, $noidung, $ma_tgia1, $ngayviet, $hinhanh);
                echo "<script>window.location.href = 'index.php?controller=article'</script>";
            }
        }
        echo $this->twig->render('edit.twig',[
            'ma_bviet' => $ma_bviet,
            'ma_tloai' => $ma_tloai,
            'ma_tgia' => $ma_tgia,
            'getIdArticle' => $getIdArticle,
            'getAllAuthor' => $getAllAuthor,
            'getAllCategory' => $getAllCategory
        ]);
    }
    public function add(){
        require_once("./services/AuthorService.php");
        require_once("./services/CategoryService.php");

        $getAllAuthor = AuthorService::getAll();
        $getAllCategory = CategoryServices::getAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tieude = $_POST['tieude'];
            $ten_bhat = $_POST['ten_bhat'];
            $ma_tloai = $_POST['ma_tloai'];
            $tomtat = $_POST['tomtat'];
            $noidung = $_POST['noidung'];
            $ma_tgia = $_POST['ma_tgia'];
            $ngayviet = $_POST['ngayviet'];
            $hinhanh = $_POST['hinhanh'];

            if(isset($_POST['add'])){
                Article::add('', $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh);
                echo "<script>window.location.href = 'index.php?controller=article'</script>";
            }
        }
        echo $this->twig->render('add.twig',[
            'getAllAuthor' => $getAllAuthor,
            'getAllCategory' => $getAllCategory
        ]);
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $ma_bviet = $_GET['ma_bviet'];
            if($_GET['action'] == 'delete'){
                $getId= Article::getByID($ma_bviet);
                $article = new Article($getId['ma_bviet'], $getId['tieude'], $getId['ten_bhat'], $getId['ma_tloai'], $getId['tomtat'], $getId['noidung'], $getId['ma_tgia'], $getId['ngayviet'], $getId['hinhanh']);
                $article->delete( $ma_bviet);
                echo "<script>window.location.href = 'index.php?controller=article'</script>";
            }
        }
    }
}
?>