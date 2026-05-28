<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) { header("Location: index.php"); exit; }

require_once 'php/datos.php';
require_once 'php/plantillas.php';
require_once 'php/conexion.php';

$nombre  = htmlspecialchars($_SESSION['usuario_nombre']);
$liga    = isset($_GET['liga'])   ? $_GET['liga']   : '';
$equipo_id = isset($_GET['id'])   ? (int)$_GET['id'] : 0;

if (!in_array($liga, ['nba','laliga']) || $equipo_id <= 0) {
    header("Location: home.php"); exit;
}

// Buscar equipo
$equipos = $liga === 'nba' ? equipos_nba() : equipos_laliga();
$equipo  = null;
foreach ($equipos as $e) {
    if ($e['id'] === $equipo_id) { $equipo = $e; break; }
}
if (!$equipo) { header("Location: home.php"); exit; }

// Plantilla
$plantillas = $liga === 'nba' ? plantilla_nba() : plantilla_laliga();
$jugadores  = $plantillas[$equipo_id] ?? [];

// Ordenar por stat principal por defecto
$orden = isset($_GET['orden']) ? $_GET['orden'] : ($liga === 'nba' ? 'pts' : 'goles');
$stats_validas_nba    = ['pts','reb','ast','fg','3p','per'];
$stats_validas_laliga = ['goles','asist','pj','rating','min'];
$stats_validas = $liga === 'nba' ? $stats_validas_nba : $stats_validas_laliga;
if (!in_array($orden, $stats_validas)) {
    $orden = $liga === 'nba' ? 'pts' : 'goles';
}

usort($jugadores, function($a, $b) use ($orden) {
    return $b[$orden] <=> $a[$orden];
});

// Colores posiciones NBA
function color_pos_nba(string $pos): string {
    return match($pos) {
        'PG' => 'pos-pg', 'SG' => 'pos-sg',
        'SF' => 'pos-sf', 'PF' => 'pos-pf',
        'C'  => 'pos-c',  default => 'pos-c',
    };
}
// Colores posiciones LaLiga
function color_pos_ll(string $pos): string {
    return match($pos) {
        'PO' => 'pos-po', 'DF' => 'pos-df',
        'MC' => 'pos-mc', 'EX' => 'pos-ex',
        'DC' => 'pos-dc', default => 'pos-dc',
    };
}



$volver = $liga === 'nba' ? 'nba.php' : 'laliga.php';
$color_header = $liga === 'nba' ? 'nba-header' : 'laliga-header';

// Favoritos
$uid_fav = (int)$_SESSION['usuario_id'];
$stmt_fav = mysqli_prepare($conexion, "SELECT 1 FROM favoritos WHERE usuario_id=? AND liga=? AND equipo_id=?");
mysqli_stmt_bind_param($stmt_fav, "isi", $uid_fav, $liga, $equipo_id);
mysqli_stmt_execute($stmt_fav);
mysqli_stmt_store_result($stmt_fav);
$es_favorito = mysqli_stmt_num_rows($stmt_fav) > 0;
mysqli_stmt_close($stmt_fav);

$redirect_url = 'equipo.php?liga=' . urlencode($liga) . '&id=' . $equipo_id
    . ($orden !== ($liga === 'nba' ? 'pts' : 'goles') ? '&orden=' . urlencode($orden) : '');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= htmlspecialchars($equipo['name']) ?> - StatsZone</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/liga.css">
    <link rel="stylesheet" href="assets/css/equipo.css">
</head>
<body>

<header class="cabecera">
    <a href="home.php" class="logo">&#128202; StatsZone</a>
    <div class="usuario-info">
        &#128100; <a href="perfil.php" class="usuario-nombre-link"><?= $nombre ?></a>
        <a href="php/cerrar_sesion.php" class="boton-salir">Cerrar sesion</a>
    </div>
</header>

