const express = require("express");
var BodyParser = require("body-parser")
const app = express();
const router = require("../router");


app.use(BodyParser.urlencoded({extended:false}))
app.use(BodyParser.json())
app.use('/testnode/',router)


app.listen(3000)