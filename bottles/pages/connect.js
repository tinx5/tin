var mysql = require('mysql');

var con = {
    host: "localhost",
    user: "root",
    password: "",
    database: "bottles"
  };

  
  var connection = mysql.createPool(con);
  const selectSql = (sql,values='', callback) => {
    
    connection.getConnection(function (err, res) {
        if (err) {
            callback(err,[])
        } else {
                connection.query(sql, [values], function (err2, result, fields) {
                    callback(err2, result);
                    res.release();
                    });
        }
      });

}

const InserSql = (sql, values,callback) => {
    connection.getConnection(function (err, tempCont) {
        if (err) {
            callback(err,[])
        } else {
            connection.query(sql, [values], function (err, result) {
                    callback(err, result); 
            });
        }
    })
}
const UpdateSql = (sql,callback) => {
    connection.getConnection(function (err, tempCont) {
        if (err) {
            callback(err,[])
        } else {
            connection.query(sql, function (err, result, fields) {
                    callback(err, fields); 
            });
        }
    })
    // con.connect(function (err) {
    //     if (err) { console.log(err); return err };
    //     con.query(sql, function (err, result) {
    //         if (err) return err;
    //         console.log(result.affectedRows + " record(s) updated");
    //     });
    // })
}
const DeleteSql = (sql, values, callback) => {
    connection.getConnection(function (err, tempCont) {
        if (err) {
            callback(err,[])
        } else {
            connection.query(sql,[values], function (err, result, fields) {
                    callback(err, 'success'); 
            });
        }
    })
}
const endconnect = () => {
    con.end();
}
module.exports = { con, selectSql, InserSql, UpdateSql, DeleteSql, endconnect };