import fetch from '../../modules/ctms.js';

$('body').on('click', '.btn-find', async (e) => state.show($(e.currentTarget).data('index')));
$('body').on('click', '#ban-user', (e) => state.onBan($(e.currentTarget).data("index")));


const state = {
    /* [Table] */
    entity: {
        name: 'user',
        attributes: ['name', 'email'],
        actions: {
            find: ['notika-icon notika-search', 'View information', 'info'],
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

        state.ask();
    },
    /* [ACTIONS] */
    ask: async () => {

        state.models = await fetch.translate(state.entity, { key: state.btnKey.value });
        if (state.models) {
            state.models.forEach(model => fetch.writer(state.entity, model));

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
};

window.addEventListener("load", state.init);