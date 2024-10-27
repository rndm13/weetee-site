<?php

namespace App\Http\Controllers;

use App\Models\DocumentationPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class DocumentationController extends Controller
{
    public function show(string $slug): View
    {
        $doc_list = DocumentationPage::select('title', 'slug')->orderBy('order')->get();

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
        $inputs = $request->validate([
            'id' => ['sometimes'],
            'title' => ['required'],
            'order' => ['required', 'integer'],
            'slug' => [],
            'description' => ['required'],
        ]);

        $new_doc = true;
        $doc = new DocumentationPage();

        if (array_key_exists("id", $inputs)) {
            $doc = DocumentationPage::find($inputs["id"]);
            $new_doc = false;

            if ($doc === null) {
                abort(404);
            }
        }

        Log::debug($inputs);

        $doc->title = $inputs['title'];

        if ($inputs['slug'] !== null) {
            $doc->slug = $inputs['slug'];
        } elseif ($new_doc) {
            $doc->slug = Str::slug($inputs['title']);
        }

        $doc->order = $inputs['order'];
        $doc->description = $inputs['description'];

        $doc->save();

        return back();
    }

    public function delete($id): RedirectResponse
    {
        DocumentationPage::destroy($id);

        return to_route('admin.documentations');
    }
}
