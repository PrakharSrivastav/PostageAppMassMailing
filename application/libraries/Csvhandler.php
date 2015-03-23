<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is a custom class for reading the csv files.
 * init_method:: needs 2 inputs file_name and number_of_fields in the file
 */
class Csvhandler {

    private $file_name = "";
    //private $col_count = "";

    function __construct($argument) {
        $this->file_name = $argument["file_name"];
        //$this->col_count = $argument["count"];
    }

    public function read_csv_data() {
        try {
            if (trim($this->file_name) === "") {
                throw new Exception("Provide a valid file path to parse the csv file");
            } else {
                $handle = fopen($this->file_name, "r");
                if ($handle === false)
                    throw new Exception("Invalid file path: " . $this->file_name);
                $return_data = array();
                $subscriber_header = array("FNAME", "LNAME", "EMAIL");
                $FNAME = -1;
                $LNAME = -1;
                $EMAIL = -1;
                $count = 0;
                while (!feof($handle)) {
                    $data = fgetcsv($handle, 0, ",");
                    if ($count === 0) {
                        foreach ($subscriber_header as $element) {
                            $index = (int) array_search($element, $data);
                            //var_dump($index);
                            if (array_search($element, $data) !== false) {
                                //var_dump($element);
                                if ($element === "FNAME")
                                    $FNAME = $index;
                                else if ($element === "LNAME")
                                    $LNAME = $index;
                                else if ($element === "EMAIL")
                                    $EMAIL = $index;
                            }
                            else {
                                throw new Exception("Improper csv files header, Please make sure that the header matches the provided format");
                            }
                        }
                        $count++;
                        continue;
                    }

                    // if (!PHP_EOL && count($data) !== $this->col_count) {
                        // throw new Exception("The number of the fields in the csv file does not match the configuration", 1);
                    // } else 
                    if (feof($handle)) {
                        break;
                    } else {
                        $temp_array = array();
                        $temp_array["fname"] = $data[$FNAME];
                        $temp_array["lname"] = $data[$LNAME];
                        $temp_array["email"] = $data[$EMAIL];
                        $return_data[] = $temp_array;
                    }
                }
                return $return_data;
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}
