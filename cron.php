<?php
		$request_do = curl_init();
		curl_setopt($request_do, CURLOPT_URL, "http://xero.nwoilgas.com/index.php/cronjobs/cronsyncbankaccount");
		//curl_setopt($request_do, CURLOPT_USERPWD, $this->Username.':'.$this->Password);
        curl_setopt($request_do, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($request_do, CURLOPT_TIMEOUT,        30);
        curl_setopt($request_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($request_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($request_do, CURLOPT_SSL_VERIFYHOST, false);
       // curl_setopt($request_do, CURLOPT_HTTPHEADER,     $this->Headers);
        $result = curl_exec($request_do); 
        curl_close($request_do);
		echo $result;
?>