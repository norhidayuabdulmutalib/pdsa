<?php
$uri = explode("?",$_SERVER['REQUEST_URI']);
$URLs = $uri[1];
$proses = $_GET['pro'];
$msg='';
if($proses=='SAVE'){ 
	$id 			= $_POST['id'];
	$jadual_masa 		= $_POST['jadual_masa'];
	$objektif 		= $_POST['objektif'];
	$kandungan 	= $_POST['kandungan'];

	$sql = "UPDATE _tbl_kursus_jadual SET 
		jadual_masa=".tosql($jadual_masa,"Text").",
		objektif=".tosql($objektif,"Text").",
		kandungan=".tosql($kandungan,"Text")."
		WHERE id=".tosql($id,"Text");
	$rs = &$conn->Execute($sql);
	audit_trail($sql);
	//print $sql;
	
	print "<script language=\"javascript\">
		alert('Rekod telah disimpan');
		//parent.location.reload();
		</script>";
}

$href_link_pro = "modal_form.php?win=".base64_encode('kursus/jadual_penceramah_pro.php;'.$id);

$dir='';
$pathtoscript='../editor/';
include_once($dir."../editor/config.inc.php");
include_once($dir."../editor/FCKeditor/fckeditor.php") ;

$sSQL="SELECT A.courseid, A.coursename, A.kampus_id, B.categorytype, C.SubCategoryNm , D.objektif, D.jadual_masa, 
D.kandungan, D.startdate, D.enddate 
FROM _tbl_kursus A, _tbl_kursus_cat B, _tbl_kursus_catsub C, _tbl_kursus_jadual D 
WHERE A.category_code=B.id AND A.subcategory_code=C.id AND A.id=D.courseid AND D.id = ".tosql($id,"Next");
$rs = &$conn->Execute($sSQL);
//print $sSQL;
$objektif = $rs->fields['objektif'];
$jadual_masa = $rs->fields['jadual_masa'];
$kandungan = $rs->fields['kandungan'];
?>
<script LANGUAGE="JavaScript">
function form_hantar(URL){
	document.ilim.action = URL;
	document.ilim.submit();
}
function form_back(URL){
	parent.emailwindow.hide();
}

</script>

<form name="ilim" method="post">
<table width="100%" align="center" cellpadding="4" cellspacing="0" border="1">
    <tr><td colspan="3">
        <table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
			<tr>
                <td width="25%" align="right"><b>Pusat Latihan @ Tempat Kursus</b></td>
                <td width="1%" align="center"><b> : </b></td>
                <td align="left"><font color="#0033FF" style="font-weight:bold">
                    <?php print dlookup("_ref_kampus","kampus_nama","kampus_id=".tosql($rs->fields['kampus_id'])); ?></font>
                </td>	        
            </tr>
            <tr>
                <td width="25%" align="right"><b>Kursus</b></td>
                <td width="1%" align="center"><b> : </b></td>
                <td width="74%" align="left"><?php print $rs->fields['courseid'] . " - " .$rs->fields['coursename'];?></td>                
            </tr>
            <tr>
                <td align="right"><b>Kategori</b></td>
                <td align="center"><b> : </b></td>
                <td align="left"><?php print $rs->fields['categorytype'];?></td>                
            </tr>
            <tr>
                <td align="right"><b>Pusat</b></td>
                <td align="center"><b> : </b></td>
                <td align="left"><?php print $rs->fields['SubCategoryNm'];?>
                <div style="float:right">
                	<?php if($btn_display==1){ ?>
                    <i>Sila klik <input type="button" value="Proses Surat" style="cursor:pointer" 
                    onclick="open_modal1('<?php print $href_link_pro;?>','Proses surat jemputan penceramah',1,1)" /></i>
                	<?php } ?>
                </div></td>                
            </tr>
            <tr>
                <td align="right"><b>Tarikh Kursus</b></td>
                <td align="center"><b> : </b></td>
                <td align="left"><?php print DisplayDate($rs->fields['startdate']);?> - <?php print DisplayDate($rs->fields['enddate']);?>
                <div style="float:right"><i>untuk menjana surat jemputan penceramah.</i></div>
                </td>                
            </tr>
		</table>
    </td>
    <tr><td colspan="3">
        <table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
            <tr>
                <td align="right" width="19%"><b>Jadual Kursus</b></td>
                <td align="center" width="1%"><b> : </b></td>
                <td align="left" valign="top" colspan="2" width="80%">
                <?php include 'kursus/jadual_pensyarah.php'; ?>
            	</td>
            </tr>

           <!-- <tr>
                <td align="right"><b>Objektif</b></td>
                <td align="center"><b> : </b></td>
                <td align="left" valign="top" colspan="2"> <div class="rte"> 
                          <?  if ($wysiwyg===true){ 
                            $oFCKeditor = new FCKeditor('objektif') ;
                            $oFCKeditor->BasePath = $pathtoscript.'../editor/FCKeditor/';
                            $oFCKeditor->Value = $objektif;
                            $oFCKeditor->Width = "100%";
                            $oFCKeditor->Height = 350;
                            $oFCKeditor->Create() ;
                         } else {
                          ?>
                              <textarea name="objektif" cols="60" rows="5"><?php print $objektif; ?></textarea>
                         <? }?>
                            </div>
            </td></tr>
            <tr>
                <td align="right"><b>Kandungan Kursus</b></td>
                <td align="center"><b> : </b></td>
                <td align="left" valign="top" colspan="2"> <div class="rte"> 
                          <?  if ($wysiwyg===true){ 
                            $oFCKeditor = new FCKeditor('kandungan') ;
                            $oFCKeditor->BasePath = $pathtoscript.'../editor/FCKeditor/';
                            $oFCKeditor->Value = $kandungan;
                            $oFCKeditor->Width = "100%";
                            $oFCKeditor->Height = 350;
                            $oFCKeditor->Create() ;
                         } else {
                          ?>
                              <textarea name="kandungan" cols="60" rows="5"><?php print $kandungan; ?></textarea>
                         <? }?>
                            </div>
            </td></tr>
            <tr><td colspan="5"><hr /></td></tr>
            <tr>
                <td colspan="5" align="center">
                	<?php if($btn_display==1){ ?>
                    <input type="button" value="Simpan" class="button_disp" title="Sila klik untuk menyimpan maklumat" onClick="form_hantar('modal_form.php?<? print $URLs;?>&pro=SAVE')" >
                    <?php } ?>
                    <!--<input type="button" value="Kembali" class="button_disp" title="Sila klik untuk kembali ke senarai rujukan disiplin" onClick="form_back()" >--1>
                    <input type="hidden" name="id" value="<?=$id?>" />
                </td>
            </tr>-->
        </table>
    </td></tr>
</table>
</form>