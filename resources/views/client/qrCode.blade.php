@extends('tool')
@section('body')
@csrf
<div class="container" style="margin-top: 2%">
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
            <div class="mb-3">
              <label for="url" class="form-label">URL</label>
              <input type="text" name="url" class="form-control" id="url" placeholder="Enter URL">
            </div>
            <div class="mb-3">
              <label for="foreColor" class="form-label">Foreground Color</label>
              <input type="text" name="foreColor" class="form-control" id="foreColor" placeholder="Enter color code">
            </div>
            <button type="button" id="send" class="btn btn-primary">Send</button>
          </form>
    </div>
<div class="col-4">
    <div class="row">
      <p>
          <img src="" alt="" id="showqr">
      </p>
      
         <a href="" id="dowloadFile" class="btn btn-secondary dropdown-toggle">  
               <i class="fa fa-download" aria-hidden="true"></i>
     </a>
    </div>

</div>
</div></div>
<script>const form = document.querySelector('#file-upload-form');
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    
    const domain = window.location.hostname;
    const url = `https://bcdnscanner.bizinfo.one/api/QRURL`;
    
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
        urlInput.addEventListener('input', updateQRCode);
      });


      submit.addEventListener('click', updateQRCode);

    
      </script>
@endsection
