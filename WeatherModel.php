<?php 
class WeatherModel{
	public function getAllWeather(){
		$curl=curl_init();
		curl_setopt_array($curl, array(
    		CURLOPT_RETURNTRANSFER => 1,
  	    	CURLOPT_URL => 'https://cloudycloudy.cloudant.com/weather_db/_all_docs?include_docs=true',
		));
		$result = curl_exec($curl);
		curl_close($curl);	
		$json=json_decode($result,true);
		return $json;
	}
	public function getWeatherByKeys($tag,$period,$weather){
		$curl=curl_init();
		curl_setopt_array($curl, array(
    		CURLOPT_RETURNTRANSFER => 1,
  	    	CURLOPT_URL => 'https://cloudycloudy.cloudant.com/weather_db/'.$tag.$period.$weather,
   			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$result = curl_exec($curl);
		curl_close($curl);
		$json=json_decode($result,true);
		return $json["detail"];
	}
	public function insertDB($tag,$period,$weather,$detail){
		$date=date_create();
		$data = array("period"=>$period,"tag"=>$tag,"weather"=>$weather,"detail"=>$detail,"_id"=>$tag.$weather.$period);                                                         
		$data_string = json_encode($data);                                                                                   
		                                                                                                                     
		$ch = curl_init('https://cloudycloudy.cloudant.com/weather_db/');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		                                                                                                                     
		$result = curl_exec($ch);
		return $result;
	}
}
?>