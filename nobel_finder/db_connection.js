var mysql      = require('mysql');
var fs         = require('fs');

var connection = mysql.createConnection({
host     : 'myinstance.cdatacloud.net',
database : 'googlecloudstoragedb',
port     : '3306',
user     : 'admin',
password : 'password',
ssl      : {
ca : fs.readFileSync('C:/certs/myCA.pem')
}
});
connection.connect();
connection.query('SELECT * FROM Buckets', function(err, rows, fields) {
if (err) throw err;
console.log(rows);
});
 
// connection.end();
