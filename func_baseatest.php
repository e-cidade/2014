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

//MODULO: educa??o
include("libs/db_stdlibwebseller.php");
require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("dbforms/db_funcoes.php");
include("classes/db_base_classe.php");
include("classes/db_escolabase_classe.php");
db_postmemory($HTTP_POST_VARS);
parse_str($HTTP_SERVER_VARS["QUERY_STRING"]);
$clbase = new cl_base;
$clescolabase = new cl_escolabase;
$clbase->rotulo->label("ed31_i_codigo");
$clbase->rotulo->label("ed31_c_descr");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilos.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
</head>
<body bgcolor="#CCCCCC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table height="100%" border="0"  align="center" cellspacing="0" bgcolor="#CCCCCC">
 <tr>
  <td height="63" align="center" valign="top">
   <table width="55%" border="0" align="center" cellspacing="0">
    <form name="form2" method="post" action="" >
    <tr>
     <td width="4%" align="right" nowrap title="<?=$Ted31_i_codigo?>">
      <?=$Led31_i_codigo?>
     </td>
     <td width="96%" align="left" nowrap>
      <?db_input("ed31_i_codigo",10,$Ied31_i_codigo,true,"text",4,"","chave_ed31_i_codigo");?>
     </td>
    </tr>
    <tr>
     <td width="4%" align="right" nowrap title="<?=$Ted31_c_descr?>">
      <?=$Led31_c_descr?>
     </td>
     <td width="96%" align="left" nowrap>
      <?db_input("ed31_c_descr",40,$Ied31_c_descr,true,"text",4,"","chave_ed31_c_descr");?>
     </td>
    </tr>
    <tr>
     <td colspan="2" align="center">
      <input name="pesquisar" type="submit" id="pesquisar2" value="Pesquisar">
      <input name="limpar" type="reset" id="limpar" value="Limpar" >
      <input name="Fechar" type="button" id="fechar" value="Fechar" onClick="parent.db_iframe_base.hide();">
     </td>
    </tr>
    </form>
   </table>
  </td>
 </tr>
 <tr>
  <td align="center" valign="top">
   <?
   $escola = db_getsession("DB_coddepto");
   $sql = "SELECT ARRAY(SELECT ed234_i_serieequiv FROM serieequiv WHERE ed234_i_serie = $serie) as seriesequivalentes";
   $result = pg_query($sql);
   db_fieldsmemory($result,0);
   $seriesequivalentes = str_replace("{","(",$seriesequivalentes);
	 $seriesequivalentes = str_replace("}",")",$seriesequivalentes);

   if ( $seriesequivalentes == "" || $seriesequivalentes == '()' ) {
    $seriesequivalentes= "(0)";
	 }

   if(!isset($pesquisa_chave)){
    $campos = "base.ed31_i_codigo,
               base.ed31_c_descr,
               base.ed31_c_turno,
               cursoedu.ed29_c_descr as dl_curso,
               regimemat.ed218_c_nome,
               base.ed31_c_medfreq,
               cursoedu.ed29_i_codigo
              ";
    if(isset($chave_ed31_i_codigo) && (trim($chave_ed31_i_codigo)!="") ){
     $sql = $clbase->sql_query_hist(""," distinct ".$campos,"ed31_c_descr"," (ed34_i_serie in $seriesequivalentes or ed34_i_serie= $serie) AND  ed31_i_codigo = $chave_ed31_i_codigo AND ed71_c_situacao = 'S' AND ed77_i_escola = $escola");
    }else if(isset($chave_ed31_c_descr) && (trim($chave_ed31_c_descr)!="") ){
     $sql = $clbase->sql_query_hist(""," distinct ".$campos,"ed31_c_descr"," (ed34_i_serie in $seriesequivalentes or ed34_i_serie= $serie) AND  ed31_c_descr like '$chave_ed31_c_descr%' AND ed71_c_situacao = 'S' AND ed77_i_escola = $escola");
    }else{
     $sql = $clbase->sql_query_hist(""," distinct ".$campos,"ed31_c_descr"," (ed34_i_serie in $seriesequivalentes or ed34_i_serie= $serie)  AND ed71_c_situacao = 'S' AND ed77_i_escola = $escola");
    }
    db_lovrot($sql,15,"()","",$funcao_js);
   }else{
    if($pesquisa_chave!=null && $pesquisa_chave!=""){
     $result = $clbase->sql_record($clbase->sql_query_hist("","*",""," (ed34_i_serie in $seriesequivalentes or ed34_i_serie= $serie) AND  ed31_i_codigo = $pesquisa_chave AND ed71_c_situacao = 'S' AND ed77_i_escola = $escola"));
     if($clbase->numrows!=0){
      db_fieldsmemory($result,0);
      echo "<script>".$funcao_js."('$ed31_c_descr',$ed29_i_codigo,'$ed29_c_descr',false);</script>";
     }else{
      echo "<script>".$funcao_js."('Chave(".$pesquisa_chave.") n?o Encontrado','','',true);</script>";
     }
    }else{
     echo "<script>".$funcao_js."('',false);</script>";
    }
   }
   ?>
  </td>
 </tr>
</table>
</body>
</html>