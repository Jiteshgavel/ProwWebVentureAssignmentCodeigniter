<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scraper extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function create(){
        $this->load->view('scrapper/scraper_form');
    }

    public function scrape()
    {
        $data['images'] = array();
        $data['url'] = '';
        
        if ($this->input->post('url')) {
            $url = $this->input->post('url');
            $data['url'] = $url;

            try {
                $html = file_get_contents($url);

                if (!$html) {
                    throw new Exception("Failed to load HTML content.");
                }
                $dom = new DOMDocument();
                @$dom->loadHTML($html);

                $images = $dom->getElementsByTagName('img');
                foreach ($images as $image) {
                    $src = $image->getAttribute('src');
                    $data['images'][] = $src;
                }
            } catch (Exception $e) {
                $data['error'] = "An error occurred: " . $e->getMessage();
            }
        }

        // Load the view with the scraped data
        $this->load->view('scrapper/scraper_view', $data);
    }

}
