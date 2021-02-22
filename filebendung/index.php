<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../header.css">
</head>

<body>
  <!-- <header style="height:300px;">
      Bendungan
  </header> -->


  <?php
  include '../conn.php';
  if (!empty($_GET['kode_bendung'])) { ?>
    <div class="headerCSS">
      <div class="header__logoJateng">
        <img class="animate__animated animate__swing animate__infinite infinite" src="../assets/header/logo_jateng.png" alt="Logo" />
        <div class="header__title">
          <h1>APEMASI</h1>
          <span> BPSDA BODRI KUTO</span>
        </div>
      </div>

      <div class="header__logoPublikasi">
        <img src="../assets/header/gunung.png" alt="" srcset="" />
        <div class="header__title">
          <span class="publikasi_distibusi">
            <marquee scrollamount="15">
              PUBLIKASI DISTRIBUSI AIR IRIGASI</marquee>
          </span>
        </div>
      </div>

      <div class="header__logoJatengGayeng">
        <img class="animate__animated animate__flipInY" src="../assets//header//logoJatengGayeng.png" alt="" srcset="" />
      </div>
    </div>
    <div class='container'>
    <?php
    include($_GET['kode_bendung'] . ".php");
  } else { ?>
      <ul style='display:flex;flex-direction:column;'>
        <?php $query = mysqli_query($conn, "SELECT kode,bendung FROM bendung");
        while ($r = mysqli_fetch_array($query)) { ?>
          <li>
            <a href="?kode_bendung=<?php echo $r['kode']; ?>"><?php echo $r['bendung']; ?></a>
          </li>
      <?php
        }
      }
      ?>
      </ul>
      <script>
        let queryString = window.location.search;
        let UrlParams = new URLSearchParams(queryString)
        let KodeBendung = UrlParams.get('kode_bendung');
        const table = document.getElementsByClassName('table');
        const lokasi = document.getElementsByClassName('lokasi');

        console.log(lokasi)
        let data = []

        function setValueTable() {
          console.log(data)
          for (let i = 0; i < table.length; i++) {
            // console.log(table[i].children[1])
            // console.log(lokasi[i].value)
            let area, qAlir;
            for (let x = 0; x < data.length; x++) {
              if (lokasi[i].value == data[x].lokasi) {
                area = data[x].a_tanam;
                qAlir = data[x].q_diberikan
              }
            }
            table[i].children[1].innerHTML = `
          <tr>
            <td>Areal</td>
            <td>${area}</td>
          </tr>
          <tr>
            <td>Q Alir</td>
            <td>${qAlir}</td>
          </tr>
        `
          }
        }

        setInterval(() => {
          fetchData()
        }, 1000)


        function fetchData() {
          console.log('test')
          fetch('http://localhost/E-sisda_skema_editor/filebendung/getBendung.php?kode_bendung=' + KodeBendung).
          then(res => {
            return res.json()
          }).then(result => {
            data = result
            console.log('h: ', result)
            setValueTable()
          }).catch(err => console.log(err))
        }
        const select = document.getElementsByTagName('select')

        for (let index = 0; index < select.length; index++) {
          select[index].setAttribute('disabled', true)
          select[index].style.textAlign = 'center'
        }
        const text = document.getElementsByClassName('text')

        for (let index = 0; index < text.length; index++) {
          text[index].setAttribute('contenteditable', false)
          text[index].style.textAlign = 'center'
        }
      </script>
    </div>
    <!-- <div class="footer">
      Copyright @2021 pemalicomal
    </div> -->
</body>

</html>