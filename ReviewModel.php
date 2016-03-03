<?php 
date_default_timezone_set('Asia/Bangkok');
class ReviewModel{
	public function getAllReview(){
		$curl=curl_init();
		curl_setopt_array($curl, array(
    		CURLOPT_RETURNTRANSFER => 1,
  	    	CURLOPT_URL => 'https://cloudycloudy.cloudant.com/review_db/_all_docs?include_docs=true',
		));
		$result = curl_exec($curl);
		curl_close($curl);	
		$json=json_decode($result,true);
		return $json;
	}
	public function getReviewById($id){
		$curl=curl_init();
		curl_setopt_array($curl, array(
    		CURLOPT_RETURNTRANSFER => 1,
  	    	CURLOPT_URL => 'https://cloudycloudy.cloudant.com/review_db/'.$id,
   			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$result = curl_exec($curl);
		curl_close($curl);
		$json=json_decode($result,true);
		return $json;
	}
	public function insertDB($image,$topic,$detail,$tag,$lat,$long){
		$date=date_create();
		$data = array("image" => $image, "topic" => $topic,"detail"=>$detail,"tag"=>$tag,"lat"=>$lat,"long"=>$long,"timestamp"=>date_format($date,"Y/m/d H:i:s"));                                                                    
		$data_string = json_encode($data);                                                                                   
		                                                                                                                     
		$ch = curl_init('https://cloudycloudy.cloudant.com/review_db/');                                                                      
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