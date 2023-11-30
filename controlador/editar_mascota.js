$(document).ready(function(){
    if($('#especie').length){
        mostrarEspecie();
    }
    
    function mostrarEspecie(){
        let action = "mostrar";
        $.ajax({
            url: 'controlador/especies_check.php',
            type: 'POST',
            data:{
                action: action
            },
            success: function (respuesta) {
                var resultado = "";
                var especies = JSON.parse(respuesta);
                if (especies.status == false) {
                    resultado = especies.msg;
                } else {
                    especies.data.forEach(especie => {
                        resultado += `
                        <option value = "${especie.id_especie}">${especie.nombre}</option>
                        `
                    });
                }
                $('#especie').append(resultado);
            },
            error: function (error) {
                console.log(error);
            }
        })
    }
    
    if($('#encargado').length){
        mostrarEncargado();
    }
    
    function mostrarEncargado(){
        let action = "mostrar";
        $.ajax({
            url: 'controlador/clientes_check.php',
            type: 'POST',
            data:{
                action: action
            },
            success: function (respuesta) {
                var resultado = "";
                var clientes = JSON.parse(respuesta);
                if (clientes.status == false) {
                    resultado = clientes.msg;
                } else {
                    clientes.data.forEach(cliente => {
                        resultado += `
                        <option value = "${cliente.id_cliente}">${cliente.nombre}</option>
                        `
                    });
                }
                $('#encargado').append(resultado);
            },
            error: function (error) {
                console.log(error);
            }
        })
    }
    

    $(document).on('click','#cerrar',function(){
        $("#fondoM").remove();
        $("#error").remove();
        $("#success").remove();
    });

    let x = 0;
    id = $("body").attr("data_id");
    action = "ficha";
    $.ajax({
        url: 'controlador/mascotas_check.php',
        type: 'POST',
        data: {
            action: action,
            id: id
        },
        success: async function (respuesta) {
            var mensaje = JSON.parse(respuesta);
            if (mensaje.status == false) {
                var modal = "";
                modal += `
                <div z-50 id='fondoM' modal-backdrop='' class='fondo bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40'></div>
            <div id="error" aria-modal="true" role="dialog" tabindex="-1" class="fondo flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center">
                <div class="relative p-4 w-full max-w-md h-full md:h-auto flex items-center justify-center">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-6 text-center">
                            <i class='bx bx-x-circle' style='color:#2a3891; font-size: 50px' ></i>                
                            <h3 style="font-size: 25px"  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">${mensaje.msg}</h3>
                            <button id="cerrar" style="font-size: 20px"  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
                $("body").append(modal);
            } else {
                mensaje.data.forEach(mascota =>{
                    $("#nombre").val(mascota.nombre);
                    $("#edad").val(mascota.edad);
                    $("#especie").val(mascota.especie);
                    mostrarRaza(mascota.especie);
                    x = mascota.raza;
                    $("#encargado").val(mascota.encargado);
                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });

    
    $('#especie').change(function(){
        let id = $('#especie').val();
        if(id == 0){
            let resultado = '<option value=0>---</option>'
            $('#raza').html(resultado);
        }else{
            mostrarRaza(id);
        }
    })
    
    function mostrarRaza(id){
        let action = "mostrar";
        $.ajax({
            url: 'controlador/raza_check.php',
            type: 'POST',
            data:{
                action: action,
                id: id
            },
            success: function (respuesta) {
                var resultado = "";
                var razas = JSON.parse(respuesta);
                if (razas.status == false) {
                    resultado = `<option value=0>---</option>`;
                } else {
                    razas.data.forEach(raza => {
                        if(x == raza.id_raza){
                            resultado += `
                                <option selected value = "${raza.id_raza}">${raza.nombre}</option>
                            `
                        }else{
                            resultado += `
                            <option value = "${raza.id_raza}">${raza.nombre}</option>
                            `
                        }
                    });
                }
                $('#raza').html(resultado);
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    $('#frmEditar').submit(function(e){
        var estado = true;
        if($('#nombre').val() == ""){
            var resultado = "";
            resultado += "<p> Nombre vacio</p>";
            $('#errorNombre').html(resultado);
            estado = false;
        }else{
            let texto = $('#nombre').val();
            let validar = /^[a-zA-zÁáÉéÍíÓóÚú\s]{3,}$/;
            if(!validar.test(texto)){
                var resultado = "";
                resultado += "<p> Nombre ingresado incorrecto </p>"
                $('#errorNombre').html(resultado);
                estado = false;
            }
        }
    
        if($('#edad').val() == ""){
            var resultado = "";
            resultado += "<p> Edad vacia </p>"
            $('#errorEdad').html(resultado);
            estado = false;
        }else{
            let texto = $('#edad').val();
            let valida = /^[0-9]{1,}$/;
            if(!valida.test(texto)){
                var resultado = "";
                resultado += "<p> Edad necesario en numeros</p>";
                $('#errorEdad').html(resultado);
                estado = false;
            }else{
                if($('#edad').val() < 0){
                    var resultado = "";
                    resultado += "<p> Edad negativa invalida</p>";
                    $('#errorEdad').html(resultado);
                    estado = false;
                }	
            }
        }
    
        if($('#especie').val() == ""){
            var resultado = "";
            resultado += "<p> Especie vacia </p>"
            $('#errorEspecie').html(resultado);
            estado = false;
        }else{
            let texto = $('#especie').val();
            let valida = /^[0-9]{1,}$/;
            if(!valida.test(texto)){
                var resultado = "";
                resultado += "<p> Especie incorrecta</p>";
                $('#errorEspecie').html(resultado);
                estado = false;
            }else{
                if($('#edad').val() < 0){
                    var resultado = "";
                    resultado += "<p> Especie incorrecta </p>";
                    $('#errorEspecie').html(resultado);
                    estado = false;
                }	
            }
        }
    
        if($('#raza').val() == ""){
            var resultado = "";
            resultado += "<p> Raza vacia </p>"
            $('#errorRaza').html(resultado);
            estado = false;
        }else{
            let texto = $('#raza').val();
            let valida = /^[0-9]{1,}$/;
            if(!valida.test(texto)){
                var resultado = "";
                resultado += "<p> Raza incorrecta</p>";
                $('#errorRaza').html(resultado);
                estado = false;
            }else{
                if($('#raza').val() < 0){
                    var resultado = "";
                    resultado += "<p> Raza incorrecta </p>";
                    $('#errorRaza').html(resultado);
                    estado = false;
                }	
            }
        }
    
        if($('#encargado').val() == ""){
            var resultado = "";
            resultado += "<p> Encargado vacio</p>"
            $('#errorEncargado').html(resultado);
            estado = false;
        }else{
            let texto = $('#encargado').val();
            let valida = /^[0-9]{1,}$/;
            if(!valida.test(texto)){
                var resultado = "";
                resultado += "<p> Encargado incorrecta</p>";
                $('#errorEncargado').html(resultado);
                estado = false;
            }else{
                if($('#encargado').val() < 0){
                    var resultado = "";
                    resultado += "<p> Encargado incorrecta </p>";
                    $('#errorEncargado').html(resultado);
                    estado = false;
                }	
            }
        }
    
        if (estado == true) {
            $.ajax({
                url: 'controlador/mascotas_check.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                async: false,
                success: function (respuesta) {
                    var mensaje = JSON.parse(respuesta);
                    if (mensaje.status == false) {
                        console.log("hola");
                        var modal = "";
                        modal += `
                        <div z-50 id='fondoM' modal-backdrop='' class='fondo bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40'></div>
                    <div id="error" aria-modal="true" role="dialog" tabindex="-1" class="fondo flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto flex justify-center items-center">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                                <div class="p-6 text-center">
                                    <i class='bx bx-x-circle' style='color:#2a3891; font-size: 50px' ></i>                
                                    <h3 style="font-size: 25px"  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">${mensaje.msg}</h3>
                                    <button id="cerrar" style="font-size: 20px"  type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                        $("body").append(modal);
                    } else {
                        console.log("hola2");
                        var modal = "";
                        modal += `
                        <div z-50 id='fondoM' modal-backdrop='' class='fondo bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40'></div>
                    <div id="success" aria-modal="true" role="dialog" tabindex="-1" class="fondo flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto flex items-center justify-center">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                                <div class="p-6 text-center">
                                    <i class='bx bx-check-circle' style='color:#2a3891; font-size: 50px' ></i>                
                                    <h3 style="font-size: 25px"  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">${mensaje.msg}</h3>
                                    <button id="cerrar" style="font-size: 20px" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                        $("body").append(modal);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    e.preventDefault();  
    });
    
    

})