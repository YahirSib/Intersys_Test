<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $pag = "Mascotas";
    include('recursos/styles.php');
    ?> 
    <title>Veterinaria - Mascotas</title>
</head>
<body id="body-pd">
    <?php
        include('recursos/menu.php');
    ?>
<div class="p-6">
    <div class="flex items-center justify-between">
        <h1 class="text-5xl font-extrabold" >Listado de Mascotas</h1>
        <a type="button" href="agregar_mascota.php" style="font-size: 20px" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 "> <i class='bx bx-plus'></i></a></div>
    </div>
        <div class="grid md:grid-cols-1 md:gap-6">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="font-size: 20px">
                        <tr>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                                N#
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Nombre
                            </th>
                            <th scope="col" class="py-3 px-6 ">
                                Edad
                            </th>
                            <th scope="col" class="py-3 px-6 ">
                                Especie
                            </th>
                            <th scope="col" class="py-3 px-6 ">
                                Raza
                            </th>
                            <th scope="col" class="py-3 px-6 ">
                                Encargado
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                               
                            </th>
                        </tr>
                    </thead>
                <tbody style="font-size: 20px" id="items">
                </tbody>
            </table>
        </div>
    </div>
</div>  
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="controlador/mascota.js"></script>
</body>
</html>