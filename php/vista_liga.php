<?php
// ================================================================
//  PLANTILLA COMPARTIDA: renderiza la pagina completa de una liga
//  Variables requeridas antes de incluir este archivo:
//    $liga       'nba' | 'laliga'
//    $titulo     texto del <h1>
//    $icono      emoji
//    $temporada  texto del badge
//    $pagina     'nba' | 'laliga'   (nombre del archivo .php)
//    $css_header clase CSS del header ('nba-header' | 'laliga-header')
//    $nombre     nombre del usuario (ya htmlspecialchars)
// ================================================================

require_once 'php/datos.php';

// --- Leer parametros de la URL ---
$fecha_sel = isset($_GET['fecha']) ? trim($_GET['fecha']) : date('Y-m-d');
// Validar formato YYYY-MM-DD
if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $fecha_sel)) {
    $fecha_sel = date('Y-m-d');
}
$vista = (isset($_GET['vista']) && $_GET['vista'] === 'clasificacion') ? 'clasificacion' : 'calendario';

// --- Generar partidos ---
$todos = generar_partidos($fecha_sel, $liga);

// --- Datos clasificacion ---
$equipos_todos = ($liga === 'nba') ? equipos_nba() : equipos_laliga();

// --- Variables calendario ---
$ts          = strtotime($fecha_sel);
$mes_ano     = date('Y-m', $ts);
$anio        = (int)date('Y', $ts);
$num_mes     = (int)date('n', $ts);
$primer_dia  = (int)date('N', strtotime($mes_ano . '-01')); // 1=Lun 7=Dom
$dias_mes    = (int)date('t', $ts);
$meses_es    = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
$nombre_mes  = $meses_es[$num_mes];
$f_mes_ant   = mes_anterior($fecha_sel);
$f_mes_sig   = mes_siguiente($fecha_sel);
$url_ant     = $pagina . '.php?vista=calendario&fecha=' . $f_mes_ant;
$url_sig     = $pagina . '.php?vista=calendario&fecha=' . $f_mes_sig;
$url_cal     = $pagina . '.php?vista=calendario&fecha=' . $fecha_sel;
$url_clas    = $pagina . '.php?vista=clasificacion&fecha=' . $fecha_sel;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?> - StatsZone</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>

<header class="cabecera">
    <a href="home.php" class="logo">&#128202; StatsZone</a>
    <div class="usuario-info">
        &#128100; <a href="perfil.php" class="usuario-nombre-link"><?= $nombre ?></a>
        <a href="php/cerrar_sesion.php" class="boton-salir">Cerrar sesion</a>
    </div>
</header>

<div class="liga-header <?= $css_header ?>">
    <a href="home.php" class="btn-volver">&#8592; Volver</a>
    <h1><?= $icono ?> <?= htmlspecialchars($titulo) ?> <span class="temporada-badge"><?= htmlspecialchars($temporada) ?></span></h1>
    <nav class="liga-tabs">
        <a href="<?= $url_cal  ?>" class="liga-tab <?= $vista==='calendario'    ? 'liga-tab--activo' : '' ?>">Calendario</a>
        <a href="<?= $url_clas ?>" class="liga-tab <?= $vista==='clasificacion' ? 'liga-tab--activo' : '' ?>">Clasificacion</a>
    </nav>
</div>

<div class="pagina-liga">

<?php if ($vista === 'calendario'): ?>

