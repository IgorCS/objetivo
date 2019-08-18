<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE, $landscape=true){
	
	$CI =& get_instance();
	$logado = $CI->session->userdata('dados_usuario_logado');
	$CI->benchmark->mark('code_start');
	
    require_once("plugins/php/dompdf/dompdf_config.inc.php");
	
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
	
	if($landscape)
		$dompdf->set_paper('a4', 'landscape');
		
    $dompdf->render();
	
	$canvas = $dompdf->get_canvas();
	$font = Font_Metrics::get_font("helvetica", "italic");
	$y = $canvas->get_height() - 25;
	$x = $canvas->get_width() - 40;
	
	$CI->benchmark->mark('code_end');
	$rodape = "Gerado em: ".$CI->benchmark->elapsed_time('code_start', 'code_end')." segundos";
	
	#linha rodape
	$linha = str_repeat("_",(int)$x-418);
	$canvas->page_text(5, $y-10, $linha, $font, 7, array(0,0,0));
	
	#rodape tempo para gerar
	$canvas->page_text(10, $y, $rodape, $font, 7, array(0,0,0));
	
	#page num
	//$canvas->page_text($x, $y, "{PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));
	$canvas->page_text($x+10, $y, "{PAGE_COUNT}", $font, 8, array(0,0,0));
	
	#cabecalho
	$cabecalho = "Classecon ".$CI->config->item('versaoClassecon')." - ".date("d/m/Y H:i:s")." - Usuário: ".$logado['nomeLogado'];
	$xx = ($x-strlen($cabecalho)*3);
	$canvas->page_text($xx, 10, $cabecalho, $font, 7, array(0,0,0));
	
    if ($stream) {
        //$dompdf->stream($filename.".pdf");
		$pdf = $dompdf->output();
        $arquivo = "images/arquivos/".$filename.".pdf"; // Caminho onde será salvo o arquivo.
	    if (file_put_contents($arquivo,$pdf)) { //Tenta salvar o pdf gerado
	    	return $pdf; // Salvo com sucesso.
	    } else {
	    	return false; // Erro ao salvar o arquivo
	    }

    } else {
        return $dompdf->output();
    }
}
?>