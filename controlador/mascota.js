$(document).ready(function(){
	function mostrarMascotas(){
		let action = "mostrar";
		$.ajax({
			url: 'controlador/mascotas_check.php',
			type: 'POST',
			data:{
				action: action
			},
			success: function (respuesta) {
                var resultado = "";
                var mascotas = JSON.parse(respuesta);
                if (mascotas.status == false) {
                    resultado = mascotas.msg;
                } else {
                    mascotas.data.forEach(mascota => {
                        resultado += `
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${mascota.id_mascota}
                            </th>
                            <td class="py-4 px-6">
                                ${mascota.nombre}
                            </td>
                            <td class="py-4 px-6">
                                ${mascota.edad}
                            </td>
                            <td class="py-4 px-6">
                                ${mascota.especie}
                            </td>
							<td class="py-4 px-6">
                                ${mascota.raza}
                            </td>
							<td class="py-4 px-6">
                                ${mascota.encargado}
                            </td>
                            <td class="py-4 px-6">
                                <div class="grid grid-cols-3 gap-3 w-full"> 
                                    <a href = "editar_mascota.php?id=${mascota.id_mascota}"style="font-size: 20px" class="editar font-medium text-green-600 underline dark:text-green-500 hover:no-underline cursor-pointer" type="button" data-modal-toggle="question"><i class='bx bx-edit'></i></a>
                                    <a  data_id="${mascota.id_mascota}" style="font-size: 20px; " class="eliminar font-medium text-red-600 underline dark:text-red-500 hover:no-underline cursor-pointer" type="button" data-modal-toggle="question"><i class='bx bx-trash'></i></a>
                                </div>    
                            </td>
                        </tr>        
                        `
                    });
                }
                $('#items').html(resultado);
            },
            error: function (error) {
                console.log(error);
            }
		})
	}
	if($("#items").length){
		mostrarMascotas();
	}

    $(document).on('click', '.eliminar', function () {
        let id = $(this).attr("data_id");
        var modal = "";
        modal += `
        <div z-50 id='fondoM' modal-backdrop='' class='fondo bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40'></div>
        <div id="question" aria-modal="true" role="dialog" tabindex="-1" class="fondo flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full items-center justify-center" >
        <div class="relative p-4 w-full max-w-md h-full md:h-auto flex items-center justify-center">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                <div class="p-6 text-center">
                    <i class='bx bx-question-mark' style='color:#2a3891; font-size: 50px' ></i>                
                    <h3 style="font-size: 25px"  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro(a) de eliminar el trabajador con id: `+ id + `?</h3>
                    <button id="borrar" data-id="`+ id + `" style="font-size: 20px"  type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Aceptar</button>
                    <button id="cerrar" style="font-size: 20px"  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancelar</button>
                </div>
            </div>
        </div>
        `;
        $("body").append(modal);
    });

    $(document).on('click', '#borrar', function () {
        $("#question").remove();
        let action = "eliminar";
        let id = $(this).attr("data-id");
        $.ajax({
            url: 'controlador/mascotas_check.php',
            type: 'POST',
            data: {
                action: action,
                id: id
            },
            success: function (respuesta) {
                var area = JSON.parse(respuesta);
                if (area.status == false) {
                    var modal = "";
                    modal += `
                    <div id="error" aria-modal="true" role="dialog" tabindex="-1" class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto flex items-center justify-center">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                                <div class="p-6 text-center">
                                    <i class='bx bx-x-circle' style='color:#2a3891; font-size: 50px' ></i>                
                                    <h3 style="font-size: 25px"  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Ha ocurrido un error. Por favor intente de nuevo</h3>
                                    <button id="cerrar" style="font-size: 20px"  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    $("body").append(modal);
                } else {
                    var modal = "";
                    modal += `
                    <div id="success" aria-modal="true" role="dialog" tabindex="-1" class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto flex items-center justify-center">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                                <div class="p-6 text-center">
                                    <i class='bx bx-check-circle' style='color:#2a3891; font-size: 50px' ></i>                
                                    <h3 style="font-size: 25px"  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¡El elemento ha sido eliminado con éxito!</h3>
                                    <button id="cerrar" style="font-size: 20px" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    $("body").append(modal);
                }
            }
        });
        mostrarMascotas();
    });

    $(document).on('click','#cerrar',function(){
        $("#fondoM").remove();
        $("#error").remove();
        $("#success").remove();
    });
    
})