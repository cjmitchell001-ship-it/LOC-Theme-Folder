# remove-importants.ps1
# Removes !important from 24 declarations. Keeps lines 5953 and 7765 (intentional guards).
# Also fixes line 7858: #152d58 -> var(--blue-dark).
# CRLF-preserving. Reverts on failure.

$cssPath = Join-Path (Split-Path -Parent $MyInvocation.MyCommand.Path) 'style.css'
$rawContent = [System.IO.File]::ReadAllText($cssPath, [System.Text.Encoding]::UTF8)
$lineEnding = if ($rawContent -match "`r`n") { "`r`n" } else { "`n" }

$lines  = $rawContent -split [regex]::Escape($lineEnding)
$n      = $lines.Count
$result = [array]::CreateInstance([string], $n)
[array]::Copy($lines, $result, $n)

# Lines to KEEP !important (1-based)
$keepLines = @(5953, 7765)

$removedCount = 0
$fixedHex     = 0

for ($i = 0; $i -lt $n; $i++) {
    $lineNum = $i + 1
    $line = $result[$i]
    if ($line -notmatch '!important') { continue }
    if ($keepLines -contains $lineNum) { continue }

    # Fix #152d58 on line 7858 before stripping !important
    if ($lineNum -eq 7858) {
        $line = $line -replace '#152d58', 'var(--blue-dark)'
        $fixedHex++
    }

    # Remove !important (with any preceding whitespace, before the semicolon)
    $newLine = $line -replace '\s*!important', ''
    if ($newLine -ne $line) {
        $result[$i] = $newLine
        $removedCount++
    }
}

$newContent = $result -join $lineEnding

# Count remaining !importants
$remaining = ([regex]::Matches($newContent, '!important')).Count

# Brace balance
$open  = ([regex]::Matches($newContent, '\{')).Count
$close = ([regex]::Matches($newContent, '\}')).Count
$balanced = $open -eq $close

Write-Host '=== SWAP COUNTS ==='
Write-Host ('  !important removed : {0}  (expected 24)  {1}' -f $removedCount, $(if ($removedCount -eq 24) { 'PASS' } else { '!! FAIL' }))
Write-Host ('  hex fix (#152d58)  : {0}  (expected 1)   {1}' -f $fixedHex,     $(if ($fixedHex -eq 1)     { 'PASS' } else { '!! FAIL' }))

Write-Host ''
Write-Host '=== REMAINING !important ==='
Write-Host ('  Total remaining: {0}  (expected 2)  {1}' -f $remaining, $(if ($remaining -eq 2) { 'PASS' } else { '!! FAIL' }))
# Print the surviving lines
$newLines = $newContent -split "`r?`n"
for ($i = 0; $i -lt $newLines.Count; $i++) {
    if ($newLines[$i] -match '!important') {
        Write-Host ('  Line {0}: {1}' -f ($i+1), $newLines[$i].Trim())
    }
}

Write-Host ''
Write-Host '=== BRACE BALANCE ==='
Write-Host ('  Open {{ : {0}  Close }} : {1}  Balanced: {2}  {3}' -f $open, $close, $balanced, $(if ($balanced) { 'PASS' } else { '!! FAIL' }))

$allPass = ($removedCount -eq 24) -and ($fixedHex -eq 1) -and ($remaining -eq 2) -and $balanced

if (-not $allPass) {
    Write-Host ''
    Write-Host '!! ONE OR MORE CHECKS FAILED. File NOT written.'
    exit 1
}

[System.IO.File]::WriteAllBytes($cssPath, [System.Text.Encoding]::UTF8.GetBytes($newContent))

$onDisk = [System.IO.File]::ReadAllText($cssPath, [System.Text.Encoding]::UTF8)
Write-Host ''
Write-Host ('CRLF present: {0}' -f ($onDisk -match "`r`n"))
Write-Host 'All checks passed. Written.'
