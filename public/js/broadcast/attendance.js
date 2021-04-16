$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    // window.onload = fetch_all();
    /* Collect all data*/

    function fetch_all() {
        $.ajax({
            url: '/api/attendances',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let i = 0;
                let output = '';
                for (i = 0; i < data.length; i++) {
                    var count = i + 1;
                    var time = new Date(data[i].updated_at);
                    var am_incolor = time.getHours() > 8 ? 'style="color:red"' : '';
                    output += '<tr id="user' + data[i].id + '">' +
                        '<td>' + count + '</td>' +
                        '<td>' + data[i].user['fullname'] + '</td>' +
                        '<td>' + data[i].created_at + '</td>' +
                        '<td ' + am_incolor + '>' + time.getHours() + ':' + time.getMinutes() + '</td>'
                    '</tr>';
                }
                $('#attendance').html(output);
            },
            error: function (data) {
                alert('Error:', data);
            }
        });
    }

    /*  When student click add student button */
    $('#create-new').click(function () {
        $('#btn-engrave').val("create-student");
        $('#studentForm').trigger("reset");
        $('#userCrudModal').html("Add New student");
        $('#modal_attendance').modal('show');
    });
    /* When click edit student */
    $('body').on('click', '#edit', function () {
        var user_id = $(this).data('id');
        $.get('/api/attendances/' + user_id, function (data) {
            $('#userCrudModal').html("Edit student");
            $('#btn-engrave').val("edit-student");
            $('#modal_attendance').modal('show');
            $('#id').val(data.id);
            $('#fname').val(data.fname);
            $('#mname').val(data.mname);
            $('#lname').val(data.lname);
            $('#DOB').val(data.DOB);
            $('#level').val(data.level);
            $('#phone').val(data.phone);
            $('#gender').val(data.gender);
            $('#email').val(data.email);
        })
    });
    // CREATE and UPDATE
    $("#btn-engrave").on('click', function (e) {
        e.preventDefault();
        var engrave = null;
        var pk = null;
        $.ajax({
            url: '/api/attendances/',
            type: 'POST',
            data: $('#studentForm').serialize(),
            dataType: 'json',
            success: function (data) {
                pk = data.id;
                engrave = '<tr id="user' + data.id + '">' +
                    '<td>' + data.fullname + '</td>' +
                    '<td>' + data.phone + '</td>' +
                    '<td>' + data.DOB + '</td>' +
                    '<td>' +
                    '<a href="javascript:void(0)" id="edit-student" data-id="' + data.id + '" class="btn btn-info">Edit</a>' +
                    '</td>';
                $('#studentForm').trigger("reset");
                $('#modal_attendance').modal('hide');
                $('#btn-save').html('Save Changes');
            },
            statusCode: {
                200: function (response) {
                    $("#attendance" + pk).replaceWith(engrave);
                    alert('Successfully Updated.');
                },
                201: function (response) {
                    $('#attendance').prepend(engrave);
                    alert('Successfully Created.');
                },
                400: function (response) {
                    bootbox.alert('<span style="color:Red;">Error While Saving Outage Entry Please Check</span>', function () { });
                },
                404: function (response) {
                    bootbox.alert('<span style="color:Red;">Error While Saving Outage Entry Please Check</span>', function () { });
                }
            },
            error: function (data) {
                alert('Error:', data);
            }
        });
    });
    //delete student login
    $('body').on('click', '.delete-student', function () {
        var pk = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "DELETE",
                url: "/api/attendances/" + pk,
                success: function (data) {
                    $("#user" + pk).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
