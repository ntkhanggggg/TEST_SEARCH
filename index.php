<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>

	<!-- import Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
	</script>

	<!-- import jquery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container-xxl">
		<?php
		// read json file
		$json = file_get_contents('ds_truyen.json');
		// decode json to array
		$data = json_decode($json, true);

		// lấy dữ liệu từ form
		if (isset($_POST) && !empty($_POST)) {
			echo '<h4>BẠN VỪA SUBMIT FORM VỚI DỮ LIỆU:</h4>';
			echo '<pre>';
			print(json_encode($_POST, JSON_PRETTY_PRINT));
			echo '</pre>';
		}

		// echo '<h4>DỮ LIỆU TRUYỆN:</h4>';
		// echo '<pre>';
		// print(json_encode($data, JSON_PRETTY_PRINT));
		// echo '</pre>';
		
		$truyen_tim_duoc = [];
		// lấy dữ liệu từ form
		$tinh_trang_form = $_POST['tinh_trang'] ?? [];
		$ending_form = $_POST['ending'] ?? [];
		$tags_form = $_POST['tags'] ?? [];
		$ten_truyen_form = $_POST['ten_truyen'] ?? '';

		if (isset($_POST) && !empty($_POST)) {
			// lặp qua tất cả các truyện
			foreach ($data as $truyen) {
				// lấy tình trạng của truyện
				$tinh_trang = $truyen['tinh_trang'];
				// lấy kết thúc của truyện
				$ending = $truyen['ending'];
				// lấy tag của truyện
				$tags = $truyen['tags'];
				// lấy tên truyện
				$ten_truyen = $truyen['ten_truyen'];


				// kiểm tra tình trạng
				$check_tinh_trang = false;
				// kiểm tra nếu tất cả các tình trạng của form có trong tình trạng của truyện thì đánh dấu là true
				

				// kiểm tra kết thúc
				$check_ending = false;
				// kiểm tra nếu tất cả các kết thúc của form có trong kết thúc của truyện thì đánh dấu là true
				

				// kiểm tra tag
				$check_tags = true;
				// kiểm tra nếu tất cả các tag của form có trong tag của truyện thì đánh dấu là true
				if (count($tags_form) > 0) {
					foreach ($tags_form as $item) {
						if (!in_array($item, $tags)) {
							$check_tags = false;
							break;
						}
					}
				}

				// kiểm tra tên truyện
				$check_ten_truyen = true;
				// kiểm tra nếu tên truyện chứa tên truyện form thì đánh dấu là true
				if (strlen($ten_truyen_form) > 0) {
					if (!strpos($ten_truyen, $ten_truyen_form)) {
						$check_ten_truyen = false;
					}
				}

				// nếu tất cả các điều kiện đều đúng thì push vào mảng truyện tìm được
				if ($check_tinh_trang && $check_ending && $check_tags && $check_ten_truyen) {
					$truyen_tim_duoc[] = $truyen;
				}
			}
			echo '<h4>DỮ LIỆU TRUYỆN TÌM ĐƯỢC (CÓ ' . count($truyen_tim_duoc) . ' TRUYỆN):</h4>';
			echo '<div class="row">';
			foreach ($truyen_tim_duoc as $truyen) {
				echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
				echo '<div class="card mb-3">';
				echo '<div class="card-body">';
				echo '<h5 class="card-title">' . $truyen['ten_truyen'] . '</h5>';
				echo '<p class="card-text">Tình trạng: ' . $truyen['tinh_trang'] . '</p>';
				echo '<p class="card-text">Kết thúc: ' . $truyen['ending'] . '</p>';
				echo '<p class="card-text">Tags: ' . implode(', ', $truyen['tags']) . '</p>';
				echo '<p class="card-text">Ngày tạo: ' . $truyen['ngay_tao'] . '</p>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
		?>

		<h1 class="mb-4">Example search</h1>

		<form method="post">
			<div class="row bg-light px-2">
				<div class="col-12">
					<h5 class="mb-2">Tình trạng:</h5>
					<div class="row">
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tinh_trang[]" value="completed">
							<label class="form-check-label form-check-label-primary" for="completed">Hoàn thành</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tinh_trang[]" value="ongoing">
							<label class="form-check-label form-check-label-primary" for="ongoing">Còn tiếp</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tinh_trang[]" value="suspended">
							<label class="form-check-label form-check-label-primary" for="suspended">Tạm ngưng</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tinh_trang[]" value="dropped">
							<label class="form-check-label form-check-label-primary" for="unverified">Chưa xác minh</label>
						</div>
					</div>
					<hr>
				</div>

				<div class="col-12">
					<h5 class="mb-2">Kết thúc:</h5>
					<div class="row">
						<!-- HE, SE, OE -->
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="ending[]" value="he">
							<label class="form-check-label form-check-label-primary" for="he">HE</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="ending[]" value="se">
							<label class="form-check-label form-check-label-primary" for="se">SE</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="ending[]" value="oe">
							<label class="form-check-label form-check-label-primary" for="oe">OE</label>
						</div>
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

					<!-- ĐIỀN CỨNG -->
					<!-- <h6 class="mb-2 tag-group-title">Đánh giá</h6>
					<div class="row">
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="1star">1 sao</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="2star">2 sao</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="3star">3 sao</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="4star">4 sao</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="5star">5 sao</label>
						</div>
					</div>

					<h6 class="my-2 tag-group-title">Thời không</h6>
					<div class="row">
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="xuyenviet">Xuyên Việt</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" id="xuyenvethegioicu">
							<label class="form-check-label form-check-label-primary" for="xuyenvethegioicu">Xuyên về thế giới
								cũ</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="xuyenthu">Xuyên thư</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="xuyenkhong">Xuyên không</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" id="codai_xuyentuonglai">
							<label class="form-check-label form-check-label-primary" for="codai_xuyentuonglai">Cổ đại xuyên tương
								lai</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="daiduong">Đại đường</label>
						</div>
						<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
							<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]">
							<label class="form-check-label form-check-label-primary" for="danquoc">Dân quốc</label>
						</div>
					</div> -->

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
							echo '<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">';
							echo '<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]" value="' . $item['value'] . '">';
							echo '<label class="form-check-label form-check-label-primary">' . $item['text'] . '</label>';
							echo '</div>';
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

	inpTag.on('input', function () {
		// lấy giá trị của input tag
		const val = $(this).val();
		if (val.length > 0) {
			// ẩn tất cả các tag
			hideAllTag();
			// lặp qua tất cả các tag là "tag-group-name"
			$('.tag-group-name').each(function () {
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

	btnShowAllTag.on('click', function () {
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
