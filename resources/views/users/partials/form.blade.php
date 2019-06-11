@csrf
<div class="form-group">
  <label for="name">Nombre:</label>
  <input type="text" name="name" id="" id="name" class="form-control  {{$errors->has('name') ? 'is-invalid': 'is-valid'}}" value="{{ $user->name ?? old('name') }}" placeholder="Nombre:" title="Nombre" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
  {!! $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
  <label for="email">Correo eléctronico:</label>
  <input type="email" name="email" id="email" class="form-control  {{$errors->has('email') ? 'is-invalid': 'is-valid'}}" title="Correo eléctronico" value="{{ $user->email ?? old('email') }}" placeholder="Correo eléctronico:" required>
  {!! $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
</div>
@unless ($user->id)
<div class="form-group">
  <label for="password">Contraseña</label>
  <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid': 'is-valid'}}" name="password" id="password" placeholder="Contraseña">
  {!! $errors->first('password','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
  <label for="password_confirmation">Confirmar contraseña</label>
  <input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid': 'is-valid'}}" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña">
  {!! $errors->first('password_confirmation','<div class="invalid-feedback">:message</div>') !!}
</div>
@endunless
<div class="form-check">
  @foreach ($roles as $id => $name)
    <div>
      <input
      type="checkbox"
      {{ isset($user) && $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
      name="roles[]"
      value="{{$id}}"
      class="form-check-input {{$errors->has('roles') ? 'is-invalid': 'is-valid'}}"
      id="{{$id.'-'.$name}}">
      <label class="form-check-label" for="{{$id.'-'.$name}}">{{ $name }}</label>
      {!! $errors->first('roles','<div class="invalid-feedback">:message</div>') !!}
    </div>

  @endforeach
</div>
