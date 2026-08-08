<?php
/**
 * Leicester Oven Cleaning — Capacity view (owner-facing, private)
 *
 * Renders the output of loc_get_capacity_overview() as a single page:
 * the next free slot pinned at the top, a month grid underneath.
 *
 * Not a customer-facing page. Its CSS is deliberately scoped here rather
 * than added to style.css — style.css is loaded by every visitor, and
 * this page is only ever seen by an admin.
 *
 * Pure rendering: takes the data array, returns an HTML string. No API
 * calls, no WordPress dependency, so it can be rendered against fixtures.
 */

if ( ! function_exists( 'loc_render_capacity_view' ) ) :

function loc_capacity_zone_colour( $zone ) {
    $map = [
        'north'   => '#3b7dd8',
        'south'   => '#8e5bd0',
        'east'    => '#1f9c9c',
        'west'    => '#d2712a',
        'central' => '#555555',
    ];
    return $map[ $zone ] ?? '#999999';
}

function loc_render_capacity_view( $data ) {
    $esc = function( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); };

    ob_start();
    ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>Capacity — Leicester Oven Cleaning</title>
<style>
:root{
  --blue:#1A3A6E; --blue-dark:#122d58; --gold:#C9960C; --white:#fff;
  --lightgrey:#F5F5F5; --offblack:#1C1C2E; --border:#e2e2e2;
  --grey-600:#555; --grey-400:#888;
  --free:#2e9e5b; --full:#c0392b;
}
*{box-sizing:border-box}
body{margin:0;padding:16px 14px 56px;background:var(--lightgrey);color:var(--offblack);
     font:16px/1.5 system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
     -webkit-text-size-adjust:100%}
.wrap{max-width:820px;margin:0 auto}
.topline{display:flex;justify-content:space-between;align-items:baseline;
         margin-bottom:12px;gap:10px;flex-wrap:wrap}
.topline h1{font-size:17px;margin:0;color:var(--blue);letter-spacing:-.2px}
.topline .stamp{font-size:12px;color:var(--grey-400)}

/* ---- pinned answer ---- */
.answer{background:var(--blue);color:var(--white);border-radius:14px;padding:20px 22px;
        box-shadow:0 6px 20px rgba(26,58,110,.18)}
.answer .eyebrow{font-size:11px;letter-spacing:.1em;text-transform:uppercase;
                 opacity:.7;margin:0 0 6px}
.answer .big{font-size:clamp(24px,6vw,34px);font-weight:800;letter-spacing:-.6px;margin:0 0 6px;line-height:1.15}
.answer .big em{color:#f2c04a;font-style:normal}
.answer .meta{margin:0;opacity:.85;font-size:14px}
.chips{display:flex;gap:8px;flex-wrap:wrap;margin-top:16px}
.chip{background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);
      border-radius:20px;padding:5px 12px;font-size:13px;white-space:nowrap}
