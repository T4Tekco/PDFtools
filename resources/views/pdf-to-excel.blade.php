<form method="POST"  enctype="multipart/form-data">
    @csrf
    <input type="file" name="pdf" />
    <button type="submit">Convert to Excel</button>
</form>
