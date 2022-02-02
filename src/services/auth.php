<?php
    include "core/init.inc.php";
    include "constants/filename.php";
    require "services/file.php";

    Class Auth {
        function doLogin($nik, $name) {
            $fileSystem = new FileSystem();
            $datas = $fileSystem->read_csv(USERS_FILE);
            foreach ($datas as $data) {
                // Checkink NIK and Name
                $isExist = $data[0] == $nik && $data[1] == strtolower($name);
                if ($isExist) return true;
            }
            return false;
        }

        function doRegister($nik, $name) {
            $fileSystem = new FileSystem();
            $data = $fileSystem->read_csv(USERS_FILE);
            // Checking if user already exist or not, if exist user allow to login,
            //  that user create new data
            $isExist = $this->doLogin($nik, $name);
            if (!$isExist) {
                $data[] = array($nik, $name);
                $fileSystem->write_csv(USERS_FILE, $data);
            }
        }

        function doLogout() {
            session_start();
            // Clear session
            session_destroy();
            return redirect("/");
        }
    }
?>