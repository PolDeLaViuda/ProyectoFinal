<?php
// ================================================================
//  DATOS Y GENERADOR DE PARTIDOS
// ================================================================

// Logos ESPN CDN - muy fiables
define('NBA_LOGO', 'https://a.espncdn.com/i/teamlogos/nba/500/');
define('LL_LOGO',  'https://a.espncdn.com/i/teamlogos/soccer/500/');

function equipos_nba(): array {
    $b = NBA_LOGO;
    return [
        ['id'=>1,  'name'=>'Boston Celtics',        'logo'=>$b.'bos.png',  'conf'=>'Este',  'w'=>52,'l'=>18],
        ['id'=>2,  'name'=>'New York Knicks',        'logo'=>$b.'ny.png',   'conf'=>'Este',  'w'=>46,'l'=>24],
        ['id'=>3,  'name'=>'Philadelphia 76ers',     'logo'=>$b.'phi.png',  'conf'=>'Este',  'w'=>35,'l'=>35],
        ['id'=>4,  'name'=>'Toronto Raptors',        'logo'=>$b.'tor.png',  'conf'=>'Este',  'w'=>22,'l'=>48],
        ['id'=>5,  'name'=>'Brooklyn Nets',          'logo'=>$b.'bkn.png',  'conf'=>'Este',  'w'=>18,'l'=>52],
        ['id'=>6,  'name'=>'Milwaukee Bucks',        'logo'=>$b.'mil.png',  'conf'=>'Este',  'w'=>48,'l'=>22],
        ['id'=>7,  'name'=>'Cleveland Cavaliers',    'logo'=>$b.'cle.png',  'conf'=>'Este',  'w'=>47,'l'=>23],
        ['id'=>8,  'name'=>'Indiana Pacers',         'logo'=>$b.'ind.png',  'conf'=>'Este',  'w'=>44,'l'=>26],
        ['id'=>9,  'name'=>'Chicago Bulls',          'logo'=>$b.'chi.png',  'conf'=>'Este',  'w'=>30,'l'=>40],
        ['id'=>10, 'name'=>'Detroit Pistons',        'logo'=>$b.'det.png',  'conf'=>'Este',  'w'=>16,'l'=>54],
        ['id'=>11, 'name'=>'Miami Heat',             'logo'=>$b.'mia.png',  'conf'=>'Este',  'w'=>42,'l'=>28],
        ['id'=>12, 'name'=>'Orlando Magic',          'logo'=>$b.'orl.png',  'conf'=>'Este',  'w'=>38,'l'=>32],
        ['id'=>13, 'name'=>'Atlanta Hawks',          'logo'=>$b.'atl.png',  'conf'=>'Este',  'w'=>32,'l'=>38],
        ['id'=>14, 'name'=>'Charlotte Hornets',      'logo'=>$b.'cha.png',  'conf'=>'Este',  'w'=>20,'l'=>50],
        ['id'=>15, 'name'=>'Washington Wizards',     'logo'=>$b.'wsh.png',  'conf'=>'Este',  'w'=>14,'l'=>56],
        ['id'=>16, 'name'=>'OKC Thunder',            'logo'=>$b.'okc.png',  'conf'=>'Oeste', 'w'=>57,'l'=>13],
        ['id'=>17, 'name'=>'Minnesota T-Wolves',     'logo'=>$b.'min.png',  'conf'=>'Oeste', 'w'=>49,'l'=>21],
        ['id'=>18, 'name'=>'Denver Nuggets',         'logo'=>$b.'den.png',  'conf'=>'Oeste', 'w'=>48,'l'=>22],
        ['id'=>19, 'name'=>'Utah Jazz',              'logo'=>$b.'utah.png', 'conf'=>'Oeste', 'w'=>22,'l'=>48],
        ['id'=>20, 'name'=>'Portland T. Blazers',    'logo'=>$b.'por.png',  'conf'=>'Oeste', 'w'=>20,'l'=>50],
        ['id'=>21, 'name'=>'Golden State Warriors',  'logo'=>$b.'gs.png',   'conf'=>'Oeste', 'w'=>40,'l'=>30],
        ['id'=>22, 'name'=>'LA Clippers',            'logo'=>$b.'lac.png',  'conf'=>'Oeste', 'w'=>38,'l'=>32],
        ['id'=>23, 'name'=>'Phoenix Suns',           'logo'=>$b.'phx.png',  'conf'=>'Oeste', 'w'=>34,'l'=>36],
        ['id'=>24, 'name'=>'Sacramento Kings',       'logo'=>$b.'sac.png',  'conf'=>'Oeste', 'w'=>32,'l'=>38],
        ['id'=>25, 'name'=>'Los Angeles Lakers',     'logo'=>$b.'lal.png',  'conf'=>'Oeste', 'w'=>42,'l'=>28],
        ['id'=>26, 'name'=>'Houston Rockets',        'logo'=>$b.'hou.png',  'conf'=>'Oeste', 'w'=>48,'l'=>22],
        ['id'=>27, 'name'=>'Memphis Grizzlies',      'logo'=>$b.'mem.png',  'conf'=>'Oeste', 'w'=>30,'l'=>40],
        ['id'=>28, 'name'=>'Dallas Mavericks',       'logo'=>$b.'dal.png',  'conf'=>'Oeste', 'w'=>38,'l'=>32],
        ['id'=>29, 'name'=>'New Orleans Pelicans',   'logo'=>$b.'no.png',   'conf'=>'Oeste', 'w'=>28,'l'=>42],
        ['id'=>30, 'name'=>'San Antonio Spurs',      'logo'=>$b.'sa.png',   'conf'=>'Oeste', 'w'=>22,'l'=>48],
    ];
}

