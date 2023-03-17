@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div style="text-align: center;">
                    <img style="margin:10px 0 0 0;object-fit: cover;max-width: 100%;" src="/assets/images/policy.jpg" alt="">
                </div>
                <div class="u-layout-row shadow text">
                    <h3>Currently our available services include:</h3>
                    <p>Word to PDF format: Convert from .docx to .pdf file, with fully converted content, tables, images.</p>
                    <p>PDF to Text format: Convert from .pdf to .txt file, with content, tables are fully converted successfully.</p>
                    <p>Text to Json format: Convert from .txt file to .json, with converted content and sorted by fully converted Keys successfully.</p>
                    <h3>Here are a few things to keep in mind when you use our services:</h3>
                    <h4>File Size Limitations</h4>
                    <p>We have a file size limit of 2MB for all files uploaded to our website. Files larger than 2MB will not be accepted for conversion.</p>
                    <h4>File Format Limitations</h4>
                    <p>We accept files that do not contain any encoding. If your PDF file contains any encryption or encoding, it will not be accepted for conversion. We still trying to develop our project more and we will soon release updating to upgrade your experience.</p>
                    <h5>Word to PDF format:</h5>
                    <p>1. The image in your Word file must be added by INSERT from the folder, copying the image and then adding it will make the image conversion impossible to complete.</p>
                    <p>2. The font of the PDF file will be converted to Calibri Light.</p>
                    <p>3. Format of Heading and Title, Spacing and Column is currently in the process of figuring out how to handle.</p>
                    <h5>PDF to Text format:</h5>
                    <p>Tables will be read in columns.</p>
                    <h5>Format Text to Json:</h5>
                    <p>The Json file will take the first line before the ":" to be the Key and until the next Key is encountered, it will take what is between the two to make the Key-Value</p>
                    <h4>File Retention and Deletion </h4>
                    <p>All PDF files uploaded for conversion are automatically deleted from our servers immediately after the conversion process is complete. We do not store any copies of your files.</p>
                    <p>Currently we are still in the process of developing this project, if there are any shortcomings, please ignore and give feedback so that we can improve the user experience for you.
                        If you have any suggestions, please contact Contact@t4tek.co. We will respond to your request as soon as possible</p>
                </div>
            </div>
        </div>
</section>
<style>
    .u-layout-row>h3 {
        margin: 15px 0 15px 0 !important;
        padding: 0 15px 0 15px !important;
    }

    .u-layout-row>h4 {
        margin-bottom: 0 !important;
        padding: 0 15px 0 15px !important;

    }

    .text {
        display: block !important;
        margin-bottom: 15px !important;
    }

    .u-layout-row>h5 {
        margin-bottom: 0 !important;
        padding: 0 15px 0 15px !important;
    }

    .u-layout-row>p {
        padding: 0 15px 10px 15px !important;
        margin: 0 !important;
        color: black !important;
    }
</style>
@endsection