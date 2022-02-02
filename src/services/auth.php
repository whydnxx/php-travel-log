<?php
    include "constants/filename.php";
    require "services/file.php";

    Class Auth {
        function doRegister($nik, $name) {
            $fileSystem = new FileSystem();
            $data = $fileSystem->read_csv(USERS_FILE);
            $data[] = array($nik, $name);
            $fileSystem->write_csv(USERS_FILE, $data);
        }
    
        function doLogin($nik, $name) {
            $fileSystem = new FileSystem();
            $datas = $fileSystem->read_csv(USERS_FILE);
            foreach ($datas as $data) {
                $isExist = $data[0] == $nik && $data[1] == strtolower($name);
                if ($isExist) return true;
            }
            return false;
        }
    }
?>