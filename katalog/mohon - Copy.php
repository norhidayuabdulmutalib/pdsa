<?php 
$uri = explode("?",$_SERVER['REQUEST_URI']);
$URLs = $uri[1];
//$conn->debug=true;
$f_peserta_noic=isset($_REQUEST["f_peserta_noic"])?$_REQUEST["f_peserta_noic"]:"";
$pass=isset($_REQUEST["pass"])?$_REQUEST["pass"]:"";
$idk=isset($_REQUEST["idk"])?$_REQUEST["idk"]:"";
$proses=isset($_REQUEST["pro"])?$_REQUEST["pro"]:"";
//$proses = $_GET['pro'];
if(!empty($proses) && $proses=='UPDATE'){
	extract($_POST);
	$pass_check = $_POST['pass_check'];
	//$conn->debug=true;
	/*
	$sql = "UPDATE _tbl_peserta SET ". 
	" f_peserta_nama=".tosql($f_peserta_nama,"Text").", f_peserta_grp=".tosql($f_peserta_grp,"Text").", f_title_grade=".tosql($f_title_grade,"Text").
	", f_peserta_jantina=".tosql($f_peserta_jantina,"Text").", BranchCd=".tosql($BranchCd,"Text").
	", f_peserta_tel_pejabat=".tosql($f_peserta_tel_pejabat,"Text").", f_peserta_tel_rumah=".tosql($f_peserta_tel_rumah,"Text").
	", f_peserta_hp=".tosql($f_peserta_hp,"Text").", f_peserta_faks=".tosql($f_peserta_faks,"Text").
	", f_peserta_email=".tosql($f_peserta_email,"Text").", f_peserta_alamat1=".tosql($f_peserta_alamat1,"Text").", 
	f_peserta_alamat2=".tosql($f_peserta_alamat2,"Text").
	", f_peserta_alamat3=".tosql($f_peserta_alamat3,"Text").", f_peserta_poskod=".tosql($f_peserta_poskod,"Text").
	", f_peserta_negeri=".tosql($f_peserta_negeri,"Text").", f_peserta_lahir=".tosql(DBDate($f_peserta_lahir),"Text").
	", update_dt=".tosql(date("Y-m-d H:i:s"),"Text"). ", update_by=".tosql($user,"Text"). 
	", f_peserta_negara=".tosql($insnationality,"Text").
	" WHERE id_peserta=".tosql($id_peserta,"Text");

	$result = $conn->Execute($sql);
	audit_trail($sql);
	
	if($pass_check==0){ 
		$conn->Execute("UPDATE _tbl_peserta SET f_pass=".tosql(md5($fpass))." WHERE id_peserta=".tosql($id_peserta,"Text"));
	}
	
	$sqli ="INSERT INTO _tbl_kursus_jadual_peserta (peserta_icno, EventId, InternalStudentSelectedDt, InternalStudentInputDt, InternalStudentInputBy, is_selected)
	VALUES (".tosql($f_peserta_noic).", ".tosql($idk).", ".tosql(date("Y-m-d H:i:s")).", ".tosql(date("Y-m-d H:i:s")).", ".tosql($f_peserta_noic).",0)";
	$result = $conn->Execute($sqli);
	*/
	//exit;
	$proses='DAFTAR';
	include 'katalog/mohon_daftar.php';
	print '<script language="javascript">
		parent.emailwindow.hide();
	</script>';
}
$msg='';
?>
<script LANGUAGE="JavaScript">
function do_pages(URL){
	//alert(URL);
	document.ilim.action = URL;
	document.ilim.submit();
}
function do_mohon(URL){
	if(document.ilim.f_peserta_noic.value==''){
		alert("Sila masukkan No. Kad Pengenalan peserta terlebih dahulu.");
		document.ilim.f_peserta_noic.focus();
		return true;
	} else if(document.ilim.f_peserta_nama.value==''){
		alert("Sila masukkan Nama Peserta terlebih dahulu.");
		document.ilim.f_peserta_nama.focus();
		return true;
	} else if (document.ilim.f_peserta_lahir.value == ''){
		alert("Sila masukkan tarikh lahir peserta.");
		document.ilim.f_peserta_lahir.focus();
		return true;
	} else if (document.ilim.insnationality.value == ''){
		alert("Sila pilih warganegara.");
		document.ilim.insnationality.focus();
		return true;
	} else if (document.ilim.f_peserta_tel_rumah.value == ''){
		alert("Sila masukkan no. telefon rumah.");
		document.ilim.f_peserta_tel_rumah.focus();
		return true;
	} else if (document.ilim.f_peserta_hp.value == ''){
		alert("Sila masukkan no. telefon bimbit (HP).");
		document.ilim.f_peserta_hp.focus();
		return true;
	} else if (document.ilim.f_peserta_email.value == ''){
		alert("Sila masukkan alamat e-mel.");
		document.ilim.f_peserta_email.focus();
		return true;
	} else if (document.ilim.f_peserta_grp.value == ''){
		alert("Sila masukkan kumpulan jawatan.");
		document.ilim.f_peserta_grp.focus();
		return true;
	} else if (document.ilim.f_title_grade.value == ''){
		alert("Sila masukkan gred jawatan.");
		document.ilim.f_title_grade.focus();
		return true;
	} else if (document.ilim.nama_ketuajabatan.value == ''){
		alert("Sila masukkan nama penyelia");
		document.ilim.nama_ketuajabatan.focus();
		return true;
	} else if (document.ilim.jawatan_ketuajabatan.value == ''){
		alert("Sila masukkan jawatan penyelia");
		document.ilim.jawatan_ketuajabatan.focus();
		return true;
	} else if (document.ilim.email_ketuajabatan.value == ''){
		alert("Sila masukkan alamat e-mel penyelia");
		document.ilim.email_ketuajabatan.focus();
		return true;
	} else if (document.ilim.BranchCd.value == ''){
		alert("Sila masukkan Jabatan/Agensi/Unit.");
		document.ilim.BranchCd.focus();
		return true;
	} else if (document.ilim.f_peserta_alamat1.value == ''){
		alert("Sila masukkan alamat tempat bertugas");
		document.ilim.f_peserta_alamat1.focus();
		return true;
	} else if (document.ilim.f_peserta_poskod.value == ''){
		alert("Sila masukkan poskod tempat bertugas");
		document.ilim.f_peserta_poskod.focus();
		return true;
	} else if (document.ilim.f_peserta_negeri.value == ''){
		alert("Sila pilih maklumat negeri");
		document.ilim.f_peserta_negeri.focus();
		return true;

	} else if (document.ilim.f_pass.value == ''){
		alert("Sila masukkan kata laluan anda (Tidak melebihi 20 abjad @ nombor).");
		document.ilim.f_pass.focus();
		return true;
	} else if (document.ilim.email_ketuajabatan.value==document.ilim.f_peserta_email.value){
		alert("Maklumat email peserta dan penyelia sama. Sila pastikan ianya berbeza.");
		document.ilim.f_penyelia_emel.focus();
		return true;
	} else {
		//document.ilim.proses.value='PROSES';
		document.ilim.action = URL;
		document.ilim.submit();
	}
}
function form_back(URL){
	parent.emailwindow.hide();
}

