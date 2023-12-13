<?php
// import connection
require_once("./connection.php");
// import model Tag
require_once("models/tag.php");
// import model Category
require_once("models/category.php");
?>

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
					<?php
					$allCategory = Category::getAll();
					foreach ($allCategory as $category) {
					?>
						<h6 class="mb-2 tag-group-title"><?php echo $category['name']; ?></h6>
						<div class="row">
							<?php
							$tags = Tag::getByCategory($category['id']);
							foreach ($tags as $tag) {
							?>
								<div class="form-check col-12 col-sm-6 col-md-4 col-lg-3 tag-group-name">
									<input type="checkbox" class="form-check-input form-check-input-primary" name="tags[]" value="<?php echo $tag['id']; ?>" id="<?php echo $tag['id']; ?>">
									<label class="form-check-label form-check-label-primary" for="<?php echo $tag['id']; ?>">
										<?php echo $tag['name']; ?>
									</label>
								</div>
							<?php
							}
							?>
						</div>
					<?php
					}
					?>

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