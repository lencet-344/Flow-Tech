<?php
$content = file_get_contents('app/Http/Requests/CompanyRequest.php');

$searchRules = <<<'PHP'
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:50|unique:companies,email,' . $id,
            'address' => 'required|string|max:100',
            'telephone' => 'required|integer|unique:companies,telephone,' . $id,
            'type_product' => 'required|string|max:30',
        ];
PHP;
$replaceRules = <<<'PHP'
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:50|unique:companies,email,' . $id,
            'address' => 'required|string|max:100',
            'telephone' => 'required|integer|unique:companies,telephone,' . $id,
            'type_product' => 'nullable|string|max:30',
            'description' => 'nullable|string',
            'website' => 'nullable|string|max:100',
            'horario' => 'nullable|string|max:100',
            'category_id' => 'nullable|integer|exists:categories,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
PHP;

$content = str_replace($searchRules, $replaceRules, $content);
file_put_contents('app/Http/Requests/CompanyRequest.php', $content);

$controller = file_get_contents('app/Http/Controllers/CompanyController.php');
$searchUpdate = <<<'PHP'
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->route("companies.index")->with("success", "Empresa a sido actualizado correctamente.");
    }
PHP;
$replaceUpdate = <<<'PHP'
    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if ($company->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($company->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('companies', 'public');
        }
        $company->update($data);
        return back()->with("success", "Empresa actualizada correctamente.");
    }
PHP;
$controller = str_replace($searchUpdate, $replaceUpdate, $controller);

$searchIndex = <<<'PHP'
    public function index()
    {
PHP;
$replaceIndex = <<<'PHP'
    public function profile()
    {
        $company = Company::first() ?? new Company();
        $categories = \App\Models\Category::all();
        return view('admin.perfil', compact('company', 'categories'));
    }

    public function index()
    {
PHP;
$controller = str_replace($searchIndex, $replaceIndex, $controller);
file_put_contents('app/Http/Controllers/CompanyController.php', $controller);
echo "Updated CompanyRequest and CompanyController.\n";
?>
