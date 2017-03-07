<?php
// --- Simple LexCode
//function encrypt($sData, $sKey = '4819a4315d3d567c625e21125fbcda24')
function encrypt($sData, $sKey = '4819a4315d3d5df3025e21125fbcda24')
{
    if (strlen($sData) % 2 == 0) {
        $sData .= "_";
    }

    $sResult = '';
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return encode_base64($sResult);
}

//function decrypt($sData, $sKey = '4819a4315d3d567c625e21125fbcda24')
function decrypt($sData, $sKey = '4819a4315d3dla5m625e21125fbcda24')
{
    $sResult = '';
    $sData = decode_base64($sData);
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    if (strlen($sData) % 2 == 1) {
        $sResult = substr($sResult, 0, (strlen($sResult) - 1));
    }

    return $sResult;
}

function encode_base64($sData)
{
    $sBase64 = base64_encode($sData);
    //return substr(strtr($sBase64, '+/', '-_'), 0, -2); <- koding asli !!
    return substr(strtr($sBase64, '+/', '-_'), 0, -1);
}

function decode_base64($sData)
{
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64 . '==');
}

function generatePDFicon($path, $target)
{
    $result = "";
    if($path == ""){
        $result = "Dokumen tdk ditemukan";
    }else{
        $result = "<a target=\"".$target."\" href=\"".$path."\"> <img src=\"images/pdf.png\" width=\"25px\" height=\"25px\"> </a>";
    }

    return $result;
}

function dbdate2caldate($dbdate)
{
    $caldate = "";
    if($dbdate == "-" || $dbdate == ""){
        $caldate = $dbdate;
    }else{
        $dbdate_array = explode("-",$dbdate); // Y-m-d

        $y = $dbdate_array[0];
        $m = m2namedate( d2tglduadigit( strval($dbdate_array[1]) ) );
        $d = $dbdate_array[2];
        $caldate = strval($d)." ".strval($m).", ".strval($y);
        //$caldate = $dbdate;
    }

    return $caldate;
}

function caldate2dbdate($caldate)
{
    $caldate = str_replace(",","",$caldate);
    $caldate_array = explode(" ",$caldate);

    $y = trim($caldate_array[2]);
    $m = namedate2m( ($caldate_array[1]) );
    $d = d2tglduadigit( trim($caldate_array[0]) );
    $dbdate = strval($y)."-".$m."-".strval($d);

    return $dbdate;
}

function d2tglduadigit($d)
{
    $result = "";

    if($d < 10){
        $result = "0".strval($d);
    }else{
        $result = $d;
    }

    return $result;
}

function namedate2m($namedate)
{
    $result = "";

    if($namedate == "January"){
        $result = "01";
    }else if($namedate == "February"){
        $result = "02";
    }else if($namedate == "March"){
        $result = "03";
    }else if($namedate == "April"){
        $result = "04";
    }else if($namedate == "May"){
        $result = "05";
    }else if($namedate == "June"){
        $result = "06";
    }else if($namedate == "July"){
        $result = "07";
    }else if($namedate == "August"){
        $result = "08";
    }else if($namedate == "September"){
        $result = "09";
    }else if($namedate == "October"){
        $result = "10";
    }else if($namedate == "November"){
        $result = "11";
    }else if($namedate == "December"){
        $result = "12";
    }else{
        $result = "0";
    }

    return $result;
}


function m2namedate($namedate)
{
    $result = "";

    if($namedate == "01"){
        $result = "January";
    }else if($namedate == "02"){
        $result = "February";
    }else if($namedate == "03"){
        $result = "March";
    }else if($namedate == "04"){
        $result = "April";
    }else if($namedate == "05"){
        $result = "May";
    }else if($namedate == "06"){
        $result = "June";
    }else if($namedate == "07"){
        $result = "July";
    }else if($namedate == "08"){
        $result = "August";
    }else if($namedate == "09"){
        $result = "September";
    }else if($namedate == "10"){
        $result = "October";
    }else if($namedate == "11"){
        $result = "November";
    }else if($namedate == "12"){
        $result = "December";
    }else{
        $result = "0";
    }

    return $result;
}

