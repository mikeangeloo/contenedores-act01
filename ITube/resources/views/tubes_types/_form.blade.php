<hr class="conjunto">
{!! Form::label('name', 'Nombre:') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
<br>

{!! Form::label('general_description', 'Descripción General:') !!}
{!! Form::text('general_description', null, ['class' => 'form-control']) !!}
<hr class="conjunto">
<button type="submit">Guardar</button>