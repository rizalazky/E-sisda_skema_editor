
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- <header style="height:300px;">
      Bendungan
  </header> -->
<div class='container'>

  <?php
    include($_GET['kode_bendung'].".php");
  ?>
  <script>
      const select=document.getElementsByTagName('select')
      console.log(select.length)
      for (let index = 0; index < select.length; index++) {
          select[index].setAttribute('disabled',true)
          select[index].style.textAlign='center'
      }
      
  </script>
</div>
</body>
</html>