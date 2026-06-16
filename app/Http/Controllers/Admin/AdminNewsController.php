<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Support\ImageUploader;
use App\Support\SlugGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminNewsController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', [
            'newsItems' => News::query()->latest('published_at')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.create', ['news' => new News()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateNews($request);
        $validated['slug'] = SlugGenerator::generate($validated['title'], News::class);
        $validated['image'] = $this->resolveImage($request);

        News::query()->create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Новость создана.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $this->validateNews($request, true);

        if ($validated['title'] !== $news->title) {
            $validated['slug'] = SlugGenerator::generate($validated['title'], News::class, $news->id);
        }

        $validated['image'] = $this->resolveImage($request, $news->image);

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Новость обновлена.');
    }

    public function destroy(News $news): RedirectResponse
    {
        ImageUploader::deleteIfLocal($news->image);
        $news->delete();

        return back()->with('success', 'Новость удалена.');
    }

    private function validateNews(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:50000'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,webp'],
            'image_url' => [$isUpdate ? 'nullable' : 'required_without:image', 'nullable', 'url'],
            'published_at' => ['required', 'date'],
        ]);
    }

    private function resolveImage(Request $request, ?string $currentImage = null): string
    {
        $uploaded = ImageUploader::store($request->file('image'), 'news', $currentImage);

        if ($uploaded) {
            return $uploaded;
        }

        if ($request->filled('image_url')) {
            if ($currentImage && $request->file('image') === null) {
                ImageUploader::deleteIfLocal($currentImage);
            }

            return $request->string('image_url')->toString();
        }

        if ($currentImage) {
            return $currentImage;
        }

        throw ValidationException::withMessages([
            'image' => 'Загрузите изображение или укажите ссылку.',
        ]);
    }
}
