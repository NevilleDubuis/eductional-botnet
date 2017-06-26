require ('newrelic');

var express = require('express'),
    expressLogging = require('express-logging'),
    logger = require('logops'),
    app = express(),
    fs = require('fs');

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');
app.set('port', (process.env.PORT || 5000));
app.set('delay', (process.env.DELAY || 1));

app.use(expressLogging(logger));
app.use(express.static(__dirname + '/public'));

app.get('/', function(request, response) {
  var contents = '';

  for(var i = 0; i < app.get('delay'); i++) {
    contents = fs.readFileSync('./views/pages/index.ejs', 'utf8');
    fs.writeFileSync('./tmp/fs.tmp', contents);
  }

  response.render('pages/index');
});

var server = app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});

server.timeout = 30000;
