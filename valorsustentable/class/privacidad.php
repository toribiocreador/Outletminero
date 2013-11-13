<?php
echo (preg_match('/privacidad.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class privacidad extends _GLOBAL_{

public function main(){
		return  '
          <p class="txtTit">Aviso de privacidad</p>
		      <p class="txtCont">Con fundamento en los artículos 15 y 16 de la Ley Federal de Protección de Datos Personales en Posesión de Particularidades hacemos de su conocimiento que OUTLETMINERO, es responsable de recabar sus datos personales, del uso que se le dé a los mismos y de su protección.<br />
          Su información personal será utilizada para las finalidades: proveer los servicios y productos que ha solicitado; notificarle sobre nuevos servicios o productos que tengan relación con los ya contratados o adquiridos; comunicarle sobre cambios en los mismos; elaborar estudios y programas que son necesarios para determinar hábitos de consumo; realizar evaluaciones periódicas de nuestros productos y servicios a efecto de mejorar la calidad de los mismos; evaluar la calidad del servicio que brindamos, y en general, para dar cumplimiento a las obligaciones que hemos contraído con usted.<br />
          Para las finalidades antes mencionadas, requerimos obtener los siguientes datos personales:<br />
          <ul>
            <li>Nombre completo</li>
            <li>Teléfono fijo y/o celular</li>
            <li>Correo electrónico</li>
            <li>Dirección</li>
            <li>RFC ó CURP</li>
          </ul>
          <p class="txtCont">Es importante informarle que usted tiene derecho al Acceso, rectificación y Cancelación de sus datos personales. A Oponerse al tratamiento de los mismos o a revocar el consentimiento que para dicho fin nos haya otorgado.<br />
          Para ello, es necesario que envíe la solicitud en los términos que marca  la Ley en su Art. 29 a Jorge Mauro Márquez Márquez, responsable de nuestro Departamento de Protección de Datos Personales, ubicado en Fraccionamiento la Herradura, Calle de la Torre #101-E, Zacatecas, Zacatecas, o bien, comunique al teléfono (492)9222624 o vía correo electrónico a info@outletminero.org el cual solicitamos confirme vía telefónica para garantizar su correcta recepción.<br /><br />
          Importante: Cualquier modificación a este Aviso de Privacidad podrá consultarlo en www.outletminero.org</p>';
}//main

}//class
?>