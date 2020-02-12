<?php

Route::get('/', 'Web\TelefoneController@index');
Route::get('/home', 'Web\TelefoneController@index')->name('home');

Route::resource('pessoa', 'Web\PessoaController');
Route::any('pessoa-search', 'Web\PessoaController@search')->name('pessoa.search');
Route::resource('contato', 'Web\ContatoController');
Route::resource('empresa', 'Web\EmpresaController');
Route::resource('genero', 'Web\GeneroController');
Route::resource('telefone', 'Web\TelefoneController');
Route::resource('operadora', 'Web\OperadoraController');
Route::resource('tipotelefone', 'Web\TipoTelefoneController');
Route::resource('endereco', 'Web\EnderecoController');
Route::resource('tipoendereco', 'Web\TipoEnderecoController');
Route::resource('cidade', 'Web\CidadeController');
Route::resource('mesorregiao', 'Web\MesorregiaoController');
Route::resource('estado', 'Web\EstadoController');
Route::resource('regiao', 'Web\RegiaoController');
Route::resource('pais', 'Web\PaisController');
Route::resource('imagem', 'Web\ImagemController');
// Route::resource('email', 'Web\EmailController');
// Route::resource('tipoemail', 'Web\TipoEmailController');
