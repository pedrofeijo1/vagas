@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                {{ csrf_field() }}
                @if($vagas->count() > 0)
                    <div class="panel-heading">{{ $vagas->count() }} vagas favoritas.</div>
                    <div class="panel-body">
                        @foreach($vagas as $vaga)
                            <a href="{{ $vaga->url }}" class="list-jobs">
                                <div class="all-jobs">
                                    <div class="col-xs-12">
                                        <h2>
                                            {{ $vaga->titulo }}
                                            @if (!Auth::guest())
                                            @if (Favoritos::usuarioTemVagaComoFavorito(Auth::id(), $vaga->id))
                                            <button type="button" class="btn btn-danger pull-right add_favorites" id="vaga_{{ $vaga->id }}" data-id="{{ $vaga->id }}" data-hasfavorite="1">Remover Favorita</button>
                                            @else
                                            <button type="button" class="btn btn-primary pull-right add_favorites" id="vaga_{{ $vaga->id }}" data-id="{{ $vaga->id }}" data-hasfavorite="0">Favoritar Vaga</button>
                                            @endif
                                            @else
                                            <button type="button" title="Logue para adicionar aos favoritos!" id="vaga_{{ $vaga->id }}" data-hasfavorite="0" class="btn btn-primary pull-right add_favorites disabled">Favoritar Vaga</button>
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
                @else
                    <div class="panel-body">
                        <p>Nenhum favorito encontrado</p>
                        <a href="{{ route('search') }}">Pesquisar vagas</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