function equipos_laliga(): array {
    // Logos desde API-Football CDN — fiables y correctos
    $b = 'https://media.api-sports.io/football/teams/';
    return [
        ['id'=>1,  'name'=>'Real Madrid',        'logo'=>$b.'541.png',  'pts'=>72,'pj'=>30,'w'=>22,'d'=>6, 'l'=>2, 'gf'=>68,'gc'=>28,'forma'=>'WDDWL'],
        ['id'=>2,  'name'=>'FC Barcelona',       'logo'=>$b.'529.png',  'pts'=>78,'pj'=>30,'w'=>24,'d'=>6, 'l'=>0, 'gf'=>74,'gc'=>18,'forma'=>'WWWDW'],
        ['id'=>3,  'name'=>'Atletico de Madrid', 'logo'=>$b.'530.png',  'pts'=>65,'pj'=>30,'w'=>19,'d'=>8, 'l'=>3, 'gf'=>55,'gc'=>32,'forma'=>'WWDWL'],
        ['id'=>4,  'name'=>'Athletic Club',      'logo'=>$b.'531.png',  'pts'=>58,'pj'=>30,'w'=>16,'d'=>10,'l'=>4, 'gf'=>46,'gc'=>30,'forma'=>'DWWWD'],
        ['id'=>5,  'name'=>'Villarreal CF',      'logo'=>$b.'533.png',  'pts'=>55,'pj'=>30,'w'=>15,'d'=>10,'l'=>5, 'gf'=>50,'gc'=>38,'forma'=>'WDWLW'],
        ['id'=>6,  'name'=>'Real Sociedad',      'logo'=>$b.'548.png',  'pts'=>50,'pj'=>30,'w'=>14,'d'=>8, 'l'=>8, 'gf'=>44,'gc'=>36,'forma'=>'LWWDW'],
        ['id'=>7,  'name'=>'Sevilla FC',         'logo'=>$b.'536.png',  'pts'=>47,'pj'=>30,'w'=>13,'d'=>8, 'l'=>9, 'gf'=>40,'gc'=>38,'forma'=>'DWLDW'],
        ['id'=>8,  'name'=>'Real Betis',         'logo'=>$b.'543.png',  'pts'=>45,'pj'=>30,'w'=>12,'d'=>9, 'l'=>9, 'gf'=>42,'gc'=>40,'forma'=>'WDLWD'],
        ['id'=>9,  'name'=>'Valencia CF',        'logo'=>$b.'532.png',  'pts'=>42,'pj'=>30,'w'=>12,'d'=>6, 'l'=>12,'gf'=>38,'gc'=>42,'forma'=>'LWWLD'],
        ['id'=>10, 'name'=>'Rayo Vallecano',     'logo'=>$b.'728.png',  'pts'=>39,'pj'=>30,'w'=>10,'d'=>9, 'l'=>11,'gf'=>35,'gc'=>40,'forma'=>'DLLWW'],
        ['id'=>11, 'name'=>'Getafe CF',          'logo'=>$b.'546.png',  'pts'=>37,'pj'=>30,'w'=>10,'d'=>7, 'l'=>13,'gf'=>30,'gc'=>38,'forma'=>'LDDWL'],
        ['id'=>12, 'name'=>'Deportivo Alaves',   'logo'=>$b.'542.png',  'pts'=>36,'pj'=>30,'w'=>9, 'd'=>9, 'l'=>12,'gf'=>34,'gc'=>44,'forma'=>'DLWLD'],
        ['id'=>13, 'name'=>'Celta de Vigo',      'logo'=>$b.'538.png',  'pts'=>35,'pj'=>30,'w'=>9, 'd'=>8, 'l'=>13,'gf'=>36,'gc'=>46,'forma'=>'LWDDL'],
        ['id'=>14, 'name'=>'Osasuna',            'logo'=>$b.'727.png',  'pts'=>34,'pj'=>30,'w'=>9, 'd'=>7, 'l'=>14,'gf'=>32,'gc'=>45,'forma'=>'WLLDL'],
        ['id'=>15, 'name'=>'Espanyol',           'logo'=>$b.'540.png',  'pts'=>33,'pj'=>30,'w'=>8, 'd'=>9, 'l'=>13,'gf'=>30,'gc'=>44,'forma'=>'DLLWD'],
        ['id'=>16, 'name'=>'Girona FC',          'logo'=>$b.'547.png',  'pts'=>32,'pj'=>30,'w'=>8, 'd'=>8, 'l'=>14,'gf'=>34,'gc'=>50,'forma'=>'LLDWL'],
        ['id'=>17, 'name'=>'Las Palmas',         'logo'=>$b.'534.png',  'pts'=>30,'pj'=>30,'w'=>7, 'd'=>9, 'l'=>14,'gf'=>28,'gc'=>46,'forma'=>'DLLDL'],
        ['id'=>18, 'name'=>'Mallorca',           'logo'=>$b.'798.png',  'pts'=>29,'pj'=>30,'w'=>7, 'd'=>8, 'l'=>15,'gf'=>26,'gc'=>48,'forma'=>'LDDLL'],
        ['id'=>19, 'name'=>'Valladolid',         'logo'=>$b.'720.png',  'pts'=>22,'pj'=>30,'w'=>4, 'd'=>10,'l'=>16,'gf'=>22,'gc'=>54,'forma'=>'LLLDD'],
        ['id'=>20, 'name'=>'Leganes',            'logo'=>$b.'724.png',  'pts'=>20,'pj'=>30,'w'=>4, 'd'=>8, 'l'=>18,'gf'=>20,'gc'=>58,'forma'=>'LLLLD'],
    ];
}

