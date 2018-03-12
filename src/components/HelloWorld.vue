<template>
  <div class="hello">
    <!-- <p>I am in /Users/shanegibney/vueCRUD</p> -->
    <p class="errorMessage" v-if="errorMessage">
      {{ errorMessage }}
    </p>
    <p class="successMessage" v-if="successMessage">
      {{ successMessage }}
    </p>
    <table>
      <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Email</td>
        <td>Mobile</td>
        <td>Edit</td>
        <td>Delete</td>
      </tr>
      <tr v-for="user in users">
        <td>{{ user.id }}</td>
        <td>{{ user.username }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.mobile }}</td>
        <td><button @click="showingEditModal = true;">Edit</button></td>
        <td><button @click="showingDeleteModal = true;">Delete</button></td>
      </tr>
    </table>
    <p>php server -> $ php -S localhost:8081</p>
    <p>npm server automatically run on 8080</p>
    <p><strong>Using: header in api.php</strong></p>
    <p style="text-align:left;">header("Access-Control-Allow-Origin: *");﻿﻿</p>
    <p>header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin");</p>
    <table>
      <tr>
        <th>proxyTable</th>
        <th>axios.get(...)</th>
        <th>Output</th>
      </tr>
      <tr>
        <td>none</td>
        <td>http://localhost:8080/api.php?action=read</td>
        <td>GET http://localhost:8080/api.php?action=read 404 (Not Found)</td>
      </tr>
      <tr>
        <td>none</td>
        <td>/api.php?action=read</td>
        <td>GET http://localhost:8080/api.php?action=read 404 (Not Found)</td>
      </tr>
      <tr>
        <td>none</td>
        <td>/api.php</td>
        <td>GET http://localhost:8080/api/ 404 (Not Found)</td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      errorMessage: "",
      successMessage: "",
      users: []
    }
  },
  mounted: function(){
    console.log("mounted");
    this.getAllUsers();
  },
  methods: {
    getAllUsers: function(){
      console.log("getAllUsers running");
      // axios.get("http://localhost:8080/api.php?action=read")
      // axios.get("http://localhost:8080/api")
      // axios.get("http://ron-swanson-quotes.herokuapp.com/v2/quotes")
      // axios.get("http://127.0.0.1:8081")
      // axios.get("/conn")
      axios.get('/conn/api.php?action=read')
      .then(function(response){
        console.log("blah"+response.data);
        if(response.data.error){
          app.errorMessage = response.data.message;
          console.log("there is an error in 'if'")
        } else {
          app.users = response.data.users;
          console.log("there is an error in 'else'")
        }
      });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  /* display: inline-block; */
  margin: 0 10px;
}
a {
  color: #42b983;
}
p {
  text-align: left;
}
td {
  text-align: left;
  vertical-align: top;
}
</style>
