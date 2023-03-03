<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <link rel="icon" href="/icons/icon.png" type="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <title>Convert Files</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #333333;">
        <div class="container-fluid" style="margin: 0 0 0 167px;">
            <a class="navbar-brand" href="">
                <img width="40px" height="40px" src="/images/logo.png" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link active" aria-current="page" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('profile')}}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a style="position: absolute;text-align: start; right: 192px;color:white" class="nav-link" href="{{ route('login')}}">Log Out</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('profile')}}">About Us</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div style="display: flex;" class="container shadow">
        <div class="border-right" style="flex-basis: 40%;padding-top: 100px;">
            <img style="margin-bottom: 4px;" src="/images/logoconvert.svg" alt="">
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
                <form action="" method="post">
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
                                <img class="size" src="/icons/pdf.png" alt="">
                                PDF</a>
                            </button>
                            <button id="2" class="btn btn-light shadow-sm ds" type="submit">
                                <img class="size" src="/icons/word.png" alt="">
                                Word</a>
                            </button>
                            <button id="3" class="btn btn-light shadow-sm ds" type="submit">
                                <img class="size" src="/icons/txt.png" alt="">
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
            if ((fileName.match('.txt')) || (fileName.match('.pdf')) || (fileName.match('.docx'))) {
                var myname = document.getElementById('text'); // Tìm phần tử span trong HTML
                myname.innerHTML = fileName;
            } else {
                alert('Chỉ cho phép tải lên các định dạng .pdf, .docx, .txt');
            }
        }
    </script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
<footer class="" style="background-color: #333333;">

    <div style="display: flex;justify-content: center;">
        <div class="footer-left">

            <img style="margin: 20px 0 0 40px ;" width="150px" height="130px" src="/images/logo.png" alt="">

            <p class="" style="color:white">Copyright © Công ty TNHH T4TeK</p>
        </div>

        <div class="" style="color:white;margin: 30px 70px 0 70px;">
            <div class="" style="margin-bottom: 20px;width: 500px;height: 50px;">

                <p style="color:white"><i class="fa-solid fa-location-dot" style="margin-right: 5px;"></i>L18-11-13, Tầng 18 Tòa nhà Vincom Center Đồng Khởi, Số 72 Lê Thánh Tôn, Phường Bến Nghé, Quận 1, Thành phố Hồ Chí Minh</p>
            </div>
            <div style="margin-bottom: 20px;">
                <p style="color:white"> <i class="fa-solid fa-phone" style="margin-right: 5px;"></i> 0965643046</p>

            </div>
            <div>
                <p style="color:white"><i class="fa-solid fa-envelope" style="margin-right: 5px;"></i>contact@t4tek.co</p>
            </div>

        </div>

        <div class="" style="display: flex;">
            <a href="">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/images/fb.png" alt="">
                </div>
            </a>
            <a href="http://zalo.me/518410350895218680?src=qr">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="https://cdn.haitrieu.com/wp-content/uploads/2022/01/Logo-Zalo-Arc.png" alt="">
                </div>
            </a>
            <a href="">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png" alt="">
                </div>
            </a>
            <a href="">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/images/link.png" alt="">
                </div>
            </a>
        </div>
    </div>

</footer>

</html>