@extends('theme.base')

@section('content')
    <div class="mt-2-custom container px-5">
        <h1><strong>FAQs</strong></h1>

        <div class="mb-3">
            <h2><strong>¿Qué es Talkie Talkie?</strong></h2>
            <h5><p>
            Talkie Talkie ese una aplicación de chat con un pequeño cambio: aquí no buscas una persona con la que hablar,
            buscas un tema del que hablar y nosotros ya nos encargamos de encontrar a la persona ideal.<br><br>

            A veces, Talkie Talkie es una tetera pero ese es otro tema...
            </p></h5>
        </div>

        <div class="mb-3">
            <h2><strong>¿Cómo se usa Talkie Talkie?</strong></h2>
            <h5><p>
            Si no tienes cuenta aún, crea una en el botón <strong>REGÍSTRATE</strong> de arriba. <br>
            
            Si ya la tienes, incia sesión, en el apartado <strong>INICIA SESIÓN</strong> de arriba también. <br><br>

            Luego, dirígete a la pantalla principal, busca un tema (el que quieras) y selecciona un idioma. Si alguien más 
            está buscando ese mismo tema en el mismo idioma te emparejamos con esa persona, sino te enviaremos a una sala de espera 
            hasta que te encontremos a una persona válida (también puedes cancelar la búsqueda si no aparece nadie :( )
            </p></h5>
        </div>

        <div class="mb-3">
            <h2><strong>¿Puedo tener más de una convesación al mismo tiempo?</strong></h2>
            <h5><p>
            Por ahora, no. Esto es debido tanto a limitaciones de nuestron software como por parte de *Pusher.
            Queremos acabar con esta limitación en actualizaciones futuras.<br>
            </p></h5>

            <small>*Pusher es el servidor que empleamos para el intercambio de mensajes.</small>
        </div>

        <div class="mb-3">
            <h2><strong>¿Puedo buscar cualquier tema?</strong></h2>
            <h5><p>
                Claro, lo que te pida el cuerpo. <br><br>
                Te recomendamos que busques temas escritos de forma sencilla para que sea más fácil encontrar con quien hablar<br><br>

                Por ejemplo:<br>
                No busques "Plato español que sabe a mangar de dioses", mejor busca "Tortilla"<br><br>

                Aunque la primera definición es completamente válida, será mucho más fácil para nostros trabajar con la segunda.
            </p></h5>
            
        </div>

        <div class="mb-3">
            <h2><strong>¿Cómo busco en un idioma que no está en la lista?</strong></h2>
            <h5><p>
                Por ahora, no puedes <br>
                En nuestra versión Beta-0.20 queremos implementar que se pueda buscar un tema en todos los idiomas recogidos en
                la ISO 639-3
            </p></h5>
        </div>

        <div class="mb-3">
            <h2><strong>¿Puedo reportar a un usuario molesto?</strong></h2>
            <h5><p>
                Por ahora, no puedes <br>
                Estamos trabajando en un sistema de vetado de usuarios y temas indeseados.
            </p></h5>
        </div>

        <div class="mb-3">
            <h2><strong>¿Se podrá buscar grupos de gente con los que hablar en vez de gente individual?</strong></h2>
            <h5><p>
                En una futura actualización, sí <br>
                Por ahora, nso estamos centrado en elementos que consideramos imprescindibles para que la base que ya tenemos
                funcione mejor incluso:
                <ul>
                    <li>Reporte de usuarios</li>
                    <li>Vetado de temas no deseados</li>
                    <li>Búsqueda en un mayor número de idiomas</li>
                    <li>Convertir Talkie Talkie en una página multilenguaje</li>
                    <li>Mostrar cuáles son los temas más buscados en la actualizad, en función del idioma</li>
                </ul>
            </p></h5>
        </div>

    <div class="return-btn-2">
        <a class="btn btn-warning rounded-pill" href="{{route('index')}}" role="button"> ← Volver a Inicio</a>
    </div>
    </div>

@endsection