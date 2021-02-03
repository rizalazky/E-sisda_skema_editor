<?php
    // echo json_encode($_POST);
    if(!empty($_POST['create'])){
        $template=$_POST['template'];
        // echo json_encode($template);
        $newFile=fopen("filebendung/".$_POST['namafile'].".php",'w');
        fwrite($newFile,$_POST['template']);
        echo json_encode($_POST['template']);

    }else{
        echo 'halo';
    }
?>