<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Buscador de Libros</title>
        <!-- Tailwind CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-3xl">
            <h1 class="text-3xl font-bold mb-6 text-center">
                Buscador de Libros
            </h1>
            <!-- Buscador -->
            <div class="flex gap-3 mb-6">
                <input
                    id="texto"
                    type="text"
                    placeholder="Buscar por título o autor..."
                    class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button
                    onclick="buscar()"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600"
                >
                    Buscar
                </button>
            </div>
            <!-- Resultados -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Libros -->
                <div>
                    <h2 class="text-xl font-semibold mb-2">
                        Libros
                    </h2>
                    <ul id="libros" class="space-y-2"></ul>
                </div>
                <!-- Autores -->
                <div>
                    <h2 class="text-xl font-semibold mb-2">
                        Autores
                    </h2>
                    <div id="autores" class="space-y-4"></div>
                </div>
            </div>
        </div>
        <script>
            function buscar() {

                let texto = document.getElementById("texto").value;

                fetch('/api/search?texto=' + texto)

                    .then(respuesta => respuesta.json())

                    .then(datos => {

                        let listaLibros = document.getElementById("libros");
                        let listaAutores = document.getElementById("autores");

                        listaLibros.innerHTML = "";
                        listaAutores.innerHTML = "";

                        // Mostrar libros
                        datos.books.forEach(libro => {

                            listaLibros.innerHTML += `
                                <li class="border p-2 rounded">
                                    <strong>${libro.titulo}</strong><br>
                                    <span class="text-gray-600">${libro.autor}</span>
                                </li>
                            `;

                        });

                        // Mostrar autores
                        datos.authors.forEach(autor => {

                            let html = `
                                <div class="border rounded p-3">
                                    <h3 class="font-semibold">${autor.nombre}</h3>
                            `;

                            if (autor.last_books) {

                                html += "<ul class='list-disc ml-5 mt-2'>";

                                autor.last_books.forEach(libro => {

                                    html += `<li>${libro.titulo}</li>`;

                                });

                                html += "</ul>";
                            }

                            html += "</div>";

                            listaAutores.innerHTML += html;

                        });

                    });

            }
        </script>
    </body>
</html>
