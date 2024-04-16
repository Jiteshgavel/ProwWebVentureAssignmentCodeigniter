<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/simple_html_dom.php';


class WebScraper
{
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('http');
    }

    public function scrape($url)
    {
        $response = $this->CI->http->get($url);
        $html = str_get_html($response);

        // Scraping logic here
        $title = $html->find('title', 0)->plaintext;

        $html->clear();
        unset($html);

        return $title;
    }
}
