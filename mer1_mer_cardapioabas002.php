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

require("libs/db_stdlibwebseller.php");
require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("dbforms/db_funcoes.php");
include("dbforms/db_classesgenericas.php");
$clcriaabas = new cl_criaabas;
$db_opcao   = 1;
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#CCCCCC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<table width="100%" height="18"  border="0" cellpadding="0" cellspacing="0" bgcolor="#5786B2">
 <tr>
  <td>&nbsp;</td>
 </tr>
</table>
<form name="formaba">
<table valign="top" marginwidth="0" width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td height="100%" align="left" valign="top" bgcolor="#CCCCCC">
   <?
   $clcriaabas->identifica = array("a1"=>"Refei??o",
                                   "a2"=>"Itens da Refei??o",
                                   "a3"=>"Modo de Preparo",
                                   "a4"=>"Caracter?stica do Preparo",
                                   "a5"=>"Alunos com Resti??es Alimentares",
                                   "a6"=>"Escolas Atendidas",  
                                   "a7"=>"Nutricionista"
                                   );
   $clcriaabas->sizecampo  = array("a1"=>"15",
                                   "a2"=>"25",
                                   "a3"=>"15",
                                   "a4"=>"25",
                                   "a5"=>"35",
                                   "a6"=>"25",
                                   "a7"=>"25"
                                   );
   $clcriaabas->src        = array("a1"=>"mer1_mer_cardapio002.php",
                                   "a2"=>"",
                                   "a3"=>"",
                                   "a4"=>"",
                                   "a5"=>"",
                                   "a6"=>"",
                                   "a7"=>""
                                   );
   $clcriaabas->disabled   = array("a2"=>"true",
                                   "a3"=>"true",
                                   "a4"=>"true",
                                   "a5"=>"true",
                                   "a6"=>"true",
                                   "a7"=>"true"
                                   );
   $clcriaabas->cordisabled   = "#9b9b9b";
   $clcriaabas->scrolling     = "no";
   $clcriaabas->iframe_height = "600";
   $clcriaabas->iframe_width  = "100%";
   $clcriaabas->cria_abas();
   ?>
  </td>
 </tr>
</table>
</form>
<?db_menu(db_getsession("DB_id_usuario"),
          db_getsession("DB_modulo"),
          db_getsession("DB_anousu"),
          db_getsession("DB_instit")
         );
?>
</body>
</html>