import Vue from 'vue';
import VeeValidate, { Validator } from 'vee-validate';
import de from 'vee-validate/dist/locale/de';
import ar from 'vee-validate/dist/locale/ar';

import './bootstrap';

window.Vue = Vue;
window.VeeValidate = VeeValidate;
window.toastr = require('toastr/toastr');
require('toastr/toastr.scss');

import ar_plug from 'array-tools'

window.a = ar_plug

import multiselect from 'vue-multiselect'

Vue.use(VeeValidate, {
    dictionary: {
        ar: ar,
        de: de,
    },
    events: 'input|change|blur',
});
Vue.prototype.$http = axios

window.eventBus = new Vue();

Vue.component('mix-customize-section', require('./components/mix_section').default);
Vue.component('advertisement-section-one', require('./components/advertisement_section_one').default);
Vue.component('advertisement-section-two', require('./components/advertisement_section_two').default);
Vue.component('slider_section', require('./components/slider_section').default);
Vue.component('slider_add_section', require('./components/slider_add_section').default);
Vue.component('multi-select', require('./components/shared/multi_select').default);
Vue.component('select2', require('./components/shared/Select2').default);
Vue.component('select4', require('./components/shared/Select4').default);
Vue.component('single-select', require('./components/shared/single_select').default);
Vue.component('image-picker', require('./components/shared/image_pickup').default);
Vue.component('customize_section_admin', require('./components/customize_section').default);

Vue.component('multiselect', multiselect);

$(document).ready(function () {
    Vue.config.ignoredElements = [
        'option-wrapper',
        'group-form',
        'group-list'
    ];

    var app = new Vue({
        el: "#app",

        data: {
            modalIds: {},
            'baseUrl': document.getElementById("base_url_span").getAttribute('baseUrl'),

        },

        mounted() {
            this.addServerErrors();
            this.addFlashMessages();

            this.$validator.localize(document.documentElement.lang);

        },

        methods: {

            onSubmit: function (e) {
                this.toggleButtonDisable(true);

                if(typeof tinyMCE !== 'undefined')
                    tinyMCE.triggerSave();

                this.$validator.validateAll().then(result => {
                    if (result) {
                        e.target.submit();
                    } else {
                        this.toggleButtonDisable(false);

                        eventBus.$emit('onFormError')
                    }
                });
            },

            toggleButtonDisable (value) {
                var buttons = document.getElementsByTagName("button");

                for (var i = 0; i < buttons.length; i++) {
                    buttons[i].disabled = value;
                }
            },

            addServerErrors(scope = null) {
                for (var key in serverErrors) {
                    var inputNames = [];
                    key.split('.').forEach(function(chunk, index) {
                        if(index) {
                            inputNames.push('[' + chunk + ']')
                        } else {
                            inputNames.push(chunk)
                        }
                    })

                    var inputName = inputNames.join('');

                    const field = this.$validator.fields.find({
                        name: inputName,
                        scope: scope
                    });
                    if (field) {
                        this.$validator.errors.add({
                            id: field.id,
                            field: inputName,
                            msg: serverErrors[key][0],
                            scope: scope
                        });
                    }
                }
            },

            addFlashMessages() {
                if (typeof flashMessages == 'undefined') {
                    return;
                };

                const flashes = this.$refs.flashes;

                flashMessages.forEach(function(flash) {
                    flashes.addFlash(flash);
                }, this);
            },

            showModal(id) {
                this.$set(this.modalIds, id, true);
            }
        }
    });
});
