<?php
	include 'ReviewModel.php';
	include 'WeatherModel.php';
	Class Controller{

		public function getReview($id){
			$models = new ReviewModel;
			$topics = $models->getAllReview();
			$result = array();
			if (is_array($topics) || is_object($topics))
			{
				foreach ($topics['rows'] as $topic) {
					$field = $topic['doc'];
					if($field['_id'] === $id){
						return $topic;
					}
				}
			}
			return null;
		}

		public function getTopic(){
			$models = new ReviewModel;
			$topics = $models->getAllReview();
			$result = array();
			if (is_array($topics) || is_object($topics))
			{
				//make array of all topic
				foreach($topics['rows'] as $topic) {
					$field = $topic['doc'];
					array_push($result, '{ "id":' . $field['_id'] . ',"images":' . $field['image'] . ',"topic":' . $field['topic'] . ',"timestamp":' . $field['timestamp'] . '}' );
				}
				return json_encode($result);
			}
		}
		
		public function getWeater($la,$lo,$date,$tag){
			$weatherModel = new WeatherModel;
			$json = file_get_contents('https://ad46647d-1b77-4644-b8c6-78eed562b7a3:NAgf7Zkmlo@twcservice.au-syd.mybluemix.net:443/api/weather/v2/forecast/daily/10day?units=m&geocode=45.42%2C75.69&language=en-US');
			$obj = json_decode($json);
			$rain_day = array();
			$rain_night = array();
			$forcasts = $obj->{'forecasts'};
			$s = 0;
			$c = 0;
			$t = 0;
			$sn = 0;
			$cn = 0;
			$tn = 0;
			// count stat of forcast each day
			foreach ($forcasts as $forcast) {
				$day = $day->{'day'} ;
				$night = $night->{'night'};
				 if($day != NULL){
					 if(strpos($day->{'shortcast'}, 'sun' ) !== false || strpos($day->{'shortcast'}, 'Sun' ) !== false)
					 		$s++;
					 else if(strpos($day->{'shortcast'}, 'thunderstorm' ) !== false){
						 	//add date
						 	array_push($rain_day,$day->{'fcst_valid_local'});
						 	$t++;
					 }
					 else{
					 		$c++;
					}
				 }
				 if($night != NULL){
					 if(strpos($night->{'shortcast'}, 'sun' ) !== false)
					 		$sn++;
					 else if(strpos($night->{'shortcast'}, 'thunderstorm' ) !== false){
						 //add date
						 	array_push($rain_night,$night->{'fcst_valid_local'});
					 		$tn++;
						}
					 else{
					 		$cn++;
					}
				 }
			}
			//calculate prop
			//day
			$weatherModel->getWeatherByKeys($tag,"day",$weather);
			//night
			$weatherModel->getWeatherByKeys($tag,"night",$weather);
		}

		public function insertReview(){
			$models = new ReviewModel;
			if ($_POST != null) {
			  $image = $_POST["image"];
			  $topic = $_POST["topic"];
			  $detail = $_POST["detail"];
			  $tag = $_POST["tag"];
			  $lat = $_POST["lat"];
			  $long = $_POST["long"];
			  $models->insertDB($image,$topic,$detail,$tag,$lat,$long);
			}
		}
	}
?>
