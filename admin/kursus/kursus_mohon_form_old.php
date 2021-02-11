
<script language="javascript" type="text/javascript">	
function open_modal(URL,title,width,height){
	emailwindow=dhtmlmodal.open('EmailBox', 'iframe', URL, title, 'width='+width+'px,height='+height+'px,center=1,resize=1,scrolling=0')
} //End "opennewsletter" function

function do_terima(URL){
	if(confirm("Adakah anda pastu untuk mengesahkan permohonan peserta ini?")){
		document.hadir.action = URL;
		document.hadir.submit();
	}
}

function do_refresh(){
	refresh = parent.location; 
	parent.location = refresh;
}
</script>

<?php
include_once '../admin/common.php'; 
//$id=isset($_REQUEST["id"])?$_REQUEST["id"]:"";
$gids=isset($_REQUEST["ids"])?$_REQUEST["ids"]:"";
$act=isset($_REQUEST["act"])?$_REQUEST["act"]:"";

if(!empty($act) && $act=='SAH'){
	$sql = "UPDATE _tbl_kursus_jadual_peserta SET approve_ilim=1, approve_dt=".tosql(date("Y-m-d H:i:s")).", 
	approve_by=".tosql($_SESSION["s_logid"])." WHERE InternalStudentId=".tosql($gids);
	$conn->execute($sql);
}


$curr_yr = date("Y");
$prev_yr = $curr_yr-1;

// $conn->debug=true;
$sSQL="SELECT A.courseid, A.coursename, B.categorytype, C.id AS CID, C.SubCategoryNm, D.startdate, D.enddate 
FROM _tbl_kursus A, _tbl_kursus_cat B, _tbl_kursus_catsub C, _tbl_kursus_jadual D 
WHERE A.category_code=B.id AND A.subcategory_code=C.id AND A.id=D.courseid AND D.id = ".tosql($id,"Text");
$rs = $conn->Execute($sSQL);

//print $sSQL;


//$sql_det = "SELECT A.*, B.insname, B.insorganization FROM _tbl_kursus_jadual_det A, _tbl_instructor B WHERE A.instruct_id=B.ingenid AND A.event_id=".tosql($id,"Number");
$sql_det = "SELECT DISTINCT(B.f_peserta_noic) as ic, A.*, B.f_peserta_nama, B.BranchCd, B.f_title_grade 
FROM _tbl_kursus_jadual_peserta A, _tbl_peserta B WHERE A.peserta_icno=B.f_peserta_noic AND A.approve_ilim=0 AND A.EventId=".tosql($id);
$sql_det .= " GROUP BY B.f_peserta_noic ORDER BY B.f_peserta_nama";
$rs_det = $conn->execute($sql_det);
//print $sql_det;
$bil=0;
$conn->debug=false;
$curr_date = date("Y-m-d");
$end_date = $rs->fields['enddate'];
?>

