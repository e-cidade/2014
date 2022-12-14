<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2012  DBselller Servicos de Informatica             
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
include("classes/db_avalfreqres_classe.php");
include("dbforms/db_funcoes.php");
db_postmemory($HTTP_POST_VARS);
$clavalfreqres = new cl_avalfreqres;
$db_opcao = 1;
$db_botao = true;
if(isset($incluir)){
 db_inicio_transacao();
 $clavalfreqres->incluir($ed67_i_codigo);
 db_fim_transacao();
 $db_botao = false;
}
if(isset($excluir)){
 db_inicio_transacao();
 $db_opcao = 3;
 $clavalfreqres->excluir($ed67_i_codigo);
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
<body bgcolor="#CCCCCC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td height="430" align="left" valign="top" bgcolor="#CCCCCC">
   <br>
   <center>
   <fieldset style="width:95%"><legend><b>Per?odos para o c?lculo de percentual de frequ?ncia do Resultado <?=$ed42_c_descr?></b></legend>
    <?include("forms/db_frmavalfreqres.php");?>
   </fieldset>
   </center>
  </td>
 </tr>
</table>
</body>
</html>
<?
if(isset($incluir)){
 if($clavalfreqres->erro_status=="0"){
  $clavalfreqres->erro(true,false);
  $db_botao=true;
  echo "<script> document.form1.db_opcao.disabled=false;</script>  ";
  if($clavalfreqres->erro_campo!=""){
   echo "<script> document.form1.".$clavalfreqres->erro_campo.".style.backgroundColor='#99A9AE';</script>";
   echo "<script> document.form1.".$clavalfreqres->erro_campo.".focus();</script>";
  };
 }else{
  if(ElementosFreq($ed67_i_procresultado)==1){
   $sql = "UPDATE procresultado SET
            ed43_c_geraresultado = 'S'
           WHERE ed43_i_codigo = $ed67_i_procresultado
          ";
   $query = pg_query($sql);
  }
  ?>
   <script>
    parent.iframe_c1.location='edu1_procresultado002.php?chavepesquisa=<?=$ed67_i_procresultado?>&forma=<?=$forma?>';
   </script>
  <?
  $clavalfreqres->erro(true,true);
 };
};
if(isset($excluir)){
 if($clavalfreqres->erro_status=="0"){
  $clavalfreqres->erro(true,false);
 }else{
  if(ElementosFreq($ed67_i_procresultado)==0){
   $clavalfreqres->erro(true,false);
   $sql = "UPDATE procresultado SET
            ed43_c_geraresultado = 'N',
            ed43_c_reprovafreq = 'N'
           WHERE ed43_i_codigo = $ed67_i_procresultado
          ";
   $query = pg_query($sql);
   ?>
    <script>
     parent.iframe_c1.location='edu1_procresultado002.php?chavepesquisa=<?=$ed67_i_procresultado?>&forma=<?=$forma?>';
     parent.mo_camada('c1');
    </script>
   <?
  }else{
   $clavalfreqres->erro(true,true);
  }
 };
};
if(isset($cancelar)){
 echo "<script>location.href='".$clavalfreqres->pagina_retorno."'</script>";
}
function ElementosFreq($ed67_i_procresultado){
 $sql = "SELECT *
         FROM avalfreqres
         WHERE ed67_i_procresultado = $ed67_i_procresultado
         ";
 $query = pg_query($sql);
 $linhas = pg_num_rows($query);
 return $linhas;
}
?>