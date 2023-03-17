<?php
require_once('./models/Article.php');
require_once('AllService.php');
class ArticleService
{
    public static function add($ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh)
    {
        AllService::addAutoPrimaryKey('baiviet','ma_bviet');
        $article = new Article($ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh);
        if ($article->add()) {
            echo "<script>alert('Thêm thành công');</script>";
        } else {
            echo "<script>alert('Thêm thất bại');</script>";
        }
        AllService::delAutoPrimaryKey('baiviet','ma_bviet');
        return $article;
    }
    public static function delete(Article $article)
    {
        if ($article->delete( $article->getMa_bviet())) {
            echo "<script>alert('Xóa thành công');</script>";
        } else {
            echo "<script>alert('Xóa thất bại');</script>";
        }
    }
    public static function getByID($ma_bviet)
    {
        $resultArticle = Article::getByID($ma_bviet);
        $result = [];
        if(is_array($resultArticle)){
            $article = new Article($resultArticle['ma_bviet'], $resultArticle['tieude'], $resultArticle['ten_bhat'], $resultArticle['ma_tloai'], $resultArticle['tomtat'], $resultArticle['noidung'], $resultArticle['ma_tgia'], $resultArticle['ngayviet'], $resultArticle['hinhanh']);
            $result = [
                'ma_bviet' => $article->getMa_bviet(),
                'tieude' => $article->getTieude(),
                'ten_bhat' => $article->getTen_bhat(),
                'ma_tloai' => $article->getMa_tloai(),
                'tomtat' => $article->getTomtat(),
                'noidung' => $article->getNoidung(),
                'ma_tgia' => $article->getMa_tgia(),
                'ngayviet' => $article->getNgayviet(),
                'hinhanh' => $article->gethinhanh(),
            ];
        }
        return $result;
    }
    public static function getAll()
    {
        $resultArticle = Article::getAll();
        $result = [];
        foreach ($resultArticle as $articles) {
            $article = new Article($articles['ma_bviet'], $articles['tieude'], $articles['ten_bhat'], $articles['ma_tloai'], $articles['tomtat'], $articles['noidung'], $articles['ma_tgia'], $articles['ngayviet'], $articles['hinhanh']);
            array_push($result,[
                'ma_bviet' => $article->getMa_bviet(),
                'tieude' => $article->getTieude(),
                'ten_bhat' => $article->getTen_bhat(),
                'ma_tloai' => $article->getMa_tloai(),
                'tomtat' => $article->getTomtat(),
                'noidung' => $article->getNoidung(),
                'ma_tgia' => $article->getMa_tgia(),
                'ngayviet' => $article->getNgayviet(),
                'hinhanh' => $article->gethinhanh(),
            ]);
        }
        return $result;
    }
}
?>