<form name="hadir" method="post" action="">
    <div class="card">
        <div class="card-header" >
            <!-- <h4>Carian Maklumat Kursus</h4> -->
        </div>
        <div class="card-body">
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><b>Kursus :</b></label>
                <div class="col-sm-12 col-md-7">
                    <div><?php print $rs->fields['courseid'] . " - " .$rs->fields['coursename'];?></div>
                </div>
            </div>
            
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><b>Kategori : </b></label>
                <div class="col-sm-12 col-md-7">
                    <?php print $rs->fields['categorytype'];?>
                </div>
            </div>
    
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><b>Pusat : </b></label>
                    <div class="col-sm-12 col-md-7">
                        <?php print $unit = pusat_list($rs->fields['CID']); //$rs->fields['SubCategoryNm'];?>
                    </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"><b>Tarikh Kursus : </b></label>
                    <div class="col-sm-12 col-md-7">
                        <?php echo date('d-m-Y', strtotime($rs->fields['startdate'])) ?> - <?php echo date('d-m-Y', strtotime($rs->fields['enddate'])) ?>
                    </div>
            </div>

            <div class="panel-group driving-license-settings" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								  <h4 class="panel-title">
									<a data-toggle="dropdown" data-parent="#accordion" href="#dropdownOne">
										<input type="checkbox" value=""> I have Driver License	
									</a>
								  </h4>
							</div>
							<div id="dropdownOne" class="panel-dropdown dropdown in">
								<div class="panel-body">
									<div class="driving-license-kind">
										<div class="checkbox">
											<input type="checkbox" value="">A
										</div>
										<div class="checkbox">
											<input type="checkbox" value="">B
										</div>
										<div class="checkbox">
											<input type="checkbox" value="">C
										</div>
										<div class="checkbox">
											<input type="checkbox" value="">D
										</div>
										<div class="checkbox">
											<input type="checkbox" value="">E
										</div>																											
									</div>
								</div>
							</div>
						</div>
					</div>
        </div>
    </div>

    <table width="100%" align="center" cellpadding="4" cellspacing="0" border="1">
        <tr><td colspan="3">
            <table width="96%" cellpadding="4" cellspacing="0" border="0" align="center">
                <tr>
                    <td width="15%" align="right"><b>Kursus</b></td>
                    <td width="1%" align="center"><b> : </b></td>
                    <td width="50%" align="left"><?php print $rs->fields['courseid'] . " - " .$rs->fields['coursename'];?></td>    
                    <td width="34%" align="right" rowspan="4" valign="top">
                        <!-- <input type="button" class="btn btn-secondary" value="Tutup" style="cursor:pointer" onclick="do_refresh();" /> -->
                    </td>            
                </tr>
                <tr>
                    <td align="right"><b>Kategori</b></td>
                    <td align="center"><b> : </b></td>
                    <td align="left"><?php print $rs->fields['categorytype'];?></td>                
                </tr>
                <tr>
                    <td align="right"><b>Pusat</b></td>
                    <td align="center"><b> : </b></td>
                    <td align="left"><?php print $unit = pusat_list($rs->fields['CID']); //$rs->fields['SubCategoryNm'];?></td>                
                </tr>
                <tr>
                    <td align="right"><b>Tarikh Kursus</b></td>
                    <td align="center"><b> : </b></td>
                    <td align="left"><?php echo date('d-m-Y', strtotime($rs->fields['startdate'])) ?> - <?php echo date('d-m-Y', strtotime($rs->fields['enddate'])) ?>
                    </td>                
                </tr>
            </table>
        </td>
        <tr><td colspan="3">
            <table width="96%" cellpadding="4" cellspacing="0" border="1" align="center">
                <tr bgcolor="#CCCCCC">
                    <td colspan="8" valign="top">
                    <div style="float:left">
                    <b>Senarai peserta bagi kursus :<br/><?php print $rs->fields['courseid'] . " - " .$rs->fields['coursename'];?></b></div>
                </td></tr>
                <tr bgcolor="#CCCCCC">
                    <th width="5%" align="center" rowspan="2"><b>Bil</b></th>
                    <th width="35%" align="center" rowspan="2"><b>Nama Peserta</b></th>
                    <th width="5%" align="center" rowspan="2"><b>Gred</b></th>
                    <th width="25%" align="center" rowspan="2"><b>Agensi/Jabatan/Unit</b></th>
                    <th width="15%" align="center" colspan="2"><b>Jumlah Penyertaan<br/>Kursus Di ILIM</b></th>
                    <th width="5%" align="center" rowspan="2"><b>Pengesahan Permohonan</b></th>
                </tr>
                <tr>
                    <th align="center"><?=$curr_yr;?></th>
                    <th align="center"><?=$prev_yr;?></th>
                </tr>
                <?php while(!$rs_det->EOF){ $bil++; 
                        $href_list = "modal_form.php?win=".base64_encode('peserta/view_senarai_kursus_peserta.php;'.$rs_det->fields['ic']).'&icno='.$rs_det->fields['ic'];
                        //$href_list = "../peserta/view_senarai_kursus_peserta.php?icno=".$rs_det->fields['ic'];
                        //$url = 'kursus_mohon_form.php?id='.$id;
                        $url = "modal_form.php?win=".base64_encode('kursus/kursus_mohon_form.php;'.$id);
                        $idh=$rs_det->fields['InternalStudentId'];
                        $ic = $rs_det->fields['ic'];
                        include 'peserta/view_kursus_mohon.php';
                        if($bil1>=2){ $bg1='CC99FF'; } else { $bg1='FFFFFF'; } 
                ?>
                <tr bgcolor="=<?=$bg1;?>">
                    <td align="right"><?php print $bil;?>.&nbsp;</td>
                    <td align="left"><?php print $rs_det->fields['f_peserta_nama'];?><br /><i>No. KP: <?php print $rs_det->fields['ic'];?></i>&nbsp;</td>
                    <td align="center"><?php print dlookup("_ref_titlegred","f_gred_code","f_gred_id=".tosql($rs_det->fields['f_title_grade']));?>&nbsp;</td>
                    <td align="left"><?php print dlookup("_ref_tempatbertugas","f_tempat_nama","f_tbcode=".tosql($rs_det->fields['BranchCd']));?>&nbsp;</td>
                    <td align="center" <?php if($jumlah1<>'-'){ ?> onclick="open_modal('<?=$href_list;?>','Senarai kursus yang telah dipohon',1,1)" style="cursor:pointer"<?php } ?>>
                    <?php	if($jumlah1<>'-'){ print $jumlah1; }
                            else { print $jumlah1; }
                    ?></td>
                    <td align="center" <?php if($jumlah2<>'-'){ ?> onclick="open_modal('<?=$href_list;?>','Senarai kursus yang telah dipohon',1,1)" style="cursor:pointer"<?php } ?>>
                    <?php 	if($jumlah2<>'-'){ print $jumlah2; } 
                            else { print $jumlah2; } 
                    ?></td>
                    <td align="center">
                        <img src="../img/check.gif" border="0" width="22" height="22" title="Sila klik untuk membuat pengesahan permohonan" 
                        style="cursor:pointer" onclick="do_terima('<?=$url."&act=SAH&ids=".$idh;?>')" />
                    </td>
                </tr>
                <?php $rs_det->movenext(); } ?>
            </table>
        </td></tr>
    </table>
    <div style="float:right"><input type="button" class="btn btn-secondary" value="Tutup" style="cursor:pointer" onclick="do_refresh();" />
    </div>

</form>

<script>

$('.dropdown').dropdown();

$('.panel-heading h4 a input[type=checkbox]').on('click', function(e) {
    e.stopPropagation();
    $(this).parent().trigger('click');   // <---  HERE
});

$('#dropdownOne').on('show.bs.dropdown', function(e) {
    if(!$('.panel-heading h4 a input[type=checkbox]').is(':checked'))
    {
        return false;
    }
});
</script>