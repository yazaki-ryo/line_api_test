class Customer {
    constructor() {}

    sortChange(elem) {
      window.location.search = 'sort=' + elem.value + '&tab=index';
    }
    
    pageLengthChange(elem, keyRowsInPage = 'rows_in_page') {
      window.location.search = keyRowsInPage + '=' + elem.value + '&tab=index';
    }
}

window.customer = new Customer();
