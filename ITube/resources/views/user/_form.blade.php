@if (isset($errors)&&(count($errors)>0))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="text-align: center">Editar perfil </h4>
        </div>
        <div class="col-sm-12 col-lg-12 text-center">
            {!! Html::image("uploads/usersprofile/{$user->image}",'userimg',['class'=>'imgperfil']) !!}
            <input id="user_image" name="user_image" class="form-control form-image" type="file">
            <hr class="conjunto2">
        </div>
        <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="password">
                        <br>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <input type="submit" class="form-control btn btn-success" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>