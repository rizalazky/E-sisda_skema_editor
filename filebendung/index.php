<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../header.css">
  <link rel="stylesheet" href="detail.css">
</head>

<body>
  <!-- <header style="height:300px;">
      Bendungan
  </header> -->


  <?php
  include 'conn.php';
  // include 'conn.php';
  include 'template/header.php';
  if (!empty($_GET['kode_bendung'])) { ?>

    
    <?php
    include './detail.php';
    ?>
    <?php
    include($_GET['kode_bendung'] . ".php");
  } else { ?>
      <div class='list-bendung-container'>
        <?php $query = mysql_query("SELECT kode,bendung FROM bendung");
        while ($r = mysql_fetch_array($query)) { 
          if(file_exists ($r['kode'].'.php')){
          ?>
          <div class="list-bendung-item">
            <a href="?kode_bendung=<?php echo $r['kode']; ?>" class='list-bendung-card'>
              <img src="../assets/images/mejagong1.jpg" alt="gambarbendung" class='list-bendung-image'>
              <div class='list-bendung-desc'>
                <?php echo $r['bendung']; ?>
              </div>
            </a>
        </div>
      <?php }} ?>
      </div>
<?php } ?>

      <script>
        let queryString = window.location.search;
        let UrlParams = new URLSearchParams(queryString)
        let KodeBendung = UrlParams.get('kode_bendung');
        const table = document.getElementsByClassName('table');
        const lokasi = document.getElementsByClassName('lokasi');

        // console.log(lokasi)
        let data = []

        function setValueTable() {
          // console.log(data)
          for (let i = 0; i < table.length; i++) {
            // console.log(table[i].children[1])
            // console.log(lokasi[i].value)
            let area, qAlir;
            for (let x = 0; x < data["query"].length; x++) {
              if (lokasi[i].value == data["query"][x].lokasi) {
                area = data["query"][x].a_tanam;
                qAlir = data["query"][x].q_diberikan
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

      
        fetchData()

        let qdiberi=[]
        let lok=[]
        function fetchData() {
          // console.log('test')
          fetch('http://localhost/E-sisda_skema_editor/filebendung/getBendung.php?kode_bendung=' + KodeBendung).
          then(res => {
            return res.json()
          }).then(result => {
            data = result
            // console.log(data["query"][0])

            for (let z = 0; z < data["query"].length; z++) {
              const dt = data["query"][z];
              qdiberi.push(dt.q_diberikan)
              lok.push(dt.lokasi)
              
            }
            
            setValueTable()
            setSum();
            setDetail();
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

        function setSum() {
          for (let index = 0; index < text.length; index++) {
            const element = text[index];
            let nilaiid=element.dataset.nilaiid
            let q_berikan=element.dataset.qberikan
            if( nilaiid!=null || q_berikan!=null ){
              sumDebit(text[index].id,nilaiid,q_berikan)
              // document.getElementById(nilaiid).innerHTML =setvalue
              // console.log('panggil func'+index)
            }
          }
        }
        
        function sumDebit(id,nl,qberi) {
          let docid=document.getElementById(id)
          let element='';
          let nilai=0;
          let totaldebit=0
          if (nl!=undefined && nl!="" && nl !=null && nl!='undefined' ) {
            let arrayNilai = nl.split(",")
            for (let index = 0; index < arrayNilai.length; index++) {
              element=document.getElementById(arrayNilai[index])
              nilai=Number(element.textContent)+nilai
              
            }
          }

          totaldebit=totaldebit+Number(nilai)

          let array=qberi.split(",")
          // console.log(array)
          // let lokasibaru=
          if(lok.length >0){
            array.map(l=>{

              for (let s = 0; s < lok.length; s++) {
                // console.log(lok[s])
                if(data["query"][s].lokasi==l){
                  totaldebit=totaldebit+ Number(qdiberi[s])
                  // console.log(qdiberi[s],'qdiberi')
                 
                  // return totaldebit
                }
                
              }
              // console.log(totaldebit, array)
              
            })        
          }
          // console.log(totaldebit, 'cek')
          docid.innerHTML=totaldebit.toFixed(2)
          // console.log(element)
        }

        
        function setDetail(){
          let debit = 0
          let diperlukan = Number(data["q_debit"][0].debit)
          for (let i = 0; i < qdiberi.length; i++) {
            debit = debit + Number(qdiberi[i]); 
          }
          console.log(data["q_debit"])
          let debitTersedia = document.getElementById('debittersedia')
          let debitDiperlukan = document.getElementById('debitdiperlukan')
          let faktorK = document.getElementById('faktorK')
          debitDiperlukan.innerHTML = diperlukan.toFixed(2)
          debitTersedia.innerHTML = debit.toFixed(2)
          faktorK.innerHTML = debit/diperlukan > 1 ? '1.00' : (debit/diperlukan).toFixed(2)

        }
      </script>

    <!-- <div class="footer">
      Copyright @2021 pemalicomal
    </div> -->
</body>
</html>