import * as Helper from "./helpers.js"

(function () {
    "use strict";
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader--hidden");

        // loader.addEventListener("transitionend", () => {
        //     document.body.removeChild(loader);
        // });
    });


    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

    $(document).on("click", ".form-confirm", function (event) {
        event.preventDefault();
        let form = $($(this).data("form-id"));
        let title = form.data("swal-title");
        let text = form.data("swal-text");
        console.log($(this).data("formid"));

        swal({
            title: title,
            text: text,
            icon: "warning",
            buttons: [form.data("no"), form.data("yes")],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal(form.data("success-msg"), {
                        icon: "success",
                    });
                    setTimeout(function () {
                        form.submit();
                    }, 1000);
                } else {

                }
            });
    });

    // Show Uploaded Photo
    $(".show-uploaded").on("change", function () {
        let imgsContainerClass = $(this).data("imgs-container-class");

        if ($(this).data("upload-type") == "single") {
            let imgBox = document.createElement("div");
            imgBox.classList.add(["img-container"]);
            let img = document.createElement("img");
            let iframe = document.createElement("iframe");
            let video = document.createElement("video");
            let source = document.createElement("source");
            var reader = new FileReader();
            var extension = this.files[0].name.split('.').pop().toLowerCase();


            reader.onload = function (e) {
                if (extension === "pdf") {
                    iframe.setAttribute("src", e.target.result);
                    iframe.setAttribute("width", '100%');
                    iframe.setAttribute("height", '250');
                } else if (extension === "docx") {
                    iframe.setAttribute("src", e.target.result);
                    iframe.setAttribute("width", '100%');
                    iframe.setAttribute("height", '200');
                } else if (extension === "mp4") {
                    video.setAttribute('width', "320");
                    video.setAttribute('height', "240");
                    video.setAttribute("controls", "controls");
                    video.setAttribute("autoplay", "true");
                    video.setAttribute("src", e.target.result);
                } else if (extension === "mov") {
                    video.setAttribute('width', "320");
                    video.setAttribute('height', "240");
                    video.setAttribute("controls", "controls");
                    video.setAttribute("autoplay", "true");
                    video.setAttribute("src", e.target.result);
                } else {
                    img.setAttribute("src", e.target.result);
                }
            }
            reader.readAsDataURL(this.files[0]);

            if (extension === "pdf") {
                imgBox.appendChild(iframe);
            } else if (extension === "mp4") {
                imgBox.appendChild(video);
            } else if (extension === "mov") {
                imgBox.appendChild(video);
            } else {
                imgBox.appendChild(img);
            }

            imgBox.style.display = "none";
            imgBox = $(imgBox);
            $("." + imgsContainerClass).empty().append(imgBox);
            imgBox.fadeIn();
        } else if ($(this).data("upload-type") == "multi") {
            let container = $("." + imgsContainerClass);
            container.empty();
            for (let index = 0; index < this.files.length; index++) {
                let imgBox = document.createElement("div");
                imgBox.classList.add(["img-container"]);
                let img = document.createElement("img");
                let iframe = document.createElement("iframe");
                let video = document.createElement("video");
                let source = document.createElement("source");
                var reader = new FileReader();
                var extension = this.files[index].name.split('.').pop().toLowerCase();
                reader.onload = function (e) {
                    if (extension === "pdf") {
                        iframe.setAttribute("src", e.target.result);
                        iframe.setAttribute("width", '100%');
                        iframe.setAttribute("height", '200');
                    } else if (extension === "docx") {
                        iframe.setAttribute("src", e.target.result);
                        iframe.setAttribute("width", '100%');
                        iframe.setAttribute("height", '200');
                    } else if (extension === "mp4") {
                        video.setAttribute('width', "320");
                        video.setAttribute('height', "240");
                        video.setAttribute("controls", "controls");
                        video.setAttribute("autoplay", "true");
                        video.setAttribute("src", e.target.result);
                    } else if (extension === "mov") {
                        video.setAttribute('width', "320");
                        video.setAttribute('height', "240");
                        video.setAttribute("controls", "controls");
                        video.setAttribute("autoplay", "true");
                        video.setAttribute("src", e.target.result);
                    } else {
                        img.setAttribute("src", e.target.result);
                    }
                }
                reader.readAsDataURL(this.files[index]);
                if (extension === "pdf") {
                    imgBox.appendChild(iframe);
                } else if (extension === "mp4") {
                    imgBox.appendChild(video);
                } else if (extension === "mov") {
                    imgBox.appendChild(video);
                } else {
                    imgBox.appendChild(img);
                }
                imgBox.style.display = "none";
                imgBox = $(imgBox);
                container.append(imgBox);
                imgBox.fadeIn();
            }
        }
    });


    $(document).on("click", ".box-checking-container .box-checking .select-all", function () {
        let allBoxes = $(this).parent().siblings(".box-checking")

        if ($(this).is(":checked")) {
            allBoxes.children("input[type=checkbox]").prop("checked", true)
        } else {
            allBoxes.children("input[type=checkbox]").prop("checked", false)
        }
    })

    $(document).on("click", ".box-checking-container .box-checking input.checkbox", function () {
        let allBoxes = $(this).parent().siblings(".box-checking")
        let inputsLength = allBoxes.children("input[type=checkbox].checkbox").length,
            inputsCheckedLength = allBoxes.children("input[type=checkbox].checkbox:checked").length

        if (!$(this).prop("checked"))
            inputsCheckedLength--
        console.log(inputsCheckedLength, inputsLength)
        if (inputsLength === inputsCheckedLength)
            $(".box-checking-container .box-checking .select-all").prop("checked", true)
        else
            $(".box-checking-container .box-checking .select-all").prop("checked", false)

    })


    $("input[type=checkbox].checked-action").on("click", (e) => {

        const isChecked = e.target.hasAttribute("checked")
        if (!isChecked)
            e.target.setAttribute("checked", 'checked')
        else
            e.target.removeAttribute("checked")
    })

    $(document).on("click", "input[type=checkbox].checked-creator-action", (e) => {

        const isChecked = e.target.hasAttribute("checked")
        if (!isChecked)
            e.target.setAttribute("checked", 'checked')
        else
            e.target.removeAttribute("checked")
    });

    $(document).ready(function (e) {
        $(".togglePassword").click(function (e) {
            e.preventDefault();
            var type = $(this).parent().parent().find(".password").attr("type");
            if (type == "password") {
                $(this).parent().parent().find(".eye").removeClass('fa fa-eye');
                $(this).parent().parent().find(".eye").addClass('fa fa-eye-slash');
                $(this).parent().parent().find(".password").attr("type", "text");
            } else if (type == "text") {
                $(this).parent().parent().find(".eye").removeClass('fa fa-eye-slash');
                $(this).parent().parent().find(".eye").addClass('fa fa-eye');
                $(this).parent().parent().find(".password").attr("type", "password");
            }
        });
    });

})();
