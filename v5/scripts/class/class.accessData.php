<?php

class aksesData
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "coba";

    private $strSql;
    private $result;
    private $row;

    private $mysqli;

    public function aksesData()
    {

        $this->openConn();
        $this->setAutoCommitFalse();

    }

    public function openConn()
    {
        $this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->db);
        if (mysqli_connect_errno()) {
            return true;
        } else
            return false;
    }

    public function setAutoCommitFalse()
    {
        $this->mysqli->autocommit(FALSE);
    }

    public function commitQuery()
    {
        $this->mysqli->commit();
    }

    public function doRollBack()
    {
        $this->mysqli->rollback();
    }

    public function setSql($sql)
    {
        $this->strSql = $sql;
    }

    public function getSql()
    {
        return $this->strSql;
    }

    public function setQuery()
    {
        $this->result = $this->mysqli->query($this->strSql);
    }

    public function getQuery()
    {
        return $this->result;
    }

    public function setNextRow()
    {
        $this->row = $this->result->fetch_row();
        return $this->row;
    }

    public function getDataRow($index)
    {
        return $this->row[$index];
    }

    public function closeResult()
    {
        $this->result->close();
    }

    public function getJmlRow()
    {
        return $this->result->num_rows;
    }

    public function closeConn()
    {
        $this->mysqli->close();
    }

    public function setNowDate($tglSkrg)
    {
        $this->nowDate = $tglSkrg;
    }

    public function cekAvailableTable($namaTable)
    {
        //$newSql = "SELECT * FROM ".$namaTable." LIMIT 0,1";
        //$newResult = mysql_query($newSql);
        //return $newResult;
        $this->setSql(" SELECT * FROM " . $namaTable . " LIMIT 0,1 ");
        $this->setQuery();
        return $this->getQuery();
    }

    public function get_date_for_db($old_date)
    {

        $temp_tgl_baru = str_replace("/", "-", $old_date);
        $array_tgl_baru = explode("-", $temp_tgl_baru);
        //m-d-y
        //2-0-1
        $new_date = $array_tgl_baru[2] . "-" . $array_tgl_baru[0] . "-" . $array_tgl_baru[1];
        return $new_date;
    }

    public function get_real_bulan($bln)
    {
        $real_bln = "";
        if ($bln == 1)
            $real_bln = "Jan";
        elseif ($bln == 2)
            $real_bln = "Feb";
        elseif ($bln == 3)
            $real_bln = "Mar";
        elseif ($bln == 4)
            $real_bln = "Apr";
        elseif ($bln == 5)
            $real_bln = "Mei";
        elseif ($bln == 6)
            $real_bln = "Juni";
        elseif ($bln == 7)
            $real_bln = "Juli";
        elseif ($bln == 8)
            $real_bln = "Agust";
        elseif ($bln == 9)
            $real_bln = "Okt";
        elseif ($bln == 10)
            $real_bln = "Sept";
        elseif ($bln == 11)
            $real_bln = "Nov";
        else
            $real_bln = "Des";

        return $real_bln;
    }

    public function cetak_format_tgl_baru($date)
    {

        $splited_date = explode("-", $date);

        $thn = $splited_date[0]; //thn
        $bln = $this->get_real_bulan($splited_date[1]); //bln
        $hari = $splited_date[2]; //hari

        return $hari . " " . $bln . " " . $thn;
    }

    //DIPAKAI COP
    public function getURL_foto($idUser)
    {

        $this->setSql("SELECT FOTO FROM tb_user WHERE ID_USER = '$idUser'");
        $this->setQuery();
        $this->setNextRow();

        return $this->getDataRow(0);
    }

    public function getNama_pelapor($idPelapor)
    {

        $this->setSql("SELECT NAMA_PELAPOR FROM tb_pelapor WHERE ID_PELAPOR = '$idPelapor'");
        $this->setQuery();
        $this->setNextRow();

        return $this->getDataRow(0);
    }

    public function getNama_penyidik($idPenyidik)
    {

        $this->setSql("SELECT NAMA_PENYIDIK FROM tb_penyidik WHERE NRP = '$idPenyidik'");
        $this->setQuery();
        $this->setNextRow();

        return $this->getDataRow(0);
    }

    public function kombinasiUserPass($user, $pass, $idUser)
    {

        $hsl = false;
        $this->setSql("SELECT * FROM tb_user WHERE ID_USER = '$idUser' AND USER_NAME = '$user' AND PASSWORD = '$pass'");
        $this->setQuery();
        if ($this->getJmlRow() == 0) {
            $hsl = false; // TIDAK DITEMUKAN !!
        } else {
            $hsl = true; // DITEMUKAN
        }

        return $hsl;
    }

    public function validasiUsername($user, $idUser)
    {

        $hsl = false;
        $this->setSql("SELECT * FROM tb_user WHERE ID_USER <> '$idUser' AND USER_NAME = '$user'");
        $this->setQuery();
        if ($this->getJmlRow() <> 0) {
            $hsl = false; // TIDAK DITEMUKAN !!
        } else {
            $hsl = true; // DITEMUKAN
        }

        return $hsl;
    }

    public function validasiPassword($pass, $idUser)
    {

        $hsl = false;
        $this->setSql("SELECT * FROM tb_user WHERE ID_USER = '$idUser' AND PASSWORD = '$pass'");
        $this->setQuery();
        if ($this->getJmlRow() == 0) {
            $hsl = false; // TIDAK DITEMUKAN !!
        } else {
            $hsl = true; // DITEMUKAN
        }

        return $hsl;
    }

    public function getNamaPengguna($idUser, $jns)
    {

        $hsl = false;

        $this->setSql("SELECT USER_NAME FROM tb_user WHERE ID_USER = '$idUser'");
        $this->setQuery();
        $this->setNextRow();

        $nama = $this->getDataRow(0);

        if ($jns == 0) {
            if (strlen($nama) > 12) {
                $nama = substr($nama, 0, 9) . "..";
            }
        } else if ($jns == 1) {
            if (strlen($nama) > 15) {
                $nama = substr($nama, 0, 12) . "..";
            }
        } else if ($jns == 2) {
            $nama = $nama;
        }

        return $nama;
    }

    public function cek_unit($nrp_loop)
    {

        $hsl = "";
        $this->setSql("	SELECT	NAMA_UNIT FROM 	tb_penyidik a WHERE a.NRP = '$nrp_loop' ");
        $this->setQuery();
        $this->setNextRow();
        $hsl = $this->getDataRow(0); // TIDAK SAMA !!
        return $hsl;
    }


    public function is_inSame_unit($nrp_loop, $nrp_sess)
    {

        $hsl = false;
        $this->setSql("	SELECT	UCASE(a.NAMA_UNIT), UCASE(b.NAMA_UNIT)
						  	FROM 	tb_penyidik a, tb_penyidik b
							WHERE 
								a.NRP = '$nrp_loop' AND
								b.NRP = '$nrp_sess' 
						  ");
        $this->setQuery();
        $this->setNextRow();
        if ($this->getDataRow(0) <> $this->getDataRow(1)) {
            $hsl = false; // TIDAK SAMA !!
        } else {
            $hsl = true; // SAMA
        }

        return $hsl;
    }


    public function is_inSame_unit_and_subnit($nrp_loop, $nrp_sess)
    {

        $hsl = false;
        $this->setSql("	SELECT	UCASE(a.NAMA_UNIT), UCASE(b.NAMA_UNIT),
						  			UCASE(a.NAMA_SUBNIT), UCASE(b.NAMA_SUBNIT)
						  	FROM 	tb_penyidik a, tb_penyidik b
							WHERE 
								a.NRP = '$nrp_loop' AND
								b.NRP = '$nrp_sess' 
						  ");
        $this->setQuery();
        $this->setNextRow();
        if ($this->getDataRow(0) == $this->getDataRow(1) AND $this->getDataRow(2) == $this->getDataRow(3)) {
            $hsl = true; // SAMA
        } else {
            $hsl = false; // TIDAK SAMA !!
        }

        return $hsl;
    }
    /*
    public function is_inSame_subnit($nrp_loop, $nrp_sess, $nama_unit) {

        $hsl = false;
        $this->setSql("	SELECT	a.NAMA_UNIT, b.NAMA_UNIT
                          FROM 	tb_penyidik a, tb_penyidik b
                        WHERE
                            a.NRP = '$nrp_loop' AND
                            b.NRP = '$nrp_sess' AND
                            b.NRP = '$nrp_sess'
                      ");
        $this->setQuery();
        $this->setNextRow();
        if( $this->getDataRow(0) <> $this->getDataRow(1) ) {
            $hsl = false; // TIDAK SAMA !!
        }else{
            $hsl = true; // SAMA
        }

        return $hsl;
    }
    */

} // END CLASSS

?>
