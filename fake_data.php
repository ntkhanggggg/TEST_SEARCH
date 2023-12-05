<?php
$fakeData = [];
$allTag = [
	"1star",
	"2star",
	"3star",
	"4star",
	"5star",
	"xuyenviet",
	"xuyenvethegioicu",
	"xuyenthu",
	"xuyenkhong",
	"codai_xuyentuonglai",
	"daiduong",
	"danquoc",
	"action",
	"adventure",
	"comedy",
	"drama",
	"fantasy",
	"historical",
	"martial_arts",
	"mystery",
	"romance",
	"sci_fi",
	"supernatural",
	"tragedy",
	"1ngay",
	"1tuan",
	"1thang",
	"1nam",
	"1theky",
	"1chuong",
	"1trang",
	"1doan",
	"1cau",
	"1tu",
	"0+",
	"13+",
	"16+",
	"18+",
	"21+",
	"nam",
	"nu",
	"khac"
];

for ($i = 1; $i <= 20; $i++) {
	$tag_number = rand(1, 5);
	$tags = [];
	for ($j = 0; $j < $tag_number; $j++) {
		$tags[] = $allTag[rand(0, count($allTag) - 1)];
	}
	$book = [
		'ten_truyen' => 'Truyện số ' . $i,
		'tinh_trang' => ['completed', 'ongoing', 'suspended', 'dropped'][rand(0, 3)],
		'ending' => ['he', 'se', 'oe'][rand(0, 2)],
		'tags' => $tags,
		'ngay_tao' => date('Y-m-d H:i:s', rand(0, time())),
	];

	$fakeData[] = $book;
}

echo '<pre>';
print(json_encode($fakeData, JSON_PRETTY_PRINT));
echo '</pre>';

// Path: index.php