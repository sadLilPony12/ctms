import fetch from '../modules/ctms.js';


$('body').on('click', '#generateQr', (e) => state.createQr());
$('body').on('click', '#generateBarcode', (e) => state.createBarcode());
$('body').on('click', '#btn-download', async (e) => state.btnDownload());
$('body').on('click', '.btn-delete', (e) => state.destroy($(e.currentTarget).data("index")));

var qr;
(function () {
    qr = new QRious({
        element: document.getElementById('qr-code'),
        size: 100,
    });
})();

// const btnDisplay = document.querySelector("#btnDisplay");
const btnDownloadQr = document.querySelector("#btnDownloadQr");
const btnDownloadBc = document.querySelector("#btnDownloadBc");
const imgConverted = document.querySelector("#imgConverted");
const myCanvas = document.querySelector("#qr-code");
const myCanvass = document.querySelector("#barcode");
const state = {
    /* [Table] */


    /* [Object Mapping] */
    models: [],
    btnEngrave: document.getElementById("engrave"),
    activeIndex: 0,
    btnUpdate: null,
    btnDelete: null,
    /* [initialized] */
    init: () => {
        // // Attach listeners
        // state.btnDownloadQr.addEventListener("click", state.createQr);
        // state.btnDownloadQr.disabled = false;
        // state.btnDownloadBc.addEventListener("click", state.createBarcode);
        // state.btnDownloadBc.disabled = false;
        // const loader = document.querySelector(".loader");
        // loader.className += " hidden";
    },
    createBarcode: () => {
        var barcodeValue = $("#code").val();
        var barcodeType = $("#barcodeType").val();
        var showText = $("#showText").val();
        JsBarcode("#barcode", barcodeValue, {
            format: barcodeType,
            displayValue: showText,
            lineColor: "#24292e",
            width: 1,
            height: 125,
            // fontSize: 20,
        });
        if (window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(myCanvass.msSaveBlob(), "BARCODE.png");
        } else {
            const a = document.createElement("a");

            document.body.appendChild(a);
            a.href = myCanvass.toDataURL();
            a.download = "BARCODE.png";
            a.click();
            document.body.removeChild(a);
        }
    },

    createQr: () => {
        var qrtext = document.getElementById("code").value;
        document.getElementById("qr-result").innerHTML = "QR code for " + qrtext + ":";
        qr.set({
            foreground: 'black',
            size: 100,
            value: qrtext
        });

        if (window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(myCanvas.msSaveBlob(), "QRCODE.png");
        } else {
            const a = document.createElement("a");

            document.body.appendChild(a);
            a.href = myCanvas.toDataURL();
            a.download = "QRCODE.png";
            a.click();
            document.body.removeChild(a);
        }
    },



};

window.addEventListener("load", state.init);
