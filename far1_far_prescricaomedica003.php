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
include("classes/db_far_prescricaomedica_classe.php");
include("dbforms/db_funcoes.php");
parse_str($HTTP_SERVER_VARS["QUERY_STRING"]);
db_postmemory($HTTP_POST_VARS);
$clfar_prescricaomedica = new cl_far_prescricaomedica;
$db_botao = false;
$db_opcao = 33;
if(isset($excluir)){
  db_inicio_transacao();
  $db_opcao = 3;
  $clfar_prescricaomedica->excluir($fa20_i_codigo);
  db_fim_transacao();
}else if(isset($chavepesquisa)){
   $db_opcao = 3;
   $result = $clfar_prescricaomedica->sql_record($clfar_prescricaomedica->sql_query($chavepesquisa)); 
   db_fieldsmemory($result,0);
   $db_botao = true;
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
<center>
<table border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td align="left" valign="top" bgcolor="#CCCCCC"> 
    <fieldset style="width:100%"><legend><b>Exclus�o de Prescri��o M�dica</b></legend>
	<? include("forms/db_frmfar_prescricaomedica.php");?>
	</fieldset>
	</td>
  </tr>
</table>
</center>
</body>
</html>
<?
if(isset($excluir)){
  if($clfar_prescricaomedica->erro_status=="0"){
    $clfar_prescricaomedica->erro(true,false);
  }else{
    $clfar_prescricaomedica->erro(true,true);
  }
}
if($db_opcao==33){
  echo "<script>document.form1.pesquisar.click();</script>";
}
?>
<script>
js_tabulacaoforms("form1","excluir",true,1,"excluir",true);
</script>