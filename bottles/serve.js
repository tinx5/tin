const express = require("express");
const app = express();

app.get("/", (req, res)=>{
    res.send('rewrewrew')
})

app.listen(3000)