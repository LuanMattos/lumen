<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController 
{
    protected $classe;

    public function index( Request $request )
    {
        // $per_page = ( isset( $request->per_page ) ? $request->per_page: 10 );
        // $offset = ($request->page - 1) * $per_page;

        // return $this->classe::query()
        // ->offset( $offset )
        // ->limit( $per_page )
        // ->get();
        return $this->classe::paginate( $request->per_page );

    }

    public function store( Request $request )
    {
        return response()->json( $this->classe::create( $request->all() ), 201 );
    }

    public function show( int $id )
    {
        $recurso =  $this->classe::find( $id );
        if ( is_null( $recurso ) ){
            return response()->json('', 204);
        }
        return response()->json( $recurso );

    }

    public function update( int $id, Request $request ){
        $recurso =  $this->classe::find( $id );
        if( is_null( $recurso ) ){
            return response()->json( ['erro'=>'Erro ocasionado pelo cliente, agora sim 404'], 404 );
        }
        $recurso->fill( $request->all() );
        $recurso->save();
        
        return $recurso;
    }

    public function destroy( int $id ){
        $remove =  $this->classe::destroy( $id );
        if ( !$remove ){
            return response()->json(['erro'=>'Recurso não encontrado'],404);
        }
        return response()->json('',204);;
    }
}
