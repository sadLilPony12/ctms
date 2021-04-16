$(document).ready(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    /* Collect all data*/
    function fetch_all() {
        $.ajax({
            url: '/api/newsflash/broadcast',
            method: 'GET',
            dataType: 'json',
            success: function (data) {

                output = '';
                for (i = 0; i < data.length; i++) {
                    output += '<div class="card">' +
                        '<div class="card-header">' +
                        data[i].reporter['fullname'] + '<br>' +
                        '<small>' + data[i].reporter['role'] + '</small>' +
                        '<button class="dropdown-toggle float-right" data-toggle="dropdown" aria-expanded="false" style="">' +
                        '...' +
                        '</button>' +
                        '<ul class="dropdown-menu">' +
                        '<li><a class="dropdown-item clearfix" href="javascript:;" id="edit" data-id="' + data[i].id + '">Edit</a></li>' +
                        '<li><a class="dropdown-item" href="javascript:;" id="delete" data-id="' + data[i].id + '">Delete</a></li>' +
                        '</ul>' +
                        '</div>' +
                        '<img src="./../images/newsflash/' + data[i].avatar + '" class="card-img-top" alt="...">' +
                        '<div class="card-body">' +
                        '<h4 class="card-title">' + data[i].title + '</h4>' +
                        '<p class="card-text">' + data[i].message + '</p>' +
                        '</div>' +
                        '</div>' +
                        '<div class="card-footer text-muted">' +
                        '<label>Start :' + data[i].start + '</label><br>' +
                        '<label>End :' + data[i].end + '</label><br>' +
                        '<label>Created :' + data[i].created_at + '</label><br>' +
                        '</div>' +
                        '</div>';
                }
                $('#newsflash').html(output);
            },
            error: function (data) {
                alert('Error:', data);
            }
        });
    }
    window.onload = fetch_all();
    /*  When newsflash click add newsflash button */
    $('#create').click(function () {
        alert('sample');
        $('#btn-engrave').val("create");
        $('#newsflashForm').trigger("reset");
        $('#modal_newsflash').modal('show');
    });
    /* When click edit newsflash */
    $('body').on('click', '#edit', function () {
        var newsflash_id = $(this).data('id');
        $.get('/api/newsflash/' + newsflash_id, function (data) {
            $('#userCrudModal').html("Edit News Flash");
            $('#btn-engrave').val("edit");
            $('#modal_newsflash').modal('show');
            $('#id').val(data.id);
            $('#avatar').val(data.avatar);
            $('#title').val(data.title);
            $('#message').val(data.message);
            $('#start').val(data.start);
            $('#end').val(data.end);
        })
    });
    // CREATE and UPDATE
    $("#btn-engrave").click(function (e) {
        alert('yes');
        e.preventDefault();
        var engrave = null;
        var pk = null;
        $.ajax({
            url: '/api/newsflash/',
            type: 'POST',
            data: $('#newsflashForm').serialize(),
            dataType: 'json',
            success: function (data) {
                pk = data.id;
                engrave = '<tr id="newsflash' + data.id + '"><td>' + data.avatar + '</td><td>' + data.title + '</td><td>' + data.user + '</td><td>' + data.message + '</td><td>' + data.start + '</td><td>' + data.end + '</td>' +
                    '<td><a href="javascript:void(0)" id="edit" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>' +
                    '<td><a href="javascript:void(0)" id="delete" data-id="' + data.id + '" class="btn btn-danger delete">Delete</a></td></tr>';
                $('#newsflashForm').trigger("reset");
                $('#modal_newsflash').modal('hide');
                $('#btn-save').html('Save Changes');
            },
            statusCode: {
                200: function (response) {
                    $("#newsflash" + pk).replaceWith(engrave);
                    alert('Successfully Updated.');
                },
                201: function (response) {
                    $('#newsflash').prepend(engrave);
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
    $('body').on('click', '.delete', function () {
        var pk = $(this).data("id");

        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "DELETE",
                url: "/api/newsflash/" + pk,
                success: function (data) {
                    $("#newsflash" + pk).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
