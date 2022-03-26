<x-app-layout>
    <section class="contacto-page">
        <h3 class="heading">Contáctanos</h3>
        <div class="content row">
            <div class="info">
                <div class="card">
                    <div class="fa-solid fa-location-dot"></div>
                    <div class="text">
                        <h3>Dirección</h3>
                        <p>Av. Huaynacápac Mz BC Lt 12 Urb. Bellavista Jicamarca – Anexo 22</p>
                    </div>
                </div>
                <div class="card">
                    <div class="fa-solid fa-phone"></div>
                    <div class="text">
                        <h3>Telefono / Celular</h3>
                        <p>+51 994 881 496</p>
                    </div>
                </div>
                <div class="card">
                    <div class="fa-solid fa-envelope"></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>sifbras@gmail.com</p>
                    </div>
                </div>
            </div>
            <form action="" id="form-contact" autocomplete="off">
                <h3>Solicita una Cotización</h3>
                    <input type="text" name="nombre" placeholder="Nombre" class="box">
                    <small class="form-error error-nombre"></small>
                    <input type="email" name="email" placeholder="Correo electrónico" class="box">
                    <small class="form-error error-email"></small>
                    <input type="number" name="telefono" placeholder="Teléfono" class="box">
                    <input type="text" name="asunto" placeholder="Asunto" class="box">
                    <small class="form-error error-asunto"></small>
                    <textarea name="mensaje" placeholder="Ingrese su mensaje" cols="30" rows="10" class="box"></textarea>
                    <small class="form-error error-mensaje"></small>
                    <br>
                    <x-button class="btn-form-contact text-xl px-6 py-4 my-4">Enviar Mensaje</x-button>
            </form>
        </div>
    </section>

    {{-- Javascript --}}
   @push('js')
        <script src="{{ asset('js/formContact.js') }}" ></script>
    @endpush
</x-app-layout>


