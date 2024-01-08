const express = require('express')
const app = express()
const port = 3000

app.get('/meme', (req, res) => {
  res.json([{"id": "123", "lower": "abc"}, {"id": "456", "lower": "abc"}]);
})

app.get('/meme/:id', (req, res) => {
  const id = req.params.id;
  // suchen...
  res.json({"id": "123", "lower": "abc"});
})

app.post('/meme', (req, res) => {
  // ...
})

app.put('/meme/:id', (req, res) => {
    // ...
    const id = req.params.id;
})

app.delete('/meme/:id', (req, res) => {
    // ...
    const id = req.params.id;
})

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})