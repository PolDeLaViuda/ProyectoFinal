<?php
// ================================================================
//  PLANTILLAS COMPLETAS — NBA y LaLiga
//  NBA: pts, reb, ast, fg% (tiros de campo), 3p% (triples), per (valoracion)
//  LaLiga: pj (partidos jugados), goles, asist, rating, min (minutos)
// ================================================================

function plantilla_nba(): array {
    return [
        // 1 Boston Celtics
        1 => [
            ['name'=>'Jayson Tatum',       'pos'=>'SF', 'pts'=>27.4,'reb'=>8.1,'ast'=>4.9,'fg'=>46.6,'3p'=>37.2,'per'=>24.1],
            ['name'=>'Jaylen Brown',        'pos'=>'SG', 'pts'=>23.0,'reb'=>5.5,'ast'=>3.6,'fg'=>47.1,'3p'=>35.8,'per'=>19.2],
            ['name'=>'Jrue Holiday',        'pos'=>'PG', 'pts'=>12.5,'reb'=>5.4,'ast'=>4.8,'fg'=>48.3,'3p'=>38.1,'per'=>14.8],
            ['name'=>'Al Horford',          'pos'=>'C',  'pts'=>9.2, 'reb'=>6.4,'ast'=>2.9,'fg'=>50.1,'3p'=>40.3,'per'=>13.1],
            ['name'=>'Kristaps Porzingis',  'pos'=>'C',  'pts'=>20.1,'reb'=>7.2,'ast'=>2.0,'fg'=>51.2,'3p'=>37.5,'per'=>20.4],
            ['name'=>'Payton Pritchard',    'pos'=>'PG', 'pts'=>14.5,'reb'=>3.2,'ast'=>3.7,'fg'=>44.8,'3p'=>43.2,'per'=>14.2],
            ['name'=>'Sam Hauser',          'pos'=>'SF', 'pts'=>11.8,'reb'=>3.9,'ast'=>1.4,'fg'=>48.2,'3p'=>44.1,'per'=>12.6],
            ['name'=>'Derrick White',       'pos'=>'SG', 'pts'=>15.2,'reb'=>4.3,'ast'=>3.7,'fg'=>46.5,'3p'=>39.8,'per'=>16.1],
        ],
        // 2 New York Knicks
        2 => [
            ['name'=>'Jalen Brunson',       'pos'=>'PG', 'pts'=>28.7,'reb'=>3.6,'ast'=>6.8,'fg'=>47.5,'3p'=>39.1,'per'=>25.3],
            ['name'=>'Karl-Anthony Towns',  'pos'=>'C',  'pts'=>24.3,'reb'=>13.7,'ast'=>3.0,'fg'=>51.0,'3p'=>39.6,'per'=>23.8],
            ['name'=>'Mikal Bridges',       'pos'=>'SF', 'pts'=>19.6,'reb'=>4.5,'ast'=>3.7,'fg'=>46.3,'3p'=>37.4,'per'=>17.2],
            ['name'=>'OG Anunoby',          'pos'=>'SF', 'pts'=>14.9,'reb'=>4.4,'ast'=>1.9,'fg'=>48.8,'3p'=>36.5,'per'=>15.7],
            ['name'=>'Josh Hart',           'pos'=>'SG', 'pts'=>11.3,'reb'=>8.4,'ast'=>4.4,'fg'=>44.2,'3p'=>33.7,'per'=>14.8],
            ['name'=>'Precious Achiuwa',    'pos'=>'PF', 'pts'=>8.4, 'reb'=>6.8,'ast'=>1.1,'fg'=>52.3,'3p'=>28.4,'per'=>12.3],
            ['name'=>'Donte DiVincenzo',    'pos'=>'SG', 'pts'=>10.2,'reb'=>3.1,'ast'=>2.8,'fg'=>43.6,'3p'=>40.1,'per'=>11.9],
            ['name'=>'Miles McBride',       'pos'=>'PG', 'pts'=>9.7, 'reb'=>2.3,'ast'=>3.1,'fg'=>45.1,'3p'=>38.7,'per'=>11.4],
        ],
        // 3 Philadelphia 76ers
        3 => [
            ['name'=>'Joel Embiid',         'pos'=>'C',  'pts'=>34.7,'reb'=>11.0,'ast'=>5.6,'fg'=>52.8,'3p'=>33.1,'per'=>31.4],
            ['name'=>'Tyrese Maxey',        'pos'=>'PG', 'pts'=>25.9,'reb'=>3.7,'ast'=>6.2,'fg'=>46.8,'3p'=>38.2,'per'=>22.7],
            ['name'=>'Paul George',         'pos'=>'SF', 'pts'=>16.1,'reb'=>5.2,'ast'=>3.5,'fg'=>43.7,'3p'=>38.6,'per'=>16.8],
            ['name'=>'Tobias Harris',       'pos'=>'PF', 'pts'=>14.8,'reb'=>6.4,'ast'=>2.9,'fg'=>49.3,'3p'=>37.2,'per'=>15.5],
            ['name'=>'Kelly Oubre Jr.',     'pos'=>'SF', 'pts'=>15.4,'reb'=>5.0,'ast'=>1.8,'fg'=>44.2,'3p'=>34.8,'per'=>14.2],
            ['name'=>'Nicolas Batum',       'pos'=>'PF', 'pts'=>6.8, 'reb'=>3.8,'ast'=>2.1,'fg'=>46.5,'3p'=>39.3,'per'=>10.4],
            ['name'=>'Kyle Lowry',          'pos'=>'PG', 'pts'=>7.7, 'reb'=>3.3,'ast'=>5.8,'fg'=>41.2,'3p'=>35.6,'per'=>11.8],
            ['name'=>'Andre Drummond',      'pos'=>'C',  'pts'=>9.4, 'reb'=>10.2,'ast'=>1.0,'fg'=>57.3,'3p'=>0.0, 'per'=>15.6],
        ],
        // 4 Toronto Raptors
        4 => [
            ['name'=>'Scottie Barnes',      'pos'=>'SF', 'pts'=>19.9,'reb'=>8.2,'ast'=>6.1,'fg'=>46.5,'3p'=>29.7,'per'=>18.4],
            ['name'=>'RJ Barrett',          'pos'=>'SG', 'pts'=>21.8,'reb'=>5.6,'ast'=>3.9,'fg'=>44.9,'3p'=>35.1,'per'=>18.1],
            ['name'=>'Immanuel Quickley',   'pos'=>'PG', 'pts'=>18.6,'reb'=>4.4,'ast'=>6.8,'fg'=>43.7,'3p'=>37.4,'per'=>17.5],
            ['name'=>'Jakob Poeltl',        'pos'=>'C',  'pts'=>12.3,'reb'=>9.7,'ast'=>3.4,'fg'=>62.1,'3p'=>0.0, 'per'=>17.2],
            ['name'=>'Pascal Siakam',       'pos'=>'PF', 'pts'=>21.3,'reb'=>7.8,'ast'=>3.7,'fg'=>49.2,'3p'=>33.5,'per'=>20.1],
            ['name'=>'Gradey Dick',         'pos'=>'SG', 'pts'=>9.4, 'reb'=>2.8,'ast'=>1.3,'fg'=>41.5,'3p'=>38.1,'per'=>10.2],
            ['name'=>'Kelly Olynyk',        'pos'=>'PF', 'pts'=>10.1,'reb'=>5.2,'ast'=>2.7,'fg'=>47.3,'3p'=>37.8,'per'=>12.4],
            ['name'=>'Chris Boucher',       'pos'=>'PF', 'pts'=>8.3, 'reb'=>5.5,'ast'=>0.9,'fg'=>44.8,'3p'=>35.2,'per'=>11.1],
        ],
        // 5 Brooklyn Nets
        5 => [
            ['name'=>'Cam Thomas',          'pos'=>'SG', 'pts'=>22.7,'reb'=>4.0,'ast'=>2.8,'fg'=>45.1,'3p'=>37.3,'per'=>19.5],
            ['name'=>'Mikal Bridges',       'pos'=>'SF', 'pts'=>19.6,'reb'=>4.5,'ast'=>3.7,'fg'=>46.3,'3p'=>37.4,'per'=>17.2],
            ['name'=>'Ben Simmons',         'pos'=>'PG', 'pts'=>6.1, 'reb'=>6.3,'ast'=>5.8,'fg'=>58.7,'3p'=>0.0, 'per'=>12.8],
            ['name'=>'Nic Claxton',         'pos'=>'C',  'pts'=>12.4,'reb'=>8.3,'ast'=>2.5,'fg'=>62.8,'3p'=>0.0, 'per'=>17.1],
            ['name'=>'Dennis Schroder',     'pos'=>'PG', 'pts'=>17.6,'reb'=>3.2,'ast'=>6.5,'fg'=>43.4,'3p'=>34.8,'per'=>16.3],
            ['name'=>'Day Ron Sharp',       'pos'=>'C',  'pts'=>11.3,'reb'=>9.1,'ast'=>1.4,'fg'=>54.2,'3p'=>31.5,'per'=>15.8],
            ['name'=>'Trendon Watford',     'pos'=>'PF', 'pts'=>8.7, 'reb'=>5.4,'ast'=>2.1,'fg'=>48.3,'3p'=>33.6,'per'=>11.4],
            ['name'=>'Lonnie Walker IV',    'pos'=>'SG', 'pts'=>10.2,'reb'=>2.7,'ast'=>1.8,'fg'=>42.7,'3p'=>36.9,'per'=>11.8],
        ],
        // 6 Milwaukee Bucks
        6 => [
            ['name'=>'Giannis Antetokounmpo','pos'=>'PF','pts'=>32.7,'reb'=>12.0,'ast'=>6.5,'fg'=>61.4,'3p'=>27.4,'per'=>31.9],
            ['name'=>'Damian Lillard',       'pos'=>'PG','pts'=>24.3,'reb'=>4.4,'ast'=>7.1,'fg'=>44.8,'3p'=>37.3,'per'=>22.6],
            ['name'=>'Khris Middleton',      'pos'=>'SF','pts'=>15.1,'reb'=>5.3,'ast'=>5.2,'fg'=>46.9,'3p'=>38.7,'per'=>17.4],
            ['name'=>'Brook Lopez',          'pos'=>'C', 'pts'=>12.5,'reb'=>4.8,'ast'=>1.4,'fg'=>50.2,'3p'=>36.3,'per'=>14.2],
            ['name'=>'Bobby Portis',         'pos'=>'PF','pts'=>14.3,'reb'=>8.2,'ast'=>1.8,'fg'=>48.1,'3p'=>37.8,'per'=>15.7],
            ['name'=>'Patrick Beverley',     'pos'=>'PG','pts'=>6.4, 'reb'=>3.4,'ast'=>2.5,'fg'=>40.2,'3p'=>36.8,'per'=>9.3],
            ['name'=>'Malik Beasley',        'pos'=>'SG','pts'=>12.8,'reb'=>2.9,'ast'=>1.7,'fg'=>43.2,'3p'=>40.1,'per'=>12.6],
            ['name'=>'MarJon Beauchamp',     'pos'=>'SF','pts'=>8.1, 'reb'=>3.7,'ast'=>1.4,'fg'=>44.6,'3p'=>35.8,'per'=>10.3],
        ],
        // 7 Cleveland Cavaliers
        7 => [
            ['name'=>'Donovan Mitchell',    'pos'=>'SG', 'pts'=>26.5,'reb'=>5.1,'ast'=>6.1,'fg'=>48.1,'3p'=>38.6,'per'=>24.2],
            ['name'=>'Darius Garland',      'pos'=>'PG', 'pts'=>20.6,'reb'=>2.9,'ast'=>7.8,'fg'=>45.3,'3p'=>37.5,'per'=>19.8],
            ['name'=>'Evan Mobley',         'pos'=>'C',  'pts'=>15.7,'reb'=>9.4,'ast'=>2.8,'fg'=>53.2,'3p'=>31.4,'per'=>18.9],
            ['name'=>'Jarrett Allen',       'pos'=>'C',  'pts'=>13.4,'reb'=>10.4,'ast'=>1.9,'fg'=>65.8,'3p'=>0.0, 'per'=>17.8],
            ['name'=>'Max Strus',           'pos'=>'SG', 'pts'=>13.1,'reb'=>4.3,'ast'=>2.8,'fg'=>43.7,'3p'=>39.2,'per'=>13.5],
            ['name'=>'Georges Niang',       'pos'=>'PF', 'pts'=>8.7, 'reb'=>3.4,'ast'=>1.8,'fg'=>45.8,'3p'=>43.1,'per'=>10.9],
            ['name'=>'Sam Merrill',         'pos'=>'SG', 'pts'=>7.3, 'reb'=>2.1,'ast'=>1.4,'fg'=>44.3,'3p'=>42.6,'per'=>9.7],
            ['name'=>'Isaac Okoro',         'pos'=>'SF', 'pts'=>9.8, 'reb'=>3.6,'ast'=>2.1,'fg'=>48.2,'3p'=>33.7,'per'=>11.4],
        ],
        // 8 Indiana Pacers
        8 => [
            ['name'=>'Tyrese Haliburton',   'pos'=>'PG', 'pts'=>20.1,'reb'=>3.9,'ast'=>10.9,'fg'=>47.2,'3p'=>38.1,'per'=>22.4],
            ['name'=>'Pascal Siakam',       'pos'=>'PF', 'pts'=>21.3,'reb'=>7.8,'ast'=>3.7,'fg'=>49.2,'3p'=>33.5,'per'=>20.1],
            ['name'=>'Bennedict Mathurin',  'pos'=>'SG', 'pts'=>17.4,'reb'=>4.7,'ast'=>2.3,'fg'=>45.1,'3p'=>36.8,'per'=>16.5],
            ['name'=>'Myles Turner',        'pos'=>'C',  'pts'=>13.0,'reb'=>6.4,'ast'=>1.6,'fg'=>52.3,'3p'=>36.4,'per'=>15.8],
            ['name'=>'Andrew Nembhard',     'pos'=>'PG', 'pts'=>11.7,'reb'=>3.8,'ast'=>5.6,'fg'=>47.8,'3p'=>37.3,'per'=>14.2],
            ['name'=>'Aaron Nesmith',       'pos'=>'SF', 'pts'=>13.2,'reb'=>5.1,'ast'=>1.7,'fg'=>47.3,'3p'=>38.6,'per'=>13.8],
            ['name'=>'T.J. McConnell',      'pos'=>'PG', 'pts'=>8.4, 'reb'=>2.9,'ast'=>5.7,'fg'=>54.2,'3p'=>35.1,'per'=>13.1],
            ['name'=>'Jalen Smith',         'pos'=>'PF', 'pts'=>9.7, 'reb'=>6.3,'ast'=>1.2,'fg'=>50.4,'3p'=>34.8,'per'=>12.6],
        ],
        // 9 Chicago Bulls
        9 => [
            ['name'=>'Zach LaVine',         'pos'=>'SG', 'pts'=>24.8,'reb'=>5.2,'ast'=>4.3,'fg'=>47.1,'3p'=>37.8,'per'=>21.3],
            ['name'=>'Nikola Vucevic',      'pos'=>'C',  'pts'=>21.4,'reb'=>10.7,'ast'=>3.9,'fg'=>52.3,'3p'=>36.5,'per'=>20.7],
            ['name'=>'DeMar DeRozan',       'pos'=>'SF', 'pts'=>24.5,'reb'=>4.7,'ast'=>5.0,'fg'=>50.4,'3p'=>28.7,'per'=>22.1],
            ['name'=>'Coby White',          'pos'=>'PG', 'pts'=>19.1,'reb'=>3.8,'ast'=>5.0,'fg'=>46.2,'3p'=>40.3,'per'=>18.4],
            ['name'=>'Patrick Williams',    'pos'=>'SF', 'pts'=>11.8,'reb'=>5.4,'ast'=>2.1,'fg'=>47.3,'3p'=>36.2,'per'=>13.4],
            ['name'=>'Andre Drummond',      'pos'=>'C',  'pts'=>9.4, 'reb'=>10.2,'ast'=>1.0,'fg'=>57.3,'3p'=>0.0, 'per'=>15.6],
            ['name'=>'Torrey Craig',        'pos'=>'SF', 'pts'=>6.7, 'reb'=>3.9,'ast'=>1.2,'fg'=>45.8,'3p'=>35.4,'per'=>9.8],
            ['name'=>'Jevon Carter',        'pos'=>'PG', 'pts'=>8.2, 'reb'=>2.1,'ast'=>2.8,'fg'=>43.6,'3p'=>38.9,'per'=>10.7],
        ],
        // 10 Detroit Pistons
        10 => [
            ['name'=>'Cade Cunningham',     'pos'=>'PG', 'pts'=>24.3,'reb'=>4.4,'ast'=>9.0,'fg'=>44.5,'3p'=>33.7,'per'=>22.8],
            ['name'=>'Jalen Duren',         'pos'=>'C',  'pts'=>13.1,'reb'=>12.6,'ast'=>1.6,'fg'=>61.4,'3p'=>0.0, 'per'=>18.7],
            ['name'=>'Ausar Thompson',      'pos'=>'SF', 'pts'=>13.8,'reb'=>6.2,'ast'=>2.8,'fg'=>47.3,'3p'=>30.1,'per'=>15.3],
            ['name'=>'Bojan Bogdanovic',    'pos'=>'SF', 'pts'=>14.7,'reb'=>3.1,'ast'=>1.7,'fg'=>46.2,'3p'=>40.8,'per'=>14.6],
            ['name'=>'Killian Hayes',       'pos'=>'PG', 'pts'=>8.7, 'reb'=>3.4,'ast'=>4.8,'fg'=>40.3,'3p'=>31.2,'per'=>10.8],
            ['name'=>'James Wiseman',       'pos'=>'C',  'pts'=>10.3,'reb'=>7.4,'ast'=>0.9,'fg'=>54.2,'3p'=>0.0, 'per'=>13.5],
            ['name'=>'Monte Morris',        'pos'=>'PG', 'pts'=>9.1, 'reb'=>2.3,'ast'=>3.7,'fg'=>49.8,'3p'=>38.2,'per'=>11.7],
            ['name'=>'Isaiah Stewart',      'pos'=>'PF', 'pts'=>11.2,'reb'=>7.1,'ast'=>1.8,'fg'=>50.3,'3p'=>35.7,'per'=>14.1],
        ],
        // 11 Miami Heat
        11 => [
            ['name'=>'Bam Adebayo',         'pos'=>'C',  'pts'=>20.4,'reb'=>10.4,'ast'=>5.1,'fg'=>54.1,'3p'=>22.3,'per'=>21.8],
            ['name'=>'Tyler Herro',         'pos'=>'SG', 'pts'=>20.8,'reb'=>5.3,'ast'=>4.5,'fg'=>44.7,'3p'=>36.8,'per'=>19.4],
            ['name'=>'Jimmy Butler',        'pos'=>'SF', 'pts'=>20.8,'reb'=>5.3,'ast'=>5.3,'fg'=>50.7,'3p'=>24.7,'per'=>22.6],
            ['name'=>'Kyle Lowry',          'pos'=>'PG', 'pts'=>7.7, 'reb'=>3.3,'ast'=>5.8,'fg'=>41.2,'3p'=>35.6,'per'=>11.8],
            ['name'=>'Terry Rozier',        'pos'=>'PG', 'pts'=>15.9,'reb'=>3.6,'ast'=>4.2,'fg'=>44.3,'3p'=>37.6,'per'=>16.4],
            ['name'=>'Caleb Martin',        'pos'=>'SF', 'pts'=>10.4,'reb'=>5.0,'ast'=>1.9,'fg'=>48.3,'3p'=>38.1,'per'=>12.9],
            ['name'=>'Duncan Robinson',     'pos'=>'SG', 'pts'=>13.4,'reb'=>3.1,'ast'=>2.3,'fg'=>44.2,'3p'=>42.5,'per'=>13.8],
            ['name'=>'Josh Richardson',     'pos'=>'SG', 'pts'=>9.8, 'reb'=>3.4,'ast'=>2.6,'fg'=>45.7,'3p'=>36.3,'per'=>11.6],
        ],
        // 12 Orlando Magic
        12 => [
            ['name'=>'Paolo Banchero',      'pos'=>'PF', 'pts'=>25.5,'reb'=>6.9,'ast'=>5.4,'fg'=>46.5,'3p'=>33.2,'per'=>23.4],
            ['name'=>'Franz Wagner',        'pos'=>'SF', 'pts'=>22.2,'reb'=>5.1,'ast'=>4.1,'fg'=>47.3,'3p'=>36.4,'per'=>20.7],
            ['name'=>'Jalen Suggs',         'pos'=>'PG', 'pts'=>14.8,'reb'=>4.1,'ast'=>5.4,'fg'=>44.7,'3p'=>35.8,'per'=>15.9],
            ['name'=>'Wendell Carter Jr.',  'pos'=>'C',  'pts'=>11.7,'reb'=>8.9,'ast'=>2.8,'fg'=>52.4,'3p'=>31.7,'per'=>16.2],
            ['name'=>'Markelle Fultz',      'pos'=>'PG', 'pts'=>10.8,'reb'=>3.4,'ast'=>5.5,'fg'=>47.9,'3p'=>29.4,'per'=>14.3],
            ['name'=>'Anthony Black',       'pos'=>'SG', 'pts'=>9.2, 'reb'=>4.0,'ast'=>3.8,'fg'=>43.8,'3p'=>33.1,'per'=>11.7],
            ['name'=>'Moritz Wagner',       'pos'=>'C',  'pts'=>11.3,'reb'=>5.8,'ast'=>1.4,'fg'=>49.7,'3p'=>37.2,'per'=>14.2],
            ['name'=>'Gary Harris',         'pos'=>'SG', 'pts'=>7.8, 'reb'=>2.3,'ast'=>2.1,'fg'=>44.1,'3p'=>38.5,'per'=>9.8],
        ],
        // 13 Atlanta Hawks
        13 => [
            ['name'=>'Trae Young',          'pos'=>'PG', 'pts'=>25.7,'reb'=>3.3,'ast'=>10.8,'fg'=>43.4,'3p'=>34.3,'per'=>23.7],
            ['name'=>'Jalen Johnson',       'pos'=>'SF', 'pts'=>19.4,'reb'=>8.6,'ast'=>3.7,'fg'=>50.2,'3p'=>33.8,'per'=>20.1],
            ['name'=>'Dejounte Murray',     'pos'=>'PG', 'pts'=>21.4,'reb'=>5.3,'ast'=>6.3,'fg'=>46.8,'3p'=>34.1,'per'=>20.8],
            ['name'=>'Clint Capela',        'pos'=>'C',  'pts'=>10.7,'reb'=>11.2,'ast'=>1.8,'fg'=>62.4,'3p'=>0.0, 'per'=>16.3],
            ['name'=>'Saddiq Bey',          'pos'=>'SF', 'pts'=>12.4,'reb'=>4.8,'ast'=>2.1,'fg'=>44.3,'3p'=>37.6,'per'=>13.2],
            ['name'=>'Bogdan Bogdanovic',   'pos'=>'SG', 'pts'=>14.7,'reb'=>3.5,'ast'=>3.4,'fg'=>45.1,'3p'=>39.7,'per'=>15.3],
            ['name'=>'Onyeka Okongwu',      'pos'=>'C',  'pts'=>11.9,'reb'=>8.4,'ast'=>1.7,'fg'=>59.3,'3p'=>0.0, 'per'=>16.1],
            ['name'=>'Vit Krejci',          'pos'=>'SF', 'pts'=>6.3, 'reb'=>3.1,'ast'=>2.4,'fg'=>46.8,'3p'=>36.2,'per'=>9.4],
        ],
        // 14 Charlotte Hornets
        14 => [
            ['name'=>'LaMelo Ball',         'pos'=>'PG', 'pts'=>24.1,'reb'=>5.5,'ast'=>8.5,'fg'=>43.8,'3p'=>37.4,'per'=>22.8],
            ['name'=>'Brandon Miller',      'pos'=>'SF', 'pts'=>17.3,'reb'=>4.4,'ast'=>2.1,'fg'=>45.2,'3p'=>37.8,'per'=>16.4],
            ['name'=>'Miles Bridges',       'pos'=>'PF', 'pts'=>22.1,'reb'=>7.0,'ast'=>3.2,'fg'=>47.8,'3p'=>34.2,'per'=>20.3],
            ['name'=>'Mark Williams',       'pos'=>'C',  'pts'=>12.4,'reb'=>9.8,'ast'=>1.4,'fg'=>63.7,'3p'=>0.0, 'per'=>17.2],
            ['name'=>'Grant Williams',      'pos'=>'PF', 'pts'=>10.3,'reb'=>4.7,'ast'=>1.8,'fg'=>47.3,'3p'=>37.4,'per'=>12.6],
            ['name'=>'Josh Green',          'pos'=>'SG', 'pts'=>10.8,'reb'=>3.7,'ast'=>3.2,'fg'=>46.2,'3p'=>37.1,'per'=>12.4],
            ['name'=>'Tre Mann',            'pos'=>'SG', 'pts'=>13.7,'reb'=>2.8,'ast'=>3.4,'fg'=>44.1,'3p'=>38.3,'per'=>14.2],
            ['name'=>'Nick Richards',       'pos'=>'C',  'pts'=>8.7, 'reb'=>7.3,'ast'=>0.8,'fg'=>60.4,'3p'=>0.0, 'per'=>13.1],
        ],
        // 15 Washington Wizards
        15 => [
            ['name'=>'Kyle Kuzma',          'pos'=>'SF', 'pts'=>17.8,'reb'=>6.8,'ast'=>3.5,'fg'=>44.3,'3p'=>34.8,'per'=>16.4],
            ['name'=>'Jordan Poole',        'pos'=>'SG', 'pts'=>20.3,'reb'=>2.8,'ast'=>5.1,'fg'=>43.1,'3p'=>34.9,'per'=>17.8],
            ['name'=>'Tyus Jones',          'pos'=>'PG', 'pts'=>10.4,'reb'=>2.8,'ast'=>7.1,'fg'=>48.5,'3p'=>38.6,'per'=>14.8],
            ['name'=>'Daniel Gafford',      'pos'=>'C',  'pts'=>12.8,'reb'=>7.6,'ast'=>1.5,'fg'=>71.4,'3p'=>0.0, 'per'=>18.3],
            ['name'=>'Corey Kispert',       'pos'=>'SF', 'pts'=>12.1,'reb'=>3.4,'ast'=>1.7,'fg'=>46.7,'3p'=>41.2,'per'=>12.8],
            ['name'=>'Deni Avdija',         'pos'=>'PF', 'pts'=>11.5,'reb'=>5.8,'ast'=>3.4,'fg'=>47.8,'3p'=>35.6,'per'=>13.9],
            ['name'=>'Tristan Vukcevic',    'pos'=>'C',  'pts'=>7.8, 'reb'=>5.4,'ast'=>1.2,'fg'=>54.2,'3p'=>32.1,'per'=>11.4],
            ['name'=>'Landry Shamet',       'pos'=>'SG', 'pts'=>8.4, 'reb'=>1.9,'ast'=>1.8,'fg'=>43.4,'3p'=>40.8,'per'=>9.8],
        ],
        // 16 OKC Thunder
        16 => [
            ['name'=>'Shai Gilgeous-Alexander','pos'=>'PG','pts'=>31.4,'reb'=>5.5,'ast'=>6.2,'fg'=>53.5,'3p'=>35.3,'per'=>29.8],
            ['name'=>'Jalen Williams',      'pos'=>'SG', 'pts'=>23.5,'reb'=>4.6,'ast'=>5.9,'fg'=>50.4,'3p'=>37.8,'per'=>22.3],
            ['name'=>'Chet Holmgren',       'pos'=>'C',  'pts'=>16.5,'reb'=>7.9,'ast'=>2.4,'fg'=>52.1,'3p'=>39.4,'per'=>20.4],
            ['name'=>'Lu Dort',             'pos'=>'SG', 'pts'=>14.7,'reb'=>4.4,'ast'=>2.8,'fg'=>44.3,'3p'=>36.2,'per'=>15.1],
            ['name'=>'Isaiah Joe',          'pos'=>'SG', 'pts'=>9.8, 'reb'=>2.7,'ast'=>1.9,'fg'=>43.8,'3p'=>41.7,'per'=>11.4],
            ['name'=>'Kenrich Williams',    'pos'=>'SF', 'pts'=>7.2, 'reb'=>4.8,'ast'=>2.3,'fg'=>48.2,'3p'=>36.1,'per'=>10.8],
            ['name'=>'Aaron Wiggins',       'pos'=>'SG', 'pts'=>9.1, 'reb'=>3.1,'ast'=>1.8,'fg'=>46.3,'3p'=>38.4,'per'=>11.3],
            ['name'=>'Ousmane Dieng',       'pos'=>'SF', 'pts'=>6.4, 'reb'=>3.3,'ast'=>1.4,'fg'=>44.7,'3p'=>33.8,'per'=>8.9],
        ],
        // 17 Minnesota Timberwolves
        17 => [
            ['name'=>'Anthony Edwards',     'pos'=>'SG', 'pts'=>25.9,'reb'=>5.4,'ast'=>5.1,'fg'=>46.1,'3p'=>35.8,'per'=>23.6],
            ['name'=>'Rudy Gobert',         'pos'=>'C',  'pts'=>14.0,'reb'=>12.0,'ast'=>1.8,'fg'=>64.1,'3p'=>0.0, 'per'=>19.4],
            ['name'=>'Karl-Anthony Towns',  'pos'=>'C',  'pts'=>24.3,'reb'=>13.7,'ast'=>3.0,'fg'=>51.0,'3p'=>39.6,'per'=>23.8],
            ['name'=>'Mike Conley',         'pos'=>'PG', 'pts'=>11.0,'reb'=>2.9,'ast'=>5.8,'fg'=>47.2,'3p'=>41.4,'per'=>14.3],
            ['name'=>'Jaden McDaniels',     'pos'=>'SF', 'pts'=>14.2,'reb'=>4.6,'ast'=>2.1,'fg'=>47.8,'3p'=>36.4,'per'=>15.1],
            ['name'=>'Naz Reid',            'pos'=>'C',  'pts'=>13.5,'reb'=>5.4,'ast'=>1.7,'fg'=>49.8,'3p'=>38.7,'per'=>15.8],
            ['name'=>'Nickeil Alexander-Walker','pos'=>'SG','pts'=>9.4,'reb'=>2.9,'ast'=>2.8,'fg'=>44.7,'3p'=>37.3,'per'=>11.6],
            ['name'=>'Kyle Anderson',       'pos'=>'PF', 'pts'=>7.8, 'reb'=>5.1,'ast'=>3.4,'fg'=>50.3,'3p'=>32.6,'per'=>12.4],
        ],
        // 18 Denver Nuggets
        18 => [
            ['name'=>'Nikola Jokic',        'pos'=>'C',  'pts'=>26.4,'reb'=>12.4,'ast'=>9.0,'fg'=>58.3,'3p'=>35.9,'per'=>31.5],
            ['name'=>'Jamal Murray',        'pos'=>'PG', 'pts'=>21.2,'reb'=>4.0,'ast'=>6.5,'fg'=>47.2,'3p'=>41.3,'per'=>20.8],
            ['name'=>'Michael Porter Jr.',  'pos'=>'SF', 'pts'=>16.7,'reb'=>7.1,'ast'=>1.5,'fg'=>49.4,'3p'=>40.2,'per'=>17.6],
            ['name'=>'Aaron Gordon',        'pos'=>'PF', 'pts'=>13.9,'reb'=>6.5,'ast'=>3.4,'fg'=>55.2,'3p'=>32.1,'per'=>16.8],
            ['name'=>'Kentavious C-P',      'pos'=>'SG', 'pts'=>8.4, 'reb'=>2.8,'ast'=>2.1,'fg'=>46.3,'3p'=>38.7,'per'=>11.2],
            ['name'=>'Reggie Jackson',      'pos'=>'PG', 'pts'=>9.7, 'reb'=>2.4,'ast'=>3.8,'fg'=>43.2,'3p'=>37.4,'per'=>11.8],
            ['name'=>'Justin Holiday',      'pos'=>'SG', 'pts'=>6.8, 'reb'=>2.7,'ast'=>1.3,'fg'=>44.8,'3p'=>39.6,'per'=>9.4],
            ['name'=>'DeAndre Jordan',      'pos'=>'C',  'pts'=>4.2, 'reb'=>5.7,'ast'=>0.6,'fg'=>67.3,'3p'=>0.0, 'per'=>8.7],
        ],
        // 19 Utah Jazz
        19 => [
            ['name'=>'Lauri Markkanen',     'pos'=>'PF', 'pts'=>23.2,'reb'=>8.2,'ast'=>1.9,'fg'=>50.7,'3p'=>36.4,'per'=>22.1],
            ['name'=>'Walker Kessler',      'pos'=>'C',  'pts'=>11.4,'reb'=>10.1,'ast'=>0.9,'fg'=>67.2,'3p'=>0.0, 'per'=>18.3],
            ['name'=>'Collin Sexton',       'pos'=>'PG', 'pts'=>16.4,'reb'=>2.8,'ast'=>3.7,'fg'=>47.3,'3p'=>37.8,'per'=>16.2],
            ['name'=>'Jordan Clarkson',     'pos'=>'SG', 'pts'=>17.8,'reb'=>3.7,'ast'=>4.1,'fg'=>43.6,'3p'=>36.9,'per'=>16.5],
            ['name'=>'Talen Horton-Tucker', 'pos'=>'SF', 'pts'=>10.3,'reb'=>4.1,'ast'=>2.7,'fg'=>45.2,'3p'=>34.7,'per'=>12.4],
            ['name'=>'Ochai Agbaji',        'pos'=>'SG', 'pts'=>9.7, 'reb'=>3.4,'ast'=>1.8,'fg'=>46.3,'3p'=>38.2,'per'=>11.3],
            ['name'=>'Simone Fontecchio',   'pos'=>'SF', 'pts'=>12.8,'reb'=>4.3,'ast'=>2.1,'fg'=>47.4,'3p'=>39.7,'per'=>14.1],
            ['name'=>'John Collins',        'pos'=>'PF', 'pts'=>14.2,'reb'=>7.4,'ast'=>1.8,'fg'=>51.3,'3p'=>36.8,'per'=>16.7],
        ],
        // 20 Portland Trail Blazers
        20 => [
            ['name'=>'Anfernee Simons',     'pos'=>'SG', 'pts'=>21.4,'reb'=>3.4,'ast'=>5.0,'fg'=>44.8,'3p'=>38.7,'per'=>19.6],
            ['name'=>'Jerami Grant',        'pos'=>'PF', 'pts'=>21.9,'reb'=>4.5,'ast'=>2.9,'fg'=>46.7,'3p'=>36.4,'per'=>20.1],
            ['name'=>'Deandre Ayton',       'pos'=>'C',  'pts'=>17.3,'reb'=>9.8,'ast'=>1.8,'fg'=>61.4,'3p'=>0.0, 'per'=>19.7],
            ['name'=>'Deni Avdija',         'pos'=>'PF', 'pts'=>11.5,'reb'=>5.8,'ast'=>3.4,'fg'=>47.8,'3p'=>35.6,'per'=>13.9],
            ['name'=>'Scoot Henderson',     'pos'=>'PG', 'pts'=>14.8,'reb'=>3.9,'ast'=>5.7,'fg'=>43.2,'3p'=>30.8,'per'=>14.7],
            ['name'=>'Jabari Walker',       'pos'=>'PF', 'pts'=>8.7, 'reb'=>6.2,'ast'=>1.3,'fg'=>48.4,'3p'=>33.7,'per'=>11.8],
            ['name'=>'Toumani Camara',      'pos'=>'SF', 'pts'=>8.2, 'reb'=>4.3,'ast'=>1.7,'fg'=>49.1,'3p'=>34.2,'per'=>10.7],
            ['name'=>'Shaedon Sharpe',      'pos'=>'SG', 'pts'=>15.3,'reb'=>3.8,'ast'=>2.4,'fg'=>45.7,'3p'=>36.8,'per'=>15.8],
        ],
        // 21 Golden State Warriors
        21 => [
            ['name'=>'Stephen Curry',       'pos'=>'PG', 'pts'=>26.4,'reb'=>4.5,'ast'=>6.0,'fg'=>49.3,'3p'=>40.8,'per'=>26.7],
            ['name'=>'Klay Thompson',       'pos'=>'SG', 'pts'=>17.9,'reb'=>3.3,'ast'=>2.4,'fg'=>44.1,'3p'=>38.4,'per'=>16.8],
            ['name'=>'Draymond Green',      'pos'=>'PF', 'pts'=>10.5,'reb'=>7.2,'ast'=>6.3,'fg'=>47.4,'3p'=>28.6,'per'=>17.8],
            ['name'=>'Andrew Wiggins',      'pos'=>'SF', 'pts'=>18.3,'reb'=>5.0,'ast'=>2.5,'fg'=>47.3,'3p'=>38.1,'per'=>17.4],
            ['name'=>'Jonathan Kuminga',    'pos'=>'SF', 'pts'=>16.1,'reb'=>4.8,'ast'=>2.3,'fg'=>51.2,'3p'=>32.4,'per'=>17.2],
            ['name'=>'Chris Paul',          'pos'=>'PG', 'pts'=>9.2, 'reb'=>3.6,'ast'=>7.9,'fg'=>44.8,'3p'=>35.3,'per'=>15.8],
            ['name'=>'Gary Payton II',      'pos'=>'SG', 'pts'=>8.4, 'reb'=>3.4,'ast'=>2.1,'fg'=>56.3,'3p'=>34.2,'per'=>11.7],
            ['name'=>'Moses Moody',         'pos'=>'SG', 'pts'=>10.7,'reb'=>2.8,'ast'=>1.7,'fg'=>46.4,'3p'=>39.5,'per'=>12.3],
        ],
        // 22 LA Clippers
        22 => [
            ['name'=>'Kawhi Leonard',       'pos'=>'SF', 'pts'=>22.0,'reb'=>6.1,'ast'=>3.9,'fg'=>52.6,'3p'=>38.5,'per'=>23.4],
            ['name'=>'James Harden',        'pos'=>'PG', 'pts'=>16.4,'reb'=>5.6,'ast'=>8.6,'fg'=>43.8,'3p'=>37.4,'per'=>20.6],
            ['name'=>'Paul George',         'pos'=>'SF', 'pts'=>22.6,'reb'=>5.3,'ast'=>3.6,'fg'=>44.7,'3p'=>39.2,'per'=>21.8],
            ['name'=>'Ivica Zubac',         'pos'=>'C',  'pts'=>11.4,'reb'=>9.8,'ast'=>1.6,'fg'=>63.2,'3p'=>0.0, 'per'=>16.4],
            ['name'=>'Norman Powell',       'pos'=>'SG', 'pts'=>18.7,'reb'=>3.3,'ast'=>2.4,'fg'=>51.2,'3p'=>40.3,'per'=>18.1],
            ['name'=>'Russell Westbrook',   'pos'=>'PG', 'pts'=>11.1,'reb'=>5.0,'ast'=>4.7,'fg'=>44.2,'3p'=>27.3,'per'=>14.6],
            ['name'=>'Mason Plumlee',       'pos'=>'C',  'pts'=>7.4, 'reb'=>6.9,'ast'=>2.8,'fg'=>60.3,'3p'=>0.0, 'per'=>12.7],
            ['name'=>'Terance Mann',        'pos'=>'SF', 'pts'=>10.3,'reb'=>4.1,'ast'=>2.3,'fg'=>51.4,'3p'=>37.8,'per'=>13.2],
        ],
        // 23 Phoenix Suns
        23 => [
            ['name'=>'Kevin Durant',        'pos'=>'PF', 'pts'=>27.3,'reb'=>6.6,'ast'=>3.9,'fg'=>52.7,'3p'=>39.1,'per'=>26.2],
            ['name'=>'Devin Booker',        'pos'=>'SG', 'pts'=>27.1,'reb'=>4.5,'ast'=>7.0,'fg'=>49.8,'3p'=>36.4,'per'=>25.8],
            ['name'=>'Bradley Beal',        'pos'=>'SG', 'pts'=>18.2,'reb'=>4.3,'ast'=>5.4,'fg'=>47.3,'3p'=>36.8,'per'=>18.7],
            ['name'=>'Jusuf Nurkic',        'pos'=>'C',  'pts'=>11.7,'reb'=>9.8,'ast'=>3.2,'fg'=>54.3,'3p'=>28.7,'per'=>16.8],
            ['name'=>'Eric Gordon',         'pos'=>'SG', 'pts'=>13.4,'reb'=>2.8,'ast'=>2.3,'fg'=>43.7,'3p'=>39.2,'per'=>13.8],
            ['name'=>'Grayson Allen',       'pos'=>'SG', 'pts'=>12.3,'reb'=>3.4,'ast'=>2.7,'fg'=>46.8,'3p'=>42.3,'per'=>13.4],
            ['name'=>'Drew Eubanks',        'pos'=>'C',  'pts'=>8.7, 'reb'=>6.4,'ast'=>1.1,'fg'=>56.4,'3p'=>0.0, 'per'=>12.3],
            ['name'=>'Royce O Neal',        'pos'=>'SF', 'pts'=>7.2, 'reb'=>4.8,'ast'=>2.1,'fg'=>44.3,'3p'=>34.7,'per'=>10.4],
        ],
        // 24 Sacramento Kings
        24 => [
            ['name'=>'De Aaron Fox',        'pos'=>'PG', 'pts'=>26.6,'reb'=>4.4,'ast'=>5.9,'fg'=>49.8,'3p'=>32.7,'per'=>24.3],
            ['name'=>'Domantas Sabonis',    'pos'=>'C',  'pts'=>18.3,'reb'=>13.3,'ast'=>8.0,'fg'=>58.4,'3p'=>27.3,'per'=>24.1],
            ['name'=>'Keegan Murray',       'pos'=>'SF', 'pts'=>15.2,'reb'=>4.7,'ast'=>1.9,'fg'=>47.8,'3p'=>40.3,'per'=>16.4],
            ['name'=>'Harrison Barnes',     'pos'=>'PF', 'pts'=>12.8,'reb'=>4.8,'ast'=>2.1,'fg'=>49.3,'3p'=>37.6,'per'=>14.2],
            ['name'=>'Kevin Huerter',       'pos'=>'SG', 'pts'=>11.4,'reb'=>3.2,'ast'=>3.7,'fg'=>45.7,'3p'=>39.8,'per'=>13.1],
            ['name'=>'Malik Monk',          'pos'=>'PG', 'pts'=>15.7,'reb'=>3.1,'ast'=>4.8,'fg'=>46.2,'3p'=>38.4,'per'=>16.3],
            ['name'=>'Alex Len',            'pos'=>'C',  'pts'=>7.3, 'reb'=>5.6,'ast'=>1.1,'fg'=>53.4,'3p'=>25.3,'per'=>10.8],
            ['name'=>'Kessler Edwards',     'pos'=>'SF', 'pts'=>8.4, 'reb'=>4.1,'ast'=>1.4,'fg'=>46.3,'3p'=>37.1,'per'=>10.7],
        ],
        // 25 Los Angeles Lakers
        25 => [
            ['name'=>'LeBron James',        'pos'=>'SF', 'pts'=>25.7,'reb'=>7.3,'ast'=>8.3,'fg'=>54.0,'3p'=>41.0,'per'=>27.4],
            ['name'=>'Anthony Davis',       'pos'=>'C',  'pts'=>24.7,'reb'=>12.6,'ast'=>3.5,'fg'=>55.8,'3p'=>27.1,'per'=>27.1],
            ['name'=>'D Angelo Russell',    'pos'=>'PG', 'pts'=>18.0,'reb'=>3.1,'ast'=>6.3,'fg'=>44.6,'3p'=>37.8,'per'=>17.8],
            ['name'=>'Austin Reaves',       'pos'=>'SG', 'pts'=>15.9,'reb'=>4.3,'ast'=>5.5,'fg'=>46.3,'3p'=>36.7,'per'=>17.4],
            ['name'=>'Rui Hachimura',       'pos'=>'PF', 'pts'=>13.5,'reb'=>4.5,'ast'=>1.4,'fg'=>52.3,'3p'=>37.4,'per'=>14.8],
            ['name'=>'Jarred Vanderbilt',   'pos'=>'PF', 'pts'=>5.8, 'reb'=>6.4,'ast'=>2.1,'fg'=>53.2,'3p'=>21.4,'per'=>10.7],
            ['name'=>'Spencer Dinwiddie',   'pos'=>'PG', 'pts'=>10.7,'reb'=>2.8,'ast'=>4.3,'fg'=>43.8,'3p'=>36.9,'per'=>13.2],
            ['name'=>'Taurean Prince',      'pos'=>'SF', 'pts'=>8.3, 'reb'=>3.4,'ast'=>1.8,'fg'=>45.7,'3p'=>38.4,'per'=>10.6],
        ],
        // 26 Houston Rockets
        26 => [
            ['name'=>'Alperen Sengun',      'pos'=>'C',  'pts'=>21.1,'reb'=>9.5,'ast'=>5.0,'fg'=>54.3,'3p'=>31.2,'per'=>23.7],
            ['name'=>'Jalen Green',         'pos'=>'SG', 'pts'=>22.8,'reb'=>4.3,'ast'=>4.5,'fg'=>43.8,'3p'=>36.4,'per'=>20.4],
            ['name'=>'Dillon Brooks',       'pos'=>'SF', 'pts'=>14.1,'reb'=>3.8,'ast'=>2.7,'fg'=>43.7,'3p'=>34.8,'per'=>14.6],
            ['name'=>'Fred VanVleet',       'pos'=>'PG', 'pts'=>17.4,'reb'=>3.9,'ast'=>7.1,'fg'=>40.8,'3p'=>36.2,'per'=>17.1],
            ['name'=>'Jabari Smith Jr.',    'pos'=>'PF', 'pts'=>14.9,'reb'=>7.3,'ast'=>1.7,'fg'=>45.2,'3p'=>37.1,'per'=>16.3],
            ['name'=>'Tari Eason',          'pos'=>'SF', 'pts'=>11.4,'reb'=>5.7,'ast'=>1.4,'fg'=>48.3,'3p'=>34.6,'per'=>13.8],
            ['name'=>'Aaron Holiday',       'pos'=>'PG', 'pts'=>7.8, 'reb'=>2.3,'ast'=>3.4,'fg'=>44.7,'3p'=>37.9,'per'=>10.4],
            ['name'=>'Jeff Green',          'pos'=>'PF', 'pts'=>6.9, 'reb'=>4.1,'ast'=>1.2,'fg'=>49.3,'3p'=>35.8,'per'=>9.7],
        ],
        // 27 Memphis Grizzlies
        27 => [
            ['name'=>'Ja Morant',           'pos'=>'PG', 'pts'=>25.1,'reb'=>5.8,'ast'=>8.1,'fg'=>47.3,'3p'=>29.7,'per'=>24.6],
            ['name'=>'Jaren Jackson Jr.',   'pos'=>'C',  'pts'=>22.4,'reb'=>6.8,'ast'=>1.8,'fg'=>46.8,'3p'=>35.4,'per'=>21.8],
            ['name'=>'Desmond Bane',        'pos'=>'SG', 'pts'=>21.3,'reb'=>4.7,'ast'=>4.3,'fg'=>47.2,'3p'=>40.3,'per'=>20.7],
            ['name'=>'Marcus Smart',        'pos'=>'PG', 'pts'=>10.1,'reb'=>3.3,'ast'=>5.7,'fg'=>39.8,'3p'=>31.2,'per'=>13.4],
            ['name'=>'Zach Edey',           'pos'=>'C',  'pts'=>10.7,'reb'=>8.4,'ast'=>0.9,'fg'=>60.8,'3p'=>0.0, 'per'=>15.4],
            ['name'=>'Vince Williams Jr.',  'pos'=>'SF', 'pts'=>9.4, 'reb'=>3.7,'ast'=>1.8,'fg'=>46.2,'3p'=>37.8,'per'=>11.3],
            ['name'=>'Scotty Pippen Jr.',   'pos'=>'PG', 'pts'=>13.7,'reb'=>2.8,'ast'=>4.3,'fg'=>44.3,'3p'=>36.7,'per'=>14.2],
            ['name'=>'Luke Kennard',        'pos'=>'SG', 'pts'=>10.3,'reb'=>2.4,'ast'=>2.1,'fg'=>47.8,'3p'=>45.3,'per'=>12.1],
        ],
        // 28 Dallas Mavericks
        28 => [
            ['name'=>'Luka Doncic',         'pos'=>'PG', 'pts'=>28.7,'reb'=>8.6,'ast'=>7.8,'fg'=>48.7,'3p'=>38.2,'per'=>29.4],
            ['name'=>'Kyrie Irving',        'pos'=>'SG', 'pts'=>24.6,'reb'=>5.0,'ast'=>5.2,'fg'=>49.6,'3p'=>41.1,'per'=>24.8],
            ['name'=>'Daniel Gafford',      'pos'=>'C',  'pts'=>12.8,'reb'=>7.6,'ast'=>1.5,'fg'=>71.4,'3p'=>0.0, 'per'=>18.3],
            ['name'=>'PJ Washington',       'pos'=>'PF', 'pts'=>10.7,'reb'=>5.4,'ast'=>2.1,'fg'=>46.3,'3p'=>37.8,'per'=>13.4],
            ['name'=>'Derrick Jones Jr.',   'pos'=>'SF', 'pts'=>8.3, 'reb'=>4.7,'ast'=>1.8,'fg'=>53.2,'3p'=>35.4,'per'=>11.8],
            ['name'=>'Josh Green',          'pos'=>'SG', 'pts'=>10.8,'reb'=>3.7,'ast'=>3.2,'fg'=>46.2,'3p'=>37.1,'per'=>12.4],
            ['name'=>'Naji Marshall',       'pos'=>'SF', 'pts'=>9.4, 'reb'=>4.3,'ast'=>2.7,'fg'=>49.7,'3p'=>37.3,'per'=>12.1],
            ['name'=>'Richaun Holmes',      'pos'=>'C',  'pts'=>7.8, 'reb'=>5.9,'ast'=>0.9,'fg'=>62.3,'3p'=>0.0, 'per'=>11.4],
        ],
        // 29 New Orleans Pelicans
        29 => [
            ['name'=>'Zion Williamson',     'pos'=>'PF', 'pts'=>23.4,'reb'=>5.8,'ast'=>5.0,'fg'=>59.8,'3p'=>23.1,'per'=>24.7],
            ['name'=>'Brandon Ingram',      'pos'=>'SF', 'pts'=>24.3,'reb'=>5.1,'ast'=>5.2,'fg'=>47.4,'3p'=>37.8,'per'=>22.9],
            ['name'=>'CJ McCollum',         'pos'=>'SG', 'pts'=>19.7,'reb'=>3.9,'ast'=>4.8,'fg'=>46.3,'3p'=>38.4,'per'=>19.2],
            ['name'=>'Jonas Valanciunas',   'pos'=>'C',  'pts'=>12.4,'reb'=>10.8,'ast'=>2.1,'fg'=>55.4,'3p'=>28.3,'per'=>17.1],
            ['name'=>'Herb Jones',          'pos'=>'SG', 'pts'=>11.3,'reb'=>4.4,'ast'=>3.4,'fg'=>49.8,'3p'=>33.7,'per'=>13.8],
            ['name'=>'Trey Murphy III',     'pos'=>'SF', 'pts'=>14.7,'reb'=>4.2,'ast'=>2.1,'fg'=>47.3,'3p'=>40.8,'per'=>15.6],
            ['name'=>'Dyson Daniels',       'pos'=>'SG', 'pts'=>9.8, 'reb'=>3.7,'ast'=>2.8,'fg'=>44.3,'3p'=>33.2,'per'=>11.7],
            ['name'=>'Larry Nance Jr.',     'pos'=>'PF', 'pts'=>8.4, 'reb'=>6.7,'ast'=>2.4,'fg'=>51.3,'3p'=>31.7,'per'=>13.2],
        ],
        // 30 San Antonio Spurs
        30 => [
            ['name'=>'Victor Wembanyama',   'pos'=>'C',  'pts'=>21.4,'reb'=>10.6,'ast'=>3.9,'fg'=>46.5,'3p'=>32.4,'per'=>24.8],
            ['name'=>'Devin Vassell',       'pos'=>'SG', 'pts'=>19.0,'reb'=>3.8,'ast'=>3.0,'fg'=>45.7,'3p'=>40.1,'per'=>18.3],
            ['name'=>'Keldon Johnson',      'pos'=>'SF', 'pts'=>16.7,'reb'=>5.6,'ast'=>2.8,'fg'=>46.3,'3p'=>34.7,'per'=>16.4],
            ['name'=>'Chris Paul',          'pos'=>'PG', 'pts'=>9.2, 'reb'=>3.6,'ast'=>7.9,'fg'=>44.8,'3p'=>35.3,'per'=>15.8],
            ['name'=>'Harrison Barnes',     'pos'=>'PF', 'pts'=>12.8,'reb'=>4.8,'ast'=>2.1,'fg'=>49.3,'3p'=>37.6,'per'=>14.2],
            ['name'=>'Charles Bassey',      'pos'=>'C',  'pts'=>9.7, 'reb'=>8.3,'ast'=>1.2,'fg'=>60.4,'3p'=>0.0, 'per'=>14.8],
            ['name'=>'Sidy Cissoko',        'pos'=>'SG', 'pts'=>7.3, 'reb'=>2.8,'ast'=>1.7,'fg'=>44.1,'3p'=>34.8,'per'=>9.4],
            ['name'=>'Julian Champagnie',   'pos'=>'SF', 'pts'=>8.9, 'reb'=>3.6,'ast'=>1.3,'fg'=>46.7,'3p'=>38.2,'per'=>11.2],
        ],
    ];
}

