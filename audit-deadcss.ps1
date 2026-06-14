# audit-deadcss.ps1 — READ ONLY. Prints a dead-CSS report. Modifies nothing.

$themeDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$cssFile  = Join-Path $themeDir "style.css"

# --- 1. Gather source files ---
$phpHtmlFiles = Get-ChildItem -Path $themeDir -Recurse -Include "*.php","*.html" |
    Where-Object { $_.FullName -notmatch 'node_modules' }
$jsFiles = Get-ChildItem -Path $themeDir -Recurse -Include "*.js" |
    Where-Object { $_.FullName -notmatch 'node_modules' }

$phpHtmlContent = ($phpHtmlFiles | ForEach-Object { Get-Content $_.FullName -Raw }) -join "`n"
$jsContent      = if ($jsFiles) { ($jsFiles | ForEach-Object { Get-Content $_.FullName -Raw }) -join "`n" } else { "" }

Write-Host "=== SOURCE FILES SCANNED ==="
Write-Host "PHP/HTML: $($phpHtmlFiles.Count) files"
$phpHtmlFiles | ForEach-Object { Write-Host "  $($_.Name)" }
Write-Host "JS: $($jsFiles.Count) files"
$jsFiles | ForEach-Object { Write-Host "  $($_.Name)" }
Write-Host ""

# --- 2. Extract distinct class names from style.css ---
$cssLines   = Get-Content $cssFile
$cssContent = $cssLines -join "`n"

$classMatches = [regex]::Matches($cssContent, '(?<![a-zA-Z0-9_-])\.([a-zA-Z][a-zA-Z0-9_-]+)')
$allClasses   = $classMatches | ForEach-Object { $_.Groups[1].Value } | Sort-Object -Unique

Write-Host "=== TOTAL DISTINCT CSS CLASSES: $($allClasses.Count) ==="
Write-Host ""

# --- 3. For each class find line range in style.css ---
function Get-LineRange {
    param([string]$className, [string[]]$lines)
    $pattern = "(?<![a-zA-Z0-9_-])\.$([regex]::Escape($className))(?![a-zA-Z0-9_-])"
    $firstLine = $null
    $lastLine  = $null
    for ($i = 0; $i -lt $lines.Count; $i++) {
        if ($lines[$i] -match $pattern) {
            if ($null -eq $firstLine) { $firstLine = $i + 1 }
            $lastLine = $i + 1
        }
    }
    if ($null -eq $firstLine) { return "not found" }
    if ($firstLine -eq $lastLine) { return "$firstLine" }
    return "$firstLine-$lastLine"
}

# --- 4. Reference check ---
$zeroRefs   = @()
$jsSurvivors = @()

foreach ($cls in $allClasses) {
    $bounded = "(?<![a-zA-Z0-9_-])$([regex]::Escape($cls))(?![a-zA-Z0-9_-])"
    $phpCount = ([regex]::Matches($phpHtmlContent, $bounded)).Count
    $jsCount  = ([regex]::Matches($jsContent,      $bounded)).Count

    if ($phpCount -eq 0 -and $jsCount -eq 0) {
        $lineRange = Get-LineRange -className $cls -lines $cssLines
        $zeroRefs += [PSCustomObject]@{ Class = $cls; Lines = $lineRange }
    } elseif ($phpCount -eq 0 -and $jsCount -gt 0) {
        $lineRange = Get-LineRange -className $cls -lines $cssLines
        $jsSurvivors += [PSCustomObject]@{ Class = $cls; Lines = $lineRange; JsCount = $jsCount }
    }
}

# --- 5. Print ZERO-REFERENCE section ---
Write-Host "=== ZERO-REFERENCE CLASSES ($($zeroRefs.Count)) ==="
$zeroRefs | ForEach-Object {
    Write-Host ("  {0,-55} lines: {1}" -f $_.Class, $_.Lines)
}
Write-Host ""

# --- 6. Print JS-ONLY SURVIVORS section ---
Write-Host "=== JS-ONLY SURVIVORS (0 PHP/HTML, >=1 JS match) ($($jsSurvivors.Count)) ==="
$jsSurvivors | ForEach-Object {
    Write-Host ("  {0,-55} lines: {1,-12} js-matches: {2}" -f $_.Class, $_.Lines, $_.JsCount)
}
Write-Host ""

Write-Host "=== SUMMARY ==="
Write-Host "Total classes defined in style.css : $($allClasses.Count)"
Write-Host "Zero-reference (candidate dead)    : $($zeroRefs.Count)"
Write-Host "JS-only survivors (keep)           : $($jsSurvivors.Count)"
Write-Host ""
Write-Host "Script complete. No files were modified."
