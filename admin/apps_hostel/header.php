<? 
date_default_timezone_set('Asia/Kuala_Lumpur');
@session_start();
//require_once 'include/dbconnect.php';
$s_userid = $_SESSION["s_userid"];
$s_username = $_SESSION["s_username"];
if(empty($_SESSION["s_userid"])){
	include '../lout.php';
	exit();
} 

require_once '../common.php';

$data = base64_decode($_GET['data']);
$get_data = explode(";", $data);
$pro = $get_data[0]; // piece1
$page = $get_data[1]; // piece1
$get_page = $get_data[1]; // piece1
$menu = $get_data[2]; // piece2
$submenu = $get_data[3]; // piece2
$id = $get_data[4]; // piece2
$sub_tab = $get_data[5]; // piece2
if($_SESSION["s_userid"]=='1'){
	//echo "<font color=#000000>PROSES:".$pro.";PG:".$page.";MENU:".$menu.";SUBMENU:".$submenu.";ID:".$id.";SUBTAB:".$sub_tab."</font>";
}


//$conn->debug=true;
$sql = "SELECT A.*, Z.kampus_id, Z.f_level FROM _tbl_user Z, _tbl_menu_user A, _tbl_menu B 
WHERE Z.id_user=A.id_kakitangan AND A.menu_id=B.menu_id AND B.sub_menu=".tosql($submenu)." 
	AND A.id_kakitangan=".tosql($_SESSION["s_userid"]);
$rsmenus = &$conn->execute($sql);

//$_SESSION['SESS_KAMPUS']=$rsmenus->fields['kampus_id'];
//$_SESSION["s_level"]=$rsmenus->fields['f_level'];
$_SESSION['SESS_ADD']=$rsmenus->fields['is_add'];
$_SESSION['SESS_UPD']=$rsmenus->fields['is_upd'];
$_SESSION['SESS_DEL']=$rsmenus->fields['is_del'];

if($_SESSION["s_level"]=='99'){ 
	$sql_filter=''; 
	$sql_kampus='';
} else { 
	$sql_filter = '';
	$sql_kampus=" AND kampus_id=".$rsmenus->fields['kampus_id']; 
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<title>Sistem Maklumat Latihan Bersepadu ILIM</title>
<link href="../css/domistik.css" rel="stylesheet" type="text/css" media="screen">
<link href="../css/template-css.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" href="../modalwindow/modal.css" type="text/css" />
<link rel="stylesheet" href="../modalwindow/dhtmlwindow.css" type="text/css" />
<script type="text/javascript" src="../modalwindow/dhtmlwindow.js">
/***********************************************
* DHTML Window Widget- � Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>
<script type="text/javascript" src="../modalwindow/modal.js"></script>
<script language="javascript" type="text/javascript">	
function open_modal(URL,title,width,height){
	emailwindow=dhtmlmodal.open('EmailBox', 'iframe', URL, title, 'width='+width+'px,height='+height+'px,center=1,resize=1,scrolling=0')
} //End "opennewsletter" function
</script>
</head>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
  <tbody>
  	<tr>
    	<td width="5" height="5"><img src="../img/b1.gif" width="5" height="5"></td>
    	<td background="../img/b_top.gif"></td>
    	<td width="5"><img src="../img/b2.gif" width="5" height="5"></td>
  	</tr>
    <tr>
        <td background="../img/b_left.gif">&nbsp;</td>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
              <tr>
                <td height="112" width="25%">
                    <img src="../images/banner/oren_lf.jpg" alt="left"/>
                </td>
                <td height="112" width="50%" align="center">
                    <img src="../images/banner/text_itis.png" alt="logo" style="float:none" />
                </td>
                <td height="112" width="25%" align="right">
                    <img src="../images/banner/oren_rt.jpg" />
                </td>
              </tr>
            </table>
        </td>
        <td background="../img/b_right.gif">&nbsp;</td>
    </tr>