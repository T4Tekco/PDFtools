<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form id="file-upload-form" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
    
    <script>
        const form = document.querySelector('#file-upload-form');
        var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");
console.log(myHeaders);
        const url = 'https://8a10-222-253-86-139.ap.ngrok.io/api/process-file';

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            
            const formData = new FormData(form);
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: myHeaders,
                });
                const json = await response.json();
                console.log(json);
                
            } catch (error) {
                console.error(error);
            }
        });
    </script>
</body>
</html>
