import fetch from '../../modules/ctms.js';

$('body').on('click', '.btn-find', async (e) => state.show($(e.currentTarget).data('index')));
$('body').on('click', '.btn-delete', (e) => state.destroy($(e.currentTarget).data("index")));
$('body').on('click', '.btn-demote', (e) => state.onDemote($(e.currentTarget).data("id")));
$('body').on('click', '#ban-user', (e) => state.onBan($(e.currentTarget).data("index")));


const state = {
    /* [Table] */
    entity: {
        name: 'admin',
        attributes: ['name', 'email'],
        actions: {
            demote: ['notika-icon notika-down-arrow', 'Demote to citizen', 'warning'],
            find: ['notika-icon notika-search', 'View information', 'info'],
            delete: ['notika-icon notika-close', 'Ban', 'danger']
        },
        baseUrl: 'api'
    },
    /* [Object Mapping] */
    models: [],
    /* [Tag object] */
    btnKey: document.getElementById("key"),
    // btnLook: document.getElementById("look"),
    // btnNew: document.getElementById("btn-new"),
    // Userid: document.getElementById("id"),
    role: document.getElementById("role_id").value,
    btnEngrave: document.getElementById("ban-user"),
    // uid: document.getElementById("uid"),
    // btnEdit: document.getElementById("btn-edit"),
    activeIndex: 0,
    btnUpdate: null,
    btnDelete: null,
    /* [initialized] */
    init: () => {
        // Attach listeners
        state.btnKey.addEventListener("keyup", state.ask);
        state.btnKey.disabled = false;
        // state.btnLook.addEventListener("click", state.ask);
        // state.btnLook.disabled = false;
        // state.btnNew.addEventListener("click", state.create);
        // state.btnNew.disabled = false;

        state.ask();

        // const loader = document.querySelector(".loader");
        // loader.className += " hidden";
    },
    /* [ACTIONS] */
    ask: async () => {

        state.models = await fetch.translate(state.entity, { key: state.btnKey.value });
        if (state.models) {
            state.models.forEach(model => fetch.writer(state.entity, model));
            if (state.role == 2) {
                $('.btn-demote').remove();
                $('.btn-delete').remove();
            }
        }
    },
    create: () => {
        state.btnEngrave.innerHTML = "Save";

        state.btnEngrave.removeEventListener("click", state.update);
        state.btnEngrave.addEventListener('click', state.store);
        fetch.showModal()
    },
    show: (i) => {
        $('#profile_picture').attr('src', `../images/avatar/${state.models[i].profile_picture}`);
        state.activeIndex = i;

        fetch.showOnModal(state.models[i]);
    },
    store: async (e) => {
        e.preventDefault();
        let params = $('#set-Model').serializeArray();
        let model = await fetch.store(state.entity, params);
        if (model) {
            state.models.push(model)
            fetch.writer(state.entity, model);
            $('#modal-main').modal('hide');
        }
    },

    find: async () => {
        state.uid = $('#uid').val()
        await fetch.ask(`./../../api/users/${state.uid}/look`);

        $('#').val(state.uid);

    },
    onDemote: async (i) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "Don't worry, you can revert this.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes demote it!`
        }).then(async (result) => {
            if (result.isConfirmed) {
                let params = [{ name: 'role_id', value: 3 }];
                let model = await fetch.update(state.entity, i, params);
                if (model) {
                    state.ask();
                }
            }
        })
    },
    onBan: async (i) => {
        // let params = {name:'reason', value:$('#reason').val()}
        let pk = state.models[i].id
        // await fetch.update(state.entity, pk, params)

        // let ans = await fetch.destroy(state.entity, pk, params);
        // if (ans) {
        //     state.models.splice(i, 1);
        // }
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `./../api/users/${pk}/destroy`,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: { reason: $('#reason').val() },
                    success: function () {
                        state.models.splice(i, 1);
                        $(`#model-${pk}`).remove();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#modal-ban').modal('hide');
                    }

                });
            }
        })


    },
    destroy: async (i) => {

        // fetch.showOnBan(state.models[i]);
        $('#modal-ban').modal('show');
        $('#ban-user').attr('data-index', i);
    },
};

window.addEventListener("load", state.init);