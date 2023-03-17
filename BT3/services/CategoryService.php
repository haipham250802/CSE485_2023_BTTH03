<?php
    require_once("./models/Category.php");
    require_once("AllService.php");
    class CategoryServices{
       public static function Add($ma_tloai,$ten_tloai){
        $category = new Category($ma_tloai,$ten_tloai);
        AllService::delForeiginKey('baiviet','baiviet_ibfk_1');
        AllService::addAutoPrimaryKey('theloai','ma_tloai');
        if($category->Add()){
            echo "<script>alert('Thêm thành công');</script>";
        }else{
            echo "<script>alert('Thêm thành thất bại !!');</script>";
        }
        AllService::delAutoPrimaryKey('theloai','ma_tloai');
        AllService::addForeiginKey('baiviet','ma_tloai','theloai','ma_tloai','baiviet_ibfk_1');
        return $category;
       }
       public static function Update($ma_tloai,$ten_tloai){
        $category = new Category($ma_tloai,$ten_tloai);
        $category->setMa_tloai($ma_tloai);
        $category->setTen_tloai($ten_tloai);
        if($category->Update()){
            echo "<script>alert('Sửa thành công');</script>";
        }else{
            echo "<script>alert('Sửa thành thất bại !!');</script>";
        }
        return $category;
       }
       public static function Delete(Category $category){
        if($category->delete()){
            echo "<script>alert('Xóa thành công');</script>";
        }else{
            echo "<script>alert('Xóa thành thất bại !!');</script>";
        }
       }
       public static function getById($ma_tloai){
        return Category::getById($ma_tloai);
       }
       public static function getAll(){
        $categorys = [];
        foreach(Category::getAll() as $value){
            $category = [
                'ma_tloai' => $value->getMa_tloai(),
                'ten_tloai' => $value->getTen_tloai()
            ];
            array_push($categorys, $category);
        }
        return $categorys;
       }
    }
?>