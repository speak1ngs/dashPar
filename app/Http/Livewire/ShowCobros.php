<?php

namespace App\Http\Livewire;
use Illuminate\Database\Query\Builder;
use App\View\Components\table;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithPagination;

class ShowCobros extends Component
{

    use WithPagination;
    public $sort = 'clientes.nombres';
    public $direction= 'desc';
    public $cant = 10;
    public $search ='';
    public $categories= 'Atra. 91-180';
    public $readyToLoad = false;


    protected $queryString = [
        'cant'=>['except'=> '10'],
        'sort'=>['except'=> 'clientes.nombres'],
        'direction'=>['except'=> 'desc'],
        'categories' =>['except' => 'Atra. 91-180'],
        'search'=>['except'=> '']
    ];


    public function mount()

    {
        $this->sort = 'clientes.nombres';
        $this->direction= 'desc';
        $this->cant = 10;
        $this->search ='';
        $this->categories= 'Atra. 91-180';
        $this->readyToLoad = true;

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    protected $listeners = ['render'];


    public function render()
    {


        if($this->readyToLoad){
            //   $data = db::table('comentarios')->select(db::raw('max(comentarios.fecha) as fecha'))->join('contrato','comentarios.idcontrato','=', 'contrato.idcontrato')->groupBy('comentarios.idcontrato')->paginate($this->cant);
            //$data = db::select("SELECT MAX(comentarios.fecha)from comentarios,contrato where comentarios.idcontrato = contrato.idcontrato GROUP by (comentarios.idcontrato); ");
            


            $datos = DB::TABLE('clientes')
            ->join('contrato', 'clientes.idclientes', '=', 'contrato.idcliente')
            ->join('cuotas' , 'contrato.idcontrato',  '=', 'cuotas.idcontrato')
            ->join('comentarios' , 'contrato.idcontrato',  '=', 'comentarios.idcontrato')
            ->join('empleados','clientes.telecob', '=', 'empleados.idempleado')
            ->select('clientes.nombres', 'clientes.apellidos', 'clientes.cino', 'empleados.nombres AS nombre_user', 'empleados.apellidos AS apelli_user', 'contrato.contrato',DB::raw('MIN(cuotas.vcto) AS primera_fecha_vencida'), DB::raw('SUM(cuotas.monto) AS suma_cuotas_vencidas'),  'comentarios.comentario as comentarios', 'comentarios.usuario',  DB::raw('MAX(comentarios.fecha) AS fecha_coment'), 'contrato.idcontrato' )
            ->where('cuotas.vcto', '<=', '2023-04-30')
            ->where('cuotas.pago', '=', '0')
            ->where('contrato.tipomovim','=','certificado')
            ->where('cuotas.categoria','=', $this->categories)
             ->where('comentarios.fecha','=', function(Builder $query){
                    $query->select(db::raw('max(comentarios.fecha) as fecha'))->from('comentarios')->whereColumn('comentarios.idcontrato','contrato.idcontrato')->groupBy('comentarios.idcontrato');
              } )
            ->where('contrato.contrato','like','%'. $this->search . '%')
            ->groupBy('clientes.idclientes', 'contrato.idcontrato', 'comentarios.idcontrato' )
            ->paginate($this->cant);
       
        }
        else{
            $datos = [];
        }


        return view('livewire.show-cobros', compact('datos'));
    }


    
    public function loadPost()
    {
        $this->readyToLoad = true;
    }

    // odernar post 
    public function order($sort)
    {
        if ($this->sort == $sort) {
            
            if ($this->direction == 'desc') {
                
                $this->direction = 'asc';
                
            } else {
                $this->direction = 'desc';
            }
            

        } else {
            $this->sort= $sort;
            $this->direction = 'asc';
        }
    }

}
