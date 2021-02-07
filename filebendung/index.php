
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
    let queryString=window.location.search;
    let UrlParams=new URLSearchParams(queryString)
    let KodeBendung=UrlParams.get('kode_bendung');
    const table=document.getElementsByClassName('table');
    const lokasi=document.getElementsByClassName('lokasi');

    console.log(lokasi)
    let data=[]
    function setValueTable(){
      console.log(data)
      for(let i=0;i<table.length;i++){
        // console.log(table[i].children[1])
        // console.log(lokasi[i].value)
        let area,qAlir;
        for(let x=0;x<data.length;x++){
          if(lokasi[i].value==data[x].lokasi){
            area=data[x].a_tanam;
            qAlir=data[x].q_diberikan
          }
        }
        table[i].children[1].innerHTML=`
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
      function fetchData(){
        fetch('http://localhost/bendung-skema/filebendung/getBendung.php?kode_bendung='+KodeBendung).
          then(res=>{
            return res.json()
          }).then(result=>{
            data=result
            setValueTable()
          }).catch(err=>console.log(err))
      }
      const select=document.getElementsByTagName('select')
      
      for (let index = 0; index < select.length; index++) {
          select[index].setAttribute('disabled',true)
          select[index].style.textAlign='center'
      }
  </script>
</div>
</body>
</html>