function plantilla_laliga(): array {
    return [
        // 1 Real Madrid
        1 => [
            ['name'=>'Vinicius Jr.',       'pos'=>'EX', 'pj'=>28,'goles'=>20,'asist'=>12,'min'=>2310,'rating'=>8.8],
            ['name'=>'Jude Bellingham',    'pos'=>'MC', 'pj'=>27,'goles'=>19,'asist'=>11,'min'=>2250,'rating'=>8.7],
            ['name'=>'Kylian Mbappe',      'pos'=>'DC', 'pj'=>29,'goles'=>23,'asist'=>7, 'min'=>2480,'rating'=>8.6],
            ['name'=>'Rodrygo',            'pos'=>'EX', 'pj'=>28,'goles'=>10,'asist'=>9, 'min'=>1980,'rating'=>7.9],
            ['name'=>'Luka Modric',        'pos'=>'MC', 'pj'=>26,'goles'=>4, 'asist'=>8, 'min'=>1740,'rating'=>7.8],
            ['name'=>'Toni Kroos',         'pos'=>'MC', 'pj'=>27,'goles'=>3, 'asist'=>10,'min'=>2100,'rating'=>7.9],
            ['name'=>'Antonio Rudiger',    'pos'=>'DF', 'pj'=>28,'goles'=>3, 'asist'=>1, 'min'=>2430,'rating'=>7.6],
            ['name'=>'Dani Carvajal',      'pos'=>'DF', 'pj'=>25,'goles'=>2, 'asist'=>5, 'min'=>2050,'rating'=>7.7],
            ['name'=>'Ferland Mendy',      'pos'=>'DF', 'pj'=>24,'goles'=>0, 'asist'=>3, 'min'=>1980,'rating'=>7.3],
            ['name'=>'Aurelien Tchouameni','pos'=>'MC', 'pj'=>26,'goles'=>2, 'asist'=>3, 'min'=>2020,'rating'=>7.4],
            ['name'=>'Thibaut Courtois',   'pos'=>'PO', 'pj'=>15,'goles'=>0, 'asist'=>0, 'min'=>1350,'rating'=>7.8],
        ],
        // 2 FC Barcelona
        2 => [
            ['name'=>'Robert Lewandowski', 'pos'=>'DC', 'pj'=>29,'goles'=>24,'asist'=>8, 'min'=>2460,'rating'=>8.7],
            ['name'=>'Lamine Yamal',       'pos'=>'EX', 'pj'=>28,'goles'=>8, 'asist'=>14,'min'=>2180,'rating'=>8.5],
            ['name'=>'Raphinha',           'pos'=>'EX', 'pj'=>28,'goles'=>15,'asist'=>9, 'min'=>2230,'rating'=>8.4],
            ['name'=>'Pedri',              'pos'=>'MC', 'pj'=>27,'goles'=>6, 'asist'=>10,'min'=>2100,'rating'=>8.3],
            ['name'=>'Frenkie de Jong',    'pos'=>'MC', 'pj'=>25,'goles'=>3, 'asist'=>7, 'min'=>1940,'rating'=>7.8],
            ['name'=>'Gavi',               'pos'=>'MC', 'pj'=>23,'goles'=>4, 'asist'=>6, 'min'=>1720,'rating'=>7.7],
            ['name'=>'Ronald Araujo',      'pos'=>'DF', 'pj'=>22,'goles'=>2, 'asist'=>1, 'min'=>1890,'rating'=>7.6],
            ['name'=>'Jules Kounde',       'pos'=>'DF', 'pj'=>27,'goles'=>3, 'asist'=>4, 'min'=>2180,'rating'=>7.5],
            ['name'=>'Inigo Martinez',     'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>2, 'min'=>1960,'rating'=>7.4],
            ['name'=>'Alejandro Balde',    'pos'=>'DF', 'pj'=>26,'goles'=>1, 'asist'=>5, 'min'=>2080,'rating'=>7.3],
            ['name'=>'Marc-Andre ter Stegen','pos'=>'PO','pj'=>28,'goles'=>0,'asist'=>0, 'min'=>2520,'rating'=>7.6],
        ],
        // 3 Atletico de Madrid
        3 => [
            ['name'=>'Antoine Griezmann',  'pos'=>'MC', 'pj'=>28,'goles'=>15,'asist'=>10,'min'=>2240,'rating'=>8.5],
            ['name'=>'Alvaro Morata',      'pos'=>'DC', 'pj'=>27,'goles'=>14,'asist'=>6, 'min'=>2080,'rating'=>8.0],
            ['name'=>'Rodrigo De Paul',    'pos'=>'MC', 'pj'=>26,'goles'=>5, 'asist'=>8, 'min'=>2020,'rating'=>7.7],
            ['name'=>'Koke',               'pos'=>'MC', 'pj'=>27,'goles'=>3, 'asist'=>7, 'min'=>2050,'rating'=>7.5],
            ['name'=>'Nahuel Molina',      'pos'=>'DF', 'pj'=>25,'goles'=>4, 'asist'=>5, 'min'=>2010,'rating'=>7.4],
            ['name'=>'Marcos Llorente',    'pos'=>'MC', 'pj'=>24,'goles'=>5, 'asist'=>6, 'min'=>1780,'rating'=>7.5],
            ['name'=>'Jose Maria Gimenez', 'pos'=>'DF', 'pj'=>26,'goles'=>2, 'asist'=>1, 'min'=>2150,'rating'=>7.4],
            ['name'=>'Reinildo Mandava',   'pos'=>'DF', 'pj'=>23,'goles'=>0, 'asist'=>2, 'min'=>1820,'rating'=>7.1],
            ['name'=>'Stefan Savic',       'pos'=>'DF', 'pj'=>22,'goles'=>1, 'asist'=>1, 'min'=>1780,'rating'=>7.0],
            ['name'=>'Conor Gallagher',    'pos'=>'MC', 'pj'=>24,'goles'=>4, 'asist'=>5, 'min'=>1740,'rating'=>7.3],
            ['name'=>'Jan Oblak',          'pos'=>'PO', 'pj'=>28,'goles'=>0, 'asist'=>0, 'min'=>2520,'rating'=>7.7],
        ],
        // 4 Athletic Club
        4 => [
            ['name'=>'Nico Williams',      'pos'=>'EX', 'pj'=>28,'goles'=>12,'asist'=>14,'min'=>2180,'rating'=>8.3],
            ['name'=>'Oihan Sancet',       'pos'=>'MC', 'pj'=>27,'goles'=>10,'asist'=>7, 'min'=>2020,'rating'=>7.9],
            ['name'=>'Gorka Guruzeta',     'pos'=>'DC', 'pj'=>26,'goles'=>13,'asist'=>4, 'min'=>1960,'rating'=>7.8],
            ['name'=>'Alex Berenguer',     'pos'=>'EX', 'pj'=>25,'goles'=>7, 'asist'=>6, 'min'=>1780,'rating'=>7.5],
            ['name'=>'Mikel Vesga',        'pos'=>'MC', 'pj'=>27,'goles'=>2, 'asist'=>4, 'min'=>2100,'rating'=>7.2],
            ['name'=>'Yeray Alvarez',      'pos'=>'DF', 'pj'=>26,'goles'=>1, 'asist'=>1, 'min'=>2120,'rating'=>7.1],
            ['name'=>'Dani Vivian',        'pos'=>'DF', 'pj'=>25,'goles'=>2, 'asist'=>2, 'min'=>2010,'rating'=>7.2],
            ['name'=>'Inigo Lekue',        'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>4, 'min'=>1820,'rating'=>7.0],
            ['name'=>'Julen Agirrezabala', 'pos'=>'PO', 'pj'=>28,'goles'=>0, 'asist'=>0, 'min'=>2520,'rating'=>7.4],
        ],
        // 5 Villarreal CF
        5 => [
            ['name'=>'Gerard Moreno',      'pos'=>'DC', 'pj'=>27,'goles'=>14,'asist'=>7, 'min'=>2060,'rating'=>8.1],
            ['name'=>'Nicolas Jackson',    'pos'=>'DC', 'pj'=>26,'goles'=>12,'asist'=>5, 'min'=>1980,'rating'=>7.8],
            ['name'=>'Alex Baena',         'pos'=>'EX', 'pj'=>27,'goles'=>7, 'asist'=>11,'min'=>2020,'rating'=>8.0],
            ['name'=>'Yeremy Pino',        'pos'=>'EX', 'pj'=>25,'goles'=>6, 'asist'=>8, 'min'=>1840,'rating'=>7.7],
            ['name'=>'Etienne Capoue',     'pos'=>'MC', 'pj'=>26,'goles'=>3, 'asist'=>5, 'min'=>2050,'rating'=>7.3],
            ['name'=>'Juan Foyth',         'pos'=>'DF', 'pj'=>25,'goles'=>2, 'asist'=>4, 'min'=>1980,'rating'=>7.2],
            ['name'=>'Pau Torres',         'pos'=>'DF', 'pj'=>26,'goles'=>1, 'asist'=>2, 'min'=>2140,'rating'=>7.3],
            ['name'=>'Pepe Reina',         'pos'=>'PO', 'pj'=>27,'goles'=>0, 'asist'=>0, 'min'=>2430,'rating'=>7.1],
        ],
        // 6 Real Sociedad
        6 => [
            ['name'=>'Mikel Oyarzabal',    'pos'=>'DC', 'pj'=>27,'goles'=>13,'asist'=>8, 'min'=>2060,'rating'=>8.0],
            ['name'=>'Brais Mendez',       'pos'=>'MC', 'pj'=>26,'goles'=>9, 'asist'=>7, 'min'=>1920,'rating'=>7.8],
            ['name'=>'Takefusa Kubo',      'pos'=>'EX', 'pj'=>27,'goles'=>8, 'asist'=>9, 'min'=>1980,'rating'=>7.9],
            ['name'=>'David Silva',        'pos'=>'MC', 'pj'=>18,'goles'=>3, 'asist'=>5, 'min'=>1320,'rating'=>7.7],
            ['name'=>'Martin Zubimendi',   'pos'=>'MC', 'pj'=>27,'goles'=>2, 'asist'=>4, 'min'=>2160,'rating'=>7.5],
            ['name'=>'Aritz Elustondo',    'pos'=>'DF', 'pj'=>25,'goles'=>1, 'asist'=>2, 'min'=>2020,'rating'=>7.1],
            ['name'=>'Aihen Munoz',        'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>3, 'min'=>1840,'rating'=>7.0],
            ['name'=>'Alex Remiro',        'pos'=>'PO', 'pj'=>27,'goles'=>0, 'asist'=>0, 'min'=>2430,'rating'=>7.3],
        ],
        // 7 Sevilla FC
        7 => [
            ['name'=>'Youssef En-Nesyri',  'pos'=>'DC', 'pj'=>27,'goles'=>18,'asist'=>4, 'min'=>2100,'rating'=>7.9],
            ['name'=>'Lucas Ocampos',      'pos'=>'EX', 'pj'=>26,'goles'=>8, 'asist'=>9, 'min'=>1940,'rating'=>7.7],
            ['name'=>'Ivan Rakitic',       'pos'=>'MC', 'pj'=>25,'goles'=>4, 'asist'=>7, 'min'=>1880,'rating'=>7.5],
            ['name'=>'Sergio Ramos',       'pos'=>'DF', 'pj'=>22,'goles'=>2, 'asist'=>1, 'min'=>1800,'rating'=>7.2],
            ['name'=>'Joan Jordan',        'pos'=>'MC', 'pj'=>24,'goles'=>3, 'asist'=>4, 'min'=>1760,'rating'=>7.1],
            ['name'=>'Marcos Acuna',       'pos'=>'DF', 'pj'=>23,'goles'=>1, 'asist'=>4, 'min'=>1740,'rating'=>7.0],
            ['name'=>'Yassine Bounou',     'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.4],
        ],
        // 8 Real Betis
        8 => [
            ['name'=>'Ayoze Perez',        'pos'=>'MC', 'pj'=>27,'goles'=>10,'asist'=>9, 'min'=>2050,'rating'=>7.7],
            ['name'=>'Isco',               'pos'=>'MC', 'pj'=>24,'goles'=>7, 'asist'=>8, 'min'=>1740,'rating'=>7.8],
            ['name'=>'Borja Iglesias',     'pos'=>'DC', 'pj'=>25,'goles'=>11,'asist'=>5, 'min'=>1920,'rating'=>7.6],
            ['name'=>'Sergio Canales',     'pos'=>'MC', 'pj'=>22,'goles'=>5, 'asist'=>7, 'min'=>1640,'rating'=>7.5],
            ['name'=>'Marc Bartra',        'pos'=>'DF', 'pj'=>24,'goles'=>2, 'asist'=>2, 'min'=>1980,'rating'=>7.1],
            ['name'=>'Alex Moreno',        'pos'=>'DF', 'pj'=>23,'goles'=>2, 'asist'=>4, 'min'=>1760,'rating'=>7.2],
            ['name'=>'Rui Silva',          'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.0],
        ],
        // 9 Valencia CF
        9 => [
            ['name'=>'Hugo Duro',          'pos'=>'DC', 'pj'=>27,'goles'=>11,'asist'=>4, 'min'=>2000,'rating'=>7.5],
            ['name'=>'Javi Guerra',        'pos'=>'MC', 'pj'=>26,'goles'=>7, 'asist'=>6, 'min'=>1920,'rating'=>7.4],
            ['name'=>'Justin Kluivert',    'pos'=>'EX', 'pj'=>24,'goles'=>9, 'asist'=>5, 'min'=>1720,'rating'=>7.6],
            ['name'=>'Diego Lopez',        'pos'=>'MC', 'pj'=>25,'goles'=>3, 'asist'=>5, 'min'=>1860,'rating'=>7.1],
            ['name'=>'Cesar Tarrega',      'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>1, 'min'=>1920,'rating'=>7.0],
            ['name'=>'Jose Gaya',          'pos'=>'DF', 'pj'=>23,'goles'=>1, 'asist'=>4, 'min'=>1740,'rating'=>7.2],
            ['name'=>'Giorgi Mamardashvili','pos'=>'PO','pj'=>27,'goles'=>0, 'asist'=>0, 'min'=>2430,'rating'=>7.5],
        ],
        // Del 10 al 20 plantillas mas cortas
        10 => [
            ['name'=>'Alvaro Garcia',      'pos'=>'EX', 'pj'=>27,'goles'=>8, 'asist'=>6, 'min'=>1980,'rating'=>7.4],
            ['name'=>'Isi Palazon',        'pos'=>'MC', 'pj'=>26,'goles'=>6, 'asist'=>7, 'min'=>1860,'rating'=>7.3],
            ['name'=>'Radamel Falcao',     'pos'=>'DC', 'pj'=>22,'goles'=>10,'asist'=>3, 'min'=>1620,'rating'=>7.2],
            ['name'=>'Oscar Trejo',        'pos'=>'MC', 'pj'=>24,'goles'=>4, 'asist'=>6, 'min'=>1740,'rating'=>7.0],
            ['name'=>'Alejandro Catena',   'pos'=>'DF', 'pj'=>25,'goles'=>1, 'asist'=>1, 'min'=>2010,'rating'=>6.9],
            ['name'=>'Fran Garcia',        'pos'=>'DF', 'pj'=>24,'goles'=>2, 'asist'=>4, 'min'=>1820,'rating'=>7.1],
            ['name'=>'Stole Dimitrievski', 'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.0],
        ],
        11 => [
            ['name'=>'Borja Mayoral',      'pos'=>'DC', 'pj'=>26,'goles'=>9, 'asist'=>3, 'min'=>1840,'rating'=>7.3],
            ['name'=>'Mason Greenwood',    'pos'=>'EX', 'pj'=>25,'goles'=>11,'asist'=>7, 'min'=>1920,'rating'=>7.8],
            ['name'=>'Mauro Arambarri',    'pos'=>'MC', 'pj'=>26,'goles'=>3, 'asist'=>4, 'min'=>2020,'rating'=>7.1],
            ['name'=>'David Soria',        'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.0],
            ['name'=>'Juan Iglesias',      'pos'=>'DF', 'pj'=>24,'goles'=>0, 'asist'=>2, 'min'=>1820,'rating'=>6.8],
            ['name'=>'Jorge Cuenca',       'pos'=>'DF', 'pj'=>23,'goles'=>1, 'asist'=>1, 'min'=>1760,'rating'=>6.9],
        ],
        12 => [
            ['name'=>'Toni Martinez',      'pos'=>'DC', 'pj'=>25,'goles'=>9, 'asist'=>3, 'min'=>1760,'rating'=>7.2],
            ['name'=>'Abdou Diallo',       'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>2, 'min'=>1880,'rating'=>6.9],
            ['name'=>'Ximo Navarro',       'pos'=>'DF', 'pj'=>23,'goles'=>0, 'asist'=>3, 'min'=>1740,'rating'=>6.8],
            ['name'=>'Antonio Sivera',     'pos'=>'PO', 'pj'=>25,'goles'=>0, 'asist'=>0, 'min'=>2250,'rating'=>6.9],
            ['name'=>'Kike Garcia',        'pos'=>'DC', 'pj'=>24,'goles'=>7, 'asist'=>2, 'min'=>1620,'rating'=>7.0],
        ],
        13 => [
            ['name'=>'Iago Aspas',         'pos'=>'DC', 'pj'=>27,'goles'=>14,'asist'=>7, 'min'=>2020,'rating'=>8.0],
            ['name'=>'Williot Swedberg',   'pos'=>'MC', 'pj'=>24,'goles'=>5, 'asist'=>6, 'min'=>1680,'rating'=>7.3],
            ['name'=>'Carles Planas',      'pos'=>'DF', 'pj'=>25,'goles'=>1, 'asist'=>3, 'min'=>1900,'rating'=>7.0],
            ['name'=>'Joseph Aidoo',       'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>1, 'min'=>1880,'rating'=>6.9],
            ['name'=>'Ivan Villar',        'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.1],
            ['name'=>'Gabri Veiga',        'pos'=>'MC', 'pj'=>22,'goles'=>5, 'asist'=>4, 'min'=>1540,'rating'=>7.2],
        ],
        14 => [
            ['name'=>'Ante Budimir',       'pos'=>'DC', 'pj'=>26,'goles'=>12,'asist'=>4, 'min'=>1980,'rating'=>7.6],
            ['name'=>'Aimar Oroz',         'pos'=>'MC', 'pj'=>25,'goles'=>6, 'asist'=>7, 'min'=>1840,'rating'=>7.3],
            ['name'=>'Jon Moncayola',      'pos'=>'MC', 'pj'=>26,'goles'=>3, 'asist'=>4, 'min'=>1980,'rating'=>7.0],
            ['name'=>'David Garcia',       'pos'=>'DF', 'pj'=>25,'goles'=>2, 'asist'=>1, 'min'=>2050,'rating'=>7.0],
            ['name'=>'Sergio Herrera',     'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.1],
        ],
        15 => [
            ['name'=>'Javier Puado',       'pos'=>'EX', 'pj'=>25,'goles'=>8, 'asist'=>5, 'min'=>1780,'rating'=>7.2],
            ['name'=>'Alejo Veliz',        'pos'=>'DC', 'pj'=>24,'goles'=>7, 'asist'=>3, 'min'=>1640,'rating'=>7.0],
            ['name'=>'Omar El Hilali',     'pos'=>'DF', 'pj'=>23,'goles'=>1, 'asist'=>2, 'min'=>1760,'rating'=>6.8],
            ['name'=>'Joan Garcia',        'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>7.3],
            ['name'=>'Irvin Cardona',      'pos'=>'DC', 'pj'=>22,'goles'=>6, 'asist'=>3, 'min'=>1480,'rating'=>6.9],
        ],
        16 => [
            ['name'=>'Samu Omorodion',     'pos'=>'DC', 'pj'=>25,'goles'=>9, 'asist'=>2, 'min'=>1720,'rating'=>7.0],
            ['name'=>'Arnaut Danjuma',     'pos'=>'EX', 'pj'=>24,'goles'=>7, 'asist'=>5, 'min'=>1640,'rating'=>7.1],
            ['name'=>'Ivan Martin',        'pos'=>'MC', 'pj'=>25,'goles'=>4, 'asist'=>6, 'min'=>1800,'rating'=>7.0],
            ['name'=>'Miguel Gutierrez',   'pos'=>'DF', 'pj'=>24,'goles'=>2, 'asist'=>4, 'min'=>1840,'rating'=>7.0],
            ['name'=>'Paulo Gazzaniga',    'pos'=>'PO', 'pj'=>25,'goles'=>0, 'asist'=>0, 'min'=>2250,'rating'=>6.9],
        ],
        17 => [
            ['name'=>'Sandro Ramirez',     'pos'=>'DC', 'pj'=>24,'goles'=>8, 'asist'=>3, 'min'=>1620,'rating'=>6.9],
            ['name'=>'Mika Marmol',        'pos'=>'DF', 'pj'=>24,'goles'=>1, 'asist'=>1, 'min'=>1920,'rating'=>6.8],
            ['name'=>'Copete',             'pos'=>'EX', 'pj'=>23,'goles'=>4, 'asist'=>4, 'min'=>1540,'rating'=>6.8],
            ['name'=>'Alvaro Valles',      'pos'=>'PO', 'pj'=>25,'goles'=>0, 'asist'=>0, 'min'=>2250,'rating'=>6.9],
        ],
        18 => [
            ['name'=>'Vedat Muriqi',       'pos'=>'DC', 'pj'=>26,'goles'=>10,'asist'=>2, 'min'=>1960,'rating'=>7.1],
            ['name'=>'Abdón Prats',        'pos'=>'DC', 'pj'=>24,'goles'=>7, 'asist'=>3, 'min'=>1680,'rating'=>7.0],
            ['name'=>'Antonio Raillo',     'pos'=>'DF', 'pj'=>25,'goles'=>2, 'asist'=>1, 'min'=>2020,'rating'=>6.9],
            ['name'=>'Dominik Greif',      'pos'=>'PO', 'pj'=>26,'goles'=>0, 'asist'=>0, 'min'=>2340,'rating'=>6.8],
        ],
        19 => [
            ['name'=>'Selim Amallah',      'pos'=>'MC', 'pj'=>24,'goles'=>5, 'asist'=>4, 'min'=>1680,'rating'=>6.6],
            ['name'=>'Marcos Leon',        'pos'=>'MC', 'pj'=>23,'goles'=>3, 'asist'=>4, 'min'=>1540,'rating'=>6.5],
            ['name'=>'Anuar',              'pos'=>'EX', 'pj'=>22,'goles'=>4, 'asist'=>3, 'min'=>1460,'rating'=>6.6],
            ['name'=>'Masip',              'pos'=>'PO', 'pj'=>24,'goles'=>0, 'asist'=>0, 'min'=>2160,'rating'=>6.5],
        ],
        20 => [
            ['name'=>'Yvan Neyou',         'pos'=>'MC', 'pj'=>23,'goles'=>3, 'asist'=>2, 'min'=>1620,'rating'=>6.4],
            ['name'=>'Munir El Haddadi',   'pos'=>'EX', 'pj'=>22,'goles'=>4, 'asist'=>3, 'min'=>1480,'rating'=>6.5],
            ['name'=>'Martin Aguirregabiria','pos'=>'DF','pj'=>22,'goles'=>1,'asist'=>2, 'min'=>1640,'rating'=>6.4],
            ['name'=>'Marko Dmitrovic',    'pos'=>'PO', 'pj'=>23,'goles'=>0, 'asist'=>0, 'min'=>2070,'rating'=>6.3],
        ],
    ];
}
