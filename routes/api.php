<?php

// Utilize o endereço:
// http://.../api/clientes/
Route::get('clientes', 'Api\ClienteController@index');

Route::get('getcep/{cep}', 'Api\LocalizacaoController@getCep');
Route::get('listapaises', 'Api\LocalizacaoController@listaPaises');
Route::get('listaregioes/{id}', 'Api\LocalizacaoController@listaRegioes');
Route::get('listaestados/{id}', 'Api\LocalizacaoController@listaEstados');
Route::get('listaestadosporregiao/{id}', 'Api\LocalizacaoController@listaEstadosPorRegiao');
Route::get('listamesorregioes/{id}', 'Api\LocalizacaoController@listaMesorregioes');
Route::get('listacidades/{id}/{pais}', 'Api\LocalizacaoController@listaCidades');
Route::get('getcidade/{nomeCidade}', 'Api\LocalizacaoController@getCidadePeloNome');
Route::get('listacidadespormeso/{id}', 'Api\LocalizacaoController@listaCidadesPorMeso');
Route::get('cepformatado/{id}', 'Api\LocalizacaoController@cepFormatado');
Route::get('listatiposendereco', 'Api\LocalizacaoController@listaTiposEnderecos');
Route::post('endereco', 'Api\LocalizacaoController@salvarEndereco');
Route::delete('endereco/{id}', 'Api\LocalizacaoController@excluirEndereco');


Route::get('pessoa/{id}/telefones', 'Api\PessoaController@telefones');
Route::get('numeroformatado/{idTelefone}', 'Api\PessoaController@numeroFormatado');

Route::get('listatipostelefone', 'Api\PessoaController@listaTiposTelefone');
Route::get('listaoperadoras', 'Api\PessoaController@listaOperadoras');
Route::post('telefone', 'Api\PessoaController@salvarTelefone');
Route::delete('telefone/{id}', 'Api\PessoaController@excluirTelefone');

Route::get('pessoa/{id}/enderecos', 'Api\PessoaController@enderecos');
Route::get('cpfformatado/{id}', 'Api\PessoaController@cpfFormatado');
