<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2009  DBselller Servicos de Informatica             
 *                            www.dbseller.com.br                     
 *                         e-cidade@dbseller.com.br                   
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt.txt 
 */

require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("classes/db_escoladiretor_classe.php");
include("dbforms/db_funcoes.php");
include("libs/db_jsplibwebseller.php");
$ed254_d_datacad_dia = date("d");
$ed254_d_datacad_mes = date("m");
$ed254_d_datacad_ano = date("Y");
$ed254_d_datacad = $ed254_d_datacad_dia."/".$ed254_d_datacad_mes."/".$ed254_d_datacad_ano;
$ed254_i_usuario = db_getsession("DB_id_usuario");
db_postmemory($HTTP_POST_VARS);
$clescoladiretor = new cl_escoladiretor;
$db_opcao = 1;
$db_botao = true;
if(isset($incluir)){
 $result = $clescoladiretor->sql_record($clescoladiretor->sql_query("","ed254_i_codigo as jatem",""," ed254_i_escola = $ed254_i_escola AND ed254_i_turno = $ed254_i_turno AND ed254_c_tipo = 'A'"));
 if($clescoladiretor->numrows>0){
  if($ed254_c_tipo=="A"){
   $clescoladiretor->erro_status = "0";
   $clescoladiretor->erro_msg = "ATEN??O! J? existe um diretor com exerc?cio ABERTO para o turno ".trim($ed15_c_nome)."!";
  }else{
   db_inicio_transacao();
   $clescoladiretor->incluir($ed254_i_codigo);
   db_fim_transacao();
  }
 }else{
  db_inicio_transacao();
  $clescoladiretor->incluir($ed254_i_codigo);
  db_fim_transacao();
 }
}
if(isset($alterar)){
 $db_opcao = 2;
 $result = $clescoladiretor->sql_record($clescoladiretor->sql_query("","ed254_i_codigo as jatem",""," ed254_i_escola = $ed254_i_escola AND ed254_i_turno = $ed254_i_turno AND ed254_c_tipo = 'A'"));
 if($clescoladiretor->numrows>0){
  if($ed254_c_tipo=="A"){
   db_fieldsmemory($result,0);
   if($ed254_i_codigo!=$jatem){
    $clescoladiretor->erro_status = "0";
    $clescoladiretor->erro_msg = "ATEN??O! J? existe um diretor com exerc?cio ABERTO para o turno ".trim($ed15_c_nome)."!";
   }else{
    db_inicio_transacao();
    $clescoladiretor->alterar($ed254_i_codigo);
    db_fim_transacao();
   }
  }else{
   db_inicio_transacao();
   $clescoladiretor->alterar($ed254_i_codigo);
   db_fim_transacao();
  }
 }else{
  db_inicio_transacao();
  $clescoladiretor->alterar($ed254_i_codigo);
  db_fim_transacao();
 }
}
if(isset($excluir)){
 $db_opcao = 3;
 db_inicio_transacao();
 $clescoladiretor->excluir($ed254_i_codigo);
 db_fim_transacao();
}
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td height="430" align="left" valign="top" bgcolor="#CCCCCC">
   <br>
   <center>
   <fieldset style="width:95%"><legend><b>Diretores da Escola</b></legend>
    <?include("forms/db_frmescoladiretor.php");?>
   </fieldset>
   </center>
  </td>
 </tr>
</table>
</body>
</html>
<script>
js_tabulacaoforms("form1","ed254_i_rechumano",true,1,"ed254_i_rechumano",true);
</script>
<?
if(isset($incluir)){
 if($clescoladiretor->erro_status=="0"){
  $clescoladiretor->erro(true,false);
  $db_botao=true;
  echo "<script> document.form1.db_opcao.disabled=false;</script>  ";
  if($clescoladiretor->erro_campo!=""){
   echo "<script> document.form1.".$clescoladiretor->erro_campo.".style.backgroundColor='#99A9AE';</script>";
   echo "<script> document.form1.".$clescoladiretor->erro_campo.".focus();</script>";
  }
 }else{
  $clescoladiretor->erro(true,false);
  db_redireciona("edu1_escoladiretor001.php?ed254_i_escola=$ed254_i_escola&ed18_c_nome=$ed18_c_nome");
 }
}
if(isset($alterar)){
 if($clescoladiretor->erro_status=="0"){
  $clescoladiretor->erro(true,false);
  $db_botao=true;
  echo "<script> document.form1.db_opcao.disabled=false;</script>  ";
  if($clescoladiretor->erro_campo!=""){
   echo "<script> document.form1.".$clescoladiretor->erro_campo.".style.backgroundColor='#99A9AE';</script>";
   echo "<script> document.form1.".$clescoladiretor->erro_campo.".focus();</script>";
  }
 }else{
  $clescoladiretor->erro(true,false);
  db_redireciona("edu1_escoladiretor001.php?ed254_i_escola=$ed254_i_escola&ed18_c_nome=$ed18_c_nome");
 }
}
if(isset($excluir)){
 if($clescoladiretor->erro_status=="0"){
  $clescoladiretor->erro(true,false);
 }else{
  $clescoladiretor->erro(true,false);
  db_redireciona("edu1_escoladiretor001.php?ed254_i_escola=$ed254_i_escola&ed18_c_nome=$ed18_c_nome");
 }
}
if(isset($cancelar)){
 db_redireciona("edu1_escoladiretor001.php?ed254_i_escola=$ed254_i_escola&ed18_c_nome=$ed18_c_nome");
}
?>