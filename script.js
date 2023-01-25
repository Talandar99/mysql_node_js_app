document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("login-form");

  form.addEventListener("submit", function(e) {
    e.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username === "pioter" && password === "ryba") {
      window.location.href = "/slownik";
    } else {
      window.alert("dane logowania są niepoprawne");
    }
  });

const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'user_name',
  password: 'password',
  database: 'database_name'
});

function searchTable(searchTerm) {
  return new Promise((resolve, reject) => {
    connection.connect();
  
    const query = `SELECT * FROM your_table WHERE column_name LIKE '%${searchTerm}%'`;
    connection.query(query, function (error, results, fields) {
      if (error) {
        reject(error);
      } else {
        resolve(results);
      }
      connection.end();
    });
  });
}

searchTable('your_search_term').then(results => console.log(results));
});
