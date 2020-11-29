let slately = {};
slately.movement = {};
slately.movement.back = function (){
    let hstnm = document.location.origin.split("/")[2];
    if (document.referrer.includes(hstnm)){
        window.history.back();
    }else {
        document.location = document.location.origin;
    }
}
slately.search = {};
slately.search.filters = {};
slately.search.parameters = {};
slately.search.type = {};
slately.search.query = {};
slately.search.URL = {};
slately.search.data = {
    filters: [],
    page: {},
    location: {},
    type: {}
};
slately.search.cache = {}

// Add a filter to the search query
slately.search.filters.set = function (type, value){
    slately.search.data.filters.push({
        t: type,
        v: value
    })
}
slately.search.filters.getAvailable = function (){
    return new Promise();
}
slately.search.type.set = function (value) {

}
slately.search.query = function (page){

}
slately.search.URL.expand = function(){
    return false;
}
slately.search.URL.push = function (){
    let data = encodeURIComponent(JSON.stringify(slately.search.data));
    if (history.pushState) {
        let new_URL_state = window.location.protocol + "//" + window.location.host + window.location.pathname + '?q=' + data;
        window.history.pushState({path:new_URL_state},'',new_URL_state);
    }
}
slately.search.cache.data = [];
slately.search.cache.add = function (data){
    slately.search.cache.push(data);
}
slately.UI = {
    modals: {
        error: function (title, subtitle, primary_option='Okay', secondary_option=null){
            $('#IMPORT_MODAL_ERROR_TITLE').html(title);
            $('#IMPORT_MODAL_ERROR_SUBTITLE').html(subtitle);
            $('#IMPORT_MODAL_ERROR_BUTTON_PRIMARY').html(primary_option);
            if (secondary_option == null){
                $('#IMPORT_MODAL_ERROR_BUTTON_SECONDARY').addClass('d-none');
            }else{
                $('#IMPORT_MODAL_ERROR_BUTTON_SECONDARY').html(secondary_option).removeClass('d-none');
            }
            $('#IMPORT_MODAL_ERROR').modal({backdrop: 'static', keyboard: false});
            return new Promise(function (resolve, reject) {
                $("#IMPORT_MODAL_ERROR_BUTTON_PRIMARY").click(function (){
                    $("#IMPORT_MODAL_ERROR").modal("hide");
                    resolve(true);
                })
                $("#IMPORT_MODAL_ERROR_BUTTON_SECONDARY").click(function (){
                    $("#IMPORT_MODAL_ERROR").modal("hide");
                    reject(false);
                })
            })
        },
        success: function (title, subtitle, primary_option='Okay', secondary_option=null){
            $('#IMPORT_MODAL_SUCCESS_TITLE').html(title);
            $('#IMPORT_MODAL_SUCCESS_SUBTITLE').html(subtitle);
            $('#IMPORT_MODAL_SUCCESS_BUTTON_PRIMARY').html(primary_option);
            if (secondary_option == null){
                $('#IMPORT_MODAL_SUCCESS_BUTTON_SECONDARY').addClass('d-none');
            }else{
                $('#IMPORT_MODAL_SUCCESS_BUTTON_SECONDARY').html(secondary_option).removeClass('d-none');
            }
            $('#IMPORT_MODAL_SUCCESS').modal({backdrop: 'static', keyboard: false});
            return new Promise(function (resolve, reject) {
                $("#IMPORT_MODAL_SUCCESS_BUTTON_PRIMARY").click(function (){
                    $("#IMPORT_MODAL_SUCCESS").modal("hide");
                    resolve(true);
                })
                $("#IMPORT_MODAL_SUCCESS_BUTTON_SECONDARY").click(function (){
                    $("#IMPORT_MODAL_SUCCESS").modal("hide");
                    reject(false);
                })
            })
        },
        warning: function (title, subtitle, primary_option='Okay', secondary_option=null){
            $('#IMPORT_MODAL_WARNING_TITLE').html(title);
            $('#IMPORT_MODAL_WARNING_SUBTITLE').html(subtitle);
            $('#IMPORT_MODAL_WARNING_BUTTON_PRIMARY').html(primary_option);
            if (secondary_option == null){
                $('#IMPORT_MODAL_WARNING_BUTTON_SECONDARY').addClass('d-none');
            }else{
                $('#IMPORT_MODAL_WARNING_BUTTON_SECONDARY').html(secondary_option).removeClass('d-none');
            }
            $('#IMPORT_MODAL_WARNING').modal({backdrop: 'static', keyboard: false});
            return new Promise(function (resolve, reject) {
                $("#IMPORT_MODAL_WARNING_BUTTON_PRIMARY").click(function (){
                    $("#IMPORT_MODAL_WARNING").modal("hide");
                    resolve(true);
                })
                $("#IMPORT_MODAL_WARNING_BUTTON_SECONDARY").click(function (){
                    $("#IMPORT_MODAL_WARNING").modal("hide");
                    reject(false);
                })
            })
        },
        info: function (title, subtitle, primary_option='Okay', secondary_option=null){
            $('#IMPORT_MODAL_INFO_TITLE').html(title);
            $('#IMPORT_MODAL_INFO_SUBTITLE').html(subtitle);
            $('#IMPORT_MODAL_INFO_BUTTON_PRIMARY').html(primary_option);
            if (secondary_option == null){
                $('#IMPORT_MODAL_INFO_BUTTON_SECONDARY').addClass('d-none');
            }else{
                $('#IMPORT_MODAL_INFO_BUTTON_SECONDARY').html(secondary_option).removeClass('d-none');
            }
            $('#IMPORT_MODAL_INFO').modal({backdrop: 'static', keyboard: false});
            return new Promise(function (resolve, reject) {
                $("#IMPORT_MODAL_INFO_BUTTON_PRIMARY").click(function (){
                    $("#IMPORT_MODAL_INFO").modal("hide");
                    resolve();
                })
                $("#IMPORT_MODAL_INFO_BUTTON_SECONDARY").click(function (){
                    $("#IMPORT_MODAL_INFO").modal("hide");
                    reject();
                })
            })
        },
        fatal: function () {
            $('#IMPORT_MODAL_ERROR_FATAL').modal({backdrop: 'static', keyboard: false})
        },
        loading : {
            open : function(){
                $("#MODAL_LOADING").modal({backdrop: 'static', keyboard: false})
            },
            close : function(){
                $("#MODAL_LOADING").modal('hide')
            }
        }
    },
    qr:{
        display_qr_element: function(e, data){
            e.qrcode(data);
        },
        display_qr:  function (title, subtitle, qr_data, primary_option='Okay', secondary_option=null){
            $('#IMPORT_MODAL_QR_TITLE').html(title);
            $('#IMPORT_MODAL_QR_SUBTITLE').html(subtitle);
            $('#IMPORT_MODAL_QR_BUTTON_PRIMARY').html(primary_option);
            $('#IMPORT_MODAL_QR_CODE').html("")
            slately.UI.qr.display_qr_element($('#IMPORT_MODAL_QR_CODE'), qr_data);
            if (secondary_option == null){
                $('#IMPORT_MODAL_QR_BUTTON_SECONDARY').addClass('d-none');
            }else{
                $('#IMPORT_MODAL_QR_BUTTON_SECONDARY').html(secondary_option).removeClass('d-none');
            }
            $('#IMPORT_MODAL_QR').modal({backdrop: 'static', keyboard: false});
            return new Promise(function (resolve, reject) {
                $("#IMPORT_MODAL_QR_BUTTON_PRIMARY").click(function (){
                    $("#IMPORT_MODAL_QR").modal("hide");
                    resolve();
                })
            })

        }
    }
}