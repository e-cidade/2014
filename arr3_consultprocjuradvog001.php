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
include("dbforms/db_funcoes.php");
require("libs/db_utils.php");
include("classes/db_procjurjudicialadvog_classe.php");

$oGet = db_utils::postmemory($_GET);
$clprocjurjudicialadvog = new cl_procjurjudicialadvog();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table height="100%" border="0"  align="center" cellspacing="0" bgcolor="#CCCCCC">
  <tr> 
    <td align="center" valign="top"> 
      <?    
     
        $sCampos  = " distinct		 									  ";
        $sCampos .= " v57_numcgm,										  ";
        $sCampos .= " z01_nome,  										  ";
        $sCampos .= " v57_oab,		  									  ";
        $sCampos .= " case 		  										  ";
        $sCampos .= "   when v65_principal is true then 'Sim' else 'N?o'  ";
        $sCampos .= " end as v65_principal	 							  ";
        
        $sSqlProcesso = $clprocjurjudicialadvog->sql_query_susp(null,$sCampos,"v57_numcgm"," ar18_sequencial = {$oGet->suspensao}");
 		
        db_lovrot($sSqlProcesso,50,"()","","","");

      ?>
     </td>
   </tr>
</table>
</body>
</html>