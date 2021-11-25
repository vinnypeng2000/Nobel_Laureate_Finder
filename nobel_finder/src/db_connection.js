function getConnection ()
{
  var mysql = require('mysql');
  const DB_HOST = process.env.DB_HOST;
  const DB_USER = process.env.DB_USER;
  const DB_PASS = process.env.DB_PASS;
  const DB_NAME = process.env.DB_NAME;
  // console.log("Hello, nothing has been done.")

  const options = 
  {  
    host: `/cloudsql/nobel-laureate-finder-332817:us-east4:nobel-laureate-finder`,   
    user: DB_USER,
    password: DB_PASS,
    database: 'nobel_laureate',
    socketPath: `/cloudsql/nobel-laureate-finder-332817:us-east4:nobel-laureate-finder`
  };
  console.log("Hello db!")
  return mysql.createConnection(options);
}


// var connection = mysql.createConnection({
// host: "34.85.200.4",
// user: 'root',
// password: 'database4750',
// database: 'nobel_laureate'
// // ssl      : {
// // ca : fs.readFileSync('C:/certs/myCA.pem')
// // }
// });

// getConnection.connect();
// connection.query('SELECT * FROM awarded_organization', function(err, rows, fields) {
// // if (err) throw err;
// if (err) console.log("Failed!");
// console.log(rows);
// });
 
// connection.end();

export default getConnection;

