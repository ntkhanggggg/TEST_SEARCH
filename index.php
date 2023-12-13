<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>

	<!-- import Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
	</script>

	<!-- import jquery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container-xxl">

		<h1 class="mb-1">Example search</h1>

		<a type="button" class="btn btn-primary mb-4" href="ds_truyen.php">
			Show danh sách truyện
		</a>

		<?php
		$array_tinhtrang = [
			'completed' => 'Hoàn thành',
			'ongoing' => 'Còn tiếp',
			'suspended' => 'Tạm ngưng',
			'dropped' => 'Đã drop',
			'unverified' => 'Chưa xác minh'
		];
		?>

		<form action="ket_qua.php" method="POST">
			<div class="row bg-light px-2">
				<div class="col-12">
					<h5 class="mb-2">Tình trạng:</h5>
					<div class="row">
						<?php foreach ($array_tinhtrang as $tinhtrang => $text) { ?>
							<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
								<input type="radio" class="form-check-input form-check-input-primary" name="tinh_trang" value="<?php echo $tinhtrang; ?>" id="<?php echo $tinhtrang; ?>">
								<label class="form-check-label form-check-label-primary" for="<?php echo $tinhtrang; ?>">
									<?php echo $text; ?>
								</label>
							</div>
						<?php } ?>
					</div>
					<hr>
				</div>

				<?php
				$array_ending = [
					'he' => 'HE',
					'se' => 'SE',
					'oe' => 'OE',
				];
				?>
				<div class="col-12">
					<h5 class="mb-2">Kết thúc:</h5>
					<div class="row">
						<?php foreach ($array_ending as $ending => $text) { ?>
							<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
								<input type="radio" class="form-check-input form-check-input-primary" name="ending" value="<?php echo $ending; ?>" id="<?php echo $ending; ?>">
								<label class="form-check-label form-check-label-primary" for="<?php echo $ending; ?>">
									<?php echo $text; ?>
								</label>
							</div>
						<?php } ?>
					</div>
					<hr>
				</div>

				<div class="col-12">
					<h5 class="mb-2">Tag:</h5>
					<div class="row">
						<div class="col-auto">
							<div class="input-group mb-2">
								<input type="text" class="form-control" id="inp_tag" placeholder="Tag">
								<button type="button" class="btn btn-primary" id="btn_show_all">Show all</button>
							</div>
						</div>
					</div>

					<!-- FAKE VÀI CÁI TAG -->

					<!-- LẤY TỪ DB -->
					<!-- FAKE DATA -->
					<?php
					$tags = [
						[
							'title' => 'Đánh giá',
							'values' => [
								[
									'text' => '1 sao',
									'value' => '1star'
								],
								[
									'text' => '2 sao',
									'value' => '2star'
								],
								[
									'text' => '3 sao',
									'value' => '3star'
								],
								[
									'text' => '4 sao',
									'value' => '4star'
								],
								[
									'text' => '5 sao',
									'value' => '5star'
								],
							]
						],
						[
							'title' => 'Thời không',
							'values' => [
								[
									'text' => 'Xuyên Việt',
									'value' => 'xuyenviet'
								],
								[
									'text' => 'Xuyên về thế giới cũ',
									'value' => 'xuyenvethegioicu'
								],
								[
									'text' => 'Xuyên thư',
									'value' => 'xuyenthu'
								],
								[
									'text' => 'Xuyên không',
									'value' => 'xuyenkhong'
								],
								[
									'text' => 'Cổ đại xuyên tương lai',
									'value' => 'codai_xuyentuonglai'
								],
								[
									'text' => 'Đại đường',
									'value' => 'daiduong'
								],
								[
									'text' => 'Dân quốc',
									'value' => 'danquoc'
								],
							]
						],
						[
							'title' => 'Thể loại',
							'values' => [
								[
									'text' => 'Action',
									'value' => 'action'
								],
								[
									'text' => 'Adventure',
									'value' => 'adventure'
								],
								[
									'text' => 'Comedy',
									'value' => 'comedy'
								],
								[
									'text' => 'Drama',
									'value' => 'drama'
								],
								[
									'text' => 'Fantasy',
									'value' => 'fantasy'
								],
								[
									'text' => 'Historical',
									'value' => 'historical'
								],
								[
									'text' => 'Martial Arts',
									'value' => 'martial_arts'
								],
								[
									'text' => 'Mystery',
									'value' => 'mystery'
								],
								[
									'text' => 'Romance',
									'value' => 'romance'
								],
								[
									'text' => 'Sci-fi',
									'value' => 'sci_fi'
								],
								[
									'text' => 'Supernatural',
									'value' => 'supernatural'
								],
								[
									'text' => 'Tragedy',
									'value' => 'tragedy'
								],
							]
						],
						[
							'title' => 'Thời gian',
							'values' => [
								[
									'text' => '1 ngày',
									'value' => '1ngay'
								],
								[
									'text' => '1 tuần',
									'value' => '1tuan'
								],
								[
									'text' => '1 tháng',
									'value' => '1thang'
								],
								[
									'text' => '1 năm',
									'value' => '1nam'
								],
								[
									'text' => '1 thế kỷ',
									'value' => '1theky'
								],
							]
						],
						[
							'title' => 'Độ dài',
							'values' => [
								[
									'text' => '1 chương',
									'value' => '1chuong'
								],
								[
									'text' => '1 trang',
									'value' => '1trang'
								],
								[
									'text' => '1 đoạn',
									'value' => '1doan'
								],
								[
									'text' => '1 câu',
									'value' => '1cau'
								],
								[
									'text' => '1 từ',
									'value' => '1tu'
								],
							]
						],
						[
							'title' => 'Độ tuổi',
							'values' => [
								[
									'text' => '0+',
									'value' => '0+'
								],
								[
									'text' => '13+',
									'value' => '13+'
								],
								[
									'text' => '16+',
									'value' => '16+'
								],
								[
									'text' => '18+',
									'value' => '18+'
								],
								[
									'text' => '21+',
									'value' => '21+'
								],
							]
						],
						[
							'title' => 'Giới tính',
							'values' => [
								[
									'text' => 'Nam',
									'value' => 'nam'
								],
								[
									'text' => 'Nữ',
									'value' => 'nu'
								],
								[
									'text' => 'Khác',
									'value' => 'khac'
								],
							]
						]
					];

					foreach ($tags as $tag) {
						echo '<h6 class="mb-2 tag-group-title">' . $tag['title'] . '</h6>';
						echo '<div class="row">';
						foreach ($tag['values'] as $item) {
					?>
							<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
								<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]" value="<?php echo $item['value']; ?>" id="<?php echo $item['value']; ?>">
								<label class="form-check-label form-check-label-primary" for="<?php echo $item['value']; ?>">
									<?php echo $item['text']; ?>
								</label>
							</div>
					<?php
						}
						echo '</div>';
					}
					?>
				</div>

				<div class="col-12 mt-3">
					<!-- Nhập tên truyện -->
					<h5 class="mb-2">Tên truyện:</h5>
					<div class="row">
						<div class="col-12">
							<div class="input-group mb-2">
								<input type="text" class="form-control" id="inp_ten_truyen" placeholder="Tên truyện" name="ten_truyen">
							</div>
						</div>
					</div>
				</div>
			</div>


			<button type="submit" class="btn btn-primary mt-3">GÉT GÔ</button>
		</form>
	</div>

</body>

<script>
	const btnShowAllTag = $('#btn_show_all');
	const inpTag = $('#inp_tag');

	inpTag.on('input', function() {
		// lấy giá trị của input tag
		const val = $(this).val();
		if (val.length > 0) {
			// ẩn tất cả các tag
			hideAllTag();
			// lặp qua tất cả các tag là "tag-group-name"
			$('.tag-group-name').each(function() {
				const name = $(this).find('label').text();
				// nếu tên tag chứa giá trị của input tag hoặc đang được chọn thì hiển thị
				if (name.toLowerCase().includes(val.toLowerCase()) || $(this).find('input').is(':checked')) {
					$(this).show();
				}
			});
		} else {
			showAllTag();
		}
	});

	btnShowAllTag.on('click', function() {
		inpTag.val('');
		showAllTag();
	});

	function showAllTag() {
		$('.tag-group-name').show();
		$('.tag-group-title').show();
	}

	function hideAllTag() {
		$('.tag-group-name').hide();
		$('.tag-group-title').hide();
	}
</script>

</html>