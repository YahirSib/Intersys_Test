<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include('recursos/styles.php');
    $id = $_GET["id"];
    ?>           
    <title>Veterinaria - Mascotas</title>
</head>
<body id="body-pd" data_id="<?php echo $id;?>">
    <?php
        $pag = "Mascotas";
        include('recursos/menu.php');
    ?>
    <div class="p-6">
    <h1 class="text-5xl font-extrabold dark:text-white" >Editar mascota</h1>
    <form class="grid md:grid-rows-2 gap-6" id="frmEditar" enctype="multipart/form-data">
        <div class="md:order-1">
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="mb-6">
                    <label style="font-size: 20px" for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre: <span style="color: red">*</span></label>
                    <input style="font-size: 20px" type="text" id="nombre" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"required>
                    <div id="errorNombre"></div>
                </div>
                <div class="mb-6">
                    <label style="font-size: 20px" for="edad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Edad: <span style="color: red">*</span></label>
                    <input style="font-size: 20px" type="number" id="edad" name="edad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <div id="errorEdad"></div>
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="mb-6">
                    <label style="font-size: 20px" for="especie" class="block mb-2 text-sm font-medium text-gray-900">Especie: <span style="color: red">*</span></label>
                    <select style="font-size: 20px" type="text" id="especie" name="especie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "required>
                        <option value="0">--Seleccione una especie--</option>
                    </select>
                    <div id="errorEspecie"></div>
                </div>
                <div class="mb-6">
                    <label style="font-size: 20px" for="raza" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Raza: <span style="color: red">*</span></label>
                    <select style="font-size: 20px" type="text" id="raza" name="raza" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    
                    </select>
                    <div id="errorRaza"></div>
            </div>
            <div class="grid md:gap-6">
                <div class="mb-6">
                    <label style="font-size: 20px" for="encargado" class="block mb-2 text-sm font-medium text-gray-900">Encargado: <span style="color: red">*</span></label>
                    <select style="font-size: 20px" type="text" id="encargado" name="encargado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "required>
                        <option value="0">--Seleccione un encargado--</option>
                    </select>
                    <div id="errorEspecie"></div>
                </div>
            </div>
            <div class="flex justify-end items-end mb-6">
                <input type="hidden" value="editar" id="action" name="action">
                <input type="hidden" value="<?php echo $id;?>" id="id" name="id">
                <button style="font-size: 20px" type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
                <a href="mascotas.php" style="font-size: 20px"  class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancelar</a>
            </div>
        </div>
    </form>
    </div>
    

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="controlador/editar_mascota.js"></script>
</body>
</html>

