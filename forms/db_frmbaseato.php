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

//MODULO: escola
include("dbforms/db_classesgenericas.php");
$cliframe_alterar_excluir = new cl_iframe_alterar_excluir;
$clbaseato->rotulo->label();
$clrotulo = new rotulocampo;
$clrotulo->label("ed77_i_escola");
$clrotulo->label("ed77_i_base");
$db_botao1 = false;
if(isset($opcao) && $opcao=="alterar"){
 $db_opcao = 2;
 $db_botao1 = true;
}elseif(isset($opcao) && $opcao=="excluir" || isset($db_opcao) && $db_opcao==3){
 $db_botao1 = true;
 $db_opcao = 3;
}else{
 if(isset($alterar)){
  $db_opcao = 2;
  $db_botao1 = true;
 }else{
  $db_opcao = 1;
 }
}
?>
<form name="form1" method="post" action="">
<center>
<?db_input('codbaseescola',15,@$Icodbaseescola,true,'hidden',3,"")?>
<?db_input('ed278_i_codigo',15,@$Ied278_i_codigo,true,'hidden',3,"")?>
<table border="0" width="60%">
 <tr>
  <td nowrap title="<?=@$Ted77_i_escola?>">
   <?db_ancora(@$Led77_i_escola,"",3);?>
  </td>
  <td>
   <?db_input('ed77_i_escola',15,@$Ied77_i_escola,true,'text',3,"")?>
   <?db_input('ed18_c_nome',40,@$Ied18_c_nome,true,'text',3,'')?>
  </td>
 </tr>
 <tr>
  <td nowrap title="<?=@$Ted77_i_base?>">
   <?db_ancora(@$Led77_i_base,"",3);?>
  </td>
  <td>
   <?db_input('ed77_i_base',15,@$Ied77_i_base,true,'text',3,"")?>
   <?db_input('ed31_c_descr',40,@$Ied31_c_descr,true,'text',3,'')?>
  </td>
 </tr>
 <tr>
  <td nowrap title="<?=@$Ted278_i_atolegal?>">
   <?db_ancora(@$Led278_i_atolegal,"js_pesquisaed278_i_atolegal();",$db_opcao=="1"?1:3);?>
  </td>
  <td>
   <?db_input('ed278_i_atolegal',15,$Ied278_i_atolegal,true,'text',3,'')?>
   <?db_input('ed05_c_finalidade',40,@$Ied05_c_finalidade,true,'text',3,'')?>
  </td>
 </tr>
   <tbody id="etapas">
 </tbody>
  </table>
  </center>
<input name="<?=($db_opcao==1?"incluir":($db_opcao==2||$db_opcao==22?"alterar":"excluir"))?>" type="submit" id="db_opcao" value="<?=($db_opcao==1?"Incluir":($db_opcao==2||$db_opcao==22?"Alterar":"Excluir"))?>" <?=($db_botao==false?"disabled":"")?> <?=$db_opcao==1||$db_opcao==2?"onclick='return js_valida();'":""?> >
<input name="cancelar" type="submit" value="Cancelar" <?=($db_botao1==false?"disabled":"")?> >
<table width="100%">
 <tr>
  <td valign="top">
  <?
  if($clescolabase->numrows>0){
   db_fieldsmemory($result_ver,0);
  }
   $campos_sql = "ed278_i_codigo,
                  ed278_i_atolegal,
                  ed05_c_numero,
                  ed05_c_finalidade,
                  (select array(select trim(ed11_c_descr)
                                from baseatoserie
                                 inner join serie on ed11_i_codigo = ed279_i_serie
                                where ed279_i_baseato = ed278_i_codigo
                               )
                  ) as ed279_i_serie                
                 ";
   $chavepri= array("ed278_i_codigo"=>@$ed278_i_codigo,"ed278_i_atolegal"=>@$ed278_i_atolegal,"ed05_c_finalidade"=>@$ed05_c_finalidade);
   $cliframe_alterar_excluir->chavepri=$chavepri;
   $cliframe_alterar_excluir->sql = $clbaseato->sql_query("",$campos_sql,"ed279_i_serie"," ed278_i_escolabase = $codbaseescola");
   $cliframe_alterar_excluir->campos  ="ed278_i_codigo,ed05_c_numero,ed05_c_finalidade,ed279_i_serie";
   $cliframe_alterar_excluir->legenda="Registros";
   $cliframe_alterar_excluir->msg_vazio ="N?o foi encontrado nenhum registro.";
   $cliframe_alterar_excluir->textocabec ="#DEB887";
   $cliframe_alterar_excluir->textocorpo ="#444444";
   $cliframe_alterar_excluir->fundocabec ="#444444";
   $cliframe_alterar_excluir->fundocorpo ="#eaeaea";
   $cliframe_alterar_excluir->iframe_height ="100";
   $cliframe_alterar_excluir->iframe_width ="100%";
   $cliframe_alterar_excluir->tamfontecabec = 9;
   $cliframe_alterar_excluir->tamfontecorpo = 9;
   $cliframe_alterar_excluir->formulario = false;
   $cliframe_alterar_excluir->iframe_alterar_excluir($db_opcao);
  ?>
  </td>
 </tr>
