jQuery('[name="template"]').change(function () {
    tinymce.remove();
    $.get("/page/template", {
        template: this.value,
        // locale_id: locale_id
    }, function (data) {
        jQuery(".page-template-fields").html(data);
        tinymce.init({
            selector: '#content'
        });
    }).fail(function (data) {
        jQuery(".page-template-fields").html("");
        //toastr.error(data.responseJSON.message, "Error");
    });
});
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$("body").on("change", ".media-upload-image", function (e) {
    var file_data = $(this).prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append('page_id', jQuery('#page_id').val())
    var _this = jQuery(this);
    $.ajax({
        url: "/media/upload", // <-- point to server-side PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        success: function (php_script_response) {
            console.log("php_script_response", php_script_response)
            let url = php_script_response.data.data.url;
            let id = php_script_response.data.data.id;
            let page_id = php_script_response.data.data.page_id;
            jQuery('#page_id').val(page_id)
            _this.next().remove();

            _this.val('');
            jQuery('[name="' + _this.data("bind") + '"]').val(id);
            _this.after(
                '<div class="preview-image-body"><span class="upload-image-remove" data-image-id="' + id + '"><i class="anticon anticon-close-circle"></i></span><img src="' +
                url +
                '"  class="img-thumbnail mt-2" style=" width: 200px; height: 200px;object-fit: contain; "/></div>'
            );
        },
    });
});


$(document).on('click', '.insert-edit-link-modal', function () {
    jQuery('.insert-edit-link-modal').removeClass("insert-edit-link-open")
    jQuery(this).addClass("insert-edit-link-open")
    $('#staticBackdrop').modal('show')
})

$(document).on('show.bs.modal', '#staticBackdrop', function () {
    var _this = jQuery('.insert-edit-link-open')
    jQuery('#insert-edit-link')[0].reset()
    var _data = _this.attr("data-value");
    console.log("_data", _data)
    if (_data)
    {
        if (typeof _data == 'string')
        {
            _data = JSON.parse(_data)
        }
        $("#staticBackdrop").find("#insert-edit-link").find("#anchor_title").val(_data.title);
        $("#staticBackdrop").find("#insert-edit-link").find("#anchor_link").val(_data.link);
        $("#staticBackdrop").find("#insert-edit-link").find("#anchor_target").prop("checked", _data.target == "on" ? true : false);
    }

})

$(document).on('click', '#add-link', function () {
    var _this = jQuery('#staticBackdrop')
    var fieldName = jQuery('.insert-edit-link-open').attr('data-name')
    var formDataTarget = JSON.stringify(getFormData(_this.find("#insert-edit-link")));
    jQuery('[name="' + fieldName + '"]').val(formDataTarget);
    jQuery('.insert-edit-link-open').attr('data-value', formDataTarget)
    jQuery('#insert-edit-link')[0].reset()
    $('#staticBackdrop').modal('hide')
    jQuery('.insert-edit-link-modal').removeClass("insert-edit-link-open")
})


function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n["name"]] = n["value"];
    });
    return indexed_array;
}


$(document).ready(function () {
    $('input[name="name"]').keyup(function () {
        var Text = $(this).val();
        Text = Text.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        $('input[name="slug"]').val(Text);
    });
});

function readURL(input) {
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
    $('#blahdiv').show();
}
