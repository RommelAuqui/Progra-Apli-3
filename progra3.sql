-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2024 a las 19:43:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletaventa`
--

CREATE TABLE `boletaventa` (
  `IDBoleta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `IDUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IDCat` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IDCat`, `Nombre`, `Descripcion`) VALUES
(5, '123', '444'),
(6, '1asfas11', 'asfas'),
(8, 'Medicina22', '33'),
(9, 'Medicinass', '33'),
(10, 'Medicinasss', '33'),
(11, 'Luz', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleboleta`
--

CREATE TABLE `detalleboleta` (
  `IDDetalle` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `IDBoleta` int(11) DEFAULT NULL,
  `IDProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IDProducto` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Stock` int(11) NOT NULL,
  `PrecioVenta` decimal(10,2) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Imagen` mediumblob DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `IDProv` int(11) DEFAULT NULL,
  `IDCat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `IDProv` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `RUC` varchar(20) NOT NULL,
  `logo` mediumblob DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`IDProv`, `Nombre`, `RUC`, `logo`, `Celular`, `direccion`) VALUES
(1, 'Empresa Interbank', '1241241', 0x89504e470d0a1a0a0000000d494844520000012c0000005108030000005f686bec000002fd504c544500a45100a95300a55100a75100a24a00a04500a046a1dfc100a24800a146009f44eff7f100a44ce8f4eb0a817733b46ed3f0e2009e4156c187f5faf51bae6156c58ebfe5cf49c0851eaf6355bf8459c58fabe2c615ac5ef8fbf8fcfdfcdef2e61dae62eaf5ee94d9b5bfe9d4fffffeaae0c47bcda0aae1c521af64cae9d6b7e5cd61c48e0ea957bbe4cd6ecd9eaee0c5f1f8f3e3f2e738ba79caebd9d0eede68c794eef8f3e1f3e9a3ddbfdcf2e7c1e8d21dad5f9dd9b724b2693bbb7b66c69116ab5b029a5e8bd4acfbfcfa80d0a511ab5a05a54f36b97719ad5e4bbd80edf8f26ac998ceecdb13a957b3e0c5b8e3ca2cb36c44bb7b2eb772c5ead628b26947bd7f06a651d5f1e473ca9a78cc9daaddbf3fb97809a652c5e8d3a6ddbd5dc792a0dbba73cd9e9dddbc6eca99dbf1e432b77305a34d56c38a0da85530b36c2bb269b3e3c9fffefd51bf835cc48cecf7f087d6af53c38b3cb87549be8292d6b0009c3e5bc68fa6dfc237b5714dc28743bd7f99d7b387d4ac12ad6018b06552c288fffcfb96d6b078cea07bd0a398dbba9fdebf88d2a9ade3c8bde8d2abdec11275800c7d7a2d49a300a34920b26a80cea2d4efe02fb56f38b7745cc1872c46a700b45700a65000a55000a94e00aa4d2a4ca030499f00a54f3049a000a65100a44d3343a53045a43145a309a8553047a1079166156f8500a34b07a958039465107a7a3243a52c4aa2d3eddd00ad4b00a14865c99600a34a3344a423599500a147225e9000a24904a85500ab4d24b46c2ab57029509b3146a2009e5b00a45500a7500ba95700ab4c00a54e00a44e00ac4b3046a416698b009f43bbe6d034b87727b46e0b8472225799f6fcf910797c00b148f2faf6f7fcfa75cfa309896e1fb1680baa5b00a34c7cd2a8eef9f483d4ac24b067078d6afefefe90d6b185d1a61b648e21b16716747fffffff2f4a9f2f47a366ca98d8efe28cd7b200ac4ce8f7f0f5fbf8e6f4ea61c894d6eedf02a75300ad541e6c82eef6ef0e7f7700a652e4f6ed0fac5c1b707e147f72373bacd9f2e6f3f8f33fbc7d0f7d787ccd9fb1e4cc9021f5630000000474524e53aeb1b576fa6f127f00000ca64944415478daed9b7958144716c0ddddee76661c97a08961dd41918440000f505714143082b7f18c17c62b1e11131363bc5713736ccc9dec6ef7003ddd0a68ab04dbc1b65144c169658c47347133d920e4c0230a6836c1241bcdeeb7dd553d333d07b107e7e3733ffafd555d555df3ead755af5ed5ab694769a252be6dd74e83a0c1d26069b034581a2c0d96064183a5c1d26069b034581a2c0d8206ab556055e41cddad5ecc445b866536efdcf5a36af9d7b69c360ccb7c787beed62daae5df3fed6ebbb0cc87bf2cb25c502f5bda32ac23bf14e55dd060a982653ebcb7fc82064b1dac9c9db99696c32218ab242ad6479cc071bca5eb28490b82409341c5d06403aa337800b08e9cffa0e5b088d2032724d9715b0a38cf4a42b7ac63d72b0b0a0a2a4b830acbf64399a879d98152a2956031ffb8715a94fa0ff9db0d8d1d9f7c23c92d474bfac5efb95c5c5c7cadd6164c0fcfdef8b1a47bc357d620c3cacb6b0ed6d93a496e0b8bfef42aa8f805d7826ee1dce7e0e5e3419d88f64ba0d19bd5c183956729cccfcfbf98db1cac7f4a3f58a302d6cf40b5ffb02d82f51978f9bfc185b50734fa5d50608998caf34bb6e69edab7fdfb6ddb8f69b0fcc3123115966cd99a7b705fd5ae733b0f9973f69fd9b55583e503cb62292fd972ec83837babbe3eb9ed1055b1ff688eb982a2ae7c14102c8220498208062c5c6c493d2cd139f9957608020f2aacc28b174e7df9e3f7e7d30f375dd92d62aa902b05028bd4618883241d08c6923eb0a63d6f90856f727744a0697f0b1d6e4579c6e60d0b27bc7a0debd23a14e5380ed53384df760451234e2f040f5661d5b9f443d7af1c3d62365778bca21e16c911cb2fad78bc6797c75fbc3413e76c5eb03677ea2a4ba2ec44d8589d71c78e4faf5b59c4ab8b3a6472d7f5293d378f302a60311ccf381884e568afbaa6998b1a7bf5ead5383286e6048f3216993c7b68caa35d66acdb34b29233360f8b6439494855b0f22e9e3c93e3852930584d8ca3d3ac47ea647964529c0df184e5964803d04fffd890a193ee993ab55ff6e8c11ca3f419d90549cbe0daceb860315cc47deb5eeb3b69cefc5bf118add8474c89eaeefcd98eb18b1e5370a775723b402ecf1dcb3507cb58faec4af12beed940ab83f5fbfdfe07a34a584dace9714f24d9315c33b0a649050cd3e96157ceb2da08ccd5b263e14bf572e7635cb00c8b870d70d62e9e5ee9b27fc8a51a8fb68f2f71b9734cd667e11e65d76662845f5834330764f433b50e2c7e445f2f24754f8470fe613da513eb672479e40d9882cad6c89835c399e9861535dea3f931abf572373312bc1aeffea4ced94e6f6f8dceaec1fcc1b261af4298c93cd51ab08c6327d5f9c86593d51fac319fd21412e1cdf6ec737048106c6d9d2fac01573d6bf798096bf327baf9fe2a308924f2b2af46f543385f58040a1f1bc673546bc0c2b9da3a3f92c4906e580db31e9624fb9930a6c958e964d57d56b1dcddb3ef035df51bddef87bb6c16940e092e13d4b11a7c24be4c4c2764bf1c1919f9ca35b9e8554e1aa3faa7fd6974add2e80d0b47378299dc2711a55a05163fbeb3ac4ddfa8e8e8a8594be5a75bac1bd63b0b0b2411300745f091b07cf384b4acf8f1911057df02d162d80afa39677174748a8956c07a746484297942926ca3b2174a4b173f313c6a4a9a80daed7676ecc88190e30f2210db6227bbcbd1a246b14eebb509f386854db80906dd1a946a155838bb429e1d1bb30c286a1046de039f7b23b80bd674832089d4456e08e8f1e9d92c67b4895ed22268d0fb73ee8155ff529ae83c11b80b56fd1e44cf18190e5bd407664c918cbccd341ce18c2474b7ec65b068b8b822a25de5d7368d45458d90909ef22788a73d61e99fec28a5978e36e0ad034b2885df74d9723b584e6cf60d70e9ea18c1f8f1e0094736c8b964877e0d19bae741e9f9011b4920704dad991dca28b73b75358da1d07123ed6be0d8ea0dce1d49deed88e2580a2889e3448bb50a2497caed9058964c6b02ef014b170147e0171849b50e2c24040e8d97ecceaf631f2dcf43ce0f2cdd44e018f5cd742ed4c2c241c0244db6daae4f05957b22a4c7deb06eb36b4f40e8e11c1ef515e3ad2bfa1498ffd331f147e12af917d6e91bebdf833abec329612195af81e41c44a05a09160795ec76c0b5f45a63a029becf1f2cae17c868741b09743a787fb98efe010ec9fe98e746badb70f74ac50fbe09db46153b43e9e41a47c68379f8104639fe0c4fdbe25c75481b74eb9250052c34330a32cd3452ad054bdf094eba7b5ddf5ad8714fb3b00806cc883e5ff1b82cc65060f35e58ae639640b3f31ceb09eb5abcbb3724731ce4ad67e13826798c4518844758fb8e1b322ce644bdcba5739ee58f835c14b0c20ceb40e28178f776b5b56035a88345c2a9769ce37859d24683ae75a866ac217059bddf0b56b4c23451e83090370e6cae054e087976d88b33d6ad78f18b3db5f52e58a7419d3fb861915d40ce1fddb07a98a6c1f532820b6823dd9ab08c610dd2f3d5d71e704a776897a218dc1a72d32fac57ec0a9558f873b32811169f1537eba69733a51656c3fa6e70a7a1a7ee5a58d627fbf8f317ebfa84f05473b0862a9d203e11e40d2c15285d5817df86d4c23afb02746243f1ff3b58a3a4fd4e73b086614a58b740de8d028149ee57d772580dd380227f5a8bdebdb098ea1e7e7a18bb5a321ccdc19a67504ec3387846d024e8e6c9ae67cf6f3e9f9fda3f35b5381058df652c02f3f0ea44f4ae85259402037fba630fa7241c8fbc2500b7c30796fe13f0bc8a534c157428dcfe08ec64e820242d11d05014c3eca1e3028215f33c746206c670772b2cc2085cd08e21c96150624610a80efa9cdeb02843233ca928709f34910ee83ad4b2e84ab830f02c8943f7605040b0aa59ee19d87c1a7f77c0124a61723aeb8ad880a5ffc1a79f676471b8b61a3eb07433bb793ba5dc707832dad5207bb7894e834636fd1c182c2bbd106eaf7a1630c180b57bd71dc222e87e5e0b1a371c001810a1f708cff88525543e01e7a16bbb2370f050af4f35026185bba2f0d6c140a7e97ad5b028eb62b8679c47d377040bafa8301fd97de64e4716e11804877a262f0667c4b89495cd84278583925101777af53058e003cb79a051932a6fa469c37c780094c4e31808c3d794c944f0d0b9d0fde7d5c36a62478c010fcfb0644b618998aee45434a59fffe9ebbd963b8485a4c8718ab18cb82b3136bdf7be5d3e87b9bcf13a2b06b158146362863d87f883251e95c18d4b787f076a355a51661af48ec217f014763fdcf784d25290cc18ba04ec763a6f60d4c3a29ab818786432172502862561da9f5391beede4eb557b0fe61695145eb8335814b752f60e6e8c4b4949e9fdeed955a14c949cf5eed09553264c78aad7b851750fa17e61e1b20d1657bf8d4b4c4b16c5ca4fdf883b433a03f8fe1f8fcee4c5eb56692be18ccd164da07a58e2e95fd928b0338d4371f5b02ac460fdfe2b1587769efba86adfc1dc9292fcf242cbaf5c39520b8b89b8e1e952b53720c953dd8f4be1b49a86f985453916bba2401d067470261f8e974edaf59b64e6e366cc18e48cfeac957e330058143a12ac189da718d4c23a79a6e250faf937b6ef3b952bde9dc92fb4dcf67e965a581437d713d60a94e2cabc433ed2919d5f58141f53ece3c28e8181183aebb84fd11c840810168e422ff7ea444c5d44da52f5f597a772cb8f6dcd2fb7a8bccca61a962d738e4777a4e3632eccbb9bcbf96660515c72ac57dddec9723992ecddcca363a52117102c31960e3fe7cf315c93babb0e4525e596bc006efebd0d954bd4b922299d2314b0e0d49b0dbc039aee3f5011a301d5f8c74677f70853674aabd15babe1d31a0f971aa1e62beb3ed1df86383b85140c5ba6280a5fbfd82a153165f0f9af0a587036c78ab042e783e40b93df72c6c065c3d8bd9a0eda35c922052cfacf2fb717e595b7c50f695d2025dbd766b87e8a2cfd1c640d87f848cc343736a15b4d4d4d87e2556be1f714f419a949d780c755d3d0fb691b78970e03adb69fe8e9230a98a97f548274f65e93b02a350db32962f4fa984db1df41f7a2b876b57c1182de300fb4b380715feff904e4f41207b0ee164846ba03d034f9999413dd680c162ccb9be7ae28dc3006918480114d493c6effc25297ef624409d36051c2e219d7c7a6313ea3fac32143120f8c7038e30584d77baeba28633a902856352198a7fb88332871efc4b5a971434ec463bc530502f169c701726869e0093efa923cc809de05dcf28387cc1e57b124f14d2b7394ea18813a1e17ad08da2a9d9422eefd8e9f96dcef4b558d7eca4886176f44f3088d53bfd28e42239cf429c57d5eb8235879451feda7da9078c37ad392a7562c85455587cd6d19d6dfb61e532b170fbedeb65879ff7727fd8d5f54cbb9f49cb6c5cae72f7447d5cb11334eb569589a68b034581a2c0d96064b83a589064b83a5c1d26069b034589adc06d6b79aa894bfffb69d266ae537bffb1f5062be9988df94b40000000049454e44ae426082, '995034234', 'Enrique Segoviano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IDRol` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IDRol`, `Nombre`) VALUES
(1, 'No Definido'),
(2, 'Vendedor'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDUsuario` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `IDRol` int(11) DEFAULT NULL,
  `estadoRegistro` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUsuario`, `Nombre`, `Apellido`, `Celular`, `Correo`, `Contraseña`, `IDRol`, `estadoRegistro`) VALUES
(1, '1234', '123', '123', 'DNI@uni.pe', '$2y$10$2jHrp.BKAKvk.1H5PYpTwuAasN3jyw33hUT2QlRAYEkEsF3cAX9ke', 1, b'0'),
(3, 'jairo', '123', '123', '123@unfv.edu.pe', '$2y$10$0Y.tj1aG95e5XSUaUbhrtuad/1SyE8ANnZAJ2OVSuEZ8PxZ7IFiZe', 3, b'1'),
(4, 'Jairo', 'Gonzales', '9970', 'jairo@outlook.com', '$2y$10$GmeFWNmz3aYhvNGDkZ3SxuLTV8CscCcIi0q1C0ZaCY.tZhoKRlUtG', 1, b'0'),
(6, '123', '1233', '333', '4414@gmail.com', '$2y$10$Y2HRk5GU1ZfYZ7vDCWCTceljhDEqYfyBdG282druGhcolSQc1JYlq', 1, b'0'),
(7, '1111', '1111', '444', '12332243@unfv.edu.pe', '$2y$10$7lAjJ5V40aDMWgMX.Iveou/ESw2dNKznLof6qrhePdKK3JRpN.H5O', 1, b'0'),
(9, 'Jairo Alessandro', 'Gonzales', '999', '12345678@unfv.edu.pe', '$2y$10$zNn6Mnp1/yd.ziiFleVKt.s1TD8r21TM.L.DtpRDIvwoSzMWsEb/u', 3, b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletaventa`
--
ALTER TABLE `boletaventa`
  ADD PRIMARY KEY (`IDBoleta`),
  ADD KEY `IDUsuario` (`IDUsuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IDCat`);

--
-- Indices de la tabla `detalleboleta`
--
ALTER TABLE `detalleboleta`
  ADD PRIMARY KEY (`IDDetalle`),
  ADD KEY `IDBoleta` (`IDBoleta`),
  ADD KEY `IDProducto` (`IDProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IDProducto`),
  ADD KEY `IDProv` (`IDProv`),
  ADD KEY `IDCat` (`IDCat`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`IDProv`),
  ADD UNIQUE KEY `RUC` (`RUC`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IDRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD UNIQUE KEY `Correo` (`Correo`),
  ADD KEY `IDRol` (`IDRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletaventa`
--
ALTER TABLE `boletaventa`
  MODIFY `IDBoleta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IDCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalleboleta`
--
ALTER TABLE `detalleboleta`
  MODIFY `IDDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IDProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `IDProv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IDRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletaventa`
--
ALTER TABLE `boletaventa`
  ADD CONSTRAINT `boletaventa_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`IDUsuario`);

--
-- Filtros para la tabla `detalleboleta`
--
ALTER TABLE `detalleboleta`
  ADD CONSTRAINT `detalleboleta_ibfk_1` FOREIGN KEY (`IDBoleta`) REFERENCES `boletaventa` (`IDBoleta`),
  ADD CONSTRAINT `detalleboleta_ibfk_2` FOREIGN KEY (`IDProducto`) REFERENCES `producto` (`IDProducto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IDProv`) REFERENCES `proveedor` (`IDProv`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`IDCat`) REFERENCES `categoria` (`IDCat`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IDRol`) REFERENCES `rol` (`IDRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
