<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Consulta de IP</title>
    <style>
      body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
        text-align: center;
      }

      h1 {
        color: #333;
        font-size: 2.5em;
        margin-bottom: 0.5em;
      }

      input[type="text"] {
        font-size: 1.2em;
        padding: 0.5em;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-left: 0.5em;
        width: 250px;
      }

      button {
        font-size: 1.2em;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 0.5em 1em;
        cursor: pointer;
      }

      .result input[type="text"] {
        font-size: 1.2em;
        padding: 0.5em;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 100%;
      }
    </style>
    <script>
      function getIP() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            var ip = this.responseText;
            document.getElementById("ip-input").value = ip;
          }
        };
        xhr.open("GET", "ip.php", true);
        xhr.send();
      }
    </script>
  </head>
  <body onload="getIP()">
    <h1>Consulta de IP</h1>
    <label for="ip-input">Seu endereço IP:</label>
    <input type="text" id="ip-input" />
    <button id="btn-consultar">Consultar</button>
    <div id="resultado"></div>
    <script>
      const inputIP = document.querySelector("#ip-input");
      const btnConsultar = document.querySelector("#btn-consultar");
      const resultado = document.querySelector("#resultado");

      btnConsultar.addEventListener("click", () => {
        const ip = inputIP.value;
        const url = `https://ipapi.co/${ip}/json/`;

        fetch(url)
          .then((response) => response.json())
          .then((data) => {
            const cidade = data.city || "Não encontrado";
            const estado = data.region || "Não encontrado";
            const pais = data.country_name || "Não encontrado";
            const provedor = data.org || "Não encontrado";
            const latitude = data.latitude || "Não encontrado";
            const longitude = data.longitude || "Não encontrado";

            resultado.innerHTML = `
            <p><strong>Cidade:</strong> ${cidade}</p>
            <p><strong>Estado:</strong> ${estado}</p>
            <p><strong>País:</strong> ${pais}</p>
            <p><strong>Provedor:</strong> ${provedor}</p>
            <p><strong>Latitude:</strong> ${latitude}</p>
            <p><strong>Longitude:</strong> ${longitude}</p>
          `;
          })
          .catch((error) => {
            console.error(`Erro ao consultar API do IP-API.com: ${error}`);
          });
      });
    </script>
  </body>
</html>