</table>
</form>
<script>
<?$codbaseescola=$codbaseescola;?>
function js_pesquisaed278_i_atolegal(){
 js_OpenJanelaIframe('','db_iframe_atolegal','func_baseato.php?codcursobase=<?=$codcursobase?>&codbaseescola=<?=$codbaseescola?>&funcao_js=parent.js_mostraatolegal1|ed05_i_codigo|ed05_c_finalidade','Pesquisa de Atos Legais',true);
}
function js_mostraatolegal1(chave1,chave2){
 document.form1.ed278_i_atolegal.value = chave1;
 document.form1.ed05_c_finalidade.value = chave2;
 db_iframe_atolegal.hide();
 js_divCarregando("Aguarde, carregando registros","msgBox");
 var url     = 'edu1_baseatoRPC.php';
 var sAction = 'PesquisaSerie';
 var oAjax = new Ajax.Request(url,{method    : 'post',
                                    parameters: 'codbaseescola=<?=$codbaseescola?>&base='+$('ed77_i_base').value+'&sAction='+sAction,
                                    onComplete: js_retornaPesquisaSerie
                                   });
}
function js_retornaPesquisaSerie(oAjax){
 js_removeObj("msgBox");
 var oRetorno = eval("("+oAjax.responseText+")");
 sHtml = '<tr><td colspan="2">';
 sHtml += '<fieldset width="95%"><legend><b> Etapas do Base Curricular '+$('ed31_c_descr').value+'</b></legend>';
 sHtml += '<table align="center" width="80%" border="0"><tr><td valign="top" width="50%">';
 if(oRetorno.length>0){
  quebra = parseInt(oRetorno.length)/2;
  quebra = (Math.ceil(quebra))-1;
  for (var i = 0;i < oRetorno.length; i++) {
   with (oRetorno[i]) {
    if(temoutro.urlDecode()=="S"){
     desab = "disabled";
     check = "checked";
    }else{
     desab = "";
     check = "checked";
    }
    sHtml += '<input type="checkbox" id="ed279_i_serie" name="ed279_i_serie[]" value="'+ed11_i_codigo.urlDecode()+'" '+desab+' '+check+'> '+ed11_c_descr.urlDecode()+' '+descr_temoutro.urlDecode()+'<br>';
    if(i==quebra){
     sHtml += '</td><td valign="top" width="50%">';
    }
   }
  }
  $('db_opcao').disabled = false;
 }else{
  sHtml += 'Base sem etapas cadastradas.';
  $('db_opcao').disabled = true;
 }
 sHtml += '</td></tr></table>';
 sHtml += '</fieldset>';
 sHtml += '</td></tr>';
 $('etapas').innerHTML = sHtml;
}
function js_valida(){
 tam = document.form1.ed279_i_serie.length;
 if(tam==undefined){
  if(document.form1.ed279_i_serie.checked==false){
   alert("Informe alguma etapa para prosseguir!");
   return false;
  }
  if(document.form1.ed279_i_serie.disabled==true){
   alert("N?o existem mais etapas dispon?veis!!");
   return false;
  }
 }else{
  marcados = 0;
  desabilitados = 0;
  for(i=0;i<tam;i++){
   if(document.form1.ed279_i_serie[i].checked==true && document.form1.ed279_i_serie[i].disabled==false){
    marcados++;
   }
   if(document.form1.ed279_i_serie[i].disabled==false){
    desabilitados++;
   }
  }
  if(desabilitados==0){
   alert("N?o existem mais etapas dispon?veis!!");
   return false;
  }
  if(marcados==0){
   alert("Informe alguma etapa para prosseguir!");
   return false;
  }
 }
}
function js_PesquisaSerieIncluida(){
 js_divCarregando("Aguarde, carregando registros","msgBox");
 var url     = 'edu1_baseatoRPC.php';
 var sAction = 'PesquisaSerieIncluida';
 var oAjax = new Ajax.Request(url,{method    : 'post',
                                    parameters: 'codbaseescola=<?=$codbaseescola?>&base='+$('ed77_i_base').value+'&baseato='+$('ed278_i_codigo').value+'&sAction='+sAction,
                                    onComplete: js_retornaPesquisaSerieIncluida
                                   });
}
function js_retornaPesquisaSerieIncluida(oAjax){
 js_removeObj("msgBox");
 var oRetorno = eval("("+oAjax.responseText+")");
 sHtml = '<tr><td colspan="2">';
 sHtml += '<fieldset width="95%"><legend><b> Etapas da Base Curricular '+$('ed31_c_descr').value+'</b></legend>';
 sHtml += '<table align="center" width="80%" border="0"><tr><td valign="top" width="50%">';
 quebra = parseInt(oRetorno.length)/2;
 quebra = (Math.ceil(quebra))-1;
 for (var i = 0;i < oRetorno.length; i++) {
  with (oRetorno[i]) {
   if(temregistro.urlDecode()=="S"){
    check = "checked";
    desab = "";
   }else if(temoutro.urlDecode()=="S"){
    check = "checked";
    desab = "disabled";
    if(document.form1.db_opcao.value=="Excluir"){
     check = "";
    }
   }else{
    check = "";
    desab = "";
   }
   if(document.form1.db_opcao.value=="Excluir"){
    desab = "disabled";
    descr_outro = "";
   }else{
    descr_outro = descr_temoutro.urlDecode();
   }
   sHtml += '<input type="checkbox" id="ed279_i_serie" name="ed279_i_serie[]" value="'+ed11_i_codigo.urlDecode()+'" '+check+' '+desab+'> '+ed11_c_descr.urlDecode()+' '+descr_outro+'<br>';
   if(i==quebra){
    sHtml += '</td><td valign="top" width="50%">';
   }
  }
 }
 sHtml += '</td></tr></table>';
 sHtml += '</fieldset>';
 sHtml += '</td></tr>';
 $('etapas').innerHTML = sHtml;
 $('db_opcao').disabled = false;
}

<?if(isset($opcao) && ($opcao=="alterar" || $opcao=="excluir")){?>
 js_PesquisaSerieIncluida();
<?}?>
</script>