<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Dropzone Example</title>

    <!-- Include Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Dropzone JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <style>
        /* Customize Dropzone appearance */
        .dropzone {
            border: 2px dashed #0087F7;
            background: #F0F8FF;
            border-radius: 8px;
            margin: 20px;
            min-height: 150px;
            padding: 20px;
        }

        .dz-message {
            font-size: 20px;
        }

        .dz-preview {
            margin: 10px;
            border-radius: 8px;
            overflow: hidden;
        }

        .dz-image img {
            width: 100%;
            height: auto;
        }

        .dz-details {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .dz-filename {
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dz-progress {
            height: 10px;
            margin: 10px 0;
            background: #D3D3D3;
            border-radius: 5px;
            overflow: hidden;
        }

        .dz-upload {
            background: #0087F7;
            width: 0;
            height: 100%;
            border-radius: 5px;
            transition: width 0.3s ease-in-out;
        }

        .dz-success-mark, .dz-error-mark {
            display: none;
        }

        .dz-error-message {
            margin: 10px;
            color: #FF0000;
        }
    </style>
</head>
<body>

    <form id="my-dropzone" class="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

    <script>
        // Dropzone configuration
        Dropzone.autoDiscover = false;

        $(document).ready(function () {
            // Initialize Dropzone
            var myDropzone = new Dropzone("#my-dropzone", {
                url: "/upload", // Replace with your server-side upload endpoint
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 5, // MB
                maxFiles: 5, // Maximum number of files
                acceptedFiles: ".jpeg,.jpg,.png", // Allowed file types
                dictDefaultMessage: "Drop files here or click to upload",
                addRemoveLinks: true,
                init: function () {
                    this.on("success", function (file, response) {
                        // Handle successful uploads
                        console.log("File uploaded:", file);
                        console.log("Server response:", response);
                    });

                    this.on("removedfile", function (file) {
                        // Handle file removal
                        console.log("File removed:", file);
                    });

                    this.on("error", function (file, errorMessage) {
                        // Handle errors during the upload
                        console.error("Error uploading file:", file, errorMessage);
                    });
                }
            });
        });
    </script>

</body>
</html>
