<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentationAssetsCollection;
use App\Models\DocumentationPage;
use App\Models\DocumentationAsset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Validation\Rule;

class DocumentationController extends Controller
{
    public function show(string $slug = ''): View|RedirectResponse
    {
        $doc_list = DocumentationPage::select('title', 'slug')->orderBy('order')->get();

        if ($slug === '') {
            $doc = DocumentationPage::orderBy('order')->first();
            return redirect(URL::route('documentation.show', ['slug' => $doc->slug]) . '/');
        }

        $doc = DocumentationPage::where('slug', $slug)->first();

        if ($doc === null) {
            abort(404);
        }

        $converter = new GithubFlavoredMarkdownConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
        $doc_markdown = $converter->convert($doc->description);

        return view("documentation.show", [
            'doc' => $doc,
            'doc_markdown' => $doc_markdown,
            'doc_list' => $doc_list,
        ]);
    }

    public function create_form(): View
    {
        return view('documentation.create');
    }

    public function edit_form(int $id): View
    {
        $doc = DocumentationPage::find($id);

        if ($doc === null) {
            abort(404);
        }

        return view('documentation.edit', ['doc' => $doc]);
    }

    public function save(Request $request): RedirectResponse
    {
        $doc = new DocumentationPage();
        $edit = false;

        $slug_rules = ['sometimes'];

        if ($request->input('id') !== null) {
            $doc = DocumentationPage::find($request->input('id'));
            $edit = true;

            if ($doc === null) {
                abort(404);
            }

            array_push($slug_rules, Rule::unique('documentation_pages', 'slug')->ignoreModel($doc));
        }

        $inputs = $request->validate([
            'id' => ['sometimes', 'integer'],
            'title' => ['required'],
            'slug' => $slug_rules,
            'order' => ['required', 'integer'],
            'description' => ['required'],
            'assets' => ['required'],
            'assets.*' => $edit ? [] : ['required', 'mimes:png,jpg,webp,bmp,gif,mp3,mp4', 'max:10240'],
        ]);

        DB::beginTransaction();

        $doc->title = $inputs['title'];

        if ($inputs['slug'] !== null) {
            $doc->slug = $inputs['slug'];
        } else {
            $doc->slug = Str::slug($inputs['title']);
        }

        $doc->order = $inputs['order'];
        $doc->description = $inputs['description'];

        $doc->save();

        $dir = 'documentation-assets/'.$doc->id.'/';
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        if (!$edit && array_key_exists('assets', $inputs)) {
            foreach ($inputs['assets'] as $file) {
                $filename = $file->getClientOriginalName();
                $generated_path = $dir;
                Storage::disk('public')->putFileAs($generated_path, $file, $filename);

                $asset = new DocumentationAsset();

                $asset->documentation_page_id = $doc->id;
                $asset->name = $filename;
                $asset->generated_path = $generated_path.$filename;

                $asset->save();
            }
        }

        DB::commit();

        return back();
    }

    public function delete(int $id): RedirectResponse
    {
        DocumentationPage::destroy($id);

        $dir = 'documentation-assets/'.$id;

        if (Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->deleteDirectory($dir);
        }

        return to_route('admin.documentations');
    }

    public function get_asset(string $doc_slug, string $asset_name): BinaryFileResponse
    {
        $asset = DocumentationAsset::where('name', $asset_name)->first();

        if ($asset === null) {
            return abort(404);
        }

        $path = Storage::disk('public')->path($asset->generated_path);

        return response()->file($path);
    }

    public function upload_asset(int $doc_id, Request $request): RedirectResponse
    {
        $inputs = $request->validate([
            'assets' => [],
            'assets.*' => ['required', 'mimes:png,jpg,webp,bmp,gif,mp3,mp4', 'max:10240'],
        ]);

        $doc = DocumentationPage::find($doc_id);
        if ($doc === null) {
            return abort(404);
        }

        $dir = 'documentation-assets/'.$doc_id.'/';
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }

        foreach ($inputs['assets'] as $file) {
            $filename = $file->getClientOriginalName();
            $generated_path = $dir;
            Storage::disk('public')->putFileAs($generated_path, $file, $filename);

            $asset = new DocumentationAsset();

            $asset->documentation_page_id = $doc->id;
            $asset->name = $filename;
            $asset->generated_path = $generated_path.$filename;

            $asset->save();
        }

        return back();
    }

    public function delete_asset(int $id): RedirectResponse
    {
        $asset = DocumentationAsset::find($id);
        if ($asset === null) {
            return abort(404);
        }

        Storage::disk('public')->delete($asset->generated_path);

        DocumentationAsset::destroy($id);

        return back();
    }

    public function list_assets(int $doc_id)
    {
        $assets = DocumentationAsset::where('documentation_page_id', $doc_id)->get();

        return new DocumentationAssetsCollection($assets);
    }
}
