@extends ('layouts.teacher')
@section ('content_3')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<form enctype="multipart/form-data" action="{{route('editar')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
					<div class="profile-img d-flex justify-content-center">
						<div class="form-group">
								<label for="imagen">Cambiar Foto</label>
								<input type="file" name="foto" class="form-control">
								@if(($user->foto)!="")
								<img width="250px" alt="Photo Profile" src="{{asset('images/users/'.$user->foto)}}" >
								@endif
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 datos">
					<div class="card-body ">
						<h3 class="card-title d-flex justify-content-center"><b>EDITAR DATOS DE USUARIO</b></h3>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" name="nombre" required value="{{$user->nombre}}" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="codigo">Correo electrónico</label>
								<input type="email" name="email" required value="{{$user->email}}" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="descripcion">Descripción</label>
								<input type="text" name="descripcion" required value="{{$user->descripcion}}" class="form-control">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="stock">Contraseña</label>
								<input type="password" name="password" value="0604838763" class="form-control">
							</div>
						</div>
					</div>
				</div>
				 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 <div class="form-group d-flex justify-content-center">
						 <button class="btn btn-info" type="submit">Guardar</button>
						 <a href="profile"><button class="btn btn-danger" type="button">Cancelar</button></a>
					 </div>
				 </div>
			 </div>
		</form>

	</div>
</div>
@endsection
