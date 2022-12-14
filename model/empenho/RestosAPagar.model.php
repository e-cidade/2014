<?php
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

require_once("model/empenho/EmpenhoFinanceiro.model.php");
/**
 * Model restos a pagar
 * @author  Bruno Silva      <bruno.silva@dbseller.com.br>
 * @author  Jeferson Belmiro <jeferon.belmiro@dbseller.com.br>
 * @package empenho
 * @version $Revision: 1.6 $
 */
class RestosAPagar extends EmpenhoFinanceiro {

  /**
   * Retorna valor acumulado nao processado do ano
   * @param integer $iAno
   * @param integer $iInstituicao
   */
  public static function getValorNaoProcessadoAno($iAno, $iInstituicao) {

    $oDaoEmpresto  = db_utils::getDao("empresto");

    $WhereEmpresto  = "e91_anousu = {$iAno}";
    $WhereEmpresto .= " and e60_instit = {$iInstituicao}";

    $sCampos       = "coalesce(sum(e91_vlremp - e91_vlranu - e91_vlrliq), 0) as valor";
    $sSqlEmpresto  = $oDaoEmpresto->sql_query_empenho(null, null, $sCampos, null,$WhereEmpresto);
    $rsSqlEmpresto = $oDaoEmpresto->sql_record($sSqlEmpresto);

    if ($rsSqlEmpresto == false || $oDaoEmpresto->erro_status == "0") {
      throw new Exception('Erro t?cnico: erro ao buscar valor de restos a pagar.');
    }

    $nValor = db_utils::fieldsMemory($rsSqlEmpresto, 0)->valor;
    return (float) $nValor;
  }

}