<div class="layout-calendario">

    <!-- ===== MINI CALENDARIO ===== -->
    <aside class="selector-fecha">
        <div class="cal-nav">
            <a href="<?= $url_ant ?>" class="cal-nav-btn">&#8249;</a>
            <span class="cal-mes-titulo"><?= $nombre_mes ?> <?= $anio ?></span>
            <a href="<?= $url_sig ?>" class="cal-nav-btn">&#8250;</a>
        </div>
        <div class="cal-grid">
            <?php foreach (['Lu','Ma','Mi','Ju','Vi','Sa','Do'] as $d): ?>
                <div class="cal-dia-semana"><?= $d ?></div>
            <?php endforeach; ?>
            <?php
            // Espacios vacios (Lunes=offset 0)
            for ($i = 0; $i < $primer_dia - 1; $i++):
            ?>
                <div class="cal-dia cal-dia--vacio"></div>
            <?php endfor; ?>
            <?php for ($d = 1; $d <= $dias_mes; $d++):
                $fd  = $mes_ano . '-' . str_pad($d, 2, '0', STR_PAD_LEFT);
                $cls = 'cal-dia';
                if ($fd === date('Y-m-d')) $cls .= ' cal-dia--hoy';
                if ($fd === $fecha_sel)    $cls .= ' cal-dia--seleccionado';
                $url_dia = $pagina . '.php?vista=calendario&fecha=' . $fd;
            ?>
                <a href="<?= $url_dia ?>" class="<?= $cls ?>"><?= $d ?></a>
            <?php endfor; ?>
        </div>
        <p class="cal-leyenda"><?= fecha_es($fecha_sel) ?></p>
    </aside>

    <!-- ===== PARTIDOS DEL DIA ===== -->
    <section class="partidos-lista">
        <h2 class="partidos-titulo"><?= fecha_es($fecha_sel) ?></h2>

        <?php if (empty($todos)): ?>
            <div class="sin-datos">
                <p>No hay partidos este dia.</p>
                <?php if ($liga === 'laliga'): ?>
                    <p class="sin-datos-sub">La Liga juega principalmente viernes, sabados y domingos.</p>
                <?php endif; ?>
            </div>

        <?php elseif ($liga === 'nba'): ?>
            <?php
            $este  = array_values(array_filter($todos, fn($p) => $p['local']['conf']==='Este'  && $p['visitante']['conf']==='Este'));
            $oeste = array_values(array_filter($todos, fn($p) => $p['local']['conf']==='Oeste' && $p['visitante']['conf']==='Oeste'));
            $inter = array_values(array_filter($todos, fn($p) => $p['local']['conf'] !== $p['visitante']['conf']));
            ?>
            <?php if (!empty($este)): ?>
            <div class="seccion-conf seccion-conf--este">
                <h3 class="seccion-conf-titulo">&#128309; Conferencia Este</h3>
                <?php foreach ($este  as $p) render_partido_html($p, 'nba'); ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($inter)): ?>
            <div class="seccion-conf seccion-conf--inter">
                <h3 class="seccion-conf-titulo">&#9889; Este vs Oeste</h3>
                <?php foreach ($inter as $p) render_partido_html($p, 'nba'); ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($oeste)): ?>
            <div class="seccion-conf seccion-conf--oeste">
                <h3 class="seccion-conf-titulo">&#128308; Conferencia Oeste</h3>
                <?php foreach ($oeste as $p) render_partido_html($p, 'nba'); ?>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <?php foreach ($todos as $p) render_partido_html($p, 'laliga'); ?>
        <?php endif; ?>

    </section>
</div><!-- layout-calendario -->

<?php else: // CLASIFICACION ?>