function jugadores_nba(): array {
    return [
        1  => ['name'=>'Jayson Tatum',            'pts'=>27,'reb'=>8, 'ast'=>5],
        2  => ['name'=>'Jalen Brunson',           'pts'=>29,'reb'=>4, 'ast'=>7],
        3  => ['name'=>'Joel Embiid',             'pts'=>35,'reb'=>11,'ast'=>6],
        4  => ['name'=>'Scottie Barnes',          'pts'=>20,'reb'=>8, 'ast'=>6],
        5  => ['name'=>'Cam Thomas',              'pts'=>23,'reb'=>4, 'ast'=>3],
        6  => ['name'=>'Giannis Antetokounmpo',   'pts'=>33,'reb'=>12,'ast'=>7],
        7  => ['name'=>'Donovan Mitchell',        'pts'=>27,'reb'=>5, 'ast'=>6],
        8  => ['name'=>'Tyrese Haliburton',       'pts'=>20,'reb'=>4, 'ast'=>11],
        9  => ['name'=>'Nikola Vucevic',          'pts'=>21,'reb'=>11,'ast'=>4],
        10 => ['name'=>'Cade Cunningham',         'pts'=>24,'reb'=>4, 'ast'=>9],
        11 => ['name'=>'Bam Adebayo',             'pts'=>20,'reb'=>10,'ast'=>5],
        12 => ['name'=>'Paolo Banchero',          'pts'=>26,'reb'=>7, 'ast'=>5],
        13 => ['name'=>'Trae Young',              'pts'=>26,'reb'=>3, 'ast'=>11],
        14 => ['name'=>'LaMelo Ball',             'pts'=>24,'reb'=>6, 'ast'=>9],
        15 => ['name'=>'Kyle Kuzma',              'pts'=>18,'reb'=>7, 'ast'=>4],
        16 => ['name'=>'Shai G-Alexander',        'pts'=>31,'reb'=>6, 'ast'=>6],
        17 => ['name'=>'Anthony Edwards',         'pts'=>26,'reb'=>5, 'ast'=>5],
        18 => ['name'=>'Nikola Jokic',            'pts'=>26,'reb'=>12,'ast'=>9],
        19 => ['name'=>'Lauri Markkanen',         'pts'=>23,'reb'=>8, 'ast'=>2],
        20 => ['name'=>'Anfernee Simons',         'pts'=>21,'reb'=>3, 'ast'=>5],
        21 => ['name'=>'Stephen Curry',           'pts'=>26,'reb'=>5, 'ast'=>6],
        22 => ['name'=>'Kawhi Leonard',           'pts'=>22,'reb'=>6, 'ast'=>4],
        23 => ['name'=>'Devin Booker',            'pts'=>27,'reb'=>5, 'ast'=>7],
        24 => ['name'=>'Domantas Sabonis',        'pts'=>18,'reb'=>13,'ast'=>8],
        25 => ['name'=>'LeBron James',            'pts'=>26,'reb'=>7, 'ast'=>8],
        26 => ['name'=>'Alperen Sengun',          'pts'=>21,'reb'=>10,'ast'=>5],
        27 => ['name'=>'Ja Morant',               'pts'=>25,'reb'=>6, 'ast'=>8],
        28 => ['name'=>'Luka Doncic',             'pts'=>29,'reb'=>9, 'ast'=>8],
        29 => ['name'=>'Zion Williamson',         'pts'=>23,'reb'=>6, 'ast'=>5],
        30 => ['name'=>'Victor Wembanyama',       'pts'=>21,'reb'=>11,'ast'=>4],
    ];
}

