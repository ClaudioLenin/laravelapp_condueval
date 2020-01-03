@extends('layouts.admin')
@section('content')
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@foreach($users as $user)
				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
          <div class="profile-img d-flex justify-content-center">
            <img width="250px" alt="Photo Profile" src="{{asset('images/users/'.$user->foto)}}" >
          </div>
				</div>
				<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 datos">
					<div class="card-body ">
            <h3 class="card-title d-flex justify-content-center"><b>DATOS DE USUARIO</b></h3>
						<h4 class="card-text"><b>Nombre: </b>{{$user->nombre}}</h4>
            <h4 class="card-text"><b>Nombre de usuario: </b>{{session('nompersona')}} {{session('apepersona') }}</h4>
            <h4 class="card-text"><b>Cédula de identidad: </b>{{session('cedpersona')}}</h4>
            <h4 class="card-text"><b>Correo electrónico: </b>{{$user->email}}</h4>
            <h4 class="card-text"><b>Descripción: </b>{{$user->descripcion}}</h4>
						<div class="form-group d-flex justify-content-center">
							<form class="" action="{{route('getprofileadmin')}}" method="get">
								<input type="hidden" name="codpersona" value="{{$user->codpersona}}">
								<button type="submit" class="btn btn-info">Editar</button>
							</form>
						</div>
					</div>
				</div>
				@endforeach
				{{$users->render()}}
			</div>
		</div>
@endsection
