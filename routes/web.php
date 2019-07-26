<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.principal');
});

Auth::routes();

Route::middleware('autorizacao')->group(function() {

  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
  Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

  //Rotas para notificacao
  Route::get('/usuario/notificacao/listar', 'NotificacaoController@listar')->name('notificacao.listar');
  Route::get('/usuario/notificacao/{id_notificacao}/ler', 'NotificacaoController@ler')->name('notificacao.ler');

  //Rotas para usuario
  Route::get('/usuario/completarCadastro', 'UsuarioController@completarCadastro')->name('usuario.completarCadastro');
  Route::post('/usuario/completar', 'UsuarioController@completar')->name('usuario.completar');

  //Rotas para alunos
  Route::get('/aluno/cadastrar', 'AlunoController@cadastrar')->name('aluno.cadastrar');
  Route::post('/aluno/criar', 'AlunoController@criar')->name('aluno.criar');
  Route::get('/aluno/listar', 'AlunoController@listar')->name('aluno.listar');
  Route::get('/aluno/buscar', 'AlunoController@buscar')->name('aluno.buscar');
  Route::post('/aluno/buscarCodigo', 'AlunoController@buscarCodigo')->name('aluno.buscarCodigo');
  Route::get('/aluno/{id_aluno}/gerenciar', 'AlunoController@gerenciar')->name('aluno.gerenciar');

  //Permissões
  Route::get('/aluno/{id_aluno}/gerenciar/permissoes','AlunoController@gerenciarPermissoes')->name('aluno.permissoes');
  Route::get('/aluno/{id_aluno}/gerenciar/permissoes/cadastrar','AlunoController@cadastrarPermissao')->name('aluno.permissoes.cadastrar');
  Route::post('/aluno/gerenciar/permissoes/criar','AlunoController@criarPermissao')->name('aluno.permissoes.criar');
  Route::get('/aluno/{id_aluno}/gerenciar/permissoes/{id_permissao}/remover','AlunoController@removerPermissao')->name('aluno.permissoes.remover');
  Route::get('/aluno/{cod_aluno}/gerenciar/permissoes/requisitar', 'AlunoController@requisitarPermissao')->name('aluno.permissoes.requisitar');
  Route::get('/aluno/{id_aluno}/gerenciar/permissoes/notificacao/{id_notificacao}/conceder', 'AlunoController@concederPermissao')->name('aluno.permissoes.conceder');
  Route::post('/aluno/gerenciar/permissoes/notificar','AlunoController@notificar')->name('aluno.permissoes.notificar');

  //Rotas para objetivos
  Route::get('/aluno/{id_aluno}/objetivos/cadastrar','ObjetivoController@cadastrar')->name('objetivo.cadastrar');
  Route::post('/aluno/objetivos/criar', 'ObjetivoController@criar')->name('objetivo.criar');
  Route::get('/aluno/{id_aluno}/objetivos/listar','ObjetivoController@listar')->name('objetivo.listar');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar','ObjetivoController@gerenciar')->name('objetivo.gerenciar');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/concluir','ObjetivoController@concluir')->name('objetivo.concluir');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/desconcluir','ObjetivoController@desconcluir')->name('objetivo.desconcluir');

  //Rotas para atividade
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/atividades/listar','AtividadeController@listar')->name('objetivo.atividades.listar');
  Route::post('/aluno/objetivos/gerenciar/atividades/criar', 'AtividadeController@criar')->name('objetivo.atividades.criar');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/atividades/cadastrar','AtividadeController@cadastrar')->name('objetivo.atividades.cadastrar');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/atividades/{id_atividade}/concluir','AtividadeController@concluir')->name('objetivo.atividades.concluir');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/atividades/{id_atividade}/desconcluir','AtividadeController@desconcluir')->name('objetivo.atividades.desconcluir');

  //Rotas para sugestão
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/sugestoes/listar','SugestaoController@listar')->name('objetivo.sugestoes.listar');
  Route::post('/aluno/objetivos/gerenciar/sugestoes/criar', 'SugestaoController@criar')->name('objetivo.sugestoes.criar');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/sugestoes/cadastrar','SugestaoController@cadastrar')->name('objetivo.sugestoes.cadastrar');

  //Rotas para feedback
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/sugestoes/{id_sugestao}/feedbacks/listar','FeedbackController@listar')->name('objetivo.sugestoes.feedbacks.listar');
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/sugestoes/{id_sugestao}/feedbacks/cadastrar','FeedbackController@cadastrar')->name('objetivo.sugestoes.feedbacks.cadastrar');
  Route::post('/aluno/objetivos/gerenciar/sugestoes/feedbacks/criar','FeedbackController@criar')->name('objetivo.sugestoes.feedbacks.criar');

  //Rotas para foruns
  Route::post('/aluno/forum/mensagem/enviar','ForumController@enviarMensagemForumAluno')->name('aluno.forum.mensagem.enviar');
  Route::get('/aluno/{id_aluno}/forum','ForumController@abrirForumAluno')->name('aluno.forum');
  Route::post('/aluno/objetivo/forum/mensagem/enviar','ForumController@enviarMensagemForumObjetivo')->name('objetivo.forum.mensagem.enviar');
  Route::get('/aluno/{id_aluno}/objetivo/{id_objetivo}/forum','ForumController@abrirForumObjetivo')->name('objetivo.forum');

  //rotas para statuses
  Route::get('/aluno/{id_aluno}/objetivos/{id_objetivo}/gerenciar/status/cadastrar','StatusController@cadastrar')->name('objetivo.status.cadastrar');
  Route::post('/aluno/objetivos/status/criar', 'StatusController@criar')->name('objetivo.status.criar');

  //Rotas para albuns
  Route::get('/aluno/{id_aluno}/albuns/listar', 'AlbumController@listar')->name('album.listar');
  Route::get('/aluno/{id_aluno}/albuns/{id_album}/ver', 'AlbumController@ver')->name('album.ver');
  Route::get('/aluno/{id_aluno}/albuns/cadastrar', 'AlbumController@cadastrar')->name('album.cadastrar');
  Route::post('/aluno/albuns/criar', 'AlbumController@criar')->name('album.criar');

  //Instituição
  Route::get('/instituicao/cadastrar', 'InstituicaoController@cadastrar')->name('instituicao.cadastrar');
  Route::post('/instituicao/criar', 'InstituicaoController@criar')->name('instituicao.criar');
  Route::get('/instituicao/listar', 'InstituicaoController@listar')->name('instituicao.listar');
  Route::get('/instituicao/{id_instituicao}/editar', 'InstituicaoController@editar')->name('instituicao.editar');
  Route::get('/instituicao/{id_instituicao}/excluir', 'InstituicaoController@excluir')->name('instituicao.excluir');
  Route::post('/instituicao/atualizar', 'InstituicaoController@atualizar')->name('instituicao.atualizar');

});
