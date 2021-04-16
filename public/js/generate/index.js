import fetch from './../modules/ctms.js';

var qr;
(function () {
    qr = new QRious({
        element: document.getElementById('QRcode'),
        size: 200,
    });
})();

$('body').on('click', '#btn-Download-br', () => state.onDownload());
$('body').on('click', '#btn-Download-qr', () => state.onDownloadQr());
const state = {
    /* [Table] */
    entity: { name: 'user', baseUrl: 'api' },
    isBtnQR: true,
    code_title: 'QR.png',
    barcodeType: "code128",
    showText: true,
    myCanvas: null,
    /* [Object Mapping] */
    qrtext: document.getElementById("code").value, //citizen_code
    qrcode: document.getElementById("QRcode"),
    address: document.getElementById("address").value,
    Id: document.getElementById("id").value,
    barcode: document.getElementById("Bar-code"),
    imgConverted: document.getElementById("imgConverted"),
    generateBarcode: document.getElementById("generateBarcode"),
    generateQr: document.getElementById("generateQr"),
    updated: document.getElementById("generateBarcode"),

    /* [initialized] */
    init: async () => {
        state.createQr();
        state.createBarcode();
        // Attach listeners
        // state.updated.addEventListener("click", state.update);
        // state.updated.disabled = false;
        // state.generateQr.addEventListener("click", state.createQr);
        // state.generateQr.disabled = false;


    },
    createQr: () => {
        state.code_title = "Qrcode.png";
        state.isBtnQR = true;

        document.getElementById("qr-result").innerHTML = state.qrtext;
        qr.set({
            foreground: 'black',
            size: 250,
            value: state.qrtext
        });
    },
    createBarcode: () => {
        state.code_title = "Barcode.png";
        state.isBtnQR = false;
        JsBarcode("#Bar-code", state.qrtext, {
            format: state.barcodeType,
            displayValue: state.showText,
            lineColor: "#24292e",
            width: 2.5,
            height: 150,
        });
    },
    onDownload: () => {
        if (window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(state.barcode.msSaveBlob(), state.code_title);
        } else {
            const a = document.createElement("a");

            document.body.appendChild(a);
            a.href = state.barcode.toDataURL();
            a.download = state.code_title;
            a.click();
            document.body.removeChild(a);
            $('#btn-Download').hide();
            //update DB
            let params = [{ name: 'has_downloaded', value: '1' }]
            fetch.updateOrCreate(`./../../api/users/${state.Id}/updateOrCreate`, params, 'PUT');
            //update GUI
            $('#has-download').val(1);
        }
        if (result.value) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                timer: 1500
            })
        }

        alert;
        () => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kailangan munang ideklara ang iyong Address/Tirahan..'
            })
        }

    },
    onDownloadQr: () => {
        if (window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(state.qrcode.msSaveBlob(), state.code_title);
        } else {
            const a = document.createElement("a");

            document.body.appendChild(a);
            a.href = state.qrcode.toDataURL();
            a.download = 'Qr code';
            a.click();
            document.body.removeChild(a);
            // $('#btn-Download').hide();
            //update DB

            let params = [{ name: 'has_downloaded', value: '1' }]
            fetch.updateOrCreate(`./../../api/users/${state.Id}/updateOrCreate`, params, 'PUT');
            //update GUI
            $('#has-download').val(1);
        }
        if (result.value) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                timer: 1500
            })
        }



    }
};

window.addEventListener("load", state.init);