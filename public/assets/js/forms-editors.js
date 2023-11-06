$(document).ready(function () {
    let quill = new Quill("#editor", {
        modules: {
            clipboard: true,
            toolbar: [
                ["bold", "italic"],
                ["link", "blockquote"],
                [{ list: "ordered" }, { list: "bullet" }],
            ],
        },
        placeholder: "Tuliskan catatan anda..",
        theme: "snow",
    });

    var fileInput = document.getElementById("fileInput");
    quill.on("paste", function (e) {
        if (e.clipboardData && e.clipboardData.items) {
            for (var i = 0; i < e.clipboardData.items.length; i++) {
                var item = e.clipboardData.items[i];
                if (item.type.indexOf("image") !== -1) {
                    var file = item.getAsFile();
                    fileInput.files = new DataTransfer();
                    fileInput.files.items.add(file);
                }
            }
        }
    });

    quill.on("text-change", function (delta, oldDelta, source) {
        $("#content").text($(".ql-editor").html());
    });
});