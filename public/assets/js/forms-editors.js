$(document).ready(function () {
    let quillCreate = new Quill("#editorCreate", {
        modules: {
            clipboard: true,
            toolbar: [
                [
                    {
                        size: ["small", false, "large", "huge"],
                    },
                ],
                [
                    {
                        font: [false],
                    },
                ],
                ["bold", "italic", "underline", "strike"],
                [
                    {
                        script: "sub",
                    },
                    {
                        script: "super",
                    },
                ],
                [
                    {
                        list: "ordered",
                    },
                    {
                        list: "bullet",
                    },
                ],
                [
                    {
                        align: [],
                    },
                ],
            ],
        },
        placeholder: "Tuliskan catatan anda..",
        theme: "snow",
    });

    quillCreate.on("text-change", function (delta, oldDelta, source) {
        $("#contentCreate").text($(".ql-editor").html());
    });
});