function do_daftar(URL){
	if(document.ilim.f_penyelia.value==''){
		alert("Sila masukkan nama penyelia terlebih dahulu.");
		document.ilim.f_penyelia.focus();
		return true;
	} else if(document.ilim.f_penyelia_jawatan.value==''){
		alert("Sila masukkan jawatan penyelia terlebih dahulu.");
		document.ilim.f_penyelia_jawatan.focus();
		return true;
	} else if (document.ilim.f_penyelia_emel.value == ''){
		alert("Sila masukkan emel penyelai terlebih dahulu.");
		document.ilim.f_penyelia_emel.focus();
		return true;
	} else if (document.ilim.f_penyelia_emel.value==document.ilim.f_peserta_email.value){
		alert("Maklumat email peserta dan penyelia sama. Sila pastikan ianya berbeza.");
		document.ilim.f_penyelia_emel.focus();
		return true;
	} else {
		//document.ilim.proses.value='PROSES';
		document.ilim.action = URL;
		document.ilim.submit();
	}
}

</script>
<form name="ilim" method="post">
<input type="hidden" name="idk" value="<?=$idk;?>" />
<table width="90%" cellpadding="5" cellspacing="1" border="0" align="center">
	<tr><td colspan="3" height="30px" align="center" valign="middle" bgcolor="#66CC99">
    	<b>Sila masukkan No. kad Pengenalan anda / Kad Kuasa (Polis/Tentera)</b>
    </td></tr>
    <tr>
        <td width="28%" align="right"><b> No. Kad Pengenalan : </b></td> 
   	  	<td width="72%" colspan="2" align="left">
        	<input type="text" size="20" name="f_peserta_noic" value="<?=$f_peserta_noic;?>" maxlength="12" />&nbsp;
      		<input type="button" value="Mohon" style="cursor:pointer" 
            onclick="do_pages('modal_form.php?win=<?=base64_encode('katalog/mohon.php;');?>')" />
            <input type="button" value="Tutup" style="cursor:pointer" onclick="form_back()" />
        </td>
    </tr>
