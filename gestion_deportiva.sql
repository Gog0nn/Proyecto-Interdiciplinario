-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb
-- Tiempo de generación: 12-06-2026 a las 21:17:54
-- Versión del servidor: 10.11.16-MariaDB-ubu2204
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_deportiva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE `Actividad` (
  `id_actividad` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `id_genero` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL COMMENT 'FK a TipoActividad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`id_actividad`, `nombre`, `descripcion`, `fecha`, `hora`, `lugar`, `id_genero`, `id_categoria`, `id_tipo`) VALUES
(1, 'Práctica Técnica', 'Entrenamiento de técnica individual', '2026-04-11', '08:00:00', 'Cancha A', 1, 1, 2),
(2, 'Partido Amistoso', 'Partido de preparación inter-categorías', '2026-08-22', '10:00:00', 'Estadio Central', 3, 2, 2),
(3, 'Práctica Táctica', 'Trabajo en bloque defensivo', '2026-05-20', '09:00:00', 'Cancha B', 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistencia`
--

CREATE TABLE `Asistencia` (
  `id_asistencia` int(10) UNSIGNED NOT NULL,
  `id_actividad` int(10) UNSIGNED NOT NULL,
  `id_jugador` int(10) UNSIGNED NOT NULL,
  `presente` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = presente, 0 = ausente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Asistencia`
--

INSERT INTO `Asistencia` (`id_asistencia`, `id_actividad`, `id_jugador`, `presente`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 2, 1, 1),
(4, 2, 3, 1),
(5, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad_max` int(11) NOT NULL,
  `edad_min` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`id_categoria`, `nombre`, `edad_max`, `edad_min`) VALUES
(1, 'Sub-10', 10, 8),
(2, 'Sub-13', 13, 11),
(3, 'Sub-15', 15, 14),
(4, 'Sub-17', 17, 16),
(5, 'Sub-20', 20, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Det_Jg`
--

CREATE TABLE `Det_Jg` (
  `id_jugador` int(10) UNSIGNED NOT NULL,
  `id_actividad` int(10) UNSIGNED NOT NULL,
  `posicion` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EntCatGen`
--

CREATE TABLE `EntCatGen` (
  `id_entrenador` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_genero` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EntCatGen`
--

INSERT INTO `EntCatGen` (`id_entrenador`, `id_categoria`, `id_genero`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 1, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Entrenadores`
--

CREATE TABLE `Entrenadores` (
  `id_entrenador` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `nro_contacto` varchar(20) NOT NULL,
  `CI` varchar(20) NOT NULL,
  `foto` longblob DEFAULT NULL COMMENT 'Imagen almacenada en binario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Entrenadores`
--

INSERT INTO `Entrenadores` (`id_entrenador`, `apellido`, `nombre`, `fecha_nac`, `nro_contacto`, `CI`, `foto`) VALUES
(1, 'González', 'Carlos', '1985-03-12', '0981123456', '3456789', 0x89504e470d0a1a0a0000000d49484452000001140000007b0806000000b5a57f420000000473424954080808087c0864880000001974455874536f66747761726500676e6f6d652d73637265656e73686f74ef03bf3e00000026744558744372656174696f6e2054696d65006d69e9203130206a756e20323032362032313a31343a3333f20cd69d0000200049444154789ceddd797c54e5bdc7f1cf39b3656632d9f71542d80221120208611554c2262a2e58b16a6bebedadda0ab65a7bbbd0d66bafb5ad4bb5add56ad56a551445164512f63dac59d84220907d5f679f73ff08198859c8241308f8bc5f2f5e9a99799ef3cb24f3cd739ef39c73a48484040541b886a8d56a828282bcda674d4d0d0e87c3eb75dc7ffffd9d3efee69b6ff67b1db22cf3dc73cfb171e346d6ae5ddbeeb9b973e7326bd62c9e78e2095c2e578feb507b5499205c05743a5dbff4e9e907b9277574161c5d858cb7eb70b95c7cf5d5572c5fbe1c8d46c3a79f7e0a40464606cb962de3c5175fec344cbaab43048a70cd51abbdff6bdd9b3ebb6b939595d5e9e33367cebcac75ac5bb70e80e5cb970360b3d958be7c392fbef8a23b603ce953048a70cd91246940f479a9365f0f8fae42a6bfeb58b76e1d9224b16cd932009e7ffef90ebb403ded53f6b83a4110842e88118a70cd5114ef1f67e84d9f574b1d17cf99b4edf25c3ca7e2499f2250846b8ec3e1e87222f252bb155dcd61d8ed76afd6d19dae8ef0f4471d1919199dce99b4cda974152a5dd5210245b8e658ad568c4663a7cf5d6ad2b32b369bcdab7540cfe64cfab30e599699356b56873993b6399559b366b17af5ea4e8ff474558724d6a108d7a2c0c040341a8d57fab2dbedd4d6d65e9375c8b2dce5a1e1ae9eebae0e31292b5c939a9b9b07445f03bd8eaec2a4bbe7baab43048a704db2d96c98cde63ef763369b7bb59bf14dad43048a70cd6a6a6ac26ab5f6babdd56aa5a9a949d4e1411d2250846b96a228343434f4ea2fb3d96ca6a1a1c12b877ebf4975884959e11b41abd562341a2f39416ab7db696e6eeed3eec537b90e1128c2378a5aad46abd5a2d168dccbc71545c16eb763b3d93c3ef14ed4f1b5fefaa3484118a81c0ec765fbb07e13eb1073288220788d08144110bc46048a20085e2302451004af1181220882d788401104c16bd42d2d2d57ba064110ae11eaa8a8a82b5d832008d708b1cb230882d788401104c16b06c4d27b318f2308573783c10088118a20085ed4ab118a640841377a119ac864acb2119dab197be911ac39ab505aaabc5da3200857098f03450a1b853efd11a6268593362484303f1f2a1a2cec2b88636b741ae6ed2fa154e4f6bd32c94074ca242626271019e88b46e5c26969a6aea288bcdddbd87fae852b72dd05d530e6fff74db8d6bccada0267cfdba94318b7e856869d5bcd47bbcab003923698c4d4095c373c96307f031ac54a637509a772f7b1fb70312d3dfc0625d3752c7e20958a8fde647349d7d7086dff3d64a0cd7c939da6b9cc8f3ece27abb2a9baf227bf0a57398f02453284a04f7f84ff9a3392a111beeec763830dc406c7313a2e88577904f3173fefe3484522246d11b78d7772386b2d5967ab6971c8680dfe440c4e2432320253c9291a7af0d91918d4444e98c304d57efeb3e77c98e862485f7c0be30c651cdcbd816da50d38d4be840e4a66fcd4c52444aee7832f8ed1a8c844cfbc9fc9b51ff2d1c146cf4254d262f453636b68c1de69433b65bbbfe0e01d779331b184f7b697223245e80b8fe65074a31731756444bb30b9d8d0085fa68e8c40377a511fab0a60706208e6bc6d6ccd2fa6b6c982d5d242634d2927b2b7b265ef950f13c5835bcc4afea3491fab216fdb216a5c006aa226dd449ae91c1b3ff884cd870b29adaca6b2f40c793bd7f09f353958421388f1934032121ad2f5bd5dbaddae7e1837df3b8b84eefe6cb86a38b03d1fcd75e98cf6f7fe3d81856f168f4628eaa814d21283bb7d4d5a6230dbf352fa54148a03bb037c42c3f0531553d7cd9e85641ac4c41953488e0b422f59a92bce6757d6768ed73901099fe854664c4b2121d41fadd2424dd111b66edc4561930b5489ccfbaf1bb06eda8a9c3a93a14d5b79f39323b468c3193d651ae38646e0af036b7d190507b7b1f5502996d602510c8349bf6d2a29317ec82d65e464ad654b41231d734e2264d418a2eaf2c82a3dfff75f1dcba8117ed41d59435efdd75b28580a37f26e2120079176e73d4c895243d403fc6070166fae3633e3e1f635bff555dfde6e47c911f21aee61cca8100eeda8bc32bb92c235c1a340b14b3ac2fc7cba7d4d989f0f76e9c26d0fcf9e3d4b6565a5fbebd0d050626363bbdf90d2c4b17d39a42c98ceb7962670e24421678bcf71b6b892a68bc7ee5208e3e7cf6344cd4656be768c5ac59f61331771f34207f5efeea05c89206dd6f58497ace79d8f4ed1ac89206dc1edcc995ec51b6b8f63c585d3a5232e2591827d6b5855518d051349736e658aee08eb3f584371139862c771d3cdf399d1f4365f1402a8881f93c8eecc0f79bd5acda099b73167e6384e146ea2f8ebf920fb131f1f40c399d3e7472720fb8511aab350525cd549005dc455c3be0f5761face6d84ecfd67eb2e8f2aa163cd4a62f7efe7a5b86a3873a68909f1f1f8efaca44e248ad04b1e058a46b152d1602136d8d0e56b2a1a2c68142b6d17eb8f8989c162b1d0d8d888c964222626a6075b52301766f1de3b67484e1949e2d0098c98301d95b399b28223ecd9be97823a07724412a3432bc85e7d8c1a9b02d4717ce721521e18cbf0b05d949796b2ed5f7f615b5bb7f6728e9faa66e2a83002384e390a2ed4706e3fdbf28a710272e078c6c4dbc85fb993c2f309505db095f75ed9dada870a40a22e6f07874a9a508093c74b700c0b24402b516cf9daa7510a2224086a0ed4bafff22b5a1d5a6c586dbdf9e476ac59325db4b9d0c92cbdf77a422eda7b19f4c8e3cc037016b3e9cd0fd8dfe14e082e6a2aab21398420996e478482d01d8f02c55172887d2763bb0d94ec822a9ca587dd5f4b9244424202a74f9f66d0a041ee0be15e9a82ada680ecac02b291501b82891e3c8c9409e359b0d8c8aab73752121880af3a9659dffb31b3da3575d06292a1542220f17aa68c1f4654a001350a924a8baaf91cb2bb0c27b5d5d5ee918214184c10f5e4d676f76177d1d8d07c61d7c0e9c08184d4c98c94a4f641afb2d168bef02995ec166cf8a0d7cbd0fd18a50bed6bbe9852b587f75fc94602d027b1e0de388ebeb99e13f6d6ba1d36a5d3993387c58c4365c0472d81530c5184def12850ac39abd81a9dc6e8f8c04e27664f9435b1f3582953cd2fb0013d4aebaf352a958a214386f4a14c05474b156772ab28aa50b8f79e1486466451a2008e93acfbdb6a8eb6bbcabf04b8904326326fee182c3b3fe3ddfd25343b2502d3ee66e998f6bd3b9daef6f30692dc69385c5c4f5f261a5cf5155458b4c4c585a32e28eed591950e35bb4b7360b3b6f628a9ecb8141776ab15abbdf7f50a424f7974944769a9c2bcfd255e5d9fcf277b8a385bdd82d5eee26c750babf69ce11f1b72f989df8f5930f4280b469e42eab7e93d07768782bdb68e462990e0000945512efae742514013164130673972a09866a7029296b0f0806ebf69a5ae9a1a02090d5679a552c561c1ecd460d05fd49fe31c39797598464d2135ac63a6ab4352b9f5de5bb82ee4f22d6456fbe8513b2d581c627422f49ec70bdb948a5ccc5ffc9ccdc58bd8917361a5aca32c87a9e617f01b7a948430b8917ae014abf313dc23959e924c23b871c138f467f6b3ff6439f5cd569c9206dfe07892d353f1afcce68b32178a2b8fbcca1452a7a651b8369b529b9e8831b3b871640d1b3fd84a69631316299698680305c532e1c953490ab0a068f5f8c8743aca70d51ee5c89934664c9dc6d9963d9c6e04dfc831ccbc790cb6adefb0faa8a76f580d553512a3420291283fbf490765bb37b0377611e98bef2460f73ef2cfd56291f504c724316efc700c67379255e3029c389d12c68000f43a0b560f86338ab980cc0fcf61be641b99a09060a839ec9e381684dee8d5d27ba5a50acb9e7f9c3f840a6d7b1b1bd0e363f7e746eadda162779d66ddb1c19ef5df789c1d5b0d4c481dcbecd18198f45a64c581a5b18ae2939bf9704f2e154e802af6aefe1c79463af31e9c8451e5a0b1a290835bb229b68352bc974d3961cc58f810a3edf59ccbddca576bcf3263f14c3296da58f3ee99ce364eeeba4f504d9dc2a4db1f24430fb6fa724e65af656b7e9347eb4f0070d573e64c1d9307c5112897bb3fb08aad98ed1fbe4779ea44c68e9ec92d53f5685c36ea2bcf716afb47ec71af94ade4446e1949136fe5bec83d7cfc61b9076fa499ba8a1edc76520e222ede97da8233d48b018ad007526a6aaa577f852414168c3cc58d49ada1f2d511993f6dbbaedb36d7fad9c692ff752cbef73aca3f7e872da5036f2daa3a7a06f72d0a61ffdb2b39d8201245f05cbf9d6dac20b13a3f8175b9416ccc91c9290ff2f626ae3a4a7d0e5b0f3a1935650c41036d31aa1c4cca94246c07b69323c244e823556464e4afbcdfadc489aa0076164570aac6ff92afb6dbaff543102e9a4a4b5146dec004df128e1537f5ea60b1f7698898b880197e8759b3f1384d03a328e12ad476d375afeff2f4c6b5becb2308d7bab65d9e0171c5b6b6620441b8ba892bb60982e03522500441f01a755595b864a32008de2146288220788d08144110bc46048a20085e2302451004af1181220882d788401104c16b06c44a59e10a536bd124ce445275feeb20e9039134fa5e77ef28da8ba3f860afdb0b570f1128df64928476d40274e3ef431518d76f9bb1a8b4dff8400908d122cb505361bbf48bafe23a44a07cc3c8be61c8be21a0f6413be636b4236eeaff6d1a02fa7d1b0395562733634138d3e787e3eba7e5ab8f4bf9f2a312ac96cb7b6b81cb558714171777c5cf36163c2769f4c8214390545a906464bff04e5f271b4351858f40d207a00a1d8aa43375fabafe643fb989e6cf7e72d9b77ba58d4d0f22e3ee28fc835a4fed37f9b7deafaaaedac6aa378bd893757956a95fce3a44a05c25246330daa4b9a88206231983d1c4a6814a73a5cbea1147f1019afef3fd2b5dc665133bc4c8c2a5d1c40d6d7f0bd9b60f729bc2a34d7cf8f7d39c3edee14649576d1d2250063875c4287c263d842a761c925a77e906fd48b15bc0d68ca4f707b9e77bcbceea421adfbaab1f2b1b184c011a32ee8a22756a105fbffd94add917a3af061fbff6d7fe5114d89d59c9a76f15515fe39d0b8d5dc93a44a0f493a79f7e1a80dffdee771eb5930362917d43515cf6d6f90eff68249516c9148e66f06464df50f76b5d2db5d80bb6a0581a504725a38ebe70ed5e575305f6c29db8ea4b906455a7ed0194961a6cc737a2d83abfc895ece38766f86c5c8d15b464fd111407923e1063c6af91d43a149703fbf18db81aca907d43d10ebf11541a14732df653db713594a2d82d58f6fecb7d933745513cb8e15b478ad2fa2bfbf53ebaeab7afdbeb89e919e1cc5a1c8ecea7fded575c0e15eaa6c9cc98740b00dbf6ac461dbe0795a6fde5f1ac6627abdf2b23f3e3b357751d625276009064153ee9ff851c9c8066f064eca77761d9f72e236302183b2a0a974be1605e3e79eb37a09ff820ead8541c677663ddff3e23068513191542e68ebf61bce57924ad017be10e2cfbde65d4d038c64e1cda69fb36d6432b19a42e6764e2a04e6bdb9f934d45be13ec66a68e1fcd928537f2839f3f87623723a975d80eafc2af6a2f935393d9ba3713b3d6886c0ac7bcfd5586c484903676242ea793cda53194141703306cd830468e1cd9e9f6b2b3b3293effbaaf4b4c4c64fcf8f1389d4eb66ddb46494909d01a18b7dc720b66b3992fbffcb2d3f0983e7d3afefefe7cfef9e7cc9f3fdffdb8cd66a3baba9ac2c242fa72e6fde8af749c533732e4ee0b13d0b6aae15c9f7c07119111eec7664fbf83b2d2a9ec3ffe31a69802f7e3999b22c8a9bf1b58d6eb1a06421d6284728549b21afdec27d18e5e0880aba194962f7fcb4f1f5ec2e28c1bd8b2e7201ab59af4b464def8e073fef2eee7a8224723951de4074b6fe7db8be7525256c9fc0797639cff2c382c976c6f9cff0c92b675bfdabcf525660ff765f1dc1b3ad4366ef4089e7cf62f649ed3e22ccde167df5d84cd6ee70fef7c8971ee6f70569ec0bce98fbcf2dbe54c1e97ccd21ffd9a6324622bd8cabd0ba6f1c8fd8bd9b4eb001ab59ac9a9a378f2c927d9b0610373e7cee58e3beee8b0bdb4b4349e78e209d6af5fdf2e141445e1dbdffe368f3df61859595968341ad2d3d3ddfd01e4e6e6a2280af3e6cda3a8a8a85dbf818181646565a156ab494d4d65fffefd141616525959894aa522262686f0f07056ae5cc92f7ff9cb5efd1c9f945b6f1553e96b27f0fbf18c9b782fa3478de9b64d6ede61b6e6ae67d596d1d8b5c300a858fbed5e6d7fa0d421462857903a2a05fdb44750455df881db4fef64cc88c12c597813df7bea59f6e49c0245e18e9bd379f2bfefe3ed8fd7517f761f2ffd7a1976879d7fad5cc7ecf4348fdadbcaf351c7b6b651458ce68b4dff61fda65ded6a5b74f374428302c8dab91f79580676732d93c625f3ec2bff421d3e12c561c5b2e72d6ecf984e70e0850b91dbceec262c40c7630fdcc94ffef765b2f6e681cbc59d5387f18b5ffc82cd9b37b376ed5ad6ae5ddb6e7bb7dd761ba1a1a16466667608938888087efce31fb36cd9323233335114856f7deb5beefe6cb6d63515858585dc7aebadbcf0c20bedda2f58b08073e7ce3168d020f7e3fffce73f59b972a5fbeb8c8c0cfef0873fb076ed5a76efdedd9b1f2700a14d1ac25dd3c16ea2a1be093fff8eb7ec05a8a969e06cb193fd39e3b06be37bbdbd815687587adf4f9e7efa69f73c4a67021edf83efddafb50b1300ec164aca2af9d1afffccee03b91866fd14edc80c0e1f3d894a96090a68fdf0befdc97a1effcd8b34343679dcfee2f912edd099f8def9574c77fe0dd39d7f4397bc88407f13cb1e5ac26f5ffc27aee061485a3db151e1840707b2ef703eaa8824ac873e22d2171e7de02e7efbe23fddfd29e65aa64db88e86a666b276ee473fed317c26dcc7aad56bf0f3f363dcb8714892e4fe07101414c4134f3cc18a152b3adc01419224a64d9b46434303999999eec73ef9e413777f6db2b2b258b87021b2dcfed77ad1a2456cdbb6adc3cfe0e23ab66edd0a80c9d4f7c3ea92243379f254fc8c511cda7f0287e3c25a0fbbddc957990728ae54312c2915c9c3bb6a0ef43a44a00c30dae45b688899c5f64a3f7cd2ee05598dfd441653c6a75056594d517119eaa8ebd85f6c43658ae8557bd93faad36d2bb6666c47bfe091fbef60e7fe1cf61e39812e75098eb23c268f4be650fe492c56078acb89f3d436562cfb1eefae5acfb153ed773106c7465178b614909003e390830661b6daa9acac64c89021ee495568fd503ffae8a3ecd8b1833d7bf6745ad79021433875ea54bbc75a5a5adcfdb5d9be7d3b3a9d8ef4f474f763494949444747b379f3e68edfeff97b616b341abefbddef525e5ecece9d3bdbd5d7177e7e7e4c9d3293a63a38967f9abdd947c93e5c4ec2f0548cbe9d8f18fac3e5ac43ecf2f4134f8feeb491b446f7ea556755012d1b7f4f7af2601e5a720bcb7ef30204c4a34f7f182409f396177bd55e153ca4433b00dbf18dc486f9b370f6546e7ff829b4c36e403604e2ac38cea4d459ec3a9083640ac37af043eeb9e5460c7a1dff787f356a55fb230abe4603cd6633a87548b20a347a90d5343636e2ef7f61f7485114e2e3e359b468118b162deaf2088dafaf2fcdcdcd1d9efb7a7f76bb9dcf3fff9cdb6fbf9d2d5bb62049128b162d62ddba7558edad47336463eb8de756ac58c18a152bdc6dcb2b2a79ea57cf6056f9a1bb6e0eb2e1c20dea24b50f922190962f2ebcde137171f1c4c5c573f044c7c9669dd240c39137b057e7e36ca9ec55ff03a90e11280394e3ec7eccbb5ee7ce79d379fcbb4b78fab9bfb2fdf0290cb37f4a87c5055e68afb89cd80bb672ef776f65f7a13cce9454e1bbe0269c5505c838989092c43fdeff0ca5b19cf8e8701ebef756ee5ff65b9c4e67874071b95ca864195caeb6074056a352a97038dadf8a75e9d2a5ecdab58bd3a74f771a289224e1743a9165b9c3e1dfcefafbf8e38ff9e0830f080a0aa2b1b19179f3e6f1c3471e451ddc3a592907b6ce13bcf0c67f58bfb975dec8a0f72175f4705e78ee77fcdfabeff0f9cea3f8dcf00448ed07f0bd0d94aeacfd6c253b3f7f85c1c393084f4e47ad92703a15ca4a8a38997704bbedf29cf7b3f6b3951c5cff320bc7041237ce808f7630169b8ba24a0beb0f54d1d0d2f3dbe78a40e927bd5d8702e02c3d8265f7ebfcf83b8b59306b0adf7bf259728a6a30dcb01cd937ac5fdabbaa4ea276b590317312bf7ff56d34d129483e269cc7f3183362080ea78bbc1385288ac2cf1f7d80dce3858c1a3a98514307a356b706ca94f129e8b41aaa6aea189e1087e2b4a2d8cdb8ccb5486a1dc1c12154d5d421f99890d53ea89c66e6cd9bc7fffefe39641f53bbd302249d0949e78bb3b688aada06468c1c85a433a10e494471d970d614111c1242555d93bb9da435703cf704c78e9f64e16d77505a5a465d7d03874f95931a36b4ddf75b5bdf48b9c31f4dc2146a1c160a36ac233c24881fdebf98cfbe7a0c576339b25fa4c73fbb9edabe39937ffde3af4c9a7933d1c35218337126250547881b9acce15d9b88888e6557d606cc2d1d4766deaee3b3b7ffc2776647322cda8f4111260c3e1a5a2c764e97351217e6c3bb9bca28adb5f4a83f1128038ccb5c8765d71b7c7fc9026e9e763d4b7ff46b8a2bebd08d9a8fb3ba10577d2992ce88abb91a97b9ae5d5be7b9fd38357a6c073fecb6bda3221f67692e924a836664069a41d7e328cf2779f810fc7c8dec3e908b6a48eb022847591e93168c67f7811c144502148e159cc1e46b242da5752d89eafc2468d2d041d4d43770e46801f7dd9e81de4787fd4426ae965a86248d2120c09f9c92160cb37e8a6237335a750a3f3f3ff616d66198fb5b3483270360c97ed75d9fa40f20f76c2df72726e01b371a57e2cdb85a6a49701410e0ef4fceb90654e7c3420e884115d6c2aacc5dcc9f3397eada7a3ecbdc8d64ba4408abb4486a2d8aa2a0f7695d8dac387bb75ab44676109e99cd918963499e90d6e96bec763bff78e5cfa44e9ac6b0d163b969721a3ed1b1a40c6b3de37bd8e07b59b34a8ddd6a65db57ebfab58ed75ffd33f7a48731363108a3e4a0a5a1919686d6e7c30c604c0cc26a77f1f29a227a32b52402a59ff4760ec57ef44b86c787f1fd6fddcaf2dfbd84824254a83f54b41e85a8ad6bc46ab7131e1a043e60f235a252a9880a0f81d24c6aeb1b191e1fd96d7bbbd5ca8fbe7337470b4eb3e170169a41d7e3aa2b66e4c441d4353452595387312d0ec5d288abfe1c93d31ee493f59b51458c42526978feedf5ee7a15a71dad6261feac74fefeef4f3952508c1a3b55b5f52c7be81efeefafefa0d5a859f6b31fb2f7703ea7ce9662183516ebc10f3b6c0f40b134602fd8e2aeef8b2dfbd8b1ff4897fd1514b59f0f5099225897b593c71f5a82cb19cdb3affc0bd9a7e3d9ce81fe26c2d5f550b4065996193b6904772fbc91759b762269f4a8ba98b8ee4aa3e424d060e436bf4828b7c28ffec257538693f4e852a262a2dbbdf660f63e14240282439873ebb73056e7a02dd98b4fe244ec25b9488183b87df112ce151c27303894daea9ecf69785a47a4d1424c48300991fe94975533f2e17f93ffd77bdcff4d88f4e75c6533a3e27cc93973e9737d44a00c30aefa12a6cc4a419625fef83f8f7678fea9dfbfca9e4379ac7beb4fed1e6ffbfa7ffef077c24383ba6dbf366b07b3d3d3d0a8d56c38d8fa8154ac8d8406275153d70880e4e38fb3e2287ebe7a92860ee627cfbc8c2a6a36daa133dbf5e728cbc3b5eb55f7d7da11737094e7f3d8affec4ef9ffc017b57bf01c0bec34779f2d9bfa04e98826c0aeb747bd03a9703b4abcfa53576d99fca3f0667fd39f7f6553163693ab989ac1dd9f89b7c29af6e409b381d68bf94fcb107efe2b1072f9c5f54545cc6bb9f7cc16bef7f8a36f90e8fce550228d7c3ecaf9dd610bded1855bb7f49fe5de94c7ee06e9a5a2cbcb12697fc9c63f8070612181a81d35c8fefa0145c273663d9f8123e8913d1187d69a8ae21342c1cffc0408f02c5d33a92837c0832e9ba9c9693240832e9880ef211817225f5fa5c1eff285e7bef535e7befd36e5f97326769b7cf77db5e5233ffc1e50068e227b66ed714c69f5f7f9f3fbffe3eb221084967447139305b6cccbbff714a2bebf11d9fd2b15edf50cc7697bb1ec3d43968864ca570d7ebdcf6fda7080f09c2ee705053d78066f0147cc6ded5e5f680f373297eedead38dbdabebfe46cea1e58b15eeedebd367c190693cf5fbd690d30e9e822a6c1807b66f74bfa6abf74e3686a24bbb1f75dc846edfdbce7cd45444a6b98c07fc8630db10e95ed5a1b13b897a670b87d767f3bb090fa236a4a0a88eb56e0f90255049a00e89c37672276a5358eb63f468eedd2b7578930894014677dd62d47169e0ea62665da543d21a50ccb59d3e2da974288ab3dbf6b26f30aefa129054c841ad473d74e3ef4333643a284e64ff68906434f1d7e3d01aa8b53663bc2e16e9a243a96d64df507ce7fd0657731592cee49ec8d44f7b145743190d754528920adfe0c1edda77b6bdd60ed518337ed9ae3e495677db9f71ee0a5c4d95485a5f64ff28d45163d0c48c0314a48058245985f1e65fa2d89a40a503a7b5e3fb660842368674fe9ef5508dd3c6f3b5f97cde5cccc3fec318a9f5733fe757d58cda100c804fd020ea726ba9a92ac7e8178053015d4802410b9e02c0a980af7f009515e5d4d776fe73f6561dc5672cd4345abb9c1f5114a869b4525cd3b34959712ecf1512f078e78bb88481abee8f9e8d5c6e3044f0a0df104254ad13bd3f59fc2b006c0d651c7d73095366ddc4988953b8edf6bbd16b6454e733d5e154f8e8c3f7d8b7735baf27657b5ac7b1b796f0c3b9d15c3f3204a3d4f18f50b3a266577e95989415842b2db3a58c1de64aee34c5b3d8370ec569a332fb3d2af6fd1b1427d93bb6a0d5e9f8c06667d2d41b28387a84614963d8b9259363b907c8deb1a5dfeb505c4e3eda5e814e23777ad8f878710d1f6dafe851988018a15c31628472f5f1748472b170950f35067fec8de5ed1ed768b50c4d4a26222a0e5925e1722994151771a29f16b67555879f41cd9cb121c485fae0a3957bbdb04d04ca152202e5ead39740f9a61027070a82e03522500441f01a11288220788d98431104c16bc408451004af1181220882d788401104c16b44a00882e03522500441f01a11288220788d08144110bc46048a20085e2302451004af5117490957ba064110ae72714aeb9d1dc508451004af1181220882d788401104c16b44a00882e03522500441f01a11288220788d08144110bc46048a20085e2302451004af11770e14042f50c9e074f5dfeb2f87d39bdfecf6f941d3efbf641f225004a18f02f51249e132bb8a9c3d0a09950cd7c7a9c82b77516b1e58d788efaed05ffb000001b4494441542a342e15366d44a008421f04ea259223551c29ed599840ebc824afdce56ed7db50d1fb68315bbabe5de9a59e6f73715874161c3d1999b411812208bd747198781a0ab5668523a5ce5eb7d7fb68d9f0d6332c7be635761f3ad6e1f98929c379fe670f71e3b77fd6a350e9ebc8a48d989415845ee84b98b4b9385402f592476dcd161bcb9e798d5756fc908929c3db3d37316538afacf821cb9e79ad4761e24d225004c1432a199223559ca9edfb1c48ad59e14c6debee8fcac34fe3ee43c7f8c12f5e6e172a6d61f2835fbcdce9c8a5bf895d1e41f090d3857b64d16051fa142a817a89f840d9a339988b5d1c2a7f7b6f2ddf5f32f78a850988118a20f44a5f7657da7863b7092e844a7f858927f32862842208bdd49789556f85499bdd878e31e5ae65fd3267228ef208c265d2162a9eae43490a97bd16266dfa12269e1ecde98a44fc8c81b5b24610ae42d7c24ad9be10d79415042ff2341caea530b99808144110bc46048a20085e2302451004af1181220882d788401104c16b44a00882e03522500441f01a754468d095ae411084ab5d45ebc236b5b662df15ae441084ab5968682895e7ff5fecf20882e035ff0f19e784d5d50f011c0000000049454e44ae426082),
(2, 'Ramírez', 'Laura', '1990-07-25', '0982234567', '4567890', NULL),
(3, 'Mendoza', 'Miguel', '1978-11-05', '0983345678', '5678901', NULL),
(5, 'Duarte', 'Roberto', '2021-08-28', '0984111222', '15554445', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Genero`
--

CREATE TABLE `Genero` (
  `id_genero` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Genero`
--

INSERT INTO `Genero` (`id_genero`, `descripcion`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Mixto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jugadores`
--

CREATE TABLE `Jugadores` (
  `id_jugador` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `CI` varchar(20) NOT NULL,
  `fecha_nac` date NOT NULL,
  `nro_contacto` varchar(20) NOT NULL,
  `genero` int(10) UNSIGNED NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `direccion` varchar(200) NOT NULL,
  `lugar_nac` varchar(100) NOT NULL,
  `foto` longblob DEFAULT NULL,
  `tipo_sangre` varchar(5) DEFAULT NULL COMMENT 'Ej: A+, O-, AB+',
  `alergias` varchar(255) DEFAULT NULL,
  `enfermedades_base` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Jugadores`
--

INSERT INTO `Jugadores` (`id_jugador`, `apellido`, `nombre`, `CI`, `fecha_nac`, `nro_contacto`, `genero`, `activo`, `direccion`, `lugar_nac`, `foto`, `tipo_sangre`, `alergias`, `enfermedades_base`) VALUES
(1, 'López', 'Andrés', '6123456', '2016-06-10', '0984111222', 1, 0, 'Av. Principal 123', 'Encarnación', NULL, 'O+', NULL, NULL),
(2, 'Benítez', 'Sofía', '6234567', '2013-09-22', '0984222333', 2, 1, 'Calle 5 de Mayo 45', 'Encarnación', NULL, 'A+', NULL, NULL),
(3, 'Benítez', 'Fatima', '5234567', '2005-09-22', '0984222333', 2, 1, 'Calle 5 de Mayo 45', 'Encarnación', NULL, 'A+', NULL, NULL),
(4, 'Torres', 'Diego', '6345678', '2012-01-15', '0984333444', 1, 1, 'San Roque 78', 'Posadas', NULL, 'B+', NULL, NULL),
(5, 'Trussi Aquino', 'Josue Alexander', '5656378', '2005-11-05', '992326561', 1, 1, 'sdfsddffd', 'Encarnacion', NULL, 'AB+', NULL, NULL),
(10, 'Duarte', 'Mili ', '323432423', '2007-01-26', '0984222333', 2, 1, 'Asuncheta', 'Asunbache', NULL, 'O+', NULL, NULL),
(11, 'González', 'Thiago', '7100001', '2017-03-12', '0981100001', 1, 1, 'Barrio San Isidro', 'Encarnación', NULL, 'O+', NULL, NULL),
(12, 'Benítez', 'Mateo', '7100002', '2016-11-20', '0982100002', 1, 1, 'Centro', 'Posadas', NULL, 'A+', NULL, NULL),
(13, 'Martínez', 'Lucas', '7100003', '2018-01-15', '0983100003', 1, 1, 'Barrio Pacu Cuá', 'Encarnación', NULL, 'B+', NULL, NULL),
(14, 'López', 'Santino', '7100004', '2017-05-22', '0984100004', 1, 1, 'Ruta 1 Km 5', 'Fram', NULL, 'O-', NULL, NULL),
(15, 'Giménez', 'Enzo', '7100005', '2016-08-10', '0985100005', 1, 1, 'Barrio Mboi Ka\'e', 'Encarnación', NULL, 'AB+', NULL, NULL),
(16, 'Vera', 'Joaquín', '7100006', '2017-12-01', '0981200006', 1, 1, 'Barrio Itá Paso', 'Coronel Bogado', NULL, 'A-', NULL, NULL),
(17, 'Duarte', 'Bautista', '7100007', '2018-04-30', '0982200007', 1, 1, 'Cerca de Costanera', 'Encarnación', NULL, 'O+', NULL, NULL),
(18, 'Villalba', 'Felipe', '7100008', '2016-02-14', '0983200008', 1, 1, 'Barrio San Pedro', 'Cambyretá', NULL, 'A+', NULL, NULL),
(19, 'Ferreira', 'Ian', '7100009', '2017-09-18', '0984200009', 1, 1, 'Praderas', 'Encarnación', NULL, 'O+', NULL, NULL),
(20, 'Rojas', 'Samuel', '7100010', '2016-10-05', '0985200010', 1, 1, 'Chaipé', 'Capitán Miranda', NULL, 'B-', NULL, NULL),
(21, 'Galeano', 'Emma', '7200001', '2017-02-10', '0971100001', 2, 1, 'Barrio Santa María', 'Encarnación', NULL, 'O+', NULL, NULL),
(22, 'Bogado', 'Sofía', '7200002', '2016-12-15', '0972100002', 2, 1, 'Loteamiento San Juan', 'Hohenau', NULL, 'A+', NULL, NULL),
(23, 'Paredes', 'Isabella', '7200003', '2018-03-25', '0973100003', 2, 1, 'Barrio Kennedy', 'Encarnación', NULL, 'B+', NULL, NULL),
(24, 'Aquino', 'Victoria', '7200004', '2017-06-12', '0974100004', 2, 1, 'Costanera Este', 'Encarnación', NULL, 'O-', NULL, NULL),
(25, 'Silvero', 'Catalina', '7200005', '2016-07-30', '0975100005', 2, 1, 'Barrio Ka\'aguy Rory', 'Piru-poy', NULL, 'A+', NULL, NULL),
(26, 'Espínola', 'Martina', '7200006', '2017-10-14', '0971200006', 2, 1, 'Ruta 6 Km 2', 'Encarnación', NULL, 'O+', NULL, NULL),
(27, 'Cano', 'Delfina', '7200007', '2018-02-11', '0972200007', 2, 1, 'Barrio Bernardino Caballero', 'Cambyretá', NULL, 'AB+', NULL, NULL),
(28, 'Ortiz', 'Elena', '7200008', '2016-04-20', '0973200008', 2, 1, 'Fátima', 'Encarnación', NULL, 'B+', NULL, NULL),
(29, 'Mendoza', 'Julieta', '7200009', '2017-08-05', '0974200009', 2, 1, 'San Roque', 'Encarnación', NULL, 'A-', NULL, NULL),
(30, 'Ramírez', 'Paula', '7200010', '2016-09-28', '0975200010', 2, 1, 'Quiteria', 'Bella Vista', NULL, 'O+', NULL, NULL),
(31, 'Ayala', 'Derlis', '6300001', '2013-05-10', '0981300001', 1, 1, 'Barrio San Francisco', 'Encarnación', NULL, 'O+', NULL, NULL),
(32, 'Valdez', 'Junior', '6300002', '2014-08-22', '0982300002', 1, 1, 'Barrio La Paz', 'Encarnación', NULL, 'A+', NULL, NULL),
(33, 'Ruiz', 'Oscar', '6300003', '2015-01-30', '0983300003', 1, 1, 'Cerca del Sambódromo', 'Capitán Meza', NULL, 'B+', NULL, NULL),
(34, 'Coronel', 'Rodrigo', '6300004', '2013-11-12', '0984300004', 1, 1, 'Barrio Obrero', 'Encarnación', NULL, 'O-', NULL, NULL),
(35, 'Silva', 'Ángel', '6300005', '2014-03-15', '0985300005', 1, 1, 'Paso de Patria', 'Encarnación', NULL, 'AB+', NULL, NULL),
(36, 'Sosa', 'Hugo', '6300006', '2015-07-20', '0981400006', 1, 1, 'Barrio Buena Vista', 'Encarnación', NULL, 'A-', NULL, NULL),
(37, 'Medina', 'Alexis', '6300007', '2013-02-28', '0982400007', 1, 1, 'San Isidro Etapa 2', 'Fram', NULL, 'O+', NULL, NULL),
(38, 'Burgos', 'Iván', '6300008', '2014-10-05', '0983400008', 1, 1, 'Santa María Sector 3', 'Cambyretá', NULL, 'B+', NULL, NULL),
(39, 'Arias', 'Esteban', '6300009', '2015-06-14', '0984400009', 1, 1, 'Chaipé Alto', 'Encarnación', NULL, 'A+', 'A la papa', 'A la lactosa'),
(40, 'Leguizamón', 'Tobías', '6300010', '2013-12-19', '0985400010', 1, 1, 'Ruta 14', 'Capitán Miranda', NULL, 'O+', NULL, NULL),
(41, 'Torres', 'Liz', '6400001', '2013-04-18', '0971400001', 2, 1, 'Barrio Itacuá', 'Encarnación', NULL, 'O+', NULL, NULL),
(42, 'Cardozo', 'Fatima', '6400002', '2014-09-11', '0972400002', 2, 1, 'Piri-puy', 'Obligado', NULL, 'A+', NULL, NULL),
(43, 'Ocampos', 'Andrea', '6400003', '2015-02-22', '0973400003', 2, 1, 'Barrio San Antonio', 'Encarnación', NULL, 'B-', NULL, NULL),
(44, 'Godoy', 'Luz', '6400004', '2013-07-30', '0974400004', 2, 1, 'Centro Comercial', 'Encarnación', NULL, 'O-', NULL, NULL),
(45, 'Samaniego', 'Dahiana', '6400005', '2014-05-05', '0975400005', 2, 1, 'Barrio San Jorge', 'Trinidad', NULL, 'AB+', NULL, NULL),
(46, 'Brítez', 'Blanca', '6400006', '2015-11-20', '0971500006', 2, 1, 'San Pedro Etapa 4', 'Encarnación', NULL, 'A-', NULL, NULL),
(47, 'Fleitas', 'Milagros', '6400007', '2013-10-15', '0972500007', 2, 1, 'Quiteria Sector B', 'Carmen del P.', NULL, 'O+', NULL, NULL),
(48, 'Acosta', 'Natalia', '6400008', '2014-01-25', '0973500008', 2, 1, 'San Roque Calle 2', 'Encarnación', NULL, 'B+', NULL, NULL),
(49, 'Irala', 'Araceli', '6400009', '2015-08-08', '0974500009', 2, 1, 'Curupayty e/ Artigas', 'Encarnación', NULL, 'A+', NULL, NULL),
(50, 'Gauto', 'Camila', '6400010', '2013-06-30', '0975500010', 2, 1, 'Mboi Ka\'e Calle 5', 'Edelira', NULL, 'O+', NULL, NULL),
(51, 'Salinas', 'Jorge', '5500001', '2011-05-15', '0981500001', 1, 1, 'Costanera San Jose', 'Encarnación', NULL, 'O+', NULL, NULL),
(52, 'Recalde', 'Matías', '5500002', '2012-10-12', '0982500002', 1, 1, 'Barrio Los Olivos', 'Encarnación', NULL, 'A+', NULL, NULL),
(53, 'Meza', 'Nelson', '5500003', '2011-03-22', '0983500003', 1, 1, 'Barrio Jardín', 'Fram', NULL, 'B+', NULL, NULL),
(54, 'Britos', 'Gustavo', '5500004', '2012-07-04', '0984500004', 1, 1, 'Ruta 1 Km 3', 'Encarnación', NULL, 'O-', NULL, NULL),
(55, 'Arzamendia', 'Rogelio', '5500005', '2011-11-30', '0985500005', 1, 1, 'Barrio San Blas', 'Pirapó', NULL, 'AB+', NULL, NULL),
(56, 'Peralta', 'César', '5500006', '2012-02-18', '0981600006', 1, 1, 'Cerca de terminal', 'Encarnación', NULL, 'A-', NULL, NULL),
(57, 'Velázquez', 'Pedro', '5500007', '2011-08-25', '0982600007', 1, 1, 'Santa María Sector A', 'Encarnación', NULL, 'O+', NULL, NULL),
(58, 'Barrios', 'Víctor', '5500008', '2012-12-01', '0983600008', 1, 1, 'Pacu Cua Calle 4', 'Cambyretá', NULL, 'B+', NULL, NULL),
(59, 'Cáceres', 'Ramón', '5500009', '2011-01-10', '0984600009', 1, 1, 'Barrio Fátima', 'Encarnación', NULL, 'A+', NULL, NULL),
(60, 'Delgado', 'Néstor', '5500010', '2012-09-14', '0985600010', 1, 1, 'Bernardino Caballero', 'Encarnación', NULL, 'O+', NULL, NULL),
(61, 'Franco', 'Gabriela', '5600001', '2011-06-20', '0971600001', 2, 1, 'Itá Paso Sector 1', 'Encarnación', NULL, 'O+', NULL, NULL),
(62, 'Díaz', 'Leticia', '5600002', '2012-11-15', '0972600002', 2, 1, 'Costanera República', 'Encarnación', NULL, 'A+', NULL, NULL),
(63, 'Leiva', 'Mariana', '5600003', '2011-04-05', '0973600003', 2, 1, 'Barrio Inmaculada', 'Hohenau', NULL, 'B-', NULL, NULL),
(64, 'Vázquez', 'Silvia', '5600004', '2012-08-28', '0974600004', 2, 1, 'Calle Independencia', 'Encarnación', NULL, 'O-', NULL, NULL),
(65, 'Insfrán', 'Romina', '5600005', '2011-12-12', '0975600005', 2, 1, 'Barrio San Juan', 'Nueva Alborada', NULL, 'AB+', NULL, NULL),
(66, 'Bobadilla', 'Karen', '5600006', '2012-03-30', '0971700006', 2, 1, 'Ruta 14 Km 4', 'Encarnación', NULL, 'A-', NULL, NULL),
(67, 'Benegas', 'Yessica', '5600007', '2011-10-02', '0972700007', 2, 1, 'Barrio Chaipé', 'Encarnación', NULL, 'O+', NULL, NULL),
(68, 'Noguera', 'Mirta', '5600008', '2012-01-20', '0973700008', 2, 1, 'Barrio María Auxiliadora', 'Natalio', NULL, 'B+', NULL, NULL),
(69, 'Alcaraz', 'Lourdes', '5600009', '2011-09-08', '0974700009', 2, 1, 'General Artigas', 'Encarnación', NULL, 'A+', NULL, NULL),
(70, 'Ovelar', 'Zunilda', '5600010', '2012-05-25', '0975700010', 2, 1, 'San Pedro Calle 8', 'Encarnación', NULL, 'O+', NULL, NULL),
(71, 'Toledo', 'Osvaldo', '5100001', '2009-04-12', '0981700001', 1, 1, 'Calle Mariscal López', 'Encarnación', NULL, 'O+', NULL, NULL),
(72, 'Chamorro', 'Diego', '5100002', '2010-09-22', '0982700002', 1, 1, 'Barrio Ita Ybate', 'Encarnación', NULL, 'A+', NULL, NULL),
(73, 'Morínigo', 'Ricardo', '5100003', '2009-01-15', '0983700003', 1, 1, 'Ruta 1 Km 10', 'Carmen del P.', NULL, 'B+', NULL, NULL),
(74, 'Centurión', 'Javier', '5100004', '2010-06-30', '0984700004', 1, 1, 'Barrio San Roque', 'Encarnación', NULL, 'O-', NULL, NULL),
(75, 'Portillo', 'Marcos', '5100005', '2009-12-05', '0985700005', 1, 1, 'Barrio Santa Rosa', 'Bella Vista', NULL, 'AB+', NULL, NULL),
(76, 'Dávalos', 'Enrique', '5100006', '2010-02-14', '0981800006', 1, 1, 'Barrio San Carlos', 'Encarnación', NULL, 'A-', NULL, NULL),
(77, 'Báez', 'Lorenzo', '5100007', '2009-08-20', '0982800007', 1, 1, 'Avenida Caballero', 'Posadas', NULL, 'O+', NULL, NULL),
(78, 'Espinoza', 'Julio', '5100008', '2010-10-10', '0983800008', 1, 1, 'Barrio Próceres', 'Encarnación', NULL, 'B+', NULL, NULL),
(79, 'Vega', 'Fabian', '5100009', '2009-03-05', '0984800009', 1, 1, 'Calle Constitución', 'Encarnación', NULL, 'A+', NULL, NULL),
(80, 'Valenzuela', 'Omar', '5100010', '2010-12-25', '0985800010', 1, 1, 'Barrio Arrabal', 'Cambyretá', NULL, 'O+', NULL, NULL),
(81, 'Bogado', 'Evelyn', '5200001', '2009-05-18', '0971800001', 2, 1, 'Barrio Los Olivos', 'Encarnación', NULL, 'O+', NULL, NULL),
(82, 'Garcete', 'Noelia', '5200002', '2010-10-11', '0972800002', 2, 1, 'Ruta 6 Km 5', 'Fram', NULL, 'A+', NULL, NULL),
(83, 'Echeverría', 'Sonia', '5200003', '2009-02-28', '0973800003', 2, 1, 'Barrio San Jorge', 'Encarnación', NULL, 'B-', NULL, NULL),
(84, 'Maldonado', 'Tania', '5200004', '2010-08-15', '0974800004', 2, 1, 'Calle Villarrica', 'Encarnación', NULL, 'O-', NULL, NULL),
(85, 'Benega', 'Cynthia', '5200005', '2009-11-22', '0975800005', 2, 1, 'Barrio Las Delicias', 'Encarnación', NULL, 'AB+', NULL, NULL),
(86, 'Escobar', 'Graciela', '5200006', '2010-04-10', '0971900006', 2, 1, 'Barrio Pacu Cua', 'Cambyretá', NULL, 'A-', NULL, NULL),
(87, 'Cantero', 'Viviana', '5200007', '2009-10-05', '0972900007', 2, 1, 'Costanera Sur', 'Encarnación', NULL, 'O+', NULL, NULL),
(88, 'Zárate', 'Marisol', '5200008', '2010-01-12', '0973900008', 2, 1, 'Barrio Fátima', 'Encarnación', NULL, 'B+', NULL, NULL),
(89, 'Arrúa', 'Gladys', '5200009', '2009-09-20', '0974900009', 2, 1, 'Cerca de Mercado', 'Encarnación', NULL, 'A+', NULL, NULL),
(90, 'Villar', 'Mirian', '5200010', '2010-07-07', '0975900010', 2, 1, 'Barrio Ka\'aguy Rory', 'Encarnación', NULL, 'O+', NULL, NULL),
(91, 'Vera', 'Roque', '4600001', '2006-03-12', '0981900001', 1, 1, 'Barrio Ciudad Nueva', 'Encarnación', NULL, 'O+', NULL, NULL),
(92, 'Mendoza', 'Miguel', '4600002', '2007-09-25', '0982900002', 1, 1, 'Avenida Irrazabal', 'Encarnación', NULL, 'A+', NULL, NULL),
(93, 'Amarilla', 'Arnaldo', '4600003', '2008-01-30', '0983900003', 1, 1, 'Barrio Obrero', 'Capitán Miranda', NULL, 'B+', NULL, NULL),
(94, 'Godoy', 'Feliciano', '4600004', '2006-11-15', '0984900004', 1, 1, 'Ruta 1 Km 2', 'Encarnación', NULL, 'O-', NULL, NULL),
(95, 'Lugo', 'Marcial', '4600005', '2007-04-22', '0985900005', 1, 1, 'Barrio Santa Cruz', 'Paso de Patria', NULL, 'AB+', NULL, NULL),
(96, 'Ortellado', 'Rubén', '4600006', '2008-07-10', '0981000006', 1, 1, 'Barrio San Juan', 'Encarnación', NULL, 'A-', NULL, NULL),
(97, 'Duarte', 'Luis', '4600007', '2006-02-28', '0982000007', 1, 1, 'Calle Curupayty', 'Posadas', NULL, 'O+', NULL, NULL),
(98, 'Galeano', 'Hernán', '4600008', '2007-10-05', '0983000008', 1, 1, 'Barrio Kennedy', 'Encarnación', NULL, 'B+', NULL, NULL),
(99, 'Osorio', 'Gustavo', '4600009', '2008-06-14', '0984000009', 1, 1, 'Calle Lomas Valentinas', 'Encarnación', NULL, 'A+', NULL, NULL),
(100, 'Nuñez', 'Alcides', '4600010', '2006-12-19', '0985000010', 1, 1, 'Barrio Santa María', 'Fram', NULL, 'O+', NULL, NULL),
(101, 'Avalos', 'Liz', '4700001', '2006-04-18', '0971000001', 2, 1, 'Barrio Mboi Ka\'e', 'Encarnación', NULL, 'O+', NULL, NULL),
(102, 'Britos', 'Alicia', '4700002', '2007-09-11', '0972000002', 2, 1, 'Barrio Chaipé', 'Cambyretá', NULL, 'A+', NULL, NULL),
(103, 'Melgarejo', 'Beatriz', '4700003', '2008-02-22', '0973000003', 2, 1, 'Barrio San Pedro', 'Encarnación', NULL, 'B-', NULL, NULL),
(104, 'Corvalán', 'Norma', '4700004', '2006-07-30', '0974000004', 2, 1, 'Barrio Buena Vista', 'Encarnación', NULL, 'O-', NULL, NULL),
(105, 'Sanabria', 'Luz', '4700005', '2007-05-05', '0975000005', 2, 1, 'Barrio Itacuá', 'Nueva Alborada', NULL, 'AB+', NULL, NULL),
(106, 'Bogarín', 'Marta', '4700006', '2008-11-20', '0971010006', 2, 1, 'Ruta 6 Km 2', 'Encarnación', NULL, 'A-', NULL, NULL),
(107, 'Montiel', 'Claudia', '4700007', '2006-10-15', '0972010007', 2, 1, 'Barrio San Carlos', 'Encarnación', NULL, 'O+', NULL, NULL),
(108, 'Caballero', 'Estela', '4700008', '2007-01-25', '0973010008', 2, 1, 'Calle Antequera', 'Carmen del P.', NULL, 'B+', NULL, NULL),
(109, 'Valiente', 'Elena', '4700009', '2008-08-08', '0974010009', 2, 1, 'Barrio San Antonio', 'Encarnación', NULL, 'A+', NULL, NULL),
(110, 'Ledesma', 'Rosa', '4700010', '2006-06-30', '0975010010', 2, 1, 'Barrio Inmaculada', 'Encarnación', NULL, 'O+', NULL, NULL),
(112, 'Trussi Aquino', 'Fatima', '63000009', '2020-12-12', '0984111222', 1, 1, 'Av. Principal 123', 'Asunbache', NULL, 'A+', 'A la papa', 'A la lactosa');
INSERT INTO `Jugadores` (`id_jugador`, `apellido`, `nombre`, `CI`, `fecha_nac`, `nro_contacto`, `genero`, `activo`, `direccion`, `lugar_nac`, `foto`, `tipo_sangre`, `alergias`, `enfermedades_base`) VALUES
(113, 'González', 'Roberto', '12345221', '2011-04-12', '0984111234', 1, 1, 'Calle 5 de Mayo 45', 'Encarnación', 0x89504e470d0a1a0a0000000d49484452000000d6000000eb08020000009a65ff0a00001000494441547801ecfd579b2447b225088aa89a99b3e034232239cf04e7bc80e2008a5c7efbce743f2c7d98d77999d9bf30bf60e7ebf7d9e96f777a2ea9aebaac2880a228709a9c0567cedd88aaca1e358f888ce424321389aad23cae2eca45458f89aa9a67028abe9481bf945aff49e9ab59e04b4a41b9da5c88fef099f90738c32f2905e9eae11accbc7ae52f65ee3d9de1bde1fbfd43c17b33dfbbc4bb2fb5f2d7b4c9bde1fbfd43c17b33df6b9afbd2825ba5d47da5fca553b9ef53f70f05bf78536de2dd3da0d4a6d16e7dea5b6a7cebc3ddd516a0e01fd2746e60abeb17df03de6d52604ba3dda8f197694d41c18de97c99f4deb496f7adf805da73634def5be35c540c14ec2660af2f93de5da5efeff80fcf9e20c9ed9afcda4d3728f88767afdb35d69fda5dd3025b20c9b59b6e50f09ac3fea9e08fd402d7f65b77d620778382ebbaaf7f6fd2f82a599b4aefbef8458f7ff76778e746b8b6dfda3cc6d62d7a3728b8aefbfaf7268daf92b5a9f4ee8b5ff4f8777f869b46b893e23599b6758bde0d0adec9a9df2f7d5d73093614bc718d8daa774fb86b4a6c9d69d79cf49f28784dd35c5270e325b8718d4b3abc3b89fb42895b9cda9f28788b06bb0bd5e1ba6e12eb83af55676226ba0cb411ba051bc91b0aa87fc33a77a1c2979882cc6b366366a514e2bb609f5bee123a6de092c61bb9970a97a6e88649f255b06a8a89bbf009a28058e7654c44f8008a08593ec54404131172182205415ee045a479ad3e9317e85e072875af87dcca78cc0c537601b9db95e4a12b7fb1717711bb3134e90a882113f6c8cdf059e433bbc275e38d76a8c5c479bc1ee57da0822571b94c8a94264f3ee43a0a54c0c480736e6338632cda93cfa74b021301744fc39786826118c230201b4cd98d2120a70be4005d39088242a1d095af1ec3ca3789abb7bf5eee553b86952f871003be27ff0db10b47bc0e72b406615a038160a249549e21eb151c1347a104da574366b7253a77be3b450ca00a092956cc8c1226ffc544be2b74842cc45d40be87507766acbbdf0b88b531c806db98596b8d2210140292a8638c499204c2d5c157cfbe7aee2d55262cf11a695c2e7717f45af1c6889b2b6c6412ad8fbdfe4d3e302aa36f21e922cff3917556bc1f44610e22cd1c6a2d5e235f81093dfa4829ad197e9299004260a26ebf748b010d6fb1c555aa7f6928d8e974baea836a70725d148b456b2d3867ad554a818bcc77c42cdda16e27f67e088ee55ad8f0671b02f9161b29086b0cf283632ec8c841b94c9e50f99eeb29482417b9631d59d14a47411829adf1105871300bab62a1582e5782201222e744902fe80e965aeb736d28ff756b1fb9b5ea57affdc55110d3bfba4a17732fab02f20d0e0e8ee5617c7c7c6464a4b7b7b7542a8561e89ccbf220222022322ff67299744b66bba5ca18081a0310b68a2b064606806ee1af360f81cc0d1059675393a5f08801a992d695a83cd257191b280ff715facb51a5181442501eddaca34b447099c0ca35d03d0d5f1c0561b86bcd1426cee18d950bde348a47c646c727b6f50f0e947b2a7d03fd40b9523978f0e0fefdfb77edda05764651842ee114375ca66f88accb80a16f129735bc61f2aaddc221adc3f347bce7ba28905f7ed914af0fe2f39860838bf0b57cb6af02c360f1b0a106448821834d84af1215c7cafdbbc7c60eef9a7a789fded64bc305190cf560b132d6df3f3e54eeaf08a1176f1bce7bf20908480010ee2da0f2bd1df086a35dc30aa3a3a3707ffdfdfdf085f0798c830ebc5f14d6eb75e46cdfbefd91471e79f4d14777efde8d3dfae2206bd6bd9881ee6f09175b5e4b42779b8b30e2a540f975e09b768bbd74c907d997a4c99386f2b051046e1b26ab48f7e9e24465f8c8c4e4a3fb871ed8c93bfa962bd969b7d21ce25abf54cb261950c168a532315018ac7041e17a0c357d673065b763a4019f754f3f5f3005317d1008c738086b508a95225e3732f3c8e8e8e123471e7becb1a9a9a903070efceddffeedff2b0fffe3fff83ffe4fffd3fff4bffc2fffcbfffc3fffcfffe93ffda7575f7df595575ef9c637bef1ddef7ef7b5d75e43cdc9c9c9dede5e9c17414ad0157645a7d742885b8dd27a7deccdd5d0f04a701e7cfe8d960de5006684165ef06dd63e480270497e387cd6b2fd57a9588c70a863e5139b3ea805a01507145682def19e91bda3e30f4e3df4ade7f67ee591c1c7f6048747dd81213e325a786c7bef337bc7bf72b4ff89dd038fef1e7c74174d551a856c78efb6af7ef79ba5fe729785910a8b6189bdab2528890f6d0abc1e36e5dd61f1f219dee1ee6fd41d8e6ed65a7835085d60cae2df60c1c8a4830007bef1f171b8c072b98c0df7a5975e02c95e7ef9e5175f7cb14bb8279e78e2e9a79f7ee1851790f3dc73cf81a9478e1cd9b76fdfd7bffef5af7ded6b5ffdea57d104f94f3ef9e4430f3d84fc288c70600f9456ebf6c68a02d61a872394bf540a4a8b51a15c2c954b659d079507e80610f95975b5f512a12346795e51a32b80f280ca008aba4025d441dc856fc60cd26338cd5ab1da6888d69d384eb21437079484c5a85829957aca85de52ffb6c1f1fd93079f3af2c8cb4f3df8ca53bb9e7e60e0811d7acfd052255be993da10b7c6a26caa4cbbfbf5fee1e8d0583c55343b7b784f7fb077a8b07798272a4baa757cf9dcde470e6ddb3365c925364bb2a4b7d45bd005b6a49582ce5060031767ba59bf8de22d0b6acb3ddc6607588cabb674c6bf35c522557a7a403e60686808fb2fb65a70e899679e79f0c10777ecd8817c383964eedcb973efdebda01d7661500decfcfad7bffead6f7deb701ee00b714c44e5bebe3eb843f842b010f5813d7bf6ecdcb1736a726adbf8b6f1b1f14ab9522a96c2206462eb6c92269db8d3eeb46d1ef090001717e352d5918f525474d632d106ba6f4ec43900a580c1c7393c73e0967742fe5e2bfe9aea2cbb9cfa8542b95ceee9e9191d1f1d9fdc36b57bc7cefdbb77ecdb3db56fe7c4de1de3fb764453fd3cd9938e159ac3ba36a2ebe3616baa1cefec357b06ccee3eb3b3cf6eef31db4a765b49460b6624acf7496b2488c78bd944194c2d1d1a97c9ca6a2169964c69a27f7cef761d8544d4e9b402c725b050c0c0352875293dbc5b40ddeb0053bf4ee9d58b2e1de3ea75ee4aae7338c6acf58ca9e21a0b5242c002e2e50ace7d13939343c3c3fd0303db2626f6ecddfbb5af7ffdd9e79edb7fe0404f4f2f084acc4a6b780ef4038004d86d415670ebf1c71f7ffef9e7bff9cd6f82880018f995af7c05ec84b3842f046ba7b66f47e7e3dbb68d8d8f63971f1e19c140fbf6efdfbd670f8a30747fff40a5d253c665a75cc11527cc435743adb55a0f6b0bc597d81d09d8541301f85d22500c84f81031c0c48a581362a599038e4a85b05428f4947a46fa47766cdb7e70cffe470e1f7aeac1815de3951d437aac6206c2a48f933e6d86223b1a950f8ff3defeceb668754896075c632cc876f4c0e1d9edbd76a2e2468ba89ff6a824721d95b5398d7516175cab686b51daee239eec29ee1d29ec199eb6b55a94f5ec18d9fbd0c1bea10122312eab148af903e2604fca0333e7df3719dd98a45776a4aeccba3739974d124997078c5ec983d61a9938ccc1f9e19c0702c16fc15139f1f5028df5653f6366544316fc0b334751d4d3d383dbf1d1a3479f7aea296cc460218e86dffbdef7fefccffffc2fffeaaf9e7dfeb9279f7eeae1471f3970e8e0f69d3b8647477afbfb4a95b271d889ad30055158e9ed19191b9ddab17df7de3de0fdb3cf3e8baeb0c53ffcf0c370b7870e1d82739d9a025dc1e74b3135f5e091230f1f3df2d8430f3ef1e8234f3dfef8334f3ef9fcb3cf3cf7cc33af7dfb9bafbff6add75efdd66baf7dfbf5d75e7dfdf5d78057bff7daa32f3db5ffe907460f6e5723a546219d4e978fd5cf7fb87c722ea8cf85ad855267b9375d1d04d5b83d11b4a6c2744f25dbd7478706f5e111757058f6f49bc952321cae84712d489a3a05f30c1b47d84c601ef1c40fd86a6973b242ad5a294b46423b59291d1c6ff4d1acad758a32be677274db38b8566fd761ff2e60550032ac8af8eee10ba320a684b9c1a1609e5d024120e6ed3b778e8e8d158a45560a6e68c7ce9d8f3ef6d88b2fbdd4cdccf01eda5a5413c24b5ac94c06a6c24915f210e0e777adbb7da27f0032f83c3232b263c70ebcbe79e08107fefa6ffff62ffffaafbffbfdef7febd557bff2ca2bcfe0f8f8c4138fe0aeb363c7c4d4d4d8b66d83c3c395dedeb05020a58c730b0b0b8b8b8b4b4b4b2b79a856abb53c605b074a79c010e03d50e9ed49d976c8346d524bdb2b9dc662ab3a5b5b9ea92d7d74faf30f4e7dfee1e9631f9d390e7c7cf604f0d1b9e3675bf367e38569bbb212c5cd3ecac6223755b6db2b9d8942b6b3cc0706c3a363c58727c207c7f9c8301f1a6a8caa3630ac5a03d4c6265bb6ada26947265389e5cc4a6a25cb9c81658cc95c6628c92833e22c0c6603d729b84e2f67c35171cfb09ae86d07c97467392bf2d4be9d93dba70437230f58ce43f2008919fcc4f75dc11749c1cb26542e97e1bd401778befefe7e381bf8305c3ee0cf2ae58af6fbae86f30b831032dac23e909d731090dc0c6676ce79bf480482821cc3c3c3131313db77ec3874e4f091078e3ef2d8a34f3ffbcc4b2f7fe59bdffed677bef7ddeffdd9f7ffefffcfff07f07ff9bffd5fffbbfff8df7fffcfffec95af7df589a79e7cf0e18776e22cb90ebcf1d9003a04060606a02afa0715f114e852212d07ed8a6e9655a344ab915d0eb20595cc73dcee8f3ac0401e0f16e21c9dc1c84e9669676f7460a4e7a1a9a1c7770d3db9a7fff15dbd8fed283cb42d7860948e0c6507fa5a7b4af59dd1ca76bd3ace3255722361da2b71d1c4616a42cb450e4b01459a42455a9162980236b1ce8ab1da2a153b4f446487da16b4a9046eb0d0ae70343550dabbad30ded7e4ace1e2ca701f8e22c5620916430f5da09fae70f762b5b5ae31addbef60f3f4b07efd786f3a3ede6ab5d224e9efeb7be2f1c7ffecfbdf7ff5dbdfdeb963478aac248ee38eb5780b46c664ad56334b530ccf38f33b642459965867ac603f5d8f41439cf7a12028a954108645ff839e81a3eceded999c9c3872e4f0d34f3ff5d5575efef6b740c56f7ee7f5d7b159e3a5cfdffddddffded7ff80f7ffd377ff3577ff557fff13ffe472421ffd99ffff9ebafbffead6f7d0b17ed57befad56f7ceb9b5ffdfad7702b7fe185e79f7ef6e9c79e7ee281271f3df8e443f1806e8d06ad6d617baa98ede971fbfad5a1a1e0f088ddd36bf6f6dabd7d765f9fdbdb0701451078ff903e385c383a5ef2d8161e180623dd54b97260bcb0db5f60d3a120ee55492f9b3e2dfd518bb3548b2b682e05aa1088a6344b6119cc12fe8b950f0142140651144685dedede421062cb2027c42c2c56491a8a1a2cd248a9b26faceff0643a129e4d96e65cbd3031a0ca85a050d06842b97589731342f623dc8d8fda5aa772c3e60acb4f6bb351c41b53098280994112c478e7828b2aae05699a8e8d8cbef0dcf37ffbd77ff3faabaf1ddc7fa0522a074a17a302502a14219348a8839e720539244e2bd19ad05910322b21768461b4d281d670978126852cbf04d88a8030d451a88042a80aa12e06bae011f496cb7d95ca505fdfb6d1d13dbb773df8c0519c3e5f7cf1c5af7dfd6b5fffe63740b86fbdfa6d1cdff0d2f1bbdf87d7fcde2b086965c500001000494441545fffeab75efbf6abafbffa677ff167dfff8b3ffbdedffcf94bdfff5661efc89eaf3fc20f0c9a8706d247fbe3877bb2477bdb87a2f468991e1f92c786dc6343f65194f699077b90698ef69a4338d80dc9fec17467a539acea7dd2e9576620aa518ccb44c68e3117c58a982db12106830cdb546c22922189492b1645c23033e8025871c639232e255bcf3a094c14851ae63084ed9a5214daa68b931e8e87c364b2c80787a387b6757696cf717dcfa30fecd8bbbfa77f9048036150d4f871590866248511084131055a4123c85b87da7a17d7ef01ae0e368cc28889f3a30634673431c6a008420f9ed3bebe42a958eea98c8e8f7ded6b5f7bfeb9e71e7ce081ed5353f08581d6a82dce21be2ad04317b0d2a540f56e8917509427f285224216b401a81b7cb1524ac36de03cd0dfd7ef8f04c3782846262726b74f6ddfb56b37eeda070f1cc081f208c2d1c30f3df2d0430f3ff4b0c7c3901f78e421dc410e3cf16061fb40b0b38f77f5d2ae5ed90df4d0ce0aefeab1db4b403655309340d14c14cc4464b715eac5ac5130cd82694516e884360e5caa9dd10e6473b86b91570eaafae74ba03913260140bc88ee347c2c441eebb560b8bc136f7df4a09d28f1e5a25c1abaac87d381201b89d2f1623c5ec8468b4bb6e54ac1c8c4d8c8b631746770a034063621df0a198431213ae714dd9970a7fab981360e24ca27a1b42666620254a087c746b74d4e947b2a61146ddfb9e3f9175e78f5d557e17bb0cae3e3e36118521eba64cdc54b22412fa485b4631f430098f094021826f70da80490afaa24f7194eb3d32400a69f23f73284167efdbc72810a021d44c19a02a8146a6c50854a05578edefedefe9e4a4f5f6f2f8027680395be9ea0a7c03d21f744eb28a8de22645b54802b2813b12d70169147200ea3d15d0ca02238074020729e89049f09c191128a94aa446aa8148cf7855303851d83b8dc2491e11e3d30da3f3a3ca8c96a722e4b097aae43a0afa02758d06723b515c0b65b697ee3b685a8609dcd8c41550dfe1198e820ab20181b1f8787e91de80f0ad1e0c8f0a38f3ffeda775edf7f603fde77e04d32ea6c8019b3df485d228837a4e71f11e6827a1e8a980520260f22d82b0761784582e5e89678c11b93384db3cc5f23adb5785ebcbf5694b7c5238f2720075407f034a106dcb326a55869ce63ed83d23a7159ec91c69226625231c8e922b6299098a463923803e2244b7038a3bb16fc24c5cf16d30690cc639c0a85c809c3d15a13385b52341005db7ac3edfdc1f6de46399b4f573b2a1d9918deb97daaa00393a5dadb95481307ccec35460478696b1fb5b5e6376ecdbca6a7527e2cac30dae8301cdb365eeeed310e37083b363efed4334f3fffe20b0f3ff248a95c86f3c38ac3d5a33204d4efb68570057ce7f8b08061f0841e4a58394f4c6c621e39e38884d8f95810f91684a5f11ccb65a2005e4fab50ab0083b1a72f5c06c084c41a204201241463213464f00ed5c320d880ef1e058ccf25f0ad60016674c2ec63081e97d4bae309a8833e8560203c3d24983cd278f29442648d49631b77f00016c50e84345e0af70ee232d4ecb1abdc92320f6f1b1e1b1f6134b34296001162ad04bd20338fb718a92db6bf61f33889510773088200ac821c46d1d8d818de6860f19224e9ebefc3eb8faf7fe31b0f3cf860b9522e140aa020335aa02ed6c80b5d22faf4151fd80240250f81a9c55bdb57131ff186d5613af265be9e2f210830621e238d2501f24c34dc0c14a2dbcd25f091622cfc3aaedf06ef7e4c06ff9999d48305f40514e7dbdd1a89f34cc80a8f0729454a9352584946b5750dfc3877ebe3e70353ac0f0551336b8c66333189b549a6ac0d25abb0c53bd903237d8727dc4861595a758a2ba37dbbf6eed4011ac15e440656444778a0e1ff03f4b145a82db6bf7e73af299122185b5b63b4d678f332313181988971843a74f0e0cb5f79f995975f3e7cf8707f5f3f48891358b74fc8a8df95e10ebbc265b1e78277744e081ece11cc42b0762ef87c9cb4d68007d89138227f3657e272ac9df7d9093be30ce09c153104e079f770841ce48268d6a28a3506ca98cccf05538086d87cb5d28a150204b6a4ac62cb64483986466c70f467491d6502b0210045ca3270d98cee7492d1a110035e1766c4c86181175701d685712c21c2e38969924d386b57c46c2b16f60d17f78fc6c3e1a2ee34435b1ae99fd83ed95329323a12122b44ec00a584fc10b485a0b6d0f6a69a3271a0b55f44e74ac5227ecf1a1b1d434e12c7a3c323b8fc7e13feefe803c5420175221d39cf934b7a86efc4aa5f92b591606f3cd884bab601ffd605816119698ff5ea282361b0d0c7a8d0cdef0a224e04633bc7248a69035a312b500d50d8ac43bfe5465104ad084360fc75088213ed2b059a513580eca1bdc0c28a7c57be373c92ac0315a04f462f771718818959bc8d08bc915c86329a55c02a543a50ac316b71f839252b482348e33ea5b7f7f3cec17a1fcf517bc134c7f6ed18da365a2c869a08a461af335bebfcf7d63ee86d6b1dacb7c63ecb9c2bb69ed3fd2e168bc61a148c8f8eedd9bd072cd44a0d0d0ebdf6eaab7ffb377ff3ddd7bf73e4e0a1be1e3c60e54885a8a66020ace52630731445dddeae16c3b824dd02b485c04cac8cb3066ecb3a6b1d9e708177c3b30ba067d02787b13e385f07c5be1327d867241349c9c3c03f08188e363e46aa0ba4b5c25a10da43c6dc0b617e7e5058d220458f4c2a0c8cb8145a9064ce12ce4f0a8a796d2d81ebd008f59c273ebab802748d7045c5b58cab571762f220f1df780a84bdf742769a79dd59582b1528ad08050e96322ec50525ab2819efa91c9e1c7ee24074705b7340cfa5f5915d93871f3832343000ba06a4a3202221a514e5416b6f905ca4300cbbc2cdc46bed6fa6eaf5eb742db151070a01ccdc893b4234383884376d85282a97caf8b5e3e1871e7ae5e557f0fbc79eddbb878786cac59226862a0066b5d1c9cd0806b76d0bce3826467d26ec2c5ed02a8002f8842a08958ed82364d849c1e2c8010ada172189caa011ce00810e03f8050e980222ed7c9fec23383c5a0fbc2eac7f63820052888505700c6f2a2e973d7973017da00880b0862bba422777162cdefbe5e320f210569e88a01cb1e3b57201adfcc0a2040d9cd19214a9dda73a239199acc8f6fea5305eb00dee89761ed83d363aeac81893867e7f73be1d91730e7464c61084970bddcc9b89fda2df4cbd1bd6c133b55107aa8091d0098fb8d6c1b6f16d93939378a31684e1b66ddb9e7eea69fc14f6e8238fecd9b5bbbfb74f338ee47e95bd2a02536c74736381513d73a153015e943af68737233e76cc0e06ee42d892cf34041747d83b3c504dc83870632dc73121e54061560490ef1c0dbd6a5768e2edbc29334f0a91a7173bc1781bc393a02322e7d1cdecca798c2137f572e745e8e521b4a605cc85f9113bc65994f3232b1be561d92789585b099d108b0924eb09cc4851b6f7e9bd436ad7e072144fa72ba6acc6f74c8e8c8e10396b33f48fe5668621052b8e75a75b0cea16eb5faf3af48007863b811e5d6d9073f0f0a1a99d3bf01a372c44d01bbf28bcf0e20b2fbdf4126ec4d8a3415c3c4dce5acc042091eb0d7045190b15f1039bc2368d17a8044ae16114678dc95231782d17530624f81d95524789a354d858498dcfc912944a16338ee13616133b5c0eb3d418e7b00484978d2a17a053179e8d8cd5f4802ec8440c40007c29a108a2103bf224936e75c4001128ea73207741a8880fbab88bc018028660f4f541b0e8b01c54e4fcb923c45800c4a8c0ce790be1e64526d5d694d90d17685b39dc3da876f6af96b2d3ad8546908deddf3eb16707473092671e1a6a6c30f8ca8175cfbf6f2a8236ebf53c05d6e5dbfd16116b2d6274800b2f2ebffe978f42542c9777ecdaf5cc73cfbdf4f2cb878e1c29f7f4f4f5f5e1fd0bf406c05ad407ff9cf56ec7cb37fb61c2594472f3e29c47440167da35296e05a6a9b3ba4a6b3aa907493d8c6b515c8fe29a8e1b4156d7594da7752f989a9733546eaab44de0a515e5149312ef31e86aa13b204abac2e6185604c02bbfc8282082407980802245be672f5397b4748dc0b7987f95eac2e25884e1d61c6cc4201b521ea8ecfb975c3b8108e435b076001868b3c4984e2649169aa42cf1a02a1f1eef7d78476b2c38635616a8158df7ed3cb2afd053425f688275ece9e9810fea2611df246090f59ab22edcee37f430c620460738f9eddcb973ff810338f5967a2a7b0fecffca2b2f7ff3dbdf7aec89c77bfbfb9aad66773454def4c4305f7f51d0ef95300eebed9d1f36d4808ce63a257369ed5473ee443c7b3c9d3d96cd7c9e4e7f0624d39fc5d39fc7339fc533883f4f663f8b3d8ec573c7db73275bf3675b8b0b690df4cd08d707218d87c20a961083324135e8ec0119ab95c3672209d05a10bfa82098120620b07817841a6b82af8089ae55432b1421be127265569e73adfcbcf0d208551dc3ade5a4c3f82238ea012cf9634050dfc31b10550122a7d969f20f9f38c221db268e53b030182bdbb1a2de35503e344153bd2b85b45972c5b1fe479e781ca72c224ad3b4d96cc20141be256ca2e02db5bb76653c07e3e3e3e01f5ce0d0f0d0030f3d08e7f78d6f7feb2b5f7d65ffa183a54ad9c1204a596793d4ff280616ae75867cbf366ba99bfa6232601f3bab25095caca54af1b9cee247cb677ef4d19b3ff8e88d7ffae417fff0c92ffefed39f03ffa78f917ce31f3e79e31f3e7d03f1df23fef48d7ffcf8173ff8f88d1f7ef4e62f8ebff3c1ccf1f3cd853ab553c24f8ac6b00105b14a427e992e53e9ca4cb0cd315ef669eb63e565c596d90bac1ca9ae601875bcec697a59a77738e949e79467216680c506ff002de2018504a4f4470e6ca88160a2e4226523c5810a340724218b66a742a7fa8256c1d4ca56ed1c1878606765ffb66420acabb4dcdfb37bf7ee1d3b76741577188ab92bdf640cad6eb2e60daa31fb819919af9d413eb010f70f3c135fffdad7bef1f5afbff4e28bfbf7ef0fb4ae556b383b944b65ad741886f0de68d2ed1aa4f4138021a49b41f8ee622dbde90b830124a2b5525a11ae665aa744abd439d35ef868f5d48f3efec57ffb0478e3bf7d02bcf9c38fdffae127393efee50f3ffe25d8f9838f7ff14314a11af8f7f19b3ffaf8cd9f1effdd3b739f9faecfae98464656c891f30c24218cc5dd98f29c3c83895900efd0a09ab08ff0e942f22ff1857c598c1254ce332192801d37075ffb763e976ae67b581b13051b801ec825a5190723dc1cb13e3ad44aeb40e30553a3dd48e037fa423318d86d45dad9934e14567bb2374fbedb2eb91d0fecdb79704f5008950f9a68ad5726ee623d87ae0c7780824c04800d438383070f1e04f9b01da7697ae4e8d1ffe17ff81fbefeca578f1c38d85b2a87ac7a4b95e181c142188185a88f5650185eb00b85c90678f0fc6ab0c020847572ec6398069501ca831790958359e18e4189280a62b2e756e7de3dffc96fa6df3fa3e6cfa885b3b4749e56a75d1d98b175e082ad5db0d569579d96950bb2344dcb17d4ca39b572d22dbe5f3bf5cee2f1d3edf94e00fea99082822a7a0f866dcbc15b081849e239a5c043e41087a421732e4311521230296b943301396647d8ced09c71ebc7621066a390ef214440fec17cae80905c1d5d635d11d3d50393cde1709e601cb43d442cad03f20630a2e04da67199ff3924e4000010004944415413832562eb540a64843b9a7f24595c44b657a523caec2c840f0ef43e3355797afb2766e6a3d5d3bd3b470e3df240a158b2d6af0591660fc5d4051366ef4197855ba760b7abcbba21eaebedebede98563831784c37becb1c770f9ddb3674f3ff22b3dc5a880d76f688a691abc354ae1b0aee8e21a1968056c2ef44bb796867dbd248a53916a06fad46693d5d9acda2c6400f68e4e683ba18b038943d709a5ed63d78990693aa1694759dbc7a61966f5205996e6b269ac264d6cc4047b818ab411302c5881a457070f89ff424a500f5fd4fd02c958a4cb33f2045b6bd2ad8c2264a20e62ea7ed61392276f26ee7685e6370754efc26be3985c5739263ce197c3f7c8bc969b1f1548112b42ec35132b26a5ac13642dd8ad6c9abd2e9d28aa3d83ed7e75a1bd146bbbebe0dea1911197f7831644ccf878e09bae1ad0fb55f36f39736c6cac5028a0d9c0c0c0c30f3ffcf2cb2f3ff9e4937bf7eec5765c2a5dfce708b21e50f32a809eebf0df02b7422c049964ad3aecd3b523045f200e0f9b09a921c97473f9f4caecf9dae27c73355562d132278025c8fe8661c95a3828e52ce3cc42be07df0509fa56943ad3485a8b8dd585fa4a8dda315c017ac0d89bb1be7ed0c1b74243407c2fbeae50de17b2ee2230c81deafd6a3de5d4f4b383d01d06b5ba7042c6b9cc8089ccac834095421ee929ed192fed18492aba1dd8c240657872b4a7bf67dd10be257a62ca8dddedf0d2585d9abcfd94520ade2d4912101187d343870e4d4d4d85f8f50105eae228484551843a571d09fa76f3bb029a29f114dc5857c967b616e73373cc0e17619c026deb7c63e1e4caf4746369356919c5c439f20e1c61f313abc4281fc313e426016d080240a1b29a9aa6b3d05899afafac741a1d31164771a6bc2d6150621fa3f2e61c28cc84123f4c57a0eb04d4b84ee9bd2eba429bf50c3f474c368757aa3b792b6c053bb2dfa459e920e442647a223dd637b46f6a78f74416c8cccabc11b367ff1e626fa4dc03a0f1067c67977db0ca97e5dc66b2d56ae1fce71c0626ad7580535dde13f3fab4f264370211bbc29531c80120df37dbd01c02f9e5c752e7a2972100a419bf7ab4c92d24d533f5d9b38db9c5b49e68872310a1b687fff68737eff99cbf1e2a710cf84e682d08ee80127187cc725c9f6b2c2fc6b5161913603322ac0706da8831c36eb22b743b80b6785a806ef29a315a5eb3ec760a30eeed34bb7e1b2697634dd9fc501a0887c47e824e04400fac9dd65429d84ac8bdc5b0afe4426a769a9da4adf0fc53d73c79631cbf089d75819697e08e51b05eafe3fe0b6e753a9dd9d9d9f3e7cf57abd5cc64cc975b4944ba4cbd44913cd1d5b11bafe99ce77789041145e8ae0b9fcc2d95c1054afd427dfef4ea85e9c642d3c5540808ed511b76000436c3c3210e996b406b0f26af1fe8e540502da9b2d5a439d3585a6855eb364e094d7cb5cb3ee87803c4be10918774533ee7de7ce40e0f8349f81e85fcfeb03119302f543a60ad48318e86d879c87b432b12461156b35eabae2eaf90b5fd951eecd4e74e9ff6bde4a616bf12b994675d19dd310a369a0d630c58383f3fffe1871fbefffefb33333348423fc193b06964e4207f53c6256257e3354b744bf20458822288002cd2058b64629ad25e682f5fa8ce9e5b9d5e6a2fe3bc1c15423fe98d67198dc91b157605683d30b1af867ec9599b81852967d5b4b9d05a9d6fadae66ad0ece87844a3964534c6b21ef98100be5a5b4e5808eb6dcc7ed7780d1fd64fc63894e9042cce4a716606b535a294f422225c29988354e25d655dbedb995f6c22ab7d2c008cc565d5a819d7913f97c57e815a0cbc31da3203ac641308ee3c5c5c563c78e1d3f7e7c6969096cc3ee6cd67f32411d00d300205c0b50fdb2a2dc2c7ea591efe7266b7c427e4c59dd8177b5f9cef26267b596350d19ad95af2d7ec68c586033a54469e7ff424368b185b072cce887615f61f46b3212ebc8b65d524d9aab69b3e63a6dca1c090a7d4d7c493e2e844d90dcd0c8808078abf0aa6cb58f3bd71e731218c04f9f194e101078411011b3c6ed24735c4b78b91dd4d36222ae91341757e37a3340e54d4aa017224c6c03b439dc310a8641d86c35e10241bb46a3f1f1c71f7ff6d967b55aad582c866108470876769d1fd4d35a6f5662b30c3591c49c117b30b92e30673c7a82a920edb238c992247306efa6cfd5e73f38fbd9673327973bab4139ece9ad60b7a034a30c3fd7e962a110ea881d17b930d2333c1cf5f5e97268c145fcc81e623b21eb4a852289a82852c5c8b09d6f2c7f7ae1c499e50b1991c5cb402769926044f283b318cb94b3162a11218fba421e63a6b04096e18749bc83234c16a5dd8943b812a87f555c59f31ee548771a180d12624020c549825fb3e22c15b1a4144705ad429d4aa9e992334b9db34baa9672334beb9d2c867ff44dd00a8d736055739b6dcacaf37d74c728d8b532e266b3090ae276027778e2c409b01026567980006085fcc8d7fe40dfb54248b9e68ec88ab3cea17fb1169de04c228a53e56665f54c63ee6c637639abc7da382dc65993668c97fa3ac4b06205af122209474a433bfb27f60def982c0ff77031704a1107da3f0cce822e2ccea167a7386153cd9a8b496d95fccf24180bcf0c33b4f1cba398f184e409af26ac0a3efa18851bb9bee4cbf781fa1bc8b5cfa79567f93942508ca78a5805a403c751a664a95d6a4939d5aa65b3469ce1fc0c3be420260fda1c90b539e965e5a33bf171dd833b13f8078082380bbef3ce3bd3d3d3ed761b23c0172a2c3a9413819340ce9580820061e2eb6510d720600806713ea034d099e6269963cbe73f5a38f9d9d2d9856435d1c6b0c3be6f8cc59bf0ee88905d627b556977dfe443db0e3ebefde8fec11d83414f60b03b93d60a56b55946acc50a1e5e519c8859ead4ced7e62e34e6daf97150b42200e3122954656cf47982c9af4d2e42c037b445fc2586300374913cd88973f8991226ae74a08248549852d871e94243d50d7e98ca1a49abdec2f3ee881daa316ff40149e50908744540d11579dd8cab56ef165d2d6662ad34796525c9c3c2c202b6e33367cec011a205332ba5ba3192d7015f5ad65d54b4d5ca6b2b280eb50d744bd925dbfc78fe14f8378d37ca1467ca3981af741a26204245117199898c1a0dfb0f0eec7874fce043e3fbf70d6c1f0c7bb465b20efa10339cab568a1c9115d6f8add92eb7abe7abb36796a77128c49b1ae74f92be3ffaa30cc2e281b9c35eac0351412641dbe020e8563b524f4d3d491ab133582b26a58599983cc807880466acc1e76cfef845dd9cbe28a3b78b891b4be01ee70155b1a238f92d2f2f9f3f7ffed8b1637373732217bb432df82754bb012eb6f0151566a67dc0de6988dbe4e6b3d6a9fac2a78b67ceb7e66bdc49020b174882e9ab28889c71d63a9b19ec178361654feff8d1be1d477b77eeab4cedecd9365a1c2872d8f5abd01ceaa17f254cb03411fa69d978aeb1707ae9fc5c63a5967652129c2b51eecdaabc49f101488801afa017f0ed33f1752bb88d26ebddcbba7087bfd12fb0b953ac9a9f3b91160a8d041dab6ab12c37c38e738db4536d67ad84fcbec25820f24f335a6ff40101703035c16428d9846b537053a59b148d35584b54460ccf871bf1caca0a2e25a74e9d8280fcdb03939f3b62450c470ae7959054293e535dfc70fad4d9dadc8a69a481b5b04d3e73908989315367f0839cab04851d03e347c6761feedfb1530d4ff0e064cfe8c4c0687fa597594167eceeac154cac5891301c298e8346bbd5a47e6e79e6c2cac24aa71993c585d9e474934d5664ca8310040fc993b718dd56a3ee1818b32bdcb1f85aca703e14ccca5654eab895bad556ba588b52b2cdd8343b64f084c2907823db5526ef49bc659096aed16040242e85ba347907520a3b1a51abd5c2ab69f84278c193274fcecece5a7fe4f7fd83a0fecb7ff2697961edd35514f15a9afc045009207168888f11d7a66c316e9c5a9afde8dc09fc98d1768951ce9025116285696671aa2138514203a59ebd63934727f6ecefd9364e3d435499e81b9d1a991cee1b0a70a084b724a7b46641031c243c05493345aa23e97c7d79aeba548df182d018c20000cebc222474b5e0f5bc5afe97288ff9f2b961522cc408988613c6e925b5ae95986a2b5d69a8d85af83fac009102cf9cf34f3e33ea7aac7f839ebe1849c0175cfca0d5c5c44d498271ae5251b1ef8a99a328ea16c79d589c601706e005dbf9a50444dc7417415fddbad78ba133bac6964a989ed854b216c52ba67eae337fb276a14e71cae8d54926e49894c6892e4e3aac9512c66f4643aab2bd32baab6f7cacd05f2655a16038e8db561e1a29f45528d2961058b3538e94f8b989c32cb09b642c75d3594caaab16cf786a303c11942154c2d3b0be52c861620f9859d8af9610d345501e248f7d6e57c86354cbbfaf15ad35ba567137ff0ec618cf830926c05488fc746015af271e6d2c03b21ce94cb0ffea86a15a8a57d3921a54c8371f18c58943ebbcaa5037ac7f775397c779d5cb336f2d8d01002b0e3196069e0fed716ab3c69c3e750a0236e277de79078e10f9f091a803e1aac867c22a5f50528ce395c0b3c1e938095989f744ce293bdb9e7be7dcfbef2d7d3ca757576c33230a242cd8a880572d14584ddc53344a5ce67ad3685734b6af3c31cc3d24ce3a0722611319cca2ede1d088f414630687d3b895519652a2b4048ac5603694122d25cd8fe68f7f38f7d97c67498815b1cd1c9644337403d59d5f2c21ed508466391c61fc50079a91a4dc2a0423105f3ee3b50cb93c7f537aadcaa69c7b208a57551131b3b0160e1c9e4d71ec38c2d42d9c5c9431ad266a391bd17db3a72fb8cc28ad2c619b0307c43fa15829ff0d11a4f4f09ff51cba3460a84b33ee50caad07f83c9012af69eaf53a7e2941f6752878d5c119aa133176cd2814cd0dd79e6f2de175c95cbcb89c5553ed2c2621b0975238c4891226618133eeaff44d0d8eef1e9e9aec1feb2be27db546a1525c0ca3c152df687960a4d4df5fe82946a5a010113b6f303cff680de6e0fea128d5b26c6a8be9ea6ada6853829d9e889cbdca0c72b2701e13e2aecea8bc014ca28b8d1c125f13f1c59c2f5af29a4307c1c703492578f4615b824770d055eb50e9c0904e24ca74843b9a11c1a23a4f3eef2f50c783ba91ef65e3836e818de4ba80d55b17b7fccdcc1b7d8888c503630cdecfe05c88abc9dcdc5cad56b37854089e08ebbd51f7a2000dbbc8178748307920afc0b8a8528bcc42bb767669e6fcd2ec6ab31a9bd829076259f83cc693ea6b62f9951067b61246a343c3a3a3233dfdbdc43a26d39234a68c428e2a854a5f4fa5d2530c0b1ad635c2ce0f04f68aef47d0adc5f952db954e7da1b1b2505fc1cf8019892865c5990c3713455e4b3f6561c2f2083bc1d8e403a68f2fc40084ebc17770bdf27b5cc6c25e23f111f9091202135b23d855945378a56f3ba969272ec94c92598325b59ba7c9cc6872f3801d6fbef28d6b325f1cdee1ad88b5f082380582823333332b2b2bce39ec4a88afd3976c94419235332462db64575cfb7c63f1d4f2cc5c73a96d630e38f75eceb1c068006a339a0ba5690a6ae9622845dde0748eeae7cdeab964653aab2eb86633b4a6a8a91888d6d689314e897fdcd1940843a23700fed535b2f6426b75b6beb41a63c777a4152b2d28244c95853c5c978268484e0410e3f068ea0000100049444154f423e263083786d7f8c6b5ee450dc17c723b08ccc09c1bd48bc8ce2cb601ce44621be322d2c097e934db0eb673171d0af32d4fe60e53f03233816aa020366290af4b413c324110305f53d17cc21bdda09a8763c689b749e94cbc7ab2367bb63ebf94d6533614a0265af878c30321414ca27098b335db39db5c7c7ff1f42fa73ff9f9ccc76fcc7dfae6dc27bf593cf6e1eab933f1f2b2eb7494b55a09710eb4f312116c2f44ceb14b02b79c3466ea4b8bedd516258e48054a29ed1be42309568a08b5a100e0f3d63f6b2cc4d7f5e988c6eb4dbed86f26f08f14cced67c55d6524b70a9122c7010e3d1d9b54db1cdbc071d26a93936eb5db8eef240561ea2bf580370205abd5eadcdc1c7c21928c35bbee9270b7174cad0bc2dcc510af52fb747dfef8f2f4746ba9ee3a9932825731e2d7bd3b8d6e75c48e09a7807ada3abf3afbded9cf7efae96f7ff8e19b3ff8f8cd7ffaf4cd7ffce8e7ffede3377efcf96fdf3efb09bce94ad2cafc2b3f3462266886d8b3b0eb55d1b58ba86a5bd3f58599c652cdb452b2a8aa3528e86b92af4bc284631031f8091b782f882f801004d5f145eca3bbf9b9430330615ede0e5d5da13d66e798b50eb5c2852f72edccd4e3c8e9928ed2768299776b6ec46b13df48df48e8aedd8d6aad97dfcc37335facc69c24491cc7b88b2c2e2ee2f7924ea70347085cac73a9b4d618535fcf8768481a14cfb457f08bf0f1950bf349350b9d8a14b168c18574edc1cd8d4588914f9ada2e9e6b2d9f5839f7fedcb1b7673ffdddfc276f2f7df6db854f7e3bf7f1ef673ef964f1d44c7329b5316148a598e00000824b0458bc40e8aca0ebb63ddb589aa92d2c75baffd0dd78c2916fc76b8341c71c9e857479c09a0097e7dee934c6bf335d32f999511e040fa165cc8a95c2e6158456d9469ad63ba0604145713b6146fdbc2e314257baa558dd52ed9ba90c3d00d444ac98d33c8085cd3c244902fe01a8702d6cccc95760b24a32722bd498692f610b860bacd98e8b38280451182a616c1ce4494758054f09f22128177541bb406295b675d20a9356216917d366216904ed3ab73b9c502854088352a9582cb1f82ebab16f4ff06ceca3803b92ae248da5b8be9a365b94a4641dfc322a09614886e081842341ec135fde0f2600e4fa0bf8e7d84f5518bb021e75a55271ad549a89b6ac70d61162bc7b626f0344cc5ec8dbde427487292822cef99d082a8878196c6bb7db78458243e1891327e6e7e7212b781dbe4a006519ab2a0ed769bf9c62711a4bd955a97d6af9c27ba73ffd74fa64dd76b8a46393b6e30e4671b84d08112b3ca51e3a20f686c03d4830b64b8d4b2ca71c590af0b62a4e09bfae273a7051a4c34007cc2e4d9376c724a945397ad2be2bd6da3932c6c636c53bc996246796a64f2d9eaf99169326afa8d754298818501191c37068600d6440f2c0986a8041bc4ac8bcff2184052062b00e311166a6156be58cad144af585558e0d252eaeb7ce9e3ca3889dbb64b93169bac5a06eb1fe6d56c7ea8082f085006485a5bb464f8c7c3c7e8cc7cea52ec33b943ac5cbb6717a7566a6b5b492d5d7fd106c853a7ef995d200b1f24006811c2cc68252993119c868d3cc2616703129ebc866c8c952936526cd9c718233b56fcedd871eef189cb725fb0e990da399a99af6425c5b8aab756aa6943971d074337c6d66de9cf565936153c98d278435f070b9807960b791d4726255ec7008e28c046642c196a1b6dcc30d3a504a6135b1ff827cd88a7128848ce3fcb59a099c0f2cc16cc526643bca2c99c699daecc73327ceac4cafc4f5b6894d7e0bc10e21d63baad4783619702e7316dcc051cdb8302c4651318c0a41018874215285900b51542a85854807a10271f1853a45bc9a2e52a05ca0ac6603db92809360329454d09fa96d13ecc5b8949cafce2fa7b5948c65eb2b405554f212c8d7a55f37f6b95fc60f2694b310bed05390d86790888604ffd731d2ce4a14e22a287896fdc4af39cb9b34c4bda0a03106b4c3450414ac56abe02228085e5e0b5e757cb4e242801bd76c67e5a3d993c797cecfb55770c37020a79f359e56901bf5d08df3c138b282df89b455810b28760224ce25cea63e86801c1bbbac652ceec16d03d9a2341363847540d87c79ed2f2278db622988fd0084b7e2ae96b67029b9509b07173d055191b0341e5e1dd4646ccf77dd9ef958772d62c2a4413acc0c94f33121853cbcced7042f0816b6b3b22a301e75ff6ee07a9aa0e5f58ad7cb36990cc65ecfbd83df20479782883b9d0e2808225ea77fe5bd0e941752decf3428860bfcf0c2b1b978a5261d1b08077ea999348b625261b11016c2402b4d14382a4ad043855e2a954c583251d144058f42c1168ad627a34e10c66100a4282a46aea06d4096b58e187df8d1c12a11274a4883580e1f26cd1d328b717da6b1bcd4a9e27890c11112fc807358284f5425a8488abef441302180e10409e4f3c0b31e606aa95589e3d89455083a62f6a00cb0c5196f321986de6267576b2ee2fbb5f9ef72699ad6f2004788fcab02eb887cc77811e85a94cc76964f2d4d1f5f3c8f13215ec47041290de69112562a0058919073e8dfbad07285c2215dd95618d8511ed9511edd511edb511edf0994c67715c77797c6a7c2e19dd1d80ec895899dbd1313e5d1a1427f6f588e380858a32f82c21e0ec665746dac9f56a853e556e2c6747561aebeb49ad6730a3aeb6be78d500944546801e9cb0a2c151807ffc7846ff12c14080453283c6aa9092ce13858a0c0c6a9e001bc1313dd44c13bd1dd957d30437f524a69ad41c446a3014758afd7afacd9cd01ffb0ae8e5c02afd35a39357bfef4e2f47c0bbf4ca49976a4090672560422c3f569630d4e8d5a71398ac6fa06f78f6d7f64e7c167f63ef0d8d4a1272681c34f4d1c7e6adbe1673c8e3c337ef485c9879e9f7cf0c51d0f3fbff3e167763cf8d8f6c387c676ed1e9ec2f9261485eb343921f40ed38b2862672d3353a89da67ada9eab2dcd2ccfcfaf2e662821b84080044e03cba4505dd11f4858631e160f4f958249328beb88c26927b5815016272216a55b9feedd3719d68f3c0503a5c9491a27ad560baf69fcb2ad3d6bdd255c8b2d82d894a449c94c67e5741517e1e5a6c429c31d594cd859f83cdc19d081ef5685411445bdc5f244dff08191ed4fec38f2d2fec7bf71f8f9ef3efccaf71e7ae5fb0fbdf2670fbef2e70ffaf8cf1efc2af0178f7cfd2f1ffbc65f3efecdbf7ce21b7ffed857bff3d08bdf3ef2ec570f3fd99306055c466079981c8a329e7a2488ac8f714127b66ddb5a8a9767e3a599ce5287b384e10704cba384733b32aa7601423221f2204f5044b496589ba8109c0c64d4a3fb2b08e59b8c40c135c530316d9c4e5d94316265c96419ca049f2d2337dd967bb94e074e84946ad41af5d55a41878b730ba74e9caaf4f4b6e2180bd7052a38c601d709fba08230255aa6ce9964f193d5b3e79a73598422e79d93735aa9280c834023895b8e75428e43c3fdae70b067e29989a3cf8d3df468795f178f97f63e5edaf37869f7e3a53d8f95f73c5ad973389a3c5adafe4069f268b4eda170e2f1d28ec72bbb1e2c6f7f7ce21035b314960d9838a340acc5deeb0a61811cb1b341445cb0ab76e578fdf487cbc78e37cfe39cca0a75714242dd14bf0271a04563811c668d5e5028ce396bb154c2a01bece4457092d12959f40b19b9b70abed506375f5f416b780bc6968351a0ae435b21d34ca2d8c50b551ddb5218a569ea489452a880f2ad406da5f14db5050585ac734992b6db1d78c066abddea748419da6f80bc8bc09471c8b7d6ff1c97ccc4ab67eb8b73317e12cf38d2582a257ec55978633109b99973b1c1d3391af5eeea1ddb551e99a48151ea9d5083937a70520d4cea7e6022e8dfa63db61787270b8313e1c084ea9ba2be5d3cb4bf3c76b07772321a182df4957481b0065a91e6506bcd388883ea2c9e45245a52edaa12cf67f599ce6ad5b533cf2486c7d4a4989405e1981cb37441c4ccc4020821e411111302225f40dd14dd5a58ebe8d61add5c6daf57aefdba62188b85b525fc3482d37644daa45d1788a5bdb93eaf5b4b5db7f40e156212444992349acd5ab3516b351063b5d03b8617ebc862714913664ec284755db5add3733327a6cfcd5757c13185ab823028c8a2608e5cf429265696c38cfb7479aa7f7cf7c8d47834d447c50a8525f82ca24851a838d02a54800e948a00e6803c42a222e9015506f976f48feeec1b1b0aca91c5054705a4c24033b313e57039724a9c6655142e346233bb5abfb0b2badcc14fa4e402e5a007580b476e9c63ed94f6317887e644c428263c2cc48899c4f74fa289823cf6b928f8a271f9f8f9a2f94c16cc84c44a96a68a551486dddb24215b84b61cd4967bb85107428ab0088417c89d34e9a2dde918eb0fb3defc9e82586452ccb88351a8710abc505b383e7beeccd26c3559fbcb29188605932674866fe7971449fcf016f4abca64efe8de91a9a9de913e2a4424a113ce848c881167c5198713a6b3fecb19eb326b62f8e48e4d322dae20aa87a2ed7da37b862686834a09274243a01e33bc9b13c2484c6099c02b169c0a1a69365bab4ed796173bf50e8609084f8fd21c6874867a39c3a0256342cc840e2e85cf62221670915099bea000adae36b21372e2c4873c2624bd35ac4b5a3196320a23bc56732e5f012cc9d5fab8a53c754bb56fb5322c8d010246449813f800a4d6b49338331926810a7e86841523045cf4633273c92a5e441f5f393f9fd4dada582d19fee46b09aa6e007c554205a3470b037b87b7ef1e9c1c0a7a4aa423c711a980592bd69af358690d68b004caa00871c878bba52251658ee038b7f78cee199c1c8dfa4a466b6899598b5bb9cd40222c825752843111addb6296e2fa6c6b79b6bd54b34d83235d00e6099ca626d6826324215622806662729a0531fa112c26394f3f46779831a198be98c0d71b96bdb9c92b87396352d89b5cda8e35a962a1d86cb6c04eba4341dda17eaed90d26aa18531193bf3db1e4e224aed76b599a3863987c113e700796a543d98c593eb67afe93a5d3e75a0b7515679198401c1613fb610ecbce2987b5c48a6a277daab4bd677cf7e0d4b6ca702f9540a990b4b71f1e7201efb1e0e2c020e93ed98e99b4c26e82fb0c38e3a70fba44148c9607770e4d8c95067b5431b00aca664c862d29a7140804c52da1334d36706d95ccb617cfae4ecf35175bd4316c3084522ad481229503e3f86911899728d78684c90184589c220781eeb720b09a03c31cc16e90bda56106b8fbac9d606a78ffd06c36c52bbf36a92dcec0afc116bbb85e73c63288c31b5c92d4a499cd922c69361bab2bcb599210f2310b2652648812e51a9c7eba7ce683a5139fd7cecfdb5a2b4c4d68b0e42a62cf0ae52cc8e70fc696186b6943c7dbfbc6f60e4eed860b8403a330c2192f5708463422195923d68a039c3804eb405f8cc8cab3c5f3c1a1526a078afd1303e3c395c19eb012aa08355ca00975b4d5ca2a2c02616b4f3930ae604dc1ceb5e64f2d9f3957bdb02ab598703ecf98398a0a5d96212686eb63cf32f6d423a4083a0b98a7c56ab24a0c62c292e70adf2fd1ba3e5819a8c4826790b563b66293543187380b26fe3a8cd23b823b4741be9a3ef93c2437b3886419b6df2cee74ead51abc22395fcc8a9d665010b7ac16dbe3d5d9938dd9e9ce4a9d63d08e086c93300c5055600f0f3f10f6aeeba51b0000100049444154b1d051c1f0cebef1dd7d93db4a43bdaa0467a689c911984e9a29601f6bc5ca23ff28528c2ae80de3b226ca0d00a654a83c58ea1f88fa7a7c3f114127853b8906b1140b40627dd72c8c5b44242b716daeb134d75cae994e4c362371ac94869e8cf5ea42c04252847b1462517e309fc54cc4585ac2994298a00bdd5f014bc5926be635c51e10086b4b821fe8a0366322d017b3402984ada2dbdd567bf1edaf6a4926c5d8e87c99d67a797e61df9ebd2b8b4b0b33b3d5e5150605ad759830a936b6e0e6f287e78ebf73f6f3cf162eac642d8a74502a92d2ca115bc2ad99707a7458e6228bd6a9f4a9f2dee1a947771e7964d7e11dbddbca14a2266128a6a0103a8d152634450611619e8a59116b4f08d412478851424a53b118d55bb550f4915d07778dee284aa48cb26d1b8625b168ab031584d0040f9373cec2b33adc5b169ab573cb0be75796eafe5c1b7512632c5b56d05145050e221c27f13b23593c0aa1172408544171e82ca32a1a61f6444cb712f81ae156fab8665da8a25891836d08e3a05ea0c38055d2e8e0fcce4614a9cf3ffb3c8842581595b4d6a8b345a82db6bf4173ac1909d445354c0f71da896d9a25ed0ee1220c0a2aa5028dc9b44d32bfba7c66f6c285c585b9e5e5ea6abd536d996a9b6a8954535b4d4a268a4c14daa89006c524e8318561d53b16f48f06bd835caa5018591db87c1044cad3cb0f4e789889f35809296214c2034113301015bac5c8e92955fab8a73fa80cea9e41d5d36b0bc5d45f3dc22c084c0e08990e331d188f76238e63536b75569badc478b26146e5201c2c947b390c63a35a4921a5b28415092a36182a0ff44515b05c8c188383815251312af77805726d6e3dc2546ebdd1f55bc044de427925056b292656d6bb406d48c36b1b97a619d64d8861406c6b79d52d456a4bad6fa2b11528eceb09fc8e50ab5ecfe2b8bab262d3549cc544b40237a493c62bb5d5f985458b5f816cd82ba541e91995be111e180768a02f2e0da49581a4dcdb29f4778a836965ccf56f5383db4b23c3410fdeaa14088fa426f16331ece3253cb51e7854e18a19abedfc0e884245606b9ef0d5a005451c1429ece7d278d4bfbd3034a507466d792029963bc562522a26888ba5a4508e0b954ea1dc29143a91eae8ea427d6561951c9528ec09c309fcecd38cfb565be1ec8abab018cdaf96579ae5955661b559699b52ec0a96430a82104315d3208cbd3ab7bd04f954fd74efe487d12b1e4dc29c88147463764499b8d404d0d64a1c27ce391d68780fcaadb7c5e131c6167bb85ef37c3a841586007599a85eab666952afae9a2c2571e45d243ed659530cc3e1de8107771c7a6af7432fee7beca5bd8fbdb4fbb197f73cfe953d4fbcb0ebd127c60f3f3df9e073530f3fb3edc127c68e3c35f1c0e3db8e3e387e60aa6764b05029920e456d9e0c3c9f22f00f9e8fc07112645037e09c932b8367c3e17c8912e407cc05d24361efde81a947270e3ebde381a7278f3c3579f4f189238f6d3b9ae3c813db8e3e397ee4298fa32fef7ff2c5038f1fd9b667b4d453c102b517e63e7b7feebdb7fb179726561b932bf56d8bab134bd589a5d56dcbabdbaa0d3e795a5f982955eb7d99ed03dd5913bc499c62e89b014c7733d5b65807a3b0b754fe514ccc0cfb1991ccd84e8a8727548133163b35fb4077246c5eb5dbea906fd0ca2f705e074443d57abd2ed6351a8d4ea763b17d810bd69a2c2daa60e7f8c493071ffcd683cf7defe1affcd9c32f7fff8197be77f4c5ef1ffdca778ebcf0dae117fefaf16ffe8727befd774fbcf6774fbcfa1f9e78f52f1efbe6ab0f7de52b479e1e29f5e3c51efc1ce734c71039ad6139f0cf03fe2fb7a82ff19fbc1a34ea3eea420e19404014116f2b0c3e34b1ef95c34fbefed00bdf7fe4e53f7ff895fff0e4ab7ff7e4abffe1a957ffeea9d7febb275efd8f4fbcfa9f1e07befd570f7ee52f1f7df99b479f38d83fe41666cebff3d6e95fff78e1773f33effcaef7934f474f9e1a3d7162e4f3cf863ffb74f0d34f878f1ddb76e1c2d0850b950bd38599b96869a5d8ec1433bc38f4f71cafd5353f50cd97ad7d79f1ae7e04d4c29a600c2f8085909cc345246bc791d28530f2f944c61a27ddcaa8b1256c998237639bee4c723d3bad361c7892e0d54c1331f2c048bc69a98485a981b1a3937b9fdc76e8f9f1a32f6e7be0b9b1c3cf8c1c7a7af4e053e3879e1c3bf8ece403cf8f3df0e2e003cf0f1f7d7eea81a7268f3c38b4777769a2a20bdd3988088159b01f9c2b09bebd1744a697310e0b13b056c7f314651e0e3b0d1a0a8185150aa72ac30f8ced7962e2f033db8e3e3781418fbc3076f485d123c08b63475e1a3bfaf2e8d197c78e7c7de2e12786766ca7b07dead4fbfffa838f7ffa83ecfcc79359f5b152f0f250ffb7c6875e1d1bfafee4d8f7c6475e1f19787d64f06945873bedf1c5c5f285e9f0fc4c697175b09d0d5110f84700ea5d0bd0ec5a4577251f46eaf60b0b62a540382c90cb8ccb6cd74ebe144ac1dcce05016ce633b6f2e92edf567ab8715b4c0395b0da88932c85ded01fee1074c40b354d5cd461258870a5eda3701b9577522fb09d2a93549ea49e29ee9be4de095741d10885232e1cc98aa3aedce7a200bc61efe68cc32dce919f0d088884cd4d2918911021c164950758e8413e1be700e7bda067817faa0db17565170c52698c7ac6082396265c61d2469379bcdd1476a4d1cec463ca683a3dbbf0cefb277ef1b38f7ff2c3c58f7eddd3b8b0cdaeec0f92c33a3da2d28743f34c45bdd8173d5fe46742f742317836d20f3b7730c976b692f15a7b70b95e58aa4516fa7935ef978f741f52ca578d99986023e318fb85b1699c48be7775b5c53a7685adc47ed1b6d2fec66d05c4f0a3705ed55a87976744dc697570b0b5608ed63a08b5c2db366b5b9dc84951a868a598126e9425abca4e978deee3425982925315a37a9cee215d212a0a6947a093a01f7ce7805d001266c1985d90e44588d6056f5ca66e4c4c12e2bd0b53201c892a11ae26ba285ccca8d7ea1eab71a52dbbb060c3c085ca06caaacfdef8f5bbfff26fc7def859edf847a5e6fcf692dd5e763d59b5d7b67a4ca7a7d31cea7426addb49b4cdd99134ddaef4feb0f058a9f274b1f49452479aad6db3f3c533e7066353ce28b4acbcb63014906b2538fc433126441e3e7f5ddec8bc1981ae1fd0c52515600b580b2fccd8e194a044b495c0e29412486a331c5efd33b3d6c8e1427949e3db496062b7d3ece6db14f02e2583c7f04a0b519ca48303834927a9ad5417e7179d524eeb469618a288834a58c4ab0d6bad0829a5231d6a7c0b073a602c037249582b1d28a590264d1432c30d865a4701488c1128402ba519cc274da2886054c6a68c6a409ec6054569d11a75496b514af2f566528af147611051058a4a41d13ff481a650fb1f4682c82975e1fcd95ffccb0fdffffd6fcf7dfa41b67076c054076d2d6cceb9fa3ca5cdd5daf2f2ca4a7bb51524942c369af35593b8b9f99533a7a73b8bb5bd2afafad0c8777a7abe1daa174c76b8d12c9f9b2dadb42a860bbac861813466c1d8fb0262808999552e6a62cdac89f8aa60565743b7325d27c87a19aa0a137e3c80ddc925e262b1692476b4d4d34b61b6daaa0495e933d33029a38da02e8c0669bdfded7eabdb6d78b3ed9c7398db466d0da230632f8ee3384992d464a9e0a705679c15e7c03fce9d17e687c97541c881a3432f003a820100ea16a222b23c205d048cd305da7af8dae8631dc4c44c609e472e53b77a1e13f9525400774985da398b47c462799c995f9a3f7efce34f3f7afbd3f77e599d39468dd928592a4b5325cdd6caeceae242adbeda684aa7259d66a7dde8d4aacdc595c6cc6273a5661ad53ad7ea43ede61edb795099873420bbe26cb8de89aacda01dabfcb249e214e321c165c569414c5e0fc2e408fa63eab700b4f060421f3782f80a7e18f10338c2d14fac724e59c719968608fecf79b330a343923c83b61cee2405bd5e5728649d83ae041ea0884969d8d968ad9bad56abd3eec471eef3b0738a4310714c5d8866ac3ad04d22f6b222073061410064de127c13a2dcba886f0cd427cd894d922c66b29de6ca99cfdf7fffd73ff9f0773f49aaa77b825a5fa1d953686d1b09764e55764c8deedb3bb56d747872b2676ae7e0e4ceed633ba60627274bc3a3515f4fad43cd8eeb74ea2e6994a53d1e9903fdc1c383e57dce4e34dabd2babe55abd9424da1aac3a7c9d16f0cf0502582d1e4c86c912392258f4e620e4e924b0fe4d03159522ce81d642782193590bc04918c957138f0816bb0bda6a505bed60537bd9246f884ec4e72b98824044249bad56664db3dd02d2d4bf180b94d6d85a15be607c6f60d4442b6198226f486bc167420405f375a05c40c64d02cdd1a4dbf4669a400147f869cd696c8f36599a3df7d9fbbf39fdc96feb339ff607f5b14a3c546af7173adb86a2c9b1dee181ca505fcf506f697cb0b26db46f74b47768b4af77a8b750297318e1881146a435dbac6d3bb5206d0c69bbb7a770300c761a33d2eef4743aa52c0d9d03079809ab8fc9311ec91c448e09e473c8276f214ce56640944f986e3a302b85e14141524cecb727ac569ac13fe4c03320e42b10f13a684be1fa14c4205beadd37f6132182d2e483cdb25aadd6ee74b04db53a9d34cb1473a88380c1427c05486ac2d99c100320207200085d285840087a03c8e92621dc0cba95d1f026018d13677418846190b4ea174e7c7aeed377d3d573db7accce41b77dc04e0dba1da3e1d4285e4e6a133757176682ac5570ad12b7226e303544da9981b76f562a416f5f4fdf405fb15c70ce249da68b5b854e7b5f18ee679e72ae3f49c234516245b1055399f000106645f9847332224740c0bcc8cb775cc8c753b0aed244d043b0f9dad498240b584117ef4f18565987d7665dbedd6facc5759a6284eb94de4a11e78ae771ad5e8fd3042eb0d569c30ba22064781905416bcc9c202866c44057f0ab403e1f3944b99da09ae40292370d22df09dd4ab08e0215b273ab0bb333a73e6f2f5d182dba233b060f4cf48c56dc40c10e96b91c4a29a04a212a682e69db1bda4a90147527529d429016b409d91634f594a2bebe4adf406fa15c14a276b3d559591e71d9ae802715f766a96ac76cacd2ca2965999d9f1f7baa8176eb3a4b37f366e3f5666bdfb2f67d8d2f8cc5a01a8315201c1c8192cce1220c0a4678105931f661ec6ae2b0221e57f673eb3918ecd61bdd520b684c04e58949293f5c9cc43820365a2decc8b8913863f1300b660543e795693d30b317054dfdf71df9c07878c7759310f2fcd3a471d958bc70be3677bee83adb074bfbc6fa4aae6d6a8bd26eaa2c6ed756db0df83c0a95d22ed32e0ea4c5a6aa6d2d74cd82740ace16c9e0ad86661b4441a1a71c54cae059dae904adfaa04d47c895e284db1dceb0e16a5181636d593b5c4b3c602166511e704e5de1666252971a2db7e7a5599b532c1b292c9566c76c893291d4958242a882ee2b05320e359540a58dfab72f5ca6e2ed7774cd96feb901b93c342b1272702ccc9d24862f841774d60a729cc3bd04d4f446c8a706a10b4f40e460157c1f7e1c81bc01646ec8372910987e5320e2104e892869361a4bf3a6b5da17baf1de70b8ac3969aad4f697a3b1a1a172a188496549da6cb674100681d69ab4725ad942e0ca81f40454625259278d9bc6c43a54c552582a68b84cd5aef69876bfa0dc2f37000010004944415435a5380e5a7198ba5094f23344c48289938f8921792821f0e86681cab7026f4b666245c4fecb29b6ccb808672e52382ce119f0a4cecddc1588690b216f8cc1b6d0c54d348dc210b5b234c5b2887390dbad16d8060a2e2e2fadacac60e5c478162a3c780a5ec026d6a4ce66e2101b7186c490cb90e3acc9e3aedc8d7d05d4b902ddd22b6322bef9454165d4c6cfa371bdd6aa2e65ad9591de70acbf645aab12b747072b051d755a498837d9a26af5a625954a50e81db22a14bcbd2c1688a85c88067b02b050625b893860e3c0b99e70a8574d0c442074d9c495349e2a967754fafb4417adea8dcaecdd3539bf3b48f77161f824c7c86227370d8787fee6014a186b336b734f41c5a814aab0556b453ac495f1c2d9734c92830a788c4831312678fb10dff4ae5310ee016a02703d6261426266a515661967291ca13106a5c8c4e46076a514c8aaf2a021b256a4000d19055702f9acf59550da37b922b662e5a6e1c0f8c464496cd28e4b5a923601322dc93a050d32c1d529260d4a648e52eb322b80c306ca9820e10aeb44b452a5280c9894a32cc5f3959158724941653d91ade8ac2f70bdec2ac64649a6da49d668b7eb4db45298ba56a2195d90d2de6aecb359d34d03b656ac105f13ea9252c55aa32ab182f26429f707c66536d48188586b72dae04140211e0dbf74b4b5b04141f4b5b59eaed6da772aa2c87f9380849e820a93d61a4b516fb76a8d7a2789313766b6247092024f89d321c80a3827ce32b201e45b475702f928bd12c8bf12d645acc39b875285280842680c4d52673a2e6b99b861d356c17b069dcf056ce3c4d84e663a29aef899f713988e837377e0bbd2badc532915152cd0a8b7db9d0c93c01a16b4ed29480588a83f54bd9a4a22a11332c6a4a973d68835387661adc90af6019488cbc86722ffe680ca8033744d649b8aac3887891a47997399cbe22c6927712b8edb711446ce592ba05d979cb038961c9b04e22d41adb7ee927b3d75e7be3123d08b8973e5b10a1e8ec488abb59acbd59566bbed302f0d4d94301e751d0481ee0685cd4c2b56003682f5dcbc0c0b0b40544af355e0ebe7cd2f11347880c18530e2cd014f802567c55aac8949c4a62c869d2d1782102f2aa035e3e1e13873adc4c52088351843319188f3c16acd3d95622fae200155ebb2528f3b9936146a5dc8674a85908a812a301755500aa262580875083331345c5b0826c2485dac65dde06b633dc53f117473310b07001c8565fc161958866fc7d9483bdc8ec919dc4dfcb0e2a70ce5581454f2395bf9dc812e6e6a78268229b02e846748b005eb62d431e96aa3d18a3b16cbe56785224e339c1b11650829449365d600c659836dc0ae0767adf3b2cf74d697de5c8c7d358593b939c4266de5e864696ae18a188406714a051dc1972a87cd5594c037c4c6750c8182e26ca85c408e1db8681559cd5931e281fe4ab947b5125a69987a12b64dc9a88a9110cb0976a15596648073309426521828601d9056ac09a020a430a4087140c18dc16b754242c39b4544bae054c1725134dea797f28329724a2a7449e6327f642222f14b29442c5854da6ab84714849f03baca822ea01d7e3348ada936eab566a39dc47196b45c0c644a32457035801714652c1e8a8cf64026d67603bea85be1d278a3c266016d290cdc4d43c2508505552c72a1a082482b8f42108185018b62f0c5b002ddd808270631812e4a074a2912d20a4b644862cd299ce0e0409fd2d468bbe55ab6da72a92b588ac036b2ce24a68397f5cd4e0a2e1b62c79c8ac6d5269120169d5000c4ec6308b70009d0c38de136aae14a1e24160853d1b195762a9d8c539b345a381430e5011e10df487405c85b80da42db5b6ccac4581826676dabd3861be9a4c9727575716579258fe796166796161a26a999b86e7dec0513d76c82240061eb98cf1a378f85acb192b5aa9d4ebd9334e3ac933863a03f29c24e2b24460072c2d8acc0bfc05064744182a2e35058f93f84db6b871d2e956664a0a7b7b79065b4bcda5e5a89e32c2055561228fc1a9ce1e0ef9ce1822ef6167b07cb037d4165405786746558f50c731e7b219791bc79a8f2f0f550ca4bd1bfaf36a44b0341a94f47fd504315ca14469643239170a7d6005734116292f5a5970d693de7d6bf7d87b7deea665b404100fbac579cc9bb0534752e4b5212e9a4f172ab3ad75a3edf5a38d39e3bd19e3ed6baf0d699f7de3afbc15b67deffd5d90f7e99e3cd33efbf899c0d9cfbe0cd731fbc052007f1f90f7c7dc83783731ffc66e6b3dfcc5e825f5f9abc588a9a339ffd7afab3b7678e7fb070ee447571a6ddaa1a97e2f5339e25ac835812c704898519cbc14c8c55d22c7ec29af05611f3b519bb24a0ce404f3080b71c8eda4d536bc4b10b5c50228dfd1664d59a835e551a8f06f694c60f9427f797260f14270f15260f17268f00d1c4e1c2b643c5891c938750b48e83c5c94b3175a8b801d4ec36598b0f17d0cf1a0e159039d56d7ba8e8c7828c71f71627f716b6ed298cef8846b64583c3c5fefe725f1227584acc8f08ae1d60c2843175da6ab8bb1484760255b1224cd0dae1724644c86a27a5206a34ebb3f5c55f9e78e7bfbef7affff5f31fff6f1fffe0bf7cfecf3f38ffcb1f9efde53f9ffee58f4ebdf5c3536ffed3a937fee1f41b7f7fea17ff7ce137ff9203c28fa67ff34360e6373fbcf09b7f9d7dfb5fe7ae827f99fddd5530f3f60fcffeea47677ebd19ff9c27ffdba95f6ee00727dff238f5d63f9c7cebbf9e7eeb0717defed9c267ef36e78ea7cd7359bcca14f4f73ae502b086394d9218cbe39ca2cc64a9482b496ace5a2d21a52056312cf716a320e0c47696768e96f74ff6161455ab9de3d3b317aad558e1b4288db885edf8e8c49e6f1c78ead59d4f7e77c733dfdbfdc27777bff0bd5d2ffcd9cee7ff62c7737fb1f3d9efef46e633dfdbf9ecf7763ef3dd5dc0b3dfd9f5ecebbb9efb0eb0fbb957773cfdea76e019c4dff6c2d3af4d01cfbcbeeb79d401beb3ebf9efee045ef8de4e8fd7269f7975f2996f0153cf7c0b987ce6db53cf7c7bf2d96f4c3efbb70f7df7bf7ff4cffee2d0375e1c7f742ceda39a2deae2fce29261c66ddf12fb208e59002230138b7afbb8eb145c530d145c93729d059ea0d56cb76757173e9b3bfdcecce7bfbef0d12f673f7a6beec337a7df7f6bfafd5f0217de7febc2fb487accbcffb3336fffec748e336ffff4ccdb3f39e3e39f9e7dfb5f8fffeae6f16fc77ff58b33ef5c156f9d7fbf8b37cfbd070131f0d685f77e71fe9d372fbcffcee289cf1b73673b8d0badd672274e1c17a252108401ab50e39d8d364e524b8eb03e7e61d8cf171f4da2c9b167a41296544b3ad05b181d2ac24bae363b0dc32dab5a196714f69407f78ded7e72e703afec7bfc9bfb9f7efde88baf1f7de9b5075e045e7fe085d71e78fedb0f02cfbdfac073af1d7dfeb523398ebee0e5a3cfbf7ae4f9d71f78f1f5075fface832f7ec7c72f7de701c8c08baf1d7de1d51cdf46b55c40f2b5232f7cf7e197bff7f0cb8873bcf2dd87fd7f94f67b0fbff2cdc32f7c75df53afec7ee2d9a9878e0cecda511a9dec1d9d181e27a80f6f423eb0500e59cff099b7fdb95714945c43c955cfc5384d48abb649573bcd95b45da5b41551b3402b41bc12745637a073597716a4bed885ab2fb85c46eceaf3726b5874f5ab62855bc03235116f60959a756e35743b2e19ee2fa8fe62aafd3d210c7b425d24a79954a4031d448e830c6fa47149e19059912201481c762b87b76c6491568a35f5f657c6a7c675442b75db684bc75612e9d7e1f0c8e0ce3d13fb0f4cecdd3b34b5b33cbcbd30b4bd3834591a9a280f8e9707c72a83a39581b1cae0f69ee19d1ba80cef5cc7ae9e915d3dc3793cb21b72efc8aede919dbd23db2b43db2bc35d4cf50c4df5e6e81bded13b02ec4293cac8ae4ade10f57b460e0c6edb5918da5d1ed95e1e2863efadb5a91973270b1c015a088cc1b34508778480e43b4467f704e2fd1f130144849fe68c35b80be3ed205e7cb4d9a5059d96755aa2a4244951d2d21a7cb2249dd0ac213271e4e538cf7115b63d370b544e229b5e034968ba451b0286488a595ab2598568b048033d2dadaba96ba694594d86c991522ad44a69cd41a48282c50e2d4a304b45f0809604ef728c256b456b8d636454e081c14aa5524c33aa36dd522b6cd8beb032393abe7f6adbdee19ee18251dc4e8a568a860a96fd85c0e1751d6912fc4081d725451c2125f082e892e051d025ca2141c943a3a8e474d1e992afe98b8ae4ab15481748154417440596424b91c51052b01419e982da09ce16a1732a31cda5d5e599b9d5f9c5e5f9852ef3ba6b2744ce4f1d9e91b61ed0f3d63bb9510f5019202ccb1a482869778a51412b85777e19b9584c5bb2ccc699a4b1241d944bd2ce914ae2c159cc5992031b97e12ce50c027220dc24d62a53060a5d868e8d6397005d013190526c5caba1daad30b3fd911a1d34fd7d7515d5ad6e654a40314c8871a795508b62714e8c65ebb4f58b24a022e004ce902d7ee3521c28e36c33d4a6afaf1c685aad9b93f3e96cab680be3bd23bb068727cbe5fe525028eba8c441018ca6b0c090a32287250a0aac356b569a592b0ec07a1f53a02860428e663c11102e42051c84a4818034a0093d28cd3a6085cccd4051c03a52be48a3546993a4699c2054ab552c20e0882c93c5d305322a22c4006d29a09bcbda6fb9cbcbfa43f2d22ebb29bce7ec2b574a4114928a5410ea40477833aa737b2ac41ca82ebab28a8220421d7f00533883855ed65180e5bd2504eb0dd17633ba632156a15f59c40086a648a962e0ffba4b7f594f8cb8d191e5b0703eb1738934096b1a627445a6a85d413217275962934c7034742cac1c2bd18a35e19b9438cd99d89631ad28822205bc203cbd982ea66557198bfac7b9d063851d4918a25b214f5e222cbb23fc08a81df82cc658635c0eb07a0dc6fa9c2c2fca63db8d51d96506b090ba1f6b330fb410eb7c10bc58b74efc1fb1ce851126ac8829cdb266bb156769274df0e22cd7821c9330a1740d740782baa20fb922670b195d75afe800d9ad6a8d5223ed24ab35bdf38fb3d0c0e844c601629ccb01c12733e7320be0cc2f5d21b35e4e2da58e929b46eaba1da2cfcbc0587c2bdd4cc85d81a01256482476a6ceb6510a974ae1b124fdedc2f2a78dce74467561a8a6c4f4473c1c49051da419a6659c23768a2d5efac13b864ca530847f679785da3a1b0b965bf4522d5bc98a59655bcfe4fe81ed7b82befe8e9846da892515cdfe01d08ab40681999562a5592beffb020a72e88073a00e07810a020e359e1c15689d0b3a44a6f6c9402b8dca9a74203a703a6f1ea27ec09106f0a451a8e0cc8da2b6cdda265d6a54176bab1052b1ab8d3a9cdf1aff3656d333c57f36326e4f50b7d7ec665b4143a05b3b171001c80874d05328e1105330146582b8e05809c8a9362c0ea333fb24728898739030fc0be07384c320ba25f886c2e8e43228d68056f0bd9b04a5c99226edb44a4215f7979a83bdb395e209ad3fe8a4c70dcf715495c0eab0522c0e1483de90acc11f1181f712ca3526e600ba87056be0754885a1552a11eed800af64daba570f4c0cef38b06df7819efee110fbad56a4f064659935c65a6bacb3568ccd9f3de32c3a714e2e81f8f1c84742245ee8cae2f022dd2188edb640453c1cce92cba0a958e31c3af6709289e04444e417c158eb776093058dba544b000010004944415461582c9574a0a91bd03f04c46b802591de12d4965adf6463a89bd7c4f706b452f5955549b2acd1ee2c572323f082da5218463a0899951382ddbc2959914675cd2a87d6ac35727c526b2105abdd2450d931dbabc11075b151ea9462529a22d34a6d9ada42d0e9899ac3bd4bc3fdc7a3f0b3b0f4d66aebedd5f89c0956e1ec0a95a1defea226f0677a66a1d968691db834c3aeecdaed2c33a6d9d15159154a469552555aeec84aa28bc33b27f63db8f3f0a3937b0e479501434ca44a8528603c0a017ae020105c611886c1b3a38855ce2fc7ce43399b0337201712854c01da8bc0766b766162249556ac709f8d603847607340ca0399ac34b356ac0008a4accdca61b1b6b2daa8d64e1f3f81e3e0d4b609875f87d14f17cef78f21ba60da6a5057ebe04ee6b1108047b3dba910b95c4ae2388d13362e12d6d87c53a3ad84040f47ec6ba3628eb5c6b2f66cb317604661710091f7687e04d4bb09a06b0f41f39b0134d58eb09c587ba7a91da97a255c19a82c8d0cfd3ec9deeeb8b79bf6fda69ce8f0820dd3a827eaeb95b088d37a6c54ab2371a61d47aad8175686b2a0b7e1ca8b9d60a6c14b69c1f54e8eee7be4e0e32f3cfff5d71f78ec99f1a95da5529fa600eba1413a62472e136b88324599a63450b1920e5b1bb0d57405a496356b69a39a34ea69b369da2ddbe9b82495cc7aab1009e5274b09883581c8303226e7c144be0a2a40200a5869d44db3b8d5b629dca2cb92146d7db5bcc26681ee445077a2936bf6017531008049fa4a486fc0b94ea783673ac4539e1ad349304fc5cce449c520492e10c136eb402e1aa0af1ceb1c22c7370bdf353acc9baf197e5d5eef0d035f0491d34cdaaf97f82860538ef0435b7374b8b963e7f4f0b6775df1e7cbc91b8b9df7eb6e2eece5b11db6d24ba5be942b6ddb13537fa20613d5df0e06ea6a60450616ddf0128db40a533d3b1e3ef8ec379ff9e69f1d78f0f1b189ed615470605c27036d254e4d27865ec29490edb06bb05ba564d1b5e64c7d4656676825c7aa97a59ac7ab9d50da91748aeb801c4882c7064f3991575e1ca64ecc3815b097280f92c7a484b04c40c81a43a7ed4e7d65b5d36a3b63dbad16b6725443d52e1cec92a39b44d1568041b7d2fcc66dbb94f3f5a0afffca3fc825c2e3150817752899493bb158ffc42a91cbc0a0046139723f08f39078f6e4b1e70d84bccb9b8b847cfdabc458952be10782aa30121e0d4031859a7a8ad9606fb47f5fba6bf7dcf0b64f82f2ef3af28bd5d65bab8d0f5ae9d98e9b4ff46cbb38dd284c374be7ebd1b165fbc94276bca6cfc5bdf5c20e1a7ea0b2e3b1a9075e38f2cc571f7cf6a5e1c9edc5de32a1e348150a61548c0aa582846c585a942d4af36cba74ac39fd49eddc074ba7df5d3cf1d6f90fdf3cff418ef7dfbcf041176f9dffe08df9f77f39ffd1af173efeddd2e7efd64e7cd03afd717aeef3f4c27c5a6f489ab2b39808acc78279e4f3973c86d9f08d389f6b5734b6d5682ecc2f74da6d6b6db3d90479517209f3bac6f2edb6fa8175b7dac5edb4c784006343e1920e713536d8941dc8e7773dedd662ff680a5687bb027465c9475b8fbd557d06d23705345feb4ae86604d477386d319620a72e0e0c22a499cae18a76b5819efac4c4eaf65d6747c67e27ea5f96abff3cbbf04987cec4c5d3ad9e63b5cac97adf8966df8976cfe9b4ef828c552b7b83edcf0c1ff9eac4032f4f1d7d767cef0385c191624f0533142650043b78461293ab723c4dabc793d977974ebc75e1839f9cfdfdbf9dfccdbf9cf8d58f8efff21f3f7be31f3f7ff31f36a19bfcffbcf3affffb7bfffafffbf0277fffd92f7e701c3fb2fff6dfcefdfea767df3b569b9d4fea2d3669208489b060d3c0d3ec88302bff0c6392782c59201304e7e24ea756afcfcdcf35db6d23aed66c080abab6eec67e25086a7bd056033adb6a17d76fefb5efd680f65d01b190c281243578538bb320282809ce4da4096c63963c5e97195df8b9a2fd3a381750115dd16565d74b12e5a582963705613238f92b61666525308257d4da1961d7c22f8ae5b031d4571d1f5999d8363b367661747865dba4daf34079ef13e53d4f47534f15763ed377f0a5d187be36f5e4b7f73effbdbdcf7e6fff33dfdbfbf8b7270e3dd537b99f4bbda05d26693b6db5d24edb240d17d7a8b340f50be9caafcf7df4c699f77e7afaed1f9ffadd8f4ffde627677efbf3b36fffe2ecef7f3dfbf1af663ef6f1ec275e98594bbeb772f29de513bf5bf8fc57331fbd79fefd9f9f7de72727dffed9b1b73f9e3b3d5d5f6e39d85afc2e43242c9e7cb416930fe024292198354bd376bbdd68341697969234c1c491f455367f04bde4d89c79bbf2dda520547584a70dd3ce15443a07a60aff07b3e0dc837555a9d5992bb0c6952daf0ad6a18a8f85d66247fe11eec6045bb1af40a4509fc1909b86e4a6dee8f68682158b3563a1c07298b93031619a50da2165d3481a455ee9095787fbeb5363d9a13dc5471f9d78e6957d2f7ef7e04b7f79e085bf3cf8e25f1f7cf1af0e7de52f1efcfadf3cf8d5bfd8fbd437470e3dab067753798c741943c7494769a2d005b804073a5616bf5f1fabcfbcb370e2a7a77ffff373efbe39fbe1ef563efba879fa78327d2a9b3993cd2d7063915b8bd45aa2e61237177d12394dfc563e6babd3e9f2d9f6fc89da854f964e7f347fe2a3d993c767cfced75762c95cbe109e7c22b2b626c2de94420882597aa4d0a9d369b55ab55a2d4b33c59c2609aa116a6d020cd2059aaec1575a136fe94bdd52eddbab0ccd37355ce38eb7039149338723a0c5168c63b2d62a1066b706727e56f8e4603ca54a581120790e88b8a9df9b117d3bea9aee622cd7cd21cf723f12630027e2ac331631356b0e44c435be12bac172d25f6ef7f674fa068a537b07f61c1d3df8c8d8a14747f63fdabfebc1cae4a1f2f8fe68703b1507131b240697e5cc6fe944117e052141c08bba84ec02553f5c3cf9d3e3bffba7f77ff6d1ea99cf6ae7cfb517164dbda193b8e8b28ab2152d65cd654d17117039a0924e436722c98a644aca54b4f486dc5f50fd85d9fa52356ea662a44b22f124c45c722022f293231f845005af8f922c05e2387678f5b35e8aaa1b50e4733792d40d68de156e31466fb7d8e256aa434b0c00f8464878cd2132b4c5453f63aac62dcb1c8451a3deaad69b2bf5ba6382bd3a2e895de658589342438716240c09f03d90a37c874481c3fa5d09b4bd12e8054fbad702dd5c0aacd05580064e93d3227e474e03c1cb111b8514445cee633c0ca6435933cd1a96324b145b5eee98f2d8b6e19d93a3bbb7f74f8e1706874afde3145498a362a100671705542a159462160949ab4c9754c5122f53fde3e5536f9c7ff71717defdb071f6f3fa85b978b523a9609e78818c97c5983ff6098142a2d833d7186333c3964215583ccccea13f8a028954aa5ccb74ea7133ea2b5141f9e71bee5f70dae450058a94260d03402046a4889920b0caac69b45b1f7ffac9ccdcecf8c4b693a74f8967265d27a6ad05b5b5e6376ecd44005d1a301f9fcb9418d36cb5ad015b94497dec1d0d16072656241008750529ff9ddb8290f2bd09546714622d50ede6917782763703f25ae2073685ca8efc590a6b68194970005f823c22436c85f030b02365591ba50db365c9636509f7abc07725cc5e7b97abe0bb2622b8d496c9e6cdea672b673e983df1f9eab9f3c9f2a26b744297060e97211801f5731bfa2803eb326332e38c55f9138a980ddee705ca29b164bd9b46a1cb040a482b4b3a599262bba1cc588320e2bca2c4be61ae85e00963df39f461a59aad56bbd3c98c49d314f5917919040aade3b2a2db48621d6fa3d5ed36c929932b9ff7a0288da55e6bb0833954daec60b9c862ad856011e43189ff2382f52542eb353be5b210d1469aee64b8ed5ebb0d110350a81b43b8161c2c10f1926d1f5f9e79e7dcb1f7cf1d3bbe707eb95d4f9de932cf4f9ffc2c5904c6f01d6a1c4af1da0a06528a82004e0df4135550de3983fb2a25cee0f194624df06acea6d664d853bdfdb07988171d7acbd3b41ed03506b006832d2e2efa836096e1c52d58881acc28c6f75dc1bda5a09f82678eff2666ec0644ed568745616fcb1a0925568cc04e844d2177344e485c6eafbccd5ab4dec7faf75af69dfada4ab77eadf2f65e20eac6748d6089acd2abae73a6be787c69fa74757e396de2d540500ac5bb5574043822c4e0a40311c9315ba532dc8d54c9041557e8a3621f950683de7e2ef798a89cea62a2c29814ce72b1112b99b5c6db50074121080295072886473aeff8a272499a6659363d3d5dad5621e08d609224286646757cdf15dc750a7ae35d45f3ee947c6c601e8bbd4ad956262dab3262f146628d8dc2b7c4532bce3181885886b545bd46b7befe97e80387dfa47431699c6f2c9e6f2e2d99565b3b172915694c95d911833b7ee3f449c2d903175429da70907b26c3a13de5f183bd934706773d30baf7c191bd4787761feedbbebfbc6d6738344e3dfd695448d876b256133f70b453324c8a61560f98931846241f44bc04238382f546e3dcb973f57add18d3683450c40ce6fb0abeea5df8dc88829e24776858cc4268537f2c0626661c5fb24ecaa9532deb1a89ca04db31b3a21c300ee05b6d6a8b2413432df1fec10b90ef1f402100faf8182a52ae2b5d1e5002344c6bb1b132535b5a6856eb26b61a5706c94cca047e62ea22390b053460518e06c29e1d3d638f6cdbf7e2de47bf71e0a96f1f7af6f5075ef8ee432fbdf6e08bdf3ef2fcb78f3cf7cd43cf7cedc0932fec7cf889f183474776f7e3b663246eb5e3b8934946b41e1c065f97bd19e1755d66b295951578416cc178f29bcd266ac0718a5c5219997710ea067d6d79e86b760086093329c95cabd6b2cd2c8c256cdb30f51454a4194719421082019cf8e5448afcb38bc7174926468aeed700e5a01a6200c25501e3e05ad14e3af556a391b48d125c6e312d63f0b6005316ccd6934fc1117aa07cbc3408b7f7fcce87bfbdffe9ef1e78f63b7b9ffad6d413df187dfca5b187bebaebb16fec7beaf5c3cf7fffe84bdf3ff2e2eb079ffbe6c1a79fdc7374f7e8447f540e1c81d54ec4390f58755da5357ea104e38282380bc205a214ef6510838288ef1e6e44c13b31b2ac77d25d8c6e52eb80bc84a75d92662c1d534cb9105394f97f2da19d67276135682da02e40be0dd6064bb3967fbf7df9c74372f5ba31f9397427de8de9d2e01758b1012b1471a07421528162c598a8ffac31c5f72584e7952b148d857d7b7bb61de9df7eb43875508fef26bc72ec9fa4de29eadf138e1d2e6c7fb8bce789d1034f8d1d7c7c6cffb3fb1f3a3ab567bc77b0272a854a332e7942ce818fe8cfab822fc160b02c38e85c2b0f7905cab20c35945288ef1eee6eeff9f4baf3c3142f9985cda7e71740c824692528e8b6916ac7d53aa1e1a28e34311983770c5aeb42a10033c144792c224ed6c3259d6e4aac975ffebda9ca964466b6508f08877c2c12809c240f599a3a6b411ee480917e18812ff3df577e326394d651b1c04ae1da00b3c06890afac891cf436d237303930ba73606c420ff4b9a0d8763d09f74a30429521a9f499a88fa2212a6da7a107fa763db6edc02323fb0f0e6cdf5619ace88226851e58a900afc4b526addaed1694544a27690261fafc8513c78f43a8542ab3b3b3942f1d3819451146bf4b5077a9df8d6e61d0aeccddaf8d180f3a93f0a8cf380000100049444154c552114966935aab88cd07fc8b5d903865440913e7c89ba01f648082a8ce44de94425ea0bb13d0f56d75dc6d8718e876b02174939b6321c2ef10de08420ab37144d639c0f993872087600262fc91ae4038a575924e6ae09f385251a823bc149436aed1a433d62971c705868aa47b241ca05285b8445c14150a1c203a22c6f5624389751963826ab8082f2f2fc32f600bf65a11772be67257bcf3b1baf35d5ede23a6c1f86cca866d610f26c5ce1a42c85c7379b564d9ac345533556d83db09ae83246807e00ce3dd48ce3f82593cff0881f30a10ee02e476faf4ba8a7f3c48f0a4dc540ff0406118554ae552540c7548f99459fb9388c06cf80893037b3c1cd352bb3ad35cbad05a5aa446939c29e824a0b633c2a402661d299092b41872a970e20a968b4e85f80dcaa13b45ac280f7e2b26524a415347e29c03ffe0f92e5cb8000ae22e8c5d989951576b6d734f01f96e604da1bbd175de27e6b0067ce539445e927c7698bef8df4985e25aa36845b752a975a8850bb2f5146445dd7ae23cffd010201f3c0b85d6533ee70bfcc8c6d8e25582565d509edc28bc5240b5de52cf48dfd078dff058cf40af2e06e437c84063e30339500e37a518d6ca21a060a77aba36fbd1dcc90f964e9d740b0bd48e0b8a7ab121532684764144ac01560c7e71282ac0cb1c80614c051d041ff2a4c337e8859888ad58f8bfb9b9395c87bb74a4f50046ae8b77e5dbeb74573a26a28bfd7a531231be683d38670960d21a26f68fac8ab312f2ea1d6926945aac0011936fe4cf73c43e45b01dad89c82084ae4521dc13ac0d7ae9589b33bb3262e0d25a574929e23e2a8d96faa67a86274a8383aa5834ac3227785de54f8f38acc038f07f3e261085a5ee3a679bb3efcc1dfbc599f7dfb8f0d127f1cc027562a2a6e025b2b3f0983011c666d05117ca4506f3c05cc4008a88f242e2fca10e94261f244e92f985f9b985f95abdde6eb7f15e10d922f7c2b80a23dd6560ca7eda978f22ae9b23ce42092d94d49b15ec18f5b66ba7925ab6a498d1126670b4561949df4afc37938fe9de06b989e1189580bc2694ccbfaf1e61e2f05943bab2a3777867efc858a1b76c35764f1b1b221432813d5dc1cf5539456960564ce3f8eaf9df9efbe48d93effdfadc27c79a1716a84e81521af622ecb0698a0b5e66052c43374c2a47ded99a5e823c05a332021176985aad7aeec2f9f9f979d06e757515674194402622ecc888ef1e30cfbbd779b76726c2a2202684351340629fa3146688b7f68487b1b6bc8cf5709d54e28c32c78e14ec8e6a4cb80043f44043cabf8560390fbabfc2c5a9aeeb85795e99d92dc4ac4ba2c674cfde816d87c676ec1b9a1c2f0df4aa02b64ee5c9e79b766b526e4347442165a15995d6e9e6dc7b33c77f73f283b74f7ef4d1b9cf56e36a276989754ab0e9e2b936699a189bf926a060de53d766e8c343c3ac78b4fd307112e35d207e14999d9b2b168b7835880add5bb0c6a914a446faae41ddb59e373aee4e1cf1258451e0165110049820ca807a3b5378966317c614a61c38182920d20eafc3c03a01e7f071580bc7e298909747f8be35d0dd0c5852f11385aa7e1881ba448e19f0e94d1fbfd30ae1654c0f05bba2b18343db0ff44fed2e8f8f050303aa125aad1cf60634447340047b270b2c1644810da92e9d73edc54f57cfbeb770ecddf9cf3e98ffec54f5dcaaa989165400930a6151336e282c181496429cc327212047a029e0b224ad57ebcb0bcb8d6abd58286cfc28825a0a4e82a81b237937a0ee46a79bfac47c1d960013cd9197204fc81987954a1383146a589c76a2f0c4990b419b3ae7561ae79655878b853e52059c0bc9c2b014383cdf8ed899406c20c2eb8198af003abf3a7215ee4814e0ed1ab8e5c02ec69e856ba3c20580a0180993101374651c28a87b44433dca030a84c411090b5e2e2a71255247fbf7bcfae04baf3ff8f2e3638727d4f0a0ee0f29421309b544e4600549034d9218135beb844b81e9d3d3527d63e6ddfffddd1ffc6f6fffe31bb3ef1c6b9f9d318b2d49ac23f851051d849cb5026b3b2408fb8925af0f8a3b5927b12931b7eacde9d31756e6566c6ccf9d3997eb48784703ba67f9eb5be75c37f36ec4ea6e747a699f025303f8ba34ff620a45462815b28e4baa58307867ea5c2b934488030a0ba4032da4b1b8009683c531ad2f3361456f121787bc4b52572b16c1843104920475692d899cae8418b2cf2666dc363822dd8b9f3d74dfbe9e898746f73fb9e3e8802d95324d1d2369067e53a855a4c82f979f2b3af05b81b67194358ad96a293de5163fa89ff9fde2b14faae716a595684a99324b46c482404e301a0b2946e42ca848a442cd8a3b9dced2d2f2ea6ad566b65428b5dbed344dbd76447edcae7437633fa7bbd9fff5fa86f5378a315b7811630c56c4652e69b4db2b75d3ec048e55fef78bba35b9fb45f8862959f0ede5b5dc2ff4cb0f0e66f8af4b3fd07103dd924b932c8e5870c6d343aa77efd0e493bb8fbc7cf88967761f393ab2735bd81f254c1d47869cc345458c2290cf3700a7c8b7c45be97624d3a6f1ded2997f3ff9decfce7ef041f5ec055a5de6768363ab2c2982bb05a130ba5f6f901286b6064e8eb55aa9ae9e3e7be6fcf4f97abb419a1bcd26160235012c0a6260f34a217967e155bab33dde526f9be7066f6fad8b3b691a6769bd93ac34a4110799d38ec85aff4cc29204e3f3da37c4fb897f9407b010c8c52ba24d0560e15ab1774b4c4e345189f4b8ea3fdcb7e3f191fddf7ae09997f73dfad0c8ee71d5879fcea9833d426b15a00fcf27f2df39ab04c94c4b436567e39577174ebe71e6c3374ebff7eec2b1e96c390e8c2152be1d165ad0880984640c0d126a8d31696575f5ccd9b3e7a7a7576bd556a79d19fcee82725238540846f1f25dfd40b3bbdaffad752e4e3aedd82556e337ba66a61a49944ae829e8e0f000181d1a2b01fb98b083e144736b236cbd36dfa08b6e7937de5415190048b0019fc483a5d8cfcf38496d60a4226a948a53d4f760eff62747f63d3576f0c1819d3b0aa383522999481b9086c139261c8e3d140c036ab1e0254243670bdc3ede9c7d7bfad35f9d79efd3e5130b6ea5834324ac86c15824df81152b6cc09e6144499a2ead2ccf2f2ec017d61a0dc45d95510a7465c47237b98805c5105f0cae3231a14eab4399444605f899ae91200e2c2bef2a283fffc1f89e7f8c75c0b7f782b0eebdd45fae3f188afda3726925a8e881b2f57c2473d1f34f1466c362853287bd36cca4e27882fb0ef74d3dbdfdc8f3bb1f7e62f2f0dedea9feace45653edfcb68a064a5839ff082af003302929e74aba1566e75af3efcf7cf6bbb31fbc37fde94cb258736d4382ed5b046cf72603bda23012a2eebb98f9f979bc084cd2a456af13b3d61a15240fb9927737fa2229d89d19f3fa72103173bbd9a1d445b06723b5cb0d536d51626071c70c0831a112ad075e17eea76f816f0372dd10015e3be4fa2f1474bf08f9c8c30903a4a24053801fe70262cd96c38c0755794738faf0e8bee7f63cf295fd4f3cb7eba1c3fd3bc7545f64b512b0106022662125b8a81191220670587455db3c539b796ff6b3df9e7effd3b9d3338de5367c61b7459758224cdcac37ce9c3ef3d9279fce4c5f883b6d9319dc82f372c1711040a79c0708770feaee757d933dfb3912a33204ec110abe2db13ab638089a95a6adb55d27138bed8b85798d85844a003ca26f48f75f00b7362bc592cfb09bb5aeb2f8a4086646a414e99039640a1469bccc0b58145e048c50df819eed8f4f1d7a76d7434f4f1e79786c7f390d2213684f5b25f083cc44acc0c2a8a061922c4b6dd29278c9d4cfb6e63f5b39776a7576aebdda92148e5014142190cc5947448d46f3c2b9f3674e9f5e9a5f483ab135192e2ae8ce39873aa80030333c22841b032d6f5ce92a35d455f2ee6116a6ea9ceb2e435756c4ad6a031bf144cf3037d26ca5d513968a6141c44f11cb86da24ac950e80fc407d0ff5bd3814d6060afbf514284548a20c3910ba4012a5b867e4022af86f9f643f11e32c802cc952ec9fe823b30e10451430e15d20dca370487a902afbf4e4a3a3fb5fd8fdf0d70e3df5c8b68363d1406894e680c3d08238498c27949db0750a3609438994ade8559d1e5b9df9e0c289f9b85633b854b3288a53fc9e8c53a1df82dbcdd6dcf4ecb14f3e2f45852c4eda8da6d70c3a6d8273cefabbe0a6ac5cbc4ae4cd7095ec1b66a91bd6b8e715188630edc43592027e23899dadc72a156f3f989055be980cd38873e22c2adf730d6f6a40af58be2a5ed868a1f21462a508202aea2062eca47e2e99cd3a6912a76992a6ac951600af0cb94c3c4e3d877a271e1bdfffc29e871f1adf375e1ad286f10281c2804a05a535fc9b12bf290beca224d31207ae13baf9a436d75c5d8e1b31655047f9c081d66265766666717e3e4b92b8dd49e28eb3b83da30a40d709f904ae537ecb45ea965bdce506300013776acd78b551c83868b96ca5ad63092d54cd8197054cce390b3f62e02beeb24277b07bcefbca63663f17b87fb091c4297291a248ab305041a0f1c6ce66065e9113a3621365d2e782a9a8ff50efb6e7771c7d72e2e0aeca68c906201587910ef1ce4010c80958082e6218ec19965dc66eb9d3986dac2cb7aa096a13310291739224c9e79f1f3b7ffe4296a4ed560be74267f03cc3fc74fd70e31ad76f7f45290c7145de179c81394adc6ac7d56621e52816aac6518c5f8d29b03825e1aca4606ee7ac58230e1444fd2f58e3eb0f0ffd005f878900f1f75247644912c9ac64cea516bf6268a64031fc133c9a66a758855a47611846a10af0f3490f17fa75697bcfd8ee818989de91dea0a89d777be8d2651913582708442482c8c3b1246ceb59bb91b4534fc1b502d0ae5aad9d3871a256ab69ad3b9d4eabd332843b393af30defe5e7fea2202c0460fe30a869c7de01c0ff358daea561072ce4c02945ca3fc978d8d91180daf73fd82faf571317022647e01f6167acc6cdd9a4763e59994dab2bd46e9169520ab4258bc9a48c274c8cb5193e56fc1542540ff70cf60c0cf6f697c38206678c511697642671de7438e6f92fc218ca0a56d7b0ebd8243199751856c2c0ffabb176bb3d3d3d3d3333639dd561d089f1a0a38578c37a2defe9074aded3f16e3498c06cd89e88c426595a6f5333558d3459a82bbca98e9d32a449f94e98e15158b197efbfcf66b54009002c72f822bfd296c4906dc59d8556ed83c533ef2c9e7e7fe9ece7f5d9f36e75893a4d4f3e95053ac62f734a3a5a92804cc816f765554888f1e3af65163c8c2cd80a6083102f6a08ced55926ab3c19311413434a6d96a1043b3d62f2363369b6b4b878f2e4c9a5e565f0324e9256a70d7a02a2f064d33d0ef972dee331af3f9ca29c82e48c692dd7d25acbd43ad50bf3dc360a3f99586f4466060f39502a80feb036dd5781094a12a6419b82b556e0aa881cc305ba540c167ea15dfbf5ecb17f9ffee85fcfbcff93331fbc75ee93dfcd1dffa476e16432bf40ed45ea2c53b2a2b29ab62b6417259b91c647b5b31fcf9f3fb3ba50cb3aa25969b6209949042e13576be5f08c92c6560c90c050d8cf0b615488fc154450375d595e3e7efcf8e9d3a7abd52afcdff2ea4aabdd86c63887da9ca69bb4be172296f05e0c732b6330c1b931ce3994745253efe87a66671ba516153b7867ab9453cc9a1881f49afa4ce42178ee7381899578cfa30c7900001000494441543091905f75a77c2c3909e8d603fab9ac11baede6f8a23c81a8dbbf7835ba851763072f959fd49c609dc1059ba459a3d33eb33af7f1d2d9df4c7ffaf333effddb89dffedbb15ffffbb15ffdf4e46f7f72f2373f3ff3fb37a73ff8cddca7bf9afbf8e7e7dffdd1676ffdc37b3ff9f5f90fde39f7f1e9a5f3cdacad02ad38c81263f13e9fbc2284e9faeebd0a5086452a4af70785de4225a4c8394e3ae9cad2d2d953279697e6db9d66bbd35e59adc25a80d68a3c6f2fea7c6fa4b535bc3783ddc4282cf073ac3382abf036358d44adc493dc5fff78263d570d40442e29c6ce84638cd1eceb10615bf28020f8ce93915391632d8a1453403904ee81ba2de81682e44d1001dd66dd1c3836acb822f81febb0f05a65e2ac6251ec5055112952caaba898c230201634d7ac99b81014fb7a7a2b6584e2f4e285132b673fac9efcd5c2876f2ebcfb6f67defae1f19ffce0e44ffee1e44ffeebf11fffd7933ffe3f8efff8ff38f1e3ff76e1973f5bf8fdfff7b77fffbbb3bf5b4e969c32624552b8c2822ef6d9c42acb6c1cbc62210800ccb4a8d5b80a0ef68f0e15fad294425d6cb69277dffedd89cf3f7afbb76f944bc1c2e2a20833878a0313a750191ade637c21835e778ed886fd4af9e512c27b052bad8c6a49884b49dd483da58e61cb14e0fca3d191f8071fdf1ec2e493ec65445dac278490f689dbfcf8d672495b9f936774058c0ee6a18af52ab11388447e1e94079fc4079573b062a59975c01250acb3baea2c4a6d3a5b3a97cc9d49667f37fde1afcfbff7ab0befbd79eedd37cebffbcb0befbf75e1bddfce7c582b76da6192e8d42a27f0727e001656a435312ec8e2ff622fee1ef97fa6a760f5f6dea1d1a8dc17564a512549697676f1fcb9f3b3d3d3a56254afade2464cc40a8faa3f2610fc2074a37b1bee3f0a8245f028803784a459d6e9749a8d46da6c27d546bc54cb569a3a751107ac752ad6efb03880b3e0050496042b82d8c299e6992083c2b23b22c092f74e48fa9eefd14772220a09b37f3eb0c090313604cd0a41c45931860ce24c4c4a2666d301b469aab4469daa6b7950bba993365c957689928cf15b3059255639a7014b0526bcb929e872b9d213962b521a547d9395f1ed03a343a59efe42a548babad2f8fcf3139f1f3b393d33cf0a2e70b9d56a4119a06b152645f73c7c0143ded41cb160793df8924e276e375aae93ba5adbad34dd4a4bb5d2108e50d862ed18d6f3f02b4c5e2012c702163a64315c039847e4583b061d39eff6ee45d2e55c1e63948de1180169828a281345ac94d261e0f7c050e11520479a4226ffff22645b6029695764134a1ad84c5b1b3a572429aa945da60414b484a39dc0ef11ae2000486c70bccc4c6a6cc748d3163ad190eadbde3f3654a85428b2999bbe30f3d9e7c72fccccb793acd16c57abfe3f9cc5385d5b5893e00bad75b98ef73452f774b49b1b8cb13cec03088516c638d3498354a244c27aa6ab71d034a1614d9a58a1021156549488766821c41e602120e4534abafc0305fd5191ee72b8c8c25c820e181093626608791e1e0cd65a2bad8252a44a211702ab09ba1ac9629bb4b23821934896ba34b3716a3b994b8cc31beccc9035e21c09409839ba44b78a0b7d3dba54448e498cc45496ca546562ffd0ee03a33b277a0622a2eac2d28963274f9d3e576b74848385a5952edf02051b8279a2b5f65f74af0386bfd7436e1a0ff6db945a13bb4b8645f2e9b584218e4d14bb62cb86b594563baa6502d14a47f02a20df063c0be16548b01d4bde3d222504b0ef927da777f323e255eec61807028644acfce8f987d662ad541804703c0ec15ab1024746e08575c65a1504eca1486b30556b501650f07d981c0661c1e3a4b4534a3c28711a178e940ba91e09fa0f8eec7962cf23cf1e7ce2c0d88e91424f5a6f9efafcc4a71f7f323bb7d08a1378c1d56a9d88c24013c80c23e20b9d22eb4e0053bef96ed4cd57bd0b35fd6a5dd9ad901367c59b66ad9085e26ad3553baa1acb62d32c34ec6a8763174aa01deb9c615a2410410c8070dd969c1b37b7083bc26e8c749eea16df83389f2286ec4230bef311928a157855d05181a22220a1a288059b7114726452e732279923e3c438975924b1c912a661842db355caa8c00691094b264a179ac5168f71dfdecac483a3fb9fdaf9e0e393470e0def1ce212b5939993673e7af7bdcf3ffdbc5aadb63bf1c2e212b4c0ec9db3d6e2f5033a15630d72ee08f249df6c4f5f2c05afd412ca6f00cbe5814a4c94b5b3acd6a65a2c2b6dbbd444ac5b26cc08146441795e4bbcb703ffc0bc3cabdb158a3c045e030e282ff0e9bbf6917577d215360fc8020d88f20a8a392035d13332591ade160e8c72efa02b55b2a890e82056051b45360a5d219428ca11880e5da0330ead8aac2a185d3441d9443d59d41b47fbca938f8e1ef8cadec7bf75e4b96f1d7df62bfb1f7f787cefce6058c7a6bd529f3973eed4e7c766a62f743aed244dabb5aa0e3038f91d9d447915056a317be9ae19e6ea1ddf3d0adef664bc2d2e53167d41d1acd969cc2d8385e5846835360bad42aad85266acb00e8ac5008bc5d8ad746fa507c664cfb9b59e9c884777f1d7f2b6f425222a0fdd5e2042b008e28cb5c6596262a5188148b37218dfa1111e04f649b28a787befc428f53e3bf5e0c3837bf704c3872a5347fa76eeeb991a91de513530ac078682fec1a0bf4ff596a95c70c58209075565904a83521e563ddba2a15de56d87fa773f3c7ce0e55d4fbcbcfdd197271f7ef5c0335fd9f9d06343bb0f86c3519caa8e3d77e2f42fdf78f383f7dfabae2ed71bb5d5ea32d8061df307015a93f31b0ecc0ec1c73eeb1e7ed45d1beb0e4f86a1a811e9186a65dcc8827a1a56135a89830c4453d8b613eb52c113adac934ea783ea4809fc21ec8dc4dd82d7ebaa7d6f9e7fb7126240819be43f9043e2c3c33b9fdc76e82bbb1ef9fafea7bebeefa9afed7de2e53d4fbcb4f789c7c70e3f3e7ef8d1b1438f8c1e7c78f4c043a3fb1f1cd9f7e0c8de4747f73f3e7ae08989834f4f1d7976e783cfef7af8c55d8fbeb4ebb117773ef6fcd4238f8f1edc571c1b71a53eab2a18a5935617573ffff4d8d93367b234b626ad5697dbadc6554db25961ba8741ddc3b16e7328210688d811a5a94beab15d6dbbc516cd36dc6c5d779c12ed4827e212728671a67749db5310eb2c445d1642a6bb123002dd4ce78af320be2e930f4c1c913ad8b71d147c65efe3af1d7eeef543cfbdbaefd9d70e3cfb9d83cfbf7ef0f9d70e3cf79dfdcfbdbeef59e0b57dcfbebaef69e0f57dcf7ce7c073df3df0dc6b079f79f5c0d3df3af0d4370f3cf5b5fd4f3d3ab4efa1917dfb7aa746555faf44656c0b4449bb75faf4b9dfbffbe1a9d367923469c78d5a7d89c8923f517a1d363eb22141607cee1dee3f0a62fe4c9b2ce2d34260a1727ef928692569b5ed969a345797d99a5a4d8aa92aea4891c64692d7610868002b827f8e05b12041be177447773c747bbf7eb7926bcf7e7c45fe0b9226eea5689cfbf644e3070bdb0f17b61fadec787870cfe323fb5fd8fee057b63ff2f28e475ed9f9e857773ef6b59d8f7d7df7135fdffde457773df1f28ec75ed8fed07313479f1a3bf0f0c0ee2395a903e5c9f16060887acb383e5a1509e33792767d7576e6c2479f7c7efadc4cadd9eac4ed7abd4a04fee122c33071d744d05af0d98ccbd39bcbeeacec7b533ebae90fac76d375b75af1523bc05c9e828ef2d762add4adb479a119cc3583f956b1662a695094909c22239a5410444c0c0d3cf9b05143a23c4d5f5860f6fa6078662f28e21c24c6058e0aa44aa42ba4fb5d38e6ca53aa7f070deea4813d3cbc5f8f1c0ac78e14c68f44db0e1726f784e3e0ebde706c971e9ea4de312a0e52d4237a30aa44a435058ab50e8224ebcccd5ff8f4f38fdffdf093e546c792ae359a8d568dc915a3509c65a89263ddce4c9ca7ef79a46e69c47575afd2e80eeb7f4977e01f3bcf24cf428cede2ccd6dabcd20e963b3c53a7d93aad76c294220994e05519453a441b923c227cd375344787f7089ccf4a089b72774445ac9074ac2c29e3709888322edaa0e2c230716122512cc55815632e25aa6c8292090a69186521eec225ab4b968b86c2cce9cc452af0bd0bf98b91b866bd3a73e1ccc913c73f3d7eb2daec74d2ac5aafe596708a3dd9d86b00fbe05b11014cc2e44bd622ba570163df99a1eec61aaf9bc46be8447216228f6ce26c4ba81e177029596899b32bf18565554f8b4e17446b4b6c9d12f655d134b7ad2086fc05614d138c7e51a93549879a342310b16266af28e3a8a65801cc9a7db606b51ce139d49643c78170a03cb482ddc53967acf3af52336b8cc9aacb4ba78f1dfbecddf73e7dff83e595ea52b5b1b0b2da4912f2419224cef5410428a2cd602226f449f72e60f87b37d8ed8e0493ac819522668714914d85130aea42f36d996b05b5ac023f41018a3393897fff92d713c23a31d24c0210e56626e4aca19b233e4709038c7a6bb568230824b4447c299087a24bc03e857c546462c6d71540a6823ad00a45798214e3059d639c639d712e8a54147184cd35228e5847d85d83402be4042161c725b442dfde1a62f1782a4f6047aedd69cfcecc7cfef1271fbef3de27ef7f084e369b8d4e7e0b2e140bec9b91560ac3de27d85085ef1385c82f1f760caf4e2ee611dc02ced1ded456441c91216a5a3a7b6159da4a5529bbd06c9d5c886756546254a86c48125150d045a5232bd8a74256f8398c02edfba59c6d440a022079925993d2e463c5584e455827806923c8864468cb609a38678cf740608f2589b3342741477bb6046491adad25ebf207c2b717e27c3892006331a62b6808082819288a34a0226ccb9e88990860c4650257e71011113a34c659671132e72808a3525988529711f3c2fcc25b6ffef2dffff527273e3f35323872ead8678dd545220775e1fff07009b31101f901e4a3bf75c0aee806c020f70e6a7da87b3df0fab837f30ddd3603cb46b0962508dc5c6e9a6a0217a896633757b70b0d6e9b0207ceaf9760e5c53ab1569c07a11dfb5642e0cf3ab0380031fe50f79317533748f7ebea3177b37d9f248873f8bebbf99b6274036c64e463fbb32a323780493926c7fe1983ea04ede113c921a79b643f08e1390a03a51182400501f604ebc051d389e373e7cefdf6edb73ffcf0a3a5e5955abd397d61161a32ba24f48d71089f0da0ffab6143c77b246c50f01e8d775bc3c08cd76c57afd592464b1a312d37ed7455a66bd16ad6938541aac8b165362c869cb586f063a8036f8940388573958740cee1d85776ec17898830a4bffb60b9e80b09d08baf1ae24e274b52f15e0c8a3138188188988250b55afbe8e38fdf78f3cd77de7f7f6e7171a55ebfb0b0804af739be1414bc0e11e0dd8c8b136a26bcd2d10bad60a1132c26bc9c4699d60edb6f4841805d53c047f00f50e2f9856501cbba800c807c8c4a1e42042f858a00dde5d055e19258bc8297e4d0c51c900f30a9b1060f1536782227620539e7cf5ff8e8a38f4f9c3cb5b0bcbcda68d43aed8cd69e28fa62022671e381bf1414bcfe34c4a619bca05a8d23306f21e1e956e2ff95096bb09043c6e91d5b97c6c2c2275a2cd845c3c8e53d0b531728403550105c847c9780212eef192a5d25f762ad9e72b9582c601316072aa23659eb924e327d7efa83f73e0005576b551c10579a8d6abb65c83f51171bdf6bc9ab77c331ef1bf93bc700001000494441542f0a5ed7f8d79c0b16236bc6e96acb2d77dc7c2b9b69c4e76b66a163ab29c5a29dd29c5f303461bf422fd8c408c6017c822eca4822e55928c29e8a48e579773312c2ac2f82d7928aa1f4e5c0d62c5d5d1466a4586ba44c9ad56ab5dffdf6b7bfffddef8f1f3fb1ba5a6db63bb566b393611628bfdf717f5170cdbeb762b46e131132b18d579ae9725b56535d73edf3d574ae29d5548385821563d2cc5ab1907204f7066807827a2801e524271c62e713ec849ccf4103ba8f42666de6c4588b47046a654972fefcf98f3ef8e877bffeedd953a7abcbab4bd88697579c957c26fef942b5fb19f717056fc3522a50bc3e0963c4764c94a85e5b30b34d5ee8e06a526c5121a1c8c16368a53c05bba4f2ce8eb08ea248404180fd4dd4f963a0dfad2527a260216f43abbbd7c43f458a49b3c33ba0249e5b98ffe4934f7efdab5f9d3975bad3ee38631bb5bacbb003731885b9f24c77356cb9fbf5d5bbab5a5eb7f32d4ec159e7d0bf62dc7501bc855d9e5d5a38311dae66e6cc6a7c7c31986b979b14b4446554088b0ed51579e2060aecc34d05ef7b0b51a8c4818bdeedc1f9e52e50f2187bdf661033c0d8d1737242d05a83d9504144f0a22e491283470109113f96f3dae99b3173ce17f4b30111df037aeb02bd39c133c3b149e33431ce2ead2cffe6b7bffd6f3ffae13fffcbbfd4aad5f9d9b9e5852581fb264542598ab3b0926b848d51b62a5ca1f6ad767833b6b9d53e6fadfe56a720c404d67401dfc03636d448c35a56aed9c24247ced7d47ca7d251a524b08d4c796689156704d7638785cc401c6bbc53f40b0cc6081156ba0bcc0549c4770b507eadeb8b92cf6062b877ad340233232b57d340f330807b9333e7cefeead7bffeddefdfc646dc68342e5cb8b0b2b49ca6090b9cbab7099a7c01f09adedab05f3c0537f4bd75e57d53b4c21cb05cb03ae8832c9b1a5c9093b955bddc89961277ae6a4eaf067349b14a1aa414783db84185faa80cb619b12022e49c85d8878505710e5aaf45d70e72eda29b2bb9389ce4837663f24363769a55a88328080b6114859188ebc4edd3674efdfce73ffbd1bffce8d7bff9f5d973e7eaf5dadcdc6cabdd407d0073430c48ee83e95e06b9e5c1d42db7b86b0d6e5df9b5458203c4c2f80489780746e2c4549bd95243ad7482e5c44d37d3d3ab34dd2ed6a462c3128511e3e7858894268605d83a0cee19886523df11430008d974a3e0ebdda8cead97bbabb1c70fe5dce913277ef6e31fffe4c7fffefefbefcdcece827fcd56334dd3ee209a35b3af8824cc81f83e0716e03ed7f006eac1d8e089b735a6021036d0fc542714af369ab3abb49246554b331d77a641e75ba5ba2db45d295345095847a4435afb277868dc05ba5c734c84a3a267e40d74b81bc5ccdced76838bd6da5a7575faec99f77ffff66f7ef9cb93c78e356ab54ea70dfe359b8dbc329e27b48231fc23851c5806f17d0e18fd3ed7f0e6d483b185b06a5a2bce83d69a88e366a7b3dc54751bac1af8c2e4f4727661d5ced7b99e0689840e0e2360dc4d54409e6d38bce34e82e3222808cb00f445850de661365d1d9acde6fcdcdc9b3ffbf947efbc3b77e142dc6a6549dc6a36c03f6b8dc32d9e70bab546f0c226a720131c62b7edfd1c7f9156be5376916e47d88301c206e62c3b8bed195b2b71bbd1aecfafc60b0d5a8c65ae5d3f36d33e3d97ceae4a2dd6890b9cd2a415f8e74f808af23786941fe81d0e66b8f9763bbfe731282879b0d642aed7ebc78e1dfbdd6f7efbf31ffff8d4b1639d7a236eb5aacbcb8d7acd59680afde0fc08a6c821f984fc810405f73960f4ad6af805b687b919fce15c05248440407c1396431c07411445b870b4b1572dd5a8955512959e599573cd602e2eaeda52538a3185d6ef5f7eff66b421ef4b4529d1ca05ec34cb1a0dd1ad602016cf4c822884ae91e8c2d35d4063f163fb6242655f01b5ae87bcd665157c1eb38fb32c6bb7db8b8b8b274f9efced6f7ffbeffffeef9f7f7e6c7171a9ddee54abb57abd633382f63ad079c00e80aebc62cc5e2124ee7f7cb92908fb1aeb0436bf12587e63b22c051550989a7471766efeb3b39332d2b710649facb43f989133d572c3564815a3c0e04ea2f062d192b59459ce40cda02091760a5c400f205d976c440e40aec232b3ffc77b8e9563b60cd76b536b1c132b854ac48c2744616f87a257c0f7894c34b43649126bf113361a00844f10047082c698d5d5d5f7df7fff873ffce1bffddbbfbdfbfefb38df9e3a3f7dfcf4d96aa38d1e94562c6c33b436d61a110c8b6c11b846ff8d01ee777ce929782d03b350ee07c04f112488108126b5b34b6a391b4e4b83ed309cefa4e756b2b93a55e3b20411875a85ac02664d5d567977865d59982e09be2ba1bc10250021853406cad14d12f912ba7eb0d62aa58ac52238879a02f2589ba6298476bb8db77defbefbee5b6fbdf5de7bef2d2c2c10f37215dc6b2778fb8df1889c13000d73408b2ef2d40da29b50ee063ddc99e23f580a5ed53cb07aa3bada5eadd95a9b563b66ae817d393bb56ace547b6a5c6e72295145fc94a7b5d512ebb4a31261e72f29022212818a827d198e0776530c461062e45397ee797cd591af99e99c0305516cbccfcec03cc8e0259cdff1e3c741be9ffce427bff9cd6f4e9c38010a56abd595959556abd5ad869a1b02e45b04c87a8b2dae579daf5778dd3298f2bae57f70853055dc6cad4e2fd4cf2fbab966b494aaf3cdecf88a9ca9f174133feb4531058e19d4c21ecbd6b11338bdae1dfcaa8182cc94c79e8e70ae482216cf3f5fa15bf566e32eff4044ecc559e6375408f57a1d9b2ff8f7f39ffffc830f3e00ed4050dc88a7a7a7c14ed08e99d1103186410c40b893e05bedecd667be3ec21f1d05832074d6c5b5567376259badabd9766136294e77ccb125395d53732dfcb2574828744c4a53a0f0dd052846dc7578205c7e73968b314a4054c4745b017cc2cd09317e6a83c3fbddef7ef72ffff22f707ea74e9d5ac6b517b939c03f740fc20120228024623484702771fb8cba652dfeb82808c35a71440cae4862e3c57a325be5854e7955f842534d3769bac1732db512474d1ba51ce0522cca8172ec7f7d2622621112647832126829b9e03398d857b8c50f58050ea1110478bb8f3ffef8a73ffde90f7ef08337de7803b760783e6cbb333333e7ce9dc3d110d598fd28ceb96e2be400688bf84b8a3f3a0a1af840d088b1d1325b49ab9d6cb96517dbf805452f74e442333bb36acfaeaa996669312dd65d68357967c79e604c84b60abbb375ca0a43e86ed32022ca509813846e2d8064b3b3b39f7efae99b6fbe09e787c31fbce0dcdcdcfcfc3c5ec72c2d2d615f16309f28080208c0ad0d707fd756f7b77a775a3bf024073c195883de7180cb5a717bb91625a21b86973a6ebaeeced5f574bb34975556a592060513444607b6fb72055c10c7ce2967734086334457de2782a76b099f71331fb0aadd6e9f3d7bf6f7bffffd2f7ef10b9cfff00a1ad70eecadb55a0d3762ecc0e8270c43ad354e8490bb6066e400dde49737fef2531094ba9af9e12aae04813fa8ef21b86458f2ffb82e952c35e985b3175667165db55368889e8b93cf97e28f17d2cf97d54ca7549341571a50e5a20bc83852a48b41ead21409b6a249b412bcfd4381236c9dd8168d359ab4d23a4b336867e13199909fa669965dbcf6e2e60157879bc73fe7e19d77de41b2d3e9c4718c13214e8168db055aa17957eec6981d72806ef2cb1bab2b54c7fa5c91773f6708dd9ac672713270588ea80be426edb43abbd29c5991a5b85495d2b20b663aed4fe73ac7e6d333cb6ab15dec50850a455c52d0120db4a2305051a8c39095c6f1cc180b66c03f051a3f3a134218850c4f2b92a606c9a8500823fc6043f073b86ae0b6fb5ffecb7ff9d77ffd571c01b1e18291a01af66594a2f21f09aea4e0a625fa92d8e01634465500a4438cd9811c8ad62ebc8167b2a4b6536da5cb2db712f34a5a58b674aa2ac797cdb10577a61a2cc6c58614631524a41d7ebe633476564c1e2c02de133b87ef14bfcaa07ff27f75d91801b7b0632aa5c4b9248e71bdf8e8a38fb0edc2f7fdec673fc32f6f9f7df6d9850b17c042783e005b73defa8f22ba9282777bda7ea5eff618d7ea1f632bc1a581483655412e93b83c4b29b212d79af5f9950e7e56ae621736e5e5ac309ff085863d5b0368a6152ca63db12e7658e347b2b6a1c488df6b050eafa7b7b7542a816d8ec07482170c022e140acc8c3dfaf4e9d3b86a8076b8738082bffce52fe1f0565656f0da792e0f488ae49a6c52f08b13efc5c85ba620d6efd6f4fc82ed0b7d3167c49e8557eae2c01c0f9ba6abcb4b4b33b366a515aca685aa0d1712395d4b3f5fb29fadc8f16a65def5ae725f27e873c58ac2ef6b511068d6ecc4ad859c825ddbe06c870b07b65d30efeffffeefffe99ffe0997dfee690f77615c7bc13cecbf699a827fa02fde11761bfe31c4588ead4df3ca55dc5a7ff7a6b5a76077248103f408c202ad9f2ac124ff1e465cdc6ad7e6571a0bd574b1e9e6db32dd94d37577a22ac7aaea543d9cee54aad26fa23e5d2ae98819a4b371dcc1b60c2601599a36ea8de9e939ecb320dfbfe7013f78e0f28b83e0eaea6a9aa6f08bb88240a0f500066f4eae67ffc17e6f99825f36cbe091e9c22bbece3f1215100e838a8475a0b17bea489322cf49a64ebd5d5d58ad4f2f67338d703e29cf653d73c67dbe6c71463cb3924eafc68bb5a4d14a933831695428e03d8bb5162ff3e0e13efffc731cf57efad39f828210f0b32f0e7c78cf825208f8c10df70fca039c1f908b7f5c11ccfc4734e12ef9baf165d34e9298f24398384993d4a6d65780b70488d276dcae36939526374d31519524c8e65ac9f95afbe452fbf3c5ecc40a9f6f15175da5ceaa9ab4176b73e7a63ffdf893dffee6b7bff8f9cfffe5473ffac13ffee3c91327e6e7e6d2348d229c0c8b5966969657969757c057e67c0c1c50730540c428bf354381b502487f70d898da1f1705b18e97f2af9b428ccb0800419cc5591074206cab041e02c8464b26eb6cad563d7feefc89cf8f87aa50c8a27059e878d3bcbd28bf5e2cbcdb2a7f96162e24e77ff7d9db3ffdd50ffecf7ffccffff93fffafffebfffbdffef947cd6ab555ab2d2d2c9c3d7beec4c953e7cf5fa8351a84ab8fe2eeae8dee9d73d8bbbb02980a01e88e0ce10f0f1b53fba3a3e0156b09536cc67af9e6bccb6454115a5d5c692d3764352935a8bf1e0c54839e45292c9833bfffec9d377ef3ab9fbff9e9479f341b8d4221c23dc524c9e2fcfc6afef7ac1c6e3c5d0f009f07a0b72f3bbad3b9dd59dc3f14bcdd19dcab76b033007b3118e9a853ad3796c0c26a67a596561b59b509c4abf5d5a5e573e7cee147365c3896969670ecabaeaee250b8525d6977da5d3fb7a6f21f06ff30191804f1ed0226bddda67f04edc0b9ee2cbb02620026d3e46fcc94d9041bead24a7d71b9b1b8d25eaeb6abf5fa6ab55ef3016ffb70d5c5cbbee5ea4abd59677fb5e97696c77f30fccb67b39508f6dc4af33bdb96ef6c775bef6de3f1de10d027b4eca24b44ceac6dc569bdd95a5aad2d2c9d3a7ee2cc9933333333de05361b99f5bf112b9cfbb4564ad3facd03fdfc095d0bdc5714dcbcd05df5ee83b84b372628b701a8d5cd568477882a60e5329360a3ad350842ab95c6715e87f1fb31133b12630d6e33976cc48ca050ed8f037cad69fef198e0a82aafe600000282494441545a16b889fcaef536b1103fbdadd311df706dccc4dd8e74188611de72fb94d6707bb85863d3f5d57c163ea8d84d39bc9644fa8f04dd395f65b27fa2e066a3801d9b9357cafe2a025b02ccf8b5d9bb4627ce380b3629a558298b77cd598652f465adcd8c416522df909895d60029141282c3ed185f7fdcf8130537af7fce96cd195df962b697f0012c5e61534ec13cc60eeb9c8f7c0b48005df47fd88891ef8b2d76634b4e7c4b64fd09447fa2e08d5800ba6d8088692d6ccacb7350907bba3c7131ea56431a02e28bed7de24f1f6f813f51d05be13a1f500b36da00929b81864822f65e0d2c037ce21a9fb5aa6ba548016b893fe22fd8f68f78f6379a3a28025c566b734e5746dc85af0916025ef29faed88d7dfa4f9f2b2cf0270a5e61924d19a00eb029c38b97e574c9b711fb1a9b3ec8df94ba28227f031773ff28a53f340a625defec3a82707805b319c8013646e9ca187703dd2224bb42b7c29f4e815d6b5c19ffa151706dbdaf9ce8ede6e08d9f670f0875293050171b1d77cbbb49c85de13e8cbf00ddae6b85fb8282f79b51365b0c3cbb84821b65972a8d6a5d6c94dfb702f4bcaf74bb2f2878bf19e5921582729763fd7792bcde462136ebae8cecaed08d91f4e826ba315dbc4023c397fe117fee0b0ade9efd2f7543b7d7c7cdb5024d36e05b20e1bf363e486f6023f38642b7c90dabfdc157f81253104bf807bf3c5f8a096ed117dc9714dcc29cb6d0f44bb1dcf7a3925bf405f72505b730a72d34bd1f57f78f41a7fb92825b31fc9fda7ed92cf0a5a0e017b5bb7e51e37ed948b4357d6f9b82f77279bea8ddf58b1a776b4bfa656b7ddb14fcd3f27cd996fa7ed5f7b62978bf4ee84f7a7dd92cf0270adeb115bb9747933ba6f47dd0d1ff1f0000ffffdf461c64000000064944415403005d85b4879b8e18450000000049454e44ae426082, 'A-', NULL, NULL);
INSERT INTO `Jugadores` (`id_jugador`, `apellido`, `nombre`, `CI`, `fecha_nac`, `nro_contacto`, `genero`, `activo`, `direccion`, `lugar_nac`, `foto`, `tipo_sangre`, `alergias`, `enfermedades_base`) VALUES
(114, 'pepe pepito', 'papurri', '1234421', '2015-11-12', '0984222333', 1, 1, 'Asuncheta', 'Encarnación', NULL, 'A+', NULL, NULL),
(115, 'Duarte', 'Rl SRL', '565637', '2012-12-12', '0984222334', 1, 1, 'dffgdfgdfgfd', 'Encarnación', NULL, 'A+', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador_tutor`
--

CREATE TABLE `jugador_tutor` (
  `id_jugador` int(10) UNSIGNED NOT NULL,
  `id_tutor` int(10) UNSIGNED NOT NULL,
  `tipo_relacion` varchar(50) DEFAULT 'Responsable',
  `fecha_registro` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Seguimiento`
--

CREATE TABLE `Seguimiento` (
  `id_seguimiento` int(10) UNSIGNED NOT NULL,
  `id_jugador` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `edad` tinyint(3) UNSIGNED NOT NULL,
  `peso` float NOT NULL COMMENT 'En kilogramos',
  `altura` float NOT NULL COMMENT 'En metros',
  `observacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Seguimiento`
--

INSERT INTO `Seguimiento` (`id_seguimiento`, `id_jugador`, `fecha`, `edad`, `peso`, `altura`, `observacion`) VALUES
(1, 1, '2026-05-01', 11, 38.5, 1.42, 'Su progreso es lento pero seguro\r\n'),
(2, 2, '2026-05-01', 12, 41, 1.48, ''),
(3, 3, '2026-05-01', 14, 55, 1.6, ''),
(4, 5, '2026-06-09', 20, 58.6, 1.66, 'burro'),
(5, 1, '2026-06-12', 10, 36.5, 1.38, 'Apto físicamente. Control de rutina.'),
(6, 2, '2026-06-12', 12, 44.2, 1.5, 'Apto físicamente. Control de rutina.'),
(7, 3, '2026-06-12', 20, 62.1, 1.66, 'Apto físicamente. Control de rutina.'),
(8, 4, '2026-06-12', 14, 52.8, 1.61, 'Apto físicamente. Control de rutina.'),
(9, 5, '2026-06-12', 20, 75.4, 1.78, 'Apto físicamente. Control de rutina.'),
(10, 10, '2026-06-12', 19, 59.3, 1.64, 'Apto físicamente. Control de rutina.'),
(11, 11, '2026-06-12', 9, 32.1, 1.31, 'Apto físicamente. Control de rutina.'),
(12, 12, '2026-06-12', 9, 33.4, 1.33, 'Apto físicamente. Control de rutina.'),
(13, 13, '2026-06-12', 8, 29.7, 1.26, 'Apto físicamente. Control de rutina.'),
(14, 14, '2026-06-12', 9, 31.8, 1.3, 'Apto físicamente. Control de rutina.'),
(15, 15, '2026-06-12', 9, 34.2, 1.34, 'Apto físicamente. Control de rutina.'),
(16, 16, '2026-06-12', 8, 28.9, 1.25, 'Apto físicamente. Control de rutina.'),
(17, 17, '2026-06-12', 8, 30.1, 1.28, 'Apto físicamente. Control de rutina.'),
(18, 18, '2026-06-12', 10, 35.8, 1.37, 'Apto físicamente. Control de rutina.'),
(19, 19, '2026-06-12', 8, 30.5, 1.29, 'Apto físicamente. Control de rutina.'),
(20, 20, '2026-06-12', 9, 33.9, 1.34, 'Apto físicamente. Control de rutina.'),
(21, 21, '2026-06-12', 9, 31.2, 1.31, 'Apto físicamente. Control de rutina.'),
(22, 22, '2026-06-12', 9, 34.5, 1.35, 'Apto físicamente. Control de rutina.'),
(23, 23, '2026-06-12', 8, 29.4, 1.27, 'Apto físicamente. Control de rutina.'),
(24, 24, '2026-06-12', 9, 32, 1.32, 'Apto físicamente. Control de rutina.'),
(25, 25, '2026-06-12', 9, 34.1, 1.33, 'Apto físicamente. Control de rutina.'),
(26, 26, '2026-06-12', 8, 30.8, 1.29, 'Apto físicamente. Control de rutina.'),
(27, 27, '2026-06-12', 8, 28.6, 1.25, 'Apto físicamente. Control de rutina.'),
(28, 28, '2026-06-12', 10, 37.2, 1.39, 'Apto físicamente. Control de rutina.'),
(29, 29, '2026-06-12', 8, 31.1, 1.3, 'Apto físicamente. Control de rutina.'),
(30, 30, '2026-06-12', 9, 33.6, 1.34, 'Apto físicamente. Control de rutina.'),
(31, 31, '2026-06-12', 13, 48.5, 1.55, 'Apto físicamente. Control de rutina.'),
(32, 32, '2026-06-12', 11, 41.2, 1.45, 'Apto físicamente. Control de rutina.'),
(33, 33, '2026-06-12', 11, 40.8, 1.43, 'Apto físicamente. Control de rutina.'),
(34, 34, '2026-06-12', 12, 45.9, 1.51, 'Apto físicamente. Control de rutina.'),
(35, 35, '2026-06-12', 12, 43.7, 1.49, 'Apto físicamente. Control de rutina.'),
(36, 36, '2026-06-12', 10, 38.4, 1.4, 'Apto físicamente. Control de rutina.'),
(37, 37, '2026-06-12', 13, 49.1, 1.57, 'Apto físicamente. Control de rutina.'),
(38, 38, '2026-06-12', 11, 42.6, 1.46, 'Apto físicamente. Control de rutina.'),
(39, 39, '2026-06-12', 11, 39.5, 1.42, 'Apto físicamente. Control de rutina.'),
(40, 40, '2026-06-12', 12, 46.2, 1.52, 'Apto físicamente. Control de rutina.'),
(41, 41, '2026-06-12', 13, 47.3, 1.54, 'Apto físicamente. Control de rutina.'),
(42, 42, '2026-06-12', 11, 42, 1.46, 'Apto físicamente. Control de rutina.'),
(43, 43, '2026-06-12', 11, 39.1, 1.41, 'Apto físicamente. Control de rutina.'),
(44, 44, '2026-06-12', 12, 44.8, 1.5, 'Apto físicamente. Control de rutina.'),
(45, 45, '2026-06-12', 12, 43.1, 1.48, 'Apto físicamente. Control de rutina.'),
(46, 46, '2026-06-12', 10, 37.9, 1.39, 'Apto físicamente. Control de rutina.'),
(47, 47, '2026-06-12', 12, 45.5, 1.51, 'Apto físicamente. Control de rutina.'),
(48, 48, '2026-06-12', 12, 46.8, 1.53, 'Apto físicamente. Control de rutina.'),
(49, 49, '2026-06-12', 10, 38.2, 1.41, 'Apto físicamente. Control de rutina.'),
(50, 50, '2026-06-12', 12, 45, 1.5, 'Apto físicamente. Control de rutina.'),
(51, 51, '2026-06-12', 15, 54.2, 1.65, 'Apto físicamente. Control de rutina.'),
(52, 52, '2026-06-12', 13, 49.6, 1.58, 'Apto físicamente. Control de rutina.'),
(53, 53, '2026-06-12', 15, 56.1, 1.67, 'Apto físicamente. Control de rutina.'),
(54, 54, '2026-06-12', 13, 48.3, 1.56, 'Apto físicamente. Control de rutina.'),
(55, 55, '2026-06-12', 14, 53.5, 1.62, 'Apto físicamente. Control de rutina.'),
(56, 56, '2026-06-12', 14, 52.1, 1.6, 'Apto físicamente. Control de rutina.'),
(57, 57, '2026-06-12', 14, 54.8, 1.64, 'Apto físicamente. Control de rutina.'),
(58, 58, '2026-06-12', 13, 47.9, 1.55, 'Apto físicamente. Control de rutina.'),
(59, 59, '2026-06-12', 15, 57.4, 1.69, 'Apto físicamente. Control de rutina.'),
(60, 60, '2026-06-12', 13, 50.2, 1.59, 'Apto físicamente. Control de rutina.'),
(61, 61, '2026-06-12', 14, 51.5, 1.61, 'Apto físicamente. Control de rutina.'),
(62, 62, '2026-06-12', 13, 48, 1.56, 'Apto físicamente. Control de rutina.'),
(63, 63, '2026-06-12', 15, 53.9, 1.64, 'Apto físicamente. Control de rutina.'),
(64, 64, '2026-06-12', 13, 49.1, 1.57, 'Apto físicamente. Control de rutina.'),
(65, 65, '2026-06-12', 14, 52.6, 1.62, 'Apto físicamente. Control de rutina.'),
(66, 66, '2026-06-12', 14, 50.8, 1.59, 'Apto físicamente. Control de rutina.'),
(67, 67, '2026-06-12', 14, 53.2, 1.63, 'Apto físicamente. Control de rutina.'),
(68, 68, '2026-06-12', 14, 52, 1.61, 'Apto físicamente. Control de rutina.'),
(69, 69, '2026-06-12', 14, 54.1, 1.64, 'Apto físicamente. Control de rutina.'),
(70, 70, '2026-06-12', 14, 51.9, 1.6, 'Apto físicamente. Control de rutina.'),
(71, 71, '2026-06-12', 17, 64.5, 1.73, 'Apto físicamente. Control de rutina.'),
(72, 72, '2026-06-12', 15, 58.2, 1.68, 'Apto físicamente. Control de rutina.'),
(73, 73, '2026-06-12', 17, 66, 1.75, 'Apto físicamente. Control de rutina.'),
(74, 74, '2026-06-12', 15, 57.6, 1.67, 'Apto físicamente. Control de rutina.'),
(75, 75, '2026-06-12', 16, 62.3, 1.71, 'Apto físicamente. Control de rutina.'),
(76, 76, '2026-06-12', 16, 60.9, 1.69, 'Apto físicamente. Control de rutina.'),
(77, 77, '2026-06-12', 16, 63.1, 1.72, 'Apto físicamente. Control de rutina.'),
(78, 78, '2026-06-12', 15, 59.4, 1.69, 'Apto físicamente. Control de rutina.'),
(79, 79, '2026-06-12', 17, 65.2, 1.74, 'Apto físicamente. Control de rutina.'),
(80, 80, '2026-06-12', 15, 58.7, 1.68, 'Apto físicamente. Control de rutina.'),
(81, 81, '2026-06-12', 17, 58.1, 1.66, 'Apto físicamente. Control de rutina.'),
(82, 82, '2026-06-12', 15, 54.6, 1.63, 'Apto físicamente. Control de rutina.'),
(83, 83, '2026-06-12', 17, 59.3, 1.67, 'Apto físicamente. Control de rutina.'),
(84, 84, '2026-06-12', 15, 53.8, 1.62, 'Apto físicamente. Control de rutina.'),
(85, 85, '2026-06-12', 16, 56.5, 1.65, 'Apto físicamente. Control de rutina.'),
(86, 86, '2026-06-12', 16, 55.2, 1.64, 'Apto físicamente. Control de rutina.'),
(87, 87, '2026-06-12', 16, 57, 1.66, 'Apto físicamente. Control de rutina.'),
(88, 88, '2026-06-12', 16, 54.9, 1.63, 'Apto físicamente. Control de rutina.'),
(89, 89, '2026-06-12', 16, 57.8, 1.67, 'Apto físicamente. Control de rutina.'),
(90, 90, '2026-06-12', 15, 54.3, 1.62, 'Apto físicamente. Control de rutina.'),
(91, 91, '2026-06-12', 20, 74.2, 1.77, 'Apto físicamente. Control de rutina.'),
(92, 92, '2026-06-12', 18, 69.5, 1.74, 'Apto físicamente. Control de rutina.'),
(93, 93, '2026-06-12', 18, 68.1, 1.73, 'Apto físicamente. Control de rutina.'),
(94, 94, '2026-06-12', 19, 72.6, 1.76, 'Apto físicamente. Control de rutina.'),
(95, 95, '2026-06-12', 19, 71.3, 1.75, 'Apto físicamente. Control de rutina.'),
(96, 96, '2026-06-12', 17, 66.8, 1.73, 'Apto físicamente. Control de rutina.'),
(97, 97, '2026-06-12', 20, 75.9, 1.79, 'Apto físicamente. Control de rutina.'),
(98, 98, '2026-06-12', 18, 70.4, 1.75, 'Apto físicamente. Control de rutina.'),
(99, 99, '2026-06-12', 17, 67.2, 1.74, 'Apto físicamente. Control de rutina.'),
(100, 100, '2026-06-12', 19, 73, 1.77, 'Apto físicamente. Control de rutina.'),
(101, 101, '2026-06-12', 20, 61.5, 1.66, 'Apto físicamente. Control de rutina.'),
(102, 102, '2026-06-12', 18, 58.9, 1.64, 'Apto físicamente. Control de rutina.'),
(103, 103, '2026-06-12', 18, 57.6, 1.63, 'Apto físicamente. Control de rutina.'),
(104, 104, '2026-06-12', 20, 62.2, 1.67, 'Apto físicamente. Control de rutina.'),
(105, 105, '2026-06-12', 19, 60.4, 1.65, 'Apto físicamente. Control de rutina.'),
(106, 106, '2026-06-12', 17, 56.8, 1.63, 'Apto físicamente. Control de rutina.'),
(107, 107, '2026-06-12', 19, 61.1, 1.66, 'Apto físicamente. Control de rutina.'),
(108, 108, '2026-06-12', 19, 59.7, 1.64, 'Apto físicamente. Control de rutina.'),
(109, 109, '2026-06-12', 17, 56.2, 1.62, 'Apto físicamente. Control de rutina.'),
(110, 110, '2026-06-12', 19, 60.8, 1.65, 'Apto físicamente. Control de rutina.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoActividad`
--

CREATE TABLE `TipoActividad` (
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) NOT NULL COMMENT 'Ej: Práctica, Partido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `TipoActividad`
--

INSERT INTO `TipoActividad` (`id_tipo`, `descripcion`) VALUES
(1, 'Práctica'),
(2, 'Partido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tutores`
--

CREATE TABLE `Tutores` (
  `id_tutor` int(10) UNSIGNED NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contacto` varchar(20) NOT NULL,
  `id_jugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Tutores`
--

INSERT INTO `Tutores` (`id_tutor`, `apellido`, `nombre`, `contacto`, `id_jugador`) VALUES
(1, 'López', 'Roberto', '985111000', 54),
(2, 'Benítez', 'María', '985222000', 1),
(4, 'Mereles', 'Pedro', '0985111000', 1),
(5, 'Benítez', 'Josue Alexander', '985111000', 2),
(6, 'López', 'Roberto', '0985111000', 4),
(7, 'Benítez', 'María', '0985222000', 1),
(8, 'Mereles', 'Pedro', '0985111000', 1),
(9, 'Benítez', 'Josue Alexander', '0985111000', 2),
(10, 'López', 'Roberto', '0984111222', 1),
(11, 'Benítez', 'María', '0984222333', 2),
(12, 'Benítez', 'Juana', '0984222333', 3),
(13, 'Torres', 'Martín', '0984333444', 4),
(14, 'Trussi Aquino', 'Carlos', '992326561', 5),
(15, 'Duarte', 'Ramón', '0984222333', 10),
(16, 'González', 'Claudio', '0981100001', 11),
(17, 'Benítez', 'Gustavo', '0982100002', 12),
(18, 'Martínez', 'Andrés', '0983100003', 13),
(19, 'López', 'Raúl', '0984100004', 14),
(20, 'Giménez', 'Pedro', '0985100005', 15),
(21, 'Vera', 'Jorge', '0981200006', 16),
(22, 'Duarte', 'Fabián', '0982200007', 17),
(23, 'Villalba', 'Hugo', '0983200008', 18),
(24, 'Ferreira', 'Mario', '0984200009', 19),
(25, 'Rojas', 'César', '0985200010', 20),
(26, 'Galeano', 'Dora', '0971100001', 21),
(27, 'Bogado', 'Alicia', '0972100002', 22),
(28, 'Paredes', 'Carmen', '0973100003', 23),
(29, 'Aquino', 'Elena', '0974100004', 24),
(30, 'Silvero', 'Marta', '0975100005', 25),
(31, 'Espínola', 'Rosa', '0971200006', 26),
(32, 'Cano', 'Laura', '0972200007', 27),
(33, 'Ortiz', 'Beatriz', '0973200008', 28),
(34, 'Mendoza', 'Silvia', '0974200009', 29),
(35, 'Ramírez', 'Julia', '0975200010', 30),
(36, 'Ayala', 'Marcos', '0981300001', 31),
(37, 'Valdez', 'Enrique', '0982300002', 32),
(38, 'Ruiz', 'Sergio', '0983300003', 33),
(39, 'Coronel', 'Daniel', '0984300004', 34),
(40, 'Silva', 'Eduardo', '0985300005', 35),
(41, 'Sosa', 'Francisco', '0981400006', 36),
(42, 'Medina', 'Luis', '0982400007', 37),
(43, 'Burgos', 'Alberto', '0983400008', 38),
(44, 'Arias', 'Fernando', '0984400009', 39),
(45, 'Leguizamón', 'Oscar', '0985400010', 40),
(46, 'Torres', 'Norma', '0971400001', 41),
(47, 'Cardozo', 'Patricia', '0972400002', 42),
(48, 'Ocampos', 'Gabriela', '0973400003', 43),
(49, 'Godoy', 'Sonia', '0974400004', 44),
(50, 'Samaniego', 'Sandra', '0975400005', 45),
(51, 'Brítez', 'Gladys', '0971500006', 46),
(52, 'Fleitas', 'Mirian', '0972500007', 47),
(53, 'Acosta', 'Lilian', '0973500008', 48),
(54, 'Irala', 'Araceli', '0974500009', 49),
(55, 'Gauto', 'Antonia', '0975500010', 50),
(56, 'Salinas', 'Rubén', '0981500001', 51),
(57, 'Recalde', 'Marcelo', '0982500002', 52),
(58, 'Meza', 'Víctor', '0983500003', 53),
(59, 'Britos', 'Nelson', '0984500004', 54),
(60, 'Arzamendia', 'Tomás', '0985500005', 55),
(61, 'Peralta', 'Ignacio', '0981600006', 56),
(62, 'Velázquez', 'Félix', '0982600007', 57),
(63, 'Barrios', 'Héctor', '0983600008', 58),
(64, 'Cáceres', 'Javier', '0984600009', 59),
(65, 'Delgado', 'Walter', '0985600010', 60),
(66, 'Franco', 'Blanca', '0971600001', 61),
(67, 'Díaz', 'Lorena', '0972600002', 62),
(68, 'Leiva', 'Cecilia', '0973600003', 63),
(69, 'Vázquez', 'Estela', '0974600004', 64),
(70, 'Insfrán', 'Natalia', '0975600005', 65),
(71, 'Bobadilla', 'Milagros', '0971700006', 66),
(72, 'Benegas', 'Yolanda', '0972700007', 67),
(73, 'Noguera', 'Teresa', '0973700008', 68),
(74, 'Alcaraz', 'Verónica', '0974700009', 69),
(75, 'Ovelar', 'Viviana', '0975700010', 70),
(76, 'Toledo', 'Claudio', '0981700001', 71),
(77, 'Chamorro', 'Cristian', '0982700002', 72),
(78, 'Morínigo', 'Ricardo', '0983700003', 73),
(79, 'Centurión', 'Javier', '0984700004', 74),
(80, 'Portillo', 'Marcos', '0985700005', 75),
(81, 'Dávalos', 'Enrique', '0981800006', 76),
(82, 'Báez', 'Lorenzo', '0982800007', 77),
(83, 'Espinoza', 'Julio', '0983800008', 78),
(84, 'Vega', 'Fabian', '0984800009', 79),
(85, 'Valenzuela', 'Omar', '0985800010', 80),
(86, 'Bogado', 'Evelyn', '0971800001', 81),
(87, 'Garcete', 'Noelia', '0972800002', 82),
(88, 'Echeverría', 'Sonia', '0973800003', 83),
(89, 'Maldonado', 'Tania', '0974800004', 84),
(90, 'Benega', 'Cynthia', '0975800005', 85),
(91, 'Escobar', 'Graciela', '0971900006', 86),
(92, 'Cantero', 'Viviana', '0972900007', 87),
(93, 'Zárate', 'Marisol', '0973900008', 88),
(94, 'Arrúa', 'Gladys', '0974900009', 89),
(95, 'Villar', 'Mirian', '0975900010', 90),
(96, 'Vera', 'Roque', '0981900001', 91),
(97, 'Mendoza', 'Miguel', '0982900002', 92),
(98, 'Amarilla', 'Arnaldo', '0983900003', 93),
(99, 'Godoy', 'Feliciano', '0984900004', 94),
(100, 'Lugo', 'Marcial', '0985900005', 95),
(101, 'Ortellado', 'Rubén', '0981000006', 96),
(102, 'Duarte', 'Luis', '0982000007', 97),
(103, 'Galeano', 'Hernán', '0983000008', 98),
(104, 'Osorio', 'Gustavo', '0984000009', 99),
(105, 'Nuñez', 'Alcides', '0985000010', 100),
(106, 'Avalos', 'Liz', '0971000001', 101),
(107, 'Britos', 'Alicia', '0972000002', 102),
(108, 'Melgarejo', 'Beatriz', '0973000003', 103),
(109, 'Corvalán', 'Norma', '0974000004', 104),
(110, 'Sanabria', 'Luz', '0975000005', 105),
(111, 'Bogarín', 'Marta', '0971010006', 106),
(112, 'Montiel', 'Claudia', '0972010007', 107),
(113, 'Caballero', 'Estela', '0973010008', 108),
(114, 'Valiente', 'Elena', '0974010009', 109),
(115, 'Ledesma', 'Rosa', '0975010010', 110);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Actividad`
--
ALTER TABLE `Actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `fk_act_genero` (`id_genero`),
  ADD KEY `fk_act_categoria` (`id_categoria`),
  ADD KEY `fk_act_tipo` (`id_tipo`);

--
-- Indices de la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD UNIQUE KEY `uq_asistencia` (`id_actividad`,`id_jugador`),
  ADD KEY `fk_asis_jugador` (`id_jugador`);

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `Det_Jg`
--
ALTER TABLE `Det_Jg`
  ADD PRIMARY KEY (`id_jugador`,`id_actividad`),
  ADD KEY `fk_detjg_actividad` (`id_actividad`);

--
-- Indices de la tabla `EntCatGen`
--
ALTER TABLE `EntCatGen`
  ADD PRIMARY KEY (`id_entrenador`,`id_categoria`,`id_genero`),
  ADD KEY `fk_ecg_categoria` (`id_categoria`),
  ADD KEY `fk_ecg_genero` (`id_genero`);

--
-- Indices de la tabla `Entrenadores`
--
ALTER TABLE `Entrenadores`
  ADD PRIMARY KEY (`id_entrenador`),
  ADD UNIQUE KEY `CI` (`CI`);

--
-- Indices de la tabla `Genero`
--
ALTER TABLE `Genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `Jugadores`
--
ALTER TABLE `Jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD UNIQUE KEY `CI` (`CI`),
  ADD KEY `fk_jug_genero` (`genero`);

--
-- Indices de la tabla `jugador_tutor`
--
ALTER TABLE `jugador_tutor`
  ADD PRIMARY KEY (`id_jugador`,`id_tutor`),
  ADD KEY `fk_jt_tutor` (`id_tutor`);

--
-- Indices de la tabla `Seguimiento`
--
ALTER TABLE `Seguimiento`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `fk_seg_jugador` (`id_jugador`);

--
-- Indices de la tabla `TipoActividad`
--
ALTER TABLE `TipoActividad`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `Tutores`
--
ALTER TABLE `Tutores`
  ADD PRIMARY KEY (`id_tutor`),
  ADD KEY `fk_tut_jugador` (`id_jugador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Actividad`
--
ALTER TABLE `Actividad`
  MODIFY `id_actividad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  MODIFY `id_asistencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Entrenadores`
--
ALTER TABLE `Entrenadores`
  MODIFY `id_entrenador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Genero`
--
ALTER TABLE `Genero`
  MODIFY `id_genero` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Jugadores`
--
ALTER TABLE `Jugadores`
  MODIFY `id_jugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `Seguimiento`
--
ALTER TABLE `Seguimiento`
  MODIFY `id_seguimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `TipoActividad`
--
ALTER TABLE `TipoActividad`
  MODIFY `id_tipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Tutores`
--
ALTER TABLE `Tutores`
  MODIFY `id_tutor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Actividad`
--
ALTER TABLE `Actividad`
  ADD CONSTRAINT `fk_act_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_act_genero` FOREIGN KEY (`id_genero`) REFERENCES `Genero` (`id_genero`),
  ADD CONSTRAINT `fk_act_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `TipoActividad` (`id_tipo`);

--
-- Filtros para la tabla `Asistencia`
--
ALTER TABLE `Asistencia`
  ADD CONSTRAINT `fk_asis_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_asis_jugador` FOREIGN KEY (`id_jugador`) REFERENCES `Jugadores` (`id_jugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Det_Jg`
--
ALTER TABLE `Det_Jg`
  ADD CONSTRAINT `fk_detjg_actividad` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id_actividad`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detjg_jugador` FOREIGN KEY (`id_jugador`) REFERENCES `Jugadores` (`id_jugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `EntCatGen`
--
ALTER TABLE `EntCatGen`
  ADD CONSTRAINT `fk_ecg_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ecg_entrenador` FOREIGN KEY (`id_entrenador`) REFERENCES `Entrenadores` (`id_entrenador`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ecg_genero` FOREIGN KEY (`id_genero`) REFERENCES `Genero` (`id_genero`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Jugadores`
--
ALTER TABLE `Jugadores`
  ADD CONSTRAINT `fk_jug_genero` FOREIGN KEY (`genero`) REFERENCES `Genero` (`id_genero`);

--
-- Filtros para la tabla `jugador_tutor`
--
ALTER TABLE `jugador_tutor`
  ADD CONSTRAINT `fk_jt_jugador` FOREIGN KEY (`id_jugador`) REFERENCES `Jugadores` (`id_jugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jt_tutor` FOREIGN KEY (`id_tutor`) REFERENCES `Tutores` (`id_tutor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Seguimiento`
--
ALTER TABLE `Seguimiento`
  ADD CONSTRAINT `fk_seg_jugador` FOREIGN KEY (`id_jugador`) REFERENCES `Jugadores` (`id_jugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Tutores`
--
ALTER TABLE `Tutores`
  ADD CONSTRAINT `fk_tut_jugador` FOREIGN KEY (`id_jugador`) REFERENCES `Jugadores` (`id_jugador`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
