<?php
require_once("./config/DBConnection.php");
class Author
{
    private $ma_tgia, $ten_tgia, $hinh_tgia;
    public function __construct($ma_tgia, $ten_tgia, $hinh_tgia)
    {
        $this->ma_tgia = $ma_tgia;
        $this->ten_tgia = $ten_tgia;
        $this->hinh_tgia = $hinh_tgia;
    }
    public function getMa_tgia()
    {
        return $this->ma_tgia;
    }
    public function getTen_tgia()
    {
        return $this->ten_tgia;
    }
    public function getHinh_tgia()
    {
        return $this->hinh_tgia;
    }
    public function setMa_tgia($ma_tgia)
    {
        $this->ma_tgia = $ma_tgia;
    }
    public function setTen_tgia($ten_tgia)
    {
        $this->ten_tgia = $ten_tgia;
    }
    public function setHinh_tgia($hinh_tgia)
    {
        $this->hinh_tgia = $hinh_tgia;
    }
    public function add()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "INSERT INTO tacgia(ma_tgia,ten_tgia,hinh_tgia) VALUES(:ma_tgia,:ten_tgia,:hinh_tgia)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $this->ma_tgia);
        $stmt->bindParam(':ten_tgia', $this->ten_tgia);
        $stmt->bindParam(':hinh_tgia', $this->hinh_tgia);
        return $stmt->execute();
    }
    public function update()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "UPDATE tacgia SET ten_tgia = :ten_tgia, hinh_tgia = :hinh_tgia WHERE ma_tgia = :ma_tgia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ten_tgia', $this->ten_tgia);
        $stmt->bindParam(':hinh_tgia', $this->hinh_tgia);
        $stmt->bindParam(':ma_tgia', $this->ma_tgia);
        return $stmt->execute();
    }
    public function delete()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "DELETE FROM tacgia WHERE ma_tgia =?";
        $sql1 = "DELETE FROM baiviet WHERE ma_tgia =?";
        $stmt = $conn->prepare($sql);
        $stmt1 = $conn->prepare($sql1);
        return $stmt1->execute([$this->ma_tgia]) && $stmt->execute([$this->ma_tgia]);
    }
    public static function getById($ma_tgia)
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "SELECT * FROM tacgia WHERE ma_tgia =:ma_tgia";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_tgia', $ma_tgia);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getAll()
    {
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();
        $sql = "SELECT * FROM tacgia";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $author = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
            array_push(
                $result,
                [
                    'ma_tgia' => $author->getMa_tgia(),
                    'ten_tgia' => $author->getTen_tgia(),
                    'hinh_tgia' => $author->getHinh_tgia()
                ]
            );
        }
        return $result;
    }
}
?>
