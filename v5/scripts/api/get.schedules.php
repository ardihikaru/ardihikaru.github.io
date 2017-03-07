<?php
session_start(); // start up your PHP ses

include "./../class/class.accessData.php";
include "./../function/function.php";

$results = array(
    'success' => false,
    'txt_result' => 'Hasil query belum didapatkan!',
    'tmp_queries' => array(
        'enabled' => true, // false | true
        'queries' => array(),
    ),
    'data' => array(),
    'reports' => array(),
);

$now_sql = "";
$day_sql = "";
$limit_sql = "";

if ( isset($_POST['act']) ){

    $act = reformat_input($_POST['act']);
    $day = reformat_input($_POST['day']);

    $results['reports'] = $_POST; // check doank!

    if($day == "today"){
        $day_sql = "
            AND DATE_FORMAT(NOW(),'%a') = a.hari_mengajar_eng 
        ";

        if($act == "now"){
            $now_sql = "
                AND (
                        TIME_TO_SEC(DATE_FORMAT(NOW(),'%H:%i:%s')) >= TIME_TO_SEC(DATE_FORMAT(c.time_starts,'%H:%i:%s')) AND 
                        TIME_TO_SEC(DATE_FORMAT(NOW(),'%H:%i:%s')) <= TIME_TO_SEC(DATE_FORMAT(c.time_ends,'%H:%i:%s'))
                    )
            ";
        }else if($act == "next"){
            $limit_sql = "LIMIT 0,1";
        }



    }else{
        //AND a.hari_mengajar_eng = DATE_FORMAT('".$day."','%a')
        $day_sql = "
            AND a.hari_mengajar_eng = '".$day."'
        ";
    }

}

$myDB = new aksesData();
// cek, apakah "idKasus + sumber_data" sudah ada di DB ?
$myDB->setSql("
		SELECT	
				a.hari_mengajar,
				DATE_FORMAT(NOW(),'%H:%i:%s') AS 'JAM_NOW', 
				c.jam_ke, c.time_starts, c.time_ends,
				b.matkul_name, b.jeniskelas_name, b.kelas_name, b.ruangkelas_name, b.ruangkelas_kode, b.dosen_utama, b.jml_jam, b.jml_sks
		FROM 	jadwal_pengajaran a
		INNER JOIN (
			SELECT		a.bebandetail_id, b.matkul_name, b.jeniskelas_name, c.kelas_name, d.ruangkelas_name, d.ruangkelas_kode, a.dosen_utama, b.jml_jam, b.jml_sks, 
						b.matkuldetail_id, b.matkul_id, b.jeniskelas_id, c.kelas_id, d.ruangkelas_id
			FROM		beban_matkul_detail a 
			INNER JOIN 	( 
				SELECT 	b1.matkuldetail_id, b1.matkul_id, b1.jeniskelas_id, b1.jml_jam, b1.jml_sks, b2.matkul_name, b3.jeniskelas_name
				FROM 		matkul_detail b1
				INNER JOIN 	matkul b2
					ON b1.matkul_id = b2.matkul_id
				INNER JOIN 	jenis_kelas b3
					ON b1.jeniskelas_id = b3.jeniskelas_id
			) AS b 
				ON a.matkuldetail_id = b.matkuldetail_id
			LEFT JOIN 	daftar_kelas c
				ON a.kelas_id = c.kelas_id
			LEFT JOIN 	daftar_ruangkelas d 
				ON a.ruangkelas_id = d.ruangkelas_id
		) b 
			ON a.bebandetail_id = b.bebandetail_id
		INNER JOIN jam_perkuliahan c
			ON a.jamkuliah_id = c.jamkuliah_id
		WHERE 	1 = 1 
		        $day_sql
				$now_sql
				$limit_sql
	");
//echo $myDB->getSql();
if($results["tmp_queries"]["enabled"])  $results["tmp_queries"]["queries"][0] = $myDB->getSql();

$myDB->setQuery();

if ($myDB->getJmlRow() > 0) { // data kasus ketemu!
    //$total_rows = $myDB->getJmlRow();
    $results["success"] = true;
    $results["txt_result"] = "Query ditemukan!";
    $i = 0;
    while( $myDB->setNextRow() ){
        $results["data"][$i]["current_day"] = $myDB->getDataRow(0);
        $results["data"][$i]["current_time"] = $myDB->getDataRow(1);
        $results["data"][$i]["time_of_teaching"] = $myDB->getDataRow(2);
        $results["data"][$i]["time_starts"] = $myDB->getDataRow(3);
        $results["data"][$i]["time_ends"] = $myDB->getDataRow(4);
        $results["data"][$i]["taught_course"] = $myDB->getDataRow(5);
        $results["data"][$i]["type_of_class"] = $myDB->getDataRow(6);
        $results["data"][$i]["taught_class"] = $myDB->getDataRow(7);
        $results["data"][$i]["class_location"] = $myDB->getDataRow(8);
        $results["data"][$i]["class_code"] = $myDB->getDataRow(9);
        $results["data"][$i]["lecturer"] = $myDB->getDataRow(10);
        $i++;
    }
    //$myDB->setNextRow();

}else{
    $results["txt_result"] = 'TIDAK ADA JAM MENGAJAR';
}
$myDB->closeConn();


//var_dump($results);
//echo $results["txt_result"];

header('Content-type: application/json');
echo json_encode($results);
?>
