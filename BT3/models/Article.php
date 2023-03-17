<?php
require_once('./config/DBConnection.php');
class Article {
    private $ma_bviet,$tieude,$ten_bhat,$ma_tloai,$tomtat,$noidung,$ma_tgia,$ngayviet,$hinhanh;
    public function __construct($ma_bviet,$tieude,$ten_bhat,$ma_tloai,$tomtat,$noidung,$ma_tgia,$ngayviet,$hinhanh){
        $this->ma_bviet = $ma_bviet;
        $this->tieude = $tieude;
        $this->ten_bhat = $ten_bhat;
        $this->ma_tloai = $ma_tloai;
        $this->tomtat = $tomtat;
        $this->noidung = $noidung;
        $this->ma_tgia = $ma_tgia;
        $this->ngayviet = $ngayviet;
        $this->hinhanh = $hinhanh;
    }

    //set
    public function setMa_bviet($ma_bviet){
        $this->ma_bviet = $ma_bviet;
    }
    public function setTieude($tieude){
        $this->tieude = $tieude;
    }
    public function setTen_bhat($ten_bhat){
        $this->ten_bhat = $ten_bhat;
    }
    public function setMa_tloai($ma_tloai){
        $this->ma_tloai = $ma_tloai;
    }
    public function setTomtat($tomtat){
        $this->tomtat = $tomtat;
    }
    public function setNoidung($noidung){
        $this->noidung = $noidung;
    }
    public function setMa_tgia($ma_tgia){
        $this->ma_tgia = $ma_tgia;
    }
    public function setNgayviet($ngayviet){
        $this->ngayviet = $ngayviet;
    }
    public function setHinhanh($hinhanh){
        $this->hinhanh = $hinhanh;
    }
    //get
    public function getMa_bviet(){
        return $this->ma_bviet;
    }
    public function getTieude(){
        return $this->tieude;
    }
    public function getTen_bhat(){
        return $this->ten_bhat;
    }
    public function getMa_tloai(){
        return $this->ma_tloai;
    }
    public function getTomtat(){
        return $this->tomtat;
    }
    public function getNoidung(){
        return $this->noidung;
    }
    public function getMa_tgia(){
        return $this->ma_tgia;
    }
    public function getNgayviet(){
        return $this->ngayviet;
    }
    public function getHinhanh(){
        return $this->hinhanh;
    }

    public function add(){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        
        $sql = "INSERT INTO baiviet(ma_bviet,tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,ngayviet,hinhanh) 
        VALUE(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $this->ma_bviet,
            $this->tieude,
            $this->ten_bhat,
            $this->ma_tloai,
            $this->tomtat,
            $this->noidung,
            $this->ma_tgia,
            $this->ngayviet,
            $this->hinhanh]);
    }
    public function update( $ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();

        $sql = "UPDATE baiviet SET tieude=?,ten_bhat=?,ma_tloai=?,tomtat=?,noidung=?,ma_tgia=?,ngayviet=?,hinhanh=? WHERE ma_bviet=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->tieude, $this->ten_bhat, $this->ma_tloai, $this->tomtat, $this->noidung, $this->ma_tgia, $this->ngayviet, $this->hinhanh, $this->ma_bviet]);
        $article = new Article($ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh);
        $article->setMa_bviet($ma_bviet);
        $article->setTieude($tieude);
        $article->setTen_bhat($ten_bhat);
        $article->setMa_tloai($ma_tloai);
        $article->setTomtat($tomtat);
        $article->setNoidung($noidung);
        $article->setMa_tgia($ma_tgia);
        $article->setNgayviet($ngayviet);
        $article->setHinhanh($hinhanh);
        if ($article->update( $ma_bviet, $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh)) {
            echo "<script>alert('Sửa thành công');</script>";
        } else {
            echo "<script>alert('Sửa thất bại');</script>";
        }
        return $article;
    }
    public function delete(Article $ma_bviet){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();

        $sql = "DELETE FROM baiviet WHERE ma_bviet=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ma_bviet->getMa_bviet()]);
        if ($stmt->execute()) {
            echo "<script>alert('Xóa thành công');</script>";
        } else {
            echo "<script>alert('Xóa thất bại');</script>";
        }
    }
    public static function getById( $ma_bviet){
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "SELECT * FROM baiviet WHERE ma_bviet = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ma_bviet]);
        $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['ma_tloai'], $row['tomtat'], $row['noidung'], $row['ma_tgia'], $row['ngayviet'], $row['hinhanh']);
            array_push($result, [
                'ma_bviet' => $article->getMa_bviet(),
                'tieude' => $article->getTieude(),
                'ten_bhat' => $article->getTen_bhat(),
                'ma_tloai' => $article->getMa_tloai(),
                'tomtat' => $article->getTomtat(),
                'noidung' => $article->getNoidung(),
                'ma_tgia' => $article->getMa_tgia(),
                'ngayviet' => $article->getNgayviet(),
                'hinhanh' => $article->getHinhanh()
            ]);
        }
        return $result;
    }
    public static function getAll(){
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();
        $sql = "SELECT * FROM baiviet";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['ma_tloai'], $row['tomtat'], $row['noidung'], $row['ma_tgia'], $row['ngayviet'], $row['hinhanh']);
            array_push($result, [
                'ma_bviet' => $article->getMa_bviet(),
                'tieude' => $article->getTieude(),
                'ten_bhat' => $article->getTen_bhat(),
                'ma_tloai' => $article->getMa_tloai(),
                'tomtat' => $article->getTomtat(),
                'noidung' => $article->getNoidung(),
                'ma_tgia' => $article->getMa_tgia(),
                'ngayviet' => $article->getNgayviet(),
                'hinhanh' => $article->getHinhanh()
            ]);
        }
        return $result;
    }
}
?>