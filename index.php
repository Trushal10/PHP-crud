<?php

    include 'update.php';
    include 'connection.php';
    include 'delete.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $director = $_POST['director'];
        $producer = $_POST['producer'];
        $releaseDate = $_POST['releaseDate'];
        $genre = !empty($_POST['genre'])?implode(",",$_POST['genre']):'';
        $verdict =$_POST['verdict'];
        if (!empty($_POST['updateid'])) {
            $id = $_POST['updateid'];
            $sql = "UPDATE `movies` SET `name`='$name',`director`='$director',`producer`='$producer',`releaseDate`='$releaseDate',`genre`='$genre',`verdict`='$verdict' WHERE id = '$id'";

            $result = mysqli_query($con, $sql);

        } else {

            $sql = "INSERT INTO `movies`(`name`, `director`, `producer`, `releaseDate`, `genre`, `verdict`) VALUES ('$name','$director','$producer','$releaseDate','$genre','$verdict')";

            $result = mysqli_query($con, $sql);
        }


    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details Form</title>
    <link rel="stylesheet" href="02.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
    <form id="movieFrom" action="index.php" method="post">
        <input type="hidden" name="updateid" value="<?php echo !empty($row) ? $row['id'] :''; ?>">
        <div class="container">
            <div class="row">
                <div class="col-25">
                    <label for="name"><b>Movie Name</b></label>
                </div>
                <div class="col-75">
                    <input type="text" class="name" id="name" value="<?php echo !empty($row) ? $row['name'] :''; ?>" name="name"  placeholder="Yodha" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="director"><b>Director</b></label>
                </div>
                <div class="col-75">
                    <select id="director" class="dir" name="director" required>
                        <option value="">Select Director</option>
                        <option value="Sagar Ambre" <?php echo !empty($row) &&  $row['director'] === 'Sagar Ambre' ? 'selected': '' ?>>Sagar Ambre</option>
                        <option value="Pushkar Ojha" <?php echo !empty($row) &&  $row['director'] === 'Pushkar Ojha' ? 'selected': '' ?>>Pushkar Ojha</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="producer"><b>Producer</b></label>
                </div>
                <div class="col-75">
                    <select id="producer" class="pro" name="producer" required>
                        <option value="">Select Producer</option>
                        <option value="Shashank Khaitan" <?php echo !empty($row) &&  $row['producer'] === 'Shashank Khaitan' ? 'selected': '' ?>>Shashank Khaitan</option>
                        <option value="Karan Johar" <?php echo !empty($row) &&  $row['producer'] === 'Karan Johar' ? 'selected': '' ?>>Karan Johar</option>
                        <option value="Apoorva Mehta" <?php echo !empty($row) &&  $row['producer'] === 'Apoorva Mehta' ? 'selected': '' ?>>Apoorva Mehta</option>
                        <option value="Hiroo Yash Johar" <?php echo !empty($row) &&  $row['producer'] === 'Hiroo Yash Johar' ? 'selected': '' ?>>Hiroo Yash Johar</option>
                        <option value="Somesh Shivraj" <?php echo !empty($row) &&  $row['producer'] === 'Somesh Shivraj' ? 'selected': '' ?>>Somesh Shivraj</option>
                        <option value="Hiroo Johar" <?php echo !empty($row) &&  $row['producer'] === 'Hiroo Johar' ? 'selected': '' ?>>Hiroo Johar</option>
                        <option value="Armando Gutierrez" <?php echo !empty($row) &&  $row['producer'] === 'Armando Gutierrez' ? 'selected': '' ?>>Armando Gutierrez</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="releasDate"><b>Release Date</b></label>
                </div>
                <div class="col-75">
                    <input type="date" class="rel" id="releaseDate" name="releaseDate" value="<?php echo !empty($row) ? $row['releaseDate']:'';?>" placeholder="YYYY-MM-DD" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label><b>Genre</b></label>
                </div>
                <div class="col-75">
                    <input type="checkbox" id="action" name="genre[]" value="action" <?php echo !empty($row['genre']) && in_array('action', $row['genre']) ? 'checked':'' ?>>
                    <label for="action">Action</label><br>
                    <input type="checkbox" id="drama" name="genre[]" value="drama" <?php echo !empty($row['genre']) && in_array('drama', $row['genre']) ? 'checked':'' ?>>
                    <label for="drama">Drama</label><br>
                    <input type="checkbox" id="thriller" name="genre[]" value="thriller"<?php echo !empty($row['genre']) && in_array('thriller', $row['genre']) ? 'checked':'' ?>>
                    <label for="thriller">Thriller</label><br>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label><b>Verdict</b></label>
                </div>
                <div class="col-75">
                    <input type="radio" id="Hit" name="verdict" value="Hit"<?php echo !empty($row) && ($row['verdict']=='Hit') ? 'checked':''?> required>
                    <label for="Hit">Hit</label>
                    <input type="radio" id="Flop" name="verdict" value="Flop"<?php echo !empty($row) && ($row['verdict']=='Flop') ? 'checked':''?> required>
                    <label for="Flop">Flop</label><br>
                </div>
            </div>
            <div class="row" style="text-align: center;">
                <button type="submit" class="button button1" >Submit</button>
                <button type="reset" class="button button1" id="clearBtn">Reset</button>
            </div>
        </div>
    </form>

    <div><h3>&nbsp;</h3></div>

    <div class="Movietable">
        <table id="moviename" class="Movietable" >
            <thead>
            <tr>
                <th>SR NO</th>
                <th>Movie Name</th>
                <th>Director</th>
                <th>Producer</th>
                <th>Release Date</th>
                <th>Genre</th>
                <th>Verdict</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $sql="SELECT * FROM `movies`";
                $result=mysqli_query($con,$sql);
                if($result) {
                    $i=1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                             <td>".$i."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['director']."</td>
                            <td>".$row['producer']."</td>
                            <td>".$row['releaseDate']."</td>
                            <td>".$row['genre']."</td>
                            <td>".$row['verdict']."</td>
                            <td>
                                 <a href='index.php?editid=$row[id]'><input type='submit' id='edit' name='edit' value='Edit'></a>
                             <a href='index.php?deleteid=$row[id]'><input type='submit' id='delete' name='delete' value='Delete' onclick='return chekeDelete()'></a>
                            </td>
                            </tr>";
                        $i++;
                    }
                }

            ?>
            </tbody>
        </table>
    </div>
<script>
    function chekeDelete() {
        return confirm('Are you sure you want to delete this row?');
    }
</script>
</body>
</html>
