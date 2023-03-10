@extends('main')
@section('body')
<div style="display: flex;" class="container shadow">
    <div class="border-right" style="flex-basis: 40%;padding-top: 100px;">
        <img style="margin-bottom: 4px;" src="/assets/images/logoconvert.svg" alt="">
        <!-- <p style="color:#000000;font-weight: bold;font-size: 20px;">How to convert PDF to other format online</p>
        <p style="color:#000000">To start the conversion, upload PDF files to the site from a computer or file storage.</p>
        <p style="color:#000000">After uploading, you can change the PDF file by replacing them. Then click the convert option and wait for the conversion.</p>
        <p style="color:#000000">Now your document is ready! Each sheet of PDF document was converted to your choice of format and you can download them in a single ZIP archive.</p> -->
    </div>
    <div style="flex-basis: 60%;height: 70p;">
        <!-- select -->
        <form id="file-upload-form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-left: 10px;">
                <title>Upload file</title>

                <div id="drop-area">
                    <div style="margin-top: 30px;">
                        <h1 id="text" style="font-size: 25px;">Drag and Drop file here</h1>
                        <p id="or">or</p>
                        <label for="file-input" id="file-label">Select File</label>
                        <input type="file" id="file-input" name="file" accept=".pdf,.docx,.txt" />
                    </div>
                </div>
            </div>
            <div style="padding-top: 40px; margin: 0 0 130px 0;">
                <p style="color:black;font-size: 20px;margin-left: 10px;text-align: center;">Drop your file, select the format that you want to convert to, and then your dream file will be saved to your drive.
                </p>
                <div style="display: flex;">
                    <div style="display: flex;">
                        <button id="1" class="btn btn-light shadow-sm ds" type="submit">
                            <img class="size" src="/assets/icons/pdf.png" alt="">
                            PDF</a>
                        </button>
                        <button id="2" class="btn btn-light shadow-sm ds" type="submit">
                            <img class="size" src="/assets/icons/word.png" alt="">
                            Word</a>
                        </button>
                        <button id="3" class="btn btn-light shadow-sm ds" type="submit">
                            <img class="size" src="/assets/icons/txt.png" alt="">
                            TxT</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const form = document.querySelector('#file-upload-form');
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'https://0882-14-169-212-161.ap.ngrok.io/api/word-to-pdf');
        xhr.responseType = 'blob';
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                const pdfBlob = this.response;
                const pdfUrl = URL.createObjectURL(pdfBlob);
                // Create a link to download the PDF
                const downloadLink = document.createElement('a');
                downloadLink.href = pdfUrl;
                downloadLink.download = $('#file-input').val().replace(/^C:\\fakepath\\/i, '').split('.').slice(0, -1).join('.') + '.pdf';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
                // Embed the PDF in an iframe

                // const pdfIframe = document.createElement('iframe');
                // pdfIframe.src = pdfUrl;
                // pdfIframe.width = '100%';
                // pdfIframe.height = '600px';
                // document.body.appendChild(pdfIframe);
            }
        };
        const formData = new FormData();
        formData.append('file', fileInput.files[0]);
        xhr.send(formData);


    });

    const dropAreaa = document.getElementById('drop-area');
    const fileInput = document.getElementById('file-input');
    const fileLabel = document.getElementById('file-label');

    document.getElementById('file-input').addEventListener('change', function() {
        var file = this.files[0];
        var fileName = file.name;
        var filename = fileName.split('.').pop();
        if (filename == 'pdf') {
            $("#1").css({
                "display": "none"
            });
            $("#2,#3").css({
                "display": "block"
            });
        } else if (filename == 'docx' || filename == 'txt') {
            $("#2,#3").css({
                "display": "none"
            });
            $("#1").css({
                "display": "block"
            });
        }
    });
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropAreaa.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop area when item is dragged over
    ['dragenter', 'dragover'].forEach(eventName => {
        dropAreaa.addEventListener(eventName, highlight, false);
    });

    // Unhighlight drop area when item is dragged out
    ['dragleave', 'drop'].forEach(eventName => {
        dropAreaa.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropAreaa.addEventListener('drop', handleDrop, false);
    fileInput.addEventListener('change', handleFileSelect, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        dropAreaa.classList.add('highlight');
    }

    function unhighlight(e) {
        dropAreaa.classList.remove('highlight');
    }

    function handleDrop(e) {
        const files = e.dataTransfer.files;
        handleFiles(files);
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 1) {
            alert('Chỉ cho phép tải lên một tệp duy nhất.');
            return;
        }
        var file = files[0];
        var fileName = file.name;
        var filename = fileName.split('.').pop();
        if ((fileName.match('.txt')) || (fileName.match('.pdf')) || (fileName.match('.docx'))) {
            var myname = document.getElementById('text'); // Tìm phần tử span trong HTML
            myname.innerHTML = fileName;
            if (filename == 'pdf') {
                $("#1").css({
                    "display": "none"
                });
                $("#2,#3").css({
                    "display": "block"
                });
            } else if (filename == 'docx' || filename == 'txt') {
                $("#2,#3").css({
                    "display": "none"
                });
                $("#1").css({
                    "display": "block"
                });
            }
        } else {
            alert('Chỉ cho phép tải lên các định dạng .pdf, .docx, .txt');
        }
    }
</script>
@endsection