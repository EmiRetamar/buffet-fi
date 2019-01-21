@extends('layout')

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/altaProducto.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/listadoProductos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paginador.css') }}">

@endsection

@section('nav')

    @include('parts/inner_nav')

@endsection

@section('content')

    <section class="principal">

        <br>

        <input class="enviar" type="button" onclick="location.href='{{ route('productos.vista-crear') }}';" value="Crear nuevo producto">
        <h2>Listado de productos</h2>
        @if(count($productos) == 0)
            <p>No hay productos para ser listados</p>
        @else
            <table id="listado" class="listado">
                <tr class="categorias">
                    <th id="idProducto">id</th>
                    <th id="nombreProducto">Nombre</th>
                    <th id="marcaProducto">Marca</th>
                    <th id="codigoBarraProducto">Codigo barra</th>
                    <th id="stockProducto">Stock </th>
                    <th id="stockMinProducto">Stock Minimo</th>
                    <th id="fechaAltaProducto">Fecha alta</th>
                    <th id="proveedorProducto">Proveedor</th>
                    <th id="precioUniProducto">Precio unitario</th>
                    <th id="descripcionProducto">Descripcion</th>
                    <th id="categoriaProducto">Categoría</th>
                    <th id="operacionesProducto">Operaciones</th>
                </tr>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre_producto }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->codigo_barra }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->stock_minimo }}</td>
                        <td>{{ $producto->fecha_alta }}</td>
                        <td>{{ $producto->proveedor }}</td>
                        <td>{{ $producto->precio_venta_unitario }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->nombre_categoria }}</td>
                        <td>
                            <a href="{{ route('productos.vista-modificar', $producto->id) }}"><img title="Editar" src="https://grupo46.proyecto2016.linti.unlp.edu.ar/entrega1/imagenes/editar.png" class="imagenesListado" alt="Editar"></a>

                            <a href="{{ route('productos.vista-eliminar', $producto->id) }}"><img title="Eliminar" src="https://grupo46.proyecto2016.linti.unlp.edu.ar/entrega1/imagenes/eliminar.png" class="imagenesListado" alt="Eliminar"></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div id="black" class="margen">
            </div>
        @endif
    </section>

@endsection

@section('javascript')

    <!-- Configuracion de la paginacion -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#black').smartpaginator({ totalrecords: {{ count($productos) }}, recordsperpage: {{ $config->elementos }}, datacontainer: 'listado', dataelement: 'tr', length: 1, initval: 0, next: 'Siguiente', prev: 'Anterior', first: 'Primero', last: 'Último', theme: 'black', controlsalways: true });
        });
    </script>

@endsection