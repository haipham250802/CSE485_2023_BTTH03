<?php
require_once("./config/DBConnection.php");
class Category
{
    private $ma_tloai, $ten_tloai;
    public function __construct($ma_tloai, $ten_tloai)
    {
        $this->ma_tloai = $ma_tloai;
        $this->ten_tloai = $ten_tloai;
    }
    public function getMa_tloai()
    {
        return $this->ma_tloai;
    }
    public function getTen_tloai()
    {
        return $this->ten_tloai;
    }
    public function setMa_tloai($ma_tloai)
    {
        $this->ma_tloai = $ma_tloai;
    }
    public function setTen_tloai($ten_tloai)
    {
        $this->ten_tloai = $ten_tloai;
    }
    public function Add()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "INSERT INTO theloai(ma_tloai,ten_tloai) VALUES(:ma_tloai, :ten_tloai)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tloai', $this->ma_tloai);
        $stmt->bindParam(':ten_tloai', $this->ten_tloai);
        return $stmt->execute();
    }
    public function Update()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "UPDATE theloai SET ten_tloai = :ten_tloai WHERE ma_tloai = :ma_tloai";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tloai', $this->ten_tloai);
        $stmt->bindParam(':ma_tloai', $this->ma_tloai);
        return $stmt->execute();
    }
    public function Delete()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
        $sql1 = "DELETE FROM baiviet WHERE ma_tloai = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt = $conn->prepare($sql);
        return $stmt1->execute([$this->ma_tloai]) && $stmt->execute([$this->ma_tloai]);
    }
    public static function getById($ma_tloai)
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "SELECT * FROM theloai WHERE ma_tloai = :ma_tloai";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tloai', $ma_tloai);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function getAll()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();
        $sql = "SELECT * FROM theloai";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category($row['ma_tloai'], $row['ten_tloai']);
            array_push($result,
            [
                'ma_tloai' => $category->getMa_tloai(),
                'ten_tloai' => $category->getTen_tloai()
            ]);
        }
        return $result;
    }
}
?>