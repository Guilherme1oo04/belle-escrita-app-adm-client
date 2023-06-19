const express = require('express');
const cors = require('cors');
const nodemailer = require('nodemailer')
const app = express()

app.use(cors())
app.use(express.json())

app.post("/emailredacao", (req, res) => {
    const correcao = req.body.htmlCorrecao
    const emailEnviar = req.body.emailEnviar
    const tema = req.body.temaRed
    const nota = req.body.nota

    const transport = nodemailer.createTransport({
        host: 'smtp.gmail.com',
        port: 465,
        secure: true,
        auth: {
            user: 'EMAIL QUE IRÁ UTILIZAR',
            pass: 'SENHA DE APP GERADA PELO GOOGLE'
        }
    })

    transport.sendMail({
        from: 'Belle Escrita',
        to: emailEnviar,
        subject: `Correção da redação com tema: ${tema}`,
        html: `<h1>${tema}</h1><br>${correcao}`,
    }).then(() => res.send('deu certo')).catch((err) => console.log(err))
})

app.listen(8085, () => {
    console.log("Rodando na porta 8085")
})