function generateID($sumberdata, $id_old)
{
    $awalan = "";
    $result = array("is_done"=>false, "data"=>"");

    if($sumberdata == "RESKRIM"){
        $awalan = "RK";
        $result['is_done'] = true;
    }else if($sumberdata == "LAKA"){
        $awalan = "LK";
        $result['is_done'] = true;
    }else if($sumberdata == "TIPIRING"){
        $awalan = "TP";
        $result['is_done'] = true;
    }else if($sumberdata == "NARKOBA"){
        $awalan = "NK";
        $result['is_done'] = true;
    }else{
        $awalan = "-";
    }

    $result['data'] = $awalan.$id_old;

    return $result;
}

function getPage($path_dir, $tpage){
    //$idpage = decrypt($pg);
    //$idpage = $pg;

    // inits
    $jp     = "common";
    $p      = "blank";
    $result = "";

    $data   = explode(":",$tpage);
    if(count($data) == 2){
        $jp     = strtolower($data[0]);
        $p      = strtolower($data[1]);
    }else if(count($data) == 3){ // yg ketiga itu jamaah_id
        $jp     = strtolower($data[0]);
        $p      = strtolower($data[1]);
    }else if(count($data) == 4) { // yg ketiga itu type action (e.g. f untuk filter), yg ke empat itu value (e.g. 1)
        $jp     = strtolower($data[0]);
        $p      = strtolower($data[1]);
    }

    $pages = array(
        "common"=>array(
            "blank"=>"blank",
            "homepage"=>"homepage",
        ),
        "profile"=>array(
            "about"=>"aboutMe",
            "research"=>"research",
            "publications"=>"publications",
            "achievements"=>"achievements",
        ),
        "teaching"=>array(
            "schedules"=>"schedules",
            "courses"=>"courses",
            "students"=>"students",
        ),
    );

    $blankPage = $pages['common']['blank'];
    //echo "pagenya: ".$pages[$jp][$p]."<br/>";

    if( empty($pages[$jp][$p]) )
        $result = $blankPage.".php";
    else{
        $result = $pages[$jp][$p].".php";
    }

    if(!isset($jp)) $jp = 'common';

    // setup located dir;
    $result = $jp . '/' . $result; // e.g. management/namaFile.php

    if( file_exists($path_dir.$result) )
        //$result = "loli";
        $result = $path_dir.$result;
    else
        //   $result = "pop";
        $result = $path_dir. 'common' . '/' . $blankPage .".php";
        //   $result = $path_dir.$pages[$jp][$p].".php";

    //return $path_dir.$result;
    return $result;
}

function address2longlat($input)
{
    // inits
    $lat = '';
    $long = '';

    $address = str_replace(" ", "+", $input);

    //$address = "TAMAN+PANCIRO+INDAH+BLOK+TP.+4/21+DESA+PANCIRO+KEC.+BAJENG+KAB.+GOWA";
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Indonesia";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    if(!empty($response_a->results[0]->geometry->location->lat))
        $lat 	= $response_a->results[0]->geometry->location->lat;
    if(!empty($response_a->results[0]->geometry->location->lng))
        $long 	= $response_a->results[0]->geometry->location->lng;

    // assign
    $coor["lat"] = $lat;
    $coor["long"] = $long;


    return $coor;

    //echo $lat = $response_a->results[0]->geometry->location->lat;
    //echo "<br />";
    //echo $long = $response_a->results[0]->geometry->location->lng;

}

function jsonDate_to_mysqlDate($p_jsonDate)
{

    $arr_date = explode(" ", $p_jsonDate); // tgl - bln - thn
    return $arr_date[2] . "-" . $arr_date[1] . "-" . $arr_date[0];

}

function jsonDate_to_mysqlDate_format_kamel($p_jsonDate)
{

    $arr_date = explode("/", $p_jsonDate); // bln / tgl / thn
    return $arr_date[2] . "-" . $arr_date[0] . "-" . $arr_date[1]; // thn - bln - tgl

}

function jsonDate_to_mysqlDate_format_kamel_oriDate($p_jsonDate)
{

    $arr_date = explode("-", $p_jsonDate); // tgl - bln - thn
    return $arr_date[1] . "/" . $arr_date[2] . "/" . $arr_date[0];
    // Y - m - d -->> d/m/Y
}

function reformat_to_field_datimepicker($dateTime)
{

    $arr_date = explode(" ", $p_jsonDate); // tgl - bln - thn
    return $arr_date[1] . "/" . $arr_date[2] . "/" . $arr_date[0];
    // Y - m - d -->> d/m/Y
}


