import fetch from '../../modules/ctms.js';

$('body').on('click', '.btn-find', async (e) => state.show($(e.currentTarget).data('index')));
$('body').on('click', '#engraveU', (e) => state.update($(e.currentTarget).data('id')));

const state = {
    /* [Table] */
    entity: {
        name: 'user_item',
        attributes: ['num', 'brgy', 'purok', 'street', 'phone'],
        actions: {
            find: ['fa fa-pencil-alt', 'Edit', 'info'],
            delete: ['fa fa-trash', 'Delete', 'danger']
        },
        baseUrl: 'api'
    },
    /* [Object Mapping] */
    models: [],
    /* [Tag object] */
    // btnKey: document.getElementById("key"),
    // btnLook: document.getElementById("look"),
    user: document.getElementById("user-id"),
    item: document.getElementById("id"),
    btnEngrave: document.getElementById("engrave"),
    activeIndex: 0,
    btnUpdate: null,
    btnDelete: null,
    /* [initialized] */
    init: () => {
        // Attach listeners

        state.btnEngrave.addEventListener('click', state.update);

    },
    /* [ACTIONS] */
    ask: async () => {
        state.models = await fetch.translate(state.entity, { user: state.user.value });
        if (state.models) {
            state.models.forEach(model => fetch.writer(state.entity, model));
        }
    },

    create: () => {
        state.btnEngrave.innerHTML = "Save";
        $('#user').val(state.user.value);

        state.btnEngrave.removeEventListener("click", state.update);
        state.btnEngrave.addEventListener('click', state.store);
        fetch.showModal()
    },
    show: (i) => {
        state.activeIndex = i;
        state.btnEngrave.innerHTML = "Update";

        state.btnEngrave.removeEventListener("click", state.store);
        state.btnEngrave.addEventListener('click', state.update);
        state.btnEngrave.setAttribute('data-id', state.models[i].id);
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
    update: async (company_id) => {
        let params = [
            { name: 'company_id', value: company_id },
            { name: 'id', value: state.item.value }
        ];
        let pk = state.item.value;
        let model = await fetch.update(state.entity, pk, params);

        if (model) {
            location.replace('../company')
        }
    },
    destroy: async (i) => {
        let pkey = state.models[i].id;
        let ans = await fetch.destroy(state.entity, pkey);
        if (ans) {
            state.models.splice(i, 1);
        }
    }
};

window.addEventListener("load", state.init);
