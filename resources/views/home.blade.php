@extends('main')
@section('body')
<!-- Convert file -->
<div style="padding-top: 100px;" class="">
    <div class="containert">
        <div class="header-section">
        </div>
        <div class="drop-section">
            <div class="col">
                <div class="cloud-icon">
                    <img src="icons/cloud.png" alt="cloud">
                </div>
                <span>Drag & Drop your files here</span>
                <span>OR</span>
                <button style="background-color: #9385ff;" class="file-selector">Browse Files</button>
                <input type="file" class="file-selector-input" multiple>
            </div>
            <div class="col">
                <div class="drop-here">Drop Here</div>
            </div>
        </div>
        <div class="list-section">
            <div class="list-title">Uploaded Files</div>
            <div class="list"></div>
        </div>
    </div>
</div>
@endsection