function jugadores_laliga(): array {
    return [
        1  => ['name'=>'Vinicius Jr.',    'goles'=>20,'asist'=>12,'rating'=>8.8],
        2  => ['name'=>'Lewandowski',     'goles'=>24,'asist'=>8, 'rating'=>8.7],
        3  => ['name'=>'Griezmann',       'goles'=>15,'asist'=>10,'rating'=>8.5],
        4  => ['name'=>'Nico Williams',   'goles'=>12,'asist'=>14,'rating'=>8.3],
        5  => ['name'=>'Gerard Moreno',   'goles'=>14,'asist'=>7, 'rating'=>8.1],
        6  => ['name'=>'Oyarzabal',       'goles'=>13,'asist'=>8, 'rating'=>8.0],
        7  => ['name'=>'En-Nesyri',       'goles'=>18,'asist'=>4, 'rating'=>7.9],
        8  => ['name'=>'Ayoze Perez',     'goles'=>10,'asist'=>9, 'rating'=>7.7],
        9  => ['name'=>'Hugo Duro',       'goles'=>11,'asist'=>4, 'rating'=>7.5],
        10 => ['name'=>'Alvaro Garcia',   'goles'=>8, 'asist'=>6, 'rating'=>7.4],
        11 => ['name'=>'Borja Mayoral',   'goles'=>9, 'asist'=>3, 'rating'=>7.3],
        12 => ['name'=>'Aleix Garcia',    'goles'=>4, 'asist'=>8, 'rating'=>7.2],
        13 => ['name'=>'Iago Aspas',      'goles'=>14,'asist'=>7, 'rating'=>8.0],
        14 => ['name'=>'Bryan Zaragoza',  'goles'=>7, 'asist'=>5, 'rating'=>7.0],
        15 => ['name'=>'Javier Puado',    'goles'=>8, 'asist'=>3, 'rating'=>6.9],
        16 => ['name'=>'Samu Omorodion',  'goles'=>9, 'asist'=>2, 'rating'=>7.0],
        17 => ['name'=>'Fabio Silva',     'goles'=>7, 'asist'=>3, 'rating'=>6.8],
        18 => ['name'=>'Vedat Muriqi',    'goles'=>10,'asist'=>2, 'rating'=>7.1],
        19 => ['name'=>'Selim Amallah',   'goles'=>5, 'asist'=>4, 'rating'=>6.6],
        20 => ['name'=>'Yvan Neyou',      'goles'=>3, 'asist'=>2, 'rating'=>6.4],
    ];
}

