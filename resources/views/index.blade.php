<!DOCTYPE html>
<html>
<head>
    <title>Drag and Drop file upload with Dropzone in Laravel 8</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- JS -->
    <script src="https://unpkg.com/dropzone@5.9.3/dist/min/dropzone.min.js" ></script>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">

</head>
<body>

<div class='content'>
    <!-- Dropzone -->
    <form action="{{route('uploadFile')}}" class='dropzone' ></form>
</div>

<!-- Script -->
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{
        maxFilesize: 2, // 2 mb
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
    });
    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("_token", CSRF_TOKEN);
    });
    myDropzone.on("success", function(file, response) {

        if(response.success == 0){ // Error
            alert(response.error);
        }

    });
</script>

</body>
</html>
