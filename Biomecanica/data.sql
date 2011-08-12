-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-12-2007 a las 18:59:27
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `biomecanica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `nro_cita` int(11) NOT NULL auto_increment,
  `mom_impresion` time NOT NULL,
  `fecha` date NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `deporte` varchar(100) NOT NULL,
  `consulta` text NOT NULL,
  `podograma` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `diagnostico` text NOT NULL,
  `huellas` tinyint(1) NOT NULL,
  `peso` float NOT NULL,
  `nro_doc` varchar(30) NOT NULL,
  `doctor` varchar(100) default NULL,
  `institucion` varchar(100) NOT NULL,
  `ant_tipo1` varchar(50) NOT NULL,
  `ant_tipo2` varchar(50) NOT NULL,
  `arco_trans` varchar(50) NOT NULL,
  `ant_notas` varchar(100) NOT NULL,
  `art_tipo` varchar(50) NOT NULL,
  `art_lado` varchar(50) NOT NULL,
  `art_notas` varchar(100) NOT NULL,
  `cad_desnivel` tinyint(1) NOT NULL,
  `cad_lado` varchar(50) NOT NULL,
  `cad_cantidad` varchar(50) NOT NULL,
  `cad_notas` varchar(100) NOT NULL,
  `escoliosis` tinyint(1) NOT NULL,
  `esco_lado` varchar(50) NOT NULL,
  `cifosis` tinyint(1) NOT NULL,
  `hiperlordosis` tinyint(1) NOT NULL,
  `col_otro` varchar(50) NOT NULL,
  `col_notas` text NOT NULL,
  `ep_tipo` varchar(50) NOT NULL,
  `ep_grado` float NOT NULL,
  `ep_notas` text NOT NULL,
  `tamano` varchar(50) NOT NULL,
  `arcolong` varchar(50) NOT NULL,
  `boton` varchar(50) NOT NULL,
  `cunas` varchar(50) NOT NULL,
  `taloneras` varchar(50) NOT NULL,
  `med_otro` varchar(100) NOT NULL,
  `tam_mod` varchar(100) NOT NULL,
  `arc_mod` varchar(100) NOT NULL,
  `bot_mod` varchar(100) NOT NULL,
  `tal_mod` varchar(100) NOT NULL,
  `cun_mod` varchar(100) NOT NULL,
  `rod_tipo` varchar(50) NOT NULL,
  `rod_notas` text NOT NULL,
  `tib_tipo` varchar(50) NOT NULL,
  `tib_notas` text NOT NULL,
  `zap_tipo` varchar(50) NOT NULL,
  `zap_desc` varchar(200) NOT NULL,
  `zap_alt` float NOT NULL,
  `zap_punta` varchar(50) NOT NULL,
  `tob_tipo` varchar(50) NOT NULL,
  `tob_notas` text NOT NULL,
  `plantillas` varchar(100) NOT NULL,
  `notas` text NOT NULL,
  `piel_callos` varchar(200) NOT NULL,
  PRIMARY KEY  (`nro_cita`),
  KEY `nro_doc` (`nro_doc`),
  KEY `doctor` (`doctor`),
  KEY `fecha` (`fecha`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `citas`
--

INSERT INTO `citas` (`nro_cita`, `mom_impresion`, `fecha`, `ocupacion`, `deporte`, `consulta`, `podograma`, `foto`, `diagnostico`, `huellas`, `peso`, `nro_doc`, `doctor`, `institucion`, `ant_tipo1`, `ant_tipo2`, `arco_trans`, `ant_notas`, `art_tipo`, `art_lado`, `art_notas`, `cad_desnivel`, `cad_lado`, `cad_cantidad`, `cad_notas`, `escoliosis`, `esco_lado`, `cifosis`, `hiperlordosis`, `col_otro`, `col_notas`, `ep_tipo`, `ep_grado`, `ep_notas`, `tamano`, `arcolong`, `boton`, `cunas`, `taloneras`, `med_otro`, `tam_mod`, `arc_mod`, `bot_mod`, `tal_mod`, `cun_mod`, `rod_tipo`, `rod_notas`, `tib_tipo`, `tib_notas`, `zap_tipo`, `zap_desc`, `zap_alt`, `zap_punta`, `tob_tipo`, `tob_notas`, `plantillas`, `notas`, `piel_callos`) VALUES
(1, '16:20:00', '1942-01-19', 'Sentada 60% + Desplazamiento', '', 'Cirujia Hallux Valgus Bilateral (derecho hace 20 años, izquiero 9 años), En Hoy-> signos de molestias 2ndo artejo pie izquierdo.', '', '', 'SAL 16mm + Boton 6mm', 0, 68, '21836440', 'Sergio Luis Bernal', '', '', '', 'Caido', '', 'En Garra', 'Bilateral', '2do artejo', 1, 'Izquierdo', '10', '', 1, '', 0, 0, 'Derecha', '', 'Plano', 1.5, 'Puntos de apoyo diferentes', '24078', 'A1485', 'B750', '', '', '', '', '', '', '', '', 'Normal', '', 'Normal', '', '', '', 0, '', 'Normal', '', '', '', 'Cabezas 1 y 2 bilateral'),
(2, '14:30:00', '2007-09-25', 'Estilista (bipedestacion)', 'Baile', 'Problemas de Espalda - (Cemical y Lumbar). Atrofia muscular molestias en pies', '', '', 'SAL 12mm + Boton 7mm + bajo relieve  para callosidades', 0, 56, '70041682', 'Carlos Velez', '', '', 'Pronado', 'Caido', '', 'En Garra', 'Bilateral', '3al 5to bilateral', 1, 'Izquierdo', '5', '', 1, '', 0, 0, '', '', 'Plano', 2.5, '+ plano el dercho cange la huella es de pie colo', '250.8', '11/12', '7 mm', '', '', '', '', '', '', '', '', 'Varas', 'Detras', '', '', '', '', 0, '', 'Valgo', '+ valgo el derecho', '', '', ''),
(3, '13:30:00', '2007-09-21', 'sentada 50% + desplazamiento', '', 'Signos de dolor en orgien de la Fascia (mayor dolor en el izquierdo) desde hace 6 a', '', '', 'Talonera 10 mm + SAL 12 m + Boton 7 m', 0, 76.9, '42867251', '', '', '', '', 'Caido', '', '', '', '', 1, 'Izquierdo', '12', '', 1, '', 0, 0, '', '', 'Plano', 2, 'Derecho 2, Izquiero 1.5\r\nAreas diferentes', '24078', 'A1285', 'B750', '', 'T1050', 'Bronco Piel', '', '', '', '', '', '', 'Rodillas Normales', 'Normal', '', 'Zapato de Calle', '', 2, 'Amplia', 'Normal', '', '', '', 'Callos 2 y 3 cabezas bilateral'),
(4, '12:00:00', '2007-09-21', 'Estudiante', 'Eliptica 4/semana 45 mins', '# Por Revision - Signos de molestia en la Fascia plantar. Mejor en el derecho con revolucion de 1 año', '', '', 'SAL 16 mm + Boton 8 mm + Taloneras suave', 0, 52.4, '43221423', '  ', '', '', 'Supinado', 'Caido', 'El Derecho', '', '', 'ok', 1, 'Izquierdo', '12', '', 1, '', 0, 0, '', 'Derecha', 'Plano', 1.5, 'apoyo con de pie', '240', 'A1585', 'B750', '', '', '', '-3mm de longitud', '+4 mm antepie medial', '+4 mm longitud', '', '', '', 'normal', 'Normal', '', '', '', 0, '', 'Normal', '', '', '', ''),
(5, '08:00:00', '2000-10-26', 'Odontologo', 'Gimnasia - Squash', 'Los signos disminuyeron (dedos lumbar)', '', '', '', 0, 72, '70072086', 'Carlos Velez', '', '', '', '', '', '', '', '', 1, 'Izquierdo', '30', '', 1, '', 0, 0, '', '', 'Cavo', 2, '', '270', 'A14/9', 'BP97', '', 'TI06', '', '-1mm longitud', '', '', '', '', '', '', 'Normal', '', '', '', 0, '', 'Normal', '', '', '', ''),
(6, '14:30:00', '2001-02-26', 'Ing. Civil 30% sentado', 'Tenis 1/Semana', 'Dolor en 4 cabeza del pie izquierdo', '', '', '', 0, 71, '71578715', 'Carlos Velez', '', '', '', 'Caido', '', '', '', '', 1, 'Izquierdo', '15', '', 0, '', 0, 0, '', '', '', 0, '', '2706', '', 'BP96', '', '', '', '+ amplia antepie', '', '', '', '', '', 'Rodillas debe ser Normal', 'Normal', '', '', '', 0, '', 'Varo', '', '', '', ''),
(7, '13:00:00', '2003-06-18', 'Admon Mallas Metalicas 50% sentado 50% Obras', 'Trote 3/semana 1 hora o caminar', 'Signos de Cansancioen personas m. if, izquierdo', '', '', 'tendencia al varo dinamico tobillo derecho', 0, 71, '71592688', '', '', '', '', 'Caido', '', '', '', '', 0, '', '', '', 1, 'Izquierdo', 0, 0, '', '', 'Cavo', 2.5, '', '2508', 'AL590', '', '', '', 'espuma 3mm', '5mm de longitud', '', '', '', '', 'Varas', 'Neutras', '', '', '', '', 0, '', 'Varo', '', '', '', ''),
(9, '10:30:00', '2007-10-09', '', '', 'Desde  nacimiento a tenido la tendencia a mantener el antepia adductos maupren el izquierdo', '', '', '', 0, 28, '42782004', 'Carlos Velez', 'Clinica Las Vegas', '', 'Pronado', 'Caido', '', '', '', '', 0, '', '', '', 0, '', 0, 0, '', '', 'Plano', 1.5, '', '2', 'A1275', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 'Valgo', 'grande mayor el izquierdo', '', '', ''),
(11, '16:40:00', '2007-10-09', '', 'Atletismo - lanzamiento bala - disco lunes a sabado 3 horas', 'lesion en region lumbar - tuvo un episodio de molestias lumbares hace 4 semanas dolor en hombro derecho el año pasado', '', '', '(Lumbalgia mecanica) - fendinitis rotuliana - tendinitis en el mango rotador hombro derecho', 0, 95, '43221423', '', '', '', '', '', '', '', 'Bilateral', '', 0, '', '', '', 0, '', 0, 0, '', '', 'Plano', 2.5, 'mayor area de contaco fue derecho', '0', '', '', '', '', '', '', '', '', '', '', '', '', 'Normal', '', '', '', 0, '', 'Normal', '', '', '', ''),
(12, '16:00:00', '2007-10-19', 'Sentada 70%', 'Caminar 3/4 de hora', 'Signos de dolor en cabezas metatarsianas pie derecho. Disminuye con zapato con suela delgada. (tenis son los que menos hacen doler)', '', '', '', 0, 68, '4133218', '', '', '', '', 'Caido', '', 'En Garra', '', 'Zalsto bilateral', 0, '', '', '', 0, '', 0, 0, '', 'ok', 'Cavo', 1.5, 'Cepljo en los curtejos diferentes', '231', 'A1485', 'B950', '', '', 'Bronco Piel', '+ 3mm antepie medial', '3mm longitud', '', '', '', '', '', 'Normal', '', 'Zapato de Calle', '', 1, 'Amplia', 'Normal', '', '', '', '2, 3 y 4 cabezas mayor en el izquierdo'),
(13, '16:30:00', '2007-10-23', 'sentada 50% tiempo + de pie 50%', 'Caminar diario 45 minutos', 'Signos de fatiga en zona mettarsiana y el medio pie derecho.', '', '', '', 0, 60.8, '42993830', 'Carlos Velez', '', '', '', 'Caido', '', 'En Garra', '', '3ro al 5to bilateral', 1, 'Izquierdo', '10', '', 1, '', 0, 0, 'Derecha', '', 'Plano', 1.5, 'Mayor area el derecho', '24078', 'A1285', '', '', '', 'Bronco piel', '+ 3mm longitud', '+ 3mm antepie medial', '', '', '', 'Valgas', '', 'Normal', '', 'Tenis', '', 1, 'Amplia', 'Normal', '', '', '', '2 y 3 Cabezas + 1er pupejo + talon bilateral'),
(14, '14:30:00', '2007-12-03', 'Jubilado', 'Caminar 4 veces x semana 1 hr', 'Molestia en Fascia plantar en arco longitudinal interno mayor en el pie derecho con evolucion de 2 años. Los signos son muy fuertes al levantarse, no lo asocia al tipo de calzado pero si a la actividad fisica', '07120314300.JPG', '07120314301.JPG', 'Fascitis Plantar', 1, 93, '8292397', 'alvaro moreno', 'Consultorio', '', '', 'Caido', '', 'Cuello de Cisne', '', '2 al 3 bilateral', 0, '', '', '', 0, '', 1, 0, 'Cirugia Osteosintesis c6-c7 cervical', '', 'Cavo', 2, '', '2558', 'A1590', 'B950', '', 'T1560', '', '+3mm antepie lateral\r\n+4mm longitud', '', '', 'sin boton, bronco piel', '', 'Varas', '', '', '', 'Zapato de Calle', '', 2, 'Amplia', 'Varo', '', 'SAL 15 mm y boton 9 mm y Talonera para amortiguar', '', ''),
(15, '15:00:00', '2007-12-03', 'Hogar', 'Gimnasio 3/ semana 1 hora Bicicleta-Eliptica', 'Signos de dolor en la fascia plantar desde hace 2-3 años Al caminar mucho. Ultimamente los sintomas son aumentados en frecuencia e intensidad', '07120315000.JPG', '07120315001.JPG', 'pie cavo + ', 0, 62.3, '43037884', 'gonzalo cardona', 'Clinica SOMA', '', '', 'Caido', '', 'En Garra', '', '4 y 5 bilateral', 0, '', '', '', 0, '', 0, 0, 'ok', '', 'Cavo', 2.5, 'mayor area pie derecho apoyo diferente en antepie', '250F8', 'A1485', 'B750', '', 'T1060', '', '', '', '', 'Balon Manchester', '', 'Normal', '', 'Normal', '', 'Tenis', '', 1, 'Amplia', 'Normal', '', 'SAL 14 mm + Boton 7mm + Talonera para amortiguar', '', 'ok'),
(16, '15:30:00', '2007-12-03', '', '', 'Afirma que no soporta dolor en la planta de los pies, y no soporta tipo de calzado, con zapato tenis es el que mas molesta, No lo asocia al tiempo de la caminada. Con 2 años de evolucion.', '07120315300.JPG', '07120315301.JPG', '', 0, 84.5, '15349224', 'juan dario serna', 'Clinica Fracturas', '', '', 'Caido', '', '', '', 'ok', 0, '', '', '', 0, '', 0, 1, '', '', 'Cavo', 2, 'Mayor cree el derecho', '2806', 'A1485', 'B750', '', 'T1060', '', '+3mm antepie lateral\r\n-3mm longitud', '', '', 'Boton Manchester', '', 'Varas', '', 'Vara', '', 'Tenis', '', 1, 'Amplia', 'Varo', '', 'SAL 14mm + boton 7mm + taloneras 10 mm', '', 'Endurecimiento piel talones y cabezas metatarsianas'),
(17, '16:30:00', '2007-12-03', 'Docente -> de pie 70%', 'Bicicleta estatica  2/semana', 'Fractura tibia y perone hace 3 años (caminata) desde hace 1 año', '07120316300.JPG', '07120316301.JPG', 'Artrosis de tobillo izquierdo', 0, 61.2, '43000302', 'felipe marino', 'Comde', '', 'Supinado', 'Caido', 'izquierdo', 'En Garra', '', '2 al 5to izqdo\r\n5to derecho', 0, '', '', '', 0, '', 0, 0, '', '', 'Cavo', 2.5, 'Apoyos cabezas y reto pie', '250F8', 'A1485', '', '', 'T1060', '', '-2mm longitud', '', '', '', '', 'Varas', 'Neutras', 'Varas', '', 'Tenis', '', 1.5, 'Amplia', 'Valgo', 'mucho mayor el izquierdo', 'Soporte Arco longitudinal 14mmm + taloneras de impacto izqda = Boton con prologacion a 5ta', '', '4 y 5 cabezas izquierda'),
(18, '16:30:00', '2006-12-20', 'Abogado', 'Caminar diario 1 hora', 'Cirugía meniscos rodilla izquierda hace 2  años', '', '', 'Pie Cavo', 0, 60.7, '8269109', 'raul jaime naranjo', 'Centro Ortopedia El Poblado', '', '', 'Caido', 'Mucho', 'En Garra', '', 'del 2 al 5 bilateral y elevados bilateral', 0, '', '', '', 1, 'Derecho', 0, 0, '', '', 'Cavo', 1, 'Areas y apoyos diferentes', '2558', '', '', '', 'T1060', 'Espuma 3 mm', 'mas amplia antepie 3 mm medial', '', '', '', '', 'Varas', '', 'Vara', '', 'Zapato de Calle', '', 1.5, 'Amplia', 'Varo', '', 'Talonera con 3 mm cuña lateral (efecto valgizante sobre las rodillas)', '', ''),
(19, '17:30:00', '2007-12-03', 'Hogar - Jubilada Cursos Meditación', 'Caminar diario 1 hora', 'Signos de dolor intenso en 2do artejo hace 20 días. \r\nEnfermedad sistemica asociada: Artrosis (2 años) Rodilla derecha', '07120317300.JPG', '07120317301.JPG', 'Acortamniento MSD', 0, 70.1, '32446267', 'alvaro moreno', 'Consultorio', '', '', 'Caido', '', 'En Garra', '', '2 al 5 bilateral', 1, 'Izquierdo', '12', '', 1, 'Derecho', 0, 0, '', '', 'Cavo', 1, 'Apoyo en los dedos y antepie', '230F8', 'A1275', 'B650', '', '', 'Bronco Piel', '+ 3 mm antepie medial\r\n- 7 mm longitud', '', '', '', '', 'Normal', '', 'Normal', '', 'Zapato de Calle', '', 1, 'Amplia', 'Normal', '', 'SAL 12 mm + Botón 6 mm', '', ''),
(20, '17:00:00', '2007-12-03', 'Hogar jubilada', 'Gimnasio 3/semana 2 horas ', 'Signos de molestia en pie y pierna bilateral con 14 meses evolución. Lo asocia a estar quieta y comienza al caminar', '07120317000.JPG', '07120317001.JPG', 'Pie plano bilateral', 0, 52.3, '39163582', 'maría teresa rua', 'Pies Confortables', '', '', 'Caido', '', 'En Garra', 'Derecho', '2 al 5 bilateral', 0, '', '', '', 0, '', 0, 0, 'OK', '', 'Plano', 4, 'Pie izquierdo grado 4.5 y derecho grado 4', '230F8', 'A1280', 'B750', '', '', 'Bronco piel', '+3mm antepie lateral', '', '', '', '', 'Normal', '', 'Normal', '', 'Zapato de Calle', '', 8, 'Amplia', 'Valgo', '', 'SAL 12 mm + Botón de 7 mm', '', 'Cabezas metarsianas 1 2 3 y 1er pulpejo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `logins`
--

INSERT INTO `logins` (`id`, `customer_id`, `username`, `password`) VALUES
(1, 1, 'joaquin', 'biomec');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_med` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL default '',
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `institucion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_med`, `nombre`, `direccion`, `telefono`, `celular`, `institucion`, `email`) VALUES
('', 'alvaro moreno', '', '', '', 'Consultorio', ''),
('', 'dalmiro campuzano', '', '', '', 'Clinica SOMA', ''),
('', 'felipe marino', '', '', '', 'Comde', ''),
('', 'gonzalo cardona', '', '', '', 'Clinica SOMA', ''),
('', 'juan dario serna', '', '', '', 'Clinica Fracturas', ''),
('', 'maría teresa rua', '', '', '', 'Pies Confortables', ''),
('', 'raul jaime naranjo', '', '', '', 'Centro Ortopedia El Poblado', ''),
('', 'sergio luis bernal', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `tipo_doc` varchar(50) NOT NULL,
  `nro_doc` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre2` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `tel_casa` varchar(20) NOT NULL,
  `tel_trab` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY  (`nro_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`tipo_doc`, `nro_doc`, `nombre`, `nombre2`, `apellido1`, `apellido2`, `fecha_nac`, `tel_casa`, `tel_trab`, `celular`, `direccion`, `email`, `observaciones`) VALUES
