<?php
require_once("includes/header.php");
?>
<?php

use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {

            $question = "";
            if (isset($column[0])) {
                $question = mysqli_real_escape_string($conn, $column[0]);
            }
            $answer = "";
            if (isset($column[1])) {
                $answer = mysqli_real_escape_string($conn, $column[1]);
            }

            $sqlInsert = "INSERT into questions_answers (question,answer)
                   values (?,?)";
            $paramType = "ss";
            $paramArray = array(
                $question,
                $answer
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if (!empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<div class="container mt-5">
    <h2>Import CSV file into Mysql using PHP</h2>
    <div id="response"
         class="<?php if (!empty($type)) {
             echo $type . " display-block";
         } ?>">
        <?php if (!empty($message)) {
            echo $message;
        } ?>
    </div>
    <div class="container">
        <div class="row">
            <form class="form form-horizontal" action="" method="post"
                  name="frmCSVImport" id="frmCSVImport"
                  enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                                            id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                            class="btn btn-primary">Import
                    </button>
                </div>
            </form>
        </div>
        <hr/>

        <?php
        $sqlSelect = "SELECT * FROM questions_answers";
        $result = $db->select($sqlSelect);
        if (!empty($result)) {
            ?>
            <table class="table table-bordered table-hover" id='userTable'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>

                </tr>
                </thead>
                <?php

                foreach ($result

                as $row) {
                ?>

                <tbody>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['question']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
<?php require_once("includes/footer.php"); ?>