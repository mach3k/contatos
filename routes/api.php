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
Route::get('listacidades/{id}', 'Api\LocalizacaoController@listaCidades');
Route::get('listacidadespormeso/{id}', 'Api\LocalizacaoController@listaCidadesPorMeso');
