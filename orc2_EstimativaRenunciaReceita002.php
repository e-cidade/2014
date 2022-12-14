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

//echo "aqui"; exit();

if (!isset($arqinclude)){
  
  include("fpdf151/pdf.php");
  include("fpdf151/assinatura.php");
  include("libs/db_sql.php");
  include("libs/db_utils.php");
  include("libs/db_libcontabilidade.php");
  include("libs/db_liborcamento.php");
  include("classes/db_orcparamrel_classe.php");
  include("dbforms/db_funcoes.php");
  include("classes/db_orcparamrelopcre_classe.php");
  
  $classinatura = new cl_assinatura;
  $orcparamrel  = new cl_orcparamrel;
  
  parse_str($HTTP_SERVER_VARS['QUERY_STRING']);
  db_postmemory($HTTP_SERVER_VARS);
  
}

include_once("classes/db_conrelinfo_classe.php");
include_once("classes/db_conrelvalor_classe.php");
include_once("classes/db_orcparamrelopcre_classe.php");
include_once("classes/db_orcparamelemento_classe.php");
include_once("libs/db_utils.php");

//$clconrelinfo      = new cl_conrelinfo;
//$clconrelvalor     = new cl_conrelvalor;
//$oOrcParamRelopcre = new cl_orcparamrelopcre;
//$clorcparamelemento = new cl_orcparamelemento();
//$xinstit = split("-",$db_selinstit);
//$resultinst = pg_exec("select codigo,munic,nomeinst,nomeinstabrev from db_config where codigo in (".str_replace('-',', ',$db_selinstit).") ");
//$descr_inst = '';
//$xvirg = '';
//$flag_abrev = false;
//$nTotalRcl = 0;
////******************************************************************
//for($xins = 0; $xins < pg_numrows($resultinst); $xins++){
//  db_fieldsmemory($resultinst,$xins);
//  if (strlen(trim($nomeinstabrev)) > 0){
//       $descr_inst .= $xvirg.$nomeinstabrev;
//       $flag_abrev  = true;
//  }else{
//       $descr_inst .= $xvirg.$nomeinst;
//  }
//
//  $xvirg = ', ';
//}
//
//if ($flag_abrev == false){
//     if (strlen($descr_inst) > 42){
//          $descr_inst = substr($descr_inst,0,100);
//     }
//}

//$anousu     = db_getsession("DB_anousu");
//$anousu_ant = $anousu - 1;

$head2 = "<ENTE DA FEDERA??O>";
$head3 = "LEI DE DIRETIZES OR?AMENT?RIAS";
$head4 = "ANEXO DE METAS FISCAIS";
$head5 = "ESTIMATIVA E COMPENSA??O DA REN?NCIA DE RECEITA";
$head6 = "<ANO DE REFER?NCIA>";
//$period = '';
//if ($periodo=="1Q"){
//  $period = "JANEIRO A ABRIL DE {$anousu}";
//}elseif($periodo=="2Q"){  
//  $period = "JANEIRO A AGOSTO DE {$anousu}";
//}elseif($periodo=="3Q"){  
//  $period = "JANEIRO A DEZEMBRO DE {$anousu}";
//}elseif($periodo=="1S"){
//  $period = "JANEIRO A JUNHO DE {$anousu}";
//}elseif($periodo=="2S"){
//  $period = "JANEIRO A DEZEMBRO DE {$anousu}";
//}
//$head6 = "$period";

/**
 * Linhas do relatorio
 */