<div class="clasificacion-wrap">
    <?php if ($liga === 'nba'):
        $conf_este  = array_values(array_filter($equipos_todos, fn($e) => $e['conf']==='Este'));
        $conf_oeste = array_values(array_filter($equipos_todos, fn($e) => $e['conf']==='Oeste'));
        usort($conf_este,  fn($a,$b) => $b['w'] - $a['w']);
        usort($conf_oeste, fn($a,$b) => $b['w'] - $a['w']);
        foreach (['&#128309; Conferencia Este'=>$conf_este,'&#128308; Conferencia Oeste'=>$conf_oeste] as $tit=>$lista):
    ?>
        <div class="conferencia-bloque">
            <h2 class="conferencia-titulo"><?= $tit ?></h2>
            <table class="tabla-clasificacion">
                <thead><tr><th>#</th><th colspan="2">Equipo</th><th>V</th><th>D</th><th>%</th></tr></thead>
                <tbody>
                <?php foreach ($lista as $pos => $eq):
                    $tot = $eq['w'] + $eq['l'];
                    $pct = $tot > 0 ? number_format($eq['w']/$tot, 3) : '.000';
                    $pc  = $pos < 6 ? 'pos--champions' : ($pos >= 14 ? 'pos--descenso' : '');
                ?>
                    <tr>
                        <td class="pos-num <?= $pc ?>"><?= $pos+1 ?></td>
                        <td><a href="equipo.php?liga=nba&id=<?= $eq['id'] ?>"><img src="<?= htmlspecialchars($eq['logo']) ?>" class="escudo-mini" alt="" onerror="this.style.display='none'"></a></td>
                        <td class="equipo-nombre-tabla"><a href="equipo.php?liga=nba&id=<?= $eq['id'] ?>" class="link-equipo"><?= htmlspecialchars($eq['name']) ?></a></td>
                        <td class="num-verde"><?= $eq['w'] ?></td>
                        <td class="num-rojo"><?= $eq['l'] ?></td>
                        <td><?= $pct ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach;
    else: // laliga
        usort($equipos_todos, fn($a,$b) => $b['pts'] - $a['pts']);
    ?>
        <table class="tabla-clasificacion tabla-clasificacion--full">
            <thead><tr>
                <th>#</th><th colspan="2">Equipo</th>
                <th>PJ</th><th>V</th><th>E</th><th>D</th>
                <th>GF</th><th>GC</th><th>DG</th><th>Pts</th><th>Forma</th>
            </tr></thead>
            <tbody>
            <?php foreach ($equipos_todos as $i => $eq):
                $rank = $i + 1;
                $dg   = $eq['gf'] - $eq['gc'];
                $pc   = $rank<=4 ? 'pos--champions' : ($rank<=6 ? 'pos--europa' : ($rank>=18 ? 'pos--descenso' : ''));
            ?>
                <tr>
                    <td class="pos-num <?= $pc ?>"><?= $rank ?></td>
                    <td><a href="equipo.php?liga=laliga&id=<?= $eq['id'] ?>"><img src="<?= htmlspecialchars($eq['logo']) ?>" class="escudo-mini" alt="" onerror="this.style.display='none'"></a></td>
                    <td class="equipo-nombre-tabla"><a href="equipo.php?liga=laliga&id=<?= $eq['id'] ?>" class="link-equipo"><?= htmlspecialchars($eq['name']) ?></a></td>
                    <td><?= $eq['pj'] ?></td>
                    <td class="num-verde"><?= $eq['w'] ?></td>
                    <td><?= $eq['d'] ?></td>
                    <td class="num-rojo"><?= $eq['l'] ?></td>
                    <td><?= $eq['gf'] ?></td>
                    <td><?= $eq['gc'] ?></td>
                    <td><?= ($dg>=0?'+':'').$dg ?></td>
                    <td class="pts-col"><?= $eq['pts'] ?></td>
                    <td>
                        <div class="forma-badges">
                        <?php foreach (str_split($eq['forma']) as $r):
                            $rc = $r==='W'?'forma-v':($r==='D'?'forma-e':'forma-d');
                        ?>
                            <span class="forma-badge <?= $rc ?>"><?= $r ?></span>
                        <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="leyenda-clasificacion">
            <span class="leyenda-item"><span class="pos-dot pos--champions"></span> Champions League</span>
            <span class="leyenda-item"><span class="pos-dot pos--europa"></span> Europa / Conference</span>
            <span class="leyenda-item"><span class="pos-dot pos--descenso"></span> Descenso</span>
        </div>
    <?php endif; ?>
</div>

<?php endif; // fin vista ?>

</div><!-- pagina-liga -->
</body>
</html>

