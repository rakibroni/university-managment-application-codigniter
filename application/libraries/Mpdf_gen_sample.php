<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name: DOMPDF
 *
 * Author: Jd Fiscus
 * jdfiscus@gmail.com
 * @iamfiscus
 *
 *
 * Origin API Class: http://code.google.com/p/dompdf/
 *
 * Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
 *
 * Created: 06.22.2010
 *
 * Description: This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
 *
 */
class Mpdf_gen_sample {

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->database();
        require_once 'mpdf/mpdf.php';
    }

    public function gen_pdf($html, $EXE_NAME, $paper = 'A4') {
        //echo '<pre>';print_r($EXE_NAME);exit;
        //$session_info = $this->CI->session->userdata('logged_in');
        $mpdf = new mPDF('utf-8', $paper, '', '', 15, 15, 30, 20, 5, 5);
        // $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

        $header = '<table style="border-bottom: 1px solid #e3e3e3;  margin-bottom: 25px; width: 50%;margin-left:135px;"><tr>
                            <td width="25%;"><img src="' . base_url() . "resources/img/account.png" . '"  /><br/><br/></td>

                            </tr></table>';
        $headerE = '<table style="border-bottom: 1px solid #e3e3e3;  margin-bottom: 25px; width: 50%;margin-left:135px;"><tr>
                            <td width="15%"><img src="' . base_url() . "hli_assets/img/hreport_tttt.png" . '"  /><br/><br/></td>
                            <td width="85%"><span style="font-size: 18px;font-weight: bold;"></span><br/><span style="font: 15px arial;"></span><br/></td>
                            </tr></table>';
        $footer = '<table style="width: 100%;">
                                <tbody>
                                            <tr>
                                                    <td style="width: 33%;  font-size: 7pt; text-align: center;"><hr style="width:66%;"><br>Marketing Executive</td>
                                                    <td style="width: 33%; text-align: center; font-size: 7pt;"><hr style="width:66%;"><br>Designer</td>
                                            </tr>
                                    </tbody>
                                </table>
                                <table>
<tbody>                                                                                        <tr>
                                              <td style="font-size: 7pt; text-align: center; margin-left:1800px; width:100%;">' . date('j-m-Y h:i:sa') . '</td>

                                            </tr>
                                            </tbody>
                                            </table>';

        $footerE = '<table style="width: 100%;">
                                <tbody>
                                        <tr>
                                                    <td style="width: 33%;  font-size: 7pt; text-align: center;"><hr style="width:66%;"><br>Marketing Executive</td>
                                                    <td style="width: 33%;  font-size: 7pt; text-align: center;"><hr style="width:66%;"><br>Designer</td>
                                            </tr>
                                </tbody>
	</table>
        <table>
<tbody>                                                                                        <tr>
                                              <td style="font-size: 7pt; text-align: center; margin-left:1800px; width:100%;">' . date('j-m-Y h:i:sa') . '</td>

                                            </tr>
                                            </tbody>
                                            </table>';
        $mpdf->SetHTMLHeader($header);
        //$mpdf->SetHTMLHeader($headerE, 'E');
        $mpdf->SetHTMLFooter($footer);
        $mpdf->SetHTMLFooter($footerE, 'E');

        // $mpdf->SetWatermarkText('GPL', 0.1);
        $mpdf->showWatermarkText = true;

        $mpdf->WriteHTML($html);
        $fileName = date('Y_m_d_H_i_s');
        $mpdf->Output('GPL_' . $fileName . '.pdf', 'I');
    }

}
