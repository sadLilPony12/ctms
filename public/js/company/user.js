import fetch from './../modules/ctms.js';

$('body').on('click', '#sa-title', async (e) => state.showCompany());
$('body').on('click', '#btn-upload', async (e) => state.onUpdate($(e.currentTarget).data('id')));
$('body').on('click', '#btn-company', async (e) => state.AddCompany($(e.currentTarget).data('id')));
$('body').on('click', '.approve', async (e) => state.valid($(e.currentTarget).data('approve'), $(e.currentTarget).data('id')));
$('body').on('click', '#company-engrave', async () => state.store());
$('body').on('click', '#btn-engrave', async () => state.validReason());

const state = {
    entity: { name: 'company', baseUrl: 'api' },
    /* [Object Mapping] */
    models: [],
    accept: document.getElementById("approve"),
    reject: document.getElementById("reject"),

    btnKey: document.getElementById("key"),
    /* [Tag object] */
    inputSearch: document.getElementById("key"),
    // btnNew: document.getElementById("btn-new"),
    company: document.getElementById("company"),
    Userid: document.getElementById("user-id"),
    btnEngrave: document.getElementById("company-engrave"),
    RoleId: document.getElementById("role").value,
    /* [initialized] */
    init: () => {
        // Attach listeners
        let company = $('#company-id').val() ? $('#company-id').val() : 'null'

        if (state.RoleId == 3) {
            if (company != 'null') {
                state.has_company();
            }
            state.inputSearch.addEventListener("keyup", state.ask);
            state.inputSearch.disabled = false;
            state.inputSearch.addEventListener("keyup", (e) => {
                // if (e.keyCode === 13) {
                //     state.inputSearch.value;
                //     state.ask();
                // }
            });
            state.inputSearch.disabled = false;

            state.ask();
        } else {
            state.askA();
        }



    },
    /* [ACTIONS] */
    has_company: async () => {
        // if (state.Userid.item.company_id) { }
        await Swal.fire({
            title: 'You already have a company.',
            text: "Want to change or look at company details?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Change',
            cancelButtonText: 'Company Details',
        }).then((result) => {
            if (result.value) {
                // query company
                state.ask();
            } else {
                location.replace('./../company')

            }
        })
    },
    ask: async () => {
        $('#userCompany').empty()
        state.models = await fetch.ask(`./../api/companies/user`, { key: state.inputSearch.value });
        if (state.models.length === 0) {
            state.showCompany();
        }
        state.models.forEach(state.writer);
    },
    askA: async () => {
        $('#companies').empty()
        state.models = await fetch.ask(`./../api/companies`);
        state.models.forEach(state.writeA);
    },
    writeA: (model) => {
        $('<input>', { type: 'hidden', id: `company-${model.id}`, value: model.id, name: `company_id` }).appendTo('#companies');
        let tr = $('<div>', { class: 'email-statis-inner notika-shadow col-md-3 ', id: `company` });
        $('<h2>', { html: $(`<strong>`, { html: model.name }) }).appendTo(tr);
        let box = $('<div>', { class: 'email-ctn-round ' });
        let row = $('<div>', { class: 'email-rdn-hd' });
        let col = $('<div>', { class: 'email-statis-wrap' });
        let body = $('<div>', { class: 'email-rdn-hd' });
        let anchor = $('<a>', { href: '#', id: 'pick' });
        if (model.logo == null) {
            $('<img>', {
                class: 'img-responsive',
                src: './../../../images/company.jpg',
                width: '120px',
                height: '120px'
            }).appendTo(anchor);
        } else {
            $('<img>', {
                class: 'img-responsive',
                src: './../../../images/company/' + model.logo,
                width: '120px',
                height: '120px'
            }).appendTo(anchor);
        }
        anchor.appendTo(body);
        body.appendTo(col);
        col.appendTo(row);


        let col_r = $('<div>', { 'class': 'col-md-6' })
        $('<h6>', { html: $(`<strong>`, { html: model.subname }) }).appendTo(col_r);
        $('<h6>', { html: $(`<strong>`, { html: model.address }) }).appendTo(col_r);
        $('<h6>', { html: $(`<strong>`, { html: model.phone }) }).appendTo(col_r);

        col_r.appendTo(row);
        let colE = $('<div>', { class: 'email-round-gp' });
        let colR = $('<div>', { class: 'email-round-pro' });
        let colT = $('<div>', { class: 'email-ctn-nock' });
        // let br = $(`<br>`)
        // br
        // br
        $('<button>', {
            'data-toggle': 'tooltip',
            'data-placement': 'top',
            id: 'approve',
            'data-approve': 1,
            // value:1,
            title: 'Approve',
            class: 'btn btn-info info-icon-notika approve',
            'data-id': model.id,
            html: $('<i>', { class: "notika-icon notika-checked" })
        }).appendTo(colT);
        $('<button>', {
            'data-id': model.id,
            'data-toggle': 'tooltip',
            type: 'submit',
            'data-placemen': 'bottom',
            'data-approve': 0,
            id: 'reject',
            // value:0,
            title: 'Reject',
            class: 'btn btn-danger danger-icon-notika approve',
            'data-id': model.id,
            html: $('<i>', { class: 'notika-icon notika-close' })
        }).appendTo(colT);
        colT.appendTo(colR);
        colR.appendTo(colE);
        colE.appendTo(row);
        row.appendTo(box);
        box.appendTo(tr);
        $('#companies').append(tr);
    },
    writer: (model) => {
        $('<input>', { type: 'hidden', id: `company-${model.id}`, value: model.id, name: `company_id` }).appendTo('#userCompany');
        //header
        let divh = $('<div>', { style: "height:600px", class: "col-lg-4 col-md-6 col-sm-6 col-xs-12", id: `company` });
        let divh2 = $('<div>', { class: "email-statis-inner notika-shadow" });
        let divh3 = $('<div>', { class: "email-ctn-round" });
        let divh4 = $('<div>', { class: "email-rdn-hd" });
        $('<h1>', { html: model.name + ", " + model.subname }).appendTo(divh4);
        divh4.appendTo(divh3);

        // image
        let divimage = $('<div>', { class: "email-statis-wrap" });
        let anchorU = $('<a>', { href: '#', id: 'pick' });

        $('<img>', {
            src: './../../../images/company/' + model.logo,
            height: "250px",
            onerror: "this.src='./../../../images/company/company.jpg'"
        }).appendTo(anchorU);
        anchorU.appendTo(divimage)

        divimage.appendTo(divh3);

        let street1 = $('<div>', { class: "past-statistic-an" });
        let street2 = $('<div>', { class: "past-statistic-ctn" });
        $('<p>', { style: "font-size: 15px;", html: "Street: " + model.street }).appendTo(street2);
        street2.appendTo(street1);

        let purok = $('<div>', { class: "past-statistic-graph" });
        $('<p>', { style: "font-size: 15px;", html: "Purok: " + model.purok }).appendTo(purok);
        purok.appendTo(street1);
        street1.appendTo(divh3);

        let brgy1 = $('<div>', { class: "past-statistic-an" });
        let brgy2 = $('<div>', { class: "past-statistic-ctn" });
        $('<p>', { style: "font-size: 15px;", html: "Baranggay: " + model.brgy }).appendTo(brgy2);
        brgy2.appendTo(brgy1);

        let phone = $('<div>', { class: "past-statistic-graph" });
        $('<p>', { style: "font-size: 15px;", html: "Contact no.: " + model.phone }).appendTo(phone);
        phone.appendTo(brgy1);
        brgy1.appendTo(divh3);

        let button = $('<div>', { class: "email-rdn-hd" });
        $('<button>', {
            'data-toggle': 'tooltip',
            'data-placemen': 'top',
            'data-approve': 0,
            id: `engraveU`,
            type: 'button',
            // value:0,
            title: 'Pick',
            class: 'btn btn-info ',
            'data-id': model.id,
            html: $('<i>', { html: '&nbsp pick', class: 'fa fa-hand-o-right' })
        }).appendTo(button);
        button.appendTo(divh3);
        divh3.appendTo(divh2);
        divh2.appendTo(divh);
        $('#userCompany').append(divh);



    },
    AddCompany: async (i) => {
        let user = await fetch.ask(`./../api/users/${state.Userid.value}/find`)
        if (user.item === null) {
            location.replace('./../user_item')
        }
        let params = { "company_id": i }
        let model = await fetch.updateOrCreate(`./../api/user_items/${state.Userid.value}/updateOrCreate`, params, 'PUT')
        if (model) {
            location.replace('./../company')
        }
    },
    create: () => {
        fetch.showModal()
    },
    store: async () => {
        let params = $('#set-Model').serializeArray();
        console.log(params);

        let model = await fetch.store(state.entity, params);
        console.log(model);
        if (model) {
            state.models.push(model)
            state.writer(state.entity, model);
            // $('#addCompany').modal('hide');
        }
    },

    valid: (approve, id) => {
        $('#modal-company').modal('show')
        $('#approve').val(approve)
        $('#id').val(id)
    },

    validReason: async () => {
        let id = $('#id').val()
        let params = [
            { name: 'approve', value: $('#approve').val() },
            { name: 'id', value: id },
            { name: 'reason', value: $('#reason').val() }
        ];
        console.log(params);
        let model = await fetch.update(state.entity, id, params)
        console.log(model);
        if (model) {
            location.replace('/admin/company')
        }
    },
    showCompany: () => {
        Swal.fire({
            title: 'We didn\'t find the company that you were looking.',
            text: "You  want to create?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Create Company'
        }).then((result) => {
            if (result.value) {
                $('#addCompany').modal('show')
            }
        })

    },
    onUpdate: async () => {
        let params = $('#modal-create').serializeArray();
        let pk = state.btnEdit.getAttribute('data-id');
        let model = await fetch.update(state.entity, pk, params);
        if (model) {
            location.replace('/admin/article')
            $('#modal-main').modal('hide');
        }

    }


};

window.addEventListener("load", state.init);