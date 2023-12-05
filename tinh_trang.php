<?php
// nếu trang được mở bằng phương thức POST (từ form tìm kiếm)
if (isset($_POST)) {
	$truyen_tim_duoc = [];
	if (isset($_POST["tinh_trang"]))
		$tinh_trang = $_POST["tinh_trang"];
	if (isset($_POST["ending"]))
		$ending = $_POST["ending"];
	if (isset($_POST["tags"]))
		$tags = $_POST["tags"];
	if (isset($_POST["ten_truyen"]))
		$ten_truyen = $_POST["ten_truyen"];

	// echo "<h1>Truyện tìm được</h1>";
	// echo "<pre>";
	// print_r($truyen_tim_duoc);
	// echo "</pre>";

	echo "<h1>Dữ liệu của người dùng nhập vào form</h1>";
	echo "<h5>Tình trạng</h5>";
	echo "<pre>";
	print_r($tinh_trang);
	echo "</pre>";
	echo "<hr>";

	echo "<h5>Kết thúc</h5>";
	echo "<pre>";
	print_r($ending);
	echo "</pre>";
	echo "<hr>";

	echo "<h5>Tag</h5>";
	echo "<pre>";
	print_r($tags);
	echo "</pre>";
	echo "<hr>";

	echo "<h5>Tên truyện</h5>";
	echo "<pre>";
	print_r($ten_truyen);
	echo "</pre>";
	echo "<hr>";

}

?>