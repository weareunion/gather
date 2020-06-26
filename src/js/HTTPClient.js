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
    set_service(service_name){
        this.request_body.target.service = service_name;
        return this;
    }
    set_action(action_name){
        this.request_body.target.action = action_name;
        return this;
    }
    set_data(data){
        this.request_body.data = data;
        return this;
    }
    header(header){
        this.request_body.headers.push(header)
        return this;
    }
    is_valid() {
        return !(this.request_body.target == null || this.request_body.target.action == null)
    }
    send(){
        if (!this.is_valid()){
            throw new ValidationError("Request is invalid.")
        }
        return new Promise(((resolve, reject) => {
            $.ajax({
                method: "POST",
                url: "#",
                data: {
                    service: this.request_body.target.service,
                    action: this.request_body.target.action,
                    data: this.request_body.data
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    reject(JSON.parse(xhr.responseText));
                },
                success: function (data) {
                    resolve(data);
                }
            })
        }))

    }

}

