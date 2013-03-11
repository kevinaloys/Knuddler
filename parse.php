
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>
  <script type="text/javascript">
  //This invokes the glassomium based Ruby server to initialte the xampp local server



  </script>
</head>
</body>
<?php
$apikey = '9hquc2qzd7nm3g7tdunrcxs5';
$q = urlencode($_POST['movie_name']); // make sure to url encode an query parameterss

// construct the query with our apikey and the query we want to make
$endpoint = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $apikey . '&q=' . $q;

// setup curl to make a call to the endpoint
$session = curl_init($endpoint);

// indicates that we want the response back
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// exec curl and get the data back
$data = curl_exec($session);

// remember to close the curl session once we are finished retrieveing the data
curl_close($session);

// decode the json data to make it easier to parse the php
$search_results = json_decode($data);
if ($search_results === NULL) die('Error parsing json');

// play with the data!
$movies = $search_results->movies;
$total_hits=$search_results->total;

foreach ($movies as $movie)
{

  $title=$movie->title;
  $year=$movie->year;
  $runtime=$movie->runtime;
  $synopsis=$movie->synopsis;
  $original=$movie->posters->original;
  $thumbnail=$movie->posters->thumbnail;
  $profile=$movie->posters->profile;


  print('<div id="display">');
  		print('<h2>'.$title.'</h2>');
  			print('<img id="image" src="'.$profile.'">');
  			print($year);
  			print($runtime);
  			print($synopsis);
        




   print('</div>');
}
?>



</body>
</html>