<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/10/13
 * Time: 3:02 PM
 * To change this template use File | Settings | File Templates.
 */

class WKHTMLPDfConverter implements PDFConverter
{

    private $location;
    public $output_file_path;
    public $html;
    public $margin_horizontal;
    public $margin_vertical;
    public $header;
    public $footer;
    public $dpi;
    public $orientation;

    private $header_footer_font;
    private $header_footer_font_size;
    private $header_footer_spacing;


    public function __construct()
    {


        $this->dpi = 200;
        $this->margin_horizontal = 10;
        $this->margin_vertical = 15;
        $this->orientation = 'Portrait';
//        $this->footer = "generated by gas.html2pdfconverter.com converter;
        $this->header_footer_font = "open sans";
        $this->header_footer_font_size = "7";
        $this->header_footer_spacing = "5";
    }

    public function convert($location, $html, $header = true)
    {

        if ($this->header)
            $this->header = "Page [page] of [toPage]";
        $this->location = Config::get('custom.wkhtlPath') . $location;
        try {
            $tmp_path = Config::get('custom.pdfDirectory') . Util::GUID() . '.html';
            $fp = fopen($tmp_path, "w+");

            fclose($fp);
            File::put($tmp_path, $html);

            $html_path = "file:///" . $tmp_path;
            $filePath = Config::get('custom.pdfDirectory') . Util::GUID() . '.pdf';
            $cmd = $this->location
                . " --margin-left $this->margin_horizontal --margin-right $this->margin_horizontal --margin-top $this->margin_vertical --margin-bottom $this->margin_vertical"
                . " --dpi $this->dpi --orientation $this->orientation"
                . " --footer-center \"$this->footer\" --header-right \"$this->header\" --header-font-name \"$this->header_footer_font\" --footer-font-name \"$this->header_footer_font\" "
                . " --footer-font-size $this->header_footer_font_size --header-font-size $this->header_footer_font_size --footer-spacing $this->header_footer_spacing --header-spacing $this->header_footer_spacing"
                . " $html_path $filePath";

            $command = $cmd . ' > /dev/null 2>&1 & echo $!; ';
            $pid = exec($command, $output);
//            unlink($tmp_path);
            return array('processId' => $pid, 'filePath' => $filePath,'htmlPath'=>$tmp_path);
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

}