// ── GENERADOR ─────────────────────────────────────────────────────────
function generar_partidos(string $fecha, string $liga): array {
    // Seed fija por fecha: mismo dia = mismos partidos siempre
    $seed = abs(crc32($fecha . '|' . $liga . '|sz2025'));
    mt_srand($seed);

    $equipos = ($liga === 'nba') ? equipos_nba() : equipos_laliga();

    // Cuantos partidos
    if ($liga === 'nba') {
        $num = mt_rand(6, 10);
    } else {
        $dow = (int)date('N', strtotime($fecha)); // 1=Lun 7=Dom
        if ($dow === 6 || $dow === 7) {
            $num = mt_rand(3, 5);
        } elseif ($dow === 5) {
            $num = mt_rand(1, 3);
        } elseif ($dow === 2) {
            $num = mt_rand(0, 2);
        } else {
            $num = 0;
        }
        if ($num === 0) return [];
    }

    // Mezclar con seed fija
    $indices = range(0, count($equipos) - 1);
    // Fisher-Yates con mt_rand
    for ($i = count($indices) - 1; $i > 0; $i--) {
        $j = mt_rand(0, $i);
        [$indices[$i], $indices[$j]] = [$indices[$j], $indices[$i]];
    }

    $hoy      = date('Y-m-d');
    $es_hoy   = ($fecha === $hoy);
    $es_pasado= ($fecha < $hoy);

    $partidos = [];
    $slot     = 0;
    while (count($partidos) < $num && $slot * 2 + 1 < count($indices)) {
        $local     = $equipos[$indices[$slot * 2]];
        $visitante = $equipos[$indices[$slot * 2 + 1]];
        $slot++;

        // Hora
        if ($liga === 'nba') {
            $horas_nba = ['19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30'];
            $hora = $horas_nba[mt_rand(0, count($horas_nba) - 1)];
        } else {
            $horas_ll = ['14:00','16:15','18:30','19:00','21:00'];
            $hora = $horas_ll[mt_rand(0, count($horas_ll) - 1)];
        }

        // Estado
        if ($es_pasado) {
            $estado = 'FT';
        } elseif ($es_hoy) {
            $r = mt_rand(0, 2);
            $estado = ($r === 0) ? 'FT' : (($r === 1) ? 'LIVE' : 'NS');
        } else {
            $estado = 'NS';
        }

        // Marcador
        $g_l = null; $g_v = null; $periodo = '';
        if ($estado === 'FT') {
            if ($liga === 'nba') {
                $g_l = mt_rand(95, 130);
                $g_v = mt_rand(95, 130);
                if ($g_l === $g_v) $g_l++;
            } else {
                $g_l = mt_rand(0, 4);
                $g_v = mt_rand(0, 3);
            }
        } elseif ($estado === 'LIVE') {
            if ($liga === 'nba') {
                $ps = ['Q1','Q2','Q3','Q4'];
                $periodo = $ps[mt_rand(0, 3)];
                $g_l = mt_rand(18, 95);
                $g_v = mt_rand(18, 95);
            } else {
                $periodo = mt_rand(1, 89) . "'";
                $g_l = mt_rand(0, 2);
                $g_v = mt_rand(0, 2);
            }
        }

        // Probabilidades
        $tw = $local['w'] + $visitante['w'];
        $pl = ($tw > 0) ? (int)round($local['w'] / $tw * 100) : 50;
        $pv = 100 - $pl;
        $pe = 0;
        if ($liga === 'laliga') {
            $pe = mt_rand(22, 28);
            $pl = max(20, $pl - (int)($pe / 2));
            $pv = max(5, 100 - $pl - $pe);
            $pl = 100 - $pe - $pv;
        }

        // Top jugador
        $tl = null; $tv = null;
        if ($estado === 'FT') {
            if ($liga === 'nba') {
                $jug = jugadores_nba();
                $tl  = isset($jug[$local['id']])     ? $jug[$local['id']]     : null;
                $tv  = isset($jug[$visitante['id']]) ? $jug[$visitante['id']] : null;
                if ($tl) $tl['pts'] = mt_rand(max(5, $tl['pts'] - 10), $tl['pts'] + 10);
                if ($tv) $tv['pts'] = mt_rand(max(5, $tv['pts'] - 10), $tv['pts'] + 10);
            } else {
                $jug = jugadores_laliga();
                $tl  = isset($jug[$local['id']])     ? $jug[$local['id']]     : null;
                $tv  = isset($jug[$visitante['id']]) ? $jug[$visitante['id']] : null;
            }
        }

        $partidos[] = [
            'local'   => $local,   'visitante'=> $visitante,
            'hora'    => $hora,    'estado'   => $estado,
            'periodo' => $periodo, 'g_l'      => $g_l,   'g_v'=>$g_v,
            'pl'      => $pl,      'pv'       => $pv,    'pe' =>$pe,
            'tl'      => $tl,      'tv'       => $tv,
        ];
    }

    usort($partidos, fn($a, $b) => strcmp($a['hora'], $b['hora']));
    return $partidos;
}

// ── HELPERS DE FECHA ─────────────────────────────────────────────────
function fecha_es(string $f): string {
    $dias  = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    $meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio',
              'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $ts = strtotime($f);
    return $dias[(int)date('w',$ts)] . ' ' . (int)date('j',$ts) . ' de ' . $meses[(int)date('n',$ts)];
}

function primer_dia_mes(string $fecha): string {
    return date('Y-m-01', strtotime($fecha));
}

function mes_anterior(string $fecha): string {
    return date('Y-m-d', strtotime(primer_dia_mes($fecha) . ' -1 month'));
}

function mes_siguiente(string $fecha): string {
    return date('Y-m-d', strtotime(primer_dia_mes($fecha) . ' +1 month'));
}
