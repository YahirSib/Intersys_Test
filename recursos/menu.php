

<nav class="bg-white border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a class="flex items-center space-x-3 ">
        <span class="self-center text-2xl font-semibold whitespace-nowrap">Veterinaria</span>
    </a>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      
        <?php
            if($pag == "Clientes"){
        ?>
            <li>
                <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0  " aria-current="page">Clientes</a>
            </li>
            <li>
                <a href="mascotas.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Mascotas</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Especies</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Razas</a>
            </li>   
        <?php
            }
            if($pag == "Mascotas"){
        ?>
            <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Clientes</a>
            </li>
            <li>
                <a href="mascotas.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0  " aria-current="page">Mascotas</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Especies</a>
            </li>
            <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Razas</a>
            </li>
        <?php        
            }
        ?>
      </ul>
    </div>
  </div>
</nav>
