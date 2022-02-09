<div>
    <section class="servicios-page">
        <h1 class="heading">Nuestros Servicios</h1>
        <div class="content">
            <div class="menu ">
                <nav>
                    <a href="#" wire:click.prevent="$set('servicio','senVerticales')"
                    @if($servicio == 'senVerticales') class="activelinkServicio" @endif>Señales Verticales</a>
                    <a href="#" wire:click.prevent="$set('servicio','senHorizontales')"
                    @if($servicio == 'senHorizontales') class="activelinkServicio" @endif>Señales Horizontales</a>
                    <a href="#" wire:click.prevent="$set('servicio','hitos')"
                    @if($servicio == 'hitos') class="activelinkServicio" @endif>Hitos Kilometricos</a>
                </nav>
            </div>
            <div class="content-service">
                <h3 class="heading2">Señales Verticales</h3>
                {{$servicio}}
            </div>
        </div>

    </section>
</div>
