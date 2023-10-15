const express = require('express');
const cors = require('cors');
const nodemailer = require('nodemailer')
const app = express()
require('dotenv/config')

const emailSender = process.env.EMAIL_SENDER
const passwordSender = process.env.APP_PASSWORD_SENDER

app.use(cors())
app.use(express.json())

app.post("/emailredacao", (req, res) => {
    const correcao = req.body.htmlCorrecao
    const emailEnviar = req.body.emailEnviar
    const tema = req.body.temaRed
    const nota1 = req.body.nota1
    const nota2 = req.body.nota2
    const nota3 = req.body.nota3
    const nota4 = req.body.nota4
    const nota5 = req.body.nota5

    const transport = nodemailer.createTransport({
        host: 'smtp.gmail.com',
        port: 465,
        secure: true,
        auth: {
            user: emailSender,
            pass: passwordSender
        }
    })

    transport.sendMail({
        from: 'Belle Escrita',
        to: emailEnviar,
        subject: `Correção da redação com tema: ${tema}`,
        html: `<h1>${tema}</h1><br><h2>COMPETÊNCIA 1: ${nota1}</h2><h2>COMPETÊNCIA 2: ${nota2}</h2><h2>COMPETÊNCIA 3: ${nota3}</h2><h2>COMPETÊNCIA 4: ${nota4}</h2><h2>COMPETÊNCIA 5: ${nota5}</h2><br>${correcao}`,
    }).then(() => res.send('deu certo')).catch((err) => console.log(err))
})

app.listen(8085, () => {
    console.log("Rodando na porta 8085")
})
