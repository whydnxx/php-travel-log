<?php
    // include "services/file.php";
    class Log {
        function readAllByFilename($fileName) {
            $fileSystem = new FileSystem();
            $data = $fileSystem->csvToJson($fileName);
            return $data;
        }
    }
?>