.chip b{color:#f2c04a}

.warn{background:#fff6e5;border:1px solid var(--gold);border-radius:10px;
      padding:12px 14px;margin-top:14px;font-size:13.5px;color:#6b4d00}
.warn b{color:#000}

/* ---- month grid ---- */
.month{margin-top:26px}
.month h2{font-size:14px;color:var(--blue);margin:0 0 8px;letter-spacing:.02em}
.grid{display:grid;grid-template-columns:repeat(7,1fr);gap:5px}
.dow{text-align:center;font-size:10.5px;font-weight:700;color:var(--grey-400);
     text-transform:uppercase;letter-spacing:.06em;padding-bottom:2px}
.day{background:var(--white);border:1px solid var(--border);border-radius:8px;
     min-height:76px;padding:5px 5px 7px;position:relative;display:flex;flex-direction:column}
.day.pad{background:transparent;border:0;min-height:0}
.day.shut{background:#eeeef0;border-style:dashed}
.day.today{outline:2px solid var(--blue);outline-offset:-2px}
.zone{position:absolute;top:0;left:0;right:0;height:4px;border-radius:7px 7px 0 0}
.num{font-size:12.5px;font-weight:700;color:var(--grey-600);line-height:1.2}
.day.shut .num{color:#a5a5ad}
.win{font-size:9.5px;color:var(--grey-400);letter-spacing:.03em;margin-top:2px}
.zlabel{font-size:9px;font-weight:800;letter-spacing:.05em;margin-top:1px}
.dots{margin-top:auto;display:flex;gap:3px;flex-wrap:wrap;padding-top:4px}
.dot{width:10px;height:10px;border-radius:50%;border:2px solid var(--free);flex:0 0 auto}
.dot.taken{background:var(--full);border-color:var(--full)}
.boost{position:absolute;top:5px;right:5px;font-size:8.5px;font-weight:800;color:var(--gold);
       border:1px solid var(--gold);border-radius:20px;padding:0 5px;line-height:1.5}
.nolabel{position:absolute;bottom:4px;right:5px;font-size:11px;color:var(--gold);line-height:1}

.key{display:flex;gap:16px;flex-wrap:wrap;margin-top:16px;font-size:12.5px;color:var(--grey-600)}
.key i{display:inline-block;width:10px;height:10px;border-radius:50%;margin-right:5px;vertical-align:-1px}
.zk{display:flex;gap:12px;flex-wrap:wrap;margin-top:8px;font-size:11.5px;color:var(--grey-600)}
.zk i{display:inline-block;width:15px;height:4px;border-radius:2px;margin-right:4px;vertical-align:3px}
.foot{margin-top:22px;font-size:12px;color:var(--grey-400);line-height:1.6}
@media(max-width:520px){
  .day{min-height:64px;padding:4px 3px 6px}
  .win,.zlabel{display:none}
  .dot{width:9px;height:9px;border-width:2px}
}
</style>
</head>
<body>
<div class="wrap">

<?php if ( empty( $data['auth_ok'] ) ) : ?>
  <div class="answer">
    <p class="eyebrow">Calendar</p>
    <p class="big">Not connected</p>
    <p class="meta">The Google Calendar authorisation has expired. Re-authorise at
       <code>/?loc_calendar_auth=1</code> while logged in as admin, then reload this page.</p>
  </div>
</div></body></html>
<?php
    return ob_get_clean();
endif;

$nf   = $data['next_free'];
$tot  = $data['totals'];
$warn = $data['warnings'] ?? [];
?>

<div class="topline">
  <h1>Capacity</h1>
  <span class="stamp">as at <?php echo $esc( $data['generated_at'] ); ?></span>
</div>

<div class="answer">
  <p class="eyebrow">Next free slot</p>
  <?php if ( $nf ) : ?>
    <p class="big"><em><?php echo $esc( $nf['label'] ); ?></em></p>
    <p class="meta">
      <?php echo (int) $nf['free']; ?> slot<?php echo $nf['free'] == 1 ? '' : 's'; ?> that day ·
      <?php echo $nf['zone']
            ? 'locked to ' . $esc( ucfirst( $nf['zone'] ) ) . ' (+ Central)'
            : 'any zone'; ?>
    </p>
  <?php else : ?>
    <p class="big">Nothing free</p>
    <p class="meta">No open slots in the next <?php echo count( $data['days'] ); ?> days.</p>
  <?php endif; ?>

  <div class="chips">
    <span class="chip">Next 7 days <b><?php echo (int) $tot['next_7']; ?> free</b></span>
    <span class="chip">Next 14 <b><?php echo (int) $tot['next_14']; ?> free</b></span>
    <?php if ( $tot['full_days'] ) : ?>
      <span class="chip">Full <b><?php echo count( $tot['full_days'] ); ?> day<?php echo count( $tot['full_days'] ) == 1 ? '' : 's'; ?></b></span>
    <?php endif; ?>
  </div>
</div>

<?php if ( $warn ) : ?>
  <div class="warn">
    <b>Zone label missing</b> on
    <?php
    $ds = array_map( function( $w ) {
        return date( 'j M', strtotime( $w['date'] ) ) . ' (' . ucfirst( $w['zone'] ) . ')';
    }, $warn );
    echo $esc( implode( ', ', array_slice( $ds, 0, 6 ) ) );
    echo count( $ds ) > 6 ? ' and ' . ( count( $ds ) - 6 ) . ' more' : '';
    ?>.
    Bookings are still restricted correctly — the calendar just isn't showing the zone. Marked ⚑ below.
  </div>
<?php endif; ?>

<?php
// ---- group days into months, then render Mon-first week grids ----
$byMonth = [];
foreach ( $data['days'] as $date => $d ) {
    $byMonth[ date( 'Y-m', strtotime( $date ) ) ][] = $d;
}

foreach ( $byMonth as $ym => $daysIn ) :
    $first  = $daysIn[0];
    $firstN = (int) date( 'N', strtotime( $first['date'] ) ); // 1=Mon
    ?>
  <div class="month">
    <h2><?php echo $esc( date( 'F Y', strtotime( $first['date'] ) ) ); ?></h2>
    <div class="grid">
      <?php foreach ( [ 'Mon','Tue','Wed','Thu','Fri','Sat','Sun' ] as $dw ) : ?>
        <div class="dow"><?php echo $dw; ?></div>
      <?php endforeach; ?>

      <?php for ( $p = 1; $p < $firstN; $p++ ) : ?>
        <div class="day pad"></div>
      <?php endfor; ?>

      <?php foreach ( $daysIn as $d ) :
          $shut    = ( $d['free'] < 1 );
          $classes = 'day' . ( $shut ? ' shut' : '' ) . ( $d['is_today'] ? ' today' : '' );
          $win     = $d['morning'] && $d['afternoon'] ? 'AM+PM'
                   : ( $d['morning'] ? 'AM' : ( $d['afternoon'] ? 'PM' : '—' ) );
          ?>
        <div class="<?php echo $classes; ?>">
          <?php if ( $d['zone'] ) : ?>
            <div class="zone" style="background:<?php echo $esc( loc_capacity_zone_colour( $d['zone'] ) ); ?>"></div>
          <?php endif; ?>
          <?php if ( $d['override'] ) : ?>
            <div class="boost">OPEN <?php echo (int) $d['override']['cap']; ?></div>
          <?php endif; ?>

          <div class="num"><?php echo (int) $d['dom']; ?></div>
          <div class="win"><?php echo $esc( $win ); ?></div>
          <?php if ( $d['zone'] ) : ?>
            <div class="zlabel" style="color:<?php echo $esc( loc_capacity_zone_colour( $d['zone'] ) ); ?>">
              <?php echo $esc( strtoupper( substr( $d['zone'], 0, 4 ) ) ); ?>
            </div>
          <?php endif; ?>

          <div class="dots">
            <?php
            $cap = max( 0, (int) $d['cap'] );
            for ( $i = 0; $i < $cap; $i++ ) {
                $taken = $i < (int) $d['booked'];
                // A day whose windows are all shut shows its remaining
                // capacity as taken — the cap isn't the binding constraint,
                // so hollow dots there would promise room that isn't usable.
                $solid = $taken || $shut;
                echo '<div class="dot' . ( $solid ? ' taken' : '' ) . '"></div>';
            }
            ?>
          </div>

          <?php if ( $d['zone'] && $d['zone_src'] === 'booking' ) : ?>
            <div class="nolabel" title="Zone label missing on the calendar">⚑</div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endforeach; ?>

<div class="key">
  <span><i style="border:2px solid var(--free)"></i>Slot free</span>
  <span><i style="background:var(--full)"></i>Booked / unusable</span>
  <span><i style="background:#eeeef0;border:1px dashed #bbb"></i>Day closed</span>
  <span><b style="color:var(--gold)">OPEN&nbsp;N</b> capacity override</span>
  <span><span style="color:var(--gold)">⚑</span> label missing</span>
</div>
<div class="zk">
  <?php foreach ( [ 'north','south','east','west','central' ] as $z ) : ?>
    <span><i style="background:<?php echo loc_capacity_zone_colour( $z ); ?>"></i><?php echo ucfirst( $z ); ?></span>
  <?php endforeach; ?>
</div>

<p class="foot">
  Free = the day's job cap allows another booking <em>and</em> a
  <?php echo (int) $data['probe']; ?>-minute job still fits in an open window.
  A longer job (double oven 135, range 150) may not fit a partly-booked day.
  Weekday cap <?php echo LOC_WEEKDAY_JOB_CAP; ?>, weekend cap <?php echo LOC_WEEKEND_JOB_CAP; ?>,
  unless an <em>Open: N</em> event overrides it.
</p>

</div>
</body>
</html>
    <?php
    return ob_get_clean();
}

endif;
