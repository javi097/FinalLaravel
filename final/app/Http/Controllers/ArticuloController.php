<?php

namespace App\Http\Controllers;

use App\Articulo;
use App\Categoria;
use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias=Categoria::orderBy('nombre')->get();
        $categoria=$request->get('categoria_id');
        $articulos=Articulo::orderBy('nombre')->categoria_id($categoria)->paginate(3);
        return view('articulos.index',compact('articulos','categorias','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=Categoria::orderBy('nombre')->get();

        return view('articulos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>['required','unique:articulos,nombre'],
            'precio'=>['required'],
            'detalle'=>['required'],
            'categoria_id'=>['required']
        ]);
        //compruebo si he subido archiivo
        if($request->has('foto')){
            $request->validate([
                'foto'=>['image']
            ]);
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('foto');
            //Creo un nombre
            $nombre='articulos/'.time().'_'.$file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //Guardo el articulo pero la imagen estaria mal
            $articulo=Articulo::create($request->all());
            //actualiza el registro foto del coche guardado
            $articulo->update(['foto'=>"img/$nombre"]);
        }
        else{
            Articulo::create($request->all());
        }
        return redirect()->route('articulos.index')->with("mensaje", "Articulo creado correctamente!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        
        return view('articulos.detalle',compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
 
        return view('articulos.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        $request->validate([
            'nombre'=>['required','unique:articulos,nombre,'.$articulo->id],
            'precio'=>['required'],
            'detalle'=>['required']
        ]);
        //compruebo si he subido archiivo
        if($request->has('foto')){
            $request->validate([
                'foto'=>['image']
            ]);
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('foto');
            //Creo un nombre
            $nombre='articulos/'.time().'_'.$file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            if(basename($articulo->foto!='default.jpg')){
                unlink($articulo->foto);
            }
            $articulo->update($request->all());
            $articulo->update(['foto'=>"img/$nombre"]);
        }
        else{
            $articulo->update($request->all());
        }
        return redirect()->route('articulos.index')->with("mensaje", "Articulo Modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
           //Dos cosas borrar la imagen si no es default.jpg
        //y borrar registro
        $foto=$articulo->foto;
        if(basename($foto)!="default.jpg"){
            //la borro NO es default.jpg
            unlink($foto);
        }
        //en cualquier caso borro el registro
        $articulo->delete();
        return redirect()->route('articulos.index')->with('mensaje', "Articulo eliminado correctamente!!");
    }
}
