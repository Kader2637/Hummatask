// // $(document).ready(function () {
// //     let editors = document.querySelectorAll("#editor-history");

// //     editors.forEach(function (editorElement) {
// //         let quill = new Quill(editorElement, {
// //             modules: {
// //                 clipboard: true,
// //                 toolbar: [
// //                     ["bold", "italic"],
// //                     ["link", "blockquote"],
// //                     [{ list: "ordered" }, { list: "bullet" }],
// //                 ],
// //             },
// //             placeholder: "Tuliskan catatan anda..",
// //             theme: "snow",
// //         });

// //         // let fileInput = editorElement.querySelector(".fileInput");

// //         quill.on("text-change", function (delta, oldDelta, source) {
// //             let allContent = "";
// //             let editorElements = document.querySelectorAll(".ql-editor");

// //             editorElements.forEach(function (editorElement) {
// //                 console.log(editorElement);
// //                 allContent += editorElement.innerHTML;
// //             });

// //             $("#content").html(allContent);
// //         });

// //         quill.on("paste", function (e) {
// //             if (e.clipboardData && e.clipboardData.items) {
// //                 for (let i = 0; i < e.clipboardData.items.length; i++) {
// //                     let item = e.clipboardData.items[i];
// //                     if (item.type.indexOf("image") !== -1) {
// //                         let file = item.getAsFile();
// //                         fileInput.files = new DataTransfer();
// //                         fileInput.files.items.add(file);
// //                     }
// //                 }
// //             }
// //         });
// //     });
// // });

// let editors = document.querySelectorAll("#editor-history");

// editors.forEach(function (editorElement) {
//     $(document).ready(function () {
//         let quill = new Quill(editorElement, {
//             modules: {
//                 clipboard: true,
//                 toolbar: [
//                     ["bold", "italic"],
//                     ["link", "blockquote"],
//                     [{ list: "ordered" }, { list: "bullet" }],
//                 ],
//             },
//             placeholder: "Tuliskan catatan anda..",
//             theme: "snow",
//         });

//         quill.on("text-change", function (delta, oldDelta, source) {
//             $("#content").text($(".ql-editor").html());
//         });

//         quill.on("text-change", function (delta, oldDelta, source) {
//             let allContent = "";
//             let editorElements = document.querySelectorAll(".ql-editor");

//             editorElements.forEach(function (editorElement) {
//                 console.log(editorElement);
//                 $("#content").html(allContent);
//             });
//         });
//     });
// });