/////////////////////////////////////////////////
/* BEGIN KUCING */

function change_format_ymd_jam($p_date)
{

    $new_date = "";

    //CEK DLU, BENTUK TANGGALNYA
    $filestring = $p_date;
    $findme = '-';

    $pos = strpos($filestring, $findme);

    // Note the use of ===.  Simply == would not work as expected
    // because the position of 'a' was the 0th (first) character.
    if ($pos === false) { // WORD NOT FOUND
        //ubah tanggal
        $ar_tgl = explode(" ", $p_date);
        $new_tgl = jsonDate_to_mysqlDate_format_kamel($ar_tgl[0]);

        // contoh data : 12:12:12
        $new_time = substr($ar_tgl[1], 0, 2) . ":" . substr($ar_tgl[1], 2, 2) . ":" . substr($ar_tgl[1], 4, 2);

        $new_date = $new_tgl . " " . $new_time;

    } else {
        //ubah tanggal
        $ar_tgl = explode(" ", $p_date);

        // contoh data : 12:12:12
        $new_time = substr($ar_tgl[1], 0, 2) . ":" . substr($ar_tgl[1], 2, 2) . ":" . substr($ar_tgl[1], 4, 2);

        $new_date = $ar_tgl[0] . " " . $new_time;
    }
    //echo "new_date : $new_date";

    return $new_date;

}

function change_format_ymd_jam_toField($p_date)
{

    $new_date = "";

    //ubah tanggal
    $ar_tgl = explode(" ", $p_date);
    //$new_tgl = jsonDate_to_mysqlDate_format_kamel_oriDate($ar_tgl[0]);

    $arr_date = explode("-", $ar_tgl[0]); // tgl - bln - thn
    //$new_tgl = $arr_date[1]."/".$arr_date[0]."/".$arr_date[2];

    // contoh data : 12:12:12
    //$new_time = substr($ar_tgl[1], 0, 2).":".substr($ar_tgl[1], 2, 2).":".substr($ar_tgl[1], 4, 2);

    //$new_date = $new_tgl." ".$new_time;
    $new_date = $ar_tgl[0] . " " . $ar_tgl[1];

    return $new_date;

}

/* END KUCING */
/////////////////////////////////////////////////

function bersihkan_kata($sInput)
{

    $new_input = "";
    $new_input = $sInput;

    $new_input = str_replace(".", "", $new_input);
    $new_input = str_replace(",", "", $new_input);
}


//reformat input !!
function reformat_input($sInput)
{

    $new_input = "";
    /*
    $target = array("</javascript>", "<javascript>", "</vbscript>", "<vbscript>", "</script>", "<script>", "'", "/", "\\", "!", "\r\n", "\n", "\r");
    */

    $new_input = $sInput;

    $new_input = str_replace("'", "\"", $new_input); //jadikan petik 2 ( " )
    $new_input = str_replace("defer=\"defer\"", "", $new_input);
    $new_input = str_replace("language=\"c#\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.1\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.2\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.3\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.4\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.5\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.6\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.7\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.8\"", "", $new_input);
    $new_input = str_replace("language=\"javascript1.9\"", "", $new_input);
    $new_input = str_replace("language=\"javascript2.0\"", "", $new_input);
    $new_input = str_replace("language=\"javascript\"", "", $new_input);
    $new_input = str_replace("language=\"jscript\"", "", $new_input);
    $new_input = str_replace("language=\"php\"", "", $new_input);
    $new_input = str_replace("language=\"vb\"", "", $new_input);
    $new_input = str_replace("language=\"vbscript\"", "", $new_input);

    $new_input = str_replace("alerts", "", $new_input);
    $new_input = str_replace("alert", "", $new_input);

    $new_input = str_replace("runat=\"server\"", "", $new_input);

    $new_input = str_replace("type=\"application/ecmascript\"", "", $new_input);
    $new_input = str_replace("type=\"application/javascript\"", "", $new_input);
    $new_input = str_replace("type=\"application/x-ecmascript\"", "", $new_input);
    $new_input = str_replace("type=\"text/ecmascript\"", "", $new_input);
    $new_input = str_replace("type=\"text/javascript\"", "", $new_input);
    $new_input = str_replace("type=\"text/jscript\"", "", $new_input);
    $new_input = str_replace("type=\"text/livescript\"", "", $new_input);
    $new_input = str_replace("type=\"text/tcl\"", "", $new_input);
    $new_input = str_replace("type=\"text/x-ecmascript\"", "", $new_input);
    $new_input = str_replace("type=\"text/x-javascript\"", "", $new_input);

    $new_input = str_replace("http", "", $new_input);

    $new_input = str_replace("</javascript>", "", $new_input);
    $new_input = str_replace("<javascript>", "", $new_input);
    $new_input = str_replace("</vbscript>", "", $new_input);
    $new_input = str_replace("<vbscript>", "", $new_input);
    $new_input = str_replace("</script>", "", $new_input);
    $new_input = str_replace("<script>", "", $new_input);
    $new_input = str_replace("<script", "", $new_input);

    $new_input = str_replace("&", "&amp;", $new_input);
    $new_input = str_replace('"', "&quot;", $new_input);
    $new_input = str_replace("<", "&lt;", $new_input);
    $new_input = str_replace(">", "&gt;", $new_input);

    $new_input = str_replace("&amp;", "", $new_input);
    $new_input = str_replace("&quot;", "", $new_input);
    $new_input = str_replace("&lt;", "", $new_input);
    $new_input = str_replace("&gt;", "", $new_input);

    $new_input = str_replace("'", "", $new_input);
    //$new_input = str_replace("/", "", $new_input);
    $new_input = str_replace("\\", "", $new_input);
    $new_input = str_replace(";", "", $new_input);
    $new_input = str_replace(":", "", $new_input);
    $new_input = str_replace("\"", "", $new_input);

    //$new_input = str_replace($target, "", $new_input);
    //str_replace($target, "", $new_input);

    return trim($new_input);
}

