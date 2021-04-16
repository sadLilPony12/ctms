$(document).ready(function() {
    var pw = $('#session').val();
    $.ajax({
        cache: false,
        success: function() {
            // Do something with the result
            if (pw != "") {
                $('#change-pass').modal('show');
            }
        }
    });
});

import fetch from './../../modules/ctms.js';
$('body').on('click', '#btn-edit', (e) => state.onUpdate($(e.currentTarget).data("id")));
$('body').on('click', '#profile', (e) => state.find($(e.currentTarget).data("index")));
$('body').on('click', '#change', (e) => state.onShow());
// $('body').on('click', '#changed', (e) => state.changePass());





const state = {

    entity: { name: 'user', baseUrl: 'api' },
    models: [],
    uid: document.getElementById("uid"),
    btnEdit: document.getElementById("btn-edit"),
    btnChange: document.getElementById("changed"),
    btnUpdate: null,
    /* [initialized] */

    find: async() => {
        state.uid = $('#uid').val()
        const user = await fetch.ask(`./../../api/users/${state.uid}/look`);
        console.log(user.profile_picture);
        $('#image').attr('src', `../images/avatar/${user.profile_picture}`);
        $('#Name').val(user.name);
        $('#Phone').val(user.phone);
        $('#Fname').val(user.fname);
        $('#Mname').val(user.mname);
        $('#Lname').val(user.lname);
        $('#AddR').val(user.addR);
        $('#AddP').val(user.addP);
        $('#AddC').val(user.addC);
        $('#modal-edit').modal('show');
        $('#btn-edit').val(state.uid);

    },

    onUpdate: async() => {
        let params = $('#profiles-Model').serializeArray();
        let pk = state.btnEdit.getAttribute('data-id');
        let model = await fetch.update(state.entity, pk, params);
        if (model) {
            location.replace('/admin/article')
            $('#modal-main').modal('hide');
        }

    },

    onShow: async() => {
        Swal.fire({
            title: 'WARNING!',
            text: "If you start to change your password you need to finish them",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change Password',
        }).then((result) => {
            if (result.value) {
                $('#change-pass').modal('show');
            }
        })

    },
    onBan: async(pk) => {
        let params = $('#set-Model').serializeArray();
        let model = await fetch.update(state.entity, pk, params);

        if (model) {
            state.models[state.activeIndex] = model
            fetch.writer(state.entity, model);

            $('#modal-ban').modal('hide');
        }
    },
    destroy: async(i) => {

        // fetch.showOnBan(state.models[i]);
        $('#modal-ban').modal('show');
        $('#ban-user').attr('data-id', state.models[i].id);
    },

    changePass: () => {
        let pass = $('#password').val()
        if (pass != null) {
            let npass = $('#npassword').val()
            let cnpass = $('#cnpassword').val()
            if (npass === cnpass) {
                alert('new pass has been activated')
                state.passUpdate(npass)
            } else {
                alert('your  pass didn\'t match ')
            }
        } else if (opass != pass) {
            alert('You have to put your current pass')
        } else {
            alert('put your real pass')
        }
    },
    passUpdate: (pass) => {
        let param = { password: pass }
        console.log(param);
    }

};

window.addEventListener("load", state.init);