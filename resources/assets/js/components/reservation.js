class ReservationForm {
  constructor(vm, selectedCustomerId, form) {
    this.vm = vm;
    this.selectedCustomerId = selectedCustomerId;
    this.form = form;
    
    this.setup();
  }
  
  setup() {
    var self = this;
    this.vm.registerCallback('customerSelected', function(selectedCustomers) {
      if (!selectedCustomers.length) {
        return;
      }
      var selectedCustomer = selectedCustomers[0];
      self.selectedCustomerId = selectedCustomer.id;
      var customerName = "";
      if (selectedCustomer.lastName) {
        customerName += selectedCustomer.lastName;
      }
      if (selectedCustomer.firstName) {
        customerName += selectedCustomer.firstName;
      }
      $("#name").attr("readonly", "readonly").val(customerName);
      $(self.form).children("input[name=customer_id]").remove();
      $(self.form).append('<input type="hidden" name="customer_id" value="' + self.selectedCustomerId + '" />');
    });

    this.vm.registerCallback('textClearButtonTapped', function(event) {
      self.selectedCustomerId = null;
      $("#name").removeAttr("readonly").val("");
      $(self.form).children("input[name=customer_id]").remove();
    });
    
    jQuery(function($){
      if (self.selectedCustomerId) {
        $("#name").attr("readonly", "readonly");
        $(self.form).append('<input type="hidden" name="customer_id" value="' + self.selectedCustomerId + '" />');
      }
    });
  }
  
  confirmCreateCustomer(event) {
    if (!this.selectedCustomerId) {
      var createCustomer = window.confirm("顧客を新規作成しますか？");
      if(createCustomer){
        $(this.form).append('<input type="hidden" name="create_customer" value="' + (createCustomer ? '1' : '0') + '" />');
        $(this.form).submit();
      }
    }
  }
}

window.ReservationForm = ReservationForm;
