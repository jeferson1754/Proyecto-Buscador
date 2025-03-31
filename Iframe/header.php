<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8846655159.js" crossorigin="anonymous"></script>


    <title>Copia al Portapapeles</title>
    <style>
        .buttons-container {
            display: flex;
            flex-direction: column;
            /* Alineación vertical */
            align-items: center;
            /* Centrar los botones horizontalmente */
            gap: 5px;
            /* Espacio entre botones */
            margin-top: 10px;
        }

        .buttons-container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            width: 5px;
            /* Ajusta el ancho de los botones según sea necesario */
            justify-content: center;
            /* Centrar el texto e ícono */
        }

        .buttons-container button:hover {
            background-color: #0056b3;
        }

        .buttons-container button i {
            font-size: 15px;
        }


        .toast {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>