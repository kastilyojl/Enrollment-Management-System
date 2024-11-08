<?php

    require('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['files'])) {
    $files = $_FILES['files'];

    for ($i = 0; $i < count($files['name']); $i++) {
        $file = $files['tmp_name'][$i];

        // Open the file in read mode
        if (($handle = fopen($file, "r")) !== FALSE) {
            // Read the first four rows to get the labels and values
            $metadata = [];
            for ($j = 0; $j < 4; $j++) {
                $metadata[] = fgetcsv($handle, 1000, ",");
            }

            // Extract metadata from the corresponding columns
            $grade_lvl = $metadata[0][10]; // row 1 column k
            $section = $metadata[1][10];  // row 2 column k
            $teacher = $metadata[3][8];  // row 3 column i
            $semester = $metadata[0][21];  // row 1 column v
            $subject = $metadata[1][21];  // row 2 column v
            $track = $metadata[2][21];  // row 3 column k

            
            // if ($track == 'BSCS' || $track == 'Computer Science') {
            //     $track = 'BS Computer Science';
            // }


            // Skip the next row which is the header for students
            fgetcsv($handle, 1000, ",");

            // Iterate through each subsequent row of the CSV file
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) >= 20) {  // Ensure there are enough columns
                    // Extract relevant data
                    $name = $data[1];  // Column B
                    $firstQuarter = $data[5];  // Column F
                    $secondQuarter = $data[13];  // Column N
                    $finalGrade = $data[21];  // Column V
                    $remarks = $data[25];  // Column z

                    // Skip the row if the name is empty
                    if (empty($name)) {
                        continue;
                    }

                    $sql = "INSERT INTO d_grades (name, first_quarter, second_quarter, final_grade, remarks, grade_lvl ,section, teacher, semester, subject, track) 
                            VALUES ('$name', '$firstQuarter', '$secondQuarter', '$finalGrade', '$remarks', '$grade_lvl' ,'$section', '$teacher', '$semester', '$subject', '$track')";
                    $sqlInsert = mysqli_query($connection, $sql);

                   echo '<script>alert("Successfully Uploaded")</script>';
                   echo '<script>window.location.href = "../Professor/Upload_Grades.php";</script>';
                }
            }
            fclose($handle);
        } else {
            echo "Error opening the file.";
        }
    }

    // echo "Data successfully inserted into the database.";
} else {
    echo '<script>alert("Please upload valid CSV files.")</script>';
}
?>
