<?php
$userModelFile = 'app/Models/User.php';
$userModelContent = file_get_contents($userModelFile);

if (strpos($userModelContent, 'public function company()') === false) {
    $companyRel = <<<PHP

    public function company()
    {
        return \$this->hasOne(Company::class, 'email', 'email');
    }
PHP;
    $userModelContent = preg_replace('/}\s*$/', $companyRel . "\n}\n", $userModelContent);
    file_put_contents($userModelFile, $userModelContent);
}
?>
