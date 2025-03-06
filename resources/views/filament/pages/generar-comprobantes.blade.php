<x-filament::page>
    <!-- Mensaje de respuesta -->
    <div id="response-message" class="hidden p-3 rounded-lg text-white mb-4"></div>

    <div class="p-6 bg-gray-900 shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Anular Comprobantes</h2>
            
        <!-- Formulario para Anular Boleta -->
        <div class="border-b border-gray-700 pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">Anular Boleta</h3>
            <form id="form-boleta" class="grid gap-2">
                @csrf
                <div class="flex space-x-2">
                    <input type="text" name="serie" class="border bg-gray-800 p-2 rounded w-24 text-white" placeholder="Serie" required>
                    <input type="text" name="correlativo" class="border bg-gray-800 p-2 rounded w-24 text-white" placeholder="Correlativo" required>
                    <input type="text" name="dni" class="border bg-gray-800 p-2 rounded w-24 text-white" placeholder="DNI" required>
                    <input type="text" name="precio" class="border bg-gray-800 p-2 rounded w-24 text-white" placeholder="Precio" required>
                </div>
                <button type="submit" class="bg-red-800 text-white p-1 rounded btn-envio-cpe w-48">Anular Boleta</button>
            </form>
        </div>
    
        <!-- Formulario para Anular Factura -->
        <div class="border-b border-gray-700 pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">Anular Factura</h3>
            <form id="form-factura" class="grid gap-2">
                @csrf
                <div class="flex space-x-3">
                    <input type="text" name="serie" class="border bg-gray-800 p-2 rounded w-24 text-white" placeholder="Serie" required>
                    <input type="text" name="correlativo" class="border bg-gray-800 p-2 rounded w-24 text-white" placeholder="Correlativo" required>
                    <textarea name="motivo" class="border bg-gray-800 p-2 rounded w-full text-white resize-none" placeholder="Motivo" maxlength="250" rows="1" required></textarea>
                </div>
                <button type="submit" class="bg-red-800 text-white p-1 rounded btn-envio-cpe w-48">Anular Factura</button>
            </form>
        </div>
    
        <!-- Formulario para Nota de Crédito -->
        <div class="border-b border-gray-700 pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">Nota de Crédito</h3>
            <form id="form-nota-credito" class="grid gap-4">
                @csrf
                <div class="flex space-x-4">
                    <input type="text" name="serie" class="w-24 border bg-gray-800 p-2 rounded text-white" placeholder="Serie" required>
                    <input type="text" name="correlativo" class="w-24 border bg-gray-800 p-2 rounded text-white" placeholder="Correlativo" required>
                    <input type="text" name="precio" class="w-24 border bg-gray-800 p-2 rounded text-white" placeholder="Precio" required>                    
                    <textarea name="motivo" class="border bg-gray-800 p-2 rounded text-white resize-none w-full" placeholder="Motivo" maxlength="250" rows="1" required></textarea>
                </div>
                
                <button type="submit" class="bg-amber-600 text-white p-1 rounded btn-envio-cpe w-48">
                    Generar Nota de Crédito
                </button>
            </form>
        </div>
    
        <!-- Formulario para Nota de Débito -->
        <div class="border-b border-gray-700 pb-4 mb-4">
            <h3 class="text-lg font-semibold mb-2">Nota de Débito</h3>
            <form id="form-nota-debito" class="grid gap-4">
                @csrf
                <div class="flex space-x-4">
                    <input type="text" name="serie" class="w-24 border bg-gray-800 p-2 rounded text-white" placeholder="Serie" required>
                    <input type="text" name="correlativo" class="w-24 border bg-gray-800 p-2 rounded text-white" placeholder="Correlativo" required>
                    <input type="text" name="precio" class="w-24 border bg-gray-800 p-2 rounded text-white" placeholder="Precio" required>                    
                    <textarea name="motivo" class="border bg-gray-800 p-2 rounded text-white resize-none w-full" placeholder="Motivo" maxlength="250" rows="1" required></textarea>
                </div>
                
                <button type="submit" class="bg-amber-600 text-white p-1 rounded btn-envio-cpe w-48">
                    Generar Nota de Débito
                </button>
            </form>
        </div>
    </div>
    



    <!-- Script para manejar respuestas -->
    <script>
        
        const toggleBotones = (estado) => {
            const botones = document.querySelectorAll(".btn-envio-cpe");
            botones.forEach(btn => {
                btn.disabled = estado;
                btn.style.opacity = estado ? "0.5" : "";
                btn.style.cursor = estado ? "not-allowed" : "";
            });
        };

        async function enviarFormulario(event, url) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);

            toggleBotones(true);

            const response = await fetch(url, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            });

            const data = await response.json();
            mostrarMensaje(data.status, data.message);

            toggleBotones(false);
        }

        function mostrarMensaje(status, message) {
            const messageDiv = document.getElementById("response-message");
            messageDiv.textContent = message;
            messageDiv.classList.remove("hidden");

            if (status === "success") {
                messageDiv.classList.add("bg-green-500");
            } else {
                messageDiv.classList.add("bg-red-500");
            }

            setTimeout(() => {
                messageDiv.classList.add("hidden");
                messageDiv.classList.remove("bg-green-500", "bg-red-500");
            }, 3000);
        }

        document.getElementById("form-boleta").addEventListener("submit", (event) => {
            enviarFormulario(event, "{{ url('/anular-boleta') }}");
        });

        document.getElementById("form-factura").addEventListener("submit", (event) => {
            enviarFormulario(event, "{{ url('/anular-factura') }}");
        });

        document.getElementById("form-nota-credito").addEventListener("submit", (event) => {
            enviarFormulario(event, "{{ url('/nota-credito') }}");
        });

        document.getElementById("form-nota-debito").addEventListener("submit", (event) => {
            enviarFormulario(event, "{{ url('/nota-debito') }}");
        });
    </script>
</x-filament::page>