('Cedula', '15349224', 'Alvaro', '', 'Guzman', 'Montoya', '1971-12-31', '3012189', '', '', 'call 77 sur no 45-67', '', ''),
('Cedula', '1822322', 'Jose', 'Luis', 'Toro', '', '1992-05-14', '550223', '', '', '', '', ''),
('Cedula', '21836440', 'Rita', '', 'Aramburgo', 'Restrepo', '1942-01-19', '2542630', '', '', 'Cr 12 58 88', '', ''),
('Cedula', '32446267', 'Mariela', 'De Jesus', 'Villegas', 'Jaramillo', '1948-03-22', '2505082', '', '', 'Cra 80A No 34- 36', '', ''),
('Cedula', '39163582', 'Luz', 'Marina', 'Rivera', 'Betancur', '1956-09-14', '3793409', '', '', '', '', ''),
('Cedula', '4133218', 'Claire', 'Theresse', 'Marie', 'de Holguin', '1940-11-03', '4133218', '', '', '', '', ''),
('Cedula', '42782004', 'Steven', '', 'Olaya', 'Ramirez', '0000-00-00', '3311808', '', '', '', '', ''),
('Cedula', '42867251', 'Blanca', 'Luz', 'Ruiz', 'Ochoa', '1952-08-19', '', '3421010', '', '', '', ''),
('Cedula', '42993830', 'Margarita', 'Maria', 'Salazar', 'Gomez', '1960-08-25', '3533350', '', '', '', '', ''),
('Cedula', '43000302', 'Gladys', 'de Jesus', 'Sierra', 'Calle', '1960-03-08', '2180897', '', '', '', '', ''),
('Cedula', '43037884', 'Gloria', 'Cecilia', 'Ruiz', 'Botero', '1962-08-02', '3210187', '', '', '', '', ''),
('Cedula', '43221423', 'Juliana', '', 'Mejia', 'Mejia', '1953-06-18', '4225609', '', '', '', '', ''),
('Cedula', '6788737', 'Enrique', '', 'Olano ', 'Asuad', '1953-06-25', '4138269', '3806100', '', '', '', ''),
('Cedula', '70041682', 'Reynel', 'Jesus', 'Diaz', 'Bedoya', '1953-06-10', '3410412', '', '', '', '', ''),
('Cedula', '70072086', 'Carlos', '', 'Ojalio', 'Prieto', '1985-10-14', '', '3126380', '', '', '', ''),
('Cedula', '71578715', 'Jorge', 'Eduardo', 'Ojalvo', 'Prieto', '2001-02-26', '', '4823708', '', '', '', ''),
('Cedula', '71592688', 'Rodrigo', 'Alfonso', 'Olano', 'Perez', '1953-06-19', '2604921', '3513132', '', 'Cl 24 59-14', '', ''),
('Cedula', '8022351', 'Jose', 'Luis', 'Martinez', 'Osorio', '1996-04-19', '1523451', '4533122', '580231222', 'Cra 22 No 22 - 35', 'Jose@osorio.com', 'hol hol '),
('Cedula', '8251212', 'Jorge', 'Antonio', 'Salazar', '', '1909-05-13', '', '', '', '', '', ''),
('Cedula', '8269109', 'Gustavo', 'Adolfo', 'Amaya', 'Yepes', '1944-10-31', '2707789', '2668228', '', '', '', ''),
('Cedula', '8292397', 'Edgar', '', 'Osorio', 'Escobar', '1948-12-08', '3172235', '', '', '', '', ''),
('Cedula', '8425850', 'Carlos', 'Emiro', 'Olier', 'Gonzales', '1953-11-02', '3174348', '', '', '', '', ''),
('Cedula', '85062330010', 'Juliana', '', 'Olier', 'Valenzuela', '0000-00-00', '4114610', '', '', '', '', '');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`nro_doc`) REFERENCES `paciente` (`nro_doc`) ON DELETE NO ACTION ON UPDATE CASCADE;
