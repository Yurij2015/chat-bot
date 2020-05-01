<?php
/**
 * Created by PhpStorm.
 * File: admin-a.php
 * Date: 30/04/2020
 * Time: 18:37
 */
require_once('includes/header.php');
?>
    <div class="container mt-5">

        <form method="post">
            <div class="form-group">
                <label for="name">Upload Question and Answer</label>
                <input type="text" class="form-control" id="name" placeholder="Название учебного материала"
                       name="name">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="" class="btn btn-primary">Отмена</a>
        </form>
    </div>
<?php
require_once('includes/footer.php');


