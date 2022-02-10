<x-app-layout>

    <div class="nosotros-page">
        <div class="banner">
            {{-- <img src="{{ Storage::url('cliente/nosotros-banner2.jpg') }}" alt=""> --}}
            <h1>¿Quienes Somos?</h1>
        </div>
        <section class="content">
            <h3 class="heading">Nosotros</h3>

            <div class="info1">
                <div class="content">
                    <p>
                        SGG Fibras y Servicios desde
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
                </div>
                <div class="icon">
                    <img src="{{ Storage::url('cliente/icons8-about.svg') }}" alt="">
                </div>
            </div>

            <h3 class="heading heading-right">Misión</h3>
            <div class="info2">

                <div class="icon">
                    <img src="{{ Storage::url('cliente/mission.jpg') }}" alt="">
                </div>
                <div class="content">
                    <p>
                        Brindar soluciones de excelencia integral, innovadoras y de calidad en el
                        mercado de la señalización Vertical e Industrial a nivel nacional,
                        innovando métodos y procesos con la más moderna tecnología y capital
                        humano altamente calificado; aplicados a satisfacer las necesidades,
                        requerimientos y exigencias de nuestros clientes con una cuota
                        constante de valor agregado en cada uno de nuestros productos.
                    </p>

                </div>
            </div>

            <h3 class="heading">Visión</h3>
            <div class="info3">

                <div class="content">
                    <p>
                        Ser la compañía líder del mercado peruano en los servicios de
                        señalización Vertical e Industrial, consolidando nuestra posición como
                        una empresa que implementa y desarrolla nuevas tecnologías en todos
                        nuestros procesos y soluciones; apostando por la conservación del
                        medio ambiente, la seguridad y bienestar integral de nuestro recurso
                        humano y contribuyendo el desarrollo sostenible en el Perú.
                    </p>
                </div>
                <div class="icon">
                    <img src="{{ Storage::url('cliente/vision.png') }}" alt="">
                </div>
            </div>

        </section>


        <section class="logo-container">
            <h3 class="heading">Nuestros Clientes</h3>
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

    </div>

</x-app-layout>
