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