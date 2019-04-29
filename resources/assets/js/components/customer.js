class Customer {
    constructor() {}

    sortChange(elem) {
      window.location.search = 'sort=' + elem.value;
    }
}

window.customer = new Customer();
