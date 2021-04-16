import fetch from '../../modules/ctms.js';

$('body').on('click', '#engraveU', async (e) => state.onStored($(e.currentTarget).data('index')));
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
    user: document.getElementById("user-id"),
    role: document.getElementById("role-id").value,
    btnNew: document.getElementById("btn-new"),
    btnEngrave: document.getElementById("iengrave"),
    activeIndex: 0,
    btnUpdate: null,
    btnDelete: null,
    /* [initialized] */
    init: () => {
        // Attach listeners
        state.btnEngrave.addEventListener('click', state.onStored);
    },
    /* [ACTIONS] */

    onStored: async (e) => {
        // e.preventDefault();
        let params = $('#let-Model').serializeArray();

        Swal.fire({
            title: 'Note',
            text: "You won't be able to update this again!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed'
        }).then(async (result) => {

            if (result.value) {
                let model = await fetch.store(state.entity, params);
                if (model) {
                    state.models.push(model)
                    fetch.writer(state.entity, model);

                    if (state.role == 2) {
                        location.replace('../admin/article')
                    } else {
                        location.replace('../user/article')
                    }
                }
            }
        })

    },

};

window.addEventListener("load", state.init);