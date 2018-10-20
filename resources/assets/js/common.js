class Common {
    constructor() {}

    /**
     * @param string url
     * @param string msg
     * @return void
     */
    submitFormWithConfirm(url, msg, method = 'post') {
        if( confirm(msg) ) {
            var form = document.getElementById('basic-form');
            form.action = url;
            form.method = method;
            form.submit();
        }
    }
}

window.common = new Common();
