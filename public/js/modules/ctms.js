const request = async (url, params, method = 'GET') => {
    const options = { method, headers: { 'Content-Type': 'application/json' } };
    if (params && method === 'GET') {
        url += params != '' ? `?${objectToQueryString(params)}` : '';
        params = '';
    }

    let response;

    try {
        response = await $.ajax({
            url: url,
            type: method,
            data: params
        });

        if (response.status === 404 || response.status === 500) {
            Swal.fire({ icon: 'error', title: 'Oops...', showConfirmButton: false, timer: 3000, text: 'The server responded with an unexpected status!' })
        } else if (response.status === 204) {
            return null;
        }

        return response;
        // const result = await response.json();
        // return result;
    } catch (error) {
        console.error(error);
    }
}
const objectToQueryString = (obj) => {
    let condition = Object.keys(obj).map(key => `${key}=${obj[key]}`).join('&')
    return condition.replace(/&\s*$/, "");
};
const generateErrorResponse = (message) => { return { status: 'error', message }; }
// const serialized = (params) => {
//     if (typeof params === 'string' || params instanceof String) {
//         return params;
//     } else {
//         var data = {};
//         for (var i in params) {

//             data[params[i]['name']] = params[i]['value']
//         }
//         return JSON.stringify(data);
//     }
// }

/**
 * Directly query on database
 * @param {'given URL'} url
 * @param {'search key'} params
 * Search key = {key:value}
 *
 *  @returns colletion of resources in json type
 */
const ask = (url, params) => request(url, params);
const find = (url) => request(url);
const store = async (_entity, params, withMsge = true) => {
    let url = `/${_entity.baseUrl}/${pluralize(_entity.name)}/save`;
    const model = await request(url, params, 'POST');
    if (model) {
        if (withMsge) {
            Swal.fire({
                position: 'top-end', icon: 'success', title: 'Your work has been saved', showConfirmButton: false, timer: 1500
            });
        }
        return model;
    }
}
// direct URL
const engrave = async (url, params, willEngrave = false) => {
    let method = willEngrave ? 'POST' : `PUT`;
    const model = await updateOrCreate(url, params, method);
    if (model) { return model }
}

/**
 * Update the given model
 * @param {'Model'} _entity
 * @param {'Primary key'} pk
 * @param {'Attributes'} params
 * @param {'Wil show msge'} withMsge
 *
 * @returns Updated Model
 */
const update = async (_entity, pk, params, withMsge = true) => {
    let url = `/${_entity.baseUrl}/${pluralize(_entity.name)}/${pk}/update`;
    const model = await request(url, params, 'PUT');
    if (model) {
        if (withMsge) {
            Swal.fire({
                position: 'top-end', icon: 'success', title: 'Your work has been saved', showConfirmButton: false, timer: 1500
            });
        }
        return model;
    }
}

/**
 * Update or Create if not Available
 * @param {'URL'} url
 * @param {*} params
 * @param {'PUT/POST'} method
 * @param {'has Confirmation '} withMsge
 *
 * @return Model
 */
const updateOrCreate = async (url, params, method) => {
    const res = await request(url, params, method);
    let msge = method == 'POST' ? 'Your work has been saved' : 'Your work has been updated';
    if (res) { Swal.fire({ position: 'top-end', icon: 'success', title: msge, showConfirmButton: false, timer: 1500 }); return res; }
}
/**
 * 
 * @param {'Table name'} _entity 
 * @param {'Primary key'} pk 
 * @param {'Will remove from the table'} remove
 * @param {'parameters'} params
 * 
 * @returns Boolean 
 */
