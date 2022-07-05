<?php 


class FileLogic {

    public static function hapus($id, $filePath) {
        $dir = "./public_html/$filePath";
        if(file_exists($dir)) {
            $res = Database::destroy("image_file", $id);
            if( $res['status'] == "success" ) {
                unlink($dir);
            }
            $_SESSION['storage']['hapus_file'] = $res;
            return true;
        }else {
            $_SESSION['storage']['hapus_file'] = [
                "status" => "error",
                "message" => "OOPS ! ada yang error !"
            ];
            return false;
        }
    }

}