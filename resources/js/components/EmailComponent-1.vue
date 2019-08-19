<template>
  <div class="container contact">
    <div class="row">      
      <div class="col-md-3">
        <div class="contact-info">
          <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
          <h2>Email Us</h2>
          <h4>We would love to hear from you !</h4>
        </div>
      </div>
      <div class="col-md-9">        
        <div class="contact-form">
          <div class="error">
            <ul>
              <li v-for="(item, index, key) in serrors">
                {{ item[key] }}
              </li>
            </ul>
          </div>
          <form @submit.prevent="handleSubmit" class="vld-parent">            
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
              <input type="text" v-model="user.email" v-validate="'required|multi_email'" id="email" name="email" placeholder="Enter Email" class="form-control" />
              <div v-if="submitted && errors.has('email')" class="invalid-feedback">{{ errors.first('email') }}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="message">Message:</label>
              <div class="col-sm-10">              
                <tinymce v-model="user.message" v-validate="'required'" id="message" name="message" class="" :toolbar1="toolbar1" :other_options="options"></tinymce>
                <div v-if="submitted && errors.has('message')" class="invalid-feedback">{{ errors.first('message') }}</div>
              </div>
            </div>
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Send</button>
              </div>
            </div>
          </form>
          <div class="success" v-if="success != ''">{{success}}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>        
import 'vue-loading-overlay/dist/vue-loading.css';
import {
    emailService
}
from './../services';

export default {
    name: 'app',
    data() {
        return {
            user: {
                email: null,
                message: '',
            },
            submitted: false,
            serrors: [],
            success: '',            
            toolbar1: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',
            options: {
                menubar: '',
                resize: false,
                statusbar: false,
                branding: false,
                contextmenu: false,
            }
        }
    },
    methods: {
        handleSubmit(e) {            
            this.submitted = true;
            this.$validator.validate().then(valid => {
                if (valid) {
                    let loader = this.$loading.show();
                    this.success = '';
                    emailService.sendEmail(this.user).then(
                        res => {
                            if (res.response == true) {
                                this.success = 'Email has been sent.';
                                setTimeout(() => {
                                    this.success = '';
                                }, 3000);
                            } else {
                                this.serrors = res;
                            }

                            loader.hide();
                        },
                        error => {
                            this.serrors = error;
                            loader.hide();
                        }
                    );
                }
            });
        }
    }
}
</script>