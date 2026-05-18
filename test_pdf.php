<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('government.pdf.report', ['totalFarmers'=>1]);
    $output = $pdf->output();
    echo "PDF generated successfully, size: " . strlen($output) . " bytes\n";
} catch (\Exception $e) {
    echo "Error generating PDF: " . $e->getMessage() . "\n";
}
