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
    });
  });
}

searchTable('your_search_term').then(results => console.log(results));

const searchButton = document.getElementById("search-button");
searchButton.addEventListener("click", () => {
  const searchTerm = document.getElementById("search-input").value;
  searchTable(searchTerm).then(results => console.log(results));
});
