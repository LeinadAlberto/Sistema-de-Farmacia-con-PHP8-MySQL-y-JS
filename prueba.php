<?php 
    /* date_default_timezone_set('America/La_Paz');
    $fecha_actual = new DateTime();
    echo "<pre>";
    var_dump ($fecha_actual);
    echo "</pre>";
 */

    /* Insertar codigo PHP dentro un texto */
    /* $nombre = "Maicol";
    $apellido = "Swider";
    $edad = 45;
    $texto = "Hola me llamo {$nombre} {$apellido} tengo {$edad} años."; */

    /* echo $texto; */
    
    /* $productos = '[{"id":"14","nombre":"Aspirina Y","concentracion":"1500 mg","adicional":"Mantener Refrigerado Siempre","precio":"860","laboratorio":"11","tipo":"4","presentacion":"2","avatar":"../img/prod/64dda49124c17-producto-1.jpg","stock":"885","cantidad":"2"},{"id":"5","nombre":"AB-BRONCOL NF 1200","concentracion":"30.5 mg","adicional":"Manzanitass","precio":"1","laboratorio":"1","tipo":"1","presentacion":"1","avatar":"../img/prod/64cf17080a470-producto-parlantes.jpg","stock":"5","cantidad":"3"},{"id":"3","nombre":"AB MOKS","concentracion":"20 mg","adicional":"Manzanitas","precio":"1.5","laboratorio":"9","tipo":"1","presentacion":"1","avatar":"../img/prod/64cf11f94cf17-producto-microfono.jpg","stock":"57","cantidad":"3"},{"id":"2","nombre":"AB AMBROMOX","concentracion":"0.5 mg","adicional":"Manzanitas","precio":"60","laboratorio":"9","tipo":"1","presentacion":"1","avatar":"../img/prod/64cf11ea38695-audifonos.jpg","stock":"85","cantidad":"5"}]'; */

    /* echo "<pre>"; */
    /* echo $productos; */
    /* echo "</pre>"; */
    

    /* $productos_json_decode = json_decode($productos);

    echo "<pre>";
    var_dump($productos_json_decode);
    echo "</pre>";

    echo "<pre>";
    print_r($productos_json_decode);
    echo "</pre>"; */
    $cadena = "";
    $producto = 3;
    $precio = 450; 
    $cadena .= "
        <tr prodId='$producto' prodPrecio='$precio'>
        </tr>
        ";
    echo $cadena;

?>


<script>

    const string_json = '[{"id":"14","nombre":"Aspirina Y","concentracion":"1500 mg","adicional":"Mantener Refrigerado Siempre","precio":"860","laboratorio":"11","tipo":"4","presentacion":"2","avatar":"../img/prod/64dda49124c17-producto-1.jpg","stock":"885","cantidad":"2"},{"id":"5","nombre":"AB-BRONCOL NF 1200","concentracion":"30.5 mg","adicional":"Manzanitass","precio":"1","laboratorio":"1","tipo":"1","presentacion":"1","avatar":"../img/prod/64cf17080a470-producto-parlantes.jpg","stock":"5","cantidad":"3"},{"id":"3","nombre":"AB MOKS","concentracion":"20 mg","adicional":"Manzanitas","precio":"1.5","laboratorio":"9","tipo":"1","presentacion":"1","avatar":"../img/prod/64cf11f94cf17-producto-microfono.jpg","stock":"57","cantidad":"3"},{"id":"2","nombre":"AB AMBROMOX","concentracion":"0.5 mg","adicional":"Manzanitas","precio":"60","laboratorio":"9","tipo":"1","presentacion":"1","avatar":"../img/prod/64cf11ea38695-audifonos.jpg","stock":"85","cantidad":"5"}]';
    console.log(string_json);

    const objeto_json = JSON.parse(string_json);
    console.log(objeto_json);

</script>