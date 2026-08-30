<?php
$companyModelFile = 'app/Models/Company.php';
$content = file_get_contents($companyModelFile);

if (strpos($content, "'status'") === false) {
    $content = str_replace("'category_id',", "'category_id',\n        'status',", $content);
}

if (strpos($content, 'public function user()') === false) {
    $userRel = <<<PHP

    public function user()
    {
        return \$this->belongsTo(User::class, 'email', 'email');
    }

PHP;
    $content = preg_replace('/}\s*$/', $userRel . "}\n", $content);
}

file_put_contents($companyModelFile, $content);
echo "Company model patched.\n";
?>
