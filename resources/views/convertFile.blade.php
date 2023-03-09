<!DOCTYPE html>
<html>
<head>
	<title> Converter file</title>
</head>
<body>
	<h1> Converter file</h1>

	<form  method="post" enctype="multipart/form-data">
		@csrf
		<input type="file" accept=".pdf" name="pdf_file">
		<button type="submit">Convert to Text</button>
	</form>
	
</body>
</html>
