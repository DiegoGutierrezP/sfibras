
<x-app-layout>
    <section class="home" >
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <section class="swiper-slide slide" style="background: url(../storage/cliente/banner2.jpg) no-repeat;">
                    <div class="content">
                        <h3>Señalizacion Vial</h3>
                        <p>Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Perferendis quas facere nesciunt,
                         totam numquam soluta!</p>
                        <x-button-redirect href="#section-about" class="text-xl px-6 py-4">Saber mas</x-button-redirect>
                    </div>
                </section>
                <section class="swiper-slide slide" style="background: url(../storage/cliente/banner4.jpg) no-repeat;">
                    <div class="content">
                        <h3>Solicita una cotización</h3>
                        <p>Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Perferendis quas facere nesciunt,
                         totam numquam soluta!</p>
                         <x-button-redirect href="{{route('contacto')}}" class="text-xl px-6 py-4">Cotizar Aqui</x-button-redirect>
                    </div>
                </section>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    {{-- about section --}}

    <section class="about" id="section-about">
        <h1 class="heading">Nosotros</h1>
        <div class="row">
            <div class="img">
                <img src="{{Storage::url('cliente/nosotros.jpg')}}" alt="nosotros">
            </div>
            <div class="content">
                <h3>SGG Fibras y Servicios</h3>
                <p>
                    Fibras y Servicios desde
                    2010 se ha concentrado en dar
                    solución integral a los
                    Requerimientos que se generan
                    en todas las etapas de la
                    señalización vertical, industrial y
                    afines a nivel nacional. Esta
                    experiencia ha otorgado a la
                    empresa el suficiente respaldo y
                    confianza de sus clientes.
                    Somos una empresa dedicada a
                    la Comercialización, Producción
                    y Servicios de Señales Verticales
                    Reflectivos en fibra de vidrio y
                    afines, Industriales.
                </p>
                {{-- <x-button-redirect href="" class="text-xl px-6 py-4">Saber mas</x-button-redirect> --}}
            </div>
        </div>

        <div class="box-container">
            <div class="box">
                {{-- <h3>10+</h3> --}}
                <img src="{{Storage::url('cliente/like-svgrepo-com.svg')}}" alt="">
                <p>Mas de 10 años de experiencia</p>
            </div>
            <div class="box">
                {{-- <h3>1100+</h3> --}}
                <img src="{{Storage::url('cliente/worker-svgrepo-com.svg')}}" alt="">
                <p>Fabricación de acuerdo a los requerimientos</p>
            </div>
            <div class="box">
                {{-- <h3>20+</h3> --}}
                <img src="{{Storage::url('cliente/time-svgrepo-com.svg')}}" alt="">
                <p>Puntualidad en las entregas</p>
            </div>
        </div>

    </section>

    {{-- Section Services --}}

    <section class="services">
        <h1 class="heading">Servicios</h1>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="{{Storage::url('cliente/señales1.jpeg')}}" alt="">
                </div>
                <div class="content">
                    <div class="info">
                        <h3>Señales Verticales</h3>
                        {{-- <p>Señales informativas, preventivas y reglamentarias, auxiliares y otros</p> --}}
                    </div>
                    <a href="{{route('servicios','señales-verticales')}}"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="{{Storage::url('cliente/tachon1.jpeg')}}" alt="">
                </div>
                <div class="content">
                    <div class="info">
                        <h3>Señales Horizontales</h3>
                        {{-- <p>Tachones viales reflectivas.</p> --}}
                    </div>
                    <a href="{{route('servicios','señales-horizontales')}}"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="{{Storage::url('cliente/hitosk1.jpeg')}}" alt="">
                </div>
                <div class="content">
                    <div class="info">
                        <h3>Hitos Kilometricos</h3>
                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus harum hic aliquam alias asperiores tempora?</p> --}}
                    </div>
                    <a href="{{route('servicios','hitos')}}"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
    </section>

    {{-- Section projects --}}
    <section class="projects" >
        <h1 class="heading">Nuestros Trabajos <a href="{{route('trabajos')}}" > <span>Ver Mas</span> </a> </h1>

        <div class="box-container">
            <div class="box">
                <img src="{{Storage::url('cliente/paneles_grandes.jpeg')}}" alt="paneles_grandes" data-img-trabajos>
            </div>
            <div class="box">
                <img src="{{Storage::url('cliente/paneles_60x60.jpeg')}}" alt="panel_60x60" data-img-trabajos>
            </div>
            <div class="box">
                <img src="{{Storage::url('cliente/img1.jpg')}}" alt="" data-img-trabajos>
            </div>
            <div class="box">
                <img src="{{Storage::url('cliente/hitoskilometricos.jpeg')}}" alt="" data-img-trabajos>
            </div>
            <div class="box">
                <img src="{{Storage::url('cliente/postes.jpeg')}}" alt="postes" data-img-trabajos>
            </div>
            <div class="box">
                <img src="{{Storage::url('cliente/tachon1.jpeg')}}" alt="tachas" data-img-trabajos>
            </div>
        </div>

    </section>

    <div class="popup-image">
        <span class="close-popup">&times;</span>
        <img src="" alt="">
    </div>

    {{-- Section contacto --}}
    <section class="contact" id="contact">
        <h1 class="heading">Contacto</h1>
        <div class="row">


            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d869.4580616270332!2d-76.95992084627416!3d-11.92352679105024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105db2262d0f25f%3A0x2157837531bf8853!2sAv.%20Huayna%20C%C3%A1pac%2C%20San%20Antonio%20de%20Chaclla!5e0!3m2!1ses!2spe!4v1661882747178!5m2!1ses!2spe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <form action="" id="form-contact" autocomplete="off">
                <h3>Contáctenos</h3>
                {{-- <input type="text" placeholder="nombre" class="box">
                <input type="email" placeholder="correo electrónico" class="box">
                <input type="number" placeholder="teléfono" class="box">
                <textarea name="" placeholder="Ingrese su mensaje" cols="30" rows="10" class="box"></textarea>
                <x-button class="text-xl px-6 py-4">Enviar Mensaje</x-button> --}}
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
        </div><br>
    </section>

    {{-- Section clientes logo--}}
    <section class="logo-container">
        <div class="swiper logo-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo1.png')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo2.jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo3.png')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo4.jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo5.jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo6.jpg')}}" alt=""></div>
                <div class="swiper-slide"><img src="{{Storage::url('cliente/clientelogo7.png')}}" alt=""></div>
            </div>
        </div>
    </section>

    {{-- Javascript --}}
    @push('js')
        <script src="{{ asset('js/formContact.js') }}" ></script>
    @endpush
</x-app-layout>
