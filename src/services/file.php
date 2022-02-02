<?php
    class FileSystem {
        function read_csv($filename) {
            if (!is_file($filename)) {
                file_put_contents($filename, "Date,Hour,Location,Temperature");
            } 
            $rows = array();
            foreach (file($filename, FILE_IGNORE_NEW_LINES) as $line) {
                $rows[] = str_getcsv($line);
            }
            return $rows;
        }

        function write_csv($filename, $rows) {
            $file = fopen($filename, 'w') or die("Unable to open file!");
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }

        function csvToJson($fileName) {
            // open csv file
            if (!($fp = fopen($fileName, 'r'))) {
                die("Can't open file...");
            }
            
            //read csv headers
            $key = fgetcsv($fp,"1024",",");
            
            // parse csv rows into array
            $json = array();
                while ($row = fgetcsv($fp,"1024",",")) {
                $json[] = array_combine($key, $row);
            }
            
            // release file handle
            fclose($fp);
            
            // encode array to json
            return json_encode($json);
        }
    }
?>