function hari()
{
    $hari2 = date("w");
    Switch ($hari2) {

        case 0 :
            $hari = "Minggu";
            Break;
        case 1 :
            $hari = "Senin";
            Break;
        case 2 :
            $hari = "Selasa";
            Break;
        case 3 :
            $hari = "Rabu";
            Break;
        case 4 :
            $hari = "Kamis";
            Break;
        case 5 :
            $hari = "Jumat";
            Break;
        case 6 :
            $hari = "Sabtu";
            Break;
    }

    return $hari;
}

function hari_baru($old_day)
{
    //$hari2=date("w");
    $old_day = (int)$old_day;
    Switch ($old_day) {
        case 0 :
            $hari = "Minggu";
            Break;
        case 1 :
            $hari = "Senin";
            Break;
        case 2 :
            $hari = "Selasa";
            Break;
        case 3 :
            $hari = "Rabu";
            Break;
        case 4 :
            $hari = "Kamis";
            Break;
        case 5 :
            $hari = "Jumat";
            Break;
        case 6 :
            $hari = "Sabtu";
            Break;
    }

    return $hari;
}

function bulan_baru($old_month)
{
    //$hari2=date("w");
    $old_month = (int)$old_month;
    Switch ($old_month) {

        case 1 :
            $hari = "Januari";
            Break;
        case 2 :
            $hari = "Februari";
            Break;
        case 3 :
            $hari = "Maret";
            Break;
        case 4 :
            $hari = "April";
            Break;
        case 5 :
            $hari = "Mei";
            Break;
        case 6 :
            $hari = "Juni";
            Break;
        case 7 :
            $hari = "Juli";
            Break;
        case 8 :
            $hari = "Agustus";
            Break;
        case 9 :
            $hari = "September";
            Break;
        case 10 :
            $hari = "Oktober";
            Break;
        case 11 :
            $hari = "November";
            Break;
        case 12 :
            $hari = "Desember";
            Break;
    }

    return $hari;
}

function dayIndo ($dayEng){

    $hari = "";
    Switch ($dayEng) {

        case "Monday" :
            $hari = "Senin";
            Break;
        case "Tuesday" :
            $hari = "Selasa";
            Break;
        case "Wednesday" :
            $hari = "Rabu";
            Break;
        case "Thursday" :
            $hari = "Kamis";
            Break;
        case "Friday" :
            $hari = "Jum'at";
            Break;
        case "Saturday" :
            $hari = "Sabtu";
            Break;
        case "Suday" :
            $hari = "Minggu";
            Break;
    }

    return strtoupper($hari);
}

?>
