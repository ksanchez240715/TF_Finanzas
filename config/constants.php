<?php

return [
    'GENERAL' => [
        'ENTIDAD' => 4,
        'TEMA' => 4,
        'DATABASE' => 1,
        'DATE_FORMAT' => 1,
        'PASSWORD_AKDEMIC' => "@ApiInvestigacion"
    ],
    'DATE_FORMAT' => [
        1 => 'h:i A d-m-Y',
        2 => 'd-m-Y',
    ],
    'DATABASES' => [
        'SQL' => 1,
        'MYSQL' => 2,
    ],
    'DATABASES_JOIN' => [
        1 => '_',
        2 => '.',
    ],
    'INTEGRADO_AKDEMIC' => 0,
    'TEMAS' => [
        1 => 'enchufate',
        2 => 'unap-iquitos',
        3 => 'akdemic',
        4 => 'unica',
        5 => 'unfv',
        6 => 'upal',
        7 => 'undac',
        8 => 'unheval',
    ],
    'ENTIDAD' =>[
        1 => 'ENCHUFATE',
        2 => 'UNAP',
        3 => 'AKDEMIC',
        4 => 'UNICA',
        5 => 'UNFV',
        6 => 'UPAL',
        7 => 'UNDAC',
        8 => 'UNHEVAL'
    ],
    'NOMBRE_INSTITUCION' =>[
        1 => 'Enchufate S.A.C.',
        2 => 'Universidad Nacional De La Amazonia Peruana',
        3 => 'Akdemic Sistema Integrado de Educación',
        4 => 'Universidad Nacional "San Luis Gonzaga"',
        5 => 'Universidad Nacional Federico Villarreal',
        6 => 'Universidad Privada Peruano Alemana',
        7 => 'Universidad Nacional Alcides Carrión',
        8 => 'Universidad Nacional Hermilio Valdizan'
    ],
    "DATATABLE_SERVER_SIDE_PARAMETERS" => [
        "SORT_ORDER" => "order[0][dir]",
        "SORT_FIELD" => "order[0][column]",
        "SEARCH" => "search[value]",
        "START" => "start",
        "PAGE_PER_PAGE" => "length",
        "DRAW_COUNTER" => "draw",
        "BASE_ORDER" => "desc",
    ],
//    "ROLES" => [
//        1 => "Administrador",
//        1 => "Asistente",
//        1 => "Vicerrector",
//        1 => "Director",
//        1 => "Coordinador",
//        1 => "Docente",
//        1 => "Alumno"
//    ],
    'ESTADO_ANALISIS' => [
        'PENDIENTE' => 1,
        'APROBADO' => 2,
        'DESAPROBADO' => 3,
        'SIN_CALIFICACION' => 4
    ],
    'ROLES' => [
        'ALUMNO' => 'Alumno',
        'PROFESOR' => 'Profesor',
        'ADMINISTRADOR' => 'Administrador',
        'COORDINADORICI' => 'CoordinadorICI',
        'ASCESOR' => 'Ascesor',
        'DIRECTORICI' => 'DirectorICI',
        'DECANO' => 'Decano',
    ],
    'TIPO_ANALISIS_ADMINISTRATIVO' => 1,


    "BREADCRUMB_ITEMS" => [
        "MODULES" => [
            "GESTION_USUARIOS" => [
                "TITLE" => [
                    "URL" => "#",
                    "NAME" => 'Gestión de usuarios'
                ],
                "ITEMS" => [
                    "ADMINISTRATIVE" => [
                        "LIST" => [
                            "URL" => "/gestion/usuario/administrativos",
                            "NAME" => 'Listado de administrativos'
                        ],
                        "ADD" => [
                            "URL" => "/gestion/usuario/administrativos/agregar",
                            "NAME" => 'Creación de usuario'
                        ],
                        "UPDATE" => [
                            "URL" => "/gestion/usuario/administrativos/actualizar",
                            "NAME" => 'Edición de usuario'
                        ]
                    ],
                    "TEACHER" => [
                        "LIST" => [
                            "URL" => "/gestion/usuario/docentes",
                            "NAME" => 'Listado de docentes'
                        ],
                        "ADD" => [
                            "URL" => "/gestion/usuario/docentes/agregar",
                            "NAME" => 'Creación de docente'
                        ],
                        "UPDATE" => [
                            "URL" => "/gestion/usuario/docentes/actualizar",
                            "NAME" => 'Edición de docente'
                        ]
                    ],
                    "STUDENT" => [
                        "LIST" => [
                            "URL" => "/gestion/usuario/alumnos",
                            "NAME" => 'Listado de alumnos'
                        ],
                        "ADD" => [
                            "URL" => "/gestion/usuario/alumnos/agregar",
                            "NAME" => 'Creación de alumno'
                        ],
                        "UPDATE" => [
                            "URL" => "/gestion/usuario/alumnos/actualizar",
                            "NAME" => 'Edición de alumno'
                        ]
                    ],
                    "EXTERNAL_RESEARCHER" => [
                        "LIST" => [
                            "URL" => "/gestion/usuario/personal",
                            "NAME" => 'Listado de personal externo'
                        ],
                        "ADD" => [
                            "URL" => "/gestion/usuario/personal/agregar",
                            "NAME" => 'Creación de personal externo'
                        ],
                        "UPDATE" => [
                            "URL" => "/gestion/usuario/personal/actualizar",
                            "NAME" => 'Edición de personal externo'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
