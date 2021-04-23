<?php
  crear(); //Creamos el archivo
  leer();  //Luego lo leemos
   
  //Para crear el archivo
  function crear(){
      $bd = new mysqli('ingsoftware.mysql.database.azure.com', 'ingsoftware@ingsoftware', 'Q!1234567', 'utp');
    
       $stmt = $bd->prepare("SELECT ID, Nombres, Apellidos, cedula, Edad, Sexo, Fecha_de_Nacimiento, Tipo_de_Sangre, Direccion_Residencia, Profesion, Celular, Telefono, Facebook FROM usuarios");
       $stmt->execute();
       $stmt->store_result();
       $stmt->bind_result($ID, $Nombres, $Apellidos, $cedula, $Edad,$Sexo, $Fecha_de_Nacimiento, $Tipo_de_Sangre, $Direccion_Residencia, $Profesion, $Celular, $Telefono, $Facebook); 
  
       $xml = new DomDocument('1.0', 'UTF-8');
  
      $miembros = $xml->createElement('miembros');
      $miembros = $xml->appendChild($miembros);
  
      while($stmt->fetch()) {
     
        $user = $xml->createElement('user');
        $user = $miembros->appendChild($user);
 
        $nodo_ID = $xml->createElement('ID', $ID);
        $nodo_ID = $user->appendChild($nodo_ID);
        $nodo_Nombres = $xml->createElement('Nombres', $Nombres);
        $nodo_Nombres = $user->appendChild($nodo_Nombres);
        $nodo_Apellidos = $xml->createElement('Apellidos', $Apellidos);
        $nodo_Apellidos = $user->appendChild($nodo_Apellidos);
        $nodo_cedula = $xml->createElement('cedula', $cedula);
        $nodo_cedula = $user->appendChild($nodo_cedula);
        $nodo_Edad = $xml->createElement('Edad', $Edad);
        $nodo_Edad = $user->appendChild($nodo_Edad);
        $nodo_Sexo = $xml->createElement('Sexo', $Sexo);
        $nodo_Sexo = $user->appendChild($nodo_Sexo);
        $nodo_Fecha_de_Nacimiento = $xml->createElement('Fecha_de_Nacimiento', $Fecha_de_Nacimiento);
        $nodo_Fecha_de_Nacimiento = $user->appendChild($nodo_Fecha_de_Nacimiento);
        $nodo_Tipo_de_Sangre = $xml->createElement('Tipo_de_Sangre', $Tipo_de_Sangre);
        $nodo_Tipo_de_Sangre = $user->appendChild($nodo_Tipo_de_Sangre);
        $nodo_Direccion_Residencia = $xml->createElement('Direccion_Residencial', $Direccion_Residencia);
        $nodo_Direccion_Residencia = $user->appendChild($nodo_Direccion_Residencia);
        $nodo_Profesion = $xml->createElement('Profesion', $Profesion);
        $nodo_Profesion = $user->appendChild($nodo_Profesion);
        $nodo_Celular = $xml->createElement('Celular', $Celular);
        $nodo_Celular = $user->appendChild($nodo_Celular);
        $nodo_Telefono = $xml->createElement('Telefono', $Telefono);
        $nodo_Telefono = $user->appendChild($nodo_Telefono);
        $nodo_Facebook = $xml->createElement('Facebook', $Facebook);
        $nodo_Facebook = $user->appendChild($nodo_Facebook);
       }
    
       
       $bd->close();
    
      $xml->formatOutput = true;
      $el_xml = $xml->saveXML();
      $xml->save('usuarios.xml');
      
      //Mostramos el XML puro
      echo "<p><b>El XML ha sido creado.... Mostrando en texto plano:</b></p>".
           htmlentities($el_xml)."
<hr>";
  }
  
  //Para leerlo
  function leer(){
    echo "<p><b>Ahora mostrandolo con estilo</b></p>";
  
    $xml = simplexml_load_file('usuarios.xml');
    $salida ="";
  
    foreach($xml->user as $item){
      $salida .=
      "<b>ID:</b> " . $item->ID . "
".
        "<b>Nombre:</b> " . $item->Nombres . "
".
        "<b>Apellido:</b> " . $item->Apellidos . "
".
        "<b>Edad:</b> " . $item->Edad . "
".
        "<b>Cedula:</b> " . $item->cedula . "
".
        "<b>Sexo:</b> " . $item->Sexo . "
".
        "<b>Fecha de Nacimiento:</b> " . $item->Fecha_de_Nacimiento . "
".
        "<b>Tipo de Sangre:</b> " . $item->Tipo_de_Sangre . "
".
        "<b>Direccion Residencia:</b> " . $item->Direccion_Residencia . "
".
        "<b>Profesion:</b> " . $item->Profesion . "
".
        "<b>Celular:</b> " . $item->Celular . "
".
        "<b>Telefono:</b> " . $item->Telefono . "
".
        "<b>Facebook:</b> " . $item->Facebook . "
<hr/>";
    }
  
    echo $salida;
  }
?>