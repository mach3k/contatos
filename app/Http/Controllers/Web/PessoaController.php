<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Genero;
use App\Models\Operadora;
use App\Models\TipoEndereco;
use App\Models\TipoTelefone;
use App\User;
use Illuminate\Support\Facades\Storage;

class PessoaController extends Controller {

    protected $titleModal = 'Pessoa Física';
    private $itemPage = 6;

    public function index() {
        $registros = Pessoa::where('juridica', false)
        ->with([
            'empregador',
            'genero',
            'enderecos',
            'telefones',
            'foto'
        ])->paginate($this->itemPage);

        $title = 'Pessoas Físicas';
        $empresas = Pessoa::all();
        $generos = Genero::all();

        return view('pessoa.index',[
            'registros' => $registros,
            'generos' => $generos,
            'empresas' => $empresas
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Pessoa::with('empregador')
        ->with('genero')
        ->with('enderecos')
        // ->with('enderecos.cidade')
        // ->with('enderecos.cidade.estado')
        // ->with('enderecos.cidade.estado.pais')
        ->with('telefones')
        ->with('telefones.tipo')
        ->with('foto')
        ->findOrFail($id);

        // dd($registro);
        // $teste = Storage::get('$registro->foto->nome');
        // dd($registro->foto);

        if($registro->juridica)
            return redirect()->route('empresa.show', $registro->id);

        $title = 'Detalhes do Contato';

        // $empresas = Pessoa::where('juridica', true)->get();
        // $generos = Genero::all();
        // $tipos = TipoTelefone::all();
        // $tiposEnd = TipoEndereco::all();
        // $operadoras = Operadora::all();

        // dd($registro);
        // // dd(json_encode($registro));

        // return view('pessoa.show',[
        //     'registro' => $registro,
        //     'tipos' => $tipos,
        //     'tiposEnd' => $tiposEnd,
        //     'operadoras' => $operadoras,
        //     'generos' => $generos,
        //     'empresas' => $empresas
        // ])
        // ->withTitle($title)
        // ->with('titleModal', $this->titleModal);

        // $registro = Operadora::findOrFail(1);

        return view('pessoa.show2',[
            'registro' => $registro
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function create() {
        return redirect()->route('pessoa.index');
    }

    public function edit($id) {
        return redirect()->route('pessoa.show', $id);
    }

    public function store(Request $request) {

        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'dataNascimento' => 'required',
                'rg_ie' => 'required|max:20',
                'cpf_cnpj' => 'cpf',
            ]);

            $registro = new Pessoa;
            $this->salvar($request, $registro);

            toastr()->success('Registro salvo com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            // dd($th);
            toastr()->error('Falha ao salvar o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'dataNascimento' => 'required',
                'rg_ie' => 'required|max:20',
            ]);

            $registro = Pessoa::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.show', $id);
    }

    protected function salvar(Request $request, Pessoa $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Pessoa::findOrFail($id);
            $registro->delete();
            toastr()->success('Registro excluído com sucesso!', 'Feito!');
            $arr = array('message' => 'Registro excluído com sucesso!', 'title' => 'Feito!');
            echo json_encode($arr);
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.index');
    }

    public function search(Request $request){

        $form = $request->except('_token');

        $query = Pessoa::where('juridica', false)
        ->with([
            'empregador',
            'genero',
            'enderecos',
            'telefones',
            'foto'
        ]);

        $title = 'Pessoas Físicas';

        $empresas = Pessoa::all();
        $generos = Genero::all();

        // if ($request->isMethod('post')) {
            if($request->has('search'))
                $query->where('nome', 'like', '%' . $form['search'] . '%')
                    ->orWhere('nomeSocial', 'like', '%' . $form['search'] . '%')
                    ->orWhere('cargo', 'like', '%' . $form['search'] . '%')
                    ->orWhere('cpf_cnpj', 'like', '%' . $form['search'] . '%');

        // }

        $registros = $query->paginate($this->itemPage);

        // dd($registros);

        return view('pessoa.index',[
            'registros' => $registros,
            'generos' => $generos,
            'empresas' => $empresas,
            'form' => $form
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }
}
