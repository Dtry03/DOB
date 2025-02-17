<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Botón On/Off</title>
  <style>
    /* Estilos para personalizar el aspecto del botón */
    .onoff-switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .onoff-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .onoff-slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 34px;
    }

    .onoff-slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked + .onoff-slider {
      background-color: #2196F3;
    }

    input:focus + .onoff-slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .onoff-slider:before {
      transform: translateX(26px);
    }
  </style>
</head>
<body>

<label class="onoff-switch">
  <input type="checkbox" id="onoff">
  <span class="onoff-slider"></span>
</label>

</body>
</html>
