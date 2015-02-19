<?php
namespace Camael\Api {
	class Request {

		private static $_host = 'http://127.0.0.1';
		private $_status = 0;
		private $_time   = 0;
		private $_header = [];
		private $_request   = '';

		public static function setHost($host) {
			static::$_host = $host;
		}

		protected function url($method, $url, $data = [])
		{
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL			, static::$_host.'/'.$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER	, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION	, true);
			curl_setopt($ch, CURLOPT_HEADER			, true);


			if(empty($data) === false) {
				curl_setopt($ch,CURLOPT_POST, count($data));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
			}

			//execute post
			$result = curl_exec($ch);
			
			$this->_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$this->_time   = curl_getinfo($ch, CURLINFO_TOTAL_TIME);

			if($result === false)
        		return trigger_error(curl_error($ch));
    	 

        	$response = new  \Hoa\Http\Response\Response();

        	$response->parse($result);

        	$this->_request = $response;

			//close connection
			curl_close($ch);

			return $this;
		}

		public function getStatusCode() {
			return $this->_status;
		}

		public function getTime() {
			return $this->_time;
		}

		public function getRequest() {
			return $this->_request;
		}

		public function getBody() {
			return $this->_request->getBody();
		}

		public function get($url) {
			return $this->url('GET', $url);
		}

		public function head($url) {
			return $this->url('HEAD', $url);
		}

		public function post($url, $data) {
			return $this->url('POST', $url, $data);
		}


	}
}
