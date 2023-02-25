<?php 

    // error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    // error_reporting(E_ALL & ~E_NOTICE);
    // ini_set('display_errors', '0');

     // función de gestión de errores
    function miGestorDeErrores($nivel, $mensaje, $errorCode)
    {
        
        // https://www.php.net/manual/es/errorfunc.constants.php
        switch($nivel) {
            case E_ERROR :
                $tipoError = 'ERROR FATAL';
                break;
            case E_WARNING:
                $tipoError = 'ADVERTENCIA';
                break;
            case 'ERROR SQL':
                $tipoError = $nivel;
                    break;
            default:
                $tipoError = 'ERROR DE TIPO NO ESPECIFICADO';           
        }

        if($mensaje == null) {

            switch($errorCode) {
                case 2002:
                    $mensaje = "$tipoError: Host de la base de datos desconocido.";
                    break;
                case 1044:
                    $mensaje = "$tipoError: Acceso denegado a la base de datos o base de datos desconocida.";
                    break;
                case 1045:
                    $mensaje = "$tipoError: Acceso denegado al usuario de la base de datos, usuario desconocido o contraseña incorrecta.";
                    break;
                case 2019:
                    $mensaje = "$tipoError: Juego de caracteres de la conexión desconocido.";
                    break;
                case 1146:
                    $mensaje = "$tipoError: La tabla no existe en la base de datos.";
                    break;
                //
                case '42000':
                    $mensaje = "$tipoError: Error de sintaxis en la consulta SQL.";
                    break;             
                case '42S02':
                    $mensaje = "$tipoError: La tabla no existe en la base de datos.";
                    break;             
                case '42S22':
                    $mensaje = "$tipoError: Columna o campo no encontrado.";
                    break; 
                case 'HY093':
                    $mensaje = "$tipoError: Número inválido de parámetros: El parámetro no fue definido.";
                    break; 
                default:
                    $mensaje = "$tipoError: $mensaje";                
            }

        }
        
        return $mensaje;
    }

?>