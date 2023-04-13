const express = require("express");
const router = express.Router();
const tools = require("./pages/connect.js");


router.post("/getOne", (req,res)=>{
    const {id}  = req.body;
    if(!id){
        res.send("Id is required!")
    }else{
        var selectById = "SELECT `id`, `name`, `status`, `description`, `created`, `updated` FROM `bottle` WHERE id = ?"
    const SelectOne = new Promise ((resolve, rejects)=>{
        tools.selectSql(selectAll,[id], (err, result) => {
            if (err || result.length === 0) rejects(err) ;
            resolve(result);
        })
    })
    SelectOne
    .then(data=>{
            res.send(data)
        })
     .catch((err)=>{
            res.send(err)
        })
    }
    
})

router.post("/getAll", (req,res)=>{
    var selectAll = "SELECT `id`, `name`, `status`, `description`, `created`, `updated` FROM `bottle`"
    const SelectAllsql = new Promise ((resolve, rejects)=>{
        tools.selectSql(selectAll,'', (err, result) => {
            if (err || result.length === 0) rejects(err) ;
            resolve(result);
        })
    })
    SelectAllsql
    .then(data=>{
            res.send(data)
        })
     .catch((err)=>{
            res.send(err)
        })
})

router.post("/Update", (req,res)=>{
    const {id, status}  = req.body;
    if(!id){
        res.send("Id is required!")
    } else if(!status){
        res.send("Status is required!")
    }else{
         var UpdateById = `UPDATE bottle SET status='${status}' WHERE id=${id}`
    const Update = new Promise ((resolve, rejects)=>{
        tools.UpdateSql(UpdateById, (err, result) => {
            if (err) rejects(err) ;
            resolve('success');
        })
    })
    Update
    .then(data=>{
            res.send(data)
        })
     .catch((err)=>{
            res.send(err)
        })
    }
   
})

router.post("/UpdateMany", (req,res)=>{
    const {id, status, name}  = req.body;
    if(!id){
        res.send("Id is required!")
    }else if(!name || name ===''){
        res.send("Id is required!")
    } else if(!status){
        res.send("Status is required!")
    }else{
        var UpdateManyById = `UPDATE bottle SET status='${status}', name='${name}' WHERE id=${id}`

    const Update = new Promise ((resolve, rejects)=>{
        tools.UpdateSql(UpdateManyById, (err, result) => {
            if (err) rejects(err) ;
            resolve('success');
        })
    })
    Update
    .then(data=>{
            res.send(data)
        })
     .catch((err)=>{
            res.send(err)
        })
    }
    
})

router.post("/DeleteOne", (req,res)=>{
    const {id} = req.body;
    if(!id){
        res.send("Id is required!")
    }else{
    var Deletesql = "DELETE FROM `bottle` WHERE id = ?"
    const DeleteOne = new Promise ((resolve, rejects)=>{
        tools.DeleteSql(Deletesql,[id], (err, result) => {
            if (err) rejects(err) ;
            resolve(result);
        })
    })
    DeleteOne
    .then(data=>{
            res.send(data)
        })
     .catch((err)=>{
            res.send(err)
        })
    }
})
router.post("/DeleteMany", (req,res)=>{
    const {id, status} = req.body;
    if(!id){
        res.send("Id is required!")
    } else if(!status){
        res.send("Status is required!")
    }else{
    var Deletesql = "DELETE FROM `bottle` WHERE id = "+id+" AND status ="+status
    const DeleteMany = new Promise ((resolve, rejects)=>{
        tools.DeleteSql(Deletesql,'', (err, result) => {
            if (err) rejects(err) ;
            resolve(result);
        })
    })
    DeleteMany
    .then(data=>{
            res.send(data)
        })
     .catch((err)=>{
            res.send(err)
        })
    }
})
module.exports = router;