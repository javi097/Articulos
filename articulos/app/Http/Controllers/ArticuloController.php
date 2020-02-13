<?php

namespace App\Http\Controllers;

use App\Articulo;
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
        $precios = [
            0 => "Todos",
            1 => "Menos de 50€",
            2 => "Entre 50€-120€",
            3 => "Más de 120€"
        ];
        $precio=$request->get('precio');
        $categorias=['electronica','bazar','hogar'];
        $myCategoria=$request->get('categoria');
        $articulos=Articulo::orderBy('nombre')->categoria($myCategoria)->precio($precio)->paginate(3);
        return view('articulos.index',compact('articulos','request','categorias','precios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
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
            'precio'=>['required']
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
            //Guardo el coche pero la imagen estaria mal
            $articulo=Articulo::create($request->all());
            //actualiza el registro foto del coche guardado
            $articulo->update(['foto'=>"img/$nombre"]);
        }
        else{
            Articulo::create($request->all());
        }
        return redirect()->route('articulos.index')->with("mensaje", "Articulo Guardado");
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
        $categorias=['electronica','bazar','hogar'];
        return view('articulos.edit', compact('articulo', 'categorias'));
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
            'precio'=>['required']
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
                unlink($articulo->logo);
            }
            $articulo->update($request->all());
            $articulo->update(['logo'=>"img/$nombre"]);
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
        return redirect()->route('articulos.index')->with('mensaje', "Articulo Eliminado");
    
    }
}
