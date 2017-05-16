@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('list') }}">
                        <div class="form-group">
                            <label for="setor" class="col-md-4 control-label">Setor</label>

                            <div class="col-md-6">
                                <input id="setor" type="text" class="form-control" name="s" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="localizacao" class="col-md-4 control-label">Localização</label>

                            <div class="col-md-6">
                                <input id="localizacao" type="text" class="form-control" name="l">
                            </div>
                        </div>

                        <fieldset>
                            <div class="form-group">
                                <label for="query">Search:</label>
                                <input type="text" class="form-control" name="query" id="query" placeholder="Start typing something to search...">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </fieldset>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Procurar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
