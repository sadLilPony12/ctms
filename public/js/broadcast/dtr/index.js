
import fetch from './../../modules/ctms.js';




$('#slide-show > div:gt(0)').hide();
setInterval(function () {
    $('#slide-show > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slide-show');
}, 5000);

/*
 * RFID
 */
const state = {
    models: [],
    rfid: document.getElementById('queue-rfid'),
    time: document.getElementById('clock'),
    activeIndex: 0,
    record: document.getElementById('attendance'),
    timer: null,
    blinking: {
        status: false,
        header: null,
        msge: null
    },
    init: () => {
        state.rfid.addEventListener("keypress", state.ask);
        state.rfid.disabled = false;
        // state.rfid.addEventListener("keypress", state.refresh);
        // state.rfid.disabled = false;
        state.ask();
        state.present();
        // state.newsfeed();
        $('#queue-rfid').focus();
    },
    present: async () => {
        state.models = await fetch.ask('./../api/dtr', state.activeIndex);
        if (state.models) { state.models.forEach(state.writer); }
    },
    ask: async (e) => {
        if (e.which == 13) {
            state.warningOff();
            let pk = state.rfid.value.split("-");
            // search on models
            let model = await fetch.ask(`./../api/dtr/${parseInt(pk[2])}/find`, { station: 1 });
            if (model) {
                var time_in = new Date(model.dtr.created_at).getMinutes();
                let time_tap = time_in += state.time
                console.log(time_tap);
                state.present();

                // if (time_in++) {

                // } else {

                // }


                $('#queue-rfid').val('');
                if (model.Unregistered) {
                    state.blinking.status = true;
                    state.blinking.header = 'Unregistered rfid!';
                    state.blinking.msge = "Please contact the admin for more information."
                    state.timer = setInterval(state.WarningMsge, 1000);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Unregistered rfid!, Please contact the admin for more information.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    let fname = model.dtr.user.fname;
                    if (model.warning) {
                        state.blinking.status = true;
                        state.blinking.header = "You have already tap!";
                        state.blinking.msge = `${fname}, Please tap after 5 minutes.`;
                        state.timer = setInterval(state.WarningMsge, 1000);

                        Swal.fire({
                            icon: 'info',
                            title: `${fname}, Please tap after 5 minutes.\n You have already tap!`,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
        }
    },


    writer: (model) => {
        var index = $("#attendance tr").length;
        index = $(`#model-${model.id}`).length == 0 ? index : $(`#model-${model.id}`).data('index');
        if (index >= 20) { state.record.removeChild(state.record.lastChild); }
        let tr = $('<tr>', {
            id: `model-${model.id}`,
            'data-index': index
        });
        $('<td>', { html: `${index + 1}.` }).appendTo(tr);
        $('<td>', { html: model.user.fullname }).appendTo(tr);
        $('<td>', { html: model.created_at }).appendTo(tr);
        $('<td>', { html: `${model.position}: ${state.ampm(model.punch['time'])}` }).appendTo(tr);
        $('#attendance').append(tr);
        // let divElement = $('#emp-name');
        // let fs = 30; //font size
        // let fl = model.user.fname.length;
        // if (fl >= 25 && fl <= 60) fs = 20;
        // else if (fl >= 60) fs = 18;

        // divElement.css('font-size', fs);
        // $('#emp-name').text(model.fname);
        // $('#log-status').text(model.position);
        // $('#company').text(model.logo);
        // $('#log-time').html(state.ampm(model.punch['time']));


    },



    ampm: (time) => {
        var HH = time.slice(0, 2);
        var MMSS = time.slice(2);

        if (HH < 12) {
            return time + ' AM';
        } else if (HH == 12) {
            return time + ' Noon';
        } else {
            HH = HH - 12;
            return HH + MMSS + ' PM';
        }
    },

    ms: (time) => {
        if (time.slice(-2) == 'PM') {
            time = time.slice(0, -3);
            return (
                (Number(time.split(':')[0]) + 12) * 3600000 +
                Number(time.split(':')[1]) * 60000 +
                Number(time.split(':')[2]) * 1000
            );
        } else if (time.slice(-2) == 'AM') {
            time = time.slice(0, -3);
        }
        return (
            Number(time.split(':')[0]) * 3600000 +
            Number(time.split(':')[1]) * 60000 +
            Number(time.split(':')[2]) * 1000
        );
    },
    warningOff: () => {
        // reset header
        clearInterval(state.timer);
        state.timer = null;
        state.blinking.status = false;
        $('#emp-name').text('Daily Time Record');
        $('#emp-level').text('Please Tap your ID');
        $('#log-status').text('Time');
        $('#log-time').html('00:00:00');

    },
    WarningMsge: () => {
        if (state.blinking) {
            $('#log-status').text('');
            $('#log-time').html('');
            $('#emp-name').text(state.blinking.header);
            $('#emp-level').text(state.blinking.msge);
            $('#emp-name').fadeOut(300);
            $('#emp-name').fadeIn(500);
        } else {
            $('#emp-name').fadeOut(0);
            $('#emp-name').fadeIn(100);
        }
    },
}

window.addEventListener("load", state.init);

