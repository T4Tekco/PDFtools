@extends('tool')
@section('body')
<div class="container" style="margin-top: 2%;margin-bottom: 2%">


<div class="row">
    <div class="col-8">
        <form id="file-upload-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-2 mb-3" >
                    <input type="color" name="color" value="#9E6F21" class="color_qr act" id="cb1" placeholder="First name"  >
                </div>
                <div class="col-md-2 mb-3">
                    <input type="color" name="color" value="#7C96AB" class="color_qr" id="cb1" placeholder="First name"  >
                </div>
                <div class="col-md-2 mb-3">
                    <input type="color" name="color" value="#917FB3" class="color_qr" id="cb1" placeholder="First name"  >
                </div>
                <div class="col-md-2 mb-3">
                    <input type="color" name="color" value="#917FB3" class="color_qr" id="cb1" placeholder="First name"  >
                </div>
                <div class="col-md-2 mb-3">
                    <input type="color" name="color" value="#D4ADFC"  class="color_qr"id="cb1" placeholder="First name"  >
                </div>
                <div class="col-md-2 mb-3">
                    <input type="color" name="color" value="#83764F" class="color_qr" id="cb1" placeholder="First name"  >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="firstName" class="form-control" placeholder="First name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="lastName" class="form-control" placeholder="Last name" required>
                </div>
            </div>
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="mb-3">
                <input type="text" name="Url" class="form-control" placeholder="URL">
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="company" class="form-control" placeholder="Company">
            </div>
            <div class="mb-3">
                <input type="text" name="job" class="form-control" placeholder="Job">
            </div>
            <div class="mb-3">
                <input type="text" name="street" class="form-control" placeholder="Street" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="city" class="form-control" placeholder="City" required>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="state" class="form-control" placeholder="State" required>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="country" class="form-control" placeholder="Country" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="zip" class="form-control" placeholder="Zip" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="numberWord" class="form-control" placeholder="Number word">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="number" class="form-control" placeholder="Number" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="foreColor" class="form-control" placeholder="Foreground color">
                </div>
            </div>
            <button type="button" id="send" class="btn btn-primary">Send</button>
        </form>
</div>
<div class="col-4">
    <div class="row" >
        @csrf
        <p>
            <img src="" alt="" id="showqr">
        </p>
        <a href="" id="dowloadFile" class="btn btn-secondary dropdown-toggle">  
            <i class="fa fa-download" aria-hidden="true"></i>
  </a>
    </div>

</div>
</div>
</div>
<script>const form = document.querySelector('#file-upload-form');
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const domain = window.location.hostname;
    const url = `https://bcdnscanner.bizinfo.one/api/QRVcrad`;
    
    const responseEl = document.querySelector('#showqr');
    const dowloadFile = document.querySelector('#dowloadFile');
    const submit = document.querySelector('#send');
    async function updateQRCode() {
        const formData = new FormData(form);
        try {
          const response = await fetch(url, {
            method: 'POST',
            body: formData,
          });
          const json = await response.json();
          responseEl.setAttribute('src', json.qrcode);
          dowloadFile.setAttribute('href', 'https://bcdnscanner.bizinfo.one/download-qr-code?filename='+json.fileName);
        } catch (error) {
          console.error(error);
        }
      }
      const urlInputs = document.querySelectorAll('.form-control');
      urlInputs.forEach(urlInput => {
        urlInput.addEventListener('change', updateQRCode);
      });
      submit.addEventListener('click', updateQRCode);
      </script>

@endsection