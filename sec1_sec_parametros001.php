<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2013  DBselller Servicos de Informatica             
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
require("libs/db_stdlibwebseller.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("classes/db_sec_parametros_classe.php");
include("dbforms/db_funcoes.php");
require_once("libs/db_libdicionario.php");
db_postmemory($HTTP_POST_VARS);
$clsec_parametros = new cl_sec_parametros;
$escola           = db_getsession("DB_coddepto");
$db_opcao         = 1;
$db_botao         = true;
$result           = $clsec_parametros->sql_record($clsec_parametros->sql_query("","*","",""));
if ($clsec_parametros->numrows != 0) {

 db_fieldsmemory($result,0);
 $db_opcao = 2;

} else {
 $db_opcao= 1;
}

if (isset($incluir)) {
	
  db_inicio_transacao();
  $clsec_parametros->incluir($ed290_sequencial);
  db_fim_transacao();
  
}

if (isset($alterar)) {
	
  db_inicio_transacao();
  $db_opcao = 2;
  $clsec_parametros->alterar($ed290_sequencial);
  db_fim_transacao();
  
}
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/prototype.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/strings.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<br><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="100%" align="left" valign="top" bgcolor="#CCCCCC"> 
    <center>
    <fieldset style="width:95%"><legend><b>Par?metros</b></legend>
	<?
	include("forms/db_frmsec_parametros.php");
	?>
	</fieldset>
    </center>
	</td>
  </tr>
</table>
<?
  db_menu(db_getsession("DB_id_usuario"),db_getsession("DB_modulo"),
  db_getsession("DB_anousu"),db_getsession("DB_instit"));
?>
</body>
</html>
<script>
js_tabulacaoforms("form1","ed290_importcenso",true,1,"ed290_importcenso",true);
</script>
<?
if (isset($incluir)) {
	
  if ($clsec_parametros->erro_status == "0") {
  	
    $clsec_parametros->erro(true,false);
    $db_botao = true;
    echo "<script> document.form1.db_opcao.disabled=false;</script>  ";
    
    if ($clsec_parametros->erro_campo != "") {
    	
      echo "<script> document.form1.".$clsec_parametros->erro_campo.".style.backgroundColor='#99A9AE';</script>";
      echo "<script> document.form1.".$clsec_parametros->erro_campo.".focus();</script>";
      
    }
    
  } else {
    $clsec_parametros->erro(true,true);
  }
}

if (isset($alterar)) {
	
  if ($clsec_parametros->erro_status == "0") {
  	
    $clsec_parametros->erro(true,false);
    $db_botao=true;
    echo "<script> document.form1.db_opcao.disabled=false;</script>  ";
    
    if ($clsec_parametros->erro_campo != "") {
    	
      echo "<script> document.form1.".$clsec_parametros->erro_campo.".style.backgroundColor='#99A9AE';</script>";
      echo "<script> document.form1.".$clsec_parametros->erro_campo.".focus();</script>";
      
    };
    
  } else {
  	
    $clsec_parametros->erro(true,false);
    db_redireciona("sec1_sec_parametros001.php?lMensagem=true");
    
  }
}
?>