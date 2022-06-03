@extends('theme.base')

@section('content')
<div class="mt-2-custom container px-5">
    <h1><strong>Sobre nosotros</strong></h1>
    <div class="mb-3">
        <h2><strong>Talkie Talkie como web</strong></h2>
        <h5>
            <p>
                Talkie Talkie ese una aplicación de chat con un pequeño cambio: aquí no buscas una persona con la que hablar,
                buscas un tema del que hablar y nosotros ya nos encargamos de encontrar a la persona ideal.<br><br>
            </p>
        </h5>
    </div>

    <div class="mb-3">
        <h2><strong>Equipo de desarollo de Talkie Talkie</strong></h2>
        <h5>
            <p>
                El equipo de desarrollo de Talkie Talkie está formado por una única persona: yo; pero "equipo de desarrollo"
                quebada más profesional.<br>
                Bromas a parte...<br><br>

                ¡Hola! Soy María, la desarolladora de Talkie Talkie <br><br>

                Soy una estuadiante de Desarrollo de Aplicaciones Web enfocada principalmente al backend.<br>
                Suelo trabajar con PHP, especialmente con frameworks como Laravel y Symfony; aunque disfruto mucho de Pygames
                para el desarrollo de pequeños videojuegos.<br><br>

                Dejando de lado el apartado profesional, suelo emplear mi tiempo libre en jugar a videojuegos (los juegos de supervivencia
                ocupan un lugar especial en mi corazón), viendo anime, leyendo mangas o garabateando.<br><br>


                Y por último, quería enseñaros los temas que más he buscado en Talkie Talkie:
            <ul>
                <li>Boku no hero</li>
                <li>Origin</li>
                <li>Watchmen</li>
                <li>Tortilla con cebolla</li>
                <li>Tortilla sin cebolla</li>
                <li>Tortilla</li>
                <li>Error 418</li>
                <li>Sketchbook</li>
                <li>Ark <small>(tenéis que juagarlo)</small></li>
                <li>The Forest <small>(este también)</small></li>
                <li>Slime Rancher</li>
                <li>Shingeki no Kyojin anime</li>
            </ul><br>

            <div class="d-flex justify-content-center">
                Por aquí os dejo mis redes, disfrutad de Talkie Talkie ^.^ <br><br>
            </div>

            <div class="d-flex justify-content-center">

                <div class="a-custom">
                    <a class="link-custom text-center" href="https://github.com/maria-celticfort/"><img src="{{URL::asset('/image/github_logo.png')}}" alt="Imágen de carga" height=50px width=50px></a>
                </div>

                <div class="a-custom">
                    <a href="https://es.linkedin.com/in/maria-castro-darriba?trk=profile-badge"><img src="{{URL::asset('/image/linkedin_logo.png')}}" alt="Imágen de carga" height=50px width=50px></a>
                </div>
            </div>
    </div>


    <div class="return-btn-2">
        <a class="btn btn-warning rounded-pill" href="{{route('index')}}" role="button"> ← Volver a Inicio</a>
    </div>
</div>

@endsection