const destroy = async (_entity, pk, remove = true, params = null) => {
    const { value: result } = await Swal.fire({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, delete it!' })
    if (result) {
        let key = params ? `?${objectToQueryString(params)}` : '';
        let url = `/${_entity.baseUrl}/${pluralize(_entity.name)}/${pk}/destroy${key}`;
        const response = await request(url, '', 'DELETE');
        if (response) {
            if (response.success) { $(`#${_entity.name}-${pk}`).remove(); Swal.fire({ position: 'top-end', icon: 'success', title: 'Your work has been saved', showConfirmButton: false, timer: 1500 }) }

            if (remove) $(`#model-${pk}`).remove();
            return true;
        }
    } else {
        return false;
    }
}
/*  
/ Mapping
/ ------------
/  it will authomatic map on the table
*/
var entity = null;
var attributes = null;
var actions = null;
var baseUrl = null;

/**
 * Will genarate url and query on database
 * @param {'model'} _entity
 * @param {'search key'} key
 * 
 * key can be string or object
 * if object it must be in json type
 *  @returns collection of models in json type
 */
const translate = async (_entity, key = '') => {
    entity = _entity.name;
    baseUrl = _entity.baseUrl;
    $('#table-main').empty();
    let params = key;

    if (typeof key === 'string' || key instanceof String) {
        params = key != '' ? { key: key } : ''
    }
    const _models = await ask(`/${baseUrl}/${pluralize(entity)}`, params);
    return _models;
};

/**
 * Display the specified resource on table-main.
 * @param {'table'} _entity 
 * @param {'object resources'} model 
 * 
 * @return write a list of data in the table-main
 */
const writer = (_entity, model) => {
    // console.log(model)
    attributes = _entity.attributes;
    actions = _entity.actions;
    var index = $("#table-main tr").length;
    index = $(`#model-${model.id}`).length == 0 ? index : $(`#model-${model.id}`).data('index');
    let tr = $('<tr>', {
        id: `model-${model.id}`,
        'data-index': index
    });
    $('<td>', { html: `${index + 1}.` }).appendTo(tr);
    const attriMap = new Map(Object.entries(model))
    attributes.forEach(attri => $('<td>', { html: attriMap.get(attri) }).appendTo(tr))
    /**
     * Check if actions is available the append action in thead
     */
    let td = $('<td>');
    let group = $('<div>', { class: 'btn-group' });
    Object.keys(actions).map(key => {
        let icons = actions[key][0];
        if (actions[key][0].length == 3) { icons = model[actions[key][0][0][0]] == actions[key][0][0][1] ? actions[key][0][1] : actions[key][0][2]; }
        if (actions[key].length === 4) {
            let val = actions[key][3][1];// value
            if (typeof val === "boolean") {
                if (model[actions[key][3][0]] == val) {
                    $('<button>', {
                        'data-index': index,
                        'data-id': model.id,
                        class: `btn btn-${actions[key][2]} btn-${key}`,
                        'data-toggle': "tooltip",
                        'title': actions[key][1],
                        html: $('<span>', { class: icons })
                    }).appendTo(group)
                }
            } else {
                if (val === null) { //Not
                    if (model[actions[key][3][0]] === null) {  //key
                        $('<button>', {
                            'data-index': index,
                            'data-id': model.id,
                            class: `btn btn-${actions[key][2]} btn-${key}`,
                            'data-toggle': "tooltip",
                            'title': actions[key][1],
                            html: $('<span>', { class: icons })
                        }).appendTo(group)
                    }
                } else if (val.indexOf('!') > -1) { //Not
                    if (model[actions[key][3][0]] != val.replace('!', '')) {  //key
                        $('<button>', {
                            'data-index': index,
                            'data-id': model.id,
                            class: `btn btn-${actions[key][2]} btn-${key}`,
                            'data-toggle': "tooltip",
                            'title': actions[key][1],
                            html: $('<span>', { class: icons })
                        }).appendTo(group)
                    }
                } else {
                    if (model[actions[key][3][0]] == val) {
                        $('<button>', {
                            'data-index': index,
                            'data-id': model.id,
                            class: `btn btn-${actions[key][2]} btn-${key}`,
                            'data-toggle': "tooltip",
                            'title': actions[key][1],
                            html: $('<span>', { class: icons })
                        }).appendTo(group)
                    }
                }

            }
        } else {
            $('<button>', {
                'data-index': index,
                'data-id': model.id,
                class: `btn btn-${actions[key][2]} btn-${key}`,
                'data-toggle': "tooltip",
                'title': actions[key][1],
                html: $('<span>', { class: icons })
            }).appendTo(group)
        };
    })

    group.appendTo(td); td.appendTo(tr); if ($(`#model-${model.id}`).length == 0) { $('#table-main').append(tr); } else { $(`#model-${model.id}`).replaceWith(tr); }
};

/**
 * Show modal with id:set-Modal
 *
 * reset the modal
 * Button with id=engrave will reset data-id to 0
 */
const showModal = () => {
    $('#set-Model').trigger("reset");
    $('#modal-title').html("Add New");
    $('#engrave').attr('data-id', 0);
    $('#modal-main').modal('show');
}

/**
 * Show modal and map data accoording to name type.
 * 
 * @param {'Resources'} model 
 */
const showOnModal = (model) => {
    $('#set-model').trigger("reset");
    $('#modal-title').html(`Update`);
    // console.log(model)
    Object.keys(model).map(key => {
        if ($(`[name='${key}']`).length !== 0 && key != 'avatar') {
            if (typeof model[key] == 'boolean') {
                $(`[name='${key}']`).val(model[key] ? 1 : 0);
            } else {
                $(`[name='${key}']`).val(model[key]);
            }
        }
    });
    $('#modal-main').modal('show');
}
/*
/ include all noun that doesn't add s only
*/
const plurals = {
    person: 'people',
    radius: 'radii',
    check: 'cheques',
    batch: 'batches',
    access: 'accesses'
};
const pluralMap = new Map(Object.entries(plurals))
const withEs = ['s', 'h', 'c', 'g'];
const pluralize = (word) => pluralMap.has(word) ? pluralMap.get(word) : (word.substr(-1) === 'y' ? word.replace(/.$/, "ies") : (withEs.indexOf(word.substr(-1)) !== -1 ? `${word}es` : `${word}s`));
/**
 * regular expression:
 * The / mark the beginning and end of the regular expression
 * The , matches the comma
 * The \s means whitespace characters (space, tab, etc) and the * means 0 or more
 * The $ at the end signifies the end of the string
 */

/**
*
* @param {'table'} _model name of model in singular form
* @param {'show'} _attri selected field to show
* @param {'url'} base_url default URL of 'api'
* @param {'search'} key { key : value, key : value }
* @returns {'options'} attach the attribute to the table with class="${_model}-id"
*/
const option_list = async (_model, _attri = 'name', required = true, searchKey = '') => {
    // $(`#${_model}-id`).empty();
    $('<option>', { value: null, text: null })
    let models = await ask(`/api/${pluralize(_model)}/list`, searchKey);
    if (!required) { $(`#${_model}-id`).append($('<option>', { value: null, text: null })) }
    models.forEach(model => {
        let title = '';
        if (typeof _attri === 'string' || _attri instanceof String) {
            title = model[_attri];
        } else {
            for (var i in _attri) {
                title += `${model[_attri[i]]} |`;
            }
            title = title.substring(0, title.length - 1);
        }
        $(`#${_model}-id`).append($('<option>', { value: model.id, text: title }))
    })
    return models;
}
export default { ask, find, update, store, engrave, updateOrCreate, destroy, writer, translate, showModal, showOnModal, option_list };