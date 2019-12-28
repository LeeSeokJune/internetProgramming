<?php
$api_key = "RGAPI-53dcf13b-6c33-420b-bdbc-7e97ade70488"; // 자신의 api_key
//$api_key = "RGAPI-3689d294-bc1a-4304-87c5-f0178deabce9";
$usernames = strtolower(trim($_GET['username']));
$username = preg_replace("/\s+/", "", $usernames);
function httpGet($url)
{
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
    $output=curl_exec($ch);
    curl_close($ch);
//	echo $output;
//	echo $url;
	return $output;
}

$get_id = json_decode(httpGet("https://kr.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$username."?api_key=".$api_key), true);
$userid = $get_id['puuid'];
$user_accid = $get_id['accountId'];
$nick = $get_id['name'];
$level = $get_id['summonerLevel'];
$profileIcon = $get_id[$username]['profileIconId'];
$get_idid = json_decode(httpGet("https://kr.api.riotgames.com/lol/summoner/v4/summoners/by-puuid/".$userid."?api_key=".$api_key),true);
$user_eid = $get_idid['id'];
//echo $user_eid;
$status = json_decode(httpGet("https://kr.api.riotgames.com/lol/league/v4/entries/by-summoner/".$user_eid."/?api_key=".$api_key), true);
$tier = $status[0]['tier'];
$division = $status[0]['division'];
$point = $status[0]['leaguePoints'];
$win = $status[0]['wins'];
$lose = $status[0]['losses'];
$current_game = json_decode(httpGet("https://kr.api.riotgames.com/lol/spectator/v4/active-games/by-summoner//".$user_eid."?api_key=".$api_key), true);
?>
<html><head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  font-family:Arial;
}
</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
  </head><body>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1>League Of Legends</h1>
            <p>Record Search System</p>
            <br>
            <form role="form">
              <div class="form-group">
                <label class="control-label" for="exampleInputEmail1">소환사 이름</label>
                <input class="form-control" id="exampleInputEmail1" placeholder="소환사 이름을 입력하세요." type="text" name="username">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>

</body></html>
<?php

if($username == "")
{
	echo $get_id[$username]['id'];
}
else if(($username) && $userid == "")
{
	echo $userid;
  echo "<p><center>존재하지 않는 아이디입니다.</center></p>";
}
else
{
  if($current_game['status']['status_code'] == '404')
  {
    echo "<center><p>인게임 정보가 없습니다.</p><br></center>";
  }
  else
  {
    echo "<center>";
    echo "<p>인게임 정보</p>";
    echo "<table border=3>";
    echo "<th>챔프</th>";
    echo "<th>이름</th>";
    echo "<tr>";
    for($i=0;$i<5;$i++) {
      echo "<tr>";
      echo "<td><img src=\"./champ/".$current_game['participants'][$i]['championId'].".png\"></td>"; // 챔프그림폴더
      echo "<td>".$current_game['participants'][$i]['summonerName']."</td>";
      echo "</tr>";
    }
    echo "<td>VS</td>";
    for($i=5;$i<10;$i++) {
      echo "<tr>";
      echo "<td><img src=\"./champ/".$current_game['participants'][$i]['championId'].".png\"></td>";
      echo "<td>".$current_game['participants'][$i]['summonerName']."</td>";
      echo "</tr>";
    }
    echo "</tr></table></center>";
  }
  echo "<br><center><img src=\"http://sk2.op.gg/images/profile_icons/profileIcon".$profileIcon.".jpg\" height=50 width=50>";
  echo "<p>ID : ".$usernames."<br>";
  echo "LV : ".$level."<br>";
  echo "TIER : ".$tier." ".$division."<br>";
  echo "LP : ".$point."<br>";
  echo "Record : ".$win."승 ".$lose."패<br>";
}
?>
