<?php
    require_once('./models/Author.php');
    require_once('AllService.php');
    class AuthorService{
        public static function add($ma_tgia,$ten_tgia,$hinh_tgia){
            $author = new Author($ma_tgia,$ten_tgia,$hinh_tgia);
            AllService::delForeiginKey('baiviet','baiviet_ibfk_2');
            AllService::addAutoPrimaryKey('tacgia','ma_tgia');
            if($author->add()){
                echo "<script>alert('Thêm thành công');</script>";
            }else{
                echo "<script>alert('Thêm thất bại');</script>";
            }
            AllService::delAutoPrimaryKey('tacgia','ma_tgia');
            AllService::addForeiginKey('baiviet','ma_tgia','tacgia','ma_tgia','baiviet_ibfk_2');
            return $author;
        }
        public static function update($ma_tgia,$ten_tgia,$hinh_tgia){
            $author = new Author($ma_tgia,$ten_tgia,$hinh_tgia);

            $author->setMa_tgia($ma_tgia);
            $author->setTen_tgia($ten_tgia);
            $author->setHinh_tgia($hinh_tgia);
            if($author->update()){
                echo "<script>alert('Sửa thành công');</script>";
            }else{
                echo "<script>alert('Sửa thất bại');</script>";
            }
            return $author;
        }
        public static function delete(Author $author){
            if($author->delete()){
                echo "<script>alert('Xóa thành công');</script>";
            }else{
                echo "<script>alert('Xóa thất bại');</script>";
            }
        }   
        public static function getById($ma_tgia){
            $resultAuthor = Author::getById($ma_tgia);
            $author = new Author($resultAuthor['ma_tgia'],$resultAuthor['ten_tgia'],$resultAuthor['hinh_tgia']);
            $result = [
                'ma_tgia' => $author->getMa_tgia(),
                'ten_tgia' => $author->getTen_tgia(),
                'hinh_tgia' => $author->gethinh_tgia()
            ];
            return $result;
        }
        public static function getAll(){
            $resultAuthors = Author::getAll();
            $result = [];
            foreach($resultAuthors as $resultAuthor){
                $author = new Author($resultAuthor['ma_tgia'],$resultAuthor['ten_tgia'],$resultAuthor['hinh_tgia']);
                array_push($result,[  
                    'ma_tgia' => $author->getMa_tgia(),
                    'ten_tgia' => $author->getTen_tgia(),
                    'hinh_tgia' => $author->gethinh_tgia()
                ]);
            }
            return $result;
        }
    }
?>
