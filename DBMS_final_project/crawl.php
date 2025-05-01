<?php
    include('simple_html_dom.php');
    $base="http://localhost/DBMS_final_project/all_public.php?account=27";
    $curl=curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $base);
    curl_setopt($curl, CURLOPT_REFERER, $base);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str=curl_exec($curl);
    curl_close($curl);

    $html=new simple_html_dom();

    $html->load($str);

    foreach($html->find('img') as $e){
        echo $e->src.'<br>';
    }


?>