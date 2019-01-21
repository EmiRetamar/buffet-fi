@extends('layout')

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/altaUsuario.css') }}">

@endsection

@section('nav')

    @include('parts/usuario_nav')

@endsection

@section('content')

    <section class="principal">
        <div id="envelope">
            @include('errors/errors')

            <!-- Laravel genera el token para evitar CSRF automaticamente -->
            {!! Form::open(['route' => ['usuarios.modificar', $usuario->id], 'method' => 'POST', 'class' => 'formato']) !!}
                <h2>Modificar los campos donde sea necesario</h2>

            @if(empty($request))

                <label for="usuario">Nombre de usuario</label>
                <input id="usuario" name="usuario" type="text" value="{{ $usuario->usuario }}" required="required" pattern="[A-Za-z0-9_]{5,20}$" maxlength="20" title="Ingrese un mínimo de 5 letras y/o números, máximo 20" autofocus>

                <label for="password">Contraseña</label>
                <input id="password" name="password" class="clave1" type="password" required="required" pattern="(?=.*\d)(?=.*[A-Z]).{6,20}" maxlength="20" title="Ingrese al menos 6 caracteres, incluyendo mínimamente un número y una mayúscula" onChange="checkPasswordMatch();">

                <label for="password2">Repetir contraseña</label>
                <input id="password2" name="password2" type="password" required="required" pattern="(?=.*\d)(?=.*[A-Z]).{6,20}" maxlength="20" title="Ingrese al menos 6 caracteres, incluyendo mínimamente un número y una mayúscula" onChange="checkPasswordMatch();">
                <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>

            @if(Auth::check())
                <label for="rol">Rol</label>
                <select name="rol" id="rol">
                    @foreach($roles as $rol)
                        @if($usuario->rol_id == $rol->id)
                            <option value="{{ $rol->id }}" selected="selected">{{ $rol->nombre }}</option>
                        @else
                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                        @endif
                    @endforeach
                </select>

                <label for="radio">Habilitado</label><br>
                @if($usuario->habilitado == '1')
                    <input id="radio1" type='radio' name='habilitado' value='1' checked>Si<br><br>
                    <input id="radio" type='radio' name='habilitado' value='0'>No
                @else
                    <input id="radio1" type='radio' name='habilitado' value='1'>Si<br><br>
                    <input id="radio" type='radio' name='habilitado' value='0' checked>No
                @endif
            @endif

                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" value="{{ $usuario->nombre }}" required="required" pattern="[A-Za-z\s]{2,30}" maxlength="30" title="Ingrese un mínimo de 2 letras, máximo 30" >

                <label for="apellido">Apellido</label>
                <input id="apellido" name="apellido" type="text" value="{{ $usuario->apellido }}" required="required" pattern="[A-Za-z]{2,30}" maxlength="30" title="Ingrese un mínimo de 2 letras, máximo 30">

                <label for="email">Email:</label>
                <input id="email" name="email"  type="email" value="{{ $usuario->email }}" required="required" title="Ingrese email válido">

                <label for="tipoDocumento">Tipo de documento:</label>
                <select id="tipoDocumento" name="tipoDocumento">
                    @if($usuario->tipoDocumento == 'DNI')
                        <option value="DNI" selected="selected">DNI</option>
                    @else
                        <option value="DNI">DNI</option>
                    @endif
                    @if($usuario->tipoDocumento == 'CI')
                        <option value="CI" selected="selected">Cedula de identidad</option>
                    @else
                        <option value="CI">Cedula de identidad</option>
                    @endif
                    @if($usuario->tipoDocumento == 'LE')
                        <option value="LE" selected="selected">Libreta de enrolamiento</option>
                    @else
                        <option value="LE">Libreta de enrolamiento</option>
                    @endif
                    @if($usuario->tipoDocumento == 'LC')
                        <option value="LC" selected="selected">Libreta civica</option>
                    @else
                        <option value="LC">Libreta civica</option>
                    @endif
                </select>

                <label>Número de documento:</label>
                <input id="numeroDocumento" name="numeroDocumento" type="number" value="{{ $usuario->numeroDocumento }}" required="required" min="10000000" max="99999999" title="Ingrese un número de documento válido">

                <label for="telefono">Teléfono:</label>
                <input id="telefono" name="telefono" type="text" value="{{ $usuario->telefono }}" required="required" pattern=".{6,20}" title="Ingrese un mínimo de 6 carácteres, máximo 20">

                <label for="ubicacion">Oficina o departamento</label>
                <select name="ubicacion" id="ubicacion">
                    @foreach($ubicaciones as $ubicacion)
                        @if($usuario->ubicacion_id == $ubicacion->id)
                            <option value="{{ $ubicacion->id }}" selected="selected">{{ $ubicacion->nombre_ubicacion }}</option>
                        @else
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre_ubicacion }}</option>
                        @endif
                    @endforeach
                </select>

            @else

                <label for="usuario">Nombre de usuario</label>
                <input id="usuario" name="usuario" type="text" value="{{ $request->usuario }}" required="required" pattern="[A-Za-z0-9_]{5,20}$" maxlength="20" title="Ingrese un mínimo de 5 letras y/o números, máximo 20" autofocus>

                <label for="password">Contraseña</label>
                <input id="password" name="password" class="clave1" type="password" required="required" pattern="(?=.*\d)(?=.*[A-Z]).{6,20}" maxlength="20" title="Ingrese al menos 6 caracteres, incluyendo mínimamente un número y una mayúscula" onChange="checkPasswordMatch();">

                <label for="password2">Repetir contraseña</label>
                <input id="password2" name="password2" type="password" required="required" pattern="(?=.*\d)(?=.*[A-Z]).{6,20}" maxlength="20" title="Ingrese al menos 6 caracteres, incluyendo mínimamente un número y una mayúscula" onChange="checkPasswordMatch();">
                <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>

            @if(Auth::check())
                <label for="rol">Rol</label>
                <select name="rol" id="rol">
                    @foreach($roles as $rol)
                        @if($request->rol == $rol->id)
                            <option value="{{ $rol->id }}" selected="selected">{{ $rol->nombre }}</option>
                        @else
                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                        @endif
                    @endforeach
                </select>

                <label for="radio">Habilitado</label><br>
                @if($request->habilitado == '1')
                    <input id="radio1" type='radio' name='habilitado' value='1' checked>Si<br><br>
                    <input id="radio" type='radio' name='habilitado' value='0'>No
                @else
                    <input id="radio1" type='radio' name='habilitado' value='1'>Si<br><br>
                    <input id="radio" type='radio' name='habilitado' value='0' checked>No
                @endif
            @endif

                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" value="{{ $request->nombre }}" required="required" pattern="[A-Za-z\s]{2,30}" maxlength="30" title="Ingrese un mínimo de 2 letras, máximo 30" >

                <label for="apellido">Apellido</label>
                <input id="apellido" name="apellido" type="text" value="{{ $request->apellido }}" required="required" pattern="[A-Za-z]{2,30}" maxlength="30" title="Ingrese un mínimo de 2 letras, máximo 30">

                <label for="email">Email:</label>
                <input id="email" name="email"  type="email" value="{{ $request->email }}" required="required" title="Ingrese email válido">

                <label for="tipoDocumento">Tipo de documento:</label>
                <select id="tipoDocumento" name="tipoDocumento">
                    @if($request->tipoDocumento == 'DNI')
                        <option value="DNI" selected="selected">DNI</option>
                    @else
                        <option value="DNI">DNI</option>
                    @endif
                    @if($request->tipoDocumento == 'CI')
                        <option value="CI" selected="selected">Cedula de identidad</option>
                    @else
                        <option value="CI">Cedula de identidad</option>
                    @endif
                    @if($request->tipoDocumento == 'LE')
                        <option value="LE" selected="selected">Libreta de enrolamiento</option>
                    @else
                        <option value="LE">Libreta de enrolamiento</option>
                    @endif
                    @if($request->tipoDocumento == 'LC')
                        <option value="LC" selected="selected">Libreta civica</option>
                    @else
                        <option value="LC">Libreta civica</option>
                    @endif
                </select>

                <label>Número de documento:</label>
                <input id="numeroDocumento" name="numeroDocumento" type="number" value="{{ $request->numeroDocumento }}" required="required" min="10000000" max="99999999" title="Ingrese un número de documento válido">

                <label for="telefono">Teléfono:</label>
                <input id="telefono" name="telefono" type="text" value="{{ $request->telefono }}" required="required" pattern=".{6,20}" title="Ingrese un mínimo de 6 carácteres, máximo 20">

                <label for="ubicacion">Oficina o departamento</label>
                <select name="ubicacion" id="ubicacion">
                    @foreach($ubicaciones as $ubicacion)
                        @if($request->ubicacion == $ubicacion->id)
                            <option value="{{ $ubicacion->id }}" selected="selected">{{ $ubicacion->nombre_ubicacion }}</option>
                        @else
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre_ubicacion }}</option>
                        @endif
                    @endforeach
                </select>

            @endif

                <br>
                <br>
                <br>

                <input class="enviar" type="submit" value="Enviar">
            {!! Form::close() !!}
            <a class="cancelar" href="{{ route('usuarios') }}">Cancelar</a>
        </div>
    </section>

@endsection

@section('javascript')

    <script type="text/javascript">
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password2").val();
            if (password != confirmPassword)
                $("#divCheckPasswordMatch").html("Las contraseñas deben coincidir");
            else
                $("#divCheckPasswordMatch").html("Las contraseñas coinciden");
        }

        $(document).ready(function () {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });
    </script>

@endsection