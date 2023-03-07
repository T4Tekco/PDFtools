@extends('main')
@section('body')
<div style="display: flex;" class="container shadow">
    <div class="border-right" style="flex-basis: 40%;padding-top: 100px;">
        <img style="margin-bottom: 4px;" src="/assets/images/logoconvert.svg" alt="">
        <p style="color:#000000;font-weight: bold;font-size: 20px;">How to convert PDF to other format online</p>
        <p style="color:#000000">To start the conversion, upload PDF files to the site from a computer or file storage.</p>
        <p style="color:#000000">After uploading, you can change the PDF file by replacing them. Then click the convert option and wait for the conversion.</p>
        <p style="color:#000000">Now your document is ready! Each sheet of PDF document was converted to your choice of format and you can download them in a single ZIP archive.</p>
    </div>
    <div style="flex-basis: 60%;height: 70p;">
        <!-- select -->
        <select id="my-dropdown" style="margin-top: 80px;border:2px solid grey ;border-radius: 5px;position: absolute;right: 215px;top: 0px;">
            <a href="">
                <option value="option1">Việt Nam</option>
            </a>
            <a href="">
                <option value="option2">English</option>
            </a>
        </select>

        <div style="margin-left: 10px;">
            <title>Upload file</title>
            <style>

            </style>
            <form action="" method="post" enctype="multipart/form-data">
                <div id="drop-area">
                    <div style="margin-top: 30px;">
                        <h1 id="text" style="font-size: 25px;">Drag and Drop file here</h1>
                        <p id="or">or</p>
                        <label for="file-input" id="file-label">Select File</label>
                        <input type="file" id="file-input" name="file-input" accept=".pdf,.docx,.txt" />
                    </div>
                </div>
            </form>
        </div>
        <div style="padding-top: 40px; margin: 0 0 130px 0;">
            <p style="color:black;font-size: 20px;margin-left: 10px;">Convert to</p>
            <div style="display: flex;">
                <form action="" method="post">
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
                        <!-- <button id="3" class="btn btn-light shadow-sm ds" type="submit">
                            <img class="size" src="/images/json.jpg" alt="">
                            Json</a>
                        </button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
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