</table>
<?php
//print $f_peserta_noic."/".$pass;
if(!empty($f_peserta_noic) && empty($pass)){ 
	//$conn->debug=true;
	$sSQL="SELECT A.* FROM _tbl_peserta A WHERE A.f_peserta_noic = ".tosql($f_peserta_noic,"Text");
	$rs = &$conn->Execute($sSQL);
	if(!$rs->EOF){
		$sqlk = "SELECt * FROM _tbl_kursus_jadual_peserta WHERE is_deleted=0 AND peserta_icno=".tosql($f_peserta_noic)." AND EventId=".tosql($idk);
		$rsk = &$conn->execute($sqlk);
		//print $sqlk;
		$ada=0;
		if(!$rsk->EOF){ 
			$ada=1; 
			$msg = "Anda telah membuat permohonan bagi kursus ini.";
		} else {
			$nopass = $rs->fields['f_pass'];
			$msg='Maklumat biodata anda telah wujud.  Sila kemaskini maklumat biodata anda.';
		} 
		//print $ada."/".$nopass;
?>
<br />
<hr /><br />
<table width="90%" cellpadding="5" cellspacing="1" border="0" align="center">
	<tr><td colspan="3" height="30px" align="center" valign="middle">
    	<font style="color:#FF0000;font-size:14px;font-weight:bold"><?php print $msg;?></font>
        <br /><br />
        <?php if($ada==0 && !empty($nopass)){ ?>
            <b>Masukkan Katalaluan anda : </b><input type="text" size="15" name="pass" maxlength="20" />
            <br /><br />
            <input type="button" value="Kemaskini Biodata" style="cursor:pointer" 
            onclick="do_pages('modal_form.php?win=<?=base64_encode('katalog/mohon.php;');?>&pro=KEMAS')" />
        <?php } else if($ada==0 && empty($nopass)){ ?>
            <br /><br />
            <input type="button" value="Kemaskini Biodata" style="cursor:pointer" 
            onclick="do_pages('modal_form.php?win=<?=base64_encode('katalog/mohon.php;');?>&pro=KEMAS&f_peserta_noic=<?=$f_peserta_noic;?>&pass=BARU')" />
        <?php } else { ?>
        <input type="button" value="Keluar" onclick="form_back()" />
        <?php } ?>
	</td></tr>
</table>
<?php
	} else {
		if($proses=='DAFTAR'){
			include 'katalog/mohon_daftar.php';
		} else {
?>
            <br />
            <hr />
            <table width="90%" cellpadding="5" cellspacing="1" border="0" align="center">
            
                <tr><td><font color="#FF0000" style="font-size:14px;font-weight:bold">Anda adalah peserta baru, sila lengkapkan maklumat dibawah ini.</font></td></tr>
                <tr><td colspan="3" height="30px" align="center" valign="middle">
                    <!--Sila masukkan No. Kad Pengenalan Anda-->
                    <?php 
                    $f_peserta_noic = $f_peserta_noic;
                    //print $f_peserta_noic;
                    include 'apps/peserta/biodata_update.php';?>
                    <br />
                    <input type="button" value="Daftar Permohonan" style="cursor:pointer"
                    onclick="do_mohon('modal_form.php?win=<?=base64_encode('katalog/mohon.php;');?>&pro=DAFTAR')" />
                </td></tr>
            </table>
<?php
		}
	}
} else if(!empty($f_peserta_noic) && !empty($pass)){ 
	//$conn->debug=true;
	$sSQL="SELECT A.* FROM _tbl_peserta A WHERE A.f_peserta_noic = ".tosql($f_peserta_noic,"Text");
	if($pass<>'BARU'){ $sSQL .= " AND f_pass=".tosql(md5($pass)); }
	$rs = &$conn->Execute($sSQL);
	if(!$rs->EOF){
?>
<br />
<hr />
<table width="90%" cellpadding="5" cellspacing="1" border="0" align="center">
	<tr><td colspan="3" height="30px" align="center" valign="middle">
		
        <?php include 'apps/peserta/biodata_update.php';?>
        <br />
        <input type="hidden" size="15" name="pass" value="<?=$pass;?>"  />
        <input type="button" value="Kemaskini" style="cursor:pointer" 
        onclick="do_mohon('modal_form.php?win=<?=base64_encode('katalog/mohon.php;');?>&pro=UPDATE')" />
	</td></tr>
</table>
<?php
	} else {
?>
<br />
<hr /><br />
<table width="90%" cellpadding="5" cellspacing="1" border="0" align="center">
	<!--<tr><td colspan="3" align="center"><b>SILA MASUKKAN MAKLUMAT KETUA JABATAN / PENYELIA DI TEMPAT KERJA TUAN/PUAN</b><br /><hr /><br /></td></tr>
    <tr>
        <td><strong>Nama Penyelia <font color="#FF0000">*</font> : </strong></td>
        <td colspan="2"><input type="text" size="65" name="f_penyelia" value="<? print $rs->fields['f_penyelia'];?>"/></td>
    </tr>
    <tr>
        <td><strong>Jawatan <font color="#FF0000">*</font> : </strong></td>
        <td colspan="2"><input type="text" size="65" name="f_penyelia_jawatan" value="<? print $rs->fields['f_penyelia_jawatan'];?>"/></td>
    </tr>
    <tr>
        <td><strong>Emel <font color="#FF0000">*</font> : </strong></td>
        <td colspan="2"><input type="text" size="65" name="f_penyelia_emel" value="<? print $rs->fields['f_penyelia_emel'];?>"/></td>
    </tr>
	<tr><td colspan="3" height="30px" align="center" valign="middle">
        <br /><br />
        <input type="button" value="Daftar Permohonan" style="cursor:pointer"
        onclick="do_daftar('katalog/mohon_daftar.php?pro=DAFTAR')" />
	</td></tr>-->
    
	<tr><td><font color="#FF0000" style="font-size:14px;font-weight:bold">Sila kemaskini maklumat biodata tuan/puan.</font></td></tr>
	<tr><td colspan="3" height="30px" align="center" valign="middle">
        <?php include 'apps/peserta/biodata_update.php';?>
        <br />
        <input type="button" value="Daftar Permohonan" style="cursor:pointer"
        onclick="do_daftar('katalog/mohon_daftar.php?pro=DAFTAR')" />
        <!--onclick="do_mohon('modal_form.php?win=<?=base64_encode('katalog/mohon_daftar.php;');?>&pro=DAFTAR')" />-->
	<!--</td></tr>-->
</table>
<script language="javascript">
document.ilim.f_penyelia.focus();
</script>
<?php
	}
} 
?>
</form>