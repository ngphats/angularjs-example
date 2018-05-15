<?php
//Các Mimes quản lý định dạng file
define('BASE_URL', __DIR__ . '/');
$mimes = array(
	'image/jpeg', 'image/png', 'image/gif', 'application/zip', 'application/octet-stream', 'video/mp4'
);
if (isset($_FILES)) {
	//die('<pre>' .print_r($_FILES, true). '</pre>');
	foreach ($_FILES as $key => $data) {
			$fileName = $data['name'];
			$fileType = $data['type'];
			$fileError = $data['error'];
			$prefix = $_POST['prefix'];
			$fileStatus = array(
				'status' => 0,
				'message' => ''	
			);
			if ($fileError== 1) { //Lỗi vượt dung lượng
				$fileStatus['message'] = 'Dung lượng quá giới hạn cho phép';
			} elseif (!in_array($fileType, $mimes)) { //Kiểm tra định dạng file
				$fileStatus['message'] = 'Không cho phép định dạng này';
			} else { //Không có lỗi nào
				move_uploaded_file($data['tmp_name'], "uploads/{$prefix}{$fileName}");
				$fileStatus['status'] = 1;
				$fileStatus['message'] = "Bạn đã upload $fileName thành công";
		        $fileStatus['uploaded'] = "uploads/{$prefix}{$fileName}";
			}
		}	
	echo json_encode($fileStatus);
	exit();
}