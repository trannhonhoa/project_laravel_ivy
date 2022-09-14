$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function removeRow(id, url) {
    if (confirm("Are you sure")) {
        $.ajax({
            type: "DELETE",
            datatype: "JSON",
            data: { id },
            url: url,
            success: function (res) {
                if (res.error == false) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            },
        });
    }
}
$("#upload").change(function (e) {
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        datatype: "JSON",
        data: form,
        url: "/admin/upload/service",
        success: function (res) {
            console.log(res);
            if (!res.error) {
                $("#image_review").html(
                    `<a href="${res.url}" target="_blank"><img src="${res.url}" width="100px"/></a>`
                );
                $("#file").val(res.url);
            } else {
                alert("Upload lỗi!");
            }
        },
    });
});
