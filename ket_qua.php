<?php
// nếu trang được mở bằng phương thức POST (từ form tìm kiếm)
if (isset($_POST)) {
	$truyen_tim_duoc = [];
	if (isset($_POST["tinh_trang"]))
		$tinh_trang = $_POST["tinh_trang"];
	else
		$tinh_trang = "";

	if (isset($_POST["ending"]))
		$ending = $_POST["ending"];
	else
		$ending = "";

	if (isset($_POST["tags"]))
		$tags = $_POST["tags"];
	else
		$tags = [];

	if (isset($_POST["ten_truyen"]))
		$ten_truyen = $_POST["ten_truyen"];
	else
		$ten_truyen = "";

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



	// lấy dữ liệu từ file json
	$ds_truyen = file_get_contents("ds_truyen.json");
	// chuyển dữ liệu từ json sang mảng
	$ds_truyen = json_decode($ds_truyen, true);

	$ketqua = [];

	// duyệt mảng truyện
	foreach ($ds_truyen as $key => $truyen) {
		$match_tentruyen = false;
		// nếu người dùng có nhập tên truyện thì mới kiểm tra
		if ($ten_truyen != "") {
			// strpos có chức năng tìm kiếm chuỗi con trong chuỗi mẹ
			$match_tentruyen = strpos($truyen["ten_truyen"], $ten_truyen);
		} else {
			$match_tentruyen = true;
		}

		$match_tinhtrang = false;
		// nếu người dùng có nhập tình trạng thì mới kiểm tra
		if ($tinh_trang != "") {
			// kiểm tra tình trạng trong form có match với tình trạng của truyện hay không
			$match_tinhtrang = ($truyen["tinh_trang"] == $tinh_trang);
		} else {
			$match_tinhtrang = true;
		}

		$match_ending = true;
		// nếu người dùng có nhập kết thúc thì mới kiểm tra
		if ($ending != "") {
			// kiểm tra kết thúc trong form có match với kết thúc của truyện hay không
			$match_ending = ($truyen["ending"] == $ending);
		} else {
			$match_ending = true;
		}

		$match_tag = true;
		// kiểm tra tất cả các tag trong form có trong mảng tag của truyện hay không
		$tag_truyen = $truyen["tags"];
		foreach ($tag_truyen as $key => $value) {
			// nếu tag trong form không có trong mảng tag của truyện
			if (!in_array($value, $tags)) {
				$match_tag = false;
				break;
			}
		}

		// nếu tất cả các điều kiện đều đúng thì thêm vào mảng kết quả
		if ($match_tentruyen && $match_tinhtrang && $match_ending && $match_tag) {
			$ketqua[] = $truyen;
		}
	}

	// in ra mảng kết quả
?>
	<h3>Truyện tìm được (<?php echo count($ketqua); ?>)</h3>
	<table border="1" cellspacing="0" cellpadding="10">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên truyện</th>
				<th>Tình trạng</th>
				<th>Kết thúc</th>
				<th>Tags</th>
				<th>Ngày tạo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// duyệt mảng truyện
			foreach ($ketqua as $key => $value) {
			?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo $value["ten_truyen"]; ?></td>
					<td><?php echo $value["tinh_trang"]; ?></td>
					<td><?php echo $value["ending"]; ?></td>
					<td>
						<?php
						// duyệt mảng tags
						echo implode(", ", $value["tags"]);
						?>
					</td>
					<td><?php echo $value["ngay_tao"]; ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
<?php
}

?>