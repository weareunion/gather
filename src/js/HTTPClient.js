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
    config = config_json;
    request_body = {
        target: {
            service: null,
            action: null
        },
        data: {

        },
        response_requested: true,
        headers: []

    };
    service(service_name){
        this.request_body.target.service = service_name;
    }
    action(action_name){
        this.request_body.target.action = action_name;
    }
    data(data){
        this.request_body.data = data;
    }
    header(header){
        this.request_body.headers.push(header)
    }
    is_valid() {
        return !(this.request_body.target == null || this.request_body.target.action == null)
    }
    send(){
        if (!this.is_valid()){
            throw new ValidationError("Request is invalid.")
        }
        return new Promise(((resolve, reject) => {
            $.post((this.config.address.target_http + ":" + this.config.address.port), {
                service: this.request_body.target.service,
                action: this.request_body.target.action,
                data: this.request_body.data
            })
                .done(function (data) {
                    resolve(data)
                })
                .fail(function (data) {
                    reject(data)
                });
        }))

    }

}

