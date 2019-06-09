<template>
  <v-layout>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition"  content-class="customer-chooser-dialog-content">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" v-bind:class="['customer-chooser-button']">{{ caption_button_trigger }}</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">{{ title }}</span>
        </v-card-title>

        <v-container fluid grid-list-md text-xs-center>
          <v-layout row>

            <v-flex xs4 v-bind:class="['customer-search-form']">
              <v-card flat>
                <v-card-text>
                  <v-layout row>
                    <v-layout wrap>
                      <v-flex xs12>
                        <v-text-field @change="getDataFromApi()" v-model="free_word" :label="placeholder_free_word" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-btn @click="getDataFromApi()" :disabled="!free_word">{{ caption_button_search }}</v-btn>
                      </v-flex>
                    </v-layout>
                  </v-layout>
                </v-card-text>
              </v-card>
            </v-flex>

            <v-flex xs8>
              
              <v-radio-group v-model="selectedCustomerId">
                <v-data-table
                  :headers="headers"
                  :items="customers"
                  :total-items="totalCustomers"
                  :loading="loading"
                  :hide-headers="false"
                  :hide-actions="true"
                  class="elevation-1"
                >

                  <template v-slot:no-data>
                    <v-alert :value="true" color="warning" icon="warning">
                      {{ caption_label_data_empty }}
                    </v-alert>
                  </template>
                  <template v-slot:items="customers">
                    <td class="py-2">
                      <v-radio :value="customers.item.id"></v-radio>
                    </td>
                    <td class="py-2">
                        <v-layout row wrap>
                          <v-flex xs12>
                            <div class="text-xs-left">
                              <span class="title">{{ customers.item.lastName }} {{ customers.item.firstName }}</span>
                              <span class="caption">{{ customers.item.lastNameKana }} {{ customers.item.firstNameKana }}</span>
                            </div>
                          </v-flex>
                          <v-flex xs11 offset-xs1>
                            <div class="text-xs-left">
                              <span class="body-2">{{ customers.item.office }}</span>
                              <span class="caption">{{ customers.item.officeKana }}</span>
                              <span class="body-2">{{ customers.item.department }} {{ customers.item.position }}</span>
                            </div>
                          </v-flex>
                          <v-flex xs11 offset-xs1>
                            <div class="text-xs-left">
                              <span class="body-2">
                                {{ customers.item.postalCode }}
                                {{ customers.item.address }}
                                {{ customers.item.building }}
                              </span>
                            </div>
                          </v-flex>
                          <v-flex xs11 offset-xs1>
                            <v-layout row wrap class="text-xs-left">
                              <v-flex xs12 v-if="customers.item.tel">{{ caption_label_tel }}: {{ customers.item.tel }}</v-flex>
                              <v-flex xs12 v-if="customers.item.mobilePhone">{{ caption_label_mobile_phone }}: {{ customers.item.mobilePhone }}</v-flex>
                              <v-flex xs12 v-if="customers.item.email">{{ caption_label_email }}: {{ customers.item.email }}</v-flex>
                            </v-layout row>
                          </v-flex>
                        </v-layout>
                    </td>
                  </template>
                </v-data-table>
              </v-radio-group>
            </v-flex>
          </v-layout>
        </v-container>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false">{{ caption_button_close }}</v-btn>
          <v-btn color="blue darken-1" flat @click="customerSelected()">{{ caption_button_done }}</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
  export default {
    props: {
      'callback_selected': { type: Function }, 
      'linked_value_element': { type: String }, 
      'title': { type: String }, 
      'caption_button_trigger': { type: String },
      'caption_button_search': { type: String },
      'caption_button_close': { type: String },
      'caption_button_done': { type: String },
      'caption_text_free_word': { type: String },
      'caption_label_tel': { type: String },
      'caption_label_mobile_phone': { type: String },
      'caption_label_email': { type: String },
      'caption_label_data_empty': { type: String },
      'placeholder_free_word': { type: String }
    },
    model: {
      event: 'select'
    },

    data: () => ({
      free_word: "",
      selectedCustomerId: 0,
      dialog: false,
      selected: [],
      totalCustomers: 0,
      customers: [],
      loading: false,
      headers: [
          {
            text: '',
            sortable: false
          },
          {
            text: '',
            sortable: false
          }
      ]
    }),

    watch: {
      dialog: function() {
        if (this.dialog) { // dialog opened
          this.getDataFromApi();
        }
      }
    },
    mounted () {
      var self = this;
      $(this.linked_value_element).on('change', function () {
        self.free_word = $(this).val();
      });
    },

    methods: {
      customerSelected () {
        this.dialog = false;
        var customer = this.customers.filter(c => { return c.id == this.selectedCustomerId});
        this.$emit('select', customer);
      },
      toggleAll () {
        if (this.selected.length) this.selected = []
        else this.selected = this.customers.slice()
      },
      getDataFromApi () {
        this.loading = true;
        var self = this;
        return new Promise(function(resolve, reject) {
          if (self.free_word) {
            var params = new URLSearchParams();
            params.set("free_word", self.free_word);

            axios.post("/ajax/customers/list",params)
            .then(function(res){
              self.customers = res.data.customers;
              self.totalCustomers = res.data.totalCustomers;
              self.loading = false;
            });
          } else {
            self.loading = false;
          }
        });
      }
    } // methods
  }
</script>

<style scoped>
.v-dialog__content {
  z-index:2000 !important;
}
.customer-chooser-dialog-content {
  background-color: rgba(0,0,0,0.5);
}
.customer-chooser-button {
  margin: 0 1em 0 0;
}

.v-input >>>.v-input__control {
    width: 100%
}
</style>