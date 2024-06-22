<hr class="conjunto">
{!! Form::label('name', 'Nombre:') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
<br>

{!! Form::label('metric_designation', 'Designación metrica:') !!}
{!! Form::text('metric_designation', null, ['class' => 'form-control']) !!}

{!! Form::label('commercial_size', 'Tamaño comercial:') !!}
{!! Form::text('commercial_size', null, ['class' => 'form-control']) !!}

{!! Form::label('inside_diameter', 'Diametro interior:') !!}
{!! Form::text('inside_diameter', null, ['class' => 'form-control']) !!}

<label for="tubes_types">Tipo de tubo</label>
<select name="tubes_types" id="tubes_types">
@foreach($_tubes_types as $tipotubo)
        <option value="{{$tipotubo->id}}">{{$tipotubo->name}}</option>
@endforeach
</select>

<hr class="conjunto">
<button type="submit">Guardar</button>