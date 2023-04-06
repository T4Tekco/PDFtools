<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form id="upload-form" action="/api/process-file" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
    {{-- <script>https://apitools.t4tek.tk/api/process-file
        const form = document.getElementById('upload-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // prevent the default form submission behavior
    
            // get the form data and create a new FormData object
            const formData = new FormData(form);
    
            // send an AJAX request to the API endpoint
            fetch('/api/process-file', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // do something with the response data
                console.log(data);
            })
            .catch(error => console.error(error));
        });
    </script> --}}
    
</body>
</html>