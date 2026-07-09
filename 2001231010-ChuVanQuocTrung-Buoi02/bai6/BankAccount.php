<?php
class BankAccount
{
    public $soTaiKhoan;
    public $tenChuTaiKhoan;
    protected $soDu;

    public function __construct($soTaiKhoan, $tenChuTaiKhoan, $soDuBanDau)
    {
        $this->soTaiKhoan = $soTaiKhoan;
        $this->tenChuTaiKhoan = $tenChuTaiKhoan;
        $this->soDu = $soDuBanDau;
    }

    public function napTien($soTien)
    {
        if ($soTien > 0) {
            $this->soDu += $soTien;
            echo "Đã nạp thành công: $soTien VNĐ. ";
        }
    }

    public function rutTien($soTien)
    {
        if ($soTien > 0 && $soTien <= $this->soDu) {
            $this->soDu -= $soTien;
            echo "Đã rút thành công: $soTien VNĐ. ";
        } else {
            echo "Giao dịch rút tiền thất bại: Số dư không đủ hoặc số tiền không hợp lệ. ";
        }
    }

    public function hienThiSoDu()
    {
        echo "Số dư hiện tại của chủ tài khoản {$this->tenChuTaiKhoan} là: " . number_format($this->soDu) . " VNĐ." . PHP_EOL;
    }
}
$taiKhoan = new BankAccount("123456789", "Chu Văn Quốc Trung", 1000000);

$taiKhoan->napTien(500000);
$taiKhoan->rutTien(200000);


echo "<br>";
$taiKhoan->hienThiSoDu();
?>