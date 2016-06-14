<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['keyEncrypter'] = "3ncr1pt3r";
$config['NomEscuela'] = "Colegio Junipero";
$config['CorreoInfo'] = "informacion@example.com";
$config['Direccion'] = 'Bondojito 238, 01520 D.F. 01 55 5277 2460';

//RUTA PARA GUARDAR LOS DOCUMENTOS QUE SUBEN LOS USUARIO (la ruta siempre debe de empezar con ./)
$config['RutaFTP'] = "./assets/uploads/files/";
//RUTA PARA SUBIR LAS NOTAS DE LAS MATERIAS
$config['RutaNota'] = "assets/uploads/files/Notas";
//RUTA PARA SUBIR LAS TAREAS POR PARTE DE LOS DOCENTES Y ESTUDIANTES
$config['RutaTarea'] = "assets/uploads/files/Tareas";
//RUTA PARA SUBIR LOS ARCHIVOS ADJUNTOS DE LOS CORREO EN CASO DE SER NECESARIO
$config['RutaAdjunto'] = "assets/uploads/files/Adjunto";
//PARAMETROS DEL CORREO GENERAL DEL SISTEMA
$config['CorreoGral'] = "erick.suarez.buendia@gmail.com";