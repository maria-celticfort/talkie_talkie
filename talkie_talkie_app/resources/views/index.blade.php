@extends('theme.base')


@section('content') 
    <header class="masthead text-center text-black">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">¿De qué quieres hablar?</h1>
                </div>
            </div>
    
            <div class="search-topic">
                <form action="{{route('topic.store')}}" method="POST">
                @csrf
            
                    <div class="container px-5">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Introduce un tema" required>
                                @error('name')
                                    <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <select type="text" name="language" class="form-control" placeholder="Escoge un idioma" required>
                                    <option value="eng">Inglés</option>
                                    <option value="spa">Español</option>
                                    <option value="cat">Catalán</option>
                                    <option value="glg">Gallego</option>
                                    <option value="eus">Euskera</option>
                                    <option value="jpn">Japón</option>
                                    <option value="chi">Chino</option>
                                    <option value="deu">Alemán</option>
                                    <option value="ita">Italiano</option>
                                    <option value="fra">Francés</option>
                                    <option value="por">Protugués</option>
                                    <option value="gre">Griego</option>
                                    <option value="gle">Irlandés</option>
                                    <option value="ukr">Ucraniano</option>
                                </select>
                                @error('language')
                                    <p class="form-text text-danger">{{ $message }}</p> 
                                @enderror
                            </div> 
                        </div>
                    
                        <div class="search-topic-btn">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-lg btn-warning rounded-pill">Buscar</button>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
    </header>
@endsection

