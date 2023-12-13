<?php
// lấy dữ liệu từ file json
$truyen = file_get_contents("ds_truyen.json");
// chuyển dữ liệu từ json sang mảng
$truyen = json_decode($truyen, true);
?>
<!-- import Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<h3>Truyện tìm được</h3>
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
		foreach ($truyen as $key => $value) {
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
