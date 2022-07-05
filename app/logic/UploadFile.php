<?php 


class UploadFile {

    private static $targetDir = "public_html/storage/uploads/";

    public static function upload($file = [], int $groupid = 0){
        $baseName = basename( time() . "_" . $file['file_data']['name']);
        $targetFile = UploadFile::$targetDir . $baseName;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        // jika bukan png/jpg
        if ( $imageFileType == "png" OR $imageFileType == "jpg" ) {

            // jika size lebih dari 5MB
            $size = $file["file_data"]["size"];
            if( $size > 5000000 ) {
                $msg = [
                    "status" => "error",
                    "message" => "Ukuran file terlalu besar !"
                ];
                $_SESSION['storage']['upload'] = $msg;
                return $msg;
            }

            $width = getimagesize($file['file_data']['tmp_name'])[0];
            $height = getimagesize($file['file_data']['tmp_name'])[1];

            // upload file
            if ( move_uploaded_file($file['file_data']['tmp_name'],  $targetFile) ) {
                $add = Database::add("image_file",[
                    "name" => $file['file_data']['name'],
                    "user_id" => Middleware::$user['id'],
                    "group_id" => $groupid,
                    "filePath" => "storage/uploads/" . $baseName,
                    "file_outside" => "",
                    "size" => $size,
                    "width" => $width,
                    "height" => $height,
                    "extension" => $imageFileType,
                    "created_at" => App::date()
                ]);
                // var_dump($add);die;
                if ( $add == false ) {
                    $_SESSION['storage']['upload'] = [
                        "status" => "error",
                        "message" => "File gagal diupload ! : nama file ngaco bang !!!! harap ganti nama file !"
                    ];
                    return false;
                }
                $_SESSION['storage']['upload'] = [
                    "status" => "success",
                    "message" => "File berhasil diupload !"
                ];

                // update user session data
                $_SESSION['user']['file_count'] += 1;
                return true;
            }
        }

        $msg = [
            "status" => "error",
            "message" => "Type file tidak diijinkan !"
        ];
        $_SESSION['storage']['upload'] = $msg;
        return false;

        
    }

}