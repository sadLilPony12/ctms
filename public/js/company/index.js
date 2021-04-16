import fetch from '../modules/ctms.js';

const state = {
    Userid: document.getElementById("id"),
    /* [initialized] */
    profile: async () => {
        let model = await fetch.ask(`./../api/user_items/${state.Userid.value}/find`)
        console.log(model.company.phone);
        $('#companyname').html(model.company.name)
        $('#subnames').html(model.company.subname)
        $('#address').html(model.company.address)
        $('#hieght').html(model.company.hieght)
        $('#width').html(model.company.width)
        $('#phoneNum').html(model.company.phone)

        if (model.company.logo == null) {
            $('#company-logo').attr("src", `images/company.jpg`);
        } else {
            $('#company-logo').attr("src", `images/company/${model.company.logo}`);
        }

    }
};

window.addEventListener("load", state.profile);