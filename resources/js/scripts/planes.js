

const apiURL = 'https://apiperu.dev/api/dni';
const token = 'db3ed63994d8aef68d6a7db28083109d033ee0e32211ecd7932a86dd15093a31';

const dni = '44388368'; // Reemplaza este valor con el DNI que deseas consultar

const headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${token}`
};

const body = JSON.stringify({ dni: dni });

fetch(apiURL, {
    method: 'POST',
    headers: headers,
    body: body
})
.then(response => response.json())
.then(data => {
    console.log('Response:', data);
})
.catch(error => {
    console.error('Error:', error.message);
});
