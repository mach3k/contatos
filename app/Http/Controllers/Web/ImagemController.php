<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\InvalidImageException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Imagem;
use App\Models\Pessoa;
use Exception;

class ImagemController extends Controller {

    protected $titleModal = 'Imagem';
    private $itemPage = 9;

    public function index() {
        $registros = Imagem::where('juridica', false)
        ->with('empregador')
        ->with('genero')
        ->with('enderecos')
        ->with('telefones')
        ->with('foto')
        ->paginate($this->itemPage);

        $title = 'Pessoas físicas';
        // $paises = Pais::all();
        $estados = Imagem::all();

        return view('pessoa.index',[
            'registros' => $registros,
            // 'paises' => $paises,
            'estados' => $estados
        ])
        ->withTitle($title)
        ->with('titleModal', $this->titleModal);
    }

    public function show($id) {
        $registro = Imagem::where('juridica', false)
        ->with('empregador')
        ->with('genero')
        ->with('enderecos')
        ->with('telefones')
        ->with('foto')
        ->findOrFail($id);

        $title = 'Detalhes do Contato';
        $estados = Estado::all();

        return view('pessoa.show',[
            'registro' => $registro,
            'estados' => $estados
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
                'pessoa_id'=> 'required|numeric',
            ]);

            if (!($request->hasFile('imagem') && $request->file('imagem')->isValid()))
                throw new InvalidImageException("Falha ao salvar a imagem", 1);

            $nameFile = null;

            $name = uniqid(date('HisYmd'));
            $extension = $request->imagem->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->imagem->storeAs('categories', $nameFile);

            dd($upload);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

            $registro = new Imagem;
            $this->salvar($request, $registro);

            $pessoa = Pessoa::findOrFail($request->pessoa_id);

            toastr()->success('Imagem salva com sucesso.', 'Feito!');
        } catch (InvalidImageException $th) {
            toastr()->error('Falha ao salvar a imagem:<br> Informe uma imagem válida', 'Ops!');
        } catch (Exception $th) {
            toastr()->error('Falha ao salvar a imagem.', 'Ops!');
        }

        if ($request->has('pessoa_id'))
            return redirect()->route('pessoa.show', $request->pessoa_id);

        return redirect()->route('pessoa.index');
    }

    public function update(Request $request, $id) {
        try {
            $this->validate($request,[
                'nome'=> 'required|max:200',
                'estado_id' => 'required|numeric',
            ]);

            $registro = Imagem::findOrFail($id);
            $this->salvar($request, $registro);

            toastr()->success('Registro alterado com sucesso.', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao atualizar o registro.', 'Ops!');
        }

        return redirect()->route('pessoa.show', $id);
    }

    protected function salvar(Request $request, Imagem $registro){
        $registro->fill($request->all());
        $registro->save();
    }

    public function destroy($id) {

        try {
            $registro = Imagem::findOrFail($id);
            $registro->delete();
            toastr()->success('Imagem excluída com sucesso!', 'Feito!');
        } catch (\Throwable $th) {
            toastr()->error('Falha ao excluir imagem.', 'Ops!');
        }

        return redirect()->route('pessoa.index');
    }
}
