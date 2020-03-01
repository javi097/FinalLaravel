<?php

namespace App\Http\Controllers;

use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedores=Vendedor::orderBy('nombre')->paginate(3);
        return view('vendedores.index',compact('vendedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendedores.create');
        
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
            'nombre'=>['required','unique:categorias,nombre'],
            'apellidos'=>['required']
        ]);
        //compruebo si he subido archiivo
        if($request->has('foto')){
            $request->validate([
                'foto'=>['image']
            ]);
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('foto');
            //Creo un nombre
            $nombre='vendedores/'.time().'_'.$file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //Guardo el articulo pero la imagen estaria mal
            $vendedor=Vendedor::create($request->all());
            //actualiza el registro foto del coche guardado
            $vendedor->update(['foto'=>"img/$nombre"]);
        }
        else{
            Vendedor::create($request->all());
        }
        return redirect()->route('vendedores.index')->with("mensaje", "Vendedor guardado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedore)
    {
        return view('vendedores.detalle',compact('vendedore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedore)
    {
        return view('vendedores.edit', compact('vendedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $vendedore)
    {
        $request->validate([
            'nombre'=>['required','unique:articulos,nombre,'.$vendedore->id],
            'apellidos'=>['required'],
        ]);
        //compruebo si he subido archiivo
        if($request->has('foto')){
            $request->validate([
                'foto'=>['image']
            ]);
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('foto');
            //Creo un nombre
            $nombre='vendedores/'.time().'_'.$file->getClientOriginalName();
            //Guardo el archivo de imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            if(basename($vendedore->foto!='default.jpg')){
                unlink($vendedore->foto);
            }
            $vendedore->update($request->all());
            $vendedore->update(['foto'=>"img/$nombre"]);
        }
        else{
            $vendedore->update($request->all());
        }
        return redirect()->route('vendedores.index')->with("mensaje", "Vendedor Modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedor)
    {
        //
    }
}
