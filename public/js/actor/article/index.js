import fetch from '../../modules/ctms.js';

$('body').on('click', '#btn-article', () => state.store());

const state = {
    /* [Table] */
    entity: { name: 'article', baseUrl: 'api' },
    /* [Object Mapping] */
    /* [Tag object] */
    btnEngrave: document.getElementById("btn-article"),
    activeIndex: 0,
    btnUpdate: null,
    btnDelete: null,
    monthFolder: null,
    yearFolder: null,
    /* [initialized] */
    /* [ACTIONS] */
    store: async() => {
        let params = $('#article-Model').serializeArray();
        console.log(params);
        let model = await fetch.store(state.entity, params);
        if (model) {
            $('#addArticle').modal('hide');
            location.replace('./../../admin/article')
        }
    },
    init: () => {
        let d = new Date();
        let month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        state.monthFolder = month[d.getMonth()];
        state.yearFolder = d.getFullYear();
        state.ask();
    },
    ask: async() => {
        $('#articles').empty()
        state.models = await fetch.ask(`./../api/articles`);
        state.models.forEach(state.writeA);
    },
    writeA: (model) => {
        console.log(model.title);
        let tr = $('<div>', { class: 'col-md-4', style: `margin-bottom: 2.5%` });
        let box = $('<div>', { class: 'email-statis-inner notika-shadow' });
        let row = $('<div>', { class: 'email-ctn-round' });
        let col = $('<div>', { class: 'email-rdn-hd' });
        $('<h2>', { html: $(`<strong>`, { html: model.title }) }).appendTo(col);
        col.appendTo(row);
        let body = $('<div>', { class: 'email-statis-wrap' });
        $('<img>', {
            class: 'img-responsive',
            src: `./../../../images/article/${state.yearFolder}/${state.monthFolder}/${model.avatar}`,
            onerror: "this.src='./../../../images/article/stayHome.jpeg'"
        }).appendTo(body);
        body.appendTo(row);
        let row1 = $('<div>', { class: 'email-round-gp' });
        let col2 = $('<div>', { class: 'email-round-pro' });
        let col_r = $('<div>', {
            class: 'email-ctn-nock'
        })
        $('<p>', {
            html: $(`<strong>`, { html: model.message }),
            id: "articleMessage"
        }).appendTo(col_r);
        col_r.appendTo(col2);
        col2.appendTo(row1);
        let cor = $('<div>', { style: 'position: absolute; margin-top:5%; right: 10%; bottom: 0%; fint-size: 25px;', })
        $('<a>', {
            html: model.reference,
            title: ' Visit Link',
            href: 'https://' + model.reference,
            target: "_blank"
        }).appendTo(cor);
        cor.appendTo(row1);
        row1.appendTo(row);
        row.appendTo(box);
        box.appendTo(tr);
        $('#articles').append(tr);
    }
};

window.addEventListener("load", state.init);