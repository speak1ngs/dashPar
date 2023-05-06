<?php

namespace App\Http\Livewire;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListarContratos extends Component
{
    public $dato;
    public $ci;
    public $nombres;
    public $open_show = false;
    

    public function mount($dato)
    {
        $this->dato = $dato;
       
    }


    public function render()
    {
        // $selectUser = DB::table('contrato')
        // ->join('clientes','contrato.idcliente','=','clientes.idclientes')
        // ->select('contrato.idcontrato', 'contrato.contrato', 'clientes.nombres', 'clientes.apellidos', 'clientes.cino')
        // ->where('contrato.idcliente','=', $this->dato);
            $selectUser = DB::select("SELECT  idcontrato,contrato, tipomovim from contrato
            JOIN clientes c on contrato.idcliente = c.idclientes
            where contrato.idcliente =" .$this->dato );

        $ci= $this->ci;
        $nombres = $this->nombres;
        return view('livewire.listar-contratos', compact('selectUser' , 'ci' , 'nombres'));
    }
}
