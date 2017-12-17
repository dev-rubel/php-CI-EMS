<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Google_url extends CI_Controller {  
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('google_url_api');
    }
	
	function urlShort($url)
	{
		$this->google_url_api->enable_debug(FALSE);
		$url = 'http://www.facebook.com';
        $short_url = $this->google_url_api->shorten($url);
        echo $short_url->id;
	}
	
	function urlLong($url)
	{
		
        $expand_url = $this->google_url_api->expand($url);
		return $expand_url;
	}
    
    function allExample()
    {

        $url = 'http://www.google.com';
        /* if you want switch debug mode, please replace FALSE with TRUE*/
        $this->google_url_api->enable_debug(FALSE);
        
        /**
         * shorten example
         */                 
        
        echo '<h2>Shorten Example</h2>';
        $short_url = $this->google_url_api->shorten($url);
        echo $url . " => " . $short_url->id . "<br />";
        echo 'Response code: ' . $this->google_url_api->get_http_status();
        
        /**
         * expand example
         */         
        
        $url = 'http://goo.gl/fbsS';
        echo '<h2>Expand Example</h2>';
        $expand_url = $this->google_url_api->expand($url);
        echo $url . " => " . $expand_url->longUrl . "<br />";
        echo 'Response code: ' . $this->google_url_api->get_http_status() . "<br />";
        echo 'Response status: ' . $expand_url->status;
        
        /**
         * analytics example
         */
        
        $url = "http://goo.gl/fbsS";
        echo '<h2>Analytics Example</h2>';         
        $analytics_url = $this->google_url_api->analytics($url);
        echo 'Response code: ' . $this->google_url_api->get_http_status() . "<br />";
        echo 'Response status: ' . $analytics_url->status . "<br />";
        echo 'Date Created: ' . date("Y-m-d H:i:s", strtotime($analytics_url->created)) . "<br />";
        $this->_print($analytics_url);
        
    }
    
    private function _dump($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '<pre>';
    }

    private function _print($data)
    {
        echo '<pre>';
        print_r($data);
        echo '<pre>';
    }    
}

/* End of file google_url.php */
/* Location: ./application/controller/google_url.php */

