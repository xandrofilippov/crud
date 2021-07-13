<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
  </head>
    <body>

        <?php require_once 'crud.php'; ?>

        <?php

        if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif; ?>

        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM books") or die($mysqli->error);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Автор</th>
                    <th colspan="2">Действия</th>
                </tr>
                </thead>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Редактировать</a>
                        <a href="crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>


        <div class="row justify-content-center">

            <form action="crud.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="form-group">
                    <input class="form-control" type="text" name="title"
                           value="<?php echo $title; ?>" placeholder="Название книги">
                </div>

                <div class="form-group">
                    <input class="form-control" type="text"
                           value="<?php echo $author; ?>" name="author" placeholder="Автор книги">
                </div>

                <div class="form-group">
                  <?php if ($update == true): ?>
                        <button type="submit" class="btn btn-info" name="update">Обновить</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary" name="save">Сохранить</button>
                    <?php endif; ?>
                </div>

            </form>

        </div>

        </div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>