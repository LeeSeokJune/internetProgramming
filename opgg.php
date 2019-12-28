<?
	$text = $_GET['summoner_name'];
		
	$summoner_name = urlencode($text);
	$api_key="RGAPI-53dcf13b-6c33-420b-bdbc-7e97ade70488i";
	$url = "https://kr.api.riotgames.com/lol/summoner/v3/summoners/by_name/".$summoner_name."?api_key=".$api_key;

	$is_post = false;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_URL, $is_post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_close($ch);

	$result = json_decode($response, true);
