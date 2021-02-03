<?php
  include('conn.php');
  if(!empty($_GET['submit'])){
    $file="filebendung/".$_GET['kode_bendung'].".php";
  
    if(!is_file($file)){
      file_put_contents($file,"<div class='context'></div>");
    }

    $query=mysqli_query($conn,"SELECT DISTINCT lokasi FROM alokasi WHERE di='$_GET[kode_bendung]'");
    // var_dump();
    // die;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'loading.html' ?>
<div class="wrapper">
  <div class='container'>
    <div class='tools'>
      <table border='1' class='bahan table'>
        <thead>
            <th colspan='2' >
              <select name="lokasi" class="lokasi" >
                  <?php while($r=mysqli_fetch_array($query)){ ?>
                    <option value='<?php echo $r['lokasi'] ?>' style='text-align:center;'><?php echo $r['lokasi'] ?></options>
                  <?php  } ?>
              </select>
            </th>
        </thead>
        <tbody>
          <tr>
            <td>Area</td>
            <td></td>
          </tr>
          <tr>
            <td>Q Alir</td>
            <td></td>
          </tr>
          
        </tbody>
      </table>
      <div class='bahan panah' data-rot='0'>
          <div class='popup'>
              <button class='resize'>Resize</button>
              <button class='rotate'>Rotate</button>
              <button class='remove'>Remove</button>
          </div>
      </div>
      <div class="bahan bulet">
          
      </div>
    </div>
    <?php
      include("filebendung/".$_GET['kode_bendung'].".php");
    ?>
  </div>
  <div class="action">
    <input type="hidden" name="namafile" id="namafile" value="<?php echo $_GET['kode_bendung'];?>">
    <button type="button" id="save">Save</button>
  </div>
</div>
  <script src="script.js"></script>
</body>
</html>