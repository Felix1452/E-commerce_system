$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id, url) {
    if (confirm('Xóa vĩnh viễn! Vui lòng xác nhận ?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

function changeMotor(mobile){
    const img = document.getElementById("img_motor").src;
    if (img == "http://127.0.0.1:8000/storage/img/motor_off.png"){
        document.getElementById("img_motor").src = "http://127.0.0.1:8000/storage/img/motor_on.png";
        document.getElementById("dot_motor").style.backgroundColor = "red";

        var status = "on";
        var mobile = "0" + mobile + "";
        // console.log(mobile);
        var url = '/api/turn-on-off-motor';
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: { status, mobile },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    // alert("Khởi động thành công");
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })

    }else {
        document.getElementById("img_motor").src = "http://127.0.0.1:8000/storage/img/motor_off.png";
        document.getElementById("dot_motor").style.backgroundColor = "#BBBBBBFF";

        var url = '/api/turn-on-off-motor';
        var status = "off";
        var mobile = "0" + mobile + "";
        // console.log(mobile);
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: { status, mobile },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    // alert("Đã tắt thiết bị");
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

function changeMotorAuto(mobile){
    const img = document.getElementById("img_motor_auto").src;
    if (img == "http://127.0.0.1:8000/storage/img/motor_auto_off.png"){
        document.getElementById("img_motor_auto").src = "http://127.0.0.1:8000/storage/img/motor_auto_on.png";
        document.getElementById("dot_auto_motor").style.backgroundColor = "red";
        var status = "on_auto";
        var mobile = "0" + mobile + "";
        // console.log(mobile);
        var url = '/api/auto-turn-on-off-motor';
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: { status, mobile },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    // alert("Khởi động thành công");
                } else {
                    alert(result.message);
                }
            }
        })
    }else {
        document.getElementById("img_motor_auto").src = "http://127.0.0.1:8000/storage/img/motor_auto_off.png";
        document.getElementById("dot_auto_motor").style.backgroundColor = "#BBBBBBFF";
        var status = "off_auto";
        var mobile = "0" + mobile + "";
        // console.log(mobile);
        var url = '/api/auto-turn-on-off-motor';
        $.ajax({
            type: 'POST',
            datatype: 'JSON',
            data: { status, mobile },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    // alert("Đã tắt thiết bị");
                } else {
                    alert(result.message);
                }
            }
        })
    }
}




/*Upload File */
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            if (results.error === false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" style="border-radius: 5%; max-width: 30vmax; max-height: 30vmax""></a>');

                $('#thumb').val(results.url);
            } else {
                alert('Upload File Lỗi');
            }
        }
    });
});

