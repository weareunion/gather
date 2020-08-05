let config_json = {
    "address": {
        "target_http": window.location.href,
        "port": 443
    }
}

class ValidationError extends Error {
    constructor(message) {
        super(message); // (1)
        this.name = "ValidationError"; // (2)
    }
}

class HTTPClient {
    constructor(){
        this.config = config_json;
        this.id = "";
        this.unsent = false;
        this.verbose = window.localStorage.getItem("debug_mode");
        this.request_body = {
            target: {
                service: null,
                action: null
            },
            data: {

            },
            response_requested: true,
            headers: []

        };
    }
    create_id(){
        this.id = "";
        for( let b = 36; this.id.length < 40;) this.id += (Math.random() * b | 0).toString(b);

    }
    set_service(service_name){
        if (!this.unsent) this.create_id();
        this.unsent = true;
        if (this.verbose) console.log("HTTPRequest->" + this.id + ": Adding parameter 'SERVICE' as " + service_name);
        this.request_body.target.service = service_name;
        return this;
    }
    set_action(action_name){
        if (!this.unsent) this.create_id();
        this.unsent = true;
        if (this.verbose) console.log("HTTPRequest->" + this.id + ": Adding parameter 'ACTION' as " + action_name);
        this.request_body.target.action = action_name;
        return this;
    }
    set_data(data){
        if (!this.unsent) this.create_id();
        this.unsent = true;
        if (this.verbose) console.log("HTTPRequest->" + this.id + ": Adding to parameter 'DATA'.");
        this.request_body.data = data;
        return this;
    }
    header(header){
        if (!this.unsent) this.create_id();
        this.unsent = true;
        if (this.verbose) console.log("HTTPRequest->" + this.id + ": Adding header: " + header);
        this.request_body.headers.push(header)
        return this;
    }
    is_valid() {
        if (this.verbose) console.log("HTTPRequest->" + this.id + ": Running validation");
        return !(this.request_body.target == null || this.request_body.target.action == null)
    }
    send(){
        if (!this.is_valid()){
            throw new ValidationError("Request is invalid.")
        }
        let scope = this;
        if (this.verbose) console.log("HTTPRequest->" + this.id + ": Creating promise");
        return new Promise(((resolve, reject) => {
            if (this.verbose) console.log("HTTPRequest->" + this.id + ": Executing HTTP POST request...");
            $.ajax({
                method: "POST",
                url: "#",
                data: {
                    service: this.request_body.target.service,
                    action: this.request_body.target.action,
                    data: this.request_body.data
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    try {
                        if (scope.verbose) console.log("HTTPRequest->" + scope.id + ": Request failed:" + JSON.parse(xhr.responseText));
                        reject(JSON.parse(xhr.responseText));
                    } catch (e) {
                        console.warn(xhr.responseText)
                    }
                },
                success: function (data) {
                    if (scope.verbose) console.log("HTTPRequest->" + scope.id + ": Request succeed. Response:" + data);
                    scope.unsent = false;
                    resolve(data);
                }
            })
        }))

    }

}

