@extends('nav')
@section('contenido')

    <div class="container">
        @if(session()->has('status'))
            <p class="alert alert-info">
                {{	session()->get('status') }}
            </p>
        @endif
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detalles de la cuenta
                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary" style="float: right">Editar</a>

                    </div>

                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Name</label>
                                <div class="col-sm-9">
                                    <p class="form-control">{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Email</label>
                                <div class="col-sm-9">
                                    <p class="form-control">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Password</label>
                                <div class="col-sm-9">
                                    <p class="form-control">********</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Created On</label>
                                <div class="col-sm-9">
                                    <p class="form-control">{{ date('d-m-Y', strtotime($user->created_at))}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="name">Last Updated</label>
                                <div class="col-sm-9">
                                    <p class="form-control">{{date('d-m-Y', strtotime($user->updated_at)) }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <a href="{{ url('/') }}" class="btn btn-success">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection