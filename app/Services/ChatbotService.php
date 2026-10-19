<?php

namespace App\Services;

use App\Models\Worker;

class ChatbotService
{
    /**
     * Base de conocimiento de MINERSCAN.
     *
     * Esta versión funciona localmente y no depende
     * de una API externa de inteligencia artificial.
     */
    private array $knowledge = [

        // =====================================================
        // MINERSCAN
        // =====================================================

        'que_es_minerscan' => [
            'keywords' => [
                'minerscan',
                'que es minerscan',
                'qué es minerscan',
                'para que sirve minerscan',
                'para qué sirve minerscan',
                'que hace minerscan',
                'qué hace minerscan',
                'explicame minerscan',
                'explícame minerscan',
                'sistema minerscan',
                'plataforma minerscan',
            ],
            'response' =>
                '<strong>MINERSCAN</strong> es una plataforma web orientada a la gestión y supervisión de trabajadores dentro de la actividad minera. '
                . 'El sistema integra principalmente el <strong>control biométrico de asistencia</strong> y la <strong>geolocalización mediante tecnología UWB</strong>. '
                . 'Su objetivo es facilitar el control de ingreso y salida de los trabajadores y permitir conocer su ubicación dentro de la mina.'
        ],

        'objetivo' => [
            'keywords' => [
                'objetivo',
                'objetivo de minerscan',
                'finalidad',
                'finalidad del sistema',
                'para que sirve el sistema',
                'para qué sirve el sistema',
                'proposito',
                'propósito',
                'que busca minerscan',
                'qué busca minerscan',
            ],
            'response' =>
                'El objetivo de MINERSCAN es mejorar el control de los trabajadores mediante herramientas tecnológicas. '
                . 'La plataforma busca reducir errores en el registro de asistencia y proporcionar información de ubicación para apoyar la supervisión y la seguridad dentro de la mina.'
        ],

        // =====================================================
        // MÓDULOS
        // =====================================================

        'modulos' => [
            'keywords' => [
                'modulos',
                'módulos',
                'que tiene minerscan',
                'qué tiene minerscan',
                'funciones',
                'funcionalidades',
                'que puedo hacer',
                'qué puedo hacer',
                'secciones',
                'secciones del sistema',
                'que incluye',
                'qué incluye',
            ],
            'response' =>
                'Actualmente MINERSCAN está orientado principalmente a estas funciones: '
                . '<br><br>'
                . '<strong>1. Dashboard:</strong> información general del sistema.<br>'
                . '<strong>2. Mineros / Trabajadores:</strong> registro y administración de trabajadores.<br>'
                . '<strong>3. Asistencia biométrica:</strong> control de ingreso y salida mediante identificación biométrica.<br>'
                . '<strong>4. Geolocalización:</strong> seguimiento de trabajadores mediante tecnología UWB.<br>'
                . '<strong>5. Reportes:</strong> consulta y análisis de la información generada por la plataforma.'
        ],

        // =====================================================
        // DASHBOARD
        // =====================================================

        'dashboard' => [
            'keywords' => [
                'dashboard',
                'panel principal',
                'panel',
                'inicio',
                'pagina principal',
                'página principal',
                'pantalla principal',
                'que muestra el dashboard',
                'qué muestra el dashboard',
                'para que sirve el dashboard',
                'para qué sirve el dashboard',
            ],
            'response' =>
                'El <strong>Dashboard</strong> es el panel principal de MINERSCAN. '
                . 'Desde allí se podrá consultar de manera general el estado de los trabajadores, la asistencia, la información de ubicación y otros indicadores importantes del sistema.'
        ],

        // =====================================================
        // TRABAJADORES
        // =====================================================

        'trabajadores' => [
            'keywords' => [
                'trabajadores',
                'trabajador',
                'mineros',
                'minero',
                'empleados',
                'empleado',
                'modulo trabajadores',
                'módulo trabajadores',
                'administrar trabajadores',
                'administrar mineros',
                'ver trabajadores',
                'ver mineros',
                'informacion trabajadores',
                'información trabajadores',
            ],
            'response' =>
                'En el módulo <strong>Mineros / Trabajadores</strong> puedes administrar la información de los trabajadores registrados en MINERSCAN. '
                . 'Desde allí se puede registrar información personal, documento, teléfono, EPS, ARL, contacto de emergencia, rol y turno.'
        ],

        // =====================================================
        // REGISTRAR TRABAJADOR
        // =====================================================

        'registrar_trabajador' => [
            'keywords' => [
                'registrar trabajador',
                'registrar un trabajador',
                'registrar trabajador nuevo',
                'registrar nuevo trabajador',
                'crear trabajador',
                'crear un trabajador',
                'agregar trabajador',
                'agregar un trabajador',
                'añadir trabajador',
                'añadir un trabajador',
                'nuevo trabajador',
                'nuevo minero',
                'agregar minero',
                'crear minero',
                'como registro un trabajador',
                'cómo registro un trabajador',
                'como agrego un trabajador',
                'cómo agrego un trabajador',
                'como creo un trabajador',
                'cómo creo un trabajador',
            ],
            'response' =>
                'Para registrar un trabajador debes entrar al módulo <strong>Mineros / Trabajadores</strong> y seleccionar '
                . '<strong>Registrar trabajador</strong>. '
                . 'Después debes completar los datos solicitados, como nombre, apellido, rol, turno, documento y demás información disponible. '
                . 'Finalmente selecciona la opción para guardar el registro.'
        ],

        // =====================================================
        // EDITAR TRABAJADOR
        // =====================================================

        'editar_trabajador' => [
            'keywords' => [
                'editar trabajador',
                'editar un trabajador',
                'modificar trabajador',
                'modificar un trabajador',
                'actualizar trabajador',
                'actualizar un trabajador',
                'cambiar datos trabajador',
                'cambiar datos de trabajador',
                'corregir trabajador',
                'corregir datos trabajador',
                'editar minero',
                'modificar minero',
            ],
            'response' =>
                'La edición de trabajadores permitirá corregir o actualizar información cuando sea necesario. '
                . 'La idea es modificar los datos administrativos sin perder el historial generado por el trabajador dentro de MINERSCAN.'
        ],

        // =====================================================
        // RETIRAR TRABAJADOR
        // =====================================================

        'retirar_trabajador' => [
            'keywords' => [
                'retirar trabajador',
                'retirar un trabajador',
                'retirar empleado',
                'retirar minero',
                'eliminar trabajador',
                'eliminar un trabajador',
                'dar de baja',
                'dar de baja trabajador',
                'trabajador retirado',
                'cuando se retira un trabajador',
                'que pasa cuando se retira',
                'qué pasa cuando se retira',
            ],
            'response' =>
                'Cuando un trabajador deje de pertenecer a la operación, MINERSCAN debe manejarlo como <strong>retirado</strong> en lugar de eliminarlo físicamente. '
                . 'De esta manera se conserva su historial de asistencia, ubicación y demás registros asociados.'
        ],

        // =====================================================
        // ASISTENCIA
        // =====================================================

        'asistencia' => [
            'keywords' => [
                'asistencia',
                'control de asistencia',
                'asistencia biometrica',
                'asistencia biométrica',
                'registro de entrada',
                'registro de salida',
                'entrada',
                'salida',
                'marcar entrada',
                'marcar salida',
                'como funciona la asistencia',
                'cómo funciona la asistencia',
                'control de ingreso',
                'control de salida',
            ],
            'response' =>
                'El módulo de <strong>Asistencia Biométrica</strong> está diseñado para controlar el ingreso y salida de los trabajadores mediante mecanismos de identificación biométrica. '
                . 'MINERSCAN contempla principalmente <strong>huella dactilar y reconocimiento facial</strong> como mecanismos de verificación.'
        ],

        // =====================================================
        // BIOMETRÍA
        // =====================================================

        'biometria' => [
            'keywords' => [
                'biometria',
                'biometría',
                'biometrico',
                'biométrico',
                'huella',
                'huella dactilar',
                'reconocimiento facial',
                'reconocer rostro',
                'reconocimiento de rostro',
                'cara',
                'rostro',
                'identificacion biometrica',
                'identificación biométrica',
                'verificacion biometrica',
                'verificación biométrica',
            ],
            'response' =>
                'La biometría permite verificar la identidad de un trabajador mediante características físicas. '
                . 'En MINERSCAN se contempla el uso de <strong>huella dactilar y reconocimiento facial</strong> para apoyar el control de asistencia.'
        ],

        // =====================================================
        // UWB
        // =====================================================

        'uwb' => [
            'keywords' => [
                'uwb',
                'que es uwb',
                'qué es uwb',
                'para que sirve uwb',
                'para qué sirve uwb',
                'tecnologia uwb',
                'tecnología uwb',
                'geolocalizacion uwb',
                'geolocalización uwb',
                'ubicacion uwb',
                'ubicación uwb',
                'como funciona uwb',
                'cómo funciona uwb',
                'para que se usa uwb',
                'para qué se usa uwb',
            ],
            'response' =>
                '<strong>UWB (Ultra-Wideband)</strong> es una tecnología de comunicación inalámbrica que permite realizar mediciones de distancia y posicionamiento con alta precisión. '
                . 'En MINERSCAN se utilizará para apoyar la <strong>geolocalización de los trabajadores dentro de la mina</strong>.'
        ],

        // =====================================================
        // GEOLOCALIZACIÓN
        // =====================================================

        'geolocalizacion' => [
            'keywords' => [
                'geolocalizacion',
                'geolocalización',
                'ubicacion',
                'ubicación',
                'donde esta un trabajador',
                'dónde está un trabajador',
                'donde esta el trabajador',
                'dónde está el trabajador',
                'localizar trabajador',
                'localizar minero',
                'seguimiento',
                'seguimiento trabajador',
                'posicion trabajador',
                'posición trabajador',
                'posicionamiento',
                'localizacion',
                'localización',
            ],
            'response' =>
                'La geolocalización de MINERSCAN utiliza tecnología <strong>UWB</strong>. '
                . 'Los trabajadores pueden portar dispositivos o etiquetas UWB y la infraestructura de la mina contará con puntos de referencia o <strong>anchors</strong>. '
                . 'La información obtenida permitirá representar la posición del trabajador dentro del sistema.'
        ],

        // =====================================================
        // ARQUITECTURA UWB
        // =====================================================

        'arquitectura_uwb' => [
            'keywords' => [
                'como funciona el uwb en minerscan',
                'cómo funciona el uwb en minerscan',
                'arquitectura uwb',
                'arquitectura de uwb',
                'como se conecta el uwb',
                'cómo se conecta el uwb',
            ],
            'response' =>
                'La arquitectura prevista para MINERSCAN funciona de manera general así: '
                . '<br><br>'
                . '<strong>Tag UWB → Anchors UWB → Gateway → Servidor/API → MINERSCAN → Dashboard/Mapa.</strong>'
                . '<br><br>'
                . 'El <strong>Tag UWB</strong> acompaña al trabajador, los <strong>Anchors</strong> reciben las señales y la información de posicionamiento puede ser procesada por el sistema para mostrar la ubicación.'
        ],

        // =====================================================
        // TAGS UWB
        // =====================================================

        'tags_uwb' => [
            'keywords' => [
                'tag uwb',
                'tags uwb',
                'que es un tag',
                'qué es un tag',
                'etiqueta uwb',
                'dispositivo del trabajador',
                'dispositivo uwb del trabajador',
            ],
            'response' =>
                'Un <strong>Tag UWB</strong> es el dispositivo que puede portar el trabajador para permitir que el sistema determine su posición dentro de la mina. '
                . 'Cada tag puede estar asociado a un trabajador y contar con información como dispositivo, estado, batería y última comunicación.'
        ],

        // =====================================================
        // ANCHORS UWB
        // =====================================================

        'anchors_uwb' => [
            'keywords' => [
                'anchor uwb',
                'anchors uwb',
                'que es un anchor',
                'qué es un anchor',
                'que son los anchors',
                'qué son los anchors',
                'punto de referencia uwb',
                'puntos de referencia uwb',
            ],
            'response' =>
                'Los <strong>Anchors UWB</strong> son puntos de referencia instalados en diferentes zonas de la mina. '
                . 'Estos dispositivos permiten recibir las señales de los Tags UWB y aportar la información necesaria para calcular o determinar la posición de los trabajadores.'
        ],

        // =====================================================
        // REPORTES
        // =====================================================

        'reportes' => [
            'keywords' => [
                'reportes',
                'reporte',
                'reportes de minerscan',
                'informes',
                'informe',
                'historial',
                'consultar reportes',
                'para que sirven los reportes',
                'para qué sirven los reportes',
                'ver reportes',
                'consultar historial',
            ],
            'response' =>
                'El módulo de <strong>Reportes</strong> estará orientado a consultar y analizar la información generada por MINERSCAN, como registros de asistencia, trabajadores y datos relacionados con la ubicación. '
                . 'La información histórica debe conservarse para facilitar consultas posteriores.'
        ],

        // =====================================================
        // NAVEGACIÓN
        // =====================================================

        'navegacion' => [
            'keywords' => [
                'como uso minerscan',
                'cómo uso minerscan',
                'como manejar minerscan',
                'cómo manejar minerscan',
                'como navegar',
                'cómo navegar',
                'donde encuentro',
                'dónde encuentro',
                'como encuentro',
                'cómo encuentro',
                'en que modulo',
                'en qué módulo',
                'que modulo uso',
                'qué módulo uso',
            ],
            'response' =>
                'Puedes navegar por MINERSCAN utilizando el menú lateral. '
                . 'Allí encontrarás las secciones principales de <strong>Dashboard, Mineros / Trabajadores, Asistencia Biométrica, Geolocalización y Reportes</strong>. '
                . 'El asistente también puede orientarte sobre qué módulo utilizar según lo que necesites hacer.'
        ],

        // =====================================================
        // SEGURIDAD
        // =====================================================

        'seguridad' => [
            'keywords' => [
                'seguridad',
                'seguridad del sistema',
                'es seguro',
                'proteccion',
                'protección',
                'datos',
                'seguridad de datos',
                'datos de trabajadores',
                'proteger informacion',
                'proteger información',
            ],
            'response' =>
                'MINERSCAN está diseñado como una plataforma de gestión con acceso autenticado. '
                . 'La información de los trabajadores y los registros generados deben manejarse con controles de acceso y buenas prácticas de seguridad. '
                . 'En las siguientes etapas del proyecto se podrán incorporar controles adicionales de seguridad y auditoría.'
        ],

        // =====================================================
        // AYUDA
        // =====================================================

        'ayuda' => [
            'keywords' => [
                'ayuda',
                'help',
                'necesito ayuda',
                'que puedes hacer',
                'qué puedes hacer',
                'puedes ayudarme',
                'puedes ayudarme con minerscan',
                'ayudame',
                'ayúdame',
                'como me ayudas',
                'cómo me ayudas',
            ],
            'response' =>
                'Claro. Puedo ayudarte a entender MINERSCAN y orientarte en el uso de la plataforma. '
                . 'Puedes preguntarme, por ejemplo, <strong>cómo registrar un trabajador, cómo editarlo, qué es UWB, cómo funciona la asistencia, qué módulos tiene MINERSCAN o para qué sirven los reportes</strong>.'
        ],

    ];

    /** Origen de la última respuesta: database | gemini | knowledge | default */
    public string $lastSource = 'default';

    /** Idioma de las respuestas con datos del sistema: es | en */
    private string $lang = 'es';

    /**
     * Procesar una pregunta y devolver la respuesta (HTML seguro).
     *
     * Orden:
     *  1. Consultas operativas  -> Laravel/MySQL (se responden aquí mismo, en español o inglés)
     *  2. Preguntas generales   -> Gemini (con la base de conocimiento como contexto)
     *  3. Respaldo si Gemini falla -> coincidencia con la base de conocimiento local
     *  4. Respuesta predeterminada
     */
    public function getResponse(string $question, array $history = []): string
    {
        $this->lastSource = 'default';

        $original = trim($question);
        $normalized = $this->normalize($original);

        // Idioma de las respuestas con datos del sistema.
        $this->lang = $this->looksSpanish($original) ? 'es' : 'en';

        // 1. Consultas reales a la base de datos (sin llamar a Gemini).
        $database = $this->answerDatabaseQuestion($normalized);

        if ($database !== null) {
            $this->lastSource = 'database';

            return $database;
        }

        // 2. Gemini responde en el idioma del usuario.
        $gemini = app(GeminiService::class)->generateResponse(
            $original,
            $history,
            $this->knowledgeContext()
        );

        if ($gemini !== null) {
            $this->lastSource = 'gemini';

            return $this->plainToHtml($gemini);
        }

        // 3. Respaldo local si Gemini no está disponible.
        $local = $this->matchKnowledge($normalized);

        if ($local !== null) {
            $this->lastSource = 'knowledge';

            return $this->adaptLanguage($local, $original);
        }

        return $this->fallbackResponse($normalized);
    }

    /**
     * Consultas operativas (español e inglés). Devuelve null si la pregunta
     * no es una consulta sobre trabajadores.
     */
    private function answerDatabaseQuestion(string $question): ?string
    {
        $q = $this->mapEnglishKeywords($question);
 
        // Turnos.
        if ($this->containsShiftQuestion($q)) {
            $shift = $this->detectShift($q);
 
            if ($shift !== null) {
                return $this->getWorkersBySpecificShiftResponse($shift);
            }
 
            return $this->getWorkersByShiftResponse();
        }
 
        $role = $this->detectRole($q);
 
        $mentionsWorkers = $role !== null || $this->matchesAny($q, [
            'trabajadores',
            'trabajador',
            'empleados',
            'empleado',
            'cuantos estan',
        ]);
 
        $isInactive = $this->matchesAny($q, [
            'inactivos',
            'inactivo',
            'retirados',
            'retirado',
        ]);
 
        // "activo" está dentro de "inactivo": primero se descarta inactivo.
        $isActive = !$isInactive && $this->matchesAny($q, ['activos', 'activo']);
 
        $statusPhrase = $this->matchesAny($q, [
            'trabajadores activos',
            'mineros activos',
            'activos trabajadores',
            'activos mineros',
            'trabajadores inactivos',
            'mineros inactivos',
            'inactivos trabajadores',
            'inactivos mineros',
            'trabajadores retirados',
            'mineros retirados',
            'retirados trabajadores',
            'retirados mineros',
        ]);
 
        // Conteos: total, activos, inactivos y por rol.
        if (
            $mentionsWorkers &&
            ($this->containsWorkerQuantityQuestion($q) || $statusPhrase)
        ) {
            if ($role !== null) {
                if ($isInactive) {
                    return $this->getInactiveWorkersByRoleResponse($role);
                }
 
                if ($isActive) {
                    return $this->getActiveWorkersByRoleResponse($role);
                }
 
                return $this->getWorkersByRoleResponse($role);
            }
 
            if ($isInactive) {
                return $this->getInactiveWorkerCountResponse();
            }
 
            if ($isActive) {
                return $this->getActiveWorkerCountResponse();
            }
 
            return $this->getWorkerCountResponse();
        }
 
        // Lista de trabajadores.
        if (
            $mentionsWorkers &&
            $this->matchesAny($q, [
                'lista',
                'listar',
                'mostrar',
                'muestrame',
                'registrados',
                'quienes son',
            ])
        ) {
            return $this->getWorkersListResponse();
        }
 
        return null;
    }
 
    /**
     * Traduce palabras clave en inglés a las que ya reconocen las consultas
     * operativas (solo palabras completas, para no tocar "minerscan").
     */
    private function mapEnglishKeywords(string $question): string
    {
        $map = [
            'how many' => 'cuantos',
            'number of' => 'numero de',
            'are there' => 'hay',
            'is there' => 'hay',
            'who are' => 'quienes son',
            'list of' => 'lista de',
            'list' => 'lista',
            'show' => 'mostrar',
            'registered' => 'registrados',
            'workers' => 'trabajadores',
            'worker' => 'trabajador',
            'miners' => 'mineros',
            'miner' => 'minero',
            'supervisors' => 'supervisores',
            'operators' => 'operadores',
            'operator' => 'operador',
            'maintenance' => 'mantenimiento',
            'inactive' => 'inactivos',
            'retired' => 'retirados',
            'active' => 'activos',
            'morning' => 'manana',
            'afternoon' => 'tarde',
            'night' => 'noche',
            'shifts' => 'turnos',
            'shift' => 'turno',
        ];
 
        foreach ($map as $english => $spanish) {
            $question = preg_replace(
                '/\b' . preg_quote($english, '/') . '\b/u',
                $spanish,
                $question
            ) ?? $question;
        }
 
        return $question;
    }
 
    /**
     * Respaldo local: busca el tema de la base de conocimiento que mejor
     * coincide con la pregunta. Devuelve null si ninguno es suficiente.
     */
    private function matchKnowledge(string $question): ?string
    {
        $best = null;
        $bestScore = 0;
        $questionWords = preg_split('/\s+/', $question) ?: [];
 
        foreach ($this->knowledge as $topic) {
            $score = 0;
 
            foreach ($topic['keywords'] as $keyword) {
                $keyword = $this->normalize($keyword);
 
                if ($keyword === '') {
                    continue;
                }
 
                // Frase completa (como palabra/s completas): mayor peso.
                if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/u', $question) === 1) {
                    $score += strlen($keyword) * 2;
                }
 
                foreach (preg_split('/\s+/', $keyword) ?: [] as $word) {
                    if (strlen($word) >= 3 && in_array($word, $questionWords, true)) {
                        $score += 2;
                    }
                }
            }
 
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $topic;
            }
        }
 
        return ($best !== null && $bestScore >= 4) ? $best['response'] : null;
    }
 
    /**
     * Base de conocimiento en texto plano, para dársela a Gemini como contexto.
     */
    private function knowledgeContext(): string
    {
        $lines = [];
 
        foreach ($this->knowledge as $topic) {
            $lines[] = '- ' . trim($this->htmlToPlain($topic['response']));
        }
 
        return implode("\n", $lines);
    }
 
    /**
     * Si la pregunta no está en español, reescribe la respuesta en el idioma
     * del usuario. Si Gemini no está disponible, se devuelve la original.
     */
    private function adaptLanguage(string $answerHtml, string $question): string
    {
        if ($this->looksSpanish($question)) {
            return $answerHtml;
        }
 
        $translated = app(GeminiService::class)->translateResponse(
            $this->htmlToPlain($answerHtml),
            $question
        );
 
        return $translated !== null ? $this->plainToHtml($translated) : $answerHtml;
    }
 
    /**
     * Detección sencilla de idioma. En caso de empate se asume español.
     */
    private function looksSpanish(string $text): bool
    {
        $words = preg_split('/\s+/', $this->normalize($text)) ?: [];
 
        $spanish = [
            'que', 'cuantos', 'cuantas', 'hay', 'trabajadores', 'trabajador', 'mineros',
            'minero', 'como', 'donde', 'quien', 'quienes', 'cual', 'cuales', 'lista',
            'turno', 'turnos', 'activos', 'inactivos', 'retirados', 'el', 'la', 'los',
            'las', 'del', 'para', 'por', 'con', 'dame', 'muestrame', 'cantidad', 'numero',
            'hola', 'es', 'son', 'de', 'en', 'un', 'una', 'y', 'mi', 'tu', 'se',
        ];
 
        $english = [
            'how', 'many', 'workers', 'worker', 'miners', 'miner', 'what', 'who', 'where',
            'which', 'list', 'show', 'shift', 'shifts', 'active', 'inactive', 'retired',
            'the', 'are', 'there', 'number', 'give', 'tell', 'please', 'hello', 'is', 'of',
            'in', 'much', 'and', 'my', 'your', 'can', 'do', 'does', 'you', 'i',
        ];
 
        return count(array_intersect($words, $spanish)) >= count(array_intersect($words, $english));
    }
 
    /** HTML de las respuestas locales -> texto plano con **negrita**. */
    private function htmlToPlain(string $html): string
    {
        $text = preg_replace('#<br\s*/?>#i', "\n", $html) ?? $html;
        $text = preg_replace('#</?(strong|b)>#i', '**', $text) ?? $text;
 
        return html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
 
    /** Texto plano (Gemini) -> HTML seguro: se escapa todo y solo se permite <strong> y <br>. */
    private function plainToHtml(string $text): string
    {
        $text = e($text);
        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text) ?? $text;
 
        return nl2br($text);
    }
 

    /**
     * Verifica si la pregunta contiene alguna de las frases indicadas.
     */

    private function matchesAny(string $question, array $phrases): bool
    {
        foreach ($phrases as $phrase) {

            $phrase = $this->normalize($phrase);

            if (str_contains($question, $phrase)) {
                return true;
            }
        }

        return false;
    }


    /**
     * Determinar si la pregunta solicita una cantidad relacionada
     * con un rol.
     */
    private function containsWorkerQuantityQuestion(string $question): bool
    {
        $quantityWords = [
            'cuantos',
            'cuántos',
            'cantidad',
            'numero',
            'número',
            'total',
        ];

        foreach ($quantityWords as $word) {

            $word = $this->normalize($word);

            if (str_contains($question, $word)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Detectar el rol consultado.
     */
    private function detectRole(string $question): ?string
    {
        $roles = [
            'supervisores' => 'Supervisor',
            'supervisor' => 'Supervisor',
            'mineros' => 'Minero',
            'minero' => 'Minero',
            'operadores' => 'Operador',
            'operador' => 'Operador',
            'mantenimiento' => 'Mantenimiento',
        ];

        foreach ($roles as $keyword => $role) {

            if (str_contains($question, $keyword)) {
                return $role;
            }
        }

        return null;
    }

    /**
     * Detectar si la pregunta está relacionada con turnos.
     */
    private function containsShiftQuestion(string $question): bool
    {
        $keywords = [
            'turno',
            'turnos',
            '6:00',
            '6 a 1',
            '6am',
            '6 am',
            '1 pm',
            '2:00',
            '2 a 7',
            '2pm',
            '2 pm',
            '7:00',
            '7 a 2',
            '7pm',
            '7 pm',
        ];

        foreach ($keywords as $keyword) {

            if (str_contains($question, $this->normalize($keyword))) {
                return true;
            }
        }

        return false;
    }

  
        /**
         * Detectar el turno específico mencionado en la pregunta.
         *
         * Retorna:
         * - 6:00 AM - 1:00 PM
         * - 2:00 PM - 7:00 PM
         * - 7:00 PM - 2:00 AM
         * - null si no se identifica un turno específico.
         */
        private function detectShift(string $question): ?string
        {
            $question = $this->normalize($question);

            /*
            * Turno de la mañana.
            */
            if ($this->matchesAny($question, [
                'manana',
                '6:00 am',
                '6 am',
                '6am',
                '6 a 1',
                '6:00 a 1:00',
                '6 a 1 pm',
                'primer turno',
            ])) {
                return '6:00 AM - 1:00 PM';
            }

            /*
            * Turno de la tarde.
            */
            if ($this->matchesAny($question, [
                'tarde',
                '2:00 pm',
                '2 pm',
                '2pm',
                '2 a 7',
                '2:00 a 7:00',
                '2 a 7 pm',
                'segundo turno',
            ])) {
                return '2:00 PM - 7:00 PM';
            }

            /*
            * Turno de la noche.
            */
            if ($this->matchesAny($question, [
                'noche',
                '7:00 pm',
                '7 pm',
                '7pm',
                '7 a 2',
                '7:00 a 2:00',
                '7 a 2 am',
                'tercer turno',
            ])) {
                return '7:00 PM - 2:00 AM';
            }

            return null;
        }

    /**
     * ¿Las respuestas con datos del sistema van en inglés?
     */
    private function isEnglish(): bool
    {
        return $this->lang === 'en';
    }

    /**
     * "Actualmente hay" / "There is currently" / "There are currently".
     */
    private function currentlyThere(int $count): string
    {
        if ($this->isEnglish()) {
            return $count === 1 ? 'There is currently' : 'There are currently';
        }

        return 'Actualmente hay';
    }

    /**
     * Cantidad + sustantivo en singular o plural, en negrita.
     * $kind: '' | 'registered' | 'active' | 'inactive'
     */
    private function countPhrase(int $count, string $kind = ''): string
    {
        $es = [
            '' => ['trabajador', 'trabajadores'],
            'registered' => ['trabajador registrado', 'trabajadores registrados'],
            'active' => ['trabajador activo', 'trabajadores activos'],
            'inactive' => ['trabajador retirado o inactivo', 'trabajadores retirados o inactivos'],
        ];

        $en = [
            '' => ['worker', 'workers'],
            'registered' => ['registered worker', 'registered workers'],
            'active' => ['active worker', 'active workers'],
            'inactive' => ['retired or inactive worker', 'retired or inactive workers'],
        ];

        $words = ($this->isEnglish() ? $en : $es)[$kind];

        return '<strong>' . $count . ' ' . ($count === 1 ? $words[0] : $words[1]) . '</strong>';
    }

    private function inMinerscan(): string
    {
        return $this->isEnglish() ? ' in MINERSCAN.' : ' en MINERSCAN.';
    }

    /**
     * Nombre del rol para mostrar (el valor guardado en la base de datos no cambia).
     */
    private function roleLabel(?string $role): string
    {
        $role = trim((string) $role);

        if ($role === '') {
            return $this->isEnglish() ? 'No role' : 'Sin rol';
        }

        if ($this->isEnglish()) {
            $roles = [
                'Supervisor' => 'Supervisor',
                'Minero' => 'Miner',
                'Operador' => 'Operator',
                'Mantenimiento' => 'Maintenance',
            ];

            return $roles[$role] ?? $role;
        }

        return $role;
    }

    private function shiftLabel(?string $shift): string
    {
        $shift = trim((string) $shift);

        if ($shift === '') {
            return $this->isEnglish() ? 'No shift' : 'Sin turno';
        }

        return $shift;
    }

    private function statusLabel(bool $isActive): string
    {
        if ($this->isEnglish()) {
            return $isActive ? 'Active' : 'Retired / Inactive';
        }

        return $isActive ? 'Activo' : 'Retirado / Inactivo';
    }

    /**
     * Frase de conteo por rol: "Actualmente hay 2 trabajadores con el rol de Minero."
     */
    private function countByRole(int $count, string $kind, string $role): string
    {
        $roleText = '<strong>' . e($this->roleLabel($role)) . '</strong>';

        return $this->currentlyThere($count)
            . ' ' . $this->countPhrase($count, $kind)
            . ($this->isEnglish() ? ' with the role ' : ' con el rol de ')
            . $roleText . '.';
    }

    /**
     * Obtener cantidad total de trabajadores.
     */
    private function getWorkerCountResponse(): string
    {
        $count = Worker::count();

        return $this->currentlyThere($count)
            . ' ' . $this->countPhrase($count, 'registered')
            . $this->inMinerscan();
    }

    /**
     * Obtener cantidad de trabajadores activos.
     */
    private function getActiveWorkerCountResponse(): string
    {
        $count = Worker::where('is_active', true)->count();

        return $this->currentlyThere($count)
            . ' ' . $this->countPhrase($count, 'active')
            . $this->inMinerscan();
    }

    /**
     * Obtener cantidad de trabajadores inactivos.
     */
    private function getInactiveWorkerCountResponse(): string
    {
        $count = Worker::where('is_active', false)->count();

        return $this->currentlyThere($count)
            . ' ' . $this->countPhrase($count, 'inactive')
            . $this->inMinerscan();
    }

    /**
     * Obtener lista de trabajadores.
     */
    private function getWorkersListResponse(): string
    {
        $workers = Worker::orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        if ($workers->isEmpty()) {
            return $this->isEnglish()
                ? 'There are currently no registered workers in MINERSCAN.'
                : 'Actualmente no hay trabajadores registrados en MINERSCAN.';
        }

        $response = $this->isEnglish()
            ? '<strong>Registered workers:</strong><br><br>'
            : '<strong>Trabajadores registrados:</strong><br><br>';

        foreach ($workers as $worker) {

            $name = e(trim($worker->first_name . ' ' . $worker->last_name));
            $role = e($this->roleLabel($worker->role));
            $shift = e($this->shiftLabel($worker->shift));
            $status = $this->statusLabel((bool) $worker->is_active);

            $response .= $this->isEnglish()
                ? '• <strong>' . $name . '</strong> — ' . $role . ' — Shift: ' . $shift . ' — Status: ' . $status . '<br>'
                : '• <strong>' . $name . '</strong> — ' . $role . ' — Turno: ' . $shift . ' — Estado: ' . $status . '<br>';
        }

        return $response;
    }

    /**
     * Obtener trabajadores por rol.
     */
    private function getWorkersByRoleResponse(string $role): string
    {
        $count = Worker::where('role', $role)->count();

        return $this->countByRole($count, '', $role);
    }

    /**
     * Obtener trabajadores activos por rol.
     */
    private function getActiveWorkersByRoleResponse(string $role): string
    {
        $count = Worker::where('role', $role)
            ->where('is_active', true)
            ->count();

        return $this->countByRole($count, 'active', $role);
    }

    /**
     * Obtener trabajadores inactivos por rol.
     */
    private function getInactiveWorkersByRoleResponse(string $role): string
    {
        $count = Worker::where('role', $role)
            ->where('is_active', false)
            ->count();

        return $this->countByRole($count, 'inactive', $role);
    }

    /**
     * Obtener trabajadores agrupados por turno.
     */
    private function getWorkersByShiftResponse(): string
    {
        $workers = Worker::select('shift')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('shift')
            ->orderBy('shift')
            ->get();

        if ($workers->isEmpty()) {
            return $this->isEnglish()
                ? 'There are no registered workers to query by shift.'
                : 'No hay trabajadores registrados para consultar por turno.';
        }

        $response = $this->isEnglish()
            ? '<strong>Workers by shift:</strong><br><br>'
            : '<strong>Trabajadores por turno:</strong><br><br>';

        foreach ($workers as $worker) {

            $shift = e($this->shiftLabel($worker->shift));

            $response .= '• <strong>' . $shift . ':</strong> '
                . $worker->total
                . '<br>';
        }

        return $response;
    }

    /**
     * Obtener trabajadores de un turno específico.
     */
    private function getWorkersBySpecificShiftResponse(string $shift): string
    {
        $workers = Worker::where('shift', $shift)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        if ($workers->isEmpty()) {
            return $this->isEnglish()
                ? 'There are no registered workers on the <strong>' . e($shift) . '</strong> shift.'
                : 'No hay trabajadores registrados en el turno de <strong>' . e($shift) . '</strong>.';
        }

        $response = $this->isEnglish()
            ? '<strong>Workers on the ' . e($shift) . ' shift:</strong><br><br>'
            : '<strong>Trabajadores del turno ' . e($shift) . ':</strong><br><br>';

        foreach ($workers as $worker) {

            $name = e(trim($worker->first_name . ' ' . $worker->last_name));
            $role = e($this->roleLabel($worker->role));
            $status = $this->statusLabel((bool) $worker->is_active);

            $response .= '• <strong>' . $name . '</strong>'
                . ' — ' . $role
                . ' — ' . $status
                . '<br>';
        }

        return $response;
    }

    /**
     * Normalizar texto para facilitar la comparación.
     */
    private function normalize(string $text): string
    {
        $text = mb_strtolower(trim($text), 'UTF-8');

        $text = str_replace(
            [
                'á',
                'é',
                'í',
                'ó',
                'ú',
                'ü',
                'ñ',
            ],
            [
                'a',
                'e',
                'i',
                'o',
                'u',
                'u',
                'n',
            ],
            $text
        );

        /*
         * Eliminamos signos de puntuación.
         */
        $text = preg_replace(
            '/[¿?!¡.,;:()"\'"]/',
            '',
            $text
        );

        /*
         * Eliminamos espacios duplicados.
         */
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    /**
     * Último recurso cuando Gemini no responde y la base local no encontró
     * coincidencia: saludos locales o el mensaje predeterminado, siempre en el
     * idioma del usuario.
     */
    private function fallbackResponse(string $normalized): string
    {
        $greeting = $this->detectGreeting($normalized);

        if ($greeting !== null) {
            $this->lang = $greeting;
            $this->lastSource = 'knowledge';

            return $this->greetingResponse();
        }

        return $this->defaultResponse();
    }

    /**
     * Devuelve 'es' o 'en' si el mensaje es solo un saludo; null si no lo es.
     */
    private function detectGreeting(string $normalized): ?string
    {
        $english = ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'];
        $spanish = ['hola', 'buenas', 'buenos dias', 'buenas tardes', 'buenas noches', 'saludos'];

        $text = preg_replace('/\s+(sofia|there|everyone|todos)$/u', '', $normalized) ?? $normalized;

        if (in_array($text, $english, true)) {
            return 'en';
        }

        if (in_array($text, $spanish, true)) {
            return 'es';
        }

        return null;
    }

    private function greetingResponse(): string
    {
        if ($this->isEnglish()) {
            return 'Hello! I am <strong>SOFIA</strong>, the virtual assistant of MINERSCAN. '
                . 'You can ask me about <strong>workers, biometric attendance, UWB geolocation, the dashboard or reports</strong>.';
        }

        return '¡Hola! Soy <strong>SOFIA</strong>, la asistente virtual de MINERSCAN. '
            . 'Puedes preguntarme sobre <strong>trabajadores, asistencia biométrica, geolocalización UWB, el dashboard o los reportes</strong>.';
    }

    /**
     * Respuesta cuando no se encuentra una coincidencia (en el idioma del usuario).
     */
    private function defaultResponse(): string
    {
        if ($this->isEnglish()) {
            return 'I could not answer that question right now: my AI service is not responding and I do not have a specific answer in my MINERSCAN knowledge base. '
                . 'You can ask me about <strong>workers, biometric attendance, UWB geolocation, Tags, Anchors, the dashboard, reports or how the platform works</strong>, or try again in a few minutes.';
        }

        return 'En este momento no pude responder esa pregunta: mi servicio de IA no está respondiendo y no tengo una respuesta específica en mi base de conocimiento de MINERSCAN. '
            . 'Puedes preguntarme sobre <strong>trabajadores, asistencia biométrica, geolocalización UWB, Tags, Anchors, dashboard, reportes o el funcionamiento general de la plataforma</strong>, o intentarlo de nuevo en unos minutos.';
    }
}