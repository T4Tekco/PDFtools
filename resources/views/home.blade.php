@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div class="u-layout-row shadow">
                    <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-shape-rectangle u-size-23 u-layout-cell-1">
                        <div class="u-container-layout u-valign-top-sm u-valign-top-xs u-container-layout-1">
                            <img class="u-expanded-width-md u-image u-image-default u-image-1" src="/assets/images/logoconvert.svg" alt="" data-image-width="400" data-image-height="240">
                            <!-- <p class="u-text u-text-1">Sample text. Click to select the Text Element.</p> -->
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-layout-cell u-shape-rectangle u-size-37 u-layout-cell-2">
                        <div class="u-container-layout u-container-layout-2">
                            <form id="file-upload-form" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="drop-area" class="u-align-center u-container-style u-group u-palette-1-base u-group-1" style="background-color: white;">
                                    <div style="display:block;" class="u-container-layout u-valign-middle u-container-layout-3">
                                        <h1 id="text" style="font-size: 25px;color: black;display: block;user-select: none;">Drag and Drop file here</h1>
                                        <p style="display: block;user-select: none;" id="or">{{trans('lang.or')}}</p>
                                        <label style="display: block;user-select: none;" for="file-input" id="file-label">Select File</label>
                                        <input style="visibility: visible;" type="file" id="file-input" name="file" accept=".pdf,.docx,.txt" />
                                        <div style="visibility: hidden;" id="load" class="progress-bar-container">
                                            <!-- <div class="progress-bar"></div> -->
                                            <div class="loader">

                                                <div class="bar1"></div>
                                                <div class="bar2"></div>
                                                <div class="bar3"></div>
                                                <div class="bar4"></div>
                                                <div class="bar5"></div>
                                                <div class="bar6"></div>
                                                <div class="bar7"></div>
                                                <div class="bar8"></div>
                                                <div class="bar9"></div>
                                            </div>

                                        </div>
                                        <style>
                                            .loader {
                                                position: relative;
                                                width: 164px;
                                                height: 100px;
                                                margin: 50px auto;
                                            }

                                            .loader div {
                                                position: absolute;
                                                width: 10px;
                                                height: 30px;
                                                background-color: #ff6a00;
                                                border-radius: 5px;
                                                animation: loader_51899 1.5s ease-in-out infinite;
                                            }

                                            .loader .bar1 {
                                                left: 0px;
                                                animation-delay: 0s;
                                            }

                                            .loader .bar2 {
                                                left: 20px;
                                                animation-delay: 0.15s;
                                            }

                                            .loader .bar3 {
                                                left: 40px;
                                                animation-delay: 0.3s;
                                            }

                                            .loader .bar4 {
                                                left: 60px;
                                                animation-delay: 0.45s;
                                            }

                                            .loader .bar5 {
                                                left: 80px;
                                                animation-delay: 0.6s;
                                            }

                                            .loader .bar6 {
                                                left: 100px;
                                                animation-delay: 0.75s;
                                            }

                                            .loader .bar7 {
                                                left: 120px;
                                                animation-delay: 0.9s;
                                            }

                                            .loader .bar8 {
                                                left: 140px;
                                                animation-delay: 1.05s;
                                            }

                                            .loader .bar9 {
                                                left: 160px;
                                                animation-delay: 1.2s;
                                            }

                                            @keyframes loader_51899 {
                                                0% {
                                                    height: 30px;
                                                    transform: translate(0, 0);
                                                }

                                                50% {
                                                    height: 70px;
                                                    transform: translate(0, 35px);
                                                }

                                                100% {
                                                    height: 30px;
                                                    transform: translate(0, 0);
                                                }
                                            }
                                        </style>
                                    </div>
                                </div>
                                <p class="u-text u-text-default u-text-3" style="color:black;user-select: none;"> Drop your file, select the format that you want to convert to, and then your dream file will be saved to your drive.</p>
                                <div id="flex">
                                    <button disabled onclick="startProgress()" id="1" class="btn btn-light shadow-sm ds" type="submit">
                                        <img class="size" src="/assets/icons/pdf.png" alt="">
                                        PDF</a>
                                    </button>
                                    <button disabled onclick="startProgress()" id="2" class="btn btn-light shadow-sm ds" type="submit">
                                        <img class="size" src="/assets/icons/word.png" alt="">
                                        Word</a>
                                    </button>
                                    <button disabled onclick="startProgress()" id="3" class="btn btn-light shadow-sm ds" type="submit">
                                        <img class="size" src="/assets/icons/txt.png" alt="">
                                        TxT</a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function startProgress() {
        $("#load").css({
            "visibility": "visible"
        });
        $("#text,#or,#file-label").css({
            "display": "none"
        });
        $("#file-input").css({
            "visibility": "hidden"
        });
    }

    const disable_button = () => {
        document.getElementById("1").disabled = true;
        document.getElementById("2").disabled = true;
        document.getElementById("3").disabled = true;
    }
    const enable_button = () => {
        document.getElementById("1").disabled = false;
        document.getElementById("2").disabled = false;
        document.getElementById("3").disabled = false;
    }

    const form = document.querySelector('#file-upload-form');
    const file_input = document.getElementById('file-input');
    const url = 'https://api.pdftools.t4tek.co/api/word-to-pdf';
    const formData = new FormData()
    const flex = document.getElementById('#flex');

    file_input.addEventListener('change', (event) => {
        const selectedFile = event.target.files[0];
        const fileSize = selectedFile.size; // fileSize sẽ chứa kích thước tệp đơn vị tính là byte
        if (fileSize < 2097152) {
            form.onsubmit = (e) => {
                e.preventDefault()
                formData.append("file", e.target.file.files[0])
                fetch(url, {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json())
                    .then(data => {
                        if (data.status == 100) {
                            alert('File không đúng định dạng')
                            location.reload();
                        }
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        const pdfUrl = URL.createObjectURL(blob);
                        const downloadLink = document.createElement('a');
                        downloadLink.href = pdfUrl;
                        downloadLink.download = $('#file-input').val().replace(/^C:\\fakepath\\/i, '').split('.') + '.pdf';
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);

                        $("#load").css({
                            "visibility": "hidden"
                        });
                        $("#text,#or,#file-label").css({
                            "display": "block"
                        });
                        $("#file-input").css({
                            "visibility": "visible"
                        });
                        alert('chúc mừng');
                        file_input.value = '';
                        form.reset();
                        document.getElementById('text').innerHTML = "Drag and Drop file here";
                        disable_button();
                        $("#1,#2,#3").css({
                            "display": "block"
                        });
                        $("#flex").css({
                            "display": "flex"
                        });
                    })
                //  .catch(error => console.error(error));
            }
        } else {
            alert('Kích thước file quá lớn vui lòng chọn file khác')
            location.reload();
        }
    });
    const dropAreaa = document.getElementById('drop-area');
    const fileInput = document.getElementById('file-input');
    const fileLabel = document.getElementById('file-label');

    document.getElementById('file-input').addEventListener('change', function() {
        var file = this.files[0];
        var fileName = file.name;
        var filename = fileName.split('.').pop();
        enable_button()
        if (filename == 'pdf') {

            $("#1").css({
                "display": "none"
            });
            $("#flex").css({
                "display": "flex"
            })
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
                enable_button()
                $("#2,#3").css({
                    "display": "block"
                });
            } else if (filename == 'docx' || filename == 'txt') {
                $("#2,#3").css({
                    "display": "none"
                });
                enable_button()
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