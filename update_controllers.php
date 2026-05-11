<?php

$dir = __DIR__ . '/app/Http/Controllers';
$models = ['RawMaterial', 'ProcessingBatch', 'QualityCheck', 'WarehouseInventory', 'Distribution'];

foreach($models as $model) {
    $var = lcfirst($model);
    $content = "<?php\n\nnamespace App\Http\Controllers;\n\nuse App\Models\\$model;\nuse Illuminate\Http\Request;\n\nclass {$model}Controller extends Controller\n{\n";
    $content .= "    public function index() { return response()->json($model::all()); }\n";
    $content .= "    public function store(Request \$request) {\n";
    $content .= "        \$$var = $model::create(\$request->all());\n";
    $content .= "        return response()->json(\$$var, 201);\n    }\n";
    $content .= "    public function show($model \$$var) { return response()->json(\$$var); }\n";
    $content .= "    public function update(Request \$request, $model \$$var) {\n";
    $content .= "        \$${var}->update(\$request->all());\n";
    $content .= "        return response()->json(\$$var);\n    }\n";
    $content .= "    public function destroy($model \$$var) { \$${var}->delete(); return response()->json(null, 204); }\n";
    $content .= "}\n";
    file_put_contents("$dir/{$model}Controller.php", $content);
}

// AI Analytics Controller
$aiController = "<?php\n\nnamespace App\Http\Controllers;\n\nuse Illuminate\Http\Request;\n\nclass AIAnalyticsController extends Controller\n{\n";
$aiController .= "    public function predictShelfLife(Request \$request) {\n";
$aiController .= "        // Simple logic to predict shelf life based on humidity, temperature, freshness\n";
$aiController .= "        \$temp = \$request->input('temperature', 20);\n";
$aiController .= "        \$humidity = \$request->input('humidity', 50);\n";
$aiController .= "        \$freshness = \$request->input('freshness_score', 100);\n";
$aiController .= "        \$baseDays = 30;\n";
$aiController .= "        \$predictedDays = \$baseDays * (\$freshness / 100) - ((\$temp - 4) * 0.5) - ((\$humidity - 40) * 0.2);\n";
$aiController .= "        return response()->json(['predicted_shelf_life_days' => max(1, round(\$predictedDays))]);\n    }\n";
$aiController .= "    public function predictQualityScore(Request \$request) {\n";
$aiController .= "        \$ph = \$request->input('ph_level', 7);\n";
$aiController .= "        \$moisture = \$request->input('moisture_level', 15);\n";
$aiController .= "        \$score = 100 - abs(7 - \$ph) * 10 - abs(12 - \$moisture) * 2;\n";
$aiController .= "        return response()->json(['predicted_quality_score' => max(0, min(100, \$score))]);\n    }\n";
$aiController .= "}\n";
file_put_contents("$dir/AIAnalyticsController.php", $aiController);

echo "Controllers generated.\n";