<?php
// ================================================================
//  FUNCION RENDER PARTIDO  (definida aqui para que este disponible)
// ================================================================
function render_partido_html(array $p, string $liga): void {
    $fin  = ($p['estado'] === 'FT');
    $vivo = ($p['estado'] === 'LIVE');
    $cls  = 'partido-card';
    if ($liga === 'nba') $cls .= ' partido-card--nba';
    if ($vivo) $cls .= ' partido-card--vivo';
    if ($fin)  $cls .= ' partido-card--finalizado';
    ?>
    <div class="<?= $cls ?>">

        <div class="partido-estado">
            <?php if ($vivo): ?>
                <span class="badge badge--vivo">&#128308; EN JUEGO &middot; <?= htmlspecialchars($p['periodo']) ?></span>
            <?php elseif ($fin): ?>
                <span class="badge badge--fin">Final</span>
            <?php else: ?>
                <span class="badge badge--hora"><?= htmlspecialchars($p['hora']) ?></span>
            <?php endif; ?>
            <?php if ($liga === 'nba'): ?>
                <?php
                $misma = ($p['local']['conf'] === $p['visitante']['conf']);
                $cc    = $misma ? strtolower($p['local']['conf']) : 'inter';
                $ct    = $misma ? $p['local']['conf'] : 'Inter-conf.';
                ?>
                <span class="conf-badge conf-<?= $cc ?>"><?= htmlspecialchars($ct) ?></span>
            <?php endif; ?>
        </div>

        <div class="partido-equipos">
            <a href="equipo.php?liga=<?= $liga ?>&id=<?= $p['local']['id'] ?>" class="equipo equipo-link">
                <img src="<?= htmlspecialchars($p['local']['logo']) ?>" class="escudo"
                     alt="<?= htmlspecialchars($p['local']['name']) ?>"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2252%22 height=%2252%22><rect width=%2252%22 height=%2252%22 rx=%228%22 fill=%22%23e2e8f0%22/><text x=%2226%22 y=%2233%22 text-anchor=%22middle%22 font-size=%2218%22>?</text></svg>'">
                <span class="equipo-nombre"><?= htmlspecialchars($p['local']['name']) ?></span>
                <?php if ($liga === 'nba'): ?>
                    <span class="record"><?= $p['local']['w'] ?>W &middot; <?= $p['local']['l'] ?>L</span>
                <?php endif; ?>
            </a>

            <div class="marcador">
                <?php if ($fin || $vivo): ?>
                    <div class="marcador-goles"><?= $p['g_l'] ?> &ndash; <?= $p['g_v'] ?></div>
                    <?php if ($vivo): ?>
                        <div class="marcador-periodo"><?= htmlspecialchars($p['periodo']) ?></div>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="marcador-vs">VS</span>
                <?php endif; ?>
            </div>

            <a href="equipo.php?liga=<?= $liga ?>&id=<?= $p['visitante']['id'] ?>" class="equipo equipo-link">
                <img src="<?= htmlspecialchars($p['visitante']['logo']) ?>" class="escudo"
                     alt="<?= htmlspecialchars($p['visitante']['name']) ?>"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2252%22 height=%2252%22><rect width=%2252%22 height=%2252%22 rx=%228%22 fill=%22%23e2e8f0%22/><text x=%2226%22 y=%2233%22 text-anchor=%22middle%22 font-size=%2218%22>?</text></svg>'">
                <span class="equipo-nombre"><?= htmlspecialchars($p['visitante']['name']) ?></span>
                <?php if ($liga === 'nba'): ?>
                    <span class="record"><?= $p['visitante']['w'] ?>W &middot; <?= $p['visitante']['l'] ?>L</span>
                <?php endif; ?>
            </a>
        </div>

        <?php if ($fin && ($p['tl'] || $p['tv'])): ?>
        <div class="top-jugadores">
            <div class="top-jugador">
                <?php if ($p['tl']): $j=$p['tl']; ?>
                    <span class="top-label">&#11088; Destacado Local</span>
                    <span class="top-nombre"><?= htmlspecialchars($j['name']) ?></span>
                    <?php if ($liga==='nba'): ?>
                        <span class="top-stats"><?= $j['pts'] ?>pts &middot; <?= $j['reb'] ?>reb &middot; <?= $j['ast'] ?>ast</span>
                    <?php else: ?>
                        <span class="top-stats">Nota <?= $j['rating'] ?> &middot; <?= $j['goles'] ?> goles &middot; <?= $j['asist'] ?> asist.</span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="top-jugador">
                <?php if ($p['tv']): $j=$p['tv']; ?>
                    <span class="top-label">&#11088; Destacado Visitante</span>
                    <span class="top-nombre"><?= htmlspecialchars($j['name']) ?></span>
                    <?php if ($liga==='nba'): ?>
                        <span class="top-stats"><?= $j['pts'] ?>pts &middot; <?= $j['reb'] ?>reb &middot; <?= $j['ast'] ?>ast</span>
                    <?php else: ?>
                        <span class="top-stats">Nota <?= $j['rating'] ?> &middot; <?= $j['goles'] ?> goles &middot; <?= $j['asist'] ?> asist.</span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!$fin && !$vivo): ?>
        <div class="probabilidades">
            <div class="prob-etiquetas">
                <span><?= htmlspecialchars($p['local']['name']) ?> <?= $p['pl'] ?>%</span>
                <?php if ($liga==='laliga'): ?><span>Empate <?= $p['pe'] ?>%</span><?php endif; ?>
                <span><?= htmlspecialchars($p['visitante']['name']) ?> <?= $p['pv'] ?>%</span>
            </div>
            <div class="prob-barra <?= $liga==='nba'?'prob-barra--nba':'' ?>">
                <div class="prob-seg prob-local"    style="width:<?= $p['pl'] ?>%"></div>
                <?php if ($liga==='laliga'): ?><div class="prob-seg prob-empate" style="width:<?= $p['pe'] ?>%"></div><?php endif; ?>
                <div class="prob-seg prob-visitante"style="width:<?= $p['pv'] ?>%"></div>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <?php
}
