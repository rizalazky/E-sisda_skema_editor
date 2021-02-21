<?php
include('conn.php');
if (!empty($_GET['submit'])) {
  $file = "filebendung/" . $_GET['kode_bendung'] . ".php";

  if (!is_file($file)) {
    file_put_contents($file, "<div class='context'></div>");
  }

  $query = mysqli_query($conn, "SELECT DISTINCT lokasi FROM alokasi WHERE di='$_GET[kode_bendung]'");
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
  <link href="assets/fontawesome/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="header.css">
</head>

<body>
  <?php include 'loading.html' ?>
  <div id="modal-resize">
    <label for="heigth">Height</label>
    <input type="text" name="height" id="inp-height" class='inpResize'>
    <label for="width">Width</label>
    <input type="text" name="width" id="inp-width" class='inpResize'>
  </div>

  <ul class='popup'>
    <li class='bg popup-item'>
      <div>
        <label for='bg'>Bg Color</label>
        <input type="color" name="bg" class='bg color-picker' id="bg" style='display:absolute;z-index:9;' placeholder='background Color'>
      </div>
    </li>
    <li class='color popup-item'>
      <label for='color'>Font Color</label>
      <input type="color" name="color" class='color color-picker' id="color">
    </li>
    <li class='animated popup-item'>Animated</li>
    <li class='resize popup-item'>Resize</li>
    <li class='rotate popup-item'>Rotate</li>
    <li class='remove popup-item'>Remove</li>
    <li class='close popup-item'>Close</li>
  </ul>
  <div class="wrapper">
    <div class='container'>
      <div class='tools'>
        <div class="pane">
          <ul>
            <li class='fas fa-table tools-item' data-target='table'></li>
            <li class='fas fa-circle tools-item' data-target='bulet'></li>
            <li class='fas fa-pen tools-item' data-target='panah'></li>
            <li class='fas fa-font tools-item' data-target='text'></li>
          </ul>
        </div>
        <!-- end pane -->
        <table class='bahan table' data-rot='0'>
          <thead>
            <th colspan='2'>
              <select name="lokasi" class="lokasi">
                <?php while ($r = mysqli_fetch_array($query)) { ?>
                  <option value='<?php echo $r['lokasi'] ?>' style='text-align:center;'><?php echo $r['lokasi'] ?></options>
                  <?php  } ?>
                  <!-- <option value="satu">Satu</option>
                  <option value="Dua" selected>Dua</option>
                  <option value="Tiga">Tiga</option> -->
              </select>
            </th>
          </thead>
          <tbody class='tbody'>
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

        </div>
        <div class="bahan bulet" data-rot='0'>

        </div>
        <div class='bahan text' contenteditable="true" data-rot='0'>
          Text
        </div>
      </div>
      <!-- end tools -->
      <!-- header -->
   


      <!-- endheader -->
      <?php
      include("filebendung/" . $_GET['kode_bendung'] . ".php");
      ?>
    </div>
    <!-- end container -->
    <div class="action">
      <input type="hidden" name="namafile" id="namafile" value="<?php echo $_GET['kode_bendung']; ?>">
      <button type="button" id="save">Save</button>
    </div>
    <!-- end action -->
  </div>
  <!-- end wrapper -->
  <script src="script.js"></script>
</body>

</html>