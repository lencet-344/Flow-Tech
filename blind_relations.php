<?php
$file = 'resources/views/public/profile.blade.php';
$content = file_get_contents($file);

// Replace count logic
$content = str_replace(
    '{{ $company->products ? $company->products->where(\'quantity\', \'>\', 0)->count() : 0 }}',
    '{{ $company && $company->id ? $company->products()->where(\'quantity\', \'>\', 0)->count() : 0 }}',
    $content
);
$content = str_replace(
    '{{ $company->products ? $company->products->where(\'quantity\', \'<=\', 0)->count() : 0 }}',
    '{{ $company && $company->id ? $company->products()->where(\'quantity\', \'<=\', 0)->count() : 0 }}',
    $content
);

// Replace foreach with forelse
$foreachRegex = '/@if\(isset\(\$company->products\) && \$company->products->count\(\) > 0\)\s*@foreach\(\$company->products as \$item\)(.*?)@endforeach\s*@else(.*?)@endif/is';
if(preg_match($foreachRegex, $content, $matches)) {
    $loopContent = $matches[1];
    $emptyContent = $matches[2];
    
    $forelse = <<<HTML
                            @forelse(isset($company) && $company->id ? $company->products : [] as \$item)
{$loopContent}
                            @empty
{$emptyContent}
                            @endforelse
HTML;
    $content = preg_replace($foreachRegex, $forelse, $content);
}

file_put_contents($file, $content);
echo "Blinded relations.\n";
?>
