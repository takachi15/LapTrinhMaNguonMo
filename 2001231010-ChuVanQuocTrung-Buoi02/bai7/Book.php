<?php
class Book
{
    public $tieuDe;
    public $tacGia;
    public $gia;

    public function __construct($tieuDe, $tacGia, $gia)
    {
        $this->tieuDe = $tieuDe;
        $this->tacGia = $tacGia;
        $this->gia = $gia;
    }
}

interface Downloadable
{
    public function download();
}

class Ebook extends Book implements Downloadable
{
    public $dungLuongFile;

    public function __construct($tieuDe, $tacGia, $gia, $dungLuongFile)
    {
        parent::__construct($tieuDe, $tacGia, $gia);
        $this->dungLuongFile = $dungLuongFile;
    }

    public function download()
    {
        echo "Đang tiến hành tải ebook: {$this->tieuDe} (Dung lượng: {$this->dungLuongFile}MB)..." . PHP_EOL;
    }
}
$ebookCuaToi = new Ebook("Lập trình PHP chuyên sâu", "Chu Văn Quốc Trung", 150000, 15);

// Hiển thị thông tin sách
echo "<h3>Thông tin sách:</h3>";
echo "Tiêu đề: " . $ebookCuaToi->tieuDe . "<br>";
echo "Tác giả: " . $ebookCuaToi->tacGia . "<br>";
echo "Giá: " . number_format($ebookCuaToi->gia) . " VNĐ<br>";

// Gọi phương thức download (Triển khai từ interface Downloadable)
echo "<br>";
$ebookCuaToi->download();
?>