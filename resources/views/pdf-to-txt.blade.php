<!DOCTYPE html>
<html>
<head>
	<title>PDF to TXT to JSON Converter</title>
</head>
<body>
	<h1>PDF to TXT to JSON Converter</h1>

	<form  method="post" enctype="multipart/form-data">
		@csrf
		<input type="file" accept=".pdf" name="pdf_file">
		<button type="submit">Convert to Text</button>
	</form>
	
<?php
if (isset( $json)) {

echo '<pre>';
print_r( $json);
echo '</pre>';

// $result = [];
//         foreach ($json as $line) {
//             $parts = explode(':', $line, 2);
//             if (count($parts) == 2) {
//                 $result[$parts[0]] = $parts[1];
//             }
//         }
echo '{';
		echo  '"'.$json[100].'":"'.$json[101].'"';
		echo '}';
//                      for ($i = 0; $i < sizeof($json); $i++) {
                   
//           if (isset($json[$i])) {
// 		   echo  $json[$i]."<br>";
// 		  }
                        
                        

// }
	# code...
}
?>
	@if(session('json'))
		<h2>JSON Output:</h2>
		<pre>{{ session('json') }}</pre>
	@endif
</body>
</html>
