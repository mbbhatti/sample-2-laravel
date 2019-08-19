<template>
    <div class="container contact">
      <div class="row">          
          <div v-if="data" class="col-sm-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Logs Detail</h3>                          
              </div>
              <table class="table table-hover" id="task-table">
                <thead>
                  <tr>
                    <th>Email</th>
                    <th>status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="log in data">
                    <td>{{log.email}}</td>
                    <td>
                      <span class="label label-deliver" v-if="log.status === 'delivered'">
                        {{log.status}}
                      </span>
                      <span class="label label-bounce" v-else-if="log.status === 'bounced'">
                        {{log.status}}
                      </span>
                      <span class="label label-queue" v-else>
                        {{log.status}}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
import {
    logService
}
from './../services';

export default {
    name: 'app',
    data() {
        return {
            data: '',
            error: ''
        }
    },
    mounted() {
        this.handleRequest();
    },
    methods: {
        handleRequest() {
            this.data = '';
            logService.getLogs().then(
                res => {
                    this.data = res;
                },
                error => {
                    this.error = error;
                }
            );
        }
    }
}
</script>