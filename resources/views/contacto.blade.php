<x-app-layout>
    <section class="contacto-page">
        <h3 class="heading">Contáctanos</h3>
        <div class="content row">
            <div class="info">
                <div class="card">
                    <div class="fa-solid fa-location-dot"></div>
                    <div class="content">
                        <h3>Dirección</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam, expedita.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="fa-solid fa-phone"></div>
                    <div class="content">
                        <h3>Telefono / Celular</h3>
                        <p>+51 994 881 496</p>
                    </div>
                </div>
                <div class="card">
                    <div class="fa-solid fa-envelope"></div>
                    <div class="content">
                        <h3>Email</h3>
                        <p>sifbras@gmail.com</p>
                    </div>
                </div>
            </div>
            <form action="">
                <h3>Solicita una Cotización</h3>
                    <input type="text" placeholder="nombre" class="box">
                    <input type="email" placeholder="correo electrónico" class="box">
                    <input type="number" placeholder="teléfono" class="box">
                    <textarea name="" placeholder="Ingrese su mensaje" cols="30" rows="10" class="box"></textarea>
                    <x-button class="text-xl px-6 py-4">Enviar Mensaje</x-button>
            </form>
        </div>
    </section>
</x-app-layout>
