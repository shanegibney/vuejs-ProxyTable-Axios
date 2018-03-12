# vuecrud

> A Vue.js project

This project tried to make use of axios to make a GET request to "http://localhost:8080/conn/api.php?action=read"

```
axios.get('/conn/api.php?action=read')
```

This proxies this api using the proxyTable in config/index.js which should see the /conn and target the proxy to http://localhost:8081/api.php?action=read

```
proxyTable: {
  //    proxy all requests starting with / api to api.php
  '/conn': {
    target: 'http://localhost:8081/',
    changeOrigin: true,
    pathRewrite: {
      '^/conn': ''
    }
  }
},
```

The vue dev server runs on port 8080 with,

```
$ npm run dev
```

and a php server runs on port 8081 with,

```
$ php -S localhost:8081
```

But unfortunately it is not connecting to the mysql server running on port 3306, despite the fact that the connection is made if the vue dev server is not running and only the php server runs.

Then json is returned if http://localhost:8081/api.php?action=read is navigated to in the browser. So the MySQL database is working, but not with vue.js.

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report

# run unit tests
npm run unit

# run e2e tests
npm run e2e

# run all tests
npm test
```

For a detailed explanation on how things work, check out the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).
# vuejs-ProxyTable-Axios
