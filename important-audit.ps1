# important-audit.ps1 - READ ONLY. For every !important, finds competing rules.

$cssPath = Join-Path (Split-Path -Parent $MyInvocation.MyCommand.Path) 'style.css'
$lines = [System.IO.File]::ReadAllLines($cssPath, [System.Text.Encoding]::UTF8)
$n = $lines.Count

# Find :root block
$rootStart = -1; $rootEnd = -1
for ($i = 0; $i -lt $n; $i++) {
    if ($lines[$i] -match '^\s*:root\s*\{') { $rootStart = $i; break }
}
if ($rootStart -ge 0) {
    $depth = 0
    for ($i = $rootStart; $i -lt $n; $i++) {
        foreach ($ch in $lines[$i].ToCharArray()) {
            if ($ch -eq '{') { $depth++ } elseif ($ch -eq '}') { $depth--; if ($depth -eq 0) { $rootEnd = $i; break } }
        }
        if ($rootEnd -ge 0) { break }
    }
}

$propSkip = '(?i)^\s*(font-size|font|color|background|border|padding|margin|gap|box-shadow|display|position|width|height|top|left|right|bottom|z-index|opacity|transform|transition|overflow|cursor|text|letter|content|pointer|flex|grid|align|justify|min|max|line|white|outline|appearance|list|visibility|float|word|table|border-radius|box-sizing|order|object|src|format|animation|filter|font-weight|font-family|font-style|background-color)\s*:'

$currentSel = '(unknown)'
$inMQ = $false; $mqDesc = ''
$inMlComment = $false
$rows = [System.Collections.Generic.List[object]]::new()

for ($i = 0; $i -lt $n; $i++) {
    if ($rootStart -ge 0 -and $i -ge $rootStart -and $i -le $rootEnd) { continue }
    $line = $lines[$i]
    if ($inMlComment) { if ($line -match '\*/') { $inMlComment = $false }; continue }
    if ($line -match '/\*' -and $line -notmatch '/\*.*\*/') { $inMlComment = $true; continue }
    $trimmed = $line.Trim()

    if ($trimmed -match '^@media\s+(.+?)\s*\{') { $inMQ = $true; $mqDesc = $matches[1] }
    if ($inMQ -and $trimmed -eq '}') { $inMQ = $false; $mqDesc = '' }

    if ($trimmed -match '\{' -and $trimmed -notmatch '(?i)^\s*(@media|@keyframes|@font)' -and $trimmed -notmatch $propSkip) {
        $sel = ($trimmed -split '\{')[0].Trim()
        if ($sel -ne '') { $currentSel = $sel }
    }

    if ($line -notmatch '!important') { continue }

    $prop = ''
    if ($trimmed -match '(?i)^\s*([\w-]+)\s*:') { $prop = $matches[1] }

    $rows.Add([PSCustomObject]@{
        Line     = $i + 1
        Selector = $currentSel
        Property = $prop
        RawLine  = $trimmed
        InMQ     = $inMQ
        MQDesc   = $mqDesc
    })
}

function Find-Competitors($sel, $prop, $skipLine, $allLines) {
    $results = [System.Collections.Generic.List[string]]::new()
    $curS = '(unknown)'
    $inMlC = $false
    $propPat = '(?i)^\s*' + [regex]::Escape($prop) + '\s*:'
    $selCore = ($sel -split '[,\s>~+\[:]')[0].Trim() -replace '^[.#*]',''
    if ($selCore.Length -lt 3) { return $results }
    for ($i = 0; $i -lt $allLines.Count; $i++) {
        if ($i -eq ($skipLine - 1)) { continue }
        $ln = $allLines[$i]
        if ($inMlC) { if ($ln -match '\*/') { $inMlC = $false }; continue }
        if ($ln -match '/\*' -and $ln -notmatch '/\*.*\*/') { $inMlC = $true; continue }
        $tr = $ln.Trim()
        if ($tr -match '\{' -and $tr -notmatch '(?i)^\s*(@media|@keyframes)' -and $tr -notmatch $propSkip) {
            $s = ($tr -split '\{')[0].Trim()
            if ($s -ne '') { $curS = $s }
        }
        if ($tr -match $propPat) {
            if ($curS -match [regex]::Escape($selCore) -or $sel -match [regex]::Escape($curS)) {
                $results.Add(('    Line {0} | [{1}] | {2}' -f ($i+1), $curS, $tr))
            }
        }
    }
    return $results
}

Write-Host '============================================================'
Write-Host ' !important AUDIT -- every occurrence with competing rules'
Write-Host '============================================================'
Write-Host ('Total !important declarations: {0}' -f $rows.Count)
Write-Host ''

foreach ($r in $rows) {
    $mq = if ($r.InMQ) { ' [in @media ' + $r.MQDesc + ']' } else { '' }
    Write-Host '------------------------------------------------------------'
    Write-Host ('Line {0}{1}' -f $r.Line, $mq)
    Write-Host ('  Selector : {0}' -f $r.Selector)
    Write-Host ('  Rule     : {0}' -f $r.RawLine)
    if ($r.Property -ne '') {
        $competitors = Find-Competitors $r.Selector $r.Property $r.Line $lines
        if ($competitors.Count -gt 0) {
            Write-Host ("  Competing rules for '{0}':" -f $r.Property)
            foreach ($c in $competitors) { Write-Host $c }
        } else {
            Write-Host ("  Competing rules for '{0}': NONE FOUND -- fighting nothing" -f $r.Property)
        }
    }
    Write-Host ''
}

Write-Host 'Script complete. No files modified.'
