<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Open Pay</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class='main-container'>
    <p class='main-description'>
      <span>Vas a pagar el importe de S/ 200.</span>
      Selecciona el método de pago que quieras usar:
    </p>

    <div class='payment-methods' id='payment-methods'>
      <div
        class='payment-methods__method payment-methods__method--selected'
        id='payment-card'
        data-method='method-card'
      >
        <img src="./images/tarjeta.svg" alt="tarjeta">
        <span>Tarjeta de crédito o débito</span>
      </div>
      <div
        class='payment-methods__method'
        id='payment-digital'
        data-method='method-digital'
      >
        <img src="./images/digital.svg" alt="digital">
        <span>Pago digital a través de la App o Web de tu banco</span>
      </div>
      <div
        class='payment-methods__method'
        id='payment-agent'
        data-method='method-agent'
      >
        <img src="./images/agentes.svg" alt="agentes">
        <span>Pago presencial en agentes, agencias o establecimientos afiliados</span>
      </div>
    </div>

    <div class='method-card' id='method-card'>
      <div class='method-card__images'>
        <img src="./images/visa.svg" alt="visa">
        <img src="./images/mastercard.svg" alt="mastercard">
        <img src="./images/american-express.svg" alt="american-express">
        <img src="./images/diners.svg" alt="diners">
      </div>
      <p class='method-card__description'>
        Recuerda que algunas tarjetas cuentan con el código de seguridad o CVV Dinámico,
        consúltalo desde el App de tu banco.
      </p>
      <div class='method-card__inputs'>
        <input
          type="text"
          placeholder='Nombre del Titular'
        >
        <input
          type="text"
          placeholder='Fecha de Expiración MM/AA'
        >
        <input
          type="text"
          placeholder='Número de la Tarjeta'
        >
        <input
          type="text"
          placeholder='Código de seguridad'
        >
        <select name="" id="">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <button class='method-card__button'>
        Pagar
      </button>
    </div>

    <div class='method-digital' id='method-digital' style='display: none;'>
      <div class='method-digital__images'>
        <img src="./images/bbva.svg" alt="bbva">
        <img src="./images/bcp.svg" alt="bcp">
        <img src="./images/interbank.svg" alt="interbank">
        <img src="./images/scotiabank.svg" alt="scotiabank">
      </div>
      <p class='method-digital__description'>
        En la App o Web de tu banco ingresa a la opción <span>"Pago de Servicios"</span>,
        busca <span>"Kashio"</span>, coloca el código de pago que llegará a tu correo
        electrónico y realiza el pago.
      </p>
      <button class='method-digital__button'>
        Genera tu código
      </button>
    </div>

    <div class='method-digital' id='method-agent' style='display: none;'>
      <div class='method-digital__images'>
        <img src="./images/bbva.svg" alt="bbva">
        <img src="./images/bcp.svg" alt="bcp">
        <img src="./images/interbank.svg" alt="interbank">
        <img src="./images/scotiabank.svg" alt="scotiabank">
        <img src="./images/tambo.svg" alt="tambo">
        <img src="./images/kasnet.svg" alt="kasnet">
      </div>
      <p class='method-digital__description'>
        Paga en agentes, agencias o establecimientos afiliados con el código de
        referencia que llegará a tu correo electrónico, indicando que deseas
        pagar <span>"Kashio"</span>.
      </p>
      <button class='method-digital__button'>
        Genera tu código
      </button>
    </div>
  </div>

  <script src="./main.js"></script>
</body>
</html>