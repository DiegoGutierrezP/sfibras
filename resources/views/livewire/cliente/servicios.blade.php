{{-- <x-app-layout> --}}
<div>
    <section class="servicios-page">
        <div class="head">
            <div id="menu-servicios-btn" class="fas fa-bars"></div>
            <h1 class="heading">Nuestros Servicios</h1>
        </div>

        <div class="content">
            <div class="menu" id="menu-servicios-page">
                <nav>
                    <a href="#" wire:click.prevent="$set('servicio','señales-verticales')"
                    @if($servicio == 'señales-verticales') class="activelinkServicio" @endif>Señales Verticales</a>
                    <a href="#" wire:click.prevent="$set('servicio','señales-horizontales')"
                    @if($servicio == 'señales-horizontales') class="activelinkServicio" @endif>Señales Horizontales</a>
                    <a href="#" wire:click.prevent="$set('servicio','hitos')"
                    @if($servicio == 'hitos') class="activelinkServicio" @endif>Hitos Kilometricos</a>
                </nav>
            </div>
            <div class="content-service">
                @if ($servicio === 'señales-verticales')
                    @include('servicios.svertical')
                @elseif($servicio === 'señales-horizontales')
                    @include('servicios.shorizontal')
                @elseif($servicio === 'hitos')
                    @include('servicios.hitoskm')
                @endif
            </div>
        </div>

    </section>


    @push('js')

    <script>
        lightGallery(document.querySelector('.servicios-page .content .content-service .imgs-servicio'),{
            download:false,
        });
    </script>

    @endpush

</div>
{{-- </x-app-layout> --}}
