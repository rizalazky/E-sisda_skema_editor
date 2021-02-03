<?php 
    require_once('conn.php');
    $query=mysqli_query($conn,"SELECT kode,bendung FROM bendung");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bendung</title>
</head>
<body>
    <form action="editor.php" method="get">
        <label for="kode_bendung">
            Pilih Kode Bendung
        </label>
        <select name="kode_bendung" id="">
            <?php
                while($row=mysqli_fetch_array($query)){
            ?>
                <option value="<?php echo $row['kode'];?>"><?php echo $row['bendung'];?></option>
            <?php
                }
            ?>
        </select>
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>