<!-- CABECERA EQUIPO -->
<div class="equipo-header <?= $color_header ?>">
    <a href="<?= $volver ?>" class="btn-volver">&#8592; Volver</a>
    <div class="equipo-header-content">
        <img src="<?= htmlspecialchars($equipo['logo']) ?>" class="equipo-logo-grande"
             alt="<?= htmlspecialchars($equipo['name']) ?>"
             onerror="this.style.display='none'">
        <div class="equipo-header-info">
            <h1><?= htmlspecialchars($equipo['name']) ?></h1>
            <?php if ($liga === 'nba'): ?>
                <div class="equipo-header-meta">
                    <span class="meta-badge"><?= $equipo['conf'] ?></span>
                    <span class="meta-badge"><?= $equipo['w'] ?>V - <?= $equipo['l'] ?>D</span>
                    <span class="meta-badge">% <?= number_format($equipo['w']/($equipo['w']+$equipo['l']),3) ?></span>
                </div>
            <?php else: ?>
                <div class="equipo-header-meta">
                    <span class="meta-badge"><?= $equipo['pts'] ?> pts</span>
                    <span class="meta-badge"><?= $equipo['pj'] ?> partidos</span>
                    <span class="meta-badge"><?= $equipo['gf'] ?> goles</span>
                </div>
            <?php endif; ?>
            <form action="php/toggle_favorito.php" method="POST" style="display:inline;">
                <input type="hidden" name="liga"      value="<?= htmlspecialchars($liga) ?>">
                <input type="hidden" name="equipo_id" value="<?= $equipo_id ?>">
                <input type="hidden" name="redirect"  value="<?= htmlspecialchars($redirect_url) ?>">
                <button type="submit" class="btn-fav <?= $es_favorito ? 'btn-fav--activo' : '' ?>">
                    <span class="btn-fav-icono"><?= $es_favorito ? '&#9829;' : '&#9825;' ?></span>
                    <?= $es_favorito ? 'Quitar de favoritos' : 'Añadir a favoritos' ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="pagina-equipo">

    <!-- FILTROS DE ORDENACION -->
    <div class="filtros-orden">
        <span class="filtros-label">Ordenar por:</span>
        <?php if ($liga === 'nba'): ?>
            <?php foreach (['pts'=>'Puntos','reb'=>'Rebotes','ast'=>'Asistencias','fg'=>'FG%','3p'=>'3P%','per'=>'Valoracion'] as $k=>$v): ?>
                <a href="equipo.php?liga=nba&id=<?= $equipo_id ?>&orden=<?= $k ?>"
                   class="filtro-btn <?= $orden===$k?'filtro-btn--activo':'' ?>"><?= $v ?></a>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach (['goles'=>'Goles','asist'=>'Asistencias','pj'=>'Partidos','rating'=>'Rating','min'=>'Minutos'] as $k=>$v): ?>
                <a href="equipo.php?liga=laliga&id=<?= $equipo_id ?>&orden=<?= $k ?>"
                   class="filtro-btn <?= $orden===$k?'filtro-btn--activo':'' ?>"><?= $v ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- TABLA DE JUGADORES -->
    <?php if (empty($jugadores)): ?>
        <div class="sin-datos"><p>No hay datos de jugadores disponibles.</p></div>
    <?php else: ?>
    <div class="tabla-jugadores-wrap">
        <table class="tabla-jugadores">
            <thead>
                <?php if ($liga === 'nba'): ?>
                <tr>
                    <th>#</th>
                    <th class="th-nombre">Jugador</th>
                    <th>Pos</th>
                    <th class="<?= $orden==='pts'?'th-activo':'' ?>">PPG</th>
                    <th class="<?= $orden==='reb'?'th-activo':'' ?>">RPG</th>
                    <th class="<?= $orden==='ast'?'th-activo':'' ?>">APG</th>
                    <th class="<?= $orden==='fg'?'th-activo':'' ?>">FG%</th>
                    <th class="<?= $orden==='3p'?'th-activo':'' ?>">3P%</th>
                    <th class="<?= $orden==='per'?'th-activo':'' ?>">VAL</th>
                </tr>
                <?php else: ?>
                <tr>
                    <th>#</th>
                    <th class="th-nombre">Jugador</th>
                    <th>Pos</th>
                    <th class="<?= $orden==='pj'?'th-activo':'' ?>">PJ</th>
                    <th class="<?= $orden==='goles'?'th-activo':'' ?>">Goles</th>
                    <th class="<?= $orden==='asist'?'th-activo':'' ?>">Asist.</th>
                    <th class="<?= $orden==='min'?'th-activo':'' ?>">Min</th>
                    <th class="<?= $orden==='rating'?'th-activo':'' ?>">Rating</th>
                </tr>
                <?php endif; ?>
            </thead>
            <tbody>
            <?php foreach ($jugadores as $i => $j):
                $pos_clase = $liga === 'nba' ? color_pos_nba($j['pos']) : color_pos_ll($j['pos']);
            ?>
                <tr class="<?= $i===0?'tr-top':'' ?>">
                    <td class="td-rank"><?= $i+1 ?></td>
                    <td class="td-nombre">
                        <?php if ($i===0): ?><span class="icono-mvp">&#11088;</span><?php endif; ?>
                        <?= htmlspecialchars($j['name']) ?>
                    </td>
                    <td><span class="pos-badge <?= $pos_clase ?>"><?= $j['pos'] ?></span></td>
                    <?php if ($liga === 'nba'): ?>
                        <td class="<?= $orden==='pts'?'td-activo':'' ?>"><?= $j['pts'] ?></td>
                        <td class="<?= $orden==='reb'?'td-activo':'' ?>"><?= $j['reb'] ?></td>
                        <td class="<?= $orden==='ast'?'td-activo':'' ?>"><?= $j['ast'] ?></td>
                        <td class="<?= $orden==='fg' ?'td-activo':'' ?>"><?= $j['fg'] ?>%</td>
                        <td class="<?= $orden==='3p' ?'td-activo':'' ?>"><?= $j['3p'] ?>%</td>
                        <td class="<?= $orden==='per'?'td-activo':'' ?> td-val"><?= $j['per'] ?></td>
                    <?php else: ?>
                        <td class="<?= $orden==='pj'    ?'td-activo':'' ?>"><?= $j['pj'] ?></td>
                        <td class="<?= $orden==='goles' ?'td-activo':'' ?> td-goles"><?= $j['goles'] ?></td>
                        <td class="<?= $orden==='asist' ?'td-activo':'' ?>"><?= $j['asist'] ?></td>
                        <td class="<?= $orden==='min'   ?'td-activo':'' ?>"><?= $j['min'] ?></td>
                        <td class="<?= $orden==='rating'?'td-activo':'' ?> td-val"><?= $j['rating'] ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- LEYENDA POSICIONES -->
    <div class="leyenda-posiciones">
        <?php if ($liga === 'nba'): ?>
            <span class="pos-badge pos-pg">PG</span> Base
            <span class="pos-badge pos-sg">SG</span> Escolta
            <span class="pos-badge pos-sf">SF</span> Alero
            <span class="pos-badge pos-pf">PF</span> Ala-pivot
            <span class="pos-badge pos-c">C</span> Pivot
        <?php else: ?>
            <span class="pos-badge pos-po">PO</span> Portero
            <span class="pos-badge pos-df">DF</span> Defensa
            <span class="pos-badge pos-mc">MC</span> Centrocampista
            <span class="pos-badge pos-ex">EX</span> Extremo
            <span class="pos-badge pos-dc">DC</span> Delantero
        <?php endif; ?>
    </div>

</div><!-- pagina-equipo -->
<?php include 'php/tab_sesion.php'; ?>
</body>
</html>
