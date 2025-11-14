<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['category'])->get();

        return view('news.index', ['news' => $news]);
    }

    public function show(int $id)
    {
        $news = News::findOrFail($id);
        return view('news.show', ['news' => $news]);
    }

    public function create()
    {
        return view('news.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:40',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'image_description' => 'required|string',
        ], [
            'title.required' => 'El título es requerido',
            'title.string' => 'El título debe ser una cadena de texto',
            'title.max' => 'El título debe tener menos de 40 caracteres',
            'content.required' => 'El contenido de la noticia es requerido',
            'content.string' => 'El contenido de la noticia debe ser una cadena de texto',
            'image.image' => 'La imagen debe ser jpeg, png o jpg',
            'image.mimes' => 'La imagen debe ser jpeg, png o jpg',
            'image.max' => 'La imagen debe pesar menos de 2048KB',
            'image_description.required' => 'La descripción de la imagen es requerida',
            'image_description.string' => 'La descripción de la imagen debe ser una cadena de texto',
        ]);

        try {
            $data = $request->only(['title', 'content', 'image', 'image_description', 'category_fk_id']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images');
            }

            $news = News::create($data);

            return to_route('news.index')
                ->with('feedback.message', 'La noticia <b>' . e($data['title']) . '</b> se ha creado correctamente');
        } catch (\Throwable $th) {
            // if(isset($data['image']) && Storage::exists($data['image']))
            //     eliminar($data['image']);

            throw $th;
        }
    }

    public function edit(int $id)
    {
        return view('news.edit', [
            'news' => News::findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:40',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_description' => 'required|string',
        ], [
            'title.required' => 'El título es requerido',
            'title.string' => 'El título debe ser una cadena de texto',
            'title.max' => 'El título debe tener menos de 40 caracteres',
            'content.required' => 'El contenido de la noticia es requerido',
            'content.string' => 'El contenido de la noticia debe ser una cadena de texto',
            'image.image' => 'La imagen debe ser jpeg, png o jpg',
            'image.mimes' => 'La imagen debe ser jpeg, png o jpg',
            'image.max' => 'La imagen debe pesar menos de 2048KB',
            'image_description.required' => 'La descripción de la imagen es requerida',
            'image_description.string' => 'La descripción de la imagen debe ser una cadena de texto',
        ]);

        $data = $request->only(['title', 'content', 'image_description', 'category_fk_id']);

        $news = News::findOrFail($id);

        $oldImage = $news->image;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images');
        }

        $news->update($data);

        if ($request->hasFile('image') && $oldImage !== null && Storage::exists($oldImage)) {
            Storage::delete($oldImage);
        }

        return to_route('news.index')
            ->with('feedback.message', 'La noticia <b>' . e($news->title) . '</b> se ha actualizado correctamente');
    }

    public function delete(int $id)
    {
        $news = News::findOrFail($id);
        return view('news.delete', ['news' => $news]);
    }

    public function destroy(int $id)
    {

        $news = News::findOrFail($id);
        $news->delete();
        if ($news->image !== null && Storage::exists($news->image)) {
            Storage::delete($news->image);
        }
        return to_route('news.index')
            ->with('feedback.message', 'La noticia <b>' . e($news->title) . '</b> se ha eliminado correctamente');
    }
}
