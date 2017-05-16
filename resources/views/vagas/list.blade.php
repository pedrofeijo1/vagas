@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                {{ csrf_field() }}
                @if($vagas->total() > 0 && ($vagas->currentPage() < $vagas->lastPage()))
                    <div class="panel-heading">{{ number_format($vagas->total(), 0, ",", ".") }} vagas de emprego</div>
                    <div class="panel-footer">
                        Resultados {{ ($vagas->currentPage() * $vagas->perPage()) - ($vagas->perPage() - 1) }} -
                        @if($vagas->total() > 10)
                            {{ $vagas->currentPage() * $vagas->perPage() }}
                        @else
                            {{ $vagas->total() }}
                        @endif
                        de {{ number_format($vagas->total(), 0, ",", ".") }}
                        <span class="pull-right">
                        Mostrar
                            <select name="pp" id="pp" class="filter">
                                <option {{ (!app('request')->has('pp') || app('request')->input('pp') == 10 ? "selected" : "" ) }}
                                        value="{{ UrlController::getUrl('pp', 10) }}">10
                                </option>
                                <option {{ (app('request')->has('pp') && app('request')->input('pp') == 25 ? "selected" : "" ) }}
                                        value="{{ UrlController::getUrl('pp', 25) }}">25
                                </option>
                                <option {{ (app('request')->has('pp') && app('request')->input('pp') == 50 ? "selected" : "" ) }}
                                        value="{{ UrlController::getUrl('pp', 50) }}">50
                                </option>
                            </select>
                            por página e ordenar por:
                            <select name="ob" id="ob" class="filter">
                                <option {{ (!app('request')->has('ob') || app('request')->input('ob') == 'su' ? "selected" : "" ) }}
                                        value="{{ UrlController::getUrl('ob', 'su') }}">Maior salario
                                </option>
                                <option {{ (app('request')->has('ob') && app('request')->input('ob') == 'sd' ? "selected" : "" ) }}
                                        value="{{ UrlController::getUrl('ob', 'sd') }}">Menor salario
                                </option>
                            </select>
                        </span>
                    </div>
                    <div class="panel-body">
                        <div id="filter-panel" class="collapse filter-panel">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form" method="GET" action="{{ route('list') }}">
                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Setor:</label>
                                            <input type="text" class="form-control input-sm" id="pref-search" name="s">
                                        </div>
                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Localização:</label>
                                            <input type="text" class="form-control input-sm" id="pref-search" name="l">
                                        </div>
                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Salario de:</label>
                                            <input type="text" class="form-control input-sm" id="pref-search" name="sd">
                                        </div>
                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Salario ate:</label>
                                            <input type="text" class="form-control input-sm" id="pref-search" name="da">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Pesquisar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary pull-right" data-toggle="collapse" data-target="#filter-panel">
                            Busca avançada
                        </button>
                        @foreach($vagas as $vaga)
                        <a href="{{ $vaga->url }}" class="list-jobs">
                            <div class="all-jobs">
                                <div class="col-xs-12">
                                    <h2>
                                        {{ $vaga->titulo }}
                                        @if (!Auth::guest())
                                            @if (Favoritos::usuarioTemVagaComoFavorito(Auth::id(), $vaga->id))
                                                <button type="button" class="btn btn-danger pull-right add_favorites" id="vaga_{{ $vaga->id }}" data-id="{{ $vaga->id }}" data-hasfavorite="1">Favoritos</button>
                                            @else
                                                <button type="button" class="btn btn-primary pull-right add_favorites" id="vaga_{{ $vaga->id }}" data-id="{{ $vaga->id }}" data-hasfavorite="0">Favoritos</button>
                                            @endif
                                        @else
                                            <button type="button" title="Logue para adicionar aos favoritos!" id="vaga_{{ $vaga->id }}" data-hasfavorite="0" class="btn btn-primary pull-right add_favorites disabled">Favoritos</button>
                                        @endif
                                    </h2>
                                </div>
                                <div class="col-xs-12">
                                    <i class="fa fa-briefcase " aria-hidden="true" title="job_type">
                                        <span class="data">{{ $vaga->tipo_contrato }}</span>
                                    </i>
                                    <span class="data">/</span>
                                    <i class="fa fa-clock-o " aria-hidden="true" title="time required">
                                        <span class="data">{{ $vaga->jornada }}</span>
                                    </i>
                                    <span class="data">/</span>
                                    <i class="fa fa-clock-o " aria-hidden="true" title="time required">
                                        <span class="data">{{ $vaga->salario }}</span>
                                    </i>
                                </div>

                                <div class="col-xs-12">
                                <p>{{ ($vaga->descricao != "Campo Vazio" ? $vaga->descricao : "Descrição não fornecida pela empresa.") }}</p>
                                </div>

                                <div class="col-xs-12">
                                    <i class="fa fa-check-circle-o " aria-hidden="true" title="job_type">
                                        <span class="data">{{ $vaga->nome_empresa }}</span>
                                    </i>
                                    <span class="data">/</span>
                                    <i class="fa fa-globe " aria-hidden="true" title="job required">
                                        <span class="data">{{ $vaga->localizacao }}</span>
                                    </i>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <div class="pagination">
                            {{ $vagas->links('custom.pagination') }}
                        </div>
                    </div>
                @else
                    <div class="panel-body">
                        <p>Nenhum resultado encontrado</p>
                        <a href="{{ route('search') }}">Voltar para a página inicial</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