// fechado ate a linha 360
	$aLinhasRelatorio              = array();
	$aLinhasRelatorio[0]["label"]  = "Aumento Permanente da Receita";    
	$aLinhasRelatorio[1]["label"]  = "(-) Transfer?ncias Constitucionais";    
	$aLinhasRelatorio[2]["label"]  = "(-) Transfer?ncias FUNDEB";    
	$aLinhasRelatorio[3]["label"]  = "Redu??o Permanente de Despesa (II)";    
	$aLinhasRelatorio[4]["label"]  = "  Novas DOCC";    
	$aLinhasRelatorio[5]["label"]  = "  Novas DOCC geradas por PPP";    
	
	for ($i = 0; $i < count($aLinhasRelatorio); $i++) {
  
	  $aLinhasRelatorio[$i]["ano2"] = 0;
  
	}
	
	
  $pdf = new PDF("P", "mm", "A4"); 
  $pdf->Open(); 
  $pdf->AliasNbPages(); 
  $pdf->setfillcolor(235);
  $pdf->setfont('arial','b',7);
  $alt            = 4;
  $pagina         = 1;
  $pdf->addpage();
  $pdf->setfont('arial','',7);
  $pdf->cell(165,$alt,'AMF - Tabela 8(LRF, art.4?,'.chr(167).'2? inciso V)','B',0,"L",0);
  $pdf->cell(25,$alt,'R$ 1,00','B',1,"R",0);
  //$pdf->cell(100,$alt,"",'RT',0,"C",0);
  //$pdf->cell(90,$alt,"VALOR",'LTB',1,"C",0);
  $pdf->cell(30,$alt,"",0,0,"C",0);
  $pdf->cell(30,$alt,"",'L',0,"C",0);
  $pdf->cell(30,$alt,"SETORES/",'L',0,"C",0);
  $pdf->cell(60,$alt,"",'L',0,"C",0);
  $pdf->cell(40,$alt,"",'L',1,"C",0);
  
  $pdf->cell(30,$alt,"TRIBUTO",0,0,"C",0);
  $pdf->cell(30,$alt,"MODALIDADE",'L',0,"C",0);
  $pdf->cell(30,$alt,"PROGRAMAS/",'L',0,"C",0);
  $pdf->cell(60,$alt,"REN?NCIA DE RECEITA PREVISTA",'LB',0,"C",0);
  $pdf->cell(40,$alt,"COMPENSA??O",'L',1,"C",0);
  
  $pdf->cell(30,$alt,"",'B',0,"C",0);
  $pdf->cell(30,$alt,"",'BL',0,"C",0);
  $pdf->cell(30,$alt,"BENEFICI?RIO",'LB',0,"C",0);
  $pdf->cell(20,$alt,"<Ano ref.>",'LB',0,"C",0);
  $pdf->cell(20,$alt,"<Ano+1>",'LB',0,"C",0);
  $pdf->cell(20,$alt,"<Ano+2>",'LB',0,"C",0);
  $pdf->cell(40,$alt,"",'LB',1,"C",0);
  
  //Corpo do Relatorio
  $pdf->cell(30,$alt,"---",0,0,"C",0);
  $pdf->cell(30,$alt,"---",'L',0,"C",0);
  $pdf->cell(30,$alt,"---",'L',0,"C",0);
  $pdf->cell(20,$alt,"---",'L',0,"C",0);
  $pdf->cell(20,$alt,"----",'L',0,"C",0);
  $pdf->cell(20,$alt,"---",'L',0,"C",0);
  $pdf->cell(40,$alt,"---",'L',1,"C",0);
   
  //Fim do Relatorio
  //$pdf->cell(30,$alt,"---",0,0,"C",0);
  //$pdf->cell(30,$alt,"---",'L',0,"C",0);
  $pdf->cell(90,$alt,"TOTAL",'TB',0,"L",0);
  $pdf->cell(20,$alt,"---",'TLB',0,"C",0);
  $pdf->cell(20,$alt,"----",'TLB',0,"C",0);
  $pdf->cell(20,$alt,"---",'TLB',0,"C",0);
  $pdf->cell(40,$alt,"---",'TLB',1,"C",0);
  
  $pdf->ln();
// ----------------------------------------------------------------
//notasExplicativas(&$pdf, 63, $periodo,190); 
//  $pdf->Ln(5);
//  
//  // assinaturas
//  $pdf->setfont('arial','',5);
//  $pdf->ln(20);
//  
//  assinaturas(&$pdf,&$classinatura,'GF');
  
  $pdf->Output();

?>