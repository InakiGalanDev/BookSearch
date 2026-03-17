<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscador de Libros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto p-8">
        <h1 class="text-4xl font-bold text-center mb-8">
            Buscador de Libros
        </h1>
        <div class="flex gap-4 mb-10 justify-center">
            <input
                id="texto"
                type="text"
                placeholder="Buscar por título o autor..."
                class="w-96 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button
                onclick="buscar()"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Buscar
            </button>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div>
                <h2 class="text-2xl font-semibold mb-4">
                    Libros encontrados
                </h2>
                <div id="libros" class="grid grid-cols-2 gap-4"></div>
            </div>
            <div>
                <h2 class="text-2xl font-semibold mb-4">
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
                // LIBROS
                datos.books.forEach(libro => {

                    listaLibros.innerHTML += `
                        <div class="bg-white shadow rounded-lg p-4 hover:shadow-lg transition">
                            <img
                                src="${libro.portada}"
                                alt="${libro.titulo}"
                                class="w-full h-40 object-cover rounded mb-3"
                            >
                            <h3 class="font-semibold text-sm">
                                ${libro.titulo}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                ${libro.autor}
                            </p>
                        </div>
                    `;
                });
                // AUTORES
                datos.authors.forEach(autor => {
                    let html = `
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-semibold text-lg mb-2">
                                ${autor.nombre}
                            </h3>
                    `;
                    if (autor.last_books) {
                        html += `
                            <p class="text-sm text-gray-500 mb-2">
                                Últimos libros
                            </p>
                            <div class="grid grid-cols-2 gap-3">
                        `;

                        autor.last_books.forEach(libro => {
                            html += `
                                <div class="border rounded p-2 text-center">
                                    <img
                                        src="${libro.portada}"
                                        class="h-24 mx-auto mb-2"
                                    >
                                    <p class="text-xs font-medium">
                                        ${libro.titulo}
                                    </p>
                                </div>
                            `;
                        });
                        html += "</div>";
                    }
                    html += "</div>";
                    listaAutores.innerHTML += html;
                });
            });
        }
    </script>
</body>

</html>
