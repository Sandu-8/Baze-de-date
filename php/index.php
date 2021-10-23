<!DOCTYPE html>
<html>
    <head>
        <title>CRUD</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <?php 

        if (isset($_SESSION['message'])):?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
           <?php 
               echo $_SESSION['message'];
               unset($_SESSION['message']);
           ?>
        </div>
           <?php endif?>

        <div class="container">
        <?php 
            $mysqli = new mysqli('localhost', 'root', '', 'harry_potter_db') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM studenti") or die($mysqli->error);
            //pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Faclutate</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
        <?php 
            while($row = $result->fetch_assoc()):?>
                <tr>
                    <td><?php echo $row['nume']; ?></td>
                    <td><?php echo $row['prenume']; ?></td>
                    <td><?php echo $row['facultate']?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id_st']; ?>" 
                           class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id_st']; ?>" 
                           class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            </table>
        </div>

        <?php
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>

        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden"  name="id_st" value="<?php echo $id;?>">
            <div class="form-group">
            <label>Nume</label>
            <input type="text" name="nume" class="form-control"
                   value="<?php echo $nume; ?>" placeholder="Introduceti numele: ">
            </div>
            <div class="form-group">
            <label>Prenume</label>
            <input type="text" name="prenume" class="form-control"
                   value="<?php echo $prenume; ?>" placeholder="Introduceti prenumele: ">
            </div>
            <div class="form-group">
                <label>Facultate</label>
                <input type="text" name="facultate" class="form-control"
                       value="<?php echo $facultate; ?>" placeholder="Introduceti facultatea: ">
            </div>
            <div class="form-group" >
                <?php
                if ($update == true):
                ?>
            <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php else:?>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
            <?php endif;?>    
        </div>
        </form>
        </div>
        </div>
    </body>
</html>