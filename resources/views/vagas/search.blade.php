@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('list') }}">
                        <div class="form-group">
                            <label for="setor" class="col-md-4 control-label">O quê?</label>

                            <div class="col-md-6">
                                <input id="setor" type="text" class="form-control" name="s" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="localizacao" class="col-md-4 control-label">Onde?</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control typeahead" id="l" name="l" />
                            </div>
                        </div>


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
