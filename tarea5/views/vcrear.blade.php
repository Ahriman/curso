@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
    <form name="crear" method="POST" action="crearJugador.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
            </div>
            <div class="form-group col-md-6">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" placeholder="Apellidos" name="apellidos" required>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="dorsal">Dorsal</label>
                <input type="number" class="form-control" id="dorsal" placeholder="Dorsal" name="dorsal" min="1" step="1" max="40">
            </div>
            <div class="form-group col-md-4">
                <label for="posicion">Posición</label>
                <select class="form-control" name="posicion" id="posicion">
                    <option value="1">Portero</option>
                    <option value="2">Defensa</option>
                    <option value="3">Lateral izquierdo</option>
                    <option value="4">Lateral derecho</option>
                    <option value="5">Central</option>
                    <option value="6">Delantero</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="codigo">Código de barras</label>
                @if(!isset($codigo))
                    <input type="text" placeholder="Código de barras" maxlength="13" class="form-control" name="barcode" readonly>
                @else
                    <input type="text" value="{{$codigo}}" maxlength="13" class="form-control" name="barcode" readonly>
                @endif
            </div>
        </div>

        {{-- Botonera --}}
        @if(!isset($codigo))
            <button type="button" onclick="return confirm('Debe generar un código de barras antes')" class="btn btn-primary mr-3" name="enviar">Crear</button>
        @else
            <button type="submit" class="btn btn-primary mr-3" name="enviar">Crear</button>
        @endif

        <input type="reset" value="Limpiar" class="btn btn-success mr-3">
        <a href="jugadores.php" class="btn btn-info mr-3">Vovler</a>
        <a href="generarCode.php" class="btn btn-secondary">
            <i class="fas fa-barcode"></i> Generar Barcode
        </a>
    </form>

    @if(isset($error))
        <div class="alert alert-danger h-100 mt-3">
            <p>{{ $error }}</p>
        </div>
    @endif
    
@endsection