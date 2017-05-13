@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if($vagas->total() > 0)
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
                            <select name="pp" id="pp">
                                <option {{ (!app('request')->has('pp') || app('request')->input('pp') == 10 ? "selected" : "" ) }}
                                        value="s={{ app('request')->input('s') }}&l={{ app('request')->input('l') }}&pp=10">10
                                </option>
                                <option {{ (app('request')->has('pp') && app('request')->input('pp') == 25 ? "selected" : "" ) }}
                                        value="s={{ app('request')->input('s') }}&l={{ app('request')->input('l') }}&pp=25">25
                                </option>
                                <option {{ (app('request')->has('pp') && app('request')->input('pp') == 50 ? "selected" : "" ) }}
                                        value="s={{ app('request')->input('s') }}&l={{ app('request')->input('l') }}&pp=50">50
                                </option>
                            </select>
                        por página
                        </span>
                    </div>
                    <div class="panel-body">
                        @foreach($vagas as $vaga)
                        <a href="{{ $vaga->url }}" class="list-jobs">
                            <div class="all-jobs">
                                <div class="col-xs-12">
                                    <h2>{{ $vaga->titulo }}</h2>
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
                                    <p>{{ $vaga->descricao }}</p>
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
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
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
