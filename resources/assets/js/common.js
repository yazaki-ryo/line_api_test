class Common {
    constructor() {}

    /**
     * @param string name
     * @param bool onlyChecked
     * @return array
     */
    elementsByName(name, onlyChecked = true) {
        var element = document.getElementsByName(name);
        var selected = [];

        for (var item of element) {
            if (item.checked === false && onlyChecked) {
                continue;
            }
            selected.push(parseInt(item.value));
        }
        return selected;
    }

    /**
     * @param mixed data
     * @return string
     */
    serialize(data) {
        var key, value, type, i, max;
        var encode = window.encodeURIComponent;
        var query = '?';

        for (key in data) {
            value = data[key];
            type = typeof(value) === 'object' && value instanceof Array ? 'array' : typeof(value);
            switch (type) {
                case 'undefined':
                    query += key;
                    break;
                case 'array':
                    for (i = 0, max = value.length; i < max; i++) {
                        query += key + '[]';
                        query += '=';
                        query += encode(value[i]);
                        query += '&';
                    }
                    query = query.substr(0, query.length - 1);
                    break;
                case 'object':
                    for (i in value) {
                        query += key + '[' + i + ']';
                        query += '=';
                        query += encode(value[i]);
                        query += '&';
                    }
                    query = query.substr(0, query.length - 1);
                    break;
                default:
                    query += key;
                    query += '=';
                    query += encode(value);
                    break;
            }
            query += '&';
        }
        query = query.substr(0, query.length - 1);
        return query;
    };

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

    selectAll() {
        const isChecked = document.getElementById('select-all').checked;   
        let selection = document.getElementsByClassName('selection');        
        for(let i = 0; i < selection.length; i++) {
            selection[i].checked = isChecked;
        }
    }
    
    pageLengthChange(elem, keyRowsInPage = 'rows_in_page') {
      window.location.search = keyRowsInPage + '=' + elem.value;
    }
    
    clearForm(form) {
        jQuery(form)
            .find("input, select, textarea")
            .not(":button, :submit, :reset, :hidden")
            .val("")
            .prop("checked", false)
            .prop("selected", false)
        ;

        jQuery(form).find(":radio").filter("[data-default]").prop("checked", true);
    }
}

window.common = new Common();
