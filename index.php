<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Nd P.V</title>
</head>

<body>
    
    <?php require_once 'process.php' ; ?>

    <?php if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    
        <?php   
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>
    <div class="container"

    <?php
        $mysqli = new mysqli('localhost', 'root', 'mysql', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        //pre_r($result->fetch_assoc()); su fetch funkcija galime atvaizduoti DB irasa
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Project</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
            <?php
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['project']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Delete</a>                      
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        // funkcija atspausdinti, pasitikrinti ar pildosi DB
        function pre_r( $array ) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label>Project</label>
                <input type="text" name="project" class="form-control" value="<?php echo $project; ?>" placeholder="Enter project">
            </div>
            <div class="form-group">
            <button class="btn btn-primary" type="submit" name="save">Save</button>
            <?php
            if ($update == true):
            ?>
                <button class="btn btn-info" type="submit" name="update">Update</button>
            <php else: ?>
                
            <?php endif; ?>
            </div>
        </form>
    </div